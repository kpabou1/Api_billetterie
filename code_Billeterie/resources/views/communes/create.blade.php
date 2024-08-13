@extends('layouts.app')
@section('content')

<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">Créer une nouvelle commune</h3>
    </div>
    
    <div class="block-content block-content-full">
        <form action="{{ route('communes.store') }}" method="POST">
            @csrf
            <div class="form-group" style="width: 90%; margin-left: 50px;">
                <label for="nom_commune">Nom de la commune:</label>
                <input type="text" name="nom_commune" id="nom_commune" class="form-control" required>
            </div>
            <div class="form-group" style="width: 90%; margin-left: 50px;">
                <label for="id_prefecture">Préfecture:</label>
                <select name="id_prefecture" id="id_prefecture" class="form-control" required>
                    <option value="">Sélectionner une préfecture</option>
                    @foreach($prefectures as $prefecture)
                        <option value="{{ $prefecture->id_prefecture }}">{{ $prefecture->nom_prefecture }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="{{ route('communes.index') }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Retour à la liste des communes"  style="float: right;">
                <i class="fa fa-arrow-left">Retour</i>
            </a>
        </form>
    </div>
</div>
@endsection
