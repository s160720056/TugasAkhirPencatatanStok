<!DOCTYPE html>
<html>
<head>
    <title>Purchase Receipt</title>
    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }
        body {
            width: 80mm;
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        header, footer {
            text-align: center;
            width: 100%;
        }
        header {
            margin-bottom: 10px;
        }
        footer {
            margin-top: 10px;
        }
        .invoice-details {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details th, .invoice-details td {
            padding: 5px;
            border: 1px solid #ddd;
        }
        .invoice-details th {
            background-color: #f5f5f5;
        }
        .invoice-details tfoot td {
            border-top: 2px solid #ddd;
        }
    </style>
</head>
<body>
    <header>
        <h1>SV MOTOR</h1>
        <p>1234 Elm Street, Springfield, IL 62704</p>
        <h2>Purchase Receipt</h2>
        <p>Invoice Number: 6666</p>
        <p>Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p> <!-- Add this line for the date -->
    </header>

    <main>
        <hr class="dasher">
        <hr class="dasher">
        <h2>Receipt Details</h2>
        <p>Transaction details are as follows:</p>
        <table class="invoice-details">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Item 1</td>
                    <td>Item 1 Description</td>
                    <td>2</td>
                    <td>$10.00</td>
                    <td>$20.00</td>
                </tr>
                <tr>
                    <td>Item 2</td>
                    <td>Item 2 Description</td>
                    <td>1</td>
                    <td>$15.00</td>
                    <td>$15.00</td>
                </tr>
                <!-- Add more items as needed -->
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right;">Total</td>
                    <td>$35.00</td>
                </tr>
            </tfoot>
        </table>
    </main>

    <footer>
        <p>Thank you for your purchase!</p>
        <p>Selamat poin anda bertambah</p>
    </footer>
</body>
</html>
