    <?php
    $hideNav = true;
    require_once("assest/header.php");

    if(!isset($_GET["id"])){

    ErrorMessage::show("No id Passed into the page");
    }
    $video = new Video($con,$_GET["id"]);

    $video->increamentVideos();

    $upNextVideo = VideProvider::getUpNext($con,$video);

    ?>

    <div class="watchcontainer">

        <div class="videoControls watchNav" >
            <button onclick="goback()"><i class="fas fa-arrow-left"></i></button>
            <h1><?php echo $video->getTitle();?></h1>
        

        <div class="VideoContols upNext" style="display: none;">
        <button onclick="restartVideo();"><i class="fas fa-redo"></i></button>
        <div class="UpNextContainer">
        <h2>Up Next:</h2>
        <h3><?php echo $upNextVideo->getTitle(); ?></h3>
        <h3><?php echo $upNextVideo->getSeasonandEpisode(); ?></h3>
        <button class="PlayNext" onclick="watchVideo(<?php echo $upNextVideo->getId();?>)">
        <i class="fas fa-play"></i> Play
        </button>
        </div>
        </div>
        </div>
        <video controls autoplay onended="showUpnext()">

        <source src='<?php echo $video->getfilepath();?>' type='video/mp4' >

        </video>
        </div>
        <script>
        intiVideo("<?php echo $video->getId();?>" , "<?php echo $userLoggedin; ?>");
        </script>