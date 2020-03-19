<meta name="viewport" content="width=device-width, initial-scale=0.5">
<style>
    .oneunitBox{
        text-align: center;
    }
    .wrapBox{
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<div class="container-fluid wrapBox">
    <div class="row unitBox">
        @foreach($units as $oneUnit)
            <div class="col-4">
                <div class="oneunitBox">
                    <a href="/units/{{$oneUnit->id}}">
                        <img class="img-responsive" width="200px" src="{{$oneUnit->logo->source}}" alt="">
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>



