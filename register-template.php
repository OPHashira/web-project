<?php
require_once('connection.php');
$firstName = '';
$lastName = '';
$user = '';
$email = '';
$pass = '';
$pass_confirm = '';
$checkIf1st = $_SESSION['isFirstTime'] ?? "";
if ($checkIf1st==false)
{
    unset($_SESSION['isFirstTime']);
}
if (isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['password-2nd']) && isset($_POST['email'])) {
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass_confirm = $_POST['password-2nd'];

    if (empty($first) || empty($last) || empty($user) || empty($email) || empty($pass)) {
        $error= "Please fill in your information";
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
        $error= "This is not a valid email";
    } elseif (strlen($pass) < 6) {
        $error= "Password must have at least 6 characters";
    } elseif ($pass != $pass_confirm) {
        $error= "Password does not match";
    } else {
        $result = register($user, $pass, $first, $last, $email);
        if ($result == 1) {
            $error= "This email is registered";
        } elseif ($result == 0) {
            header('Location: login.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cssPack/style.css">
    <script src="./jsPack/script.js"></script>
    <title>Register</title>
    <style>
        .alert {
            color: white;
            padding: 4px 0 24px 0;
            line-height: 100%;
        }
    </style>
</head>

<body class="login-body">
    <div class="login-box">
        <form method="POST" action="register-template.php">
            <div class="user-box">
                <input type="text" name="firstname">
                <label>First name</label>
            </div>
            <div class="user-box">
                <input type="text" name="lastname">
                <label>Last name</label>
            </div>
            <div class="user-box">
                <input type="text" name="username">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password">
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="password" name="password-2nd">
                <label>Re-enter Password</label>
            </div>
            <div class="user-box">
                <input type="email" name="email">
                <label>Email</label>
            </div>
            <div class="user_box">
                <?php
                if (!empty($error)) {
                    echo "<div class='alert '>$error</div>";
                }
                ?>
            </div>
            <button class="custom-btn-login" type="submit">
                Register
            </button>

            <button class="custom-btn-register" type="button" onclick="moveTo('./index.php')">
                cancel
            </button>
        </form>
    </div>
</body>

</html>