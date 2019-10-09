<form style="display:inline" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        {{ __('Delete') }}
    </button>
</form>
