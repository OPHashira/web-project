<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "ft";

    $conn = mysqli_connect($host, $user, $password, $database);
    $query="INSERT INTO bookmarkfilm(MovieID, username) values (?,?)";
    $stmt=$conn->prepare($query);
    $stmt->bind_param('ss',$_POST['movieid'],$_POST['user']);
    $stmt->execute();
?>