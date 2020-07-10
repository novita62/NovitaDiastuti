<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Komdanas;
use App\Pegawai;
use App\Presensi;
use DateTime;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    private $folder = 'presensi';

    private function getStatus($komdanas, $pegawai, $presensi)
    {
        $status = "";
        $masuk_ok = false;
        if ($presensi->jam_masuk == null) {
            foreach ($komdanas as $k) {
                if ($k->kode === 'tam') {
                    $status .= "tam, ";
                    break;
                }
            }
        } else {
            if (strtotime($presensi->jam_masuk) < strtotime('07:00')) {
                foreach ($komdanas as $k) {
                    if ($k->kode === 'bw') {
                        $status .= "bw, ";
                        break;
                    }
                }
            } elseif (strtotime($presensi->jam_masuk) > strtotime($pegawai->jam_masuk)) {
                foreach ($komdanas as $k) {
                    if ($k->kode === 't') {
                        $status .= "t, ";
                        break;
                    }
                }
            } elseif (strtotime($presensi->jam_masuk) <= strtotime($pegawai->jam_masuk)) {
                $masuk_ok = true;
            }
        }
        if ($presensi->jam_pulang == null) {
            foreach ($komdanas as $k) {
                if ($k->kode === 'tap') {
                    $status .= "tap, ";
                    break;
                }
            }
        } else {
            if (strtotime($presensi->jam_pulang) > strtotime('18:00')) {
                foreach ($komdanas as $k) {
                    if ($k->kode === 'lw') {
                        $status .= "lw, ";
                        break;
                    }
                }
            } elseif (strtotime($presensi->jam_pulang) < strtotime($pegawai->jam_pulang)) {
                foreach ($komdanas as $k) {
                    if ($k->kode === 'pa') {
                        $status .= "pa, ";
                        break;
                    }
                }
            } elseif (strtotime($presensi->jam_pulang) >= strtotime($pegawai->jam_pulang) && $masuk_ok) {
                $status = "v";
            }
        }
        return rtrim($status, ", ");
    }

    public function index(Request $request)
    {
        $tanggal = date('d/m/Y');
        $data = [];
        if (isset($request->tanggal)) {
            $tanggal = $request->tanggal;
            if (isset($request->jam_masuk) || isset($request->jam_pulang)) {
                $komdanas = Komdanas::all();
                $pegawai = Pegawai::findOrFail($request->get('nip'));
                $presensi = Presensi::where(['nip_pegawai' => $request->get('nip'), 'jenis' => 2, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
                if ($presensi == null) {
                    $presensi = new Presensi;
                }
                $presensi->jenis = 2;
                $presensi->nip_pegawai = $request->nip;
                $presensi->tanggal = DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d');
                if (isset($request->jam_masuk)) {
                    $presensi->jam_masuk = $request->jam_masuk;
                    if (strtotime($presensi->jam_masuk) > strtotime($pegawai->jam_masuk)) {
                        $tm = strtotime($presensi->jam_masuk) - strtotime($pegawai->jam_masuk);
                        $presensi->terlambat = date('H:i', $tm);
                    }
                }

                if (isset($request->jam_pulang)) {
                    $presensi->jam_pulang = $request->jam_pulang;
                    if (strtotime($presensi->jam_pulang) < strtotime($pegawai->jam_pulang)) {
                        $tm = strtotime($pegawai->jam_pulang) - strtotime($presensi->jam_pulang);
                        $presensi->pulang_cepat = date('H:i', $tm);
                    }
                }
                if($presensi->jam_pulang !== null && $presensi->jam_masuk !== null) {                    
                    $tm = strtotime($presensi->jam_pulang) - strtotime($presensi->jam_masuk);
                    $presensi->jumlah_jam = date('H:i', $tm);
                }
                $presensi->status_komdanas = $this->getStatus($komdanas, $pegawai, $presensi);
                $presensi->save();
            }
        }
        if ($tanggal === '') {
            $tanggal = date('d/m/Y');
        }
        $pegawai = Pegawai::all();
        foreach ($pegawai as $key => $p) {
            $pegawai[$key]->finger = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 1, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
            $pegawai[$key]->manual = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 2, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
            $pegawai[$key]->kehadiran = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 3, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
        }
        $jabatan = Jabatan::all();
        $perjab = [];
        foreach ($jabatan as $jab) {
            $arr = [];
            foreach ($pegawai as $p) {
                if ($p->id_jabatan == $jab->id) {
                    $arr[] = $p;
                }
            }
            $perjab[$jab->id] = $arr;
        }
        return view($this->folder . '.index', compact('pegawai', 'tanggal', 'perjab', 'jabatan'));
    }

    public function destroy(Request $request)
    {
        if (isset($request->nip) && isset($request->tanggal)) {
            if (($p = Presensi::where(['nip_pegawai' => $request->nip, 'jenis' => 2, 'tanggal' => DateTime::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d')])->first()) !== null) {
                $p->delete();
            }
        }
        return redirect($this->folder)->with(['success' => 'Berhasil diubah !']);
    }
}
