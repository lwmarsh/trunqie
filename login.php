<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trunqie | Log In</title>
    <link rel="stylesheet" href="./includes/styles.css">
</head>

<body style="margin-top: 100px;">
    <div class="container">
        <div class="content" style="color: #12214E;">
            <h1>Log In</h1>
            <form action="login_action.php" method="post" class="form" role="form">
                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="pass" class="form-input" placeholder="Password">
                </div>
                <button type="submit" name="submit" class="form-button" style="margin-top: 15px;">LOG IN</button>
            </form>
            <p>If you do not already have an account, please <a href="./register.php">register</a>.</p>
        </div>
    </div>
</body>

</html>