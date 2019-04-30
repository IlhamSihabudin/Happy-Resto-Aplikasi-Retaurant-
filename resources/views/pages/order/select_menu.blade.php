@extends('layouts.master')
@section('title', 'Pesan Masakan')

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
                        <span class="h4">Masakan</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <div class="table-responsive">
                                    <table id="datatables" class="table table-bordered table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>Nama Masakan</th>
                                            <th>Harga</th>
                                            <th>Jenis Masakan</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($masakan as $value)
                                            <tr>
                                                <td>{{ $value->nama_masakan}}</td>
                                                <td>Rp. {{ $value->harga }}</td>
                                                <td align="center">
                                                    <i style="font-size: 20pt" class="fa {{ $value->jenis_masakan == 'Makanan' ? 'fa-utensils text-success' : 'fa-wine-glass text-info' }}"></i>
                                                </td>
                                                <td align="center">
                                                    <a id="tambah" href="{{ route('api.masakan', $value) }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
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
            <div class="col-md-5 mt-4">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <span class="h4">Detail Pesanan</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('order.store_keranjang', $order->id_order) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <input type="hidden" id="id_masakan" name="id_masakan">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Nama Masakan</label>
                                        <input type="text" class="form-control" id="nama_masakan" name="nama_masakan" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Harga</label>
                                        <input type="number" class="form-control" id="harga" name="harga" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Jumlah</label>
                                        <input type="number" class="form-control" id="qty" name="qty" onkeyup="hitung_total()" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Total Harga</label>
                                        <input type="number" class="form-control" id="total_harga" name="total_harga" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">Tambah ke Keranjang</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <span class="h4">Keranjang</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="keranjang" class="table table-bordered table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>Nama Masakan</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($detail_order as $value)
                                            <tr>
                                                <td>{{ $value->get_masakan->nama_masakan }}</td>
                                                <td>{{ $value->qty }}</td>
                                                <td>Rp. {{ $value->total_harga }}</td>
                                                <td>{{ $value->keterangan }}</td>
                                                <td align="center">
                                                    <a href="{{ route('order.keranjang.destroy', $value) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group mt-3">
                                    <a href="{{ route('order.pesan_masakan', $order->id_order) }}" class="btn btn-primary btn-block">Pesan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js-script')
    <script>
        $(document).ready(function () {
            $('#datatables').dataTable({
                "info": false,
                "order": [[2, 'asc']]
            });
            $('#keranjang').dataTable({
                "info": false
            });
        });

        $('body').on('click', '#tambah', function () {
            event.preventDefault();

            $('#qty').val("");
            $('#total_harga').val("");

            $.getJSON($(this).attr('href'), function (response) {
                $('#id_masakan').val(response.data.id_masakan);
                $('#nama_masakan').val(response.data.nama_masakan);
                $('#harga').val(response.data.harga);
                $('#qty').focus();
            });
        });

        function hitung_total() {
            if ($('#qty').val() == "" || $('#qty').val() <= 0  || $('#harga').val() == ""){
                $('#qty').val("");
                $('#total_harga').val("");
            }else{
                var total = $('#qty').val() * $('#harga').val();
                $('#total_harga').val(total);
            }
        }
    </script>
@endpush