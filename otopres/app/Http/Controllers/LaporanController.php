<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Komdanas;
use App\Pegawai;
use App\Presensi;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
class LaporanController extends Controller
{
    private $folder = 'laporan';

    public function download(Request $request)
    {
        if (isset($request->dokumen)) {
            return Storage::download($request->dokumen);
            return response()->download(url(Storage::url($request->dokumen)));
        }
    }
    public function semua(Request $request)
    {
        $tanggal = date('d/m/Y');
        if (isset($request->tanggal)) {
            $tanggal = $request->tanggal;
        }

        if ($tanggal === '') {
            $tanggal = date('d/m/Y');
        }

        $data = [];
        $data = Pegawai::all();
        $pegawai_all = [];
        $pegawai_tidak_lengkap = [];
        foreach ($data as $key => $p) {
            $data[$key]->kehadiran = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 3, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
            if ($data[$key]->kehadiran !== null && $data[$key]->kehadiran->status_komdanas !== null && $data[$key]->kehadiran->status_komdanas !== "") {
                $data[$key]->status = $data[$key]->kehadiran->status_komdanas;
                $data[$key]->masuk = $data[$key]->kehadiran->jam_masuk;
                $data[$key]->pulang = $data[$key]->kehadiran->jam_pulang;
                $k = Komdanas::where(['kode' => $data[$key]->kehadiran->status_komdanas])->first();
                if ($k !== null) {
                    $data[$key]->keterangan = $k->keterangan;
                }
                $pegawai_all[] = $data[$key];
                continue;
            }
            $data[$key]->manual = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 2, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
            if ($data[$key]->manual !== null && $data[$key]->manual->status_komdanas !== null && $data[$key]->manual->status_komdanas !== "") {
                $data[$key]->status = $data[$key]->manual->status_komdanas;
                $data[$key]->masuk = $data[$key]->manual->jam_masuk;
                $data[$key]->pulang = $data[$key]->manual->jam_pulang;
                $data[$key]->keterangan = "";
                $stats = explode(",", $data[$key]->manual->status_komdanas);
                foreach ($stats as $s) {
                    $k = Komdanas::where(['kode' => rtrim($s, " ")])->first();
                    if ($k !== null) {
                        $data[$key]->keterangan .= $k->keterangan . ", ";
                    }
                }
                $data[$key]->keterangan = rtrim($data[$key]->keterangan, ", ");
                $pegawai_all[] = $data[$key];
                continue;
            }
            $data[$key]->finger = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 1, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
            if ($data[$key]->finger !== null && $data[$key]->finger->status_komdanas !== null && $data[$key]->finger->status_komdanas !== "") {
                $data[$key]->status = $data[$key]->finger->status_komdanas;
                $data[$key]->masuk = $data[$key]->finger->jam_masuk;
                $data[$key]->pulang = $data[$key]->finger->jam_pulang;
                $data[$key]->keterangan = "";
                $stats = explode(",", $data[$key]->finger->status_komdanas);
                foreach ($stats as $s) {
                    $k = Komdanas::where(['kode' => rtrim($s, " ")])->first();
                    if ($k !== null) {
                        $data[$key]->keterangan .= $k->keterangan . ", ";
                    }
                }
                $data[$key]->keterangan = rtrim($data[$key]->keterangan, ", ");
                $pegawai_all[] = $data[$key];
                continue;
            }
            $pegawai_all[] = $data[$key];
            $pegawai_tidak_lengkap[] = $data[$key];
        }
        return view($this->folder . '.index_semua', compact('pegawai_all', 'pegawai_tidak_lengkap', 'tanggal'));
    }

    public function perjabatan(Request $request)
    {
        $tanggal = date('d/m/Y');
        if (isset($request->tanggal)) {
            $tanggal = $request->tanggal;
        }

        if ($tanggal === '') {
            $tanggal = date('d/m/Y');
        }

        $data = [];
        $pegawai = Pegawai::all();
        $jabatan = Jabatan::all();

        foreach ($jabatan as $key => $j) {
            foreach ($pegawai as $p) {
                if ($p->id_jabatan == $j->id) {
                    $dt = DateTime::createFromFormat('d/m/Y', $tanggal);
                    $presensi = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 3, 'tanggal' => $dt->format('Y-m-d')])->first();
                    if ($presensi !== null) {
                        $k = Komdanas::where(['kode' => $presensi->status_komdanas])->first();
                        if ($k !== null) {
                            $presensi->keterangan = $k->keterangan;
                        }
                        $data[$j->id][] = $presensi;
                        continue;
                    }
                    $presensi = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 2, 'tanggal' => $dt->format('Y-m-d')])->first();
                    if ($presensi !== null) {
                        $k = Komdanas::where(['kode' => $presensi->status_komdanas])->first();
                        $presensi->keterangan = "";
                        $stats = explode(",", $presensi->status_komdanas);
                        foreach ($stats as $s) {
                            $k = Komdanas::where(['kode' => rtrim($s, " ")])->first();
                            if ($k !== null) {
                                $presensi->keterangan .= $k->keterangan . ", ";
                            }
                        }
                        $presensi->keterangan = rtrim($presensi->keterangan, ", ");
                        $data[$j->id][] = $presensi;
                        continue;
                    }
                    $presensi = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 1, 'tanggal' => $dt->format('Y-m-d')])->first();
                    if ($presensi !== null) {
                        $k = Komdanas::where(['kode' => $presensi->status_komdanas])->first();
                        $presensi->keterangan = "";
                        $stats = explode(",", $presensi->status_komdanas);
                        foreach ($stats as $s) {
                            $k = Komdanas::where(['kode' => rtrim($s, " ")])->first();
                            if ($k !== null) {
                                $presensi->keterangan .= $k->keterangan . ", ";
                            }
                        }
                        $presensi->keterangan = rtrim($presensi->keterangan, ", ");
                        $data[$j->id][] = $presensi;
                        continue;
                    }
                }
            }
        }
        return view($this->folder . '.index_perjabatan', compact('data', 'jabatan', 'tanggal'));
    }

    public function perseorangan(Request $request)
    {
        $tanggal_start = date('d/m/Y');
        $tanggal_end = date('d/m/Y');

        if (isset($request->start)) {
            $tanggal_start = $request->start;
        }

        if ($tanggal_start === '') {
            $tanggal_start = date('d/m/Y');
        }

        if (isset($request->end)) {
            $tanggal_end = $request->end;
        }

        if ($tanggal_end === '') {
            $tanggal_end = date('d/m/Y');
        }
        if (strtotime($tanggal_end) < strtotime($tanggal_start)) {
            $tanggal_start = $tanggal_end;
        }
        $data = [];
        $pegawai = Pegawai::all();

        $start = DateTime::createFromFormat('d/m/Y', $tanggal_start);
        $end = DateTime::createFromFormat('d/m/Y', $tanggal_end);
        $end->setTime(0, 0, 1);
        $interval = DateInterval::createFromDateString('1 day');
        $end->add($interval);
        $period = new DatePeriod($start, $interval, $end);
        foreach ($pegawai as $p) {
            foreach ($period as $dt) {
                $presensi = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 3, 'tanggal' => $dt->format('Y-m-d')])->first();
                if ($presensi !== null) {
                    $k = Komdanas::where(['kode' => $presensi->status_komdanas])->first();
                    if ($k !== null) {
                        $presensi->keterangan = $k->keterangan;
                    }
                    $data[$p->nipid()][] = $presensi;
                    continue;
                }
                $presensi = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 2, 'tanggal' => $dt->format('Y-m-d')])->first();
                if ($presensi !== null) {
                    $k = Komdanas::where(['kode' => $presensi->status_komdanas])->first();
                    $presensi->keterangan = "";
                    $stats = explode(",", $presensi->status_komdanas);
                    foreach ($stats as $s) {
                        $k = Komdanas::where(['kode' => rtrim($s, " ")])->first();
                        if ($k !== null) {
                            $presensi->keterangan .= $k->keterangan . ", ";
                        }
                    }
                    $presensi->keterangan = rtrim($presensi->keterangan, ", ");
                    $data[$p->nipid()][] = $presensi;
                    continue;
                }
                $presensi = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 1, 'tanggal' => $dt->format('Y-m-d')])->first();
                if ($presensi !== null) {
                    $k = Komdanas::where(['kode' => $presensi->status_komdanas])->first();
                    $presensi->keterangan = "";
                    $stats = explode(",", $presensi->status_komdanas);
                    foreach ($stats as $s) {
                        $k = Komdanas::where(['kode' => rtrim($s, " ")])->first();
                        if ($k !== null) {
                            $presensi->keterangan .= $k->keterangan . ", ";
                        }
                    }
                    $presensi->keterangan = rtrim($presensi->keterangan, ", ");
                    $data[$p->nipid()][] = $presensi;
                    continue;
                }
            }
        }
        return view($this->folder . '.index_perseorangan', compact('data', 'pegawai', 'tanggal_start', 'tanggal_end'));
    }

    public function cetak_perjabatan(Request $request)
    {
        if (isset($request->tanggal) && isset($request->id)) {
            $tanggal = date('d/m/Y');
            if (isset($request->tanggal)) {
                $tanggal = $request->tanggal;
            }

            if ($tanggal === '') {
                $tanggal = date('d/m/Y');
            }

            $data = [];
            $pegawai = Pegawai::all();
            $dt = DateTime::createFromFormat('d/m/Y', $tanggal);

            foreach ($pegawai as $p) {
                if ($p->id_jabatan == $request->id) {
                    $presensi = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 3, 'tanggal' => $dt->format('Y-m-d')])->first();
                    if ($presensi !== null) {
                        $k = Komdanas::where(['kode' => $presensi->status_komdanas])->first();
                        if ($k !== null) {
                            $presensi->keterangan = $k->keterangan;
                        }
                        $data[] = $presensi;
                        continue;
                    }
                    $presensi = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 2, 'tanggal' => $dt->format('Y-m-d')])->first();
                    if ($presensi !== null) {
                        $k = Komdanas::where(['kode' => $presensi->status_komdanas])->first();
                        $presensi->keterangan = "";
                        $stats = explode(",", $presensi->status_komdanas);
                        foreach ($stats as $s) {
                            $k = Komdanas::where(['kode' => rtrim($s, " ")])->first();
                            if ($k !== null) {
                                $presensi->keterangan .= $k->keterangan . ", ";
                            }
                        }
                        $presensi->keterangan = rtrim($presensi->keterangan, ", ");
                        $data[] = $presensi;
                        continue;
                    }
                    $presensi = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 1, 'tanggal' => $dt->format('Y-m-d')])->first();
                    if ($presensi !== null) {
                        $k = Komdanas::where(['kode' => $presensi->status_komdanas])->first();
                        $presensi->keterangan = "";
                        $stats = explode(",", $presensi->status_komdanas);
                        foreach ($stats as $s) {
                            $k = Komdanas::where(['kode' => rtrim($s, " ")])->first();
                            if ($k !== null) {
                                $presensi->keterangan .= $k->keterangan . ", ";
                            }
                        }
                        $presensi->keterangan = rtrim($presensi->keterangan, ", ");
                        $data[] = $presensi;
                        continue;
                    }
                }
            }

            $jab = Jabatan::where(['id' => $request->id])->first();
            if ($jab !== null) {
                $title = 'Jabatan : ' . $jab->nama_jabatan;
                $html = view($this->folder . '.cetak_perjabatan', compact('data', 'title', 'tanggal'))->render();
                $pdf = PDF::loadHTML($html)->setPaper('A4', 'potrait');
                return $pdf->stream();
            }
        }
    }

    public function cetak_perseorangan(Request $request)
    {
        if (isset($request->start) && isset($request->end) && isset($request->nip)) {

            $tanggal_start = $request->start;
            if ($tanggal_start === '') {
                $tanggal_start = date('d/m/Y');
            }
            $tanggal_end = $request->end;
            if ($tanggal_end === '') {
                $tanggal_end = date('d/m/Y');
            }
            if (strtotime($tanggal_end) < strtotime($tanggal_start)) {
                $tanggal_start = $tanggal_end;
            }
            $nip = $request->nip;
            $data = [];
            $pegawai = Pegawai::all();

            $start = DateTime::createFromFormat('d/m/Y', $tanggal_start);
            $end = DateTime::createFromFormat('d/m/Y', $tanggal_end);
            $interval = DateInterval::createFromDateString('1 day');
            $end->add($interval);
            $period = new DatePeriod($start, $interval, $end);

            foreach ($pegawai as $p) {
                if ($p->nipid() === $nip) {
                    foreach ($period as $dt) {
                        $presensi = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 3, 'tanggal' => $dt->format('Y-m-d')])->first();
                        if ($presensi !== null) {
                            $k = Komdanas::where(['kode' => $presensi->status_komdanas])->first();
                            if ($k !== null) {
                                $presensi->keterangan = $k->keterangan;
                            }
                            $data[] = $presensi;
                            continue;
                        }
                        $presensi = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 2, 'tanggal' => $dt->format('Y-m-d')])->first();
                        if ($presensi !== null) {
                            $k = Komdanas::where(['kode' => $presensi->status_komdanas])->first();
                            $presensi->keterangan = "";
                            $stats = explode(",", $presensi->status_komdanas);
                            foreach ($stats as $s) {
                                $k = Komdanas::where(['kode' => rtrim($s, " ")])->first();
                                if ($k !== null) {
                                    $presensi->keterangan .= $k->keterangan . ", ";
                                }
                            }
                            $presensi->keterangan = rtrim($presensi->keterangan, ", ");
                            $data[] = $presensi;
                            continue;
                        }
                        $presensi = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 1, 'tanggal' => $dt->format('Y-m-d')])->first();
                        if ($presensi !== null) {
                            $k = Komdanas::where(['kode' => $presensi->status_komdanas])->first();
                            $presensi->keterangan = "";
                            $stats = explode(",", $presensi->status_komdanas);
                            foreach ($stats as $s) {
                                $k = Komdanas::where(['kode' => rtrim($s, " ")])->first();
                                if ($k !== null) {
                                    $presensi->keterangan .= $k->keterangan . ", ";
                                }
                            }
                            $presensi->keterangan = rtrim($presensi->keterangan, ", ");
                            $data[] = $presensi;
                            continue;
                        }
                    }

                    $title = $p->nip . ' ' . $p->nama;

                    $html = view($this->folder . '.cetak_perseorangan', compact('data', 'title', 'tanggal_start', 'tanggal_end'))->render();
                    // dd($html);
                    $pdf = PDF::loadHTML($html)->setPaper('A4', 'potrait');
                    return $pdf->stream();
                }
            }
        }
    }

    public function cetak_semua(Request $request)
    {
        if (isset($request->tanggal) && isset($request->jenis)) {
            $tanggal = $request->tanggal;
            if ($tanggal === '') {
                $tanggal = date('d/m/Y');
            }
            $jenis = $request->jenis;
            if ($jenis === '') {
                $jenis = 1;
            }
            $data = Pegawai::all();
            $pegawai = [];
            foreach ($data as $key => $p) {
                $data[$key]->kehadiran = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 3, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
                if ($data[$key]->kehadiran !== null && $data[$key]->kehadiran->status_komdanas !== null && $data[$key]->kehadiran->status_komdanas !== "") {
                    $data[$key]->status = $data[$key]->kehadiran->status_komdanas;
                    $data[$key]->masuk = $data[$key]->kehadiran->jam_masuk;
                    $data[$key]->pulang = $data[$key]->kehadiran->jam_pulang;
                    $k = Komdanas::where(['kode' => $data[$key]->kehadiran->status_komdanas])->first();
                    if ($k !== null) {
                        $data[$key]->keterangan = $k->keterangan;
                    }
                    if ($jenis == 1) {
                        $pegawai[] = $data[$key];
                    }
                    continue;
                }
                $data[$key]->manual = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 2, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
                if ($data[$key]->manual !== null && $data[$key]->manual->status_komdanas !== null && $data[$key]->manual->status_komdanas !== "") {
                    $data[$key]->status = $data[$key]->manual->status_komdanas;
                    $data[$key]->masuk = $data[$key]->manual->jam_masuk;
                    $data[$key]->pulang = $data[$key]->manual->jam_pulang;
                    $data[$key]->keterangan = "";
                    $stats = explode(",", $data[$key]->manual->status_komdanas);
                    foreach ($stats as $s) {
                        $k = Komdanas::where(['kode' => rtrim($s, " ")])->first();
                        if ($k !== null) {
                            $data[$key]->keterangan .= $k->keterangan . ", ";
                        }
                    }
                    $data[$key]->keterangan = rtrim($data[$key]->keterangan, ", ");
                    if ($jenis == 1) {
                        $pegawai[] = $data[$key];
                    }
                    continue;
                }
                $data[$key]->finger = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 1, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
                if ($data[$key]->finger !== null && $data[$key]->finger->status_komdanas !== null && $data[$key]->finger->status_komdanas !== "") {
                    $data[$key]->status = $data[$key]->finger->status_komdanas;
                    $data[$key]->masuk = $data[$key]->finger->jam_masuk;
                    $data[$key]->pulang = $data[$key]->finger->jam_pulang;
                    $data[$key]->keterangan = "";
                    $stats = explode(",", $data[$key]->finger->status_komdanas);
                    foreach ($stats as $s) {
                        $k = Komdanas::where(['kode' => rtrim($s, " ")])->first();
                        if ($k !== null) {
                            $data[$key]->keterangan .= $k->keterangan . ", ";
                        }
                    }
                    $data[$key]->keterangan = rtrim($data[$key]->keterangan, ", ");
                    if ($jenis == 1) {
                        $pegawai[] = $data[$key];
                    }
                    continue;
                }
                $pegawai[] = $data[$key];
            }
            $title = 'Laporan Presensi - ' . ($jenis == 1 ? 'Semua' : ' Tidak Lengkap');

            $html = view($this->folder . '.cetak_semua', compact('pegawai', 'title', 'tanggal'))->render();
            // dd($html);
            $pdf = PDF::loadHTML($html)->setPaper('A4', 'potrait');
            return $pdf->stream();

        }
    }
}
