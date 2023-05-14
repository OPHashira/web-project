<?php
    function connToDb(){
        $host = "localhost";
        $user = "root";
        $passwd = "";
        $db = "ft";
        $con = new mysqli($host,$user,$passwd,$db);
        if ($con->connect_errno) {
            printf("connection failed: %s\n", $con->connect_error);
            exit();
        };
        return $con;
    }

    function getInfo($username){
        $query = "SELECT firstname, lastname, email FROM account WHERE username =?";
        $conn = connToDb();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        if(!$stmt->execute()){
            return null;
        }
        $data=$stmt->get_result();
        $row = $data->fetch_assoc();
        $result = array('firstname' => $row['firstname'],
        'lastname' => $row['lastname'],
        'email' => $row['email']);
        
        return $result;
    }
    

    function login($username,$password){
        $query = "SELECT * FROM account WHERE username = ?";
        $conn = connToDb();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        if(!$stmt->execute()){
            return null;
        }

        $data=$stmt->get_result();
        if($data->num_rows==0){
            return null;
        }
        
        $result=$data->fetch_assoc();
        
        $passFromDB=$result['token']; 
        if(!password_verify($password,$passFromDB)){
            return null ;
        }else return $result;
    }

    function checkMail($email){
        $conn=connToDb();

        $query="SELECT COUNT(*) FROM account WHERE email=?";

        $stmt=$conn->prepare($query);
        $stmt->bind_param('s',$email);

        if(!$stmt->execute()){
            return null;
        }

        $count=mysqli_stmt_num_rows($stmt);
        if($count==1){
            return true;
        }return false;
    }

    function register($user,$pass,$firstName,$lastName,$email){
        $conn=connToDb();
        
        $query="INSERT INTO account(username,firstname,lastname,email,token) VALUES (?,?,?,?,?)";
        
        $passHash=password_hash($pass,PASSWORD_DEFAULT);
        $stmt=$conn->prepare($query);
        $stmt->bind_param('sssss',$user,$firstName,$lastName,$email,$passHash);

        if(checkMail($email)==true){
            return $flag=1;
        }
        if(!$stmt->execute()){
            return null;
        }return $flag=0;
    }

    function getLatest(){
        $conn=connToDb();
        $query="SELECT `movie`.*, `rating`.*
        FROM `movie` 
            LEFT JOIN `rating` ON `rating`.`MovieID` = `movie`.`MovieID`
        ORDER BY movie.ReleaseDate DESC LIMIT 5;";

        $stmt=$conn->prepare($query);
        if(!$stmt->execute()){
            return null;
        }else{
            $data=$stmt->get_result();
            $item=[];
            for($i=1;$i<=$data->num_rows;$i++){
                $item[]=$data->fetch_assoc();
            }
        }

        return $item;
    }

    function getMovieByGenre($genre){
        $conn = connToDb();
        $query= "SELECT `movie`.*, GROUP_CONCAT(`genre`.`GenreName` SEPARATOR ', ') AS `Genres`, `rating`.*
        FROM `movie` 
        LEFT JOIN `moviegenre` ON `moviegenre`.`MovieID` = `movie`.`MovieID` 
        LEFT JOIN `genre` ON `moviegenre`.`GenreiID` = `genre`.`GenreID` 
        LEFT JOIN `rating` ON `rating`.`MovieID` = `movie`.`MovieID`
        WHERE `genre`.`GenreName` LIKE CONCAT(?, '%') 
        AND `movie`.`MovieID`=`rating`.`MovieID`
        GROUP BY `movie`.`MovieID`;";
        
        $stmt=$conn->prepare($query);
        $stmt->bind_param('s',$genre);
        if(!$stmt->execute()){
            return null;
        }else{
            $data=$stmt->get_result();
            $item=[];
            for($i=1;$i<=$data->num_rows;$i++){
                $item[]=$data->fetch_assoc();
            }
        }
        return $item;
    }

    function getMovieInfo($filmName){
        $conn = connToDb();
        $query= "SELECT DISTINCT `movie`.*, GROUP_CONCAT( DISTINCT `genre`.`GenreName` SEPARATOR ', ') AS `Genres`, `rating`.*,GROUP_CONCAT(DISTINCT `actor`.`ActorName` SEPARATOR ', ') AS `Actors`, GROUP_CONCAT( DISTINCT `director`.`DirectorName` SEPARATOR ', ') AS `Directors` FROM `movie` LEFT JOIN `moviegenre` ON `moviegenre`.`MovieID` = `movie`.`MovieID` LEFT JOIN `genre` ON `moviegenre`.`GenreiID` = `genre`.`GenreID` LEFT JOIN `moviecast` ON `moviecast`.`MovieID` = `movie`.`MovieID` LEFT JOIN `actor` ON `moviecast`.`ActorID` = `actor`.`ActorID` LEFT JOIN `moviedirector` ON `moviedirector`.`MovieID` = `movie`.`MovieID` LEFT JOIN `director` ON `moviedirector`.`DirectorID` = `director`.`DirectorID` LEFT JOIN `rating` ON `rating`.`MovieID` = `movie`.`MovieID` WHERE `movie`.`Title` LIKE CONCAT(?, '%')  AND `movie`.`MovieID`=`rating`.`MovieID` GROUP BY `movie`.`MovieID`;";
        
        $stmt=$conn->prepare($query);
        $stmt->bind_param('s',$filmName);
        if(!$stmt->execute()){
            return null;
        }else{
            $data=$stmt->get_result();
            $item=$data->fetch_assoc();
        }
        return $item;
    }


    function getUserInfo($user){
        $conn=connToDb();
        $query="SELECT DISTINCT `account`.*, `bookmarkfilm`.*, `movie`.*,`rating`.*
        FROM `account` 
            LEFT JOIN `bookmarkfilm` ON `bookmarkfilm`.`username` = `account`.`username` 
            LEFT JOIN `movie` ON `bookmarkfilm`.`MovieID` = `movie`.`MovieID`
            LEFT JOIN `rating` ON `rating`.`MovieID` = `movie`.`MovieID`
            WHERE `bookmarkfilm`.`MovieID`=`movie`.`MovieID` AND `account`.`username`=?
            ORDER BY `account`.`username`;";

        $stmt=$conn->prepare($query);
        $stmt->bind_param('s',$user);
        if(!$stmt->execute()){
            return null;
        }else{
            $data=$stmt->get_result();
            $item=[];
            for($i=1;$i<=$data->num_rows;$i++){
                $item[]=$data->fetch_assoc();
            }
        }

        return $item;
    }
?>