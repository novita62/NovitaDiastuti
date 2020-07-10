<?php

namespace App\Http\Controllers;

use App\Komdanas;
use Illuminate\Http\Request;

class KomdanasController extends Controller
{
    private $folder = 'komdanas';
    private $rules = [
        'kode' => 'required',
        'keterangan' => 'required',
       // 'deskripsi' => 'required',
    ];

    public function index()
    {
        $data = Komdanas::all();
        return view($this->folder . '.index', compact('data'));
    }

    public function create()
    {
        return view($this->folder . '.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        $data = new Komdanas;
        $data->kode = $request->kode;
        $data->keterangan = $request->keterangan;
        $data->deskripsi = $request->deskripsi;
        $data->save();
        return redirect($this->folder)->with(['success' => 'Berhasil dibuat !']);
    }

    public function edit(Request $request)
    {
        $data = Komdanas::findOrFail($request->get('kode'));
        return view($this->folder . '.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, $this->rules);
        $data = Komdanas::findOrFail($request->get('kode'));
        $data->keterangan = $request->keterangan;
        $data->deskripsi = $request->deskripsi;
        $data->save();
        return redirect($this->folder)->with(['success' => 'Berhasil dibuat !']);
    }

    public function destroy(Request $request)
    {
        $data = Komdanas::findOrFail($request->get('kode'))->delete();
        return redirect($this->folder)->with(['success' => 'Berhasil diubah !']);
    }
}
