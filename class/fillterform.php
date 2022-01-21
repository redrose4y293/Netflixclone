<?php
class filterform {
    public static function sanitizerFormstring($inputtext){
    $inputtext = strip_tags($inputtext);
    $inputtext = str_replace(" ","",$inputtext);
    $inputtext = strtolower($inputtext);
    $inputtext = ucfirst($inputtext);
    return $inputtext;
 }
    public static function sanitizerFormusername($inputtext){
    $inputtext = strip_tags($inputtext);
    $inputtext = str_replace(" ","",$inputtext);
    return $inputtext;
    }
    
    public static function sanitizerFormpassword($inputtext){
        $inputtext = strip_tags($inputtext);
        return $inputtext;
    }
    public static function sanitizerFormEmail($inputtext){
        $inputtext = strip_tags($inputtext);
        $inputtext = str_replace(" ","",$inputtext);
        return $inputtext;
        }

}


?>