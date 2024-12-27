<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->order_no }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            padding: 20px;
            border-bottom: 2px solid #ddd;
            margin-bottom: 20px;
        }

        .header img {
            height: 60px;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .details-table th,
        .details-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .details-table th {
            font-weight: bold;
            background-color: #f7f7f7;
        }

        .content {
            margin: 20px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f7f7f7;
            color: #333;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <img src="{{ public_path(getSetting('app_logo')) }}" alt="App Logo">
        <h1>{{ getSetting('app_name', 'Your App Name') }}</h1>
    </div>

    <div class="content">
        <!-- Client and Company Information -->
        <table class="details-table">
            <tr>
                <th colspan="2">Client Information</th>
                <th colspan="2">Company Information</th>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $order->client->name }}</td>
                <td>Company Name</td>
                <td>{{ getSetting('app_name', 'Your App Name') }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $order->client->address ?? 'N/A' }}</td>
                <td>Address</td>
                <td>{{ getSetting('app_address', 'Company Address Here') }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ $order->client->phone ?? 'N/A' }}</td>
                <td>Phone</td>
                <td>{{ getSetting('app_phone', 'Company Phone Here') }}</td>
            </tr>
        </table>

        <!-- Order Details -->
        <h3>Order Details</h3>
        <table class="details-table">
            <tr>
                <td>Status</td>
                <td>{{ ucfirst($order->status) }}</td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td>{{ \Carbon\Carbon::parse($order->start_date)->format('F d, Y') }}</td>
            </tr>
            <tr>
                <td>Due Date</td>
                <td>{{ \Carbon\Carbon::parse($order->due_date)->format('F d, Y') }}</td>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td><i class="mdi mdi-currency-bdt"></i>{{ number_format($order->total_amount, 2) }}</td>
            </tr>
            <tr>
                <td>Paid Amount</td>
                <td><i class="mdi mdi-currency-bdt"></i>{{ number_format($order->paid_amount, 2) }}</td>
            </tr>
            <tr>
                <td>Due Amount</td>
                <td><i class="mdi mdi-currency-bdt"></i>{{ number_format($order->due_amount, 2) }}</td>
            </tr>
        </table>

        <!-- Description -->
        <h3>Order Description</h3>
        <table class="details-table">
            <tr>
                <td>{{ $order->description ?? 'No description provided.' }}</td>
            </tr>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; {{ date('Y') }} {{ getSetting('app_name', 'Your App Name') }}. All rights reserved.
    </div>
</body>

</html>
