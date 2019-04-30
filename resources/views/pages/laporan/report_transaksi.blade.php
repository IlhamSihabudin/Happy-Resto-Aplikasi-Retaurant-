@extends('layouts.master')
@section('title', 'Waiter')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <span class="h4">Laporan Transaksi</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id Order</th>
                                    <th>Nama User</th>
                                    <th>No Meja</th>
                                    <th>Nama Masakan</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Total Bayar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order as $value)
                                    <tr>
                                        <td rowspan="{{ count($value->get_detail_order()->get()) }}">{{ $value->id_order }}</td>
                                        <td rowspan="{{ count($value->get_detail_order()->get()) }}">{{ $value->get_user->nama_user }}</td>
                                        <td rowspan="{{ count($value->get_detail_order()->get()) }}">{{ $value->get_meja->no_meja }}</td>
                                        <td>{{ $value->get_detail_order()->with('get_masakan')->first()->get_masakan->nama_masakan }}</td>
                                        <td>{{ $value->get_detail_order()->with('get_masakan')->first()->qty }}</td>
                                        <td>Rp. {{ $value->get_detail_order()->with('get_masakan')->first()->total_harga }}</td>
                                        <td rowspan="{{ count($value->get_detail_order()->get()) }}">Rp. {{ $value->get_transaksi()->first()->total_bayar }}</td>
                                    </tr>
                                    @foreach($value->get_detail_order()->with('get_masakan')->get() as $item)
                                        @if($loop->index+1 == 1)
                                        @else
                                            <tr>
                                                <td>{{ $item->get_masakan->nama_masakan }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>Rp. {{ $item->total_harga }}</td>
                                            </tr>
                                        @endif

                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection