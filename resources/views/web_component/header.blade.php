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
        width: 30%;
        height: auto;
    }

</style>

<div class="row">
    <div class="col-md-12">
        <div id="owl-index">
            @forelse(\App\Models\Banner::select('image')->where('active',1)->get() as $banner)
                <div class="item"><img src="{{ asset('content/banner/'.$banner->image) }}" height=500></div>
            @empty
                <div class="item"><img src="{{ asset('resources/banner').'/header1.png' }}" height=500></div>
            @endforelse
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
            autoPlay: true,
            singleItem: true,
            pagination: false

        });

    });
</script>