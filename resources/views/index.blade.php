<!doctype html>
<!-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> -->
<html lang="zh-tw">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="minimum-scale=1, initial-scale=1, width=device-width" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blogging Map</title>

    <link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="root"></div>
    <script src="{{mix('js/app.js')}}"></script>
</body>

</html>
