@extends('layouts.master')
@section('title', 'Pelanggan')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <span class="h1">Menu Terbaru</span>
            </div>
            @foreach ($masakan as $item)
                <div class="col-sm-4 mt-4">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header"><span class="h4">{{ $item->nama_masakan }}</span></div>
                        <img src="{{ asset('assets/img/'.$item->gambar) }}" alt="" height="200" class="card-img-bottom">
                    </div>
                </div>
            @endforeach
            <div class="col-md-12 mt-4">
                <div class="card border-0 shadow-lg">
                    <video src="{{ asset('assets/video/restaurant.mp4') }}" class="card-img-top" controls></video>
                </div>
            </div>
        </div>
    </div>
@endsection
