<?php

require_once("../class/config.php");

if(isset($_POST["videoId"]) && isset($_POST["username"])) {

    $query = $con->prepare("SELECT * FROM videoprogress WHERE username=:username
                        AND videoId=:videoId");
                        $query->bindValue(":videoId",$_POST["videoId"]);

                        $query->bindValue(":username",$_POST["username"]);

                        $query->execute();

          if($query->rowCount() == 0) {
        $query = $con->prepare("INSERT INTO videoprogress (username,videoId) 
                                VALUE(:username,:videoId)");
            $query->bindValue(":username",$_POST["username"]);

            $query->bindValue(":videoId",$_POST["videoId"]);

            $query->execute();
          }
                           
}
else {
    echo "No video Id or username";
}



?>