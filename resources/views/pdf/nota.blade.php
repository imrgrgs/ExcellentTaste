<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <ul>
            <li>{{ $reservation->user->name }}</li>
            <li>{{ $reservation->user->address }}</li>
            <li>{{ $reservation->user->phone }}</li>
        </ul>
        <ul>
            <li>Excelent Taste</li>
            <li>Grote Markt 12, 8011 LW ZWOLLE</li>
            <li>06-346434</li>
        </ul>
        <ul>
            <li>Datum: {{ $reservation->date_string }}</li>
            <li>Start: {{ $reservation->tables->first()->start_time }}</li>
            <li>Start: {{ $reservation->tables->first()->end_time }}</li>
        </ul>
        <table>
            @foreach($reservation->orders as $order)
                <tr>
                    <td></td>
                </tr>
            @endforeach
        </table>
    </body>
</html>