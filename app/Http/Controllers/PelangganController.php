<?php

namespace App\Http\Controllers;

use App\Masakan;
use App\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PelangganController extends Controller
{
    //Pelanggan
    public function index()
    {
        $meja = Meja::all();
        return view('pages.pelanggan.index', ['meja'=>$meja]);
    }

    public function pilih_meja(Request $request)
    {
        $meja = Meja::where('id_meja', $request->id_meja)->first();

        Session::put('id_meja', $meja->id_meja);
        return redirect()->route('pelanggan.dashboard', $meja->id_meja);
    }

    public function order($idMeja)
    {
        $meja = Meja::where('id_meja', $idMeja)->first();
        if (Meja::where('id_meja', $idMeja)->count() == 0){
            return redirect()->route('pelanggan.home')->with('message', 'Meja Tidak Tersedia');
        }
        return view('pages.pelanggan.pesan',['meja'=> $meja]);
    }

    public function dashboard($idMeja)
    {
        $meja = Meja::where('id_meja', $idMeja)->first();
        if (Meja::where('id_meja', $idMeja)->count() == 0){
            return redirect()->route('pelanggan.home')->with('message', 'Meja Tidak Tersedia');
        }
        $masakan = Masakan::latest()->paginate(3);
        return view('pages.pelanggan.dashboard',['meja'=> $meja, 'masakan'=>$masakan]);
    }
}
