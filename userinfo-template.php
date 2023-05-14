<?php
    session_start();
    include_once('connection.php');
    $data=getUserInfo($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cssPack/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./jsPack/script.js"></script>
    <link rel="stylesheet" href="./cssPack/custom-icon.css">
    <title>User</title>
    <style>
        input[type="text"]:disabled {
        background: #fff;
        }
    </style>
</head>
<body class="userpage-body">
    <header >
        <nav class="homepage-nav">
            <ul class="homepage-ul lef">
                <li class="logo-li"><a href="./mainPage-login-template.php" class="logo"><img src="./img-gif/logovector.avif" alt="logo" class="logo-img"></a></li>
            </ul>
            <ul class="homepage-ul cen">
                <li class="nav-search-box">
                </li>
            </ul>
            <ul class="homepage-ul rig">
                <li class="rtl">
                </li>
                <li class="nav-button rtl">
                    <button type="button" class="custom-btn-MP-alert ct-color" onclick="moveTo('./logout-template.php')">
                    log out
                    </button>
                </li>
            </ul>
        </nav>
    </header>
    <div class="bg-user-img"></div>
    <div class="user-img"  id="uimg" onclick="open_select()"></div>
    
    <article class="user-article sticky-item">
        <div class="user-sel-img" id="usi" style="display: none;">
            <img class="upi"  src="./img-gif/image.jpeg" id="image" alt="user profile img" onclick="select_img('image')">
            <img class="upi" src="./img-gif/image2.jpeg" id="image2" alt="user profile img" onclick="select_img('image2')">
            <img class="upi" src="./img-gif/image3.jpeg" id="image3" alt="user profile img" onclick="select_img('image3')">
            <img class="upi" src="./img-gif/image4.jpeg" id="image4" alt="user profile img" onclick="select_img('image4')">
            <img class="upi" src="./img-gif/image5.jpeg" id="image5" alt="user profile img" onclick="select_img('image5')">
            <img class="upi" src="./img-gif/image6.jpeg" id="image6" alt="user profile img" onclick="select_img('image6')">
            <img class="upi" src="./img-gif/image7.jpeg" id="image7" alt="user profile img" onclick="select_img('image7')">
        </div>
        <user-container>
            <h3>My Account:</h3>
            <div class="user-block">
                <label>First name: </label>
                <input id="FN" class="search-box" type="text" placeholder='<?=$data[0]['firstname']?>' disabled>
            </div>
            <div class="user-block">
                <label>Last Name: </label>
                <input id="LN" class="search-box" type="text" placeholder="<?=$data[0]['lastname']?>" disabled>
            </div>
            <div class="user-block">
                <label>Email: </label>
                <input id="E" class="search-box" type="text" placeholder="<?=$data[0]['email']?>" disabled>
            </div>
            <div class="user-block">
                <a style="color: white" href="./bookMark-template.php">Favorite films</a>
            </div>
        </user-container>
    </article>

    <footer>
        <div class="container">
            <div class="footer-content about">
                <h2>About us</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos animi velit et enim nihil minima nisi quis sit vel? Illum provident modi adipisci repellendus accusantium architecto sunt ad reprehenderit atque.</p>
                <ul class="social-icon">
                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i class="fa fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
            <div class="footer-content links">
                <h2>Đường Dẫn</h2>
                <ul>
                    <li><a href="#">Trang Chủ</a></li>
                    <li><a href="#">Về Chúng Tôi</a></li>
                    <li><a href="#">Thông Tin Liên Lạc</a></li>
                    <li><a href="#">Dịch Vụ</a></li>
                    <li><a href="#">Điều Kiện Chính Sách</a></li>
                </ul>
            </div>
            <div class="footer-content contact">
                <h2>Thông Tin Liên Hệ</h2>
                <ul class="info">
                    <li>
                        <span><i class="fa fa-map-marker"></i></span>
                        <span>Đường Số 1<br />
                            Quận 1, Thành Phố Hồ Chí Minh<br />
                            Việt Nam</span>
                    </li>
                    <li>
                        <span><i class="fa fa-phone"></i></span>
                        <p><a href="#">+84 123 456 789</a>
                            <br />
                            <a href="#">+84 987 654 321</a></p>
                    </li>
                    <li>
                        <span><i class="fa fa-envelope"></i></span>
                        <p><a href="#">diachiemail@gmail.com</a></p>
                   </li>
                    <li>
                        <form class="form">
                            <div class="search-box">
                                <input placeholder="Email to subscribe" type="search" class="search-platform">
                            </div>
                            <button type="button" class="btn btn--primary  uppercase">Gửi</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>

<script>
    window.onscroll = function() {myFunction()};
    
    var header = document.getElementById("user-header");
    var sticky = header.offsetTop;
    
    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky-item");
      } else {
        header.classList.remove("sticky-item");
      }
    }

    function open_select(){
        var usi = document.getElementById("usi");
        if (usi.style.display === "none") {
            usi.style.display = "flex";
        } else {
            usi.style.display = "none";
        }
    }
    
    function select_img(id){ 
        var imgSrc = "./img-gif/" + id + ".jpeg";
        var uimg = document.getElementById("uimg");
        uimg.style.backgroundImage = "url('" + imgSrc + "')";
        document.getElementById("usi").style.display = "none";
    }
    
</script>
</html>