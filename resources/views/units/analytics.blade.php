@extends('layouts.default')

@section('content')

    <div class="container-fluid mt-5">
        <div class="row">
            <a href="{{ route('units.show', $unit->id) }}" class="ml-3 mb-3" style="font-size: 20px;">Назад</a>
            <div class="col-md-12" style="overflow: auto; margin-right: 20px;">
                <h2>Статистика по Направлениям</h2>

                <div class="years my-5 row">
                    <h4 class="ml-3 mr-2">Выберите год</h4>
                    <select name="year" id="year">
                        @foreach($years as $year)
                            <option value="{{ route('statistics', ['unit' => $unit->id, 'year' => $year]) }}"
                                {{ $year === $currentYear ? 'selected' : ''}}
                            >
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <table class=" table-bordered" width="100%">
                    <tr>
                        <th class="pl-2" style="min-width: 200px;">Отдел</th>

                        @foreach(['Январь', 'Февраль', 'Март',
                                        'Апрель', 'Май', 'Инюнь',
                                        'Июль', 'Август', 'Сентябрь',
                                        'Октябрь', 'Ноябрь', 'Декабрь'] as $month)

                            <th colspan="4" class="text-center">
                                <table width="100%">
                                    <tr>{{ $month }}</tr>
                                    <tr>
                                        <td style="border: none;">Визуализация
                                            <table width="100%">
                                                <tr>
                                                    <td style="border: none;">План</td>
                                                    <td style="border: none;">Факт</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="border: none;">Завершено
                                            <table width="100%">
                                                <tr>
                                                    <td style="border: none;">План</td>
                                                    <td style="border: none;">Факт</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </th>
                        @endforeach

                    </tr>

                    @foreach($unitsAnalytics as $departmentName => $departmentAnalytic)
                        <tr>
                            <td class="pl-2">{{ $departmentName }}</td>
                            @foreach($departmentAnalytic as $month => $statistic)
                                @foreach($template as $key => $value)
                                    <td width="70px" class="text-right">{{ $statistic[$key] }}</td>
                                @endforeach
                            @endforeach
                        </tr>
                    @endforeach

                </table>
            </div>
            @if($totalAnalytics)
                <div class="col-md-12 my-5">
                    <h4 class="mr-2">Большая математика</h4>

                    <table class=" table-bordered" width="100%">
                    <tr>
                        <th class="pl-2">По всем Системам</th>
                        <th>Всего</th>
                        <th>Коливество утвержденных визуализаций</th>
                        <th>Запланировано</th>
                        <th>В работе</th>
                        <th>Выполнено</th>
                    </tr>

                    @foreach($totalAnalytics as $companyName => $data)
                        <tr>
                            <td>{{ $companyName }}</td>
                            @foreach($data as $key => $value)
                                <td>{{ $value }}</td>
                            @endforeach
                        </tr>
                    @endforeach

                </table>
            </div>
            @endif
        </div>
    </div>
@endsection
