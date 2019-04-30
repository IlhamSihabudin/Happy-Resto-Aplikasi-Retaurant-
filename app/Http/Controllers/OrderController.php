<?php

namespace App\Http\Controllers;

use App\DetailOrder;
use App\Masakan;
use App\Meja;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meja = Meja::where('status_meja', '0')->get();
        return view('pages.order.index', ['meja'=> $meja]);
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
        //
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

    public function order(Request $request)
    {
        $user = User::firstOrCreate(
            ['username'=> $request->nama_user],
            ['nama_user'=> $request->nama_user, 'id_level'=>'5']
        );

        $order = Order::create([
            'id_meja' => $request->id_meja,
            'id_user' => $user->id_user,
            'tanggal' => date('Y-m-d H:i:s'),
            'keterangan' => $request->keterangan,
            'status_order' => 'Belum Bayar'
        ]);

        return redirect()->route('order.select_menu', $order->id_order);
    }

    public function select_menu($idOrder)
    {
        $order = Order::with('get_user', 'get_meja')->where('id_order', $idOrder)->first();
        $masakan = Masakan::where('status_masakan', 'Tersedia')->get();

        $detail_order = DetailOrder::with('get_masakan')->where('id_order', $idOrder)->get();

        return view('pages.order.select_menu', ['order'=>$order, 'masakan'=>$masakan, 'detail_order'=>$detail_order]);
    }
}
