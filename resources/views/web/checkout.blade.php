@extends('web_component.main')
@section('content')

    <h2><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> รายการสั่งซื้อสินค้า</h2>

    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12 table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อผู้รับ</th>
                    <th>ราคาทั้งหมด</th>
                    <th>สถานะ</th>
                </tr>
                </thead>
                <tbody>
                @if($checkout->isEmpty())
                    <tr>
                        <td colspan="4" align="center">ยังไม่มีรายการใดๆ</td>
                    </tr>
                    @else
                @foreach($checkout as $r)
                    <tr onclick="checkoutDetail({{ $r->id or '' }})" style="cursor: pointer">
                        <td>{{ $r->id or '' }}</td>
                        <td>{{ $r->name or '' }}</td>
                        <td>{{ $r->total_cost or '' }}</td>
                        <td>{{ ($r->status == 1) ? 'รอการชำระ' : ($r->status == 2) ? 'รอยืนยันการชำระ' : 'รอการจัดส่ง'}}</td>
                    </tr>
                @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script type="application/javascript">

        function checkoutDetail(id) {
            window.location.href = '{{ url('checkout') }}/' + id;
        }

    </script>
@stop