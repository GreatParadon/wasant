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

        .gear img {
            width: 100%;
            margin-bottom: 30px;
            cursor: pointer;
        }

        .fit-image {
            object-fit: cover;
            /*max-height: 100%;*/
            /*width: auto;*/
            /*min-width: 100%;*/
            /*min-height: 100%;*/
        }

        .wrap-content {
            word-wrap: break-word;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <h1>GEAR</h1>
        </div>
    </div>

    <div class="row gear">
        @forelse($gears as $image)
            <div class="col-md-3 item gear">
                <img src="{{ asset('content/gear').'/'.$image->image }}" data-toggle="modal"
                     data-target="#image{{$image->id}}" height="200" class="fit-image">
                <div class="modal fade" id="image{{$image->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">{{ $image->title }}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ asset('content/gear').'/'.$image->image }}">
                                    </div>
                                    <div class="col-md-6 wrap-content">
                                        {!! $image->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <img src="{{ asset('resources/gear').'/gear.png' }}">
            </div>
        @endforelse
    </div>


@stop