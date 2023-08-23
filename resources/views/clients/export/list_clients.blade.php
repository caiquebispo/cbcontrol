<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Clientes</title>

    <style>
        table {
            width:100%;
            font-family:sans-serif;
            border-collapse: collapse;
            font-size: 70%;

        }

        td, thead {
            border: 1px solid black;
            text-align: center;
        }
        thead, th {
            border: 1px solid black;
            background-color: #0080c1;
            text-align: center;
            color: white;
        }
        @page {
            margin: 10px 5px;
        }

    </style>

</head>

<body>

<div style="width: 95%; margin: 0 auto;">
{{--    <div style="width: 10%; float:left; margin-right: 20px;">--}}
{{--        <img src="{{ public_path('img/logo/cb-logo.png') }}" width="100%"  alt="">--}}
{{--    </div>--}}
{{--    <div style="width: 50%; float: left;">--}}
{{--        <h1>Relação de Clientes</h1>--}}
{{--    </div>--}}
</div>

<table>
    <thead>
    <tr>
        <th>CLIENTE</th>
        <th>TELEFONE</th>
        <th>VALOR</th>
        <th>LOCAL</th>
        <th>PAGAMENTO</th>
        <th>ENTREGA</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($clients as $client)
        <tr>
            <td>{{ $client->full_name }}</td>
            <td>{{ $client->number_phone }}</td>
            <td>R$ {{ number_format($client->value, 2,'.',',')}}</td>
            <td>{{ $client->local }}</td>
            <td>{{ $client->payment_method }}</td>
            <td>{{ $client->delivery }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<script type="text/php">
    if (isset($pdf)) {

    $text = "{PAGE_NUM}/{PAGE_COUNT}";
    $font = null;
    $size = 10;
    $color = array(0, 0, 0);
    $word_space = 0.0;
    $char_space = 0.0;
    $angle = 0.0;
    $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
  }
</script>
</body>

</html>
