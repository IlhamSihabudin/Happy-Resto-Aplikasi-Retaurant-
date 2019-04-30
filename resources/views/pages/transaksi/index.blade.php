@extends('layouts.master')
@section('title', 'Transaksi')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <form action="{{ route('transaksi.cari') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">No Meja</label>
                                        <select name="id_meja" id="id_meja" class="form-control">
                                            <option value="" selected disabled>Pilih Salah Satu</option>
                                            @foreach($meja as $value)
                                                <option value="{{ $value->id_meja }}">{{ $value->no_meja }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">Cari</button>
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