    <?php
    class SeasonProvider {
    private $con,$username;

    public function __construct($con,$username)
    {
    $this->con = $con;
    $this->username = $username;
        
    }
    public function create($entity){
    $seasons = $entity->getSeasons();

    if (sizeof($seasons)== 0 ) {
        return;
    }
    $seasonHtml = "";
    foreach($seasons as $season){
 
    $seasonNumbser=  $season->getSeasonNunber();

        $videosHtml = "";
        
        foreach($season->getVideos() as $video) {

            $videosHtml .= $this->createVideoSquare($video);
        }


    $seasonHtml .= "<div class='season'>
                    <h3>Season $seasonNumbser</h3>
                    <div class='video'>
                        $videosHtml
                            </div>
                        </div>";
    }
    return $seasonHtml;
    }
    private function createVideoSquare($video){
        $id = $video->getId();
        $thumbnail = $video->getthumbnail();
        $name = $video->getTitle();
        $descraption = $video->getDetails();
        $episodeNumber = $video->getEpisodeNumber();
        $hasSeen = $video->hasSeen($this->username) ? "<i class='fas fa-check-square seen'></i>" : "" ;

        return "<a href='watch.php?id=$id'>
                <div class='episodeContainer'>

                <div class='contents'>

                    <img src='$thumbnail'>

                        <div class='videoinfo'>

                        <h4>$episodeNumber. $name</h4>

                        <span>$descraption</span>

                        </div>
                        $hasSeen
                    </div>
                 </div>
                </a>";

    }
   

 }

?>