<?php

require_once("../class/config.php");
require_once("../class/searchResultProvider.php");
require_once("../assest/EntityProvider.php");
require_once("../assest/Entity.php");
require_once("../assest/PreviewProvider.php");

if(isset($_POST["term"]) && isset($_POST["username"] )) {

    $Serach = new SearchResultProvider($con,$_POST["username"]);
     echo $Serach->getResults($_POST['term']);
}
else {
    echo "No  term or username";
}
?>