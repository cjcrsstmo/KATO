<?php
    session_start();

    //This pulls the mongodb driver
    require_once '../vendor/autoload.php';

    //connecting to mongodb
    $dbconn = new MongoDB\Client;
    
    //connecting to a specific database
    $myDatabase = $dbconn -> katodb;

    //connecting to the database collection
    $userCollection = $myDatabase->users;

    //Getting the inputted details 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {

        $username = $_POST["username"];
        $passwd = $_POST["passwd"];

    };

    //fetching the data
    $fetchUserdata = $userCollection->findOne(['username' => $username]);

    //message
    $message = "User not found";



    $hashedPasswordfromDB = $fetchUserdata['passwd'];

    // This will verify the entered password against the hashed password
    if(password_verify($passwd, $hashedPasswordfromDB)){


            header("location: ../profile-gallery.php");
    } else {
            echo '<script>alert("' . $message . '"); window.location.href = "../signup.php";</script>';
    }   ;

?>

