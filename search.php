<?php

include_once("assest/header.php");
?>

<div class="search-box">
    <input type="text" class="searchInput" placeholder="Search for Some Thing">

</div>
<div class="results"></div>

<script>

$(function(){
    var username = '<?php echo $userLoggedin ?>';
  var $timer ; 
  $(".searchInput").keyup(function(){
      clearTimeout($timer);

    timer = setTimeout(function(){

        var val = $(".searchInput").val();
        
        if(val != "") {

            $.post("ajax/getSearchresult.php", {term: val, username: username},function(data){

                $(".results").html(data);
            })

        }
        else {

            $(".results").html("");
        }


    }, 500);
  })    
})


</script>