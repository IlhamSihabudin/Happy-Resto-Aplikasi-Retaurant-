@extends('layouts.master')
@section('title', 'Admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg">
                    <img src="{{ asset('assets/img/bg_kasir.jpg') }}" class="card-img-top" alt="Restaurant" >
                    <div class="card-body text-center">
                        <span class="h3">Welcome <b>{{ Auth::user()->nama_user }}</b></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection