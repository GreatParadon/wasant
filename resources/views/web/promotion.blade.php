@extends('web_component.main')
@section('content')
    <h2>PROMOTION : {{ $promotion->title }}</h2>

    <div class="row">
        <div class="col-sm-12">
            {!! $promotion->content !!}
        </div>
    </div>
@stop