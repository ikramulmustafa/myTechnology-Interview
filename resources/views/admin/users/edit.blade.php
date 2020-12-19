@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">{{ __('Create User') }}
                <div class="pull-right">
                    <a href="{{ route('users.index') }}" class="btn btn-primary">
                        User List</a>

                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('users.update',$user->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{(old('name')) ?(old('name')) : $user->name}}" required
                                   autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                               class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{(old('email')) ?(old('email')) : $user->email}}" required
                                   readonly autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role-select"
                               class="col-md-4 col-form-label text-md-right">{{ __('Select Role') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" id="role_id" name="role_id" required>
                                @foreach($roles as $role)
                                    <option
                                        {{($role->id == $user->role_id) ?"selected" : ''}} value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
