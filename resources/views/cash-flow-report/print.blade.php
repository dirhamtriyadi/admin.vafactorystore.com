<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Flow Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* margin: 20px; */
        }

        .report {
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

        .report-header,
        .report-body,
        .report-footer {
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

        .footer-info {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="report">
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

        <div class="report-header">
            <h2>Cash Flow Report</h2>
            <p>Cetak Tanggal: {{ date('Y-m-d') }}</p>
        </div>

        <div class="report-body">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $uangMasuk = 0;
                        $uangKeluar = 0;
                    @endphp
                    @foreach ($cashFlows as $item)
                        @php
                            if ($item->cash_flow_type == 'UANGMASUK') {
                                $uangMasuk += $item->amount;
                            } else {
                                $uangKeluar += $item->amount;
                            }
                        @endphp
                        @if ($item->cash_flow_type == 'UANGMASUK')
                            <tr style="background-color: #F1948A">
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->description }}</td>
                                <td>@money($item->amount)</td>
                                <td></td>
                            </tr>
                        @endif
                        @if ($item->cash_flow_type == 'UANGKELUAR')
                            <tr style="background-color: #82E0AA">
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->description }}</td>
                                <td></td>
                                <td>@money($item->amount)</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="report-footer">
            <table>
                <tr>
                    <td>Total Pemasukan:</td>
                    <td>@money($uangMasuk)</td>
                </tr>
                <tr>
                    <td>Total Pengeluaran:</td>
                    <td>@money($uangKeluar)</td>
                </tr>
                <tr>
                    <td>Saldo Akhir:</td>
                    <td>@money($uangMasuk - $uangKeluar)</td>
                </tr>
            </table>
        </div>

        <div class="footer-info">
            <p>Nama Pencetak: {{ auth()->user()->name }}</p>
        </div>
    </div>
</body>
</html>
