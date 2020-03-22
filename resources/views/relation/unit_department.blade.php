@extends('layouts.default')

@section('content')
    <div class="container-fluid departments">
        <div class="unit__logo">
            <img class="img-responsive" width="100px" height="100px" src="{{ asset('storage') . $unit->logo->source }}">
        </div>
        <div class="row" >
            <div class="col-4  sectionlistItems">
                @forelse($unit->departments as $one)
                    <div class="staticList" data-department-id="{{ $one->id}}">
                        <a href="#"> {{($one->name)}}</a>
                    </div>
                @empty
                    <div class="content">
                        <p>No Blocks</p>
                    </div>
                @endforelse
                <div class="exitDiv">
                    <a class="backBtn" href="{{ route('units.show', $unit->id) }}">
                        <h5><i class="fas fa-undo-alt"></i>Назад</h5>
                    </a>
                </div>
            </div>
            <div class="col-8 ">
                    <div class="secondBlock wrapper" style="margin: 15px 0 0; padding: 0;">
                        @forelse($unit->departments as $k => $one)
                            <div class="{{ $k ===0 ? 'd-flex' : 'd-none' }} blocks flex-wrap justify-content-between"
                                 data-department-id="{{ $one->id }}"
                            >
                                @foreach($one->blocks as $block)
                                    <div class="single-block d-flex align-items-center">
                                        <a href="{{ route('blocks', $block->id ) }}">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <span>{{ $block->name }}</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @empty
                            <div class="content">
                                <p>No Blocks</p>
                            </div>
                        @endforelse
                    </div>
            </div>
        </div>
    </div>
@endsection
