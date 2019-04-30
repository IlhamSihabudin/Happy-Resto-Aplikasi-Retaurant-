@extends('layouts.master_pelanggan')
@section('title', 'Pelanggan')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-4">
                @if(session('message'))
                    <div class="alert alert-danger">
                        <b>Warning!! </b> {{ session('message') }}
                    </div>
                @endif
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <form action="{{ route('pelanggan.pilih_meja') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">No Meja</label>
                                        <select name="id_meja" class="form-control" required>
                                            <option value="" disabled selected>Pilih Salah Satu</option>
                                            @foreach($meja as $value)
                                                <option value="{{ $value->id_meja }}">{{ $value->no_meja }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">Pilih</button>
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