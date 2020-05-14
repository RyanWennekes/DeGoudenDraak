<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>De Gouden Draak</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    <!-- Javascript -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div id="app">
    {{$user ?? ''}}
    <!-- Here we placed our Vue Component with the router-view -->
    <vue-app></vue-app>
</div>
</body>
</html>
