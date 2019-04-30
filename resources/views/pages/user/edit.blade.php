@extends('layouts.master')
@section('title', 'Admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <span class="h4">Edit User</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', $user) }}">
                            @csrf @method('patch')

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="nama_user" class="form-control-label">{{ __('Full Name') }}</label>
                                    <input id="nama_user" type="text" class="form-control{{ $errors->has('nama_user') ? ' is-invalid' : '' }}" name="nama_user" value="{{ $user->nama_user }}" required autofocus>

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

                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $user->username }}" required>

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="id_level" class="form-control-label">{{ __('Level') }}</label>

                                    <select id="id_level" class="form-control" name="id_level" required>
                                        <option value="" selected disabled>Choose One</option>
                                        @foreach($level as $value)
                                            @if($value->id_level != 5)
                                                <option value="{{ $value->id_level }}" {{ $user->id_level == $value->id_level ? ' selected' : '' }}>{{ $value->nama_level }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Update') }}
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