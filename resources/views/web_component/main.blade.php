<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Theme Made By www.w3schools.com - No Copyright -->
    <title>Wasant Studios</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

    <!-- Basic stylesheet -->
    <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.carousel.css') }}">

    <!-- Default Theme -->
    <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.theme.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <script src="{{ asset('plugins/owl-carousel/owl.carousel.js') }}"></script>

</head>
<body>

@include('web_component.header')

<div class="wrapper">
    <div class="container" id="container">
        @include('web_component.menu')
        @yield('content')
    </div>
</div>

@include('web_component.footer')

</body>

</html>