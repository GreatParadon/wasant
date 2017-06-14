@extends('web_component.main')
@section('content')

    <style>
        body {
            background-image: url('{{ asset('resources/index/bg.png') }}');
            background-repeat: repeat;
        }

        #owl-promotion .item img {
            display: block;
            width: 100%;
        }

        footer {
            margin-top: 50px;
        }

        .content {
            margin-top: 50px;
        }

        .content div img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
        }

        .history {
            background-color: rgba(255, 255, 255, 0.8);
            position: absolute;
            top: 10%;
            left: 55%;
            right: 5%;
            bottom: 10%;
        }

        .history .one {
            display: block;
            width: 45%;
            margin: 0 auto 20px;
        }

        .promotion {
            background-color: rgba(255, 255, 255, 0.8);
            position: absolute;
            top: 15%;
            left: 15%;
            right: 15%;
            bottom: 15%;
            padding-right: 100px;
            padding-left: 100px;
        }

        .fit-image {
            object-fit: cover;
            /*max-height: 100%;*/
            /*width: auto;*/
            /*min-width: 100%;*/
            /*min-height: 100%;*/
        }

    </style>

    <div class="row content">
        <div class="col-md-12">
            <div id="owl-promotion" class="owl-carousel owl-theme">
                @forelse($promotion as $r)
                    <div class="item">

                        <img src="{{ asset('content/promotion').'/'.$r->image }}" height="380" class="fit-image">
                        <div class="row promotion hidden-sm hidden-xs" align="center">
                            <div class="col-md-12">
                                <h1>PROMOTION</h1>
                            </div>
                            <div class="col-md-12">
                                <h3>{{ $r->title or 'Promotion' }}</h3>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="item">

                        <img src="{{ asset('resources/banner/header1.png') }}" height="380" class="fit-image">
                        <div class="row promotion hidden-sm hidden-xs" align="center">
                            <div class="col-md-12">
                                <h1>PROMOTION</h1>
                            </div>
                            <div class="col-md-12">
                                <h3>No Promotion now</h3>
                            </div>
                        </div>
                    </div>

                @endforelse

            </div>
        </div>
    </div>

    <div class="row content">
        <div class="col-md-12">
            @if($info)
                <img src="{{ asset('content/info/'.$info->image) }}" width="1165" height="380" class="fit-image">
            @else
                <img src="{{ asset('resources/index/history.png') }}" width="1165" height="380" class="fit-image">
            @endif
            <div class="history">

                <div class="row one">
                    <div class="col-md-12">
                        <img src="{{ asset('resources/header').'/logo.png' }}">
                        <img src="{{ asset('resources/header').'/logo_name.png' }}">
                    </div>
                </div>
                <div class="row hidden-sm hidden-xs">
                    <div class="col-md-12" align="center">
                        <h4>{{ $info->title or '' }}</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="application/javascript">
        $(document).ready(function () {

            $("#owl-promotion").owlCarousel({
                slideSpeed: 200,
                paginationSpeed: 800,
                autoPlay: true,
                singleItem: true,
                pagination: false

            });

        });
    </script>
@stop