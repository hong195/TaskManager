<div>
    @foreach($blocks as $oneBlock)
        <a href="/block/{{$oneBlock->id}}/cells"><h3>{{$oneBlock->name}}</h3></a>
    @endforeach
</div>
