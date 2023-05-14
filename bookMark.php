<?php
    include_once('insertBookMark.php');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cssPack/custom-icon.css">
    <link rel="stylesheet" href="./cssPack/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./jsPack/script.js"></script>
    <title>PageName</title>
</head>
<body class="mainpage-body">
<form action="selectedTypeFilm-login-template.php" method="post">
    <header>
        <nav class="homepage-nav">
            <ul class="homepage-ul lef">
                <li class="logo-li"><a href="./mainPage-login-template.php" class="logo"><img src="./img-gif/logovector.avif" alt="logo" class="logo-img"></a></li>
            </ul>
            <ul class="homepage-ul cen">
                <li class="nav-search-box">
                    <div class="search-box">
                        <svg class="search-box-icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                        <input id="filmName" placeholder="Search" type="text" class="search-platform" name="genre">
                    </div>
                </li>
            </ul>
            <ul class="homepage-ul rig">
                <li class="rtl">
                    <a href="./userinfo-template.php" class="default-icon"><div class="user"></div></a>
                </li>
                <li class="nav-button rtl">
                    <button type="button" class="custom-btn-MP-alert ct-color" onclick="moveTo('./logout-template.php')">
                    log out
                    </button>
                </li>
            </ul>
        </nav>
    </header>
</form>
    <main class="finding">
        <article class="finding">
            <container>
                <h3 style="color:white; text-align: center;">Successfully add movie to favorite</h3>
            </container>
        </article>
    </main>
</body>
</html>