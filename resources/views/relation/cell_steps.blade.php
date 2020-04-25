@extends('layouts.default')
@section('content')
    <div class="container-fluid departments">
        @if($unit->logo)
            <div class="unit__logo">
                <a href="{{ route('units.show', $unit->id ) }}">
                    <img class="img-responsive" width="100px" height="100px"
                         src="{{ asset('storage') . $unit->logo->source }}">
                </a>
            </div>
        @endif
        <div class="row">
            <div class="col-4  sectionlistItems">
                <h3 class="ml-2">Ячейки</h3>
                @forelse($block->cells  as $k => $cell)
                    <div class="steps staticList {{ $cell->id === $active_cell ? 'active' : '' }}" data-id="{{ $cell->id}}">
                        <a href="{{ route('cells', $cell->id) }}">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            {{$cell->name}}
                        </a>
                    </div>
                @empty
                    <div class="content">
                        <p>No Cells</p>
                    </div>
                @endforelse
                <div class="exitDiv">
                    <a class="backBtn" href="{{ route('blocks', $block->id) }}">
                        <h5><i class="fas fa-undo-alt"></i>Назад</h5>
                    </a>
                </div>
            </div>
            <div class="col-8 ">
                <h3 class="ml-2">Шаги</h3>
                <div class="secondBlock wrapper" style="margin: 15px 0 0; padding: 0;">
                    @forelse($block->cells as $k => $cell)
                        <div data-id="{{ $cell->id }}"
                             class="step__wrapper {{ $cell->id === $active_cell ? 'd-block' : 'd-none' }} w-100"
                        >
                            <table class="table-bordered w-100 steps__table"
                                   data-id="{{ $cell->id }}"
                            >
                                <tr>
                                    <th>Название</th>
                                    <th>Дата визуализаци</th>
                                    <th>Дедлайн</th>
                                    <th>Отвественный</th>
                                    <th>Статус</th>
                                    @can('manage', $unit)
                                        <th>Действия</th>
                                    @endcan
                                </tr>
                                @forelse($cell->steps as $k => $step)
                                    <tr data-id="{{ $step->id }}" data-name="{{ $step->name }}"
                                        data-deadline="{{ $step->deadline }}" data-status="{{ $step->status }}"
                                        data-status-readable="{{ __('status.'.$step->status) }}"
                                        data-person="{{ $step->person }}" data-start="{{ $step->start_date }}">
                                        <td>{{ $step->name }}</td>
                                        <td>{{ $step->start_date }}</td>
                                        <td>{{ $step->deadline }}</td>
                                        <td>{{ $step->person }}</td>
                                        <td>{{ __('status.'.$step->status) }}</td>
                                        @can('manage', $unit)
                                            <td>
                                                <a href="{{ route('step.update', $step->id) }}"
                                                   data-id="{{ $step->id }}" data-toggle="modal"
                                                   data-cell-id="{{ $cell->id }}"
                                                   data-target="#stepEdit">
                                                    <i class="fa fa-pencil-square-o mx-1" aria-hidden="true"></i>
                                                </a>
                                                <a class="step__delete" href="{{ route('step.destroy', $step->id) }}"
                                                   data-id="{{ $step->id }}"
                                                   data-toggle="modal" data-target="#destroyStep">
                                                    <i class="fa fa-trash mx-1 " aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="6">Пусто</td>
                                    </tr>
                                @endforelse
                            </table>
                            @can('manage', $unit)
                                <div class="w-100 mr-auto mt-4">
                                    <a href="#" data-cell-id="{{ $cell->id }}"
                                       class="add_step btn btn-primary ml-3" data-toggle="modal"
                                       data-target="#exampleModal">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        Добавить задачу
                                    </a>
                                </div>
                            @endcan
                            @if ($cell->files)
                                <div class="ml-3 mt-5">
                                    <h5 style="font-weight: bold">Прикрепленные файлы</h5>
                                    <ul>
                                        @foreach($cell->files as $file)
                                            <li>
                                                <a href="{{ asset('storage') . '/' .$file->source }}">{{ $file->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @empty
                        Пусто
                    @endforelse

                </div>
            </div>
        </div>
    </div>
    @if (Auth::check() && Auth::user()->getAccessLevel())
        @include('steps.create')
        @include('steps.destroy')
        @include('steps.edit')
    @endif

@endsection


