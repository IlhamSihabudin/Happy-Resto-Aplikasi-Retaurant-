@extends('layouts.master')
@section('title', 'Admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <span class="h4">Ubah No Meja</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('meja.update', $data) }}">
                            @csrf @method('patch')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">No Meja</label>
                                        <input type="text" class="form-control" name="no_meja" value="{{ $data->no_meja }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">Update</button>
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
        function validate_harga() {
            if ($('#harga').val() <= 0){
                $('#harga').val("");
            }
        }
    </script>
@endpush