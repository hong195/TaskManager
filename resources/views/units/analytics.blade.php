@extends('layouts.default')

@section('content')

    <div class="container-fluid mt-5">
        <div class="row">
            <a href="{{ route('units.show', $unit->id) }}" class="ml-3 mb-3" style="font-size: 20px;">Назад</a>
            <div class="col-md-12" style="overflow: auto; margin-right: 20px;">
                <h2>Статистика по Направлениям</h2>

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
        </div>
    </div>
@endsection
