<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css" >
    <link rel="stylesheet" href="/css/app.css" >
    <script src="/js/main.js" defer></script>
    <script src="/js/app.js" defer></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <link href="https://css.gg/css?=|check|close|pen|add-r" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @include('components.routes')
    <title>@yield('title')</title>
</head>
<body>
    @yield('content')
</body>
</html>