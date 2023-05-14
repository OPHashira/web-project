<?php
    session_start();
    $checkIfLogged = $_SESSION['username'] ?? "";
    if($checkIfLogged==""){
        
    }
    else{
        header('Location:index.php');
        exit();
    }
    $if1stTime = $_SESSION['isFirstTime'] ?? "";
    if ($if1stTime=="")
    {
        unset($_SESSION['errp']);
        unset($_SESSION['erru']);
    }
    $errp = $_SESSION['errp'] ?? "";
    $erru = $_SESSION['erru'] ?? "";
    require_once('connection.php');

    
    $user=$_POST['username'] ?? "";
    $pass=$_POST['password'] ?? "";

    if (empty($user)) {
        $_SESSION['erru'] = 'Please enter your username';
        
    }
    else
    {
        $_SESSION['erru'] ='';
    }
    if (empty($pass)) {
        $_SESSION['errp'] = 'Please enter your password';
        
    } else
    {
        $_SESSION['errp'] ='';
        $conn=login($user,$pass);
        if($conn){
            $_SESSION['username']=$user;
            header('Location:mainPage-login-template.php');
            exit();
        }else{
            $_SESSION['errp'] ='Wrong username or password';
        }
    }
    $_SESSION['isFirstTime'] = false;
    
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cssPack/style.css">
    <script src="./jsPack/script.js"></script>
    <title>Login to NAME</title>
</head>
<body class="login-body">
    <div class="login-box">
        <form method="post" action="login.php">
            <div class="user-box">
                <input type="text" name="username" value="<?=$user?>" required>
                <label>Username</label>
                <p style="color: red; margin-bottom: 10px;"><?=$erru?></p>
            </div>
            <div class="user-box">
                <input type="password" name="password" value="<?=$pass?>" required>
                <label>Password</label>
                <p style="color: red; margin-bottom: 10px;"><?=$errp?></p>
            </div>
            <div class="err-sec"></div>

            <button class="custom-btn-login" type="submit">
                Login
            </button>

            <button class="custom-btn-register" type="button" onclick="moveTo('./register-template.php')">
                register
            </button>
        </form>
    </div>
</body>
<script>


</script>

</html>