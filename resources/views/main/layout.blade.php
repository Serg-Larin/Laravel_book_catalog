<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
</head>
<body>

<main role="main" style="min-height: 800px;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-item nav-link
                                    @if(url()->current() === route('main')) active @endif" href="{{route('main')}}">
                                        Главная <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link
                     @if(url()->current() === route('main.catalog')) active @endif
                                    " href="{{route('main.catalog')}}">
                                        Каталог <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <span class="navbar-text">
                <a href="{{route('book.index')}}" >
                    <div class="btn btn-outline-danger">
                        to Managenent
                    </div>
                </a>
            </span>
        </div>
    </nav>
{{--    <nav class="navbar navbar-expand-lg navbar-light bg-light">--}}
{{--        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">--}}
{{--            <div class="navbar-nav">--}}
{{--                <a class="nav-item nav-link--}}
{{--                @if(url()->current() === route('main')) active @endif" href="{{route('main')}}">--}}
{{--                    Главная <span class="sr-only">(current)</span></a>--}}
{{--                <a class="nav-item nav-link--}}
{{--                @if(url()->current() === route('main.catalog')) active @endif--}}
{{--                " href="{{route('main.catalog')}}">--}}
{{--                    Каталог <span class="sr-only">(current)</span></a>--}}
{{--            </div>--}}
{{--            <span class="navbar-text text-right">--}}
{{--                  Navbar text with an inline element--}}
{{--                </span>--}}
{{--        </div>--}}
{{--    </nav>--}}
    @yield('content')
</main>

<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">
                <i class="fas fa-4x fa-arrow-alt-circle-up" style="color: #ffe817;"></i>
            </a>
        </p>

    </div>
</footer>

<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>
</body>

</html>
