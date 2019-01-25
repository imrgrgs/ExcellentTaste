<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        {{-- personal info --}}
        <ul>
            <li>{{ $reservation->user->name }}</li>
            <li>{{ $reservation->user->address }}</li>
            <li>{{ $reservation->user->phone }}</li>
        </ul>
        <ul>
            <li>Excellent Taste</li>
            <li>Grote Markt 12, 8011 LW ZWOLLE</li>
            <li>0591-272012</li>
        </ul>
        <ul>
            <li>Datum van reservering: {{ $reservation->date_string }}</li>
            <li>Starttijd: {{ $reservation->tables->first()->start_time }}</li>
            <li>Eindtijd: {{ $reservation->tables->first()->end_time }}</li>
        </ul>
        {{-- Reciept --}}
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Product</th>
              <th scope="col">Aantal</th>
              <th scope="col">Prijs per stuk</th>
              <th scope="col">Betaalt</th>
            </tr>
          </thead>
          <tbody>
            @foreach($reservation->orders as $order)
                    @foreach($order->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->amount }}</td>
                        <td>€ {{ number_format($product->pivot->payed/$product->pivot->amount, 2, ',', '.') }}</td>
                        <td>€ {{ number_format($product->pivot->payed, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
            @endforeach
            <tr>
                <td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td colspan="3">Totaal:</td><td>€ {{ number_format($reservation->total_price, 2, ',', '.') }}</td>
            </tr>
          </tbody>
        </table>
        
<style type="text/css">
    ul{
        list-style: none;
    }
    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table td, .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    table {
        display: table;
        border-collapse: separate;
        border-spacing: 2px;
        border-color: grey;
    }

    thead {
        display: table-header-group;
        vertical-align: middle;
        border-color: inherit;
    }

    th {
        text-align: inherit;
    }

    td, th {
        display: table-cell;
        vertical-align: inherit;
    }

    tbody {
        display: table-row-group;
        vertical-align: middle;
        border-color: inherit;
    }

    tr {
        display: table-row;
        vertical-align: inherit;
        border-color: inherit;
    }
</style>
    </body>
</html>