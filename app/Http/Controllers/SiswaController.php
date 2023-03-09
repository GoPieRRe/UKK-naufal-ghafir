<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Siswa = Siswa::all();
        $Kelas = Kelas::all();
        $Spp = Spp::all();
        return view('Siswa.index', compact('Siswa', 'Spp', 'Kelas'));
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
        $request->validate([
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'id_kelas' => 'required',
            'no_telp' => 'required',
            'id_spp' => 'required',
        ]);
        $siswa = Siswa::where('nisn', $request->nisn)->first();

        if ($siswa) {
            return back()->with('error', 'nisn sudah ada');
        }

        $cek = Siswa::create($request->all());

        switch ($cek) {
            case true:
                $user = User::create([
                    'name' => $request->nama,
                    'username' => $request->nis,
                    'password' => Hash::make($request->nis),
                    'level' => 'siswa',
                ]);

                if ($user) {
                    return redirect()->back()->with('success', 'data berhasil ditambah');
                }else{
                    $siswa = Siswa::where('nis', $request->nis)->first();
                    $siswa->delete();
                    return redirect()->back()->with('error', 'data gagal ditambah');
                }
                break;
            
            default:
                
            return redirect()->back()->with('error', 'data gagal ditambah');
                break;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $Siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $Siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $Siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $Siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $Siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'nama_Siswa' => 'required',
            'kompetensi_keahlian' => 'required',
        ]);
        $Siswa = Siswa::find($id);

        $cek = $Siswa->update($request->all());
        
        if ($cek) {
            return redirect()->back()->with('success', 'data berhasil diubah');
        }else{
            return redirect()->back()->with('success', 'data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $Siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);

        $cek = $pembayaran->delete();

        if ($cek) {
            return redirect()->back()->with('success', 'data berhasil dihapus');
        }else{
            return redirect()->back()->with('error', 'data gagal dihapus');
        }
    }
}
