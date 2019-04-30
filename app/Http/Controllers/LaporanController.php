<?php

namespace App\Http\Controllers;

use App\Order;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = date('Y');
        $report_year = DB::table('transaksis')->where(DB::raw('YEAR(tanggal)'), $tahun)->sum('total_bayar');
        for ($i=1;$i<=12;$i++){
            $report_month[$i] = DB::table('transaksis')->where(DB::raw('YEAR(tanggal)'), $tahun)->where(DB::raw('MONTH(tanggal)'), $i)->sum('total_bayar');
        }
        $month_name = ['Januari', 'Februari', 'Maret', 'April', 'May', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('pages.laporan.index', ['tahun'=>$tahun, 'report_year'=>$report_year, 'report_month'=>$report_month, 'month_name'=>$month_name]);
    }

    public function filter_year($tahun)
    {
        $report_year = DB::table('transaksis')->where(DB::raw('YEAR(tanggal)'), $tahun)->sum('total_bayar');
        for ($i=1;$i<=12;$i++){
            $report_month[$i] = DB::table('transaksis')->where(DB::raw('YEAR(tanggal)'), $tahun)->where(DB::raw('MONTH(tanggal)'), $i)->sum('total_bayar');
        }
        $month_name = ['Januari', 'Februari', 'Maret', 'April', 'May', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('pages.laporan.report_selected', ['tahun'=>$tahun, 'report_year'=>$report_year, 'report_month'=>$report_month, 'month_name'=>$month_name]);
    }

    //Pertanggal
    public function pertanggal()
    {
        return view('pages.laporan.pertanggal');
    }

    public function store_pertanggal($tglAwal, $tglAkhir)
    {
        $order = DB::table('orders')
            ->whereBetween('orders.tanggal', [$tglAwal, $tglAkhir])
            ->join('mejas', 'orders.id_meja', '=', 'mejas.id_meja')
            ->join('users', 'orders.id_user', '=', 'users.id_user')
            ->join('transaksis', 'orders.id_order', 'transaksis.id_order')
            ->get();

        return view('pages.laporan.report_pertanggal', ['order'=> $order, 'tglAwal'=>$tglAwal, 'tglAkhir'=>$tglAkhir]);
    }

    //Laporan Transaksi
    public function show_transaksi()
    {
        $order=Order::with('get_user', 'get_meja', 'get_detail_order', 'get_transaksi')->where('status_order', 'Sudah Bayar ')->get();

        return view('pages.laporan.report_transaksi', ['order'=>$order]);
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
}
