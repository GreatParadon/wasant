<style>
    footer {
        background-color: #050412;
        color: #ffffff;
        bottom: 0;
        height: auto;
    }

    .footer-middle img {
        width: 40%;
        display: block;
        margin: 0 auto;
    }

    .footer-middle {
        text-align: center;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .footer-side {
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 60px;
        padding-right: 60px;
    }

    .footer-side a {
        font-size: 20px;
        color: #FFFFFF;
        display: block;
        margin-bottom: 20px;
    }

    .footer-side a:hover {
        color: #FFFFFF;
        text-decoration: none;
    }

    .footer-side a:visited {
        color: #FFFFFF;
        text-decoration: none;
    }

    .footer-side a:active {
        color: #FFFFFF;
        text-decoration: none;
    }

    .footer-side a:link {
        color: #FFFFFF;
        text-decoration: none;
    }
</style>
<footer class="container-fluid">
    <div class="row">
        <div class="col-md-4 footer-side">
            <h3>
                Wasant Studio
            </h3>
            <hr align="left" width="100%">
            <p>Wasant studio สาขา 1 เทเวศน์<br>
                88-90 ถนนประชาธิปไตย แขวงบางขุนพรหม เขตพระนคร กทม. 10200<br>
                โทร. 02-2826848 </p>
            <hr align="left" width="100%">
            <p>Wasant studio สาขา 2 หน้ามหาวิทยาลัยสยาม<br>
                85, 87 ถนนเพชรเกษม แขวงบางหว้า เขตภาษีเจริญ กทม. 10160<br>
                (ตรงข้ามมหาวิทยาลัยสยาม)
                โทร. 0-2868-9686-88</p>
            <hr align="left" width="100%">
            <p>Wasant studio สาขา 3 ท่าพระ<br>
                465-9 ถนนรัชดา-ท่าพระ แขวงบุคคโล เขตธนบุรี กทม 10600<br>
                โทร. 02-878 8988 / 090-984 8615</p>

        </div>
        <div class="col-md-4 footer-middle">
            <h4>" ทีมงานคุณภาพที่มี ประสบการณ์ ยาวนานกว่า 20 ปี "</h4>
            <img src="{{ asset('resources/header').'/logo.png' }}">
            <hr width="70%">
        </div>
        <div class="col-md-4 footer-side">
            <h3>
                Contact Us
            </h3>
            <hr align="left" width="80%">
            <a href="https://www.facebook.com/Wasant-Studio-517995318300074/?fref=ts"><img src="{{ asset('resources/footer').'/facebook.png' }}"> wasant studio</a>
            <a href="#"><img src="{{ asset('resources/footer').'/email.png' }}"> wasantstudio@hotmail.com</a>
            <a href="tel:+6628788988"><img src="{{ asset('resources/footer').'/call.png' }}"> @wasantstudio</a>
        </div>
    </div>
</footer>