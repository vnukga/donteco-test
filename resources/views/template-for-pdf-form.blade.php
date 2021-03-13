<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Справка</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body class="antialiased">
<form method="post">
    @csrf
    <ul>
        <li>
            <label>
                Фамилия:
                <input type="text" name="surname">
            </label>
        </li>
        <li>
            <label>
                Имя:
                <input type="text" name="name">
            </label>
        </li>
        <li>
            <label>
                Отчество:
                <input type="text" name="second_name">
            </label>
        </li>
        <li>
            <label>
                Дата:
                <input type="date" name="date">
            </label>
        </li>
    </ul>
    <input type="submit" value="Сгенерировать справку">
</form>
</body>
</html>
