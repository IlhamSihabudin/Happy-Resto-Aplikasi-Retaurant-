@extends('layouts.master')
@section('title', 'Waiter')

@section('content')
    <div class="container">
        @foreach($order as $value)
            <div class="row justify-content-center mt-3">
                <div class="col-md-12">
                    <div class="card border-0 shadow">
                        <div class="card-header bg-primary text-white">
                            <div class="row justify-content-between">
                                <div class="col-md-4 col-6 mt-2"><b>{{ $value->get_user->nama_user }}</b></div>
                                <div class="col-md-4 col-6 mt-2">No Meja <b>{{ $value->get_meja->no_meja }}</b></div>
                                <div class="col-md-3 col-12 mt-2">
                                    <a href="{{ route('waiter.batalkan', $value) }}" onclick="return confirm('Anda yakin akan membatalkan pesanan ini?')" class="btn btn-block btn-danger">Batalkan</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="datatables" class="table table-bordered table-hover table-striped">
                                            <thead>
                                            <tr>
                                                <th>Nama Masakan</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Keterangan</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($value->get_detail_order()->with('get_masakan')->get() as $item)
                                                <tr>
                                                    <td>{{ $item->get_masakan->nama_masakan }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>Rp. {{ $item->total_harga }}</td>
                                                    <td>{{ $item->keterangan }}</td>
                                                    <td align="center">
                                                        <div class="badge {{ $item->status_detail_order == 'Belum di Antar' ? ' badge-warning' : 'badge-success'}}">{{ $item->status_detail_order }}</div>
                                                    </td>
                                                    <td align="center">
                                                        @if($item->status_detail_order == "Belum di Antar")
                                                            <a href="{{ route('waiter.antar_masakan', $item) }}" class="btn btn-success" >Antar Masakan</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection