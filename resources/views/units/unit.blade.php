@extends('layouts.default')
@section('content')
    <div class="allBox container-fluid">
        <div class="unit__logo">
            <img class="img-responsive" width="100px" height="100px" src="{{ asset('storage') . $unit->logo->source }}">
        </div>
        <div class="row wrapper">
            <div class="sectionlistItems col-4">
                @foreach($sections as $section)
                    <div class="staticList
                    <?php echo $section->type === 'term' ? 'active' : '';
                          echo $section->type === 'system' ? 'system' : ''
                    ?>
                    ">
                        @if ($section->type === 'system')
                            <a  href="{{ route('unit.systems', $unit->id) }}"
                                style="text-decoration:none"
                                id="system"
                            >
                                <i class="{{$section->icon_code}}"></i>
                                {{ $section->name }}
                            </a>
                        @elseif($section->type === 'term')
                            <a class="link active item" onclick="getTerm({{$section->id}}, {{$unit->id}})" href="#">
                                <i class="{{$section->icon_code}}"></i>
                                {{ $section->name }}
                            </a>
                        @else
                            <a class="link" onclick="getFile({{$section->id}}, {{$unit->id}})" href="#">
                                <i class="{{$section->icon_code}}"></i>
                                {{ $section->name }}
                            </a>
                        @endif
                    </div>
                @endforeach
                <div class="exitDiv">
                    <a class="backBtn" href="/units">
                        <h5><i class="fas fa-undo-alt"></i> Назад к выбору BU</h5>
                    </a>
                </div>
            </div>
            <div class="col-8 d-flex align-items-center justify-content-center">
                <div class="secondBlock wrapper">
                    @include('terms.index')
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
  function getFile(sectionId, unitId){
    $.ajax({
      type: 'POST',
      url: '/getDataBySection',
      data:
          {
            'sectionId': sectionId,
            'unitId': unitId,
          },
      success: function (data) {
        $('.secondBlock').html(data);
      },
      error: (error) => {
        console.log(error)
      }
    });
  }
  function getTerm(sectionId, unitId){
    $.ajax({
      type: 'GET',
      url: "{{  route('term.index') }}" ,
      data:
          {
            'sectionId': sectionId,
            'unitId': unitId,
          },
      success: function (data) {
        $('.secondBlock').html(data);
      },
      error: (error) => {
        console.log(error)
      }
    });
  }
</script>








