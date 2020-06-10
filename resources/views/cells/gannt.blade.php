@extends('layouts.default')

@section('content')
    <div class="container-fluid departments">
        @if($unit->logo)
            <div class="unit__logo">
                <img class="img-responsive" width="100px" height="100px"
                     src="{{ asset('storage') . $unit->logo->source }}">
            </div>
        @endif
        <div class="exitDiv">
            <a class="backBtn" href="{{ route('units.show', $unit->id) }}">
                <h5><i class="fas fa-undo-alt"></i>Назад</h5>
            </a>
        </div>

        <div class="row">
            <div class="col-12  sectionlistItems" style="margin-bottom: 50px;">

                @if($department)
                    <div class="my-5">
                        <select-list :options="{{ json_encode($unit->departments) }}"
                                     @on-change="changeDepartment($event)"
                                     :selected="{{ $department->id }}"
                        >
                        </select-list>
                    </div>

                    @if($department->blocks)
                        <div v-for="block in {{ json_encode($department->blocks)  }}">
                            <h3 class="my-5">@{{ block.name }}</h3>
                            <gantt-chart :active-block="block.id" />
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
@endsection

