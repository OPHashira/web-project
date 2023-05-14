<?php
session_start();
$user = $_SESSION['username']?? "";
if ($user=="")
{

}
else
{
    header('location: mainPage-login-template.php');
    exit();
}
include_once('connection.php');
$data=getLatest();
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
    <title>Homepage</title>
</head>
<body class="mainpage-body">
<form action="selectedTypeFilm-template.php" method="post">
    <header>
        <nav class="homepage-nav">
            <ul class="homepage-ul lef">
                <li class="logo-li"><a href="./mainPage-template.php" value="" class="logo"><img src="./img-gif/logovector.avif" alt="logo" class="logo-img"></a></li>
            </ul>
            <ul class="homepage-ul cen">
                <li class="nav-search-box">
                    <div class="search-box">
                        <svg class="search-box-icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                        <input placeholder="Search by genres" type="search" class="search-platform" name="genre">
                    </div>
                </li>
            </ul>
            <ul class="homepage-ul rig">
                <li class="rtl">
                    <a href="./userinfo-template.php" value="" class="default-icon"><div class="user"></div></a>
                </li>
                <li class="nav-button rtl">
                    <li class="nav-button rtl">
                        <button type="button" class="custom-btn-MP-default ct-color" onclick="moveTo('./login.php')">
                        Log in
                        </button>
                    </li>
                    <li class="nav-button rtl">
                        <button type="button" class="custom-btn-MP-success ct-color" onclick="moveTo('./register-template.php')">
                        Register
                        </button>
                    </li>
                </li>
            </ul>
        </nav>
    </header>
</form>
    <div class="preloader lds-dual-ring" id="preloader"></div>
    <div class="progress" id="progress"></div>
    <!-- ==========================================================-->
    
    <aside>
            <nav class="side-nav">
                <ul>
                    <li ><a href="./selectedTypeFilm-template.php?genre=action" value="action">Action</a></li>
                    <li><a href="./selectedTypeFilm-template.php?genre=comedy" value="comedy">Comedy</a></li>
                    <li><a href="./selectedTypeFilm-template.php?genre=horror" value="horror">Horror</a></li>
                    <li><a href="./selectedTypeFilm-template.php?genre=drama" value="drama">Drama</a></li>
                    <li><a href="./selectedTypeFilm-template.php?genre=fantasy" value="fantasy">Fantasy</a></li>
                    <li><a href="./selectedTypeFilm-template.php?genre=mystery" value="mystery">Mystery</a></li>
                    <li><a href="./selectedTypeFilm-template.php?genre=science fiction" value="scifi">Sci-Fi</a></li>
                    <li><a href="./selectedTypeFilm-template.php?genre=action" value="romance">Romance</a></li>
                </ul>
            </nav>
        </aside>

    <!-- ==========================================================-->
    <main class="main">

        
        <article class="main">
            <!-- ==========================================================-->
            <h2 class="title">Latest Films</h2>
            <container>
                <?php
                    foreach($data as $i){         
                ?>
                    <figure>
                        <img src="<?=$i['image']?>" alt="something">
                        <p>
                            <star><?=$i['Star']?><span class="fa fa-star star-checked"></span></star>
                            <?=$i['Title']?>
                        </p>
                        <a href="./filmPage-template.php?filmName=<?=$i['Title']?>">
                            <div style="  position: absolute;width: 100%;height: 100%;top: 0;right: 0;"></div>
                        </a>
                    </figure>
                <?php
                    }
                ?>

                
            </container>
            <!-- ==========================================================-->
            <h2 class="title">Something Films</h2>
            <container>
                <figure onclick="moveTo('./filmPage-template.php')">
                    <img src="./img-gif/Poster6.jpg" alt="something">
                    <p>
                        <star>5 <span class="fa fa-star star-checked"></span></star>
                        something
                    </p>
                </figure>
                <figure onclick="moveTo('./filmPage-template.php')">
                    <img src="./img-gif/Poster7.jpg" alt="something">
                    <p>
                        <star>5 <span class="fa fa-star star-checked"></span></star>
                        something
                    </p>
                </figure>
                <figure onclick="moveTo('./filmPage-template.php')">
                    <img src="./img-gif/Poster8.jpg" alt="something">
                    <p>
                        <star>5 <span class="fa fa-star star-checked"></span></star>
                        something
                    </p>
                </figure>
                <figure onclick="moveTo('./filmPage-template.php')">
                    <img src="./img-gif/Poster9.jpg" alt="something">
                    <p>
                        <star>5 <span class="fa fa-star star-checked"></span></star>
                        something
                    </p>
                </figure>
                <figure onclick="moveTo('./filmPage-template.php')">
                    <img src="./img-gif/Poster10.jpg" alt="something">
                    <p>
                        <star>5 <span class="fa fa-star star-checked"></span></star>
                        something
                    </p>
                </figure>
            </container>
            <!-- ==========================================================-->
            <h2 class="title">Another Something Films</h2>
            <container>
                <figure onclick="moveTo('./filmPage-template.php')"> 
                    <img src="./img-gif/Poster11.jpg" alt="something">
                    <p>
                        <star>5 <span class="fa fa-star star-checked"></span></star>
                        something
                    </p>
                </figure>
                <figure onclick="moveTo('./filmPage-template.php')">
                    <img src="./img-gif/Poster12.jpg" alt="something">
                    <p>
                        <star>5 <span class="fa fa-star star-checked"></span></star>
                        something
                    </p>
                </figure>
                <figure onclick="moveTo('./filmPage-template.php')">
                    <img src="./img-gif/Poster13.jpg" alt="something">
                    <p>
                        <star>5 <span class="fa fa-star star-checked"></span></star>
                        something
                    </p>
                </figure>
                <figure onclick="moveTo('./filmPage-template.php')">
                    <img src="./img-gif/Poster14.jpg" alt="something">
                    <p>
                        <star>5 <span class="fa fa-star star-checked"></span></star>
                        something
                    </p>
                </figure>
                <figure onclick="moveTo('./filmPage-template.php')">
                    <img src="./img-gif/Poster15.jpg" alt="something">
                    <p>
                        <star>5 <span class="fa fa-star star-checked"></span></star>
                        something
                    </p>
                </figure>
            </container>
            <!-- ==========================================================-->
        </article>
        <section>

        </section>
    </main>
    <!-- ==========================================================-->
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