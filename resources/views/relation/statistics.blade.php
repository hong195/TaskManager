@extends('layouts.default')

@section('content')

    <div class="container-fluid mt-5">
        <div class="row">
            <a href="{{ route('units.show', $unit->id) }}" class="ml-3 mb-3" style="font-size: 20px;">Назад</a>
            @if($unit->id === 1 || $unit->id == 2)
                <div class="col-md-12" style="overflow: auto">
                    <h2>Статистика Отделов</h2>

                    <table class=" table-bordered" width="100%">
                        <tr>
                            <th width="100" class="pl-2">Отдел</th>
                            @foreach($totalStat as $company => $data)
                                <th colspan="4" class="text-center">
                                    <table width="100%">
                                        <tr>{{ $company }}</tr>
                                        <tr>
                                            <td style="border: none;">В работе
                                                <table width="100%">
                                                    <tr>
                                                        <td style="border: none;">План</td>
                                                        <td style="border: none;">Факт</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="border: none;">В работе
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
                        @foreach($departments as $department)
                            <tr>
                                <td class="pl-2">{{ $department }}</td>
                                @foreach($totalStat as $company => $info)
                                    @foreach($info[$department] as $key => $data)
                                        <td width="70px" class="text-right">{{ $data['plan'] }}</td>
                                        <td width="70px" class="text-right">{{ $data['fact'] }}</td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-md-12" style="overflow: auto; margin: 50px 0 50px;">
                    <h2>Статистика компаний</h2>

                    <table class=" table-bordered" width="100%">
                        <tr>
                            <th width="100" class="pl-2">Отдел</th>
                            @foreach($companyStat as $mounth => $data)
                                <th colspan="4" class="text-center">
                                    <table width="100%">
                                        <tr>{{ $mounth }}</tr>
                                        <tr>
                                            <td style="border: none;">В работе
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
                        @foreach($companies as $companySlug => $companyName)
                            <tr>
                                <td class="pl-2">{{ $companyName }}</td>
                                @foreach($companyStat as $month => $data)
                                    <td width="70px" class="text-right">{{ $data[$companySlug]['in_progress'] }}</td>
                                    <td width="70px" class="text-right">{{ $data[$companySlug]['fact'] }}</td>
                                    <td width="70px" class="text-right">{{ $data[$companySlug]['in_progress'] }}</td>
                                    <td width="70px" class="text-right">{{ $data[$companySlug]['complete'] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <div class="col-md-12" style="overflow: auto; margin: 50px 0 50px;">
                    <h2>Статистика</h2>

                    <table class=" table-bordered" width="100%">
                        <tr>
                            <th width="100" class="pl-2">Отдел</th>
                            @foreach(array_keys($companyDepStat) as $key => $month)
                                <th colspan="4" class="text-center">
                                    <table width="100%">
                                        <tr>{{ $month }}</tr>
                                        <tr>
                                            <td style="border: none;">В работе
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
                        @php
                            $arr = array_pop($departments);
                        @endphp
                        @foreach($departments as $department)
                            <tr>
                                <td class="pl-2">{{ $department }}</td>
                                @foreach($companyDepStat as $month => $data)
{{--                                    @php--}}
{{--                                        dump($data)--}}
{{--                                            @endphp--}}
                                    <td width="70px" class="text-right">{{ $data[$department]['in_progress'] }}</td>
                                    <td width="70px" class="text-right">{{ $data[$department]['fact'] }}</td>
                                    <td width="70px" class="text-right">{{ $data[$department]['in_progress'] }}</td>
                                    <td width="70px" class="text-right">{{ $data[$department]['complete'] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
