@extends('web_component.main')
@section('content')
    <h2>{{ $name }}</h2>
    <h4>What we offer</h4>
    <br>

    <div class="row ">
        @foreach($products as $product)
            <div class="col-sm-4" onclick="product('{{ $product->id }}')" style="cursor: pointer">
                <img src="{{ url('content/subcategory').'/'.$product->image }}" width="100px" height="100px">
                <h4>{{ $product->title }}</h4>

                <p>{{ $product->desc }}</p>
            </div>
        @endforeach
    </div>
    <script type="application/javascript">
        function product(product_id) {
            window.location.href = "{{ url('product') }}/" + product_id;
        }
    </script>
@stop