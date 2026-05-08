<!DOCTYPE html>
<html>
<head>
    <title>santrikoding.com</title>
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
        <h3>{{ $data['name'] }}</h3>
        <h4>{{ $data['body'] }}</h4>
        <p>Terimakasih</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} santrikoding.com. All rights reserved.
    </div>
</body>
</html>
