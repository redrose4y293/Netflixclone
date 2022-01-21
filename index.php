    <?php
   require_once("assest/header.php");
   
   
    $preview = new PreviewProvider($con,$userLoggedin);
    echo $preview->CreatpreviewVideo(null);

    $showcategory = new CategoryContainers($con,$userLoggedin);
    echo $showcategory->showAllCategories();
    ?>
