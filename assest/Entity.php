<?php 
class Entity {

    private $con,$sqldata;

    public function __construct($con,$input)
    {
        $this->con = $con;
        if(is_array($input)){
            $this->sqldata = $input; 
        }
        else{
            $query = $this->con->prepare("SELECT * FROM entities WHERE id=:id");
            $query->bindValue(":id",$input);
            $query->execute();

            $this->sqldata = $query->fetch(PDO::FETCH_ASSOC);

        }
    }
    public function getId() {
        return $this->sqldata["id"];
    }
    public function getName() {

    return $this->sqldata["name"];

    }
    public function getThumbnail() {

        return $this->sqldata["thumbnail"];
    }
    public function getPreview() {

        return $this->sqldata["preview"];
    }
    public function getcategoryId() {

        return $this->sqldata["categoryId"];

    }
    public function getSeasons() {
        $query = $this->con->prepare("SELECT * FROM videos WHERE entityId=:id

        AND isMovie=0 ORDER BY season,episode ASC");
        
         $query->bindValue(":id",$this->getId());
        $query->execute();

        $season = array();
        $videos = array();
        $currentSeason = null;
        while($row = $query->fetch(PDO::FETCH_ASSOC)){

        if($currentSeason != null && $currentSeason != $row["season"]) {

        $season[] = new Season($currentSeason , $videos);
        
        $videos =  array();


        }
        $currentSeason = $row["season"];
        $videos[] = new Video($this->con,$row);
        }
         if(sizeof($videos) != 0){

        $season[] = new Season($currentSeason , $videos);

        }
             return $season;
    }



}
?>