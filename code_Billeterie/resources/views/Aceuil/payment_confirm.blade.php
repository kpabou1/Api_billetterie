@extends('layouts.welcome')

@section('title', __('Confirmation de Paiement'))

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Section du haut : Affichage des informations -->
        <div class="col-12 text-center mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Résumé de votre commande</h4>
                    <p><strong>Nombre de tickets:</strong> {{ $ticket_quantity }}</p>
                    <p><strong>Prix total:</strong> {{ $total_price }} CFA</p>
                </div>
            </div>
        </div>

        <!-- Section Gauche : Formulaire -->
        <div class="col-md-6">
            <div class="card">
                @if ($notification = Session::get('notification'))
                @if ($notification['type'] === 'success')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">{{ $notification['message'] }}</p>
                    </div>
                @elseif ($notification['type'] === 'warning')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">{{ $notification['message'] }}</p>
                    </div>

                @elseif ($notification['type'] === 'danger')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">{{ $notification['message'] }}</p>
                    </div>
                @endif
            @endif
                <div class="card-body">
                    <h5 class="card-title text-center">Informations de Paiement</h5>
                    <form id="paymentForm" action="{{ route('payment.confirm') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="order_payment">Mode de paiement</label>
                            <select class="form-control @error('order_payment') is-invalid @enderror" id="order_payment" name="order_payment">
                                <option value="tmonney" {{ old('order_payment') == 'tmonney' ? 'selected' : '' }}>T-Money</option>
                                <option value="flooz" {{ old('order_payment') == 'flooz' ? 'selected' : '' }}>Flooz</option>
                            </select>
                            @error('order_payment')
                            <div class="bg-danger text-white text-sm font-bold px-4 py-2 rounded mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="order_type">Type de Commande</label>
                            <select class="form-control @error('order_type') is-invalid @enderror" id="order_type" name="order_type">
                                <option value="en_ligne" {{ old('order_type') == 'en_ligne' ? 'selected' : '' }}>Commande en ligne</option>
                                <option value="sur_place" {{ old('order_type') == 'sur_place' ? 'selected' : '' }}>Commande sur place</option>
                            </select>
                            @error('order_type')
                            <div class="bg-danger text-white text-sm font-bold px-4 py-2 rounded mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="ticket_email">Email</label>
                            <input type="email" class="form-control @error('ticket_email') is-invalid @enderror" id="ticket_email" name="ticket_email" value="{{ old('ticket_email') }}" placeholder="Entrez votre email" required>
                            @error('ticket_email')
                            <div class="bg-danger text-white text-sm font-bold px-4 py-2 rounded mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="ticket_phone">Téléphone</label>
                            <input type="text" class="form-control @error('ticket_phone') is-invalid @enderror" id="ticket_phone" name="ticket_phone" value="{{ old('ticket_phone') }}" placeholder="Entrez votre téléphone" required>
                            @error('ticket_phone')
                            <div class="bg-danger text-white text-sm font-bold px-4 py-2 rounded mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        
                       
                        <div class="form-group mt-3" hidden >
                            <label for="ticket_email">Email</label>
                            <input type="text" class="form-control is-invalid id="ticket_email" name="order_intent_id" value="{{$orderIntent->order_intent_id }}" placeholder="Entrez votre email" >
                            <input type="text" class="form-control is-invalid  id="" name="ticket_type_id" value="{{ $ticketId }}" placeholder="Entrez votre email" >
                            <input type="text" class="form-control is-invalid  id="" name="ticket_quantity" value="{{ $ticket_quantity }}" placeholder="Entrez votre email" >

                          
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-4">Confirmer le paiement</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Section Droite : Détails du ticket et de l'événement -->
        <div class="col-md-4">
            <div class="card">
                <!-- Image de l'événement -->
                <div class="img-container" style="max-height: 200px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $event->event_image) }}" alt="{{ $event->event_title }}" class="w-100 h-auto object-cover" onerror="this.onerror=null;this.src='{{ asset('assets_3/logo.png') }}';">
                </div>
        
                <!-- Détails de l'événement et du ticket -->
                <div class="card-body">
                    <h5 class="card-title">{{ $event->event_title }}</h5>
                    <p class="card-text">{{ $event->event_description }}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Date:</strong> {{ $event->event_date }}</li>
                        <li class="list-group-item"><strong>Adresse:</strong> {{ $event->event_address }}, {{ $event->event_city }}</li>
                    </ul>
                </div>
        
                <!-- Détails du ticket -->
                <div class="card-footer">
                    <h6 class="text-muted">{{ $ticket->ticket_type_name }}</h6>
                    <p class="text-muted">{{ $ticket->ticket_type_description }}</p>
                    <p class="text-muted"><strong>Prix:</strong> {{ $ticket->ticket_type_price }} CFA</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- saut de 6 lignes -->
    <div style="margin-top: 20em;"></div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous allez confirmer le paiement.",
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
