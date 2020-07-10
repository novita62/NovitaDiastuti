<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Pangkat;


class PangkatController extends Controller
{
    
    private $folder = 'pangkat';
    private $rules = [
        'nama_pangkat' => 'required',
    ];
    public function index()
    {
        $data = Pangkat::all();
        return view($this->folder . '.index', compact('data'));
    }

    public function create()
    {
        return view($this->folder . '.create');
    }
    
    public function store(Request $request)
    {
      $this->validate($request,$this->rules);
      $data = new Pangkat;
      $data->nama_pangkat = $request->nama_pangkat;
      $data->save();
      return redirect($this->folder)->with(['success' => 'Berhasil dibuat !']);
    }
    
    public function edit(Request $request)
    {
      $data = Pangkat::findOrFail($request->get('id'));
      return view($this->folder.'.edit',compact('data'));
    }

    public function update(Request $request)
    {
      $this->validate($request,$this->rules);
      $data = Pangkat::findOrFail($request->get('id'));
      $data->nama_pangkat = $request->nama_pangkat;
      $data->save();
      return redirect($this->folder)->with(['success' => 'Berhasil dibuat !']);
    }
    
    public function destroy(Request $request)
    {
      $data = Pangkat::findOrFail($request->get('id'))->delete();
      return redirect($this->folder)->with(['success' => 'Berhasil diubah !']);
    }

}
