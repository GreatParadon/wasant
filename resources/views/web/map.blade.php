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

        .map {
            margin-top: 30px;
            margin-bottom: 50px;
        }

        .map div iframe {
            width: 100%;
            height: 480px;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <h1>MAP</h1>
        </div>
    </div>
    <div class="row map">
        <div class="col-md-12">
            <h2>วสันต์ โฟโต้</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d242.26151824498146!2d100.48198249157562!3d13.707285495064662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29862323b5e91%3A0x2e809243be30313d!2z4Lin4Liq4Lix4LiZ4LiV4LmMIOC5guC4n-C5guC4leC5iSBLaHdhZW5nIEJ1a2toYWxvLCBLaGV0IFRob24gQnVyaSwgS3J1bmcgVGhlcCBNYWhhIE5ha2hvbiAxMDYwMCwgVGhhaWxhbmQ!5e0!3m2!1sen!2s!4v1495713280011"
                    frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
    <div class="row map">
        <div class="col-md-12">
            <h2>วสันต์ สตูดิโอ</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62006.5799001331!2d100.44245810836294!3d13.754055978484782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2983ce3c65b01%3A0x271d6e80630e2b92!2sWasan+Studio!5e0!3m2!1sen!2s!4v1495713410788"
                    frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
    <div class="row map">
        <div class="col-md-12">
            <h2>บริษัท วสันต์ สตูดิโอ จำกัด</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15500.946286248936!2d100.5057295!3d13.7646023!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd22f8d013ce55148!2sWasan+Studio!5e0!3m2!1sen!2sth!4v1495713450955"
                    frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>


@stop