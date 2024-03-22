<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Clientes</title>

    <style>
        table {
            width: 100%;
            font-family: sans-serif;
            border-collapse: collapse;
            font-size: 75%;

        }

        td,
        thead {
            border: 1px solid black;
            text-align: center;
        }

        thead,
        th {
            border: 1px solid black;
            background-color: #0080c1;
            text-align: center;
            color: white;
        }

        @page {
            margin: 10px 10px;
        }
    </style>

</head>

<body>
    <div>
        <p style="text-align:center; font-size: 1.2rem">RDS - Resumo diário de vendas:
            {{ (new Datetime('now'))->format('d/m/Y h:i:s') }}</p>
        <p style="text-align:center; font-size: 1.1rem; margin-top: -15px">Empresa:
            {{ auth()->user()->company->corporate_reason }} - Usuário: {{ auth()->user()->name }}</p>
    </div>
    <div>
        <p style="text-align:center; font-size: 1.1rem; font-weight: bold;">Relação dos Produtos</p>
        <table>
            <thead>
                <tr>
                    <th>PRODUTO</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($summary['summary_products'] as $product)
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>R$ {{ number_format($product['price'], 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @php
                        $total = 0;
                        $qt = 0;
                        foreach ($summary['summary_products'] as $product) {
                            $total += $product['price'];
                            $qt += $product['quantity'];
                        }
                    @endphp
                    <td>TOTAL</td>
                    <td>{{ $qt }}</td>
                    <td>R$ {{ number_format($total, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>
        <p style="text-align:center; font-size: 1.1rem; font-weight: bold;">Relação de produtos por vendedores</p>
        <table>
            <thead>
                <tr>
                    <th>VENDEDOR</th>
                    <th>PRODUTO</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($summary['summary_sellers'] as $product)
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['product'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>R$ {{ number_format($product['price'], 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @php
                        $total = 0;
                        $qt = 0;
                        foreach ($summary['summary_sellers'] as $product) {
                            $total += $product['price'];
                            $qt += $product['quantity'];
                        }
                    @endphp
                    <td>TOTAL</td>
                    <td>-</td>
                    <td>{{ $qt }}</td>
                    <td>R$ {{ number_format($total, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>
        <p style="text-align:center; font-size: 1.1rem; font-weight: bold;">Relação de produtos por clientes</p>
        <table>
            <thead>
                <tr>
                    <th>Clientes</th>
                    <th>PRODUTO</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($summary['summary_clients'] as $product)
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['product'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>R$ {{ number_format($product['price'], 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @php
                        $total = 0;
                        $qt = 0;
                        foreach ($summary['summary_clients'] as $product) {
                            $total += $product['price'];
                            $qt += $product['quantity'];
                        }
                    @endphp
                    <td>TOTAL</td>
                    <td>-</td>
                    <td>{{ $qt }}</td>
                    <td>R$ {{ number_format($total, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>
        <p style="text-align:center; font-size: 1.1rem; font-weight: bold;">Relação de Recebidos</p>
        <table>
            <thead>
                <tr>
                    <th>Clientes</th>
                    <th>Vendedor</th>
                    <th>D/COMPRA</th>
                    <th>D/PAGAMENTO</th>
                    <th>QUEM RECEBEU</th>
                    <th>VALOR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($summary['summary_received'] as $product)
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['seller'] }}</td>
                        <td>{{ $product['date'] }}</td>
                        <td>{{ $product['duet_day'] }}</td>
                        <td>{{ $product['received_name'] }}</td>
                        <td>{{ $product['value'] }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @php
                        $total = 0;
                        foreach ($summary['summary_received'] as $product) {
                            $total += str_replace(
                                ',',
                                '.',
                                str_replace('.', '', str_replace('R$ ', '', $product['value'])),
                            );
                        }
                    @endphp
                    <td>TOTAL</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>R$ {{ number_format($total, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>
        <p style="text-align:center; font-size: 1.1rem; font-weight: bold;">Relação de Despesas</p>
        <table>
            <thead style="backgoround-color: red !important">
                <tr>
                    <th>DATA</th>
                    <th>QUEM CADASTROU</th>
                    <th>DESPESA</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($summary['summary_expenses'] as $product)
                    <tr>
                        <td>{{ $product['date'] }}</td>
                        <td>{{ $product['user_name'] }}</td>
                        <td>{{ $product['expense_name'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ $product['value'] }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @php
                        $total = 0;
                        foreach ($summary['summary_expenses'] as $product) {
                            $total += str_replace(
                                ',',
                                '.',
                                str_replace('.', '', str_replace('R$ ', '', $product['value'])),
                            );
                        }
                    @endphp
                    <td>TOTAL</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>R$ {{ number_format($total, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>
        <p style="text-align:center; font-size: 1.1rem; font-weight: bold;">Resumo Geral</p>
        <table>
            <thead>
                <tr>
                    <th>Clientes</th>
                    <th>VENDEDOR</th>
                    <th>F/PAGAMENTO</th>
                    <th>FOI PG?</th>
                    <th>SEGMENTO</th>
                    <th>VALOR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($summary['general'] as $product)
                    @if (!$product['is_retroactive'])
                        <tr>
                            <td>{{ $product['client_name'] }}</td>
                            <td>{{ $product['seller_name'] }}</td>
                            <td>{{ $product['type_payment_sale'] }}</td>
                            <td>{{ $product['payment_status'] }}</td>
                            <td>{{ $product['segment'] }}</td>
                            <td>{{ $product['value'] }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @php
                        $total = 0;
                        foreach ($summary['general'] as $product) {
                            if (!$product['is_retroactive']) {
                                $total += str_replace(
                                    ',',
                                    '.',
                                    str_replace('.', '', str_replace('R$ ', '', $product['value'])),
                                );
                            }
                        }
                    @endphp
                    <td>TOTAL</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>R$ {{ number_format($total, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

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
