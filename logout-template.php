<?php
  session_start();
  session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cssPack/style.css">
    <script src="./jsPack/script.js"></script>
    <title>Document</title>
</head>
<body class="logout-body"> 
  <form>
      <div class="logout-box">
        <div class="user-box-gradient">
          <h1>Logout succesfully</h1>
          you will be return to login page in <strong id="timer" class="timer">10</strong>
          <button class="custom-btn-login" type="button" onclick="moveTo('./index.php')">To Main Page</button>
        </div>
      </div>
  </form>
    
</body>
<script>
      
    var countDownDate = new Date().getTime()+10000;
    var x = setInterval(function() {
      var now = new Date().getTime();
      var distance = countDownDate - now;
      distance = distance % (1000 * 60)

      var seconds = Math.floor(distance / 1000);
        
      if (distance<0)
      {
        seconds=0;
      }
      document.getElementById("timer").innerHTML =seconds;
      
      if (distance < 0) {
        clearInterval(x);
        window.location.replace("./mainPage-template.php");
      }
    }, 1000);

</script>
</html>