<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>{{$title}}</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="{{ URL::asset('assets/cms/images/favicon.png')}}">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        @yield('css')
        
        <link href="{{ URL::asset('assets/cms/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/cms/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/cms/css/style.css')}}" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div id="wrapper">
            @yield('content')

            <!-- jQuery  -->
            <script src="{{ URL::asset('assets/cms/js/jquery.min.js')}}"></script>
            <script src="{{ URL::asset('assets/cms/js/bootstrap.bundle.min.js')}}"></script>

            <!-- App js -->
            <script src="{{ URL::asset('assets/cms/js/app.js')}}"></script>

        </div>
</body>
</html>