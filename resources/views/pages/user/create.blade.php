@extends('layouts.master')
@section('title', 'Admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <span class="h4">Tambah User</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.store') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="nama_user" class="form-control-label">{{ __('Full Name') }}</label>
                                    <input id="nama_user" type="text" class="form-control{{ $errors->has('nama_user') ? ' is-invalid' : '' }}" name="nama_user" value="{{ old('nama_user') }}" required autofocus>

                                    @if ($errors->has('nama_user'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nama_user') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="username" class="form-control-label">{{ __('Username') }}</label>

                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="password" class="form-control-label ">{{ __('Password') }}</label>

                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="password-confirm" class="form-control-label">{{ __('Confirm Password') }}</label>

                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="id_level" class="form-control-label">{{ __('Level') }}</label>

                                    <select id="id_level" class="form-control" name="id_level" required>
                                        <option value="" selected disabled>Choose One</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Waiter</option>
                                        <option value="3">Kasir</option>
                                        <option value="4">Owner</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Tambah') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection