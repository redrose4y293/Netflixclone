<?php 
 require_once("class/config.php");
 require_once("assest/PreviewProvider.php");
 require_once("assest/Entity.php");
 require_once("assest/CategoryContainers.php");
 require_once("assest/EntityProvider.php");
 require_once("entity.php");
 require_once("class/ErrorMessage.php");
 require_once("class/seaseonprovider.php");
 require_once("assest/season.php");
 require_once("assest/Video.php");
 require_once("class/VideoProvider.php");
 require_once("assest/User.php");


 if(!isset($_SESSION["userloggedin"])) {
 header("Location: register.php"); 
 }
 $userLoggedin = $_SESSION["userloggedin"];

?>
<html>
        <head>
            <title>Welcome to flex Login page</title>
            <link rel="stylesheet" type="text/css" href="assest/style.css"/>
            <script src="https://kit.fontawesome.com/46936f93f7.js" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script src="assest/js/script.js"> </script>
        </head>
        <body>
        <div class='wraper'>
<?php
if(!isset($hideNav)){
include_once("assest/navbar.php");
}

?>