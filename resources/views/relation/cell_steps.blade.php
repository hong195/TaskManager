<div class="container">
    <div class="row">
        @foreach($steps as $oneStep)
            <div class="col-6">
                <h4>{{$oneStep->name}}</h4>
            </div>
            <div class="col-2">
                {{$oneStep->status}}
            </div>
            <div class="col-4">
               Deadline will be: {{$oneStep->deadline}}
            </div>
        @endforeach
    </div>
</div>
