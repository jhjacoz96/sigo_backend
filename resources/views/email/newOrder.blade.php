<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Nueva orden</title>
    </head>
    <body>
    <div style="text-align: center;">
        <strong>SISTEMA SIGO</strong>
    </div>
    <br>
    Hola {{ $employee->name }}, tienes un nuevo pedido #{{ $order->code }}.<br>
    <table>
        <tr>
            <td>
            Monto total:
            </td>
            <td>
            {{ $order->total }}
            </td>
        </tr>
        <tr>
            <td>
                Cliente:
            </td>
            <td>
                {{ $client->name }}
            </td>
        </tr>
    </table>
    <br>
    </body>
</html>