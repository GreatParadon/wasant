<style>

    #owl-demo .item img {
        display: block;
        width: 100%;
    }

    .wasant-logo {
        background-color: rgba(255,255,255, 0.5);
        position: absolute;
        top: 14%;
        left: 10%;
        right: 10%;
        padding-bottom: 25px;
    }

    .wasant-logo div img{
        display: block;
        margin: 0 auto;
    }

</style>

<div id="owl-demo" class="owl-carousel owl-theme">
    @foreach(['header1'] as $r)
        <div class="item"><img src="{{ asset('resources/banner').'/'.$r.'.png' }}"></div>
    @endforeach
</div>
<div class="row wasant-logo">
    <div class="col-md-12">
        <img src="{{ asset('resources/header').'/logo.png' }}">
    </div>
    <div class="col-md-12">
        <img src="{{ asset('resources/header').'/logo_name.png' }}">
    </div>
</div>

<script type="application/javascript">
    $(document).ready(function () {

        $("#owl-demo").owlCarousel({
            slideSpeed: 200,
            paginationSpeed: 800,
            singleItem: true,
            pagination: true

        });

    });
</script>