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
        }

        #owl-service .item img {
            display: block;
            width: 100%;
            margin-top: 50px;
            margin-bottom: 50px;
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
                <div class="col-md-12">
                    <div id="owl-service" class="owl-carousel owl-theme">
                        @if(isset($r->service_image))
                            @foreach($r->service_image as $image)
                                <div class="item">
                                    <img src="{{ asset('content/subcategory').'/'.$image->image }}">
                                </div>
                            @endforeach
                        @else
                            <div class="item">
                                <img src="{{ asset('resources/banner').'/header1.png' }}">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <script type="application/javascript">
        $(document).ready(function () {

            $("#owl-service").owlCarousel({
                slideSpeed: 200,
                paginationSpeed: 800,
                pagination: true,
                items : 3

            });

        });
    </script>

@stop