@extends('layouts.app')
@section('htmlheader_title')
    {{ $page['title'] or '' }}
@stop
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css"
          rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
    <form class="form-horizontal" role="form"
          action="@if(isset($select)){{ url('admin/'.$page['content'].'/'.$select->id) }}@else{{ url('admin/'.$page['content']) }}@endif"
          method="POST" enctype="multipart/form-data">
        @if(isset($select))
            {!! method_field('PUT') !!}
        @endif
        {{ csrf_field() }}
        <table class="table table-responsive table-hover no-border">
            @foreach($form_data as $form)
                <tr>
                    @if($form['type'] == 'image')
                        <td>
                            <label for="{{ $form['field'] or '' }}">{{ $form['label'] }}</label>
                            <input type="file" name="{{ $form['field'] or '' }}" id="{{ $form['field'] or '' }}"
                                   @if(isset($select)) @else @if($form['required'] == true) required @endif @endif>
                        </td>
                        <td id="{{ $form['field'] or '' }}_preview">
                            @if(isset($select))
                                <a href="{{ filePath($page['content'] , $select->{$form['field']}) }}"
                                   data-lightbox="{{ $page['content'] or '' }}"><img
                                            src="{{ filePath($page['content'] , $select->{$form['field']}) }}"
                                            style="width:100px"></a>
                            @endif
                        </td>
                        <script>
                            $(document).on('change', '#{{ $form['field'] or '' }}', function () {
                                var image = $("#{{ $form['field'] or '' }}");
                                var ext = image.val().split('.').pop().toLowerCase();
                                if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                                    alert('File extension are not allowed');
                                    image.val("");
                                    $("#{{ $form['field'] or '' }}_preview").empty();
                                    return false;
                                }

                                if (this.files && this.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $("#{{ $form['field'] or '' }}_preview").html('<a href="' + e.target.result + '" data-lightbox="image"><img src="' + e.target.result + '" style="width:100px"></a>');
                                    };

                                    reader.readAsDataURL(this.files[0]);
                                }
                            });
                        </script>
                    @elseif($form['type'] == 'vdo')
                        <td>
                            <label for="{{ $form['field'] or '' }}">{{ $form['label'] }}</label>
                            <input type="file" name="{{ $form['field'] or '' }}" id="{{ $form['field'] or '' }}"
                                   @if(isset($select)) @else @if($form['required'] == true) required @endif @endif>
                        </td>
                        <td id="{{ $form['field'] or '' }}_preview">
                            @if(isset($select))
                                <video width="320" height="240" controls>
                                    <source src="{{ filePath($page['content'] , $select->{$form['field']}) }}"
                                            type="video/mp4">
                                </video>
                            @endif
                        </td>
                        <script>
                            $(document).on('change', '#{{ $form['field'] or '' }}', function () {
                                var vdo = $("#{{ $form['field'] or '' }}");
                                var ext = image.val().split('.').pop().toLowerCase();
                                if ($.inArray(ext, ['mp4']) == -1) {
                                    alert('File extension are not allowed');
                                    vdo.val("");
                                    $("#{{ $form['field'] or '' }}_preview").empty();
                                    return false;
                                }

                                if (this.files && this.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $("#{{ $form['field'] or '' }}_preview").html('<video width="320" height="240" controls><source src="' + e.target.result + '" type="video/mp4"></video>');
                                    };

                                    reader.readAsDataURL(this.files[0]);
                                }
                            });
                        </script>
                    @else
                        <td colspan="2">
                            <label for="{{ $form['field'] or '' }}">{{ $form['label'] }}</label>
                            @if($form['type'] == 'textarea')
                                <textarea name="{{ $form['field'] or '' }}" id="{{ $form['field'] or '' }}"
                                          class="form-control input-group-sm"
                                          @if($form['required'] == true) required @endif>{{ $select->{$form['field']} or '' }}</textarea>
                            @elseif($form['type'] == 'checkbox')
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="{{ $form['field'] or '' }}"
                                               id="{{ $form['field'] or '' }}"
                                               @if(isset($select)) @if($select->{$form['field']} == 1) checked @endif @endif>Active
                                    </label>
                                </div>
                            @elseif($form['type'] == 'wysiwyg')
                                <textarea name="{{ $form['field'] or '' }}" id="{{ $form['field'] or '' }}"
                                          @if($form['required'] == true) required @endif class="form-control"
                                          rows="5">{!! $select->{$form['field']} or '' !!}</textarea>
                                <script>
                                    $('#{{ $form['field'] or '' }}').summernote({
                                        height: 500,
                                        callbacks: {
                                            onImageUpload: function (files) {
                                                var url = $(this).data('{{ $form['field'] or '' }}'); //path is defined as data attribute for  textarea
                                                console.log(url);
                                                sendFile(files[0], url, $(this));
                                            }
                                        }

                                    });
                                </script>
                            @elseif($form['type'] == 'select')

                                <select class="form-control input-group-sm" id="{{ $form['field'] or '' }}"
                                        name="{{ $form['field'] or '' }}">
                                    @foreach($form['option'] as $key => $val)
                                        <option value="{{ $key or '' }}"
                                                @if(isset($select)) @if($key == $select->{$form['field']}) selected @endif @endif>{{ $val or '' }}</option>
                                    @endforeach
                                </select>
                            @elseif($form['type'] == 'map')
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5lHJ78QZHKv7GUO2H8IcYyjhQ8DkfSPY"></script>
                                <script>
                                    var lat = '{{ $select->lat or '18.789167'}}';
                                    var lng = '{{ $select->lon or '98.985187'}}';
                                    var myCenter = new google.maps.LatLng(lat, lng);
                                    var map;
                                    var marker;

                                    function initialize() {
                                        var mapProp = {
                                            center: myCenter,
                                            zoom: 15,
                                            mapTypeId: google.maps.MapTypeId.ROADMAP
                                        };

                                        map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

                                        var marker = new google.maps.Marker({
                                            position: myCenter
                                        });

                                        marker.setMap(map);
                                        document.getElementById("lat").value = lat;
                                        document.getElementById("lon").value = lng;

                                        google.maps.event.addListener(map, 'click', function (event) {
                                            marker.setMap(null);
                                            placeMarker(event.latLng);
                                        });

                                        google.maps.event.addListener(marker, 'click', function () {
                                            marker.setMap(null);
                                            document.getElementById("lat").value = null;
                                            document.getElementById("lon").value = null;
                                        });
                                    }

                                    function placeMarker(location) {
                                        if (marker == null) {
                                            marker = new google.maps.Marker({
                                                position: location,
                                                map: map
                                            });
                                            document.getElementById("lat").value = location.lat();
                                            document.getElementById("lon").value = location.lng();
                                        } else {
                                            marker.setMap(null);
                                            document.getElementById("lat").value = null;
                                            document.getElementById("lon").value = null;
                                            marker = new google.maps.Marker({
                                                position: location,
                                                map: map
                                            });
                                            document.getElementById("lat").value = location.lat();
                                            document.getElementById("lon").value = location.lng();
                                        }
                                    }

                                    google.maps.event.addDomListener(window, 'load', initialize);
                                </script>
                                <input type="hidden" name="lat" id="lat" class="form-control input-group-sm"
                                       value="{{ $select->lat or '' }}">
                                <input type="hidden" name="lon" id="lon" class="form-control input-group-sm"
                                       value="{{ $select->lon or '' }}">
                                <div id="googleMap" style="width:100%;height:380px;"></div>
                            @elseif($form['type'] == 'color')
                                <input type="{{ $form['type'] or 'color' }}" name="{{ $form['field'] or '' }}"
                                       id="{{ $form['field'] or '' }}"
                                       value="{{ $select->{$form['field']} or '' }}"
                                       class="form-control input-group-sm"
                                       @if($form['required'] == true) required @endif>
                            @else
                                <input type="{{ $form['type'] or '' }}" name="{{ $form['field'] or '' }}"
                                       id="{{ $form['field'] or '' }}"
                                       value="{{ $select->{$form['field']} or '' }}"
                                       class="form-control input-group-sm" @if($form['required'] == true) required
                                       @endif
                                       @if( $form['field'] == 'id') readonly @endif>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
            <tr>
                <td colspan="2">
                    <input type="submit" value="Submit" class="btn btn-success pull-right margin-r-5">
                </td>
            </tr>
        </table>
    </form>
    <script>
        function sendFile(file, url, editor) {
            $("body").css("cursor", "progress");
            data = new FormData();
            data.append("file", file);
            data.append("_token", '{{ csrf_token() }}');
            $.ajax({
                data: data,
                type: "POST",
                url: "{{url('admin/wysiwyg_upload')}}",
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("body").css("cursor", "default");
                    if (data.success == true) {
                        editor.summernote('insertImage', data.filepath, function ($image) {
                            $image.css('width', '50%');
                            $image.attr('data-filename', data.filepath);
                        });
                    } else {
                        alert('Your image file are invalid, Please change your image!');
                    }
                }, error: function () {
                    alert('Your image file are invalid, Please change your image!');
                }
            });
        }
    </script>
@stop