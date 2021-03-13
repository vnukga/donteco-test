<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Справка</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        .container {
            width: 1024px;
        }

        .container-title {
            margin-left: 480px;
        }

        .container-name {
            min-width: 700px;
            border-bottom: 2px solid black;
        }
    </style>
</head>
<body class="antialiased">
<div class="container">
    <h1 class="container-title">Справка</h1>
    <h3>
        Пользователь: <span class="container-name">{{$surname}} {{$name}} {{$secondName}}</span>.
        <br>
        Данная справка подтверждает работу сервиса генерации PDF.
    </h3>
    <br>
    <h4>
        <span class="container-date">Дата: {{$date}}</span>
        <span class="container-barcode"></span>
    </h4>
</div>
</body>
</html>
