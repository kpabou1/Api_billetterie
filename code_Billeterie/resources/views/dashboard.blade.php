@extends('layouts.app')
@section('title')
{{__('Dashboard')}}
@endsection

@section('content')


<div class="container-fluid">

    @if(auth()->user()->roles->whereIn('name', ['Gerant', 'Vendeur','Magasinier','Admin','Developpeur'])->isNotEmpty())

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @include('layouts.partials.admin_dash')


  
    @endif

</div>
@endsection