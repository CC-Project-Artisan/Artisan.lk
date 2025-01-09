<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #4e342e, #bcaaa4);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .success-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            animation: fadeIn 1.5s ease;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: scale(0.8); }
            100% { opacity: 1; transform: scale(1); }
        }
        .success-container h1 {
            font-size: 2.8rem;
            margin: 0;
            color: #4e342e;
        }
        .success-container p {
            margin: 20px 0;
            font-size: 1.2rem;
            color: #5d4037;
        }
        .success-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #8d6e63;
            color: #fff;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            border-radius: 30px;
            transition: all 0.4s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .success-container a:hover {
            background: #6d4c41;
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }
        .icon {
            font-size: 4rem;
            color: #4e342e;
            margin-bottom: 20px;
            animation: bounce 1s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="icon">&#10003;</div>
        <h1>Payment Successful</h1>
        <p>Thank you for your payment! Your order has been successfully processed.</p>
        <a href="{{ route('welcome') }}">Go to Homepage</a>
    </div>
</body>
</html>
