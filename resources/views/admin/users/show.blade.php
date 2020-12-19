@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">{{ __('User Details') }}
                <div class="pull-right">
                    <a href="{{ route('users.index') }}" class="btn btn-primary">
                        User List</a>

                </div>
            </div>
            <div class="card-body">
                <b>Name</b>: {{$user->name}} <br>
                <b>Email</b>: {{$user->email}}<br>
                <b> Role </b>: {{$user->role->name}}<br>
            </div>
        </div>
    </div>
@endsection
