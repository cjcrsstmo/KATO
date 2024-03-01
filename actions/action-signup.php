<?php
    //This pulls the mongodb driver
    require_once '../vendor/autoload.php';

    //connecting to mongodb
    $dbconn = new MongoDB\Client("mongodb://localhost:27017");
    
    //connecting to a specific database
    $database = $dbconn -> katodb;

    //connecting to the database collection
    $userCollection = $database->users;

    // Counter collection for user IDs
    $counterCollection = $database->userCounter; 


    //Getting the inputted details 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {


         // Fetch the next available user ID and increment the counter
        $counterDocument = $counterCollection->findOneAndUpdate(
            ['_id' => 'userIdCounter'],
            ['$inc' => ['sequence_value' => 1]],
            [
                'upsert' => true,
                'returnDocument' => MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER
            ]
        );


        $userId = $counterDocument['sequence_value'];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $passwd = $_POST["passwd"];

        // Hash the password using bcrypt
        $hashedPassword = password_hash($passwd, PASSWORD_BCRYPT);

    };

    //Making an array (json)
    $userData = array(
        "userId" => $userId,
        "username" => $username,
        "email" => $email,
        "passwd" => $hashedPassword
    );

    //inserting into the database
    $insertUserdata = $userCollection->insertOne($userData);

    // Message variable to store the registration status
    $message = "";

     // Check if the insertion was successful
    if ($insertUserdata->getInsertedCount() > 0) {


        // Set success message
        $message = "Registration successful! You can now login.";

        // Generate JavaScript code for alert then redirect to the login page
        echo '<script>alert("' . $message . '"); window.location.href = "../signup.php";</script>';



    } else {

        $message = "Error registering user.";
        
        echo '<script>alert("' . $message . '");</script>'; 
    }

?>

