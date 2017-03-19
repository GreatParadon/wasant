<style>

    #owl-index .item img {
        display: block;
        width: 100%;
    }

    .wasant-logo {
        background-color: rgba(255, 255, 255, 0.8);
        position: absolute;
        top: 15%;
        left: 15%;
        right: 15%;
        bottom: 15%;
        padding-bottom: 25px;
    }

    .wasant-logo div img {
        display: block;
        margin: 0 auto;
        /*max-width: 100%;*/
        width: 30%;
        height: auto;
    }

</style>

<div class="row">
    <div class="col-md-12">
        <div id="owl-index">
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
    </div>
</div>

<script type="application/javascript">
    $(document).ready(function () {

        $("#owl-index").owlCarousel({
            slideSpeed: 200,
            paginationSpeed: 800,
            singleItem: true,
            pagination: true

        });

    });
</script>