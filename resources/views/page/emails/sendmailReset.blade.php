<!DOCTYPE html>
<html>
<head>
    <title>Reset PIN - TAPenjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h3 {
            color: #333;
        }
        h4 {
            color: #555;
        }
        p {
            color: #777;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #aaa;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Reset PIN Request</h3>
        <p>Hi,</p>
        <p>We received a request to reset your PIN. Please find your temporary PIN below:</p>
        <h4>Email: {{ $data['email'] }}</h4>
        <h4>Temporary PIN: {{ $data['pin'] }}</h4>
        <p>Please use this PIN to log in and remember to update it after logging in for security purposes.</p>
        <p>Thank you,</p>
        <p>TAPenjualan Team</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} TAPenjualan All rights reserved.
    </div>
</body>
</html>
