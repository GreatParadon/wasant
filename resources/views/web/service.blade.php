@extends('web_component.main')
@section('content')

    <style>
        .wrapper {
            background-image: url('{{ asset('resources/map/bg.png') }}');
            background-size: cover;
            background-repeat: repeat;
            width: 100%;
            height: 100%;
        }

        .service-title {
            color: #ffffff;
            background-color: #1c2840;
            margin-top: 30px;
        }

        .item img {
            width: 100%;
            margin-top: 30px;
            cursor: pointer;
        }

        .modal-image {
            margin-top: -30px;
        }
    </style>

    @if(isset($service))
        @foreach($service as $r)
            <div class="row">
                <div class="col-md-3 service-title">
                    <h2>{{ $r->title or 'Service Title' }}</h2>
                </div>
            </div>
            <div class="row">
                @if(isset($r->service_image))
                    @foreach($r->service_image as $image)
                        <div class="col-md-3 item">
                            <img src="{{ asset('content/subcategory').'/'.$image->image }}" data-toggle="modal"
                                 data-target="#image{{$image->id}}">
                            <div class="modal fade" id="image{{$image->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">{{ $image->title }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 modal-image">
                                                    <img src="{{ asset('content/subcategory').'/'.$image->image }}">
                                                </div>
                                                <div class="col-md-6">
                                                    {!! $image->content !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-3 item">
                        <img src="{{ asset('resources/banner').'/header1.png' }}">
                    </div>
                @endif
            </div>
        @endforeach
    @endif

    <script>
        function detail(id) {

        }
    </script>

@stop