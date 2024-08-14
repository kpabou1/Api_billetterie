@extends('layouts.app')

@section('title', __('Éditer une annonce'))

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
            <span>{{ __('Éditer un événement') }}</span>
        </li>
    </ul>
    <br>
    <!-- End page title -->

    @include('flash-message')
    <div class="container mx-auto p-8">
        <div class="bg-white p-8 rounded shadow-md">
            <h2 class="text-3xl font-bold mb-8 text-center">Éditer l'événement</h2>

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

            <form action="{{ route('events_billets.update', $event->event_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Step 1: Info de base -->
                <div class="step-content" id="step1-content">
                    <div class="mb-5">
                        <label class="block text-gray-700">Catégorie <span class="text-red-500">*</span></label>
                        <select name="event_category" class="w-full mt-2 p-2 border rounded">
                            <option value="Autre" {{ $event->category == 'Autre' ? 'selected' : '' }}>Autre</option>
                            <option value="Concert-Spectacle"
                                {{ $event->category == 'Concert-Spectacle' ? 'selected' : '' }}>Concert-Spectacle</option>
                            <option value="Diner Gala" {{ $event->category == 'Diner Gala' ? 'selected' : '' }}>Diner Gala
                            </option>
                            <option value="Festival" {{ $event->category == 'Festival' ? 'selected' : '' }}>Festival
                            </option>
                            <option value="Formation" {{ $event->category == 'Formation' ? 'selected' : '' }}>Formation
                            </option>
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
                            value="{{ old('event_title', $event->event_title) }}" required>
                        @error('event_title')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="block text-gray-700">Description textuelle</label>
                        <textarea name="event_description" class="w-full mt-2 p-2 border rounded">{{ old('event_description', $event->description) }}</textarea>
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
                        <input type="datetime-local" name="event_date" class="w-full mt-2 p-2 border rounded"
                            value="{{ old('event_date', $event->event_date) }}" required>
                        @error('event_date')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="block text-gray-700">Ville<span class="text-red-500">*</span></label>
                        <input type="text" name="event_city" class="w-full mt-2 p-2 border rounded"
                            value="{{ old('event_city', $event->event_city) }}" required>
                        @error('event_city')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="block text-gray-700">Adresse complète <span class="text-red-500">*</span></label>
                        <input type="text" name="event_address" class="w-full mt-2 p-2 border rounded"
                            value="{{ old('event_address', $event->event_address) }}" required>
                        @error('event_address')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="block text-gray-700">Image principale <span class="text-red-500">*</span></label>
                        <div class="relative w-full h-48 bg-gray-100 border rounded flex items-center justify-center">
                            <img id="imagePreview"
                                src="{{ $event->image ? asset('storage/' . $event->image) : 'https://via.placeholder.com/150' }}"
                                alt="Image Preview" class="max-h-full max-w-full">
                            <input type="file" name="event_image"
                                class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer"
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
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded"
                            onclick="prevStep(1)">Précédent</button>
                        <button type="button" class="bg-red-500 text-white px-4 py-2 rounded"
                            onclick="nextStep(3)">Suivant</button>
                    </div>
                </div>

                <!-- Step 3: Tickets -->
                <div class="step-content hidden" id="step3-content">
                    <div class="mb-5">
                        <label class="block text-gray-700">Prix des billets <span class="text-red-500">*</span></label>
                        <input type="number" name="event_ticket_price" class="w-full mt-2 p-2 border rounded"
                            value="{{ old('event_ticket_price', $event->ticket_price) }}" required>
                        @error('event_ticket_price')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="block text-gray-700">Lien d'achat <span class="text-red-500">*</span></label>
                        <input type="url" name="event_ticket_link" class="w-full mt-2 p-2 border rounded"
                            value="{{ old('event_ticket_link', $event->ticket_link) }}" required>
                        @error('event_ticket_link')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="block text-gray-700">Infoline <span class="text-red-500">*</span></label>
                        <input type="tel" name="event_infoline" class="w-full mt-2 p-2 border rounded"
                            value="{{ old('event_infoline', $event->infoline) }}" required>
                        @error('event_infoline')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded"
                            onclick="prevStep(2)">Précédent</button>
                        <button type="button" class="bg-red-500 text-white px-4 py-2 rounded"
                            onclick="nextStep(4)">Suivant</button>
                    </div>
                </div>

                <!-- Step 4: Publication -->
                <div class="step-content hidden" id="step4-content">
                    <div class="mb-5">
                        <label class="block text-gray-700">Statut de l'annonce <span class="text-red-500">*</span></label>
                        <select name="event_status" class="w-full mt-2 p-2 border rounded" required>
                            <option value="Publié" {{ $event->status == 'Publié' ? 'selected' : '' }}>Publié</option>
                            <option value="Non Publié" {{ $event->status == 'Non Publié' ? 'selected' : '' }}>Non Publié
                            </option>
                        </select>
                        @error('event_status')
                            <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded"
                            onclick="prevStep(3)">Précédent</button>
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Enregistrer</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        function nextStep(step) {
            const currentStep = document.querySelector('.step-content:not(.hidden)');
            const nextStep = document.getElementById(`step${step}-content`);
            if (currentStep && nextStep) {
                currentStep.classList.add('hidden');
                nextStep.classList.remove('hidden');
                updateIndicators(step);
            }
        }

        function prevStep(step) {
            const currentStep = document.querySelector('.step-content:not(.hidden)');
            const prevStep = document.getElementById(`step${step}-content`);
            if (currentStep && prevStep) {
                currentStep.classList.add('hidden');
                prevStep.classList.remove('hidden');
                updateIndicators(step);
            }
        }

        function updateIndicators(step) {
            const indicators = document.querySelectorAll('.step-item');
            indicators.forEach((indicator, index) => {
                if (index < step - 1) {
                    indicator.querySelector('.step-number').classList.replace('bg-gray-300', 'bg-red-500');
                    indicator.querySelector('.step-label').classList.replace('text-gray-600', 'text-red-500');
                } else if (index === step - 1) {
                    indicator.querySelector('.step-number').classList.replace('bg-gray-300', 'bg-red-500');
                    indicator.querySelector('.step-label').classList.replace('text-gray-600', 'text-red-500');
                } else {
                    indicator.querySelector('.step-number').classList.replace('bg-red-500', 'bg-gray-300');
                    indicator.querySelector('.step-label').classList.replace('text-red-500', 'text-gray-600');
                }
            });
        }
    </script>

@endsection
