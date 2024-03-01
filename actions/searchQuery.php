

<?php

//This pulls the mongodb driver
require_once '../vendor/autoload.php';


// Connect to MongoDB
session_start();

$dbconn = new MongoDB\Client("mongodb://localhost:27017");


//connecting to a specific database
$database = $dbconn->selectDatabase("katodb");

    
// Image Collection
$imageCollection = $database->selectCollection("gallery");



// Define the range of photoIds 
$startPhotoId = 1;
$endPhotoId = 100; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/searchh.css">

    <title>Home</title>
</head>
<body>
<!-- HEADER -->
    <header>

        <!-- LOGO -->
        <div class="logo">
            <img src="../images/logo.png" alt="logo">
        </div>

        <!-- This is the NAV bar -->
        <ul class="navbar-area">
            <li><a href="../profile-gallery.php">Gallery</a></li>
            <li><a href="../categories.php">Category</a></li>
            <li><a href="../news.php">News</a></li>
            <li><a href="../aboutus.php">About Us</a></li>
        </ul>

        <!-- This is the SEARCH bar -->
        <div class="searchContainer">
            <table class="textContainer">
                <tr>
                    <td>

                    
                        <input type="text" placeholder="search" id="search" class="search">
                    </td>
                    <td>
                        <a href=""> <svg xmlns="http://www.w3.org/2000/svg" height="1.3em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#114b5f}</style><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></a>
                    </forms>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Profile -->
            <div class="profile-pic">
                <a href="../profile/profile-favorites.php"><img src="../images/profile.png" alt="profile"></a>
            </div>
    </header>
            

    </header>

    <div class="titleBox">
        <img src="../images/gallery.png" alt="title-gallery">
    </div>


<!-- MAIN -->
    <main>

        <!-- Gallery -->
        
        <?php
        // Retrieve all image details
        $imageDetails = $imageCollection->find();?> 
                        
        <div class="imgcontainer">        
            <div class="image-container"> 

                <?php foreach ($imageDetails as $image): ?>
                <div class="image-container">

            <!-- Img url variable -->
                <?php $imagePath = 'KATO/images/' ;?>

            <!-- Display the image -->
            <img src="<?php echo $imagePath; ?>" alt="<?php echo $image['title']; ?>">
            <p>Title: <?php echo $image['title']; ?></p>
                </div>
            <?php endforeach; ?>
            </div>

            </div>
        </div>
    </main>

    

    <script>
        window.onclick = function(event) {
        var modal = document.getElementById('modal-box');
        if (event.target == modal) {
        modal.style.display = "none";
        }
    }
    </script>  




    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="index.js"></script>

</body>
</html>