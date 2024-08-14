@extends('layouts.app')

@section('title', __('Modifier l\'événement'))

@section('content')

<ul class="flex space-x-2 rtl:space-x-reverse">
    <li>
        <a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <a href="{{ route('events_billets.index') }}" class="text-primary hover:underline">Événements</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <span>{{ __('Modifier l\'événement') }}</span>
    </li>
</ul>

<br>

@include('flash-message')

<div class="card">
    <div class="card-body">
        <form class="space-y-5" action="{{ route('events_billets.update', $event->event_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="event_category">{{ __('Catégorie de l\'événement') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="event_category" class="form-input @error('event_category') is-invalid @enderror" value="{{ old('event_category', $event->event_category) }}" required>
                        @error('event_category')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="event_title">{{ __('Titre de l\'événement') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="event_title" class="form-input @error('event_title') is-invalid @enderror" value="{{ old('event_title', $event->event_title) }}" required>
                        @error('event_title')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="event_description">{{ __('Description de l\'événement') }}</label>
                        <textarea name="event_description" class="form-input @error('event_description') is-invalid @enderror">{{ old('event_description', $event->event_description) }}</textarea>
                        @error('event_description')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="event_date">{{ __('Date de l\'événement') }} <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="event_date" class="form-input @error('event_date') is-invalid @enderror" 
                        value="{{ old('event_date', $event->event_date instanceof \DateTime ? $event->event_date->format('Y-m-d\TH:i') : $event->event_date) }}" required>
                                                @error('event_date')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="event_image">{{ __('Image de l\'événement') }}</label>
                        <input type="file" name="event_image" class="form-input @error('event_image') is-invalid @enderror">
                        @error('event_image')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror

                        @if($event->event_image)
                            <div class="mt-4">
                                <p>{{ __('Image actuelle :') }}</p>
                                <img src="{{ asset('storage/' . $event->event_image) }}" alt="{{ $event->event_title }}" style="width: 150px; height: auto;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="event_city">{{ __('Ville de l\'événement') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="event_city" class="form-input @error('event_city') is-invalid @enderror" value="{{ old('event_city', $event->event_city) }}" required>
                        @error('event_city')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="event_address">{{ __('Adresse de l\'événement') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="event_address" class="form-input @error('event_address') is-invalid @enderror" value="{{ old('event_address', $event->event_address) }}" required>
                        @error('event_address')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full px-3">
                    <div class="form-group">
                        <label>{{ __('Types de billet') }} <span class="text-red-500">*</span></label>

                        <div id="ticket_types_container">
                            @foreach($event->ticketTypes as $index => $ticketType)
                                <div class="ticket-type-item">
                                    <div class="form-group">
                                        <label for="ticket_type_name">{{ __('Nom du type de billet') }}</label>
                                        <input type="text" name="ticket_type_name[]" class="form-input @error('ticket_type_name.' . $index) is-invalid @enderror" value="{{ old('ticket_type_name.' . $index, $ticketType->ticket_type_name) }}" required>
                                        @error('ticket_type_name.' . $index)
                                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="ticket_type_price">{{ __('Prix du billet') }}</label>
                                        <input type="number" name="ticket_type_price[]" class="form-input @error('ticket_type_price.' . $index) is-invalid @enderror" value="{{ old('ticket_type_price.' . $index, $ticketType->ticket_type_price) }}" required>
                                        @error('ticket_type_price.' . $index)
                                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="ticket_type_quantity">{{ __('Quantité de billets') }}</label>
                                        <input type="number" name="ticket_type_quantity[]" class="form-input @error('ticket_type_quantity.' . $index) is-invalid @enderror" value="{{ old('ticket_type_quantity.' . $index, $ticketType->ticket_type_quantity) }}" required>
                                        @error('ticket_type_quantity.' . $index)
                                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="ticket_type_description">{{ __('Description du billet') }}</label>
                                        <textarea name="ticket_type_description[]" class="form-input @error('ticket_type_description.' . $index) is-invalid @enderror">{{ old('ticket_type_description.' . $index, $ticketType->ticket_type_description) }}</textarea>
                                        @error('ticket_type_description.' . $index)
                                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="ticket_type_real_quantity">{{ __('Quantité réelle de billets') }}</label>
                                        <input type="number" name="ticket_type_real_quantity[]" class="form-input @error('ticket_type_real_quantity.' . $index) is-invalid @enderror" value="{{ old('ticket_type_real_quantity.' . $index, $ticketType->ticket_type_real_quantity) }}" required>
                                        @error('ticket_type_real_quantity.' . $index)
                                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <hr class="my-4">
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-secondary" id="add_ticket_type">{{ __('Ajouter un type de billet') }}</button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Mettre à jour') }}</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('add_ticket_type').addEventListener('click', function () {
        const container = document.getElementById('ticket_types_container');
        const newIndex = container.children.length;
        const ticketTypeItem = `
            <div class="ticket-type-item">
                <div class="form-group">
                    <label for="ticket_type_name">{{ __('Nom du type de billet') }}</label>
                    <input type="text" name="ticket_type_name[]" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label for="ticket_type_price">{{ __('Prix du billet') }}</label>
                    <input type="number" name="ticket_type_price[]" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="ticket_type_quantity">{{ __('Quantité de billets') }}</label>
                    <input type="number" name="ticket_type_quantity[]" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="ticket_type_description">{{ __('Description du billet') }}</label>
                    <textarea name="ticket_type_description[]" class="form-input"></textarea>
                </div>

                <div class="form-group">
                    <label for="ticket_type_real_quantity">{{ __('Quantité réelle de billets') }}</label>
                    <input type="number" name="ticket_type_real_quantity[]" class="form-input" required>
                </div>

                <hr class="my-4">
            </div>
        `;
        container.insertAdjacentHTML('beforeend', ticketTypeItem);
    });
</script>

@endsection
