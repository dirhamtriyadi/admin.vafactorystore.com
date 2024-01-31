<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* margin: 20px; */
        }

        .invoice {
            border: 1px solid #ddd;
            padding: 20px;
            /* width: 80%; */
            margin: 0 auto;
        }

        .company-profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .company-logo {
            width: 80px;
            margin-right: 20px;
        }

        .company-info {
            flex-grow: 1;
        }

        .company-info h1,
        .company-info p {
            margin: 0;
        }

        .invoice-header,
        .invoice-body,
        .invoice-footer {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="company-profile">
            <div class="company-logo">
                <img src="{{ public_path('logo.png') }}" alt="Company Logo" style="width: 100%;">
            </div>
            <div class="company-info">
                <h1>{{ config('app.name') }}</h1>
                <p>Jalan Raya Cicalengka-Majalaya Cikuya. Cicalengka</p>
                <p>Kab. Bandung Jawa Barat 50395</p>
                <p>0813131744474</p>
            </div>
        </div>

        <div class="invoice-header">
            <h2>Invoice: {{ $transaction->transaction_number }}</h2>
            <p>Tanggal: {{ date('Y-m-d') }}</p>
            <p>Jatuh tempo: {{ date('Y-m-d') }}</p>
        </div>

        <div class="invoice-body">
            <table>
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Quantity</th>
                        <th>Harga Barang</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($transaction->transactionDetails as $item)
                        @php
                            $total += $item->total;
                        @endphp
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>@money($item->price)</td>
                            <td>@money($item->total)</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="invoice-footer">
            <p class="total">Total: @money($total)</p>
        </div>
    </div>
</body>
</html>
