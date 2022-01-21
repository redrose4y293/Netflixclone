<?php
require_once("assest/header.php");


if(!isset($_GET["id"])){

    ErrorMessage::show("No ID passed into page");
    }
    $entityid = $_GET["id"];
    $entity = new Entity($con,$entityid);
    

$preview = new PreviewProvider($con,$userLoggedin);
echo $preview->CreatpreviewVideo($entity);

$seasonprovider = new SeasonProvider($con,$userLoggedin);
echo $seasonprovider->create($entity);

$categoryContainer = new CategoryContainers($con,$userLoggedin);
echo $categoryContainer->showCategory($entity->getcategoryId(), "You might Also Liked This");


?>