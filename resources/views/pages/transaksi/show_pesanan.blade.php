@extends('layouts.master')
@section('title', 'Transaksi')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <b>{{ $order->get_user->nama_user }}</b>
                            </div>
                            <div class="col-6 text-right">
                                No Meja <b>{{ $order->get_meja->no_meja }}</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 mt-4">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <span class="h4">List Pesanan</span>
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
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($detail_order as $value)
                                            <tr>
                                                <td>{{ $value->get_masakan->nama_masakan }}</td>
                                                <td>{{ $value->qty }}</td>
                                                <td>Rp. {{ $value->total_harga }}</td>
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
            <div class="col-md-5 mt-4">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <span class="h4">Kasir</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transaksi.store', $order->id_order) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Total Bayar</label>
                                        <input type="number" class="form-control" name="total_bayar" id="total_bayar" value="{{ $total_bayar }}" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Bayar</label>
                                        <input type="number" class="form-control" name="bayar" id="bayar" onkeyup="hitung_total()" required>
                                    </div>
                                    <div class="form-group" id="form_kembalian" style="display: none">
                                        <label for="" class="form-control-label">Kembalian</label>
                                        <input type="number" class="form-control" name="kembalian" id="kembalian" readonly>
                                    </div>
                                    @if(session('message'))
                                        <div class="form-group">
                                            <label for="" class="form-control-label text-danger">*Uang anda kurang</label>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">Transaksi</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js-script')
    <script>
        //Error
        function hitung_total() {
            if ($('#bayar').val() <= '0' || $('#bayar').val() == ""){
                $('#bayar').val("");
            }else{
                if (parseInt($('#bayar').val()) > parseInt($('#total_bayar').val())){
                    var kembalian = $('#bayar').val() - $('#total_bayar').val();
                    $('#kembalian').val(kembalian);
                    $('#form_kembalian').fadeIn('fast');
                }else{
                    $('#kembalian').val(kembalian);
                    $('#form_kembalian').fadeOut('fast');
                }
            }
        }
    </script>
@endpush