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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d242.26111293771064!2d100.48185900590298!3d13.707678492447792!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDQyJzI3LjciTiAxMDDCsDI4JzU1LjMiRQ!5e0!3m2!1sen!2sth!4v1478798416381"
                    frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>


@stop