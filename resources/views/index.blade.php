<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Brights test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">

        <!-- Compiled and minified JavaScript -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>

    </head>
    <body>
    <div class="container">
        <nav>
            <div class="nav-wrapper">
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="{{url('/view-statistics')}}">Statistics</a></li>
                </ul>
            </div>
        </nav>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <form action="{{url('/post-urls')}}" method="post">
                    {{ csrf_field() }}
                    <label for="url-container">Input your URL`s:</label>
                    <textarea name="url-container" id="url-container" class="materialize-textarea"></textarea>

                    <input class="btn" type="submit" value="Get info">
                </form>

                @include('statistics')
            </div>
        </div>
    </div>
    </body>
</html>
