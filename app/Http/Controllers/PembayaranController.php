<?php

namespace App\Http\Controllers;

use App\Models\{Pembayaran, Siswa, Petugas, Spp, Kelas, User};
use Illuminate\Http\Request;
use carbon\Carbon;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\PembayaranExport;
use Maatwebsite\Excel\Facades\Excel;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = siswa::all();
        $pembayaran = pembayaran::all();
        return view('Pembayaran.index', compact('siswa', 'pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::all();
        return view('Pembayaran.create', compact('siswa'));
    }

    public function getData($nisn, $berapa)
    {   
        $siswa = Siswa::where('nisn', '=', $nisn)->first();
        $spp = Spp::where('id', '=', $siswa->id_spp)->first();
        $pembayaran = Pembayaran::where('nisn', '=', $nisn)
            ->orderBy('id', 'Desc')->latest()
            ->first();


        if ($pembayaran == null) {
            $data = [
                'nominal' => $spp->nominal * $berapa,
                'bulan' => 'belum pernah bayar',
                'tahun' => '',
                'buln' => 'juli',
                'spp' => $spp->tahun,
            ];
        } else {
            if ($pembayaran->tahun_dibayar == substr($spp->tahun, -4, 4) && $pembayaran->bulan_dibayar == 'juni') {
                $data = [
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => 'sudah lunas',
                    'tahun' => '',
                    'created' => '',
                ];
            } else {
                $data = [
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => $pembayaran->bulan_dibayar,
                    'tahun' => $pembayaran->tahun_dibayar,
                    'created' => $pembayaran->created_at,
                ];
            }
        }

        return response()->json($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nisn' => 'required|numeric',
            'jumlah_bayar' => 'required|numeric',
        ]);

        for ($i = 0; $i < $request->bayar_berapa; $i++) {
            $bulan = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];

            $siswa = Siswa::where('nisn', '=', $request->nisn)->first();
            $spp = Spp::where('id', $siswa->id_spp)->first();
            $pembayaran = Pembayaran::where('nisn', '=', $siswa->nisn)->get();

            if ($pembayaran->isEmpty()) {
                $bln = 6;
                $tahun = substr($spp->tahun, 0, 4);
            } else {
                $pembayaran = Pembayaran::where('nisn', '=', $siswa->nisn)
                    ->orderBy('id', 'Desc')->latest()
                    ->first();

                $bln = array_search($pembayaran->bulan_dibayar, $bulan);

                if ($bln == 11) {
                    $bln = 0;
                    $tahun = $pembayaran->tahun_dibayar + 1;
                } else {
                    $bln = $bln + 1;
                    $tahun = $pembayaran->tahun_dibayar;
                }
                if ($pembayaran->tahun_dibayar == substr($spp->tahun, -4, 4)+3 && $pembayaran->bulan_dibayar == 'juni') {
                    return back()->with('error', 'Pembayaran '.$siswa->nama.' sudah lunas');
                }
            }

            if ($request->jumlah_bayar < $spp->nominal) {
                return back()->with('error', 'Uang yang dimasukan tidak sesuai');
            }

            $pembayaranSimpan = Pembayaran::create([
                'id_petugas' => auth()->user()->id,
                'nisn' => $request->nisn,
                'tgl_bayar' => Carbon::now()->timezone('asia/jakarta'),
                'bulan_dibayar' => $bulan[$bln],
                'tahun_dibayar' => $tahun,
                'id_spp' => $spp->id,
                'jumlah_bayar' => $spp->nominal
            ]);
        }

        if ($pembayaranSimpan) {
            return redirect()->route('Pembayaran.struk', $request);
        } else {
            return redirect()->back()->with('error', 'data gagal masuk');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function struk(Request $request)
    {
        $siswa = Siswa::where('nisn', $request->nisn)->first();
        $bayar = Pembayaran::where('nisn', $request->nisn)->where('bulan_dibayar', $request->bulans)->where('tahun_dibayar', $request->tahuns)->where('created_at', $request->created)->first();
        if ($bayar == null) {
            $bayars = Pembayaran::where('nisn', $request->nisn)->where('bulan_dibayar', $request->blns)->where('tahun_dibayar', $request->spps)->first();
            $start_at = $bayars->created_at;
        }else{
            $start_at = $bayar->created_at;
        }
        $bayar2 = Pembayaran::where('nisn', $request->nisn)->orderBy('id', 'DESC')->latest()->first();
        $end_at = $bayar2->created_at;

        $total = $request->total_bayar;
        $jumlah = $request->jumlah_bayar;
        $kembali = $request->kembalian;

        $pembayaran = Pembayaran::whereBetween('created_at', [$start_at, $end_at])->get();

        $pdf = PDF::loadView('Pembayaran.struk',compact('pembayaran', 'siswa', 'total', 'kembali', 'jumlah'));
        $name = 'Struk Pembayaran spp ' . date('Y-m-d',time());
        return $pdf->download($name.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);

        $hapus = $pembayaran->delete();

        if ($hapus) {
            return redirect()->route('Pembayaran.index')->with('success', 'Data berhasil dihapus');
        }
    }

    public function riwayat()
    {
        if (auth()->user()->level == "siswa") {
            $id = auth()->user()->username;
            $siswa = Siswa::where('nis', $id)->first();
            $bulan = Pembayaran::where('nisn', $siswa->nisn)->orderBy('id', 'DESC')->latest()->first();
            $pembayaran = Pembayaran::where('nisn', $siswa->nisn)->orderBy('id', 'DESC')->latest()->get();
            return view('Pembayaran.history', compact('bulan', 'pembayaran'));
        }else{
            $pembayaran = Pembayaran::orderBy('id', 'DESC')->latest()->get();
            return view('Pembayaran.history', compact('pembayaran'));
        }
    }

    public function export_excel()
    {
        $nama = time(). ' spp';
        return Excel::download(new PembayaranExport, $nama . '.xlsx');
    }
}
