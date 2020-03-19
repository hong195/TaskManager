<style>
    .linkDepartments {
        border: 1px solid #c4c4c4;
        margin: 15px 0 15px 0;
        border-radius: 5px;
        max-width: 320px;
        background-color: #67b437;
        padding-left: 5px;
        font-size: 1.8em;
        max-width: 98%;
    }

    .linkDepartments a {
        color: white;
    }

    .secondBlock {
        border: 2px solid red;
    }

    .depPanel {
        margin: auto;
        /*margin-right: 10px;*/
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-4 depPanel">
            @foreach($departments as $one)
                <div class="linkDepartments">
                    <a style="text-decoration: none" href="#" onclick="getBlock({{$one->id}})"><i
                            class="fab fa-steam-square"></i> {{($one->name)}}</a> <br>
                </div>
            @endforeach
        </div>
        <div class=" secondBlock col-8">
            foo
        </div>
    </div>

    <script>
        function getBlock(dep_id) {
            $.ajax({
                type: 'POST',
                url: '/ajaxblocks',
                data:
                    {
                        'id': dep_id
                    },
                success: function (data) {
                    event.preventDefault();
                    console.log($('.secondBlock'));
                    $('.secondBlock').html(data);
                }
            });
        }
    </script>
</div>
