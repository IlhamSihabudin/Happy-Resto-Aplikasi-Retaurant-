@extends('layouts.master')
@section('title', 'Pesan Masakan')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if(session('success'))
                    <div class="alert alert-success">
                        <b>Success!! </b> {{ session('success') }}
                    </div>
                @endif
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <form action="{{ route('order.pesan') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">No Meja</label>
                                        <select name="id_meja" class="form-control" required>
                                            <option value="" selected disabled>Pilih Salah Satu</option>
                                            @foreach($meja as $value)
                                                <option value="{{ $value->id_meja }}">{{ $value->no_meja }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Atas Nama</label>
                                        <input type="text" name="nama_user" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Keterangan</label>
                                        <textarea name="keterangan" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">Order</button>
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