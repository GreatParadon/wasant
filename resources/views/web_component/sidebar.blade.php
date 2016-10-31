<table class="table table-hover table-bordered ">
    @if(isset($categories))
        <tr class="active">
            <th>
                ประเภทสินค้า
            </th>
        </tr>
        @foreach($categories as $category)
            <tr onclick="category({{ $category->id }})" style="cursor: pointer">
                <td>
                    <img src="{{ url('content/category').'/'.$category->image }}" width="30px" height="30px">
                    {{ $category->title }}
                </td>
            </tr>
        @endforeach
    @else
        <tr class="active">
            <th>
                จัดการสินค้า
            </th>
        </tr>
        @foreach(['checkout' => ['รายการสั่งซื้อสินค้า' , 'glyphicon glyphicon-list-alt'], 'cart' => ['ตระกร้าสินค้า','glyphicon glyphicon-shopping-cart'], 'user' => ['จัดการข้อมูลส่วนตัว','glyphicon glyphicon-user']] as $key => $val)
            <tr onclick="manageUrl('{{ $key or '' }}')" style="cursor: pointer">
                <td>
                    <span class="{{ $val[1] or '' }}" aria-hidden="true"></span> {{ $val[0] or '' }}
                </td>
            </tr>
        @endforeach
    @endif
</table>
<script type="application/javascript">
    function category(id) {
        window.location.href = "{{ url('category') }}/" + id;
    }
    function manageUrl(url) {
        console.log(url);
        window.location.href = "{{ url('') }}/" + url;
    }
</script>