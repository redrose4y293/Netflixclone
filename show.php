<?php
   require_once("assest/header.php");
   
   
    $preview = new PreviewProvider($con,$userLoggedin);
    echo $preview->CreateTvShowvideo();

    $showcategory = new CategoryContainers($con,$userLoggedin);
    echo $showcategory->showtvCategories();
    ?>
