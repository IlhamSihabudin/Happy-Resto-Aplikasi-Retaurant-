@extends('layouts.master')
@section('title', 'Admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <span class="h4">Tambah Meja</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('meja.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">No Meja</label>
                                        <input type="number" class="form-control" id="no_meja" name="no_meja" onkeyup="validate_meja()" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">Tambah</button>
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
        function validate_meja() {
            if ($('#no_meja').val() <= 0){
                $('#no_meja').val("");
            }
        }
    </script>
@endpush