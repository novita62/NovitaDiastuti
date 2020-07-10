<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    private $folder = 'admin';

    private $rules = [
        'username' => 'required',
        'password' => 'required',
        'nama' => 'required',
        'role' => 'required',
    ];

    private $rules_update = [
        'username' => 'required',
        'nama' => 'required',
        'role' => 'required',
    ];

    public function index()
    {
        $data = Admin::all();
        return view($this->folder . '.index', compact('data'));
    }

    public function create()
    {
        return view($this->folder . '.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        $data = new Admin;
        $data->username = $request->username;
        $data->password = bcrypt($request->password);
        $data->nama = $request->nama;
        $data->role = $request->role;
        $data->remember_token = Str::random(10);
        $data->save();
        return redirect($this->folder)->with(['success' => 'Berhasil dibuat !']);
    }

    public function edit(Request $request)
    {
        $data = Admin::findOrFail($request->get('username'));
        $data->password = "";
        return view($this->folder . '.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, $this->rules_update);
        $data = Admin::findOrFail($request->get('username'));
        $oldp = $data->password;
        if ($request->password !== '') {
            $data->password = Hash::check($request->password, $data->password) ? $data->password : bcrypt($request->password);
        }
        $data->nama = $request->nama;
        $data->role = $request->role;
        $data->remember_token = Str::random(10);
        $data->save();
        return redirect($this->folder)->with(['success' => 'Berhasil dibuat !']);
    }

    public function destroy(Request $request)
    {
        $data = Admin::findOrFail($request->get('username'))->delete();
        return redirect($this->folder)->with(['success' => 'Berhasil diubah !']);
    }
}
