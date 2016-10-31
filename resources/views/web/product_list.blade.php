@extends('web_component.main')
@section('content')
    <h2>{{ $name or '' }}</h2>
    <h4>
        {{ $desc or '' }}
    </h4>
    <hr>

    <div class="row  text-center">
        @foreach($products as $product)
            <div class="col-sm-2" onclick="product('{{ $product->id }}')" style="cursor: pointer">
                <img src="{{ url('content/subcategory').'/'.$product->image }}" width="100px" height="100px">
                <br>
                <b>{{ $product->title }}</b>

            </div>
        @endforeach
    </div>
    <script type="application/javascript">
        function product(id) {
            window.location.href = "{{ url('product') }}/" + id;
        }
    </script>
@stop