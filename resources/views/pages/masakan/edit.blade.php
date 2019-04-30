@extends('layouts.master')
@section('title', 'Admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <span class="h4">Ubah Masakan</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('masakan.update', $data) }}">
                            @csrf @method('patch')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Nama Masakan</label>
                                        <input type="text" class="form-control" name="nama_masakan" value="{{ $data->nama_masakan }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Harga</label>
                                        <input type="number" class="form-control" name="harga" id="harga" required onkeyup="validate_harga()" value="{{ $data->harga }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Jenis Masakan</label>
                                        <select class="form-control" name="jenis_masakan" required>
                                            <option value="" selected disabled>Pilih Salah Satu</option>
                                            <option value="Makanan" {{ $data->jenis_masakan == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                            <option value="Minuman" {{ $data->jenis_masakan == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Status Masakan</label>
                                        <select class="form-control" name="status_masakan" required>
                                            <option value="" selected disabled>Pilih Salah Satu</option>
                                            <option value="Tersedia" {{ $data->status_masakan == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="Tidak Tersedia" {{ $data->status_masakan == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                                        </select>
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