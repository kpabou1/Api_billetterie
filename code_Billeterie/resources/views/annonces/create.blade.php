@extends('layouts.app')

@section('title', __('Ajouter une annonce'))

@section('content')

<!-- Start page title -->
<ul class="flex space-x-2 rtl:space-x-reverse">
    <li>
        <a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <a href="{{ route('annonces.index') }}" class="text-primary hover:underline">Annonces</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <span>{{ __('Ajouter une annonce') }}</span>
    </li>
</ul>
<br>
<!-- End page title -->

@include('flash-message')

<div class="card">
    <div class="card-body">
        <form class="space-y-5" action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="objet_marche">{{ __('Objet du Marché') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="objet_marche" class="form-input @error('objet_marche') is-invalid @enderror" value="{{ old('objet_marche') }}" required>
                        @error('objet_marche')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="corps_annonce">{{ __('Corps de l\'annonce') }} <span class="text-red-500">*</span></label>
                        <textarea id="corps_annonce" name="corps_annonce" class="form-input @error('corps_annonce') is-invalid @enderror">{{ old('corps_annonce') }}</textarea>
                        @error('corps_annonce')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="nom_autorite_contractante">{{ __('Nom Autorité Contractante') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="nom_autorite_contractante" class="form-input @error('nom_autorite_contractante') is-invalid @enderror" value="{{ old('nom_autorite_contractante') }}" required>
                        @error('nom_autorite_contractante')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="image_autorite_contractante">{{ __('Logo Autorité Contractante') }}</label>
                        <input type="file" name="image_autorite_contractante" accept="image/*" class="form-input @error('image_autorite_contractante') is-invalid @enderror">
                        @error('image_autorite_contractante')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                
                

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="lieu_depot">{{ __('Lieu de Dépôt') }} <span class="text-red-500">*</span></label></label>
                        <input type="text" name="lieu_depot" class="form-input @error('lieu_depot') is-invalid @enderror" value="{{ old('lieu_depot') }}" required>
                        @error('lieu_depot')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="adresse_autorite_contractante">{{ __('Adresse Autorité Contractante') }} <span class="text-red-500">*</span></label>
                        <textarea name="adresse_autorite_contractante" class="form-input @error('adresse_autorite_contractante') is-invalid @enderror">{{ old('adresse_autorite_contractante') }}</textarea>
                        @error('adresse_autorite_contractante')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="garantie_soumission">{{ __('Garantie de Soumission') }} <span class="text-red-500">*</span></label>
                        <textarea name="garantie_soumission" class="form-input @error('garantie_soumission') is-invalid @enderror">{{ old('garantie_soumission') }}</textarea>
                        @error('garantie_soumission')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>



                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group" >
                        <label for="date_depot">{{ __('Date de Dépôt') }}</label>
                        <input type="date" name="date_depot" class="form-input @error('date_depot') is-invalid @enderror" value="{{ old('date_depot') }}" >
                        @error('date_depot')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

               
                
                <div class="flex flex-wrap -mx-3">
                    <div class="form-group">
                        <label>{{ __('Source de Financement') }}<span class="text-red-500">*</span></label>
                        <div class="flex items-center space-x-4 mt-2">
                            <label class="flex items-center">
                                <input type="radio" name="sourcesfinance" class="form-radio h-5 w-5 rounded-full text-blue-600" value="{{$sourcefinances[0]->id}}">
                                <span class="ml-2">{{$sourcefinances[0]->name}}</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" id="sourcesfinance_id" name="sourcesfinance" class="form-radio h-5 w-5 rounded-full text-blue-600" value="{{$sourcefinances[1]->id}}">
                                <span class="ml-2">{{$sourcefinances[1]->name}}</span>
                                @error('categoriefinance_id')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                            </label>

                            <label class="flex items-center">
                                <input type="radio" id="autres" name="sourcesfinance" class="form-radio h-5 w-5 rounded-full text-blue-600" value="{{$sourcefinances[2]->id}}">
                                <span class="ml-2">{{$sourcefinances[2]->name}}</span>
                                @error('autres')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                            </label>
                            
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <div class="form-group" id="autre-div" style="display: none;">
                        <label for="autres">{{ __('Autres') }}</label>
                        <input type="text" name="autres" class="form-input @error('autres') is-invalid @enderror" placeholder="Entrez votre source de finance">
                        @error('autres')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <div class="form-group" id="category-div" style="display: none;">
                        <label for="categoriefinance_id">{{ __('Catégorie de Financement') }}</label>
                        <select id="categoriefinance_id" name="categoriefinance_id" class="form-input @error('categoriefinance_id') is-invalid @enderror">
                            <option value="">{{ __('Sélectionner une catégorie de financement') }}</option>
                            <!-- Les options seront ajoutées dynamiquement par JavaScript -->
                        </select>
                        @error('categoriefinance_id')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" class="form-input @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <div class="form-group">
                        <label for="ficher_annonce">{{ __('Fichier Annonce') }} <span class="text-red-500">*</span></label>
                        <input type="file" name="ficher_annonce" class="form-input @error('ficher_annonce') is-invalid @enderror" required>
                        @error('ficher_annonce')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <div class="form-group">
                        <label for="datetimepicker" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Date de Clôture') }} <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="text" id="datetimepicker" name="date_cloture" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" placeholder="Sélectionner la date et l'heure" value="{{ old('date_cloture') }}">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H3a2 2 0 00-2 2v11a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2h-2V3a1 1 0 00-1-1H6zm0 2V3h8v1H6z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        @error('date_cloture')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Ajouter') }}</button>
        </form>
    </div>
</div>
<!-- Ajoutez ceci dans votre section head -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#corps_annonce'))
            .catch(error => {
                console.error(error);
            });
    });
</script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        // Initialisation du sélecteur de date
        flatpickr("#datetimepicker", {
            enableTime: true,
            dateFormat: "Y-m-d H:i", // Format 24 heures
            time_24hr: true
        });

        // Initialisation de la gestion des sources de financement
        const sourcesFinanceRadios = document.querySelectorAll('input[name="sourcesfinance"]');
        const autresDiv = document.getElementById('autre-div');
        const categoryDiv = document.getElementById('category-div');
        const categorieSelect = document.getElementById('categoriefinance_id');

        sourcesFinanceRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                autresDiv.style.display = 'none';
                categoryDiv.style.display = 'none';

                if (this.id === 'sourcesfinance_id') {
                    categoryDiv.style.display = 'block';
                    fetchCategories(this.value);
                } else if (this.id === 'autres') {
                    autresDiv.style.display = 'block';
                }
            });
        });

        function fetchCategories(sourceId) {
            categorieSelect.innerHTML = '<option value="">{{ __('Sélectionner une catégorie de financement') }}</option>';

            if (sourceId) {
                fetch(`/api/categories/${sourceId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.categorie.forEach(function(categorie) {
                            var option = document.createElement('option');
                            option.value = categorie.id;
                            option.textContent = categorie.name;
                            categorieSelect.appendChild(option);
                        });
                    });
            }
        }
    });
</script>

@endsection
