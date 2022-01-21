<?php
   require_once("assest/header.php");
   
   
    $preview = new PreviewProvider($con,$userLoggedin);
    echo $preview->CreateMovieShowvideo();

    $showcategory = new CategoryContainers($con,$userLoggedin);
    echo $showcategory->showMoviesCategories();
    ?>
