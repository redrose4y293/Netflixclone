<?php 

class EntityProvider{


public static function getEntities($con, $categoryid, $limits){

    $sql = "SELECT * FROM entities ";

    if($categoryid != null) {
    $sql .= "WHERE categoryId=:categoryId ";
    }
    $sql .= "ORDER BY RAND() LIMIT :limit";

    $query = $con->prepare($sql);

    if($categoryid != null) {

        $query->bindValue(":categoryId",$categoryid);
    }

    $query->bindValue(":limit",$limits,PDO::PARAM_INT);
    $query->execute();

    $result = array();
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $result[] = new Entity($con,$row);
    }
    return $result;
}
public static function getTvShowsEntities($con, $categoryid, $limits){

        $sql = "SELECT DISTINCT(entities.id) FROM entities 

                INNER JOIN videos ON entities.id = videos.entityid

                 WHERE videos.isMovie =0 ";
    
        if($categoryid != null) {
        $sql .= "AND categoryId=:categoryId ";
        }
        $sql .= "ORDER BY RAND() LIMIT :limit";
    
        $query = $con->prepare($sql);
    
        if($categoryid != null) {
    
            $query->bindValue(":categoryId",$categoryid);
        }
    
        $query->bindValue(":limit",$limits,PDO::PARAM_INT);
        $query->execute();
    
        $result = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Entity($con,$row["id"]);
        }
        return $result;
    
    
}
public static function getMovieShowsEntities($con, $categoryid, $limits){

            $sql = "SELECT DISTINCT(entities.id) FROM entities 
    
                    INNER JOIN videos ON entities.id = videos.entityid
    
                     WHERE videos.isMovie = 1 ";
        
            if($categoryid != null) {
            $sql .= "AND categoryId=:categoryId ";
            }
            $sql .= "ORDER BY RAND() LIMIT :limit";
        
            $query = $con->prepare($sql);
        
            if($categoryid != null) {
        
                $query->bindValue(":categoryId",$categoryid);
            }
        
            $query->bindValue(":limit",$limits,PDO::PARAM_INT);
            $query->execute();
        
            $result = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $result[] = new Entity($con,$row["id"]);
            }
            return $result;               
}
public static function getSearchEntities($con, $term){

                $sql = "SELECT * FROM entities WHERE name LIKE CONCAT('%' , :term ,'%') LIMIT 30";       
                $query = $con->prepare($sql); 
                $query->bindValue(":term",$term);
                $query->execute();
            
                $result = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $result[] = new Entity($con,$row);
                }
                return $result;
}
}

?>