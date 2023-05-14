<?php
session_start();

$title = $_POST['title']??"";
$RDate = $_POST['RD']??"";
$plot = $_POST['plot']??"";
$ml = $_POST['ml']??"";
$role = $_POST['role']??"";
$DN = $_POST['directorN']??"";
$GN = $_POST['GenreN']??"";
$AN = $_POST['ActorN']??"";
if ($title == "")
{
    $_SESSION['AMerr'] = "title cannot be left empty";
    header('Location: addFilm.php');
    exit(); 
}
if ($RDate == "")
{
    $_SESSION['AMerr'] = "date cannot be left empty";
    header('Location: addFilm.php');
    exit(); 
}
if ($plot == "")
{
    $_SESSION['AMerr'] = "plot cannot be left empty";
    header('Location: addFilm.php');
    exit(); 
}
if ($ml == "" || !ctype_digit($ml))
{
    $_SESSION['AMerr'] = "movie length cannot be left empty or movie length must be int";
    header('Location: addFilm.php');
    exit(); 
}
if ($role == "")
{
    $_SESSION['AMerr'] = "role cannot be left empty";
    header('Location: addFilm.php');
    exit(); 
}
if ($GN == "")
{
    $_SESSION['AMerr'] = "Genre cannot be left empty";
    header('Location: addFilm.php');
    exit(); 
}
if ($AN == "")
{
    $_SESSION['AMerr'] = "Actor cannot be left empty";
    header('Location: addFilm.php');
    exit(); 
}
if ($DN == "")
{
    $_SESSION['AMerr'] = "Director cannot be left empty";
    header('Location: addFilm.php');
    exit(); 
}

$_SESSION['AMerr'] = "";
$target_dir = __DIR__ . "/img-gif/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$_SESSION['path'] = $target_file;
$uploadOk = 1; 
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION['AMerr'] = "File is not an image.";
        header('Location: addFilm.php');
        exit();  
    }
}


if (file_exists($target_file)) {
    $_SESSION['AMerr'] = "Sorry, file already exists.";
    header('Location: addFilm.php');
    exit();
}


if ($_FILES["fileToUpload"]["size"] > 500000) {
    $_SESSION['AMerr'] = "Sorry, your file is too large.";
    header('Location: addFilm.php');
    exit();
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    $_SESSION['AMerr'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    header('Location: addFilm.php');
    exit();
}

if ($uploadOk == 0) {
    $_SESSION['AMerr'] = "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
    } else {
        $_SESSION['AMerr'] = "Sorry, there was an error uploading your file.";
        header('Location: addFilm.php');
        exit();
    }
}


include('connection.php');
$conn=connToDb();


$sql = "SELECT MAX(MovieID) AS MID FROM movie";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $max_id_movie = $row['MID']+1;
} else {
    $max_id_movie=1;
}

$sql = "SELECT DirectorID AS DN FROM director WHERE DirectorName =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $DN);
if($stmt->execute()){
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $directorID = $row['DN']??null;

    if($directorID===null){
        $sql = "SELECT MAX(DirectorID) AS DID FROM director";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $directorID = $row['DID']+1;
        } else {
            $directorID=1;
        }
    }
    
}
else
{
    $_SESSION['AMerr'] = "something went wrong";
    header('Location: addFilm.php');
    exit();
}


$sql = "SELECT ActorID AS AID FROM actor WHERE ActorName =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $AN);
if($stmt->execute()){
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $ActorID = $row['AID']??null;

    if($ActorID===null){
        $sql = "SELECT MAX(ActorID) AS AID FROM actor";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ActorID = $row['AID']+1;
        } else {
            $ActorID=1;
        }
    }
    
}
else
{
    $_SESSION['AMerr'] = "something went wrong";
    header('Location: addFilm.php');
    exit();
}


$sql = "SELECT GenreID AS GID FROM genre WHERE GenreName =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $GN);
if($stmt->execute()){
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $GenreID = $row['GID']??null;

    if($GenreID===null){
        $sql = "SELECT MAX(GenreID) AS GID FROM genre";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $GenreID = $row['GID']+1;
        } else {
            $GenreID=1;
        }
    }
    
}
else
{
    $_SESSION['AMerr'] = "something went wrong";
    header('Location: addFilm.php');
    exit();
}
$img = "./img-gif/".basename($_FILES["fileToUpload"]["name"]);
   

$sql = "INSERT INTO genre (GenreID, GenreName) VALUES (?, ?)";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("is", $GenreID,$GN);
    if ($stmt->execute()) {   
    } else {
        $_SESSION['AMerr'] = "something went wrong";
        header('Location: addFilm.php');
        exit();
    }


$sql = "INSERT INTO actor (ActorID, ActorName) VALUES (?, ?)";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("is", $ActorID,$AN);
    if ($stmt->execute()) {   
    } else {
        $_SESSION['AMerr'] = "something went wrong";
        header('Location: addFilm.php');
        exit();
    }

$sql = "INSERT INTO director (DirectorID, DirectorName) VALUES (?, ?)";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("is", $directorID,$DN);
    if ($stmt->execute()) {   
    } else {
        $_SESSION['AMerr'] = "something went wrong";
        header('Location: addFilm.php');
        exit();
    }

$sql = "INSERT INTO movie (MovieID, Title, ReleaseDate, Plot, MovieLength, image) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssis",$max_id_movie, $title, $RDate, $plot, $ml, $img);

if ($stmt->execute()) {   
} else {
    $_SESSION['AMerr'] = "something went wrong";
    header('Location: addFilm.php');
    exit();
}



$sql = "INSERT INTO moviecast (MovieID, ActorID, role) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $max_id_movie, $ActorID, $role);

if ($stmt->execute()) {   
} else {
    $_SESSION['AMerr'] = "something went wrong";
    header('Location: addFilm.php');
    exit();
}



$sql = "INSERT INTO moviedirector (MovieID, DirectorID) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $max_id_movie, $directorID);

if ($stmt->execute()) {   
} else {
    $_SESSION['AMerr'] = "something went wrong";
    header('Location: addFilm.php');
    exit();
}

$sql = "INSERT INTO moviegenre (MovieID, GenreiID) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $max_id_movie, $GenreID);

if ($stmt->execute()) {   
} else {
    $_SESSION['AMerr'] = "something went wrong";
    header('Location: addFilm.php');
    exit();
}
$star = 10.0;
$numOfRating = 10000;
$sql = "INSERT INTO rating (MovieID, Star, NumOfRating) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("idi", $max_id_movie, $star, $numOfRating);

if ($stmt->execute()) {   
} else {
    $_SESSION['AMerr'] = "something went wrong";
    header('Location: addFilm.php');
    exit();
}

$_SESSION['AMerr'] = "Success";
header('Location: addFilm.php');
exit();
?>