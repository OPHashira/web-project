<?php

session_start();
if ($_SESSION['username']!="admin")
{
    header('Location: mainPage-login-template.php');
    exit();
}
$error = $_SESSION['AMerr'] ??"";
$path = $_SESSION['path'] ??"";
unset($_SESSION['AMerr']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add film</title>
    <link rel="stylesheet" href="./cssPack/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./jsPack/script.js"></script>
    <link rel="stylesheet" href="./cssPack/custom-icon.css">
</head>
<body class="mainpage-body">
<div class="preloader lds-dual-ring" id="preloader"></div>
<div class="progress" id="progress"></div>
<!-- ==========================================================-->


<!-- ==========================================================-->
<div class="login-box">
    <form method="POST" action="addFilm-Function.php" enctype="multipart/form-data">
        <div class="user-box">
            <input type="text" name="title" id="title">
            <label>Title</label>
        </div>
        <?=$path?>
        <div class="user-box">
            <input type="date" name="RD" id="RD">
            <label>Date</label>
        </div>
        <div class="user-box">
            <input type="text" name="plot" id="plot">
            <label>Plot</label>
        </div>
        <div class="user-box">
            <input type="text" name="ml" id="ml">
            <label>Movie length</label>
        </div>
        <div class="user-box">
            <input type="text" name="role" id="role">
            <label>Role</label>
        </div>
        <div class="user-box">
            <input type="text" name="directorN" id="directorN">
            <label>Director Name</label>
        </div>
        <div class="user-box">
            <input type="text" name="ActorN" id="ActorN">
            <label>Actor Name</label>
        </div>
        <div class="user-box">
            <input type="text" name="GenreN" id="GenreN">
            <label>Genre</label>
        </div>
        <div class="user-box">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <label>Image</label>
        </div>
        <div class="user_box">
            <?php
            if (!empty($error)) {
                echo "<div class='alert '>$error</div>";
            }
            ?>
        </div>
        <button class="custom-btn-login" type="submit">
            Add
        </button>

        <button class="custom-btn-register" type="button" onclick="moveTo('./mainPage-login-template.php')">
            cancel
        </button>
    </form>
</div>
<!-- ==========================================================-->

</body>
<script>
var loader = document.getElementById('preloader');

window.addEventListener("load",function()
    {
        loader.classList.toggle('active');
    }
)

var progBar = document.getElementsById('progress');
window.addEventListener('scroll', () => {
    progBar.style.setProperty('--scroll',window.pageYOffset / (progBar.offsetHeight - window.innerHeight));
    progBar.classList.toggle('active');
}, false);
</script>
</html>