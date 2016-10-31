@extends('layouts.app')
@section('content')
    <link href="{{ asset("sortable/css/app.css")}}" rel="stylesheet" type="text/css"/>
    <style>
        #sortsort {
            height: 40px;
        }
    </style>

    <div>
        <a onclick="sort()" class="btn btn-success">Save Sort</a>
    </div>

    <br>

    <ol class="serialization vertical">
        @foreach ($select as $r)
            <li data-id="{{ $r->id }}" id="sortsort">
                <div class="row">
                @foreach ($r['attributes'] as $key => $value)
                    <div class="col-md-2"><b>{!! $value !!}</b></div>
                @endforeach
                </div>
            </li>
        @endforeach
    </ol>

    <script src="{{ asset("sortable/js/jquery-sortable.js")}}" type="text/javascript"></script>

    <script type="text/javascript">
        var group = $("ol.serialization").sortable({
            group: 'serialization',
            onDrop: function ($item, container, _super) {
                _super($item, container);
            }
        });

        function sort() {
            var confirm = window.confirm('Are you sure to Sort?');
            if (confirm == true) {
                var data = group.sortable("serialize").get();

                $.ajax({
                    url: "{{ url('admin/'. $page['content'] .'/sort') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        data: data[0]
                    },
                    success: function (result) {
                        if (result.success == true) {
                            alert(result.message);
                        } else {
                            alert(result.message);
                        }

                    },
                    error: function () {
                        alert('failed');
                    }
                });
            }
        }

    </script>
@stop