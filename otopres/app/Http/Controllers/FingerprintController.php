<?php

namespace App\Http\Controllers;

use App\Imports\PresensiImport;
use App\Komdanas;
use App\Pegawai;
use App\Presensi;
use DateTime;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FingerprintController extends Controller
{
    private $folder = 'fingerprint';
    private $headers = [
        "No. ID", "Nama", "Tanggal", "Jam Masuk", "Jam Pulang", "Scan Masuk", "Scan Pulang", "Terlambat", "Plg. Cepat", "Lembur", "Jml Jam Kerja", "Pengecualian", "Jml Kehadiran",
    ];

    private function checkFormat($rows)
    {
        foreach ($this->headers as $h) {
            $f = false;
            foreach ($rows as $row) {
                if ($row == $h) {
                    $f = true;
                    break;
                }
            }
            if (!$f) {
                return false;
            }

        }
        return true;
    }

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
        $tanggal = "";
        $data = [];
        if (isset($request->file_xls)) {
            $file = $request->file('file_xls');
            try {
                $collections = Excel::toCollection(new PresensiImport, $file);
                if (isset($collections[0])) {
                    $checked = false;
                    $pegawai = Pegawai::all();
                    $komdanas = Komdanas::all();
                    foreach ($collections[0] as $cols) {
                        if ($checked) {
                            $presensi = new Presensi;
                            $presensi->jenis = 1;
                            $peg = null;
                            foreach ($cols as $key => $val) {
                                $row = trim($val);
                                switch ($key) {
                                    case 0:
                                        $presensi->id_finger = $row;
                                        break;
                                    case 1:
                                        foreach ($pegawai as $p) {
                                            if (strtolower(rtrim($p->nama_file)) === strtolower(rtrim($row))) {
                                                $presensi->nip_pegawai = $p->nip;
                                                $peg = $p;
                                                break;
                                            }
                                        }
                                        break;
                                    case 2:
                                        $presensi->tanggal = DateTime::createFromFormat('d-m-Y', $row)->format('Y-m-d');
                                        break;
                                    case 5:
                                        $presensi->jam_masuk = ($row === "" ? null : $row);
                                        break;
                                    case 6:
                                        $presensi->jam_pulang = ($row === "" ? null : $row);
                                        break;
                                    case 7:
                                        $presensi->terlambat = ($row === "" ? null : $row);
                                        break;
                                    case 8:
                                        $presensi->pulang_cepat = ($row === "" ? null : $row);
                                        break;
                                    case 9:
                                        $presensi->jumlah_jam = ($row === "" ? null : $row);
                                        break;
                                }
                            }
                            if ($peg !== null && Presensi::where(['id_finger' => $presensi->id_finger, 'tanggal' => $presensi->tanggal])->first() === null) {
                                $presensi->status_komdanas = $this->getStatus($komdanas, $peg, $presensi);
                                $presensi->save();
                            }

                        } else {
                            $checked = $this->checkFormat($cols);
                        }
                    }
                    \Session::flash('success', 'Users uploaded successfully.');
                    return redirect(route('fingerprint'));
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        if (isset($request->tanggal)) {
            $tanggal = $request->tanggal;
            $data = Presensi::where(['jenis' => 1, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->get();
        } else {
            $data = Presensi::where('jenis', '=', 1)->get();
        }
        return view($this->folder . '.index', compact('data', 'tanggal'));
    }

    public function destroy(Request $request)
    {
        $data = Presensi::findOrFail($request->get('id'))->delete();
        return redirect($this->folder)->with(['success' => 'Berhasil diubah !']);
    }
}
