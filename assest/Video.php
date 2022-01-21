<?php
class Video {

    private $con,$sqldata , $entity;

    public function __construct($con,$input)
    {
        $this->con = $con;
        if(is_array($input)){
            $this->sqldata = $input; 
        }
        else{
            $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
            $query->bindValue(":id",$input);
            $query->execute();

            $this->sqldata = $query->fetch(PDO::FETCH_ASSOC);
        }
        $this->entity = new Entity($con, $this->sqldata["entityId"]);
    }
    public function getId(){
    return $this->sqldata["id"];
    }
    public function getTitle(){
        return $this->sqldata["title"];
    }
    public function getDetails(){
        return $this->sqldata["description"];
    }
    public function getfilepath(){
        return $this->sqldata["filePath"];
    }
    public function getthumbnail() {
        return $this->entity->getthumbnail();
    }
    public function getEpisodeNumber() {
        return $this->sqldata["episode"];
    }

    public function getSeasonNumber() {
        return $this->sqldata["season"];
    }
    public function getEntityId(){
        return $this->sqldata["entityId"];
    }
    public function increamentVideos(){
    
    $query = $this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
    $query->bindValue(":id",$this->getId());
    $query->execute();
    }

    public function getSeasonandEpisode() {
        if($this->isMovie()) {
       return;
        }
        $season  = $this->getSeasonNumber();
        $episode = $this->getEpisodeNumber();

        return "Season $season , Episode $episode";
    }
    public function IsMovie() {
        return $this->sqldata["isMovie"] == 1;
    }
    public function isInProgress($username) {
        $query = $this->con->prepare("SELECT * FROM videoprogress WHERE videoId=:videoId AND
                                    username=:username");
        $query->bindValue(":videoId",$this->getId());
        $query->bindValue(":username",$username);
        $query->execute();
        return $query->rowCount() != 0;
    }
    public function hasSeen($username) {
        $query = $this->con->prepare("SELECT * FROM videoprogress WHERE videoId=:videoId AND 
                                        username=:username AND
                                        finished=1");
        $query->bindValue(":videoId",$this->getId());
        $query->bindValue(":username",$username);
        $query->execute();

        return $query->rowCount() !=0;
    }

}





?>