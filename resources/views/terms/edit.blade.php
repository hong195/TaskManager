@extends('layouts.default')
@section('content')
<form method="POST" action="{{ route('term.update', [$term->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="text" >Текст</label>
        <input type="text" name="text" id="text" required>
    </div>
    <div class="form-group">
        <label for="img">Изображение</label>
        @if ($term->file->source)
            <div style="background: url('{{ asset('storage/' . $term->file->source) }}');"></div>
        @endif
        <input type="file" name="term_image" id="img">
    </div>
    <div class="form-group">
        <input type="submit" value="Сохранить">
    </div>
</form>
@endsection

