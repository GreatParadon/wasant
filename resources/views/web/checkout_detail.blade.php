@extends('web_component.main')
@section('content')

    <h2><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> รายการสั่งซื้อสินค้า
        : {{ $checkout->id or '' }}</h2>

    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-8 table-responsive">
            <table class="table">
                <tr>
                    <th>รหัส :</th>
                    <td>{{ $checkout->id or '' }}</td>
                </tr>
                <tr>
                    <th>ชื่อผู้รับ :</th>
                    <td>{{ $checkout->name or '' }}</td>
                </tr>
                <tr>
                    <th>ที่อยู่ผู้รับ :</th>
                    <td>{{ $checkout->address or '' }}</td>
                </tr>
                <tr>
                    <th>ราคารวม :</th>
                    <td>{{ $checkout->total_cost or '' }} บาท</td>
                </tr>
                <tr>
                    <th>สถานะ :</th>
                    <td>{{ ($checkout->status == 1) ? 'รอการชำระ' : ($checkout->status == 2) ? 'รอยืนยันการชำระ' : 'รอการจัดส่ง'}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-4 table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th colspan="2">
                        แจ้งชำระเงิน
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="2">
                        <textarea class="form-control" id="transfer_detail" rows="4"
                                  placeholder="รายละเอียดการชำระ">{{ $checkout->transfer_detail or '' }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-success pull-right"
                                onclick="checkoutProductCart({{ $checkout->id or '' }})">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                            ยืนยัน
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12 table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>รูปสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                </tr>
                </thead>
                <tbody>
                @foreach($product_cart as $r)
                    <tr>
                        <td>{{ $r->id or '' }}</td>
                        <td><img src="{{ url('content/subcategory').'/'.$r->image }}" width="75" height="75"></td>
                        <td>{{ $r->title or '' }}</td>
                        <td>
                            {{ number_format($r->cost * $r->pieces,2) }} บาท
                        </td>
                        <td>
                            {{ $r->pieces or '' }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script type="application/javascript">
        function checkoutProductCart(id) {
            var confirm = window.confirm('ยืนยันสินค้าหรือไม่ ?');
            if (confirm == true) {
                $.ajax({
                    url: '{{ url('checkout') }}/' + id,
                    type: 'POST',
                    data: {
                        transfer_detail: $("#transfer_detail").val(),
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
    </script>
@stop