@if(false)
    <div class="edit_section_image">
        <form action="{{ route('file.update', $file->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <h2>Редактировать Изображение</h2>
            <div class="form-group">
                <input type="file" name="section_img">
            </div>
            <div class="form-group">
                <input type="submit" value="Сохранить">
            </div>
            <input type="hidden" name="section_id" value="{{ $section_id }}">
            <input type="hidden" name="unit_id" value="{{ $unit_id }}">
        </form>
    </div>
@elseif ($file)
    <div class="section_image">
        <img class="w-100" src="{{ asset('storage') . $file->source }}" alt="">
        <input type="hidden" name="file_id" value="{{ $file->id }}">
    </div>
@else
    <div class="add_section_image">
        <form action="{{ route('file.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h2>Добавить Изображение</h2>
            <div class="form-group">
                <input type="file" name="section_img">
            </div>
            <div class="form-group">
                <input type="submit" value="Сохранить">
            </div>
            <input type="hidden" name="section_id" value="{{ $section_id }}">
            <input type="hidden" name="unit_id" value="{{ $unit_id }}">
        </form>
    </div>
@endif

