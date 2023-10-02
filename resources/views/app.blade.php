<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/spectre.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/spectre-exp.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/spectre-icons.css') }}">
    <style>
        html, body{
            width: 100%;
            height: 100%;
            margin: 0;
        }
    </style>
    @vite('resources/js/app.js')
    @inertiaHead
</head>
<body style="background-image: url('{{ asset('images/wallpaper.jpg') }}'); background-size: cover;
    background-repeat:   no-repeat;
    background-position: center center;  ">
@inertia
</body>
</html>
