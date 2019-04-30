<?php

namespace App\Http\Controllers;

use App\DetailOrder;
use App\Meja;
use App\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    //Admin
    public function admin()
    {
        return view('pages.user_home.admin');
    }


    //Waiter
    public function waiter()
    {
        $order = Order::with('get_user', 'get_meja', 'get_detail_order')->where('status_order', 'Belum Bayar')->orderBy('created_at', 'asc')->get();
        return view('pages.user_home.waiter', ['order'=>$order]);
    }

    public function batalkan(Order $order)
    {
        $order->update(['status_order'=>'Dibatalkan']);

        $meja = Meja::where('id_meja', $order->id_meja)->first();
        $meja->update(['status_meja'=>'0']);

        return back();
    }

    public function antar_masakan(DetailOrder $detailOrder)
    {
        $detailOrder->update(['status_detail_order'=>'Sudah di Antar']);

        return back();
    }

    //Kasir
    public function kasir()
    {
        return view('pages.user_home.kasir');
    }

    //Owner
    public function Owner()
    {
        return view('pages.user_home.owner');
    }
}
