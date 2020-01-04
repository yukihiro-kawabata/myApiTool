<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        {{-- <link rel="stylesheet" href="{{ asset('/library/musubii/dist/musubii.min.css') }}" /> --}}

        <?php // bootstrap, ver 3 ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">API Tool</a>
                </div>
                
                <div class="collapse navbar-collapse" id="navbarEexample1">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/regist/index') }}">regist</a></li>
                        <li><a href="{{ url('/doc') }}">document</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('body')
    </body>
</html>

