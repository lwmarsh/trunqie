<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trunqer | Log In</title>
    <link rel="stylesheet" href="./includes/styles.css">
</head>

<body>
    <div class="container">
        <div class="content" style="color: #12214E;">
            <h1>Log In</h1>
            <form action="login_action.php" method="post" class="form" role="form">
                <div class="form-group">
                    <label class="form-label">Email address:</label>
                    <br>
                    <input type="email" name="email" class="form-input" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label class="form-label">Password:</label>
                    <br>
                    <input type="password" name="pass" class="form-input">
                </div>
                <button type="submit" name="submit" class="form-button" style="margin-top: 15px;">LOG IN</button>
            </form>
            <p>If you do not already have an account, please <a href="./register.php">register</a>.</p>
        </div>
    </div>
</body>

</html>