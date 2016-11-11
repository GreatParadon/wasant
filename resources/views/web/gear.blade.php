@extends('web_component.main')
@section('content')

    <style>
        .wrapper {
            background-image: url('{{ asset('resources/gear/bg.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
        }

        .gear {
            padding-right: 100px;
            padding-left: 100px;
            margin-top: 30px;
            margin-bottom: 50px;
        }

        .gear div img {
            max-width: 100%;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <h1>GEAR</h1>
        </div>
    </div>
    <div class="row gear">
        <div class="col-md-12">
            <img src="{{ asset('resources/gear').'/gear.png' }}">
        </div>
    </div>


@stop