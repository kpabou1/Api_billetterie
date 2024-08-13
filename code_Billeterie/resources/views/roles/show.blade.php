@extends('layouts.app')

@section('title', __('User Details'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('User Details')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" >{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{__('Users')}}</a></li>
                    <li class="breadcrumb-item active">{{__('User Details')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $user->firstname }} {{ $user->lastname }}</h5>
        <p class="card-text">
            <strong>{{ __('Telephone') }}:</strong> {{ $user->telephone }}<br>
            <strong>{{ __('Sexe') }}:</strong> {{ $user->sexe }}<br>
            <strong>{{ __('Date of Birth') }}:</strong> {{ $user->datenaiss }}<br>
            <strong>{{ __('Email') }}:</strong> {{ $user->email }}<br>
            <strong>{{ __('Avatar') }}:</strong> {{ $user->avatar }}<br>
            <strong>{{ __('Username') }}:</strong> {{ $user->username }}<br>
            <strong>{{ __('Created At') }}:</strong> {{ $user->created_at }}
        </p>

        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-warning">{{ __('Edit User') }}</a>

        <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">{{ __('Delete User') }}</button>
        </form>
    </div>
</div>

@endsection
