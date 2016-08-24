<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <title>{{ $article->title }} - Wait But Why Reader</title>
        <link href='https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
        <link href='/css/master.css' rel='stylesheet' type='text/css'>
    </head>
    <body>
        @include('analytics')
        <main class="container">
            @yield('content')
        </main>

        <script src="/js/master.js" charset="utf-8"></script>
    </body>
</html>
