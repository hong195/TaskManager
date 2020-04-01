@if(Auth::check() && Auth::user()->can('manage', $unit))
    @if(!$file)
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
    @else
        <div id="lightgallery" class="section_image">
            <a href="{{ asset('storage') . $file->source }}">
                <img  src="{{ asset('storage') . $file->source }}" alt="">
            </a>
        </div>
    @endif
@else
    @if($file)
        <div id="lightgallery" class="section_image">
            <a href="{{ asset('storage') . $file->source }}">
                <img  src="{{ asset('storage') . $file->source }}" alt="">
            </a>
        </div>
    @endif
@endif

