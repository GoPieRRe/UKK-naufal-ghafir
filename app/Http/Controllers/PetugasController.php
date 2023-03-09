<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Petugas = Petugas::all();
        return view('Petugas.index', compact('Petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'nama_petugas' => 'required',
        ]);

        if ($request->password != $request->confirm_password) {
            return back()->with('error', 'konfirmasi password tidak sesuai');
        }
        $cek = Petugas::create([
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
            'nama_petugas' => $input['nama_petugas'],
        ]);

        if ($cek) {
            $user = User::create([
                'name' => $input['nama_petugas'],
                'username' => $input['username'],
                'password' => Hash::make($input['password']),
                'level' => 'petugas',
            ]);
            if ($user) {
                return redirect()->back()->with('success', 'data berhasil ditambah');
            }else{
                $petugas = Petugas::orderBy('id', 'DESC')->first();
                $petugas->delete();
                return redirect()->back()->with('error', 'data gagal ditambah');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $Petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $Petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $Petugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Petugas $Petugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $Petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'nama_petugas' => 'required',
        ]);

        if (Hash::make($request->confirm_password) != $Petugas->password) {
            return back()->with('error', 'konfirmasi password tidak sesuai');
        }
        

        $cek = $Petugas->update($request->all());
        
        if ($cek) {
            return redirect()->back()->with('success', 'data berhasil diubah');
        }else{
            return redirect()->back()->with('success', 'data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $Petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Petugas = Petugas::find($id);
        $user = User::where('username', $Petugas->username)->first();
        $cek = $Petugas->delete();
        if ($cek) {
            $user->delete();
            return redirect()->back()->with('success', 'data berhasil dihapus');
        }else{
            return redirect()->back()->with('success', 'data gagal dihapus');
        }
    }
}
