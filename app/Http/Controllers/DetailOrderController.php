<?php

namespace App\Http\Controllers;

use App\DetailOrder;
use App\Order;
use Illuminate\Http\Request;

class DetailOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $detail_order = DetailOrder::where('id_masakan', $request->id_masakan)->where('id_order', $idOrder)->first();
        if ($detail_order){
            $detail_order->qty += $request->qty;
            $detail_order->total_harga += $request->total_harga;
            if ($detail_order->keterangan == ""){
                $detail_order->keterangan = $request->keterangan;
            }else{
                $detail_order->keterangan = $detail_order->keterangan . ', ' .$request->keterangan;
            }
            $detail_order->update();
        }else{
            DetailOrder::create([
                'id_order' => $idOrder,
                'id_masakan' => $request->id_masakan,
                'qty' => $request->qty,
                'total_harga' => $request->total_harga,
                'keterangan' => $request->keterangan,
                'status_detail_order' => 'Belum Selesai'
            ]);
        }


        return redirect()->route('order.select_menu', $idOrder);
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
    public function destroy(DetailOrder $detailOrder)
    {
        $idOrder = $detailOrder->id_order;
        $detailOrder->delete();

        return redirect()->route('order.select_menu', $idOrder);
    }

    public function pesan($idOrder)
    {
        $order = DetailOrder::where('id_order', $idOrder)->get();

        foreach ($order as $value){
            $value->update(['status_detail_order' => 'Belum di Antar']);
        }

        return redirect()->route('order.list_pesanan', $idOrder);
    }

    public function list_pesanan($idOrder)
    {
        $order = Order::with('get_user')->where('id_order', $idOrder)->first();
        $detail_order = DetailOrder::with('get_masakan')->where('id_order', $idOrder)->get();
        return view('pages.order.list_pesanan', ['order'=>$order, 'detail_order'=>$detail_order]);
    }
}
