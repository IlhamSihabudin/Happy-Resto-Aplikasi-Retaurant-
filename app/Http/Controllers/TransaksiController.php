<?php

namespace App\Http\Controllers;

use App\DetailOrder;
use App\Meja;
use App\Order;
use App\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meja = Meja::where('status_meja', '1')->get();
        return view('pages.transaksi.index', ['meja'=>$meja]);
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
    public function store(Request $request, $idOrder)
    {
        if ($request->bayar < $request->total_bayar){
            return back()->with('message', '*Uang anda kurang');
        }

        $order = Order::where('id_order', $idOrder)->first();

        $transaksi = Transaksi::create([
            "id_user" => $order->id_user,
            "id_order" => $order->id_order,
            "tanggal" => date('Y-m-d H:i:s'),
            "total_bayar" => $request->total_bayar
        ]);

        $order->update([
            'status_order' => 'Sudah Bayar'
        ]);

        $meja = Meja::find($order->id_meja);
        $meja->update([
            'status_meja' => '0'
        ]);

        return redirect()->route('transaksi.struk', [$transaksi->id_transaksi, $request->bayar]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cari(Request $request)
    {
        $order = Order::where('id_meja', $request->id_meja)->first();
        return redirect()->route('transaksi.show_pesanan', $order->id_order);
    }

    public function show_pesanan($idOrder)
    {
        $order = Order::with('get_user', 'get_meja')->where('id_order', $idOrder)->first();
        $detail_order = $order->get_detail_order()->get();
        $total_bayar = $order->get_detail_order()->sum('total_harga');

        return view('pages.transaksi.show_pesanan', ['order'=>$order, 'detail_order'=>$detail_order, 'total_bayar'=>$total_bayar]);
    }

    public function struk($idTransaksi, $bayar)
    {
        $struk = Transaksi::with('get_order', 'get_user')->where('id_transaksi', $idTransaksi)->first();

        $meja = Meja::where('id_meja', $struk->get_order->id_meja)->first();

        $detail_order = DetailOrder::with('get_masakan')->where('id_order', $struk->id_order)->get();

        $total_bayar = DetailOrder::where('id_order', $struk->id_order)->sum('total_harga');

        $kembalian = $bayar - $total_bayar;
        return view('pages.transaksi.struk', ['struk'=> $struk, 'meja'=>$meja, 'detail_order'=> $detail_order, 'bayar' => $bayar, 'total_bayar' => $total_bayar, 'kembalian'=>$kembalian]);
    }
}
