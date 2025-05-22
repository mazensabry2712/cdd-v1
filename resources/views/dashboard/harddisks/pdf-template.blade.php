<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Hard Disk #{{ $harddisk->id }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            direction: ltr;
            text-align: left;
            font-size: 14px;
            margin: 30px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        p.date {
            font-size: 12px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
        }

        table th {
            background-color: #f0f0f0;
            width: 30%;
            text-align: left;
            font-size: 14px;
        }

        table td {
            font-size: 14px;
        }

        footer {
            position: fixed;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>

    <header>
        <h1>Hard Disk Details</h1>
        <p class="date">Print Date: {{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
    </header>

    <table>
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $harddisk->id }}</td>
            </tr>
            <tr>
                <th>Model</th>
                <td>{{ $harddisk->model }}</td>
            </tr>
            <tr>
                <th>Health</th>
                <td>{{ $harddisk->health }}</td>
            </tr>
            <tr>
                <th>Interface</th>
                <td>{{ $harddisk->interface ?? '-' }}</td>
            </tr>
            <tr>
                <th>Capacity</th>
                <td>{{ $harddisk->capacity_gb }} {{ $harddisk->capacity_unit }}</td>
            </tr>
            <tr>
                <th>Serial Number</th>
                <td>{{ $harddisk->serial_number }}</td>
            </tr>
            <tr>
                <th>Stored PDF</th>
                <td>
                    @if ($harddisk->pdf && Storage::disk('public')->exists($harddisk->pdf))
                        Yes ({{ basename($harddisk->pdf) }})
                    @else
                        No PDF File
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <footer>
        All rights reserved &copy; {{ date('Y') }}
    </footer>

</body>

</html>
