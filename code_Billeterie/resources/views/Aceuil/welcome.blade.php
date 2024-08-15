@extends('layouts.welcome')

@section('title')
    {{ __('Billeterie') }}
@endsection
@section('content')
    <!-- Section des événements -->
    <section class="py-5 container-content">
        <div class="container">
            <h2 class="mb-4">Y-A QUELS MOUVEMENTS ?</h2>
            <div class="row">
                @foreach ($events->take(3) as $event)
                <div class="col-md-4 mb-4">
                    
                    <div class="card event-card">
                        <img src="{{ asset('storage/' . $event->event_image) }}"
                        alt="" class="img-fluid w-100"
                        style="height: 200px; object-fit: cover;"
                        onerror="this.onerror=null;this.src='{{ asset('assets_3/logo.png') }}';">                        <div class="card-body">
                            <h5 class="card-title">{{  $event->event_address }}</h5>
                            <p class="card-text">{{  $event->event_date }}</p>
                            <a href="{{ route('listeevents') }}" class="btn btn-primary">Acheter Tickets</a>
                        </div>
                    </div>
                </div>
                @endforeach
                
              
            </div>
            <!-- Bouton Voir Plus d'Événements -->
            <div class="text-center mt-4">
                <a href="{{ route('listeevents') }}" class="btn btn-secondary">Voir plus d'événements</a>
            </div>
        </div>
          <!-- saut de 6 lignes -->
    <div style="margin-top: 20em;"></div>
    </section>
@endsection
