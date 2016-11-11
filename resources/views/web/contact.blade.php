@extends('web_component.main')
@section('content')

    <style>
        .wrapper {
            background-image: url('{{ asset('resources/contact/bg.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
        }

        .contact {
            padding-right: 100px;
            padding-left: 100px;
        }

        .contact .col-md-6{
            margin-bottom: 50px;
        }

        .contact-desc {
            margin-top: 22px;
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
        }

        .contact-wasant-logo {
            display: block;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .contact-wasant-logo img{
            width: 50%;

        }

    </style>

    <div class="row">
        <div class="col-md-12" align="center">
            <h1>CONTACT US</h1>
        </div>
    </div>
    <div class="row contact">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">ชื่อของคุณ</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="">
            </div>
            <div class="form-group">
                <label for="email">อีเมลล์ของคุณ</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="">
            </div>
            <div class="form-group">
                <label for="tel">เบอร์ติดต่อกลับ</label>
                <input type="text" class="form-control" id="tel" name="tel" placeholder="">
            </div>
            <div class="form-group">
                <label for="topic">หัวข้อ</label>
                <input type="text" class="form-control" id="topic" name="topic" placeholder="">
            </div>
            <div class="form-group">
                <label for="message">ข้อวามของคุณ</label>
                <textarea class="form-control" id="message" name="message" rows="6"></textarea>
            </div>
            <button type="submit" id="submit_button" class="btn btn-default">ยืนยัน</button>
        </div>
        <div class="col-md-6 contact-desc">
            <div class="contact-wasant-logo">
                <img src="{{ asset('resources/header').'/logo.png' }}">
                <img src="{{ asset('resources/header').'/logo_name.png' }}">
            </div>
            <p>
                Wasant studio สาขา 1 เทเวศน์<br>
                88-90 ถนนประชาธิปไตย แขวงบางขุนพรหม เขตพระนคร กทม. 10200<br>
                โทร. 02-2826848<br>
                <br>
                Wasant studio สาขา 2 หน้ามหาวิทยาลัยสยาม<br>
                85, 87 ถนนเพชรเกษม แขวงบางหว้า เขตภาษีเจริญ กทม. 10160<br>
                (ตรงข้ามมหาวิทยาลัยสยาม)<br>
                โทร. 0-2868-9686-88<br>
                <br>
                Wasant studio สาขา 3 ท่าพระ<br>
                465-9 ถนนรัชดา-ท่าพระ แขวงบุคคโล เขตธนบุรี กทม 10600<br>
                โทร. 02-878 8988 / 090-984 8615<br>

            </p>
        </div>
    </div>

    <script type="application/javascript">
        $("#submit_button").click(function () {
            $.ajax({
                url: '{{ url('store') }}',
                type: 'POST',
                data: {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    tel: $("#tel").val(),
                    topic: $("#topic").val(),
                    message: $("#message").val(),
                    _token: '{{ csrf_token() }}'
                }
            });
            alert('เราจะติดต่อกลับไปทางอีเมลค่ะ ขอบคุณค่ะ');
            window.location.href = '{{ url('') }}';
        })
    </script>


@stop