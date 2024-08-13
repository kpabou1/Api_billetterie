@extends('layouts.app')

@section('title', 'Modifier une année')

@section('content')

<!-- Start page title -->
<ul class="flex space-x-2 rtl:space-x-reverse">
    <li>
        <a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <a href="{{ route('annees.index') }}" class="text-primary hover:underline">Années</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <span>Modifier une année</span>
    </li>
</ul>
<br>
<!-- End page title -->

@include('flash-message')

<div class="card">
    <div class="card-body">
        <form class="space-y-5" action="{{ route('annees.update', $annee->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-1/2 px-3">
                    <div class="form-group">
                        <label for="libelle">Libellé</label>
                        <input type="number" name="libelle" class="form-input @error('libelle') is-invalid @enderror" value="{{ old('libelle', $annee->libelle) }}" required>
                        @error('libelle')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-input @error('description') is-invalid @enderror">{{ old('description', $annee->description) }}</textarea>
                        @error('description')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <div class="form-group">
                        <label for="statut">Statut</label>
                        <select name="statut" class="form-input @error('statut') is-invalid @enderror" required>
                            <option value="En cours" {{ old('statut', $annee->statut) == 'En cours' ? 'selected' : '' }}>En cours</option>
                            <option value="Clôturé" {{ old('statut', $annee->statut) == 'Clôturé' ? 'selected' : '' }}>Clôturé</option>
                        </select>
                        @error('statut')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <div class="form-group">
                        <label for="date_debut">Date de Début</label>
                        <input type="date" name="date_debut" class="form-input @error('date_debut') is-invalid @enderror" value="{{ old('date_debut', $annee->date_debut) }}">
                        @error('date_debut')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <div class="form-group">
                        <label for="date_fin">Date de Fin</label>
                        <input type="date" name="date_fin" class="form-input @error('date_fin') is-invalid @enderror" value="{{ old('date_fin', $annee->date_fin) }}">
                        @error('date_fin')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="btn btn-primary">Modifier l'année</button>
                <a href="{{ route('annees.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
