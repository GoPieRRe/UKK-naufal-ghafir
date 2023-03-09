<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Spp = Spp::all();
        return view('Spp.index', compact('Spp'));
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
            'nominal' => 'required',
            'tahun' => 'required',
        ]);

        $cek = Spp::create($request->all());

        if ($cek) {
            return redirect()->back()->with('success', 'data berhasil ditambah');
        }else{
            return redirect()->back()->with('error', 'data gagal ditambah');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spp  $Spp
     * @return \Illuminate\Http\Response
     */
    public function show(Spp $Spp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spp  $Spp
     * @return \Illuminate\Http\Response
     */
    public function edit(Spp $Spp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spp  $Spp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'nominal' => 'required',
            'tahun' => 'required',
        ]);
        $Spp = Spp::find($id);

        $cek = $Spp->update($request->all());
        
        if ($cek) {
            return redirect()->back()->with('success', 'data berhasil diubah');
        }else{
            return redirect()->back()->with('success', 'data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spp  $Spp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Spp = Spp::find($id);

        $cek = $Spp->delete();

        if ($cek) {
            return redirect()->back()->with('success', 'data berhasil dihapus');
        }else{
            return redirect()->back()->with('success', 'data gagal dihapus');
        }
    }
}
