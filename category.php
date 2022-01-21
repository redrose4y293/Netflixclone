<?php
   require_once("assest/header.php");
  
   if(!isset($_GET["id"])) {
       ErrorMessage::show("No id passed");
   }
   
    $preview = new PreviewProvider($con,$userLoggedin);
    echo $preview->CreatecategoryShowvideo($_GET["id"]);

    $showcategory = new CategoryContainers($con,$userLoggedin);
    echo $showcategory->showCategory($_GET["id"]);
    ?>
 