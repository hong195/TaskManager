@extends('layouts.default')
@section('content')
    <div class="allBox container-fluid">
        @if($unit->logo)
            <div class="unit__logo">
                <img class="img-responsive" width="100px" height="100px" src="{{ asset('storage') . $unit->logo->source }}">
            </div>
        @endif
        <div class="row wrapper">
            <div class="sectionlistItems col-4">
                @foreach($sections as $k => $section)
                    <div class="staticList
                    <?php echo $k === 0 ? 'active' : '';
                          echo $section->type === 'system' ? 'system' : ''
                    ?>
                    ">
                        @if ($section->type === 'system')
                            <a  href="{{ route('departments', $unit->id) }}"
                                style="text-decoration:none"
                                id="system"
                            >
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

                </div>
            </div>
        </div>
    </div>
@endsection
<script>
  function getFile(sectionId, unitId){
    jQuery.ajax({
      type: 'POST',
      url: '/getDataBySection',
      data:
          {
            'sectionId': sectionId,
            'unitId': unitId,
          },
      success: function (data) {
        $('.secondBlock').html(data);
        $("#lightgallery").lightGallery();
      },
      error: (error) => {
        console.log(error)
      }
    });
  }
  window.onload = function(){
    getFile( {{ $active_section }}, {{ $unit->id }})
  }
</script>








