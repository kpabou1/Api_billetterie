@extends('layouts.welcome')

@section('title', __('Informations de Paiement'))

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Section Gauche : Formulaire -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Remplissez vos informations</h5>
                    <form id="paymentForm" action="{{ route('payments.inofs') }}" method="POST">
                        @csrf
                        <div hidden class="form-group">
                            <label for="order_intent_id">Identifiant de Commande</label>
                            <input type="text" class="form-control @error('ticket_type_id') is-invalid @enderror" id="ticket_type_id" name="ticket_type_id" value="{{$tickets[0]->ticket_type_id }}" placeholder="Entrez l'identifiant">
                            @error('id_ticket')
                            <div class="bg-danger text-white text-sm font-bold px-4 py-2 rounded mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div  class="form-group">
                            <label for="order_intent_type">Type de Commande</label>
                            <select class="form-control @error('order_intent_type') is-invalid @enderror" id="order_intent_type" name="order_intent_type">
                                <option value="en_ligne" {{ old('order_intent_type') == 'en_ligne' ? 'selected' : '' }}>Commande en ligne</option>
                                <option value="sur_place" {{ old('order_intent_type') == 'sur_place' ? 'selected' : '' }}>Commande sur place</option>
                            </select>                     
                            @error('order_intent_type')
                            <div class="bg-danger text-white text-sm font-bold px-4 py-2 rounded mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        

                        <div class="form-group mt-3">
                            <label for="order_intent_nombre">Nombre de tickets</label>
                            <input type="number" class="form-control @error('order_intent_nombre') is-invalid @enderror" id="order_intent_nombre" name="order_intent_nombre" value="{{ old('order_intent_nombre') }}" placeholder="Entrez le nombre de tickets" required>
                            @error('order_intent_nombre')
                            <div class="bg-danger text-white text-sm font-bold px-4 py-2 rounded mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mt-3" hidden>
                            <label for="user_email">Email</label>
                            <input type="email" class="form-control @error('user_email') is-invalid @enderror" id="user_email" name="user_email" value="{{ old('user_email') }}" placeholder="Entrez votre email" >
                            @error('user_email')
                            <div class="bg-danger text-white text-sm font-bold px-4 py-2 rounded mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="user_phone">Téléphone</label>
                            <input type="text" class="form-control @error('user_phone') is-invalid @enderror" id="user_phone" name="user_phone" value="{{ old('user_phone') }}" placeholder="Entrez votre téléphone" required>
                            @error('user_phone')
                            <div class="bg-danger text-white text-sm font-bold px-4 py-2 rounded mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-4">Passer la commande</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Section Droite : Informations de l'événement et du ticket -->
        <div class="col-md-4">
            <div class="card">
                <!-- Zone pour l'image -->
                <div class="img-container" style="max-height: 200px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $event->event_image) }}" alt="{{ $event->event_title }}"
                        class="w-100 h-auto object-cover"
                        onerror="this.onerror=null;this.src='{{ asset('assets_3/logo.png') }}';">
                </div>
        
                <!-- Corps de la carte -->
                <div class="card-body">
                    <h5 class="card-title">{{ $event->event_title }}</h5>
                    <p class="card-text">{{ $event->event_description }}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Date:</strong> {{ $event->event_date }}</li>
                        <li class="list-group-item"><strong>Adresse:</strong> {{ $event->event_address }}, {{ $event->event_city }}</li>
                    </ul>
                </div>
        
                <!-- Pied de page de la carte -->
                <div class="card-footer">
                    <h6 class="text-muted">{{ $tickets[0]->ticket_type_name }}</h6>
                    <p class="text-muted">{{ $tickets[0]->ticket_type_description }}</p>
                    <p class="text-muted"><strong>Prix:</strong> {{ $tickets[0]->ticket_type_price }} CFA</p>
                </div>
            </div>
        </div>
    </div>

    <!-- saut de 6 lignes -->
    <div style="margin-top: 20em;"></div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous allez passer la commande.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, confirmer',
            cancelButtonText: 'Non, annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>
@endsection
