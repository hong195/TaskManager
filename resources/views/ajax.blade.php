<style>
    .blocks{
        border: 2px solid #38c172;
        margin: 2px;
        max-width: 49%;
    }
</style>
<h3>Big dreams!</h3>
<div class="container">
    <div class="row">
        @foreach($blocks as $oneBLock)
            <div class="blocks col-6">{{$oneBLock->name}}</div>
        @endforeach
    </div>
</div>К
