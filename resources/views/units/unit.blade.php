<style>
    .sectionlistItems {
    }

    .staticList {
        border: 1px solid #c4c4c4;
        margin: 15px;
        border-radius: 5px;
        max-width: 320px;
        background-color: #67b437;
        padding-left: 5px;
        font-size: 1.8em;
        min-width: 100%;
    }

    .staticList a, .backBtn {
        color: white;
    }

    .backBtn {
        color: #67b437;
    }

    .allBox {
        height: 100%;
        /*background: #f9f8a8;*/
    }

    .unitName {
        color: #1d643b;
    }

    .termContent {
        display: flex;
        flex-direction: row;
    }
    .imageclass{
        float: left;
        max-width: 220px;
        margin: 5px;
    }
</style>
<div class="allBox container-fluid">
    <img class="img-responsive" width="100px" height="100px" src="{{$unit->logo->source}}" alt="">
    <div class="row">
        <div class="sectionlistItems col-4">
            @foreach($sections as $oneSection)
                <div class="staticList">
                    <a style="text-decoration:none" onclick="getFile({{$oneSection->id}}, {{$unit->id}})" href="#">
                        <i class="{{$oneSection->icon_code}}"></i>
                        {{ $oneSection->name }}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="col-8 secondBlock">
            @foreach($terms as $oneTerm)
                <div class="termBlock">
                    <div class="termContent">
                        <div class="termTextContainer">
                            <h3>{{$oneTerm->type}}</h3>
                            <img class="imageclass" width="100%" src="{{ asset('storage/' . $oneTerm->file->source) }}">
                            <a href="{{ route('term.edit', [$oneTerm->id] ) }}">Редактировать</a>
                            <p>
                                {{$oneTerm->text}}
                            </p>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
    <div class="exitDiv">
        <a style="text-decoration:none"
           class="backBtn" href="/units">
            <h5><i class="fas fa-undo-alt"></i> Назад к выбору BU</h5>
        </a>
    </div>
</div>

<script>
function getFile(sectionId, unitId){
    $.ajax({
        type: 'POST',
        url: '/getDataBySection',
        data:
            {
                'sectionId': sectionId,
                'unitId': unitId,
            },
        success: function (data) {
            $('.secondBlock').html(data);
        },
        error: (error) => {
          console.log(error)
        }
    });
}
</script>







