<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href=" {{ asset('home/css/bootstrap.css')}}"/>
    <!-- font awesome style -->
    <link href=" {{ asset('home/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href=" {{ asset('home/css/style.css')}}" rel="stylesheet"/>
    <!-- responsive style -->
    <link href=" {{ asset('home/css/responsive.css')}}" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<!-- header section strats -->
@include('home.layouts.header')
<!-- end header section -->
@yield('content')
<!-- footer start -->
@include('home.layouts.footer')
<!-- footer end -->

<!-- jQery -->
<script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
<!-- popper js -->
<script src="{{ asset('home/js/popper.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('home/js/bootstrap.js') }}"></script>
<!-- custom js -->
<script src="{{ asset('home/js/custom.js') }}"></script>
<script src="{{ asset('admin/assets/js/sweet-alert.js')}}"></script>
<script>
    @if(session('status'))
    {{--swal("{{session('status')}}", "{{session('statuscode')}}");--}}
    swal({
        title: "{{session('status')}}",
        // text: "You clicked the button!",
        icon: "{{session('statuscode')}}",
        button: "OK!",
    });
    @endif
</script>
@yield('scripts')
</body>
</html>
