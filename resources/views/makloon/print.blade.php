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

        .text-bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
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
            <h2>Invoice: {{ $makloon->makloon_number }}</h2>
            <p>Tanggal: {{ $makloon->date }}</p>
            <p>Jatuh tempo: {{ $makloon->date }}</p>
        </div>

        <div class="invoice-body">
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Ukuran</th>
                        <th>Satuan</th>
                        <th>Qty</th>
                        <th>Harga Barang</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $qty = 0;
                        $price = 0;
                        $total = 0;
                    @endphp
                    @foreach ($makloon->details as $item)
                        @php
                            $qty += $item->qty;
                            $price += $item->price;
                            $total += $item->price * $item->qty;
                        @endphp
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->size }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>@money($item->price)</td>
                            <td>@money($item->price * $item->qty)</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-center text-bold" colspan="4">Total</td>
                        <td class="text-bold">{{ $qty }}</td>
                        <td class="text-bold">@money($price)</td>
                        <td class="text-bold">@money($total)</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="invoice-footer">
            <p class="total">Total: @money($total)</p>
        </div>
    </div>
</body>
</html>
