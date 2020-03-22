@extends('layouts.default')

@section('content')
    @foreach($cells as $oneCell)
        <a href="{{ route('cells', $oneCell->id) }}"><h4>{{$oneCell->name}}</h4></a>
    @endforeach
@endsection

