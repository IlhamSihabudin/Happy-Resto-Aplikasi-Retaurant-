@extends('layouts.master')
@section('title', 'Admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success">
                        <b>Success!! </b> {{ session('success') }}
                    </div>
                @endif
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <span class="h4">Masakan</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('masakan.create') }}" class="btn btn-primary col-md-2"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="table-responsive">
                                    <table id="datatables" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Masakan</th>
                                                <th>Harga</th>
                                                <th>Jenis Masakan</th>
                                                <th>Gambar</th>
                                                <th>Status Masakan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($masakan as $value)
                                                <tr>
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td>{{ $value->nama_masakan}}</td>
                                                    <td>Rp. {{ $value->harga }}</td>
                                                    <td align="center">
                                                        <i style="font-size: 20pt" class="fa {{ $value->jenis_masakan == 'Makanan' ? 'fa-utensils text-success' : 'fa-wine-glass text-info' }}"></i>
                                                    </td>
                                                    <td align="center">
                                                        <img src="{{ asset('assets/img').'/'.$value->gambar }}" alt="{{ $value->gambar }}" width="200">
                                                    </td>
                                                    <td align="center">
                                                        <div class="badge {{ $value->status_masakan == 'Tersedia' ? 'badge-success' : 'badge-danger'}}">{{ $value->status_masakan }}</div>
                                                    </td>
                                                    <td align="center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('masakan.edit', $value) }}" class="btn btn-success"><i class="fa fa-pencil-alt"></i></a>
                                                            <a href="{{ route('masakan.destroy', $value) }}" class="btn btn-danger" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></a>
                                                        </div>
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
        </div>
    </div>
@endsection

@push('js-script')
    <script>
        $(document).ready(function () {
            $('#datatables').dataTable({
                "info": false
            });
        })
    </script>
@endpush