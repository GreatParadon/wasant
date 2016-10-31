@extends('web_component.main')
@section('content')
    <h2>ติดต่อเรา</h2>

    <div class="row">
        <div class="col-sm-12">
            <form action="{{ url('user') }}" method="POST">
                <table class="table">
                    <tr>
                        <td><label for="email">อีเมลล์</label>
                            <input class="form-control" id="email"
                                   name="email"
                                   type="email" value="{{ $user->email or '' }}">
                            {{ csrf_field() }}
                        </td>
                    </tr>
                    <tr>
                        <td><label for="name">ชื่อ</label>
                            <input class="form-control" id="name" name="name"
                                   type="text" value="{{ $user->name or '' }}"></td>
                    </tr>
                    <tr>
                        <td><label for="address">ที่อยู่</label>
                            <textarea class="form-control" id="address"
                                      name="address">{{ $user->address or '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="tel">เบอร์โทร</label>
                            <input class="form-control" id="tel" name="tel"
                                   type="tel" value="{{ $user->tel or '' }}"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="บันทึก" class="btn btn-success pull-right"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@stop