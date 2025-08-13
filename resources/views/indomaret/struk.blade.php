<!DOCTYPE html>
<html>

<head>
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: monospace;
            width: 250px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            font-size: 12px;
        }

        td {
            padding: 2px 0;
        }
    </style>
</head>

<body onload="window.print(); window.close();">
    <h2>Indomaret</h2>
    <hr>
    <table>
        @foreach ($data->details as $item)
            <tr>
                <td colspan="2">{{ $item->nama_barang }}</td>
            </tr>
            <tr>
                <td>{{ $item->qty }} x Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td style="text-align:right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>
    <hr>
    <p>Total: Rp {{ number_format($transaksi->details->sum('total'), 0, ',', '.') }}</p>
    <p>Terima kasih!</p>
</body>

</html>
