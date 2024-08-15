@extends('layouts.app')

@section('title', __('Ajouter une annonce'))

@section('content')

    <!-- Start page title -->
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <a href="{{ route('events_billets.index') }}" class="text-primary hover:underline">Annonces</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>{{ __('Ajouter un événement') }}</span>
        </li>
    </ul>
    <br>
    <!-- End page title -->

    @include('flash-message')
    <div class="container mx-auto p-8">
        <div class="bg-white p-8 rounded shadow-md">
            <h2 class="text-3xl font-bold mb-8 text-center">Créer un événement</h2>

            <div class="mb-8">
                <div class="flex justify-between">
                    <div class="step-item" id="step1-indicator">
                        <div
                            class="step-number bg-red-500 text-white rounded-full w-10 h-10 flex items-center justify-center mx-auto">
                            1</div>
                        <div class="step-label mt-2 text-center text-red-500">Info de base</div>
                    </div>
                    <div class="step-item" id="step2-indicator">
                        <div
                            class="step-number bg-gray-300 text-gray-600 rounded-full w-10 h-10 flex items-center justify-center mx-auto">
                            2</div>
                        <div class="step-label mt-2 text-center text-gray-600">Date, lieu et images</div>
                    </div>
                    <div class="step-item" id="step3-indicator">
                        <div
                            class="step-number bg-gray-300 text-gray-600 rounded-full w-10 h-10 flex items-center justify-center mx-auto">
                            3</div>
                        <div class="step-label mt-2 text-center text-gray-600">Tickets et infoline</div>
                    </div>
                    <div class="step-item" id="step4-indicator">
                        <div
                            class="step-number bg-gray-300 text-gray-600 rounded-full w-10 h-10 flex items-center justify-center mx-auto">
                            4</div>
                        <div class="step-label mt-2 text-center text-gray-600">Publication</div>
                    </div>
                </div>
            </div>

            <form action="{{ route('events_billets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Step 1: Info de base -->
                <div class="step-content" id="step1-content">
                    <div class="mb-5">
                        <label class="block text-gray-700">Catégorie <span class="text-red-500">*</span></label>
                        <select name="event_category" class="w-full mt-2 p-2 border rounded">
                            <option value="Autre">Autre</option>
                            <option value="Concert-Spectacle">Concert-Spectacle</option>
                            <option value="Diner Gala">Diner Gala</option>
                            <option value="Festival">Festival</option>
                            <option value="Formation">Formation</option>
                        </select>
                        @error('event_category')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-gray-700">Titre de l'évènement <span class="text-red-500">*</span></label>
                        <input type="text" name="event_title" class="w-full mt-2 p-2 border rounded" maxlength="30"
                            required>
                        @error('event_title')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="block text-gray-700">Description textuelle</label>
                        <textarea name="event_description" class="w-full mt-2 p-2 border rounded"></textarea>
                        @error('event_description')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-red-500 text-white px-4 py-2 rounded"
                            onclick="nextStep(2)">Suivant</button>
                    </div>
                </div>

                <!-- Step 2: Date, lieu et images -->
                <div class="step-content hidden" id="step2-content">
                    <div class="mb-5">
                        <label class="block text-gray-700">Date & Heure <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="event_date" class="w-full mt-2 p-2 border rounded" required>
                        @error('event_date')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="block text-gray-700">Ville<span class="text-red-500">*</span></label>
                        <input type="text" name="event_city" class="w-full mt-2 p-2 border rounded" required>
                        @error('event_city')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="block text-gray-700">Adresse complète <span class="text-red-500">*</span></label>
                        <input type="text" name="event_address" class="w-full mt-2 p-2 border rounded" required>
                        @error('event_address')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="block text-gray-700">Image principale <span class="text-red-500">*</span></label>
                        <div class="relative w-full h-48 bg-gray-100 border rounded flex items-center justify-center">
                            <img id="imagePreview" src="https://via.placeholder.com/150" alt="Image Preview"
                                class="max-h-full max-w-full">
                            <input type="file" name="event_image"
                                class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer" required
                                onchange="previewImage(event)">
                            <div class="absolute top-2 right-2 bg-white p-1 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 20h9M16.5 3.5a2.121 2.121 0 010 3L8.5 14.5l-2 2-3-3 2-2 8-8a2.121 2.121 0 013 0z" />
                                </svg>
                            </div>
                            @error('event_image')
                                <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <script>
                        function previewImage(event) {
                            const reader = new FileReader();
                            reader.onload = function() {
                                const output = document.getElementById('imagePreview');
                                output.src = reader.result;
                            }
                            reader.readAsDataURL(event.target.files[0]);
                        }
                    </script>

                    <div class="flex justify-between">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded"
                            onclick="previousStep(1)">Précédent</button>
                        <button type="button" class="bg-red-500 text-white px-4 py-2 rounded"
                            onclick="nextStep(3)">Suivant</button>
                    </div>
                </div>

                <!-- Step 3: Tickets et infoline -->
                <div class="step-content hidden" id="step3-content">
                    <div class="mb-5">
                        <h3 class="text-xl font-bold">Informations sur les tickets</h3>
                        <div id="tickets-container">
                            <div class="ticket-entry mb-5 p-4 border rounded">
                                <div class="mb-3">
                                    <label class="block text-gray-700">Nom du ticket <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="ticket_type_name[]"
                                        class="w-full mt-2 p-2 border rounded" maxlength="50" required>
                                    @error('ticket_type_name')
                                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block text-gray-700">Prix du ticket <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" name="ticket_type_price[]"
                                        class="w-full mt-2 p-2 border rounded" required>
                                    @error('ticket_type_price')
                                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block text-gray-700">Quantité de tickets <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" name="ticket_type_quantity[]"
                                        class="w-full mt-2 p-2 border rounded" required>
                                    @error('ticket_type_quantity')
                                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3"hidden>
                                    <label class="block text-gray-700">Quantité réelle de tickets <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" name="ticket_type_real_quantity[]"
                                        class="w-full mt-2 p-2 border rounded" >

                                    @error('ticket_type_real_quantity')
                                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3" >
                                    <label class="block text-gray-700">Description</label>
                                    <textarea name="ticket_type_description[]" class="w-full mt-2 p-2 border rounded"></textarea>
                                    @error('ticket_type_description')
                                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="button" class="bg-green-500 text-white px-4 py-2 rounded"
                            onclick="addTicketEntry()">Ajouter un autre type de ticket</button>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded"
                            onclick="previousStep(2)">Précédent</button>
                        <button type="button" class="bg-red-500 text-white px-4 py-2 rounded"
                            onclick="nextStep(4)">Suivant</button>
                    </div>
                </div>

                <script>
                    function addTicketEntry() {
                        const ticketContainer = document.getElementById('tickets-container');
                        const newTicket = document.createElement('div');
                        newTicket.classList.add('ticket-entry', 'mb-5', 'p-4', 'border', 'rounded');
                        newTicket.innerHTML = `
            <div class="mb-3">
                <label class="block text-gray-700">Nom du ticket *</label>
                <input type="text" name="ticket_type_name[]" class="w-full mt-2 p-2 border rounded" maxlength="50" required>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700">Prix du ticket *</label>
                <input type="number" name="ticket_type_price[]" class="w-full mt-2 p-2 border rounded" required>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700">Quantité de tickets *</label>
                <input type="number" name="ticket_type_quantity[]" class="w-full mt-2 p-2 border rounded" required>
            </div>
             <div class="mb-3" hidden>
                    <label class="block text-gray-700">Quantité réelle de tickets *</label>
                    <input type="number" name="ticket_type_real_quantity[]" class="w-full mt-2 p-2 border rounded" >
                </div>
            <div class="mb-3">
                <label class="block text-gray-700">Description</label>
                <textarea name="ticket_type_description[]" class="w-full mt-2 p-2 border rounded"></textarea>
            </div>
        `;
                        ticketContainer.appendChild(newTicket);
                    }
                </script>
                <div class="step-content hidden" id="step4-content">
                    <div class="mb-5">
                        <h3 class="text-2xl font-bold text-gray-800">Vérifiez les informations de l'évènement</h3>

                        <!-- Section de l'image de l'événement -->
                        <div class="flex items-center mb-5">
                            <div class="w-1/4 mr-4">
                                <img id="event-image-preview" class="rounded-lg shadow-md" src="#"
                                    alt="Image de l'événement" />
                            </div>
                            <div class="w-3/4">
                                <h4 class="text-lg font-semibold text-gray-700">Titre de l'événement :</h4>
                                <p id="verify-event-title" class="text-gray-600"></p>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h4 class="text-lg font-semibold text-gray-700">Description :</h4>
                            <p id="verify-event-description" class="text-gray-600"></p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-700">Date & Heure :</h4>
                                <p id="verify-event-date" class="text-gray-600"></p>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-700">Lieu :</h4>
                                <p id="verify-event-city" class="text-gray-600"></p>
                                <p id="verify-event-address" class="text-gray-600"></p>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h4 class="text-lg font-semibold text-gray-700">Types de tickets :</h4>
                            <div id="verify-tickets" class="space-y-4"></div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                            onclick="previousStep(3)">Précédent</button>
                        <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Publier</button>
                    </div>
                </div>

                <script>
                    document.querySelector('input[name="event_title"]').addEventListener('input', function() {
                        document.getElementById('verify-event-title').textContent = this.value;
                    });

                    document.querySelector('textarea[name="event_description"]').addEventListener('input', function() {
                        document.getElementById('verify-event-description').textContent = this.value;
                    });

                    document.querySelector('input[name="event_date"]').addEventListener('change', function() {
                        document.getElementById('verify-event-date').textContent = this.value;
                    });

                    document.querySelector('input[name="event_city"]').addEventListener('input', function() {
                        document.getElementById('verify-event-city').textContent = this.value;
                    });

                    document.querySelector('input[name="event_address"]').addEventListener('input', function() {
                        document.getElementById('verify-event-address').textContent = this.value;
                    });

                    // Pour les tickets, ajoutez un écouteur d'événement pour chaque champ de ticket
                    document.querySelectorAll(
                        'input[name="ticket_type_name[]"], input[name="ticket_type_price[]"],input[name="ticket_type_real_quantity[]"], input[name="ticket_type_quantity[]"], textarea[name="ticket_type_description[]"]'
                    ).forEach(function(element) {
                        element.addEventListener('input', updateTicketVerification);
                    });

                    function updateTicketVerification() {
                        const ticketContainer = document.getElementById('verify-tickets');
                        ticketContainer.innerHTML = ''; // Vider le contenu pour le remplir à nouveau

                        const ticketNames = document.querySelectorAll('input[name="ticket_type_name[]"]');
                        const ticketPrices = document.querySelectorAll('input[name="ticket_type_price[]"]');
                        const ticketQuantities = document.querySelectorAll('input[name="ticket_type_quantity[]"]');
                        const ticketRealQuantities = document.querySelectorAll('input[name="ticket_type_real_quantity[]"]');
                        const ticketDescriptions = document.querySelectorAll('textarea[name="ticket_type_description[]"]');

                        ticketNames.forEach((_, index) => {
                            const ticketBlock = document.createElement('div');
                            ticketBlock.classList.add('p-4', 'bg-gray-100', 'rounded-lg', 'shadow-sm');
                            ticketBlock.innerHTML = `
                <h5 class="text-md font-semibold text-gray-700">Nom du ticket :</h5>
                <p class="text-gray-600">${ticketNames[index].value}</p>
                <h5 class="text-md font-semibold text-gray-700">Prix :</h5>
                <p class="text-gray-600">${ticketPrices[index].value} F CFA</p>
                <h5 class="text-md font-semibold text-gray-700">Quantité :</h5>
                <p class="text-gray-600">${ticketQuantities[index].value}</p>
                 <h5 class="text-md font-semibold text-gray-700">Quantité réelle de tickets :</h5>
                <p class="text-gray-600">${ticketRealQuantities[index].value}</p>
                <h5 class="text-md font-semibold text-gray-700">Description :</h5>
                <p class="text-gray-600">${ticketDescriptions[index].value}</p>
            `;
                            ticketContainer.appendChild(ticketBlock);
                        });
                    }

                    // Gestion de l'affichage de l'image
                    document.querySelector('input[name="event_image"]').addEventListener('change', function(event) {
                        const reader = new FileReader();
                        reader.onload = function() {
                            document.getElementById('event-image-preview').src = reader.result;
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    });
                </script>

            </form>
        </div>
    </div>

    <script>
        function nextStep(step) {
            document.querySelectorAll('.step-content').forEach(content => content.classList.add('hidden'));
            document.getElementById(`step${step}-content`).classList.remove('hidden');
            updateStepIndicator(step);
        }

        function previousStep(step) {
            nextStep(step);
        }

        function updateStepIndicator(step) {
            document.querySelectorAll('.step-item').forEach((indicator, index) => {
                const stepNumber = index + 1;
                if (stepNumber <= step) {
                    indicator.querySelector('.step-number').classList.remove('bg-gray-300', 'text-gray-600');
                    indicator.querySelector('.step-number').classList.add('bg-red-500', 'text-white');
                    indicator.querySelector('.step-label').classList.remove('text-gray-600');
                    indicator.querySelector('.step-label').classList.add('text-red-500');
                } else {
                    indicator.querySelector('.step-number').classList.add('bg-gray-300', 'text-gray-600');
                    indicator.querySelector('.step-number').classList.remove('bg-red-500', 'text-white');
                    indicator.querySelector('.step-label').classList.add('text-gray-600');
                    indicator.querySelector('.step-label').classList.remove('text-red-500');
                }
            });
        }
    </script>
@endsection
