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
                        <span class="h4">User</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('user.create') }}" class="btn btn-primary col-md-2"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="table-responsive">
                                    <table id="datatables" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Full Name</th>
                                                <th>Username</th>
                                                <th>Level</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user as $value)
                                                <tr>
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td>{{ $value->nama_user }}</td>
                                                    <td>{{ $value->username }}</td>
                                                    <td>{{ $value->get_level->nama_level }}</td>
                                                    <td align="center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('user.edit', $value) }}" class="btn btn-success"><i class="fa fa-pencil-alt"></i></a>
                                                            <a href="{{ route('user.change_password', $value) }}" class="btn btn-warning"><i class="fa fa-key"></i></a>
                                                            <a href="{{ route('user.destroy', $value) }}" class="btn btn-danger" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></a>
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