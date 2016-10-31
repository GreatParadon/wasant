@extends('web_component.main')
@section('content')

    <h2><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> ตระกร้าสินค้า</h2>

    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-8 table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>รูปสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                    <th>ลบ</th>
                </tr>
                </thead>
                <tbody>
                @if($product_cart->isEmpty())
                    <tr>
                        <td colspan="6" align="center">ยังไม่มีสินค้าในตระกร้า</td>
                    </tr>
                @else
                    @foreach($product_cart as $r)
                        <tr>
                            <td>{{ $r->id or '' }}</td>
                            <td><img src="{{ url('content/subcategory').'/'.$r->image }}" width="75" height="75"></td>
                            <td>{{ $r->title or '' }}</td>
                            <td id="total_product_cost_{{ $r->id or '' }}">
                                {{ number_format($r->cost * $r->pieces,2) }} บาท
                            </td>
                            <td>
                                <input type="number" id="pieces_{{ $r->id or '' }}" class="form-control" min="1"
                                       value="{{ $r->pieces or '' }}"
                                       style="width: 65px" onchange="changePieces('{{ $r->id or '' }}')">
                            </td>
                            <td>
                                <a href="#" onclick="deleteProductCart('{{ $r->id or '' }}')">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-4 table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th colspan="2">
                        ยืนยันการใช้สินค้า
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="2">
                        <input type="text" class="form-control" id="customer_name" placeholder="ชื่อผู้สั่ง" value="{{ App\Models\WebUser::find(Session::get('user_id'))->name }}">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea class="form-control" id="owner_address" rows="4" placeholder="ที่อยู่จัดส่ง">{{ App\Models\WebUser::find(Session::get('user_id'))->address }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td id="total"><b>ราคาทั้งหมด</b><br>{{ number_format($total,2) }} บาท</td>
                    <td>
                        <button type="button" class="btn btn-success pull-right" onclick="checkoutProductCart()">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                            ยืนยัน
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script type="application/javascript">
        function changePieces(id) {
            var pieces = $("#pieces_" + id).val();
            $.ajax({
                url: '{{ url('changepieces') }}',
                type: 'POST',
                data: {
                    id: id,
                    pieces: pieces,
                    _token: '{{ csrf_token() }}'
                },
                success: function (result) {
                    $("#total_product_cost_" + id).html(result.total_product_cost + ' บาท');
                    $("#total").html('<b>ราคาทั้งหมด</b><br>' + result.total + ' บาท');
                }, error: function () {
                    alert('ลบไม่สำเร็จ');
                }
            })
        }

        function deleteProductCart(id) {
            var confirm = window.confirm('คุณแน่ใจที่จะลบหรือไม่ ?');
            if (confirm == true) {
                $.ajax({
                    url: '{{ url('productcart') }}/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (result) {
                        if (result.success == true) {
                            alert(result.message);
                            location.reload();
                        } else {
                            alert(result.message);
                        }
                    }, error: function () {
                        alert('ลบไม่สำเร็จ');
                    }
                })
            }
        }

        function checkoutProductCart() {
            var confirm = window.confirm('ยืนยันสินค้าหรือไม่ ?');
            if (confirm == true) {
                $.ajax({
                    url: '{{ url('checkoutcart') }}',
                    type: 'POST',
                    data: {
                        name: $("#customer_name").val(),
                        address: $("#owner_address").val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (result) {
                        if (result.success == true) {
                            alert(result.message);
                            window.location.href = "{{ url('checkout') }}/" + result.checkout_id;
                        } else {
                            alert(result.message);
                        }
                    }, error: function () {
                        alert('ลบไม่สำเร็จ');
                    }
                })
            }
        }
    </script>
@stop