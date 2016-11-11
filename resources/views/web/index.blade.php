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
            margin: 0 auto;
            width: 45%;
            margin-bottom: 20px;
        }

        .promotion {
            background-color: rgba(255, 255, 255, 0.5);
            position: absolute;
            top: 15%;
            left: 15%;
            right: 15%;
            bottom: 15%;
            padding-right: 100px;
            padding-left: 100px;
        }

    </style>

    <div class="row content">
        <div class="col-md-12">
            <div id="owl-promotion" class="owl-carousel owl-theme">
                @if(isset($promotion))
                    @foreach($promotion as $r)
                        <div class="item">
                            <img src="{{ asset('content/promotion').'/'.$r->image }}">
                            <div class="row promotion  hidden-sm hidden-xs" align="center">
                                <div class="col-md-12">
                                    <h1>PROMOTION</h1>
                                </div>
                                <div class="col-md-12">
                                    <h3>{{ $r->title or 'Promotion Description' }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="item">
                        <img src="{{ asset('resources/banner').'/header1.png' }}">
                        <div class="row promotion" align="center">
                            <div class="col-md-12">
                                <h1>PROMOTION</h1>
                            </div>
                            <div class="col-md-12 hidden-sm hidden-xs">
                                <h3>Promotion Description</h3>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row content">
        <div class="col-md-12">
            <img src="{{ asset('resources/index/history.png') }}">
            <div class="history">

                <div class="row one">
                    <div class="col-md-12">
                        <img src="{{ asset('resources/header').'/logo.png' }}">
                        <img src="{{ asset('resources/header').'/logo_name.png' }}">
                    </div>
                </div>
                <div class="row hidden-sm hidden-xs">
                    <div class="col-md-12" align="center">
                        <h4>สตูดิโอถ่ายภาพชั้นนำของประเทศผู้เชี่ยวชาญด้านการถ่ายภาพ<br>
                            ครบวงจร ด้วยอุปกรณ์ครบครันทันสมัยพร้อมทีมงานคุณภาพที่มี<br>
                            ประสบการณ์ ยาวนานกว่า 20 ปี</h4>
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
                singleItem: true,
                pagination: true

            });

        });
    </script>
@stop