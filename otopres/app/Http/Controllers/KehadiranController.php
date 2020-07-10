<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Pegawai;
use App\Presensi;
use App\Komdanas;
use DateTime;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KehadiranController extends Controller
{
    private $folder = 'kehadiran';
    private $rules = [
        'tanggal_start' => 'required',
        'tanggal_end' => 'required',
        'status' => 'required',
        'nip' => 'required',
    ];

    public function index(Request $request)
    {
        $tanggal = date('d/m/Y');
        $data = [];
        if (isset($request->tanggal)) {
            $tanggal = $request->tanggal;
        }
        if ($tanggal === '') {
            $tanggal = date('d/m/Y');
        }
        $data = Pegawai::all();
        $pegawai = [];
        foreach ($data as $key => $p) {
            $data[$key]->finger = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 1, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
            $data[$key]->manual = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 2, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
            $data[$key]->kehadiran = Presensi::where(['nip_pegawai' => $p->nip, 'jenis' => 3, 'tanggal' => DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d')])->first();
            if (($data[$key]->finger !== null && strpos($data[$key]->finger->status_komdanas, 'v') !== false ) 
                || ($data[$key]->manual !== null && strpos( $data[$key]->manual->status_komdanas, 'v') !== false)) {
                continue;
            }
            if ($data[$key]->kehadiran !== null && $data[$key]->kehadiran->status_komdanas !== null && $data[$key]->kehadiran->status_komdanas !== "") {
                $k = Komdanas::where(['kode' => $data[$key]->kehadiran->status_komdanas])->first();
                if ($k !== null) {
                    $data[$key]->keterangan = $k->keterangan;
                }
            }
            $pegawai[] = $data[$key];
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
            if (($p = Presensi::where(['nip_pegawai' => $request->nip, 'jenis' => 3, 'tanggal' => DateTime::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d')])->first()) !== null) {
                $p->delete();
            }
        }
        return redirect($this->folder)->with(['success' => 'Berhasil diubah !']);
    }

    public function create(Request $request)
    {
        if (isset($request->nip) && isset($request->tanggal)) {
            $tanggal = $request->tanggal;
            $pegawai = Pegawai::findOrFail($request->nip);
            return view($this->folder . '.create', compact('tanggal', 'pegawai'));
        }
        return redirect($this->folder)->with(['error' => 'Data not found !']);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        $begin  =  DateTime::createFromFormat('d/m/Y', $request->tanggal_start);
        $end  =  DateTime::createFromFormat('d/m/Y', $request->tanggal_end);
        if($begin > $end) {
            $end = $begin;
        }
        $interval = DateInterval::createFromDateString('1 day');
        $end->add($interval);
        $period = new DatePeriod($begin, $interval, $end);
        $file_name = "";
        
        if (isset($request->file)) {
            $file_name = $request->file('file')->store('public');
        }
        foreach ($period as $dt) {
            $presensi = Presensi::where(['nip_pegawai' => $request->nip, 'jenis' => 3, 'tanggal' => $dt->format('Y-m-d')])->first();
            if($presensi === null) {
                $presensi = new Presensi;
                $presensi->tanggal = $dt->format('Y-m-d');                
            }            
            $presensi->jenis = 3;
            $presensi->nip_pegawai = $request->nip;
            $presensi->status_komdanas = $request->status;
            $presensi->file = $file_name;
            $presensi->save();
        }
        return redirect($this->folder)->with(['success' => 'Berhasil dibuat !']);
    }
}
