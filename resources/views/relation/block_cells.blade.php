@extends('layouts.default')

@section('content')
    <div class="container-fluid departments">
        <div class="unit__logo">
            <a href="{{ route('units.show', $unit->id ) }}">
                <img class="img-responsive" width="100px" height="100px" src="{{ asset('storage') . $unit->logo->source }}">
            </a>
        </div>
        <div class="row" >
            <div class="col-4  sectionlistItems">
                @forelse($department->blocks as $k=> $block)
                    <div class="staticList {{  $block->id === $active_block ? 'active' : ''  }}"
                         data-id="{{ $block->id}}">
                        <a href="{{ route('cells', $block->id) }}">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            {{$block->name}}
                        </a>
                    </div>
                @empty
                    <div class="content">
                        <p>No Blocks</p>
                    </div>
                @endforelse
                <div class="exitDiv">
                    <a class="backBtn" href="{{ route('unit.systems', $unit->id) }}">
                        <h5><i class="fas fa-undo-alt"></i>Назад</h5>
                    </a>
                </div>
            </div>
            <div class="col-8 ">
                <div class="secondBlock wrapper" style="margin: 15px 0 0; padding: 0;">
                    @forelse($department->blocks as $k => $block)
                        <div class="{{ $block->id === $active_block ? 'd-flex' : 'd-none' }} blocks flex-wrap"
                             data-id="{{ $block->id }}"
                        >
                            @foreach($block->cells as $cell)
                                <div class="single-block d-flex align-items-center">
                                    <a href="{{ route('cells', $cell->id ) }}">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <span>{{ $cell->name }}</span>
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

