@extends('layouts.app')

@section('title', __('User Details'))

@section('content')
<!-- Start page title -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="text-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('users.index') }}" class="text-primary">Users</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('User Details') }}</li>
    </ol>
</nav>
<!-- End page title -->

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4 class="mb-3">{{ __('User Information') }}</h4>
                <hr>
                <div class="mb-3">
                    <strong>{{ __('First Name') }}:</strong>
                    <span>{{ $user->firstname }}</span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('Last Name') }}:</strong>
                    <span>{{ $user->lastname }}</span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('Date of Birth') }}:</strong>
                    <span>{{ $user->datenaiss }}</span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('Place of Birth') }}:</strong>
                    <span>{{ $user->lieu_naissance }}</span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('Gender') }}:</strong>
                    <span>{{ ucfirst($user->sexe) }}</span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('Email') }}:</strong>
                    <span>{{ $user->email }}</span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('Telephone') }}:</strong>
                    <span>{{ $user->telephone }}</span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('Username') }}:</strong>
                    <span>{{ $user->username }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="mb-3">{{ __('Role Information') }}</h4>
                <hr>
                <div class="mb-3">
                    <strong>{{ __('Roles') }}:</strong>
                    <span>
                        @foreach ($user->roles as $role)
                        <span class="badge badge-info">{{ $role->name }}</span>
                        @endforeach
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
