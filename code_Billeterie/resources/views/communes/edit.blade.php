@extends('layouts.app')

@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">Modifier la commune</h3>
    </div>

    <div class="block-content block-content-full">
        <form action="{{ route('communes.update', $communes->id_commune) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom_commune">Nom de la commune</label>
                <input type="text" class="form-control" id="nom_commune" name="nom_commune" value="{{ $communes->nom_commune }}">
            </div>

            <div class="form-group">
                <label for="id_prefecture">Préfecture</label>
                <select class="form-control" id="id_prefecture" name="id_prefecture">
                    @foreach($prefectures as $prefecture)
                    <option value="{{ $prefecture->id_prefecture }}" {{ $prefecture->id_prefecture == $communes->id_prefecture ? 'selected' : '' }}>{{ $prefecture->nom_prefecture }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</div>
@endsection
