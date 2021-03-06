@extends('layouts.default')

@section('content')
    <div class="container-fluid departments">
        @if($unit->logo)
            <div class="unit__logo">
                <img class="img-responsive" width="100px" height="100px"
                     src="{{ asset('storage') . $unit->logo->source }}">
            </div>
        @endif
        <div class="row">
            <div class="col-4  sectionlistItems">
                <h3 class="ml-2">Блоки</h3>
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
                    <a class="backBtn" href="{{ route('departments', $unit->id) }}">
                        <h5><i class="fas fa-undo-alt"></i>Назад</h5>
                    </a>
                </div>
            </div>
            <div class="col-8 ">
                <div class="secondBlock wrapper" style="margin: 15px 0 0; padding: 0;">
                    <h3 class="ml-2">Ячейки</h3>
                    @forelse($department->blocks as $k => $block)
                        <div class="{{ $block->id === $active_block ? 'd-flex' : 'd-none' }} blocks flex-wrap"
                             data-id="{{ $block->id }}"
                        >
                            @foreach($block->cells as $cell)
                                <div class="single-block d-flex flex-wrap align-items-center"
                                >
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('cells', $cell->id ) }}">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <span>{{ $cell->name }}</span>
                                        </a>
                                        @can('manage', $unit)
                                            <div class="edit__cell"
                                                 data-action="{{ route('cell.update', $cell->id) }}"
                                                 data-cell-name="{{ $cell->name }}"
                                                 data-plan-approved-at="{{ $cell->visualisation_date }}"
                                                 data-fact-approved-at="{{ $cell->plan_deadline }}"
                                                 data-status="{{ $cell->status }}"
                                                 data-target="#cellEdit"
                                                 data-toggle="modal"
                                                 style="cursor: pointer;"
                                            >
                                                <i class="fa fa-pencil-square-o mx-1" aria-hidden="true"></i>
                                            </div>
                                        @endcan
                                    </div>
                                    <div class="w-100 mt-2">
                                        <h6 style="color: #fff;">Статус: <span>{{ __('status.'. $cell->status) }}</span>
                                        </h6>
                                        <h6 style="color: #fff;">Дата Визуализации:
                                            <span>
                                                {{ $cell->visualisation_date
                                                                        ? $cell->visualisation_date->format('Y-m-d')
                                                                        : 'Отсутвует' }}
                                            </span>
                                        </h6>
                                        <h6 style="color: #fff;">Дедлайн:
                                            <span>
                                                {{ $cell->plan_deadline
                                                                        ? $cell->plan_deadline->format('Y-m-d')
                                                                        : 'Отсутвует' }}
                                            </span>
                                        </h6>
                                    </div>
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
    @include('cells.edit')
    @include('cells.show')
@endsection

