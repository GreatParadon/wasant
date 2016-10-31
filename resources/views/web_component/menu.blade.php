<style>

    .navbar {
        background-color: #1c2840;
        margin-bottom: 20px;
        margin-top: 20px;
        text-align: center;
        border-radius: 0px;
        font-size: 20px;
    }

    .nav > li > a {
        border-radius: 0px;
        color: #FFFFFF;
        background-color: #1c2840;
        border-left: 3px solid #FFFFFF;
    }

    .nav > li > a:hover {
        color: #1c2840;
        background-color: #FFFFFF;
    }

    .nav > li > a:active {
        color: #1c2840;
        background-color: #FFFFFF;
    }

    .nav > li > a:focus {
        color: #1c2840;
        background-color: #FFFFFF;
    }

    .nav .open > a, .nav .open > a:focus, .nav .open > a:hover {
        /* background-color: #eee; */
        border-color: #1c2840;
    }

    .nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
        color: #1c2840;
        background-color: #FFFFFF;
    }

    .dropdown-menu {
        background-color: #1c2840;
        border-radius: 0px;
    }

    .dropdown-menu > li > a {
        color: #FFFFFF;
    }

    .dropdown-menu > li > a:hover {
        color: #1c2840;
        background-color: #FFFFFF;
    }

    .nav .open > a, .nav .open > a:focus, .nav .open > a:hover {
        color: #1c2840;
        background-color: #FFFFFF;
    }

    .wasant-menu-logo {
        background-color: #050318;
        float: left;
        color: #ffffff;
    }

</style>
<nav class="navbar wasant-menu">
    <ul class="nav nav-pills nav-justified">
        <li class="wasant-menu-logo">
            <img src="{{ asset('resources/menu/logo.png') }}">
        </li>
        <li><a href="/">Home</a></li>
        <li><a href="/service">Our Service</a></li>
        <li><a href="/great">Gears</a></li>
        <li><a href="/map">Maps</a></li>
        <li><a href="/contact">Contact Us</a></li>
    </ul>
</nav>