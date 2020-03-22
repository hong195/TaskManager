@foreach($terms as $oneTerm)
    <div class="termBlock">
        <div class="termContent">
            <div class="termTextContainer">
                <h3>{{$oneTerm->type}}</h3>
                <div class="d-flex">
                    <div class="termBlock__image">
                        <img class="term_image" src="{{ asset('storage/' . $oneTerm->file->source) }}">
                    </div>
                    <div class="termBlock__content">
                        <p>
                            {{$oneTerm->text}}
                        </p>
                        <a href="{{ route('term.edit', [$oneTerm->id] ) }}">Редактировать</a>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endforeach
