<table class="table table-responsive table-hover no-border">
    <tr>
        <td>
            <form class="form-horizontal" role="form" {{--action="{{ url('admin/gallery') }}" --}}method="POST"
                  enctype="multipart/form-data" id="gallery_form">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="{{ $select->id or '' }}" readonly>
                <input type="file" name="gallery[]" id="gallery" required multiple>
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <div id="gallery_preview" class="row">
                @if($galleries['gallery']->isEmpty())
                    <div class="col-md-12">No any image file</div>
                @else
                    @foreach($galleries['gallery'] as $g)
                        <div class="col-md-3" id="{{ $g->id }}">
                            <img src="{{ $g->image }}" style="width:100px; cursor: pointer"
                                 onclick="deletePopUp('{{ $g->id }}')">
                        </div>
                    @endforeach
                @endif
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <button onclick="sendFile('{{ url('admin/gallery') }}')" class="btn btn-success pull-right margin-r-5">
                Submit
            </button>
        </td>
    </tr>
</table>

<script>

    function deletePopUp(id) {
        var confirm = window.confirm('Did you want to Delete this image ?');
        if (confirm == true) {
            $.ajax({
                url: '{{ url('admin/gallery') }}/' + id,
                data: {'_token': '{{ csrf_token() }}'},
                type: 'DELETE',
                success: function (result) {
                    alert(result.message);
                    $('#' + id).remove();
                }, error: function () {
                    alert('Delete Failed');
                }
            });
        }
    }

    function sendFile(url) {
        $("body").css("cursor", "progress");
        var form = $('form')[1]; // You need to use standart javascript object here
        var data = new FormData(form);
        data.append('gallery', $('input[type=file]')[0].files[0]);
        $.ajax({
            data: data,
            type: "POST",
            url: url,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("body").css("cursor", "default");
                alert(data.message);
            }, error: function () {
                alert('Your image file are invalid, Please change your image!');
            }
        });
    }

    $(document).on('change', '#gallery', function () {
        var image = $("#gallery");

        var ext = image.val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            alert('File extension are not allowed');
            image.val("");
            return false;
        }

//        $("#gallery_preview").empty();

        for (var i = 0; i < this.files.length; i++) {
            if (this.files && this.files[i]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#gallery_preview").append('<div class="col-md-3"><img src="' + e.target.result + '"  style="width:100px; cursor: pointer"></div>');
                };

                reader.readAsDataURL(this.files[i]);
            }
        }

    });
</script>