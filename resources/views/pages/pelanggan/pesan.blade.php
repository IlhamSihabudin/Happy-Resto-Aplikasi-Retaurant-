@extends('layouts.master')
@section('title', 'Pelanggan')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <form action="{{ route('order.pesan') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <h2><span class="text-primary">Selamat</span> Datang</h2>
                                        <h3>di Happy<b class="text-primary">Resto</b></h3>
                                    </div>
                                    <div class="form-group">
                                        <div class="h4">No Meja <span class="h3"><b>{{ $meja->no_meja }}</b></span></div>
                                    </div>
                                    <input type="hidden" value="{{ $meja->id_meja }}" name="id_meja">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Atas Nama</label>
                                        <input type="text" class="form-control" name="nama_user">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Keterangan</label>
                                        <textarea name="keterangan" id="" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">Pesan</button>
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