<?php

require_once("../class/config.php");

if(isset($_POST["videoId"]) && isset($_POST["username"] )) {

    $query = $con->prepare("SELECT progress FROM videoprogress
    
                        WHERE username=:username AND videoId=:videoId");

                        $query->bindValue(":videoId",$_POST["videoId"]);

                        $query->bindValue(":username",$_POST["username"]);

                        $query->execute();

                        echo $query->fetchColumn();

   
                        
}
else {
    echo "No video Id or username";
}



?>