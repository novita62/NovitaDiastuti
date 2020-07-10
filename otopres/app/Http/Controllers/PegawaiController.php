<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;

class PegawaiController extends Controller
{
    
    private $folder = 'pegawai';
    private $rules = [
        'nip' => 'required',
        'id_jabatan' => 'required',
        'nama_file' => 'required',
       // 'id_pangkat' => 'required',
        'nama' => 'required',
        'jam_masuk' => 'required',
        'jam_pulang' => 'required',
    ];
    
    public function index()
    {
        $data = Pegawai::all();
        return view($this->folder . '.index', compact('data'));
    }

    public function create()
    {
        return view($this->folder . '.create');
    }
    
    public function store(Request $request)
    {
      $this->validate($request,$this->rules);
      $data = new Pegawai;
      $data->nip = $request->nip;
      $data->id_jabatan = $request->id_jabatan;
      $data->id_pangkat = $request->id_pangkat;
      $data->nama_file = $request->nama_file;
      $data->nama = $request->nama;
      $data->jam_masuk = $request->jam_masuk;
      $data->jam_pulang = $request->jam_pulang;
      $data->save();
      return redirect($this->folder)->with(['success' => 'Berhasil dibuat !']);
    }
    
    public function edit(Request $request)
    {
      $data = Pegawai::findOrFail($request->get('nip'));
      return view($this->folder.'.edit',compact('data'));
    }

    public function update(Request $request)
    {
      $this->validate($request,$this->rules);
      $data = Pegawai::findOrFail($request->get('nip'));
      $data->nip = $request->nip;
      $data->id_jabatan = $request->id_jabatan;
      $data->id_pangkat = $request->id_pangkat;
      $data->nama_file = $request->nama_file;
      $data->nama = $request->nama;
      $data->jam_masuk = $request->jam_masuk;
      $data->jam_pulang = $request->jam_pulang;
      $data->save();
      return redirect($this->folder)->with(['success' => 'Berhasil dibuat !']);
    }
    
    public function destroy(Request $request)
    {
      $data = Pegawai::findOrFail($request->get('nip'))->delete();
      return redirect($this->folder)->with(['success' => 'Berhasil diubah !']);
    }
}
