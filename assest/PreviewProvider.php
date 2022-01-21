<?php

class PreviewProvider {

    private $con,$username;


    public function __construct($con,$username)
    {
        $this->con = $con;
        $this->username  = $username;

    }
    public function CreateTvShowvideo()
    {
    
        $entityArray= EntityProvider::getTvShowsEntities($this->con,null,1);

        if(sizeof($entityArray) == 0){
            ErrorMessage::show("No Tv Show to Dislpay");
        }
        return $this->CreatpreviewVideo($entityArray[0]);

    }
    public function CreatecategoryShowvideo($categoryid)
    {
    
        $entityArray= EntityProvider::getEntities($this->con,$categoryid,1);

        if(sizeof($entityArray) == 0){
            ErrorMessage::show("No Movies to Dislpay");
        }
        return $this->CreatpreviewVideo($entityArray[0]);

    }

    public function CreateMovieShowvideo()
    {
    
        $entityArray= EntityProvider::getMovieShowsEntities($this->con,null,1);

        if(sizeof($entityArray) == 0){
            ErrorMessage::show("No Movies to Dislpay");
        }
        return $this->CreatpreviewVideo($entityArray[0]);

    }
    public function CreatpreviewVideo($entity) {

        if($entity == null ){

            $entity = $this->getRandomEntity();

        }
        
        $id = $entity->getId();
        $name  = $entity->getName();
        $thumbnail = $entity->getThumbnail();
        $preview = $entity->getPreview();

        $videoid = VideProvider::getentityVideoidforuser($this->con,$id,$this->username);
        $video = new Video($this->con, $videoid);
        
        $inProgress = $video->isInProgress($this->username);

        $palyButtonText = $inProgress ? "Continue Watching " : "Play";

        $seasonEpisode = $video->getSeasonandEpisode();

        $subHeading = $video->IsMovie() ? "" : "<h4>$seasonEpisode</h4>"; 
         return "<div class='previewContainer'>

          <img src='$thumbnail' class='previewImage' hidden>
        
          <video autoplay muted class='previewVideos' onended='previewEnded()'>

          <source src='$preview' type='video/mp4'>

          </video>

          <div class='previewOverlay'>

                <div class='mainDetails'>

                <h3>$name</h3>
                $subHeading
            <div class='playingbutton'>

            <button onclick='watchVideo($videoid)'>$palyButtonText</button>

            <button onclick='volumetoggle(this)'>Volume</button>
            </div>



                </div>

            </div>

                </div>";
    }
    public function createEntityPreviewsqure($entity){
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        return "<a href='entity.php?id=$id'>
            <div class='previewContainer small'>
            <img src='$thumbnail' title='$name'>
            </div>
              </a>";
    }
    public function getRandomEntity() {

        $entity = EntityProvider::getEntities($this->con, null, 1);
      return $entity[0];
    }
}

?>