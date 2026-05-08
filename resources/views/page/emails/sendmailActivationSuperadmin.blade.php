<!DOCTYPE html>
<html>
<head>
    <title>Account Activation - TAPenjualan</title>
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
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            color: #fff;
            background-color: #28a745;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Account Activation</h3>
        <p>Hi,</p>
        <p>Thank you for registering with TAPenjualan. Please click the button below to activate your account:</p>
        <p>Email: {{$data['email']}}</p>
        <p>Pin : {{$data['pin']}}</p>
        <p>If you did not create an account, no further action is required.</p>
        <p>Thank you,</p>
        <p>TAPenjualan Team</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} TAPenjualan All rights reserved.
    </div>
</body>
</html>
</div>