@foreach($cells as $oneCell)
    <a href="/cell/{{$oneCell->id}}/steps"><h4>{{$oneCell->name}}</h4></a>
@endforeach
