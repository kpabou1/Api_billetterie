@extends('layouts.welcome')

@section('title', __('Liste de tous les événements'))

@section('content')
    <main class="main">
        <section class="news section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Filtres</h5>
                                <!-- Filtres sous forme de tableau -->
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Type d'événement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="eventStatus"
                                                        id="eventOngoing" value="upcoming">
                                                    <label class="form-check-label" for="eventOngoing">
                                                        Événements en cours
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="eventStatus"
                                                        id="eventCompleted" value="completed">
                                                    <label class="form-check-label" for="eventCompleted">
                                                        Tous les événements
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button id="resetFilters" class="btn btn-secondary mt-3">
                                    Effacer les critères de recherche
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="row" id="events-list">
                            @foreach ($events as $event)
                                <div class="col-xl-4 col-lg-6 col-md-6 mt-4">
                                    @php
                                        $eventDate = \Carbon\Carbon::parse($event->event_date);
                                    @endphp

                                    <div class="card">
                                        <img src="{{ asset('storage/' . $event->event_image) }}" alt=""
                                            class="card-img-top" style="height: 200px; object-fit: cover;"
                                            onerror="this.onerror=null;this.src='{{ asset('assets_3/logo.png') }}';">
                                        <div class="card-body text-center p-4">
                                            <h5 class="card-title">{{ $event->event_title }}</h5>
                                            <p class="card-text text-muted">{{ Str::limit($event->event_address, 100) }}</p>
                                            <button class="btn btn-primary mt-4 view-tickets"
                                                data-id="{{ $event->event_id }}" data-title="{{ $event->event_title }}">
                                                Voir les types de tickets disponibles pour cet événement
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $events->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ticketModalLabel">Types de tickets disponibles</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div id="ticket-list" class="d-flex flex-row flex-nowrap overflow-auto"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
          <!-- saut de 6 lignes -->
    <div style="margin-top: 20em;"></div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filters = document.querySelectorAll('input[name="eventStatus"]');
            const ticketsUrl = `{{ route('event.tickets', ['eventId' => '__event_id__']) }}`;

            document.querySelectorAll('.view-tickets').forEach(button => {
                button.addEventListener('click', function() {
                    const eventId = this.getAttribute('data-id');
                    const url = ticketsUrl.replace('__event_id__', eventId);

                    const eventTitle = this.getAttribute('data-title');
                    document.getElementById('ticketModalLabel').textContent =
                        `Tickets disponibles pour ${eventTitle}`;

                    fetch(url)
                        .then(response => response.json())
                        .then(tickets => {
                            const ticketList = document.getElementById('ticket-list');
                            ticketList.innerHTML = '';

                            if (tickets.length > 0) {
                                tickets.forEach(ticket => {
                                    const ticketItem = document.createElement('div');
                                    ticketItem.innerHTML = `
                                        <p>Type: ${ticket.ticket_type} - Prix: ${ticket.ticket_price}€</p>

                                    `;
                                    ticketList.appendChild(ticketItem);
                                });
                            } else {
                                ticketList.innerHTML =
                                    '<p>Aucun ticket disponible pour cet événement.</p>';
                            }

                            const modal = new bootstrap.Modal(document.getElementById(
                                'ticketModal'));
                            modal.show();
                        })
                        .catch(error => console.error('Erreur lors de la récupération des tickets:',
                            error));
                });
            });

            filters.forEach(filter => {
                filter.addEventListener('change', fetchEvents);
            });

            document.getElementById('resetFilters').addEventListener('click', function(event) {
                event.preventDefault();

                filters.forEach(filter => {
                    filter.checked = false;
                });

                fetchEvents();
            });

            function fetchEvents() {
                const eventStatus = document.querySelector('input[name="eventStatus"]:checked')?.value;

                let url = '{{ route('events.filter') }}';
                const params = new URLSearchParams();

                if (eventStatus) {
                    params.append('eventStatus', eventStatus);
                }

                url = `${url}?${params.toString()}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        const eventsList = document.getElementById('events-list');
                        eventsList.innerHTML = '';

                        data.forEach(event => {
                            const eventElement = document.createElement('div');
                            eventElement.classList.add('col-xl-4', 'col-lg-6', 'col-md-6', 'mt-4');

                            const cardDiv = document.createElement('div');
                            cardDiv.classList.add('card');

                            const imgEvent = document.createElement('img');
                            imgEvent.src = `{{ asset('storage/') }}/${event.event_image}`;
                            imgEvent.alt = '';
                            imgEvent.classList.add('card-img-top');
                            imgEvent.style.height = '200px';
                            imgEvent.style.objectFit = 'cover';
                            imgEvent.onerror = function() {
                                this.onerror = null;
                                this.src = '{{ asset('assets_3/logo.png') }}';
                            };

                            const cardBodyDiv = document.createElement('div');
                            cardBodyDiv.classList.add('card-body', 'text-center', 'p-4');

                            const cardTitle = document.createElement('h5');
                            cardTitle.classList.add('card-title');
                            cardTitle.textContent = event.event_title;

                            const cardText = document.createElement('p');
                            cardText.classList.add('card-text', 'text-muted');
                            cardText.textContent = event.event_address ? event.event_address.substring(
                                0, 100) : '';

                            const btnDetails = document.createElement('button');
                            btnDetails.classList.add('btn', 'btn-primary', 'mt-4');
                            btnDetails.textContent =
                                'Voir les types de tickets disponibles pour cet événement.';
                            btnDetails.setAttribute('data-id', event.event_id);
                            btnDetails.setAttribute('data-title', event.event_title);
                            btnDetails.classList.add('view-tickets');

                            cardBodyDiv.appendChild(cardTitle);
                            cardBodyDiv.appendChild(cardText);
                            cardBodyDiv.appendChild(btnDetails);
                            cardDiv.appendChild(imgEvent);
                            cardDiv.appendChild(cardBodyDiv);
                            eventElement.appendChild(cardDiv);
                            eventsList.appendChild(eventElement);
                        });

                        // Re-attach event listeners for the dynamically generated buttons
                        document.querySelectorAll('.view-tickets').forEach(button => {
                            button.addEventListener('click', function() {
                                const eventId = this.getAttribute('data-id');
                                const url = ticketsUrl.replace('__event_id__', eventId);

                                const eventTitle = this.getAttribute('data-title');
                                document.getElementById('ticketModalLabel').textContent =
                                    `Tickets disponibles pour ${eventTitle}`;

                                fetch(url)
                                    .then(response => response.json())
                                    .then(tickets => {
                                        const ticketList = document.getElementById(
                                            'ticket-list');
                                        ticketList.innerHTML = '';

                                        if (tickets.length > 0) {
                                            tickets.forEach(ticket => {
                                                const ticketItem = document
                                                    .createElement('div');
                                                ticketItem.innerHTML = `
        
                                      <div class="mx-2">
                                            <div class="card h-100 d-flex flex-row">
                                                  @csrf
                                                <div class="card-body d-flex flex-column">
                                                    <h5 class="card-title">${ticket.ticket_type_name}</h5>
                                                    <p class="card-text">Prix: ${ticket.ticket_type_price} CFA</p>
                                                    <a href="{{ url('payment') }}/${ticket.ticket_type_id}" class="btn btn-success">Je veux ce ticket</a>
                                                </div>
                                            </div>
                                    </div>
                    
                                                       
                                        `;
                                                ticketList.appendChild(ticketItem);
                                            });

                                        } else {
                                            ticketList.innerHTML =
                                                '<p>Aucun ticket disponible pour cet événement.</p>';
                                        }

                                        const modal = new bootstrap.Modal(document
                                            .getElementById('ticketModal'));
                                        modal.show();
                                    })
                                    .catch(error => console.error(
                                        'Erreur lors de la récupération des tickets:', error
                                    ));
                            });
                        });
                    })
                    .catch(error => console.error('Erreur lors de la récupération des événements:', error));
            }

            fetchEvents();
        });
    </script>
@endsection
