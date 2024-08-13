@extends('layouts.app')
@section('content')

<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">Liste des communes</h3>
        <div class="block-options">
            <a href="{{ route('communes.create') }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Ajouter une commune">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    
    <div class="block-content block-content-full">
        @if($communes->isEmpty())
            <p>Aucune donnée disponible.</p>
        @else
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
            <thead>
                <tr>
                    {{-- <th class="text-center" style="width: 80px;">ID</th> --}}
                    <th class="d-none d-sm-table-cell" style="width: 20%;">Préfecture</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">communes</th>
                    
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($communes as $commune)

                <tr>
                    {{-- <td class="text-center">{{ $commune->id }}</td> --}}
                    <td class="font-w600">{{ $commune->prefecture->nom_prefecture }}</td>
                    <td class="font-w600">{{ $commune->nom_commune }}</td>
                    <td class="text-center">
                        <a href="{{ route('communes.edit', $commune->id) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Modifier">
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('communes.destroy', $commune->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commune ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Supprimer">
                                <i class="fa fa-times"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
