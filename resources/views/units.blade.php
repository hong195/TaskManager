@extends('layouts.default')
@section('content')

    <div class="container-fluid wrapBox">
        <div class="row unitBox">
            @foreach($units as $oneUnit)
                <div class="col-4">
                    <div class="oneunitBox">
                        <a href="/units/{{$oneUnit->id}}">
                            <img class="img-responsive" width="200px"
                                 src="{{ asset('storage') . $oneUnit->logo->source }}">
                            <h4>{{$oneUnit->name}}</h4>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
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


