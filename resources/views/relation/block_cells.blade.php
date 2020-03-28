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
                <h3 class="ml-2">Блоки</h3>
                @forelse($department->blocks as $k=> $block)
                    <div class="staticList {{  $block->id === $active_block ? 'active' : ''  }}"
                         data-id="{{ $block->id}}"
                         style="background-color: {{ $block->code_color }} "
                    >
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
                <h3 class="ml-2">Ячейки</h3>
                <div class="secondBlock wrapper" style="margin: 15px 0 0; padding: 0;">
                    @forelse($department->blocks as $k => $block)
                        <div class="{{ $block->id === $active_block ? 'd-flex' : 'd-none' }} blocks flex-wrap"
                             data-id="{{ $block->id }}"
                        >
                            @foreach($block->cells as $cell)
                                <div style="width: 31%; margin: 0 10px 10px 10px;">
                                    <a class="single-block d-flex" href="{{ route('cells', $cell->id ) }}"
                                       style="width: 100%; color: #fff; min-height: 125px;">
                                        <span>
                                            <i class="fa fa-star" style="margin: 5px 10px 0 0 ;" aria-hidden="true"></i>
                                            {{ $cell->name }}
                                        </span>
                                    </a>
                                    <h6 class="ml-3">Статус: <span>{{ $cell->status }}</span></h6>
                                    <h6 class="ml-3">Дедлайн: <span>{{ $cell->deadline }}</span></h6>
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

