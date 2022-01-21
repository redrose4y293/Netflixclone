<?php
class Season {
private $seasonNumber,$videso;

public function __construct($seasonNumber,$videos)
{
    $this->seasonNumber = $seasonNumber;
    $this->videos = $videos;
}

public  function getSeasonNunber()
{
    return $this->seasonNumber;
}
public function getVideos()
{
    return $this->videos;
}








}
?>