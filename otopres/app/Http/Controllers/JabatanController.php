<?php
;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Jabatan;

class JabatanController extends Controller
{
    private $folder = 'jabatan';
    private $rules = [
        'nama_jabatan' => 'required',
    ];
    public function index()
    {
        $data = Jabatan::all();
        return view($this->folder . '.index', compact('data'));
    }

    public function create()
    {
        return view($this->folder . '.create');
    }
    
    public function store(Request $request)
    {
      $this->validate($request,$this->rules);
      $data = new Jabatan;
      $data->nama_jabatan = $request->nama_jabatan;
      $data->save();
      return redirect($this->folder)->with(['success' => 'Berhasil dibuat !']);
    }
    
    public function edit(Request $request)
    {
      $data = Jabatan::findOrFail($request->get('id'));
      return view($this->folder.'.edit',compact('data'));
    }

    public function update(Request $request)
    {
      $this->validate($request,$this->rules);
      $data = Jabatan::findOrFail($request->get('id'));
      $data->nama_jabatan = $request->nama_jabatan;
      $data->save();
      return redirect($this->folder)->with(['success' => 'Berhasil dibuat !']);
    }
    
    public function destroy(Request $request)
    {
      $data = Jabatan::findOrFail($request->get('id'))->delete();
      return redirect($this->folder)->with(['success' => 'Berhasil diubah !']);
    }

}
