<?php
require_once '../session.php';
if(isset($_SESSION['username']))
    header("location:".BASE_URL."/app.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Log In</title>
    <!-- Inclua os arquivos CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        width: 400px;
        max-width: 100%;
    }

    .container h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .container form {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
    }

    .container form .form-group {
        margin-bottom: 15px;
    }

    .container form .btn-primary {
        width: 100%;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Log In</h1>
        <form action="<?=BASE_URL?>/backend/auth.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="email" id="username" />
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="senha" id="password" />
            </div>
            <input type="submit" class="btn btn-primary" value="Log In" />
        </form>
    </div>

    <!-- Inclua os arquivos JS do Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>