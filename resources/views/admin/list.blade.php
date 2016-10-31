@extends('layouts.app')
@section('htmlheader_title')
    {{ $page['title'] or '' }}
@stop
@section('content')

    <table class="table table-hover">
        <thead>
        <tr>
            @foreach($list_data as $list)
                <th>{{ $list['label'] }}</th>
            @endforeach
            @if($edit == true or $delete == true)
                <th>Option</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @if($select->isEmpty())
            <tr>
                <td colspan="@if($edit == true or $delete == true){{ count($list_data)+1 }}@else{{ count($list_data) }}@endif"
                    align="center"><a href="{{ $page['content'].'/create' }}">Add
                        new {{ $page['title'] }}</a></td>
            </tr>
        @else
            @foreach ($select as $r)
                <tr>
                    @foreach ($r['attributes'] as $key => $value)
                        <td>{!! $value !!}</td>
                    @endforeach
                    @if($edit == true or $delete == true)
                        <td>
                            @if($edit == true)
                                <a href="{{ $page['content'].'/'.$r->id .'/edit'}}">Edit</a>
                            @endif
                            @if($edit == true and $delete == true)
                                |
                            @endif
                            @if($delete == true)
                                <a onclick="deleteData({{ $r->id }})" style="cursor: pointer">Delete</a>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <script type="application/javascript">

        function deleteData(id) {
            var confirm = window.confirm('Are you sure to delete?');
            if (confirm == true) {
                $.ajax({
                    url: "{{ url('admin/'.$page['content']) }}/" + id,
                    type: "DELETE",
                    data: {_token: "{{ csrf_token() }}"},
                    success: function (result) {
                        alert(result.message);
                        location.reload();
                    },
                    error: function () {
                        location.reload();
                    }
                })
            }
        }

    </script>
@stop