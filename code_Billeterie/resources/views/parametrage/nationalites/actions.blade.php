<!-- resources/views/nationalites/actions.blade.php -->

<a href="{{ route('nationalites.show', $row->id) }}" class="btn btn-info btn-sm">
    <i class="bx bxs-bullseye"></i>
</a>
<a href="{{ route('nationalites.edit', $row->id) }}" class="btn btn-warning btn-sm">
    <i class="bx bxs-edit"></i>
</a>
<form action="{{ route('nationalites.destroy', $row->id) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger btn-sm delete-btn">
        <i class="bx bxs-trash"></i>
    </button>
</form>
