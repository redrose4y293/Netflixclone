$(document).scroll(function(){

    var isScrolled = $(this).scrollTop() > $(".topbar").height();
        $(".topbar").toggleClass("scrolled",isScrolled);

    })
    
    
    function volumetoggle(){

        var muted = $(".previewVideos").prop("muted");
        $(".previewVideos").prop("muted",!muted);
    }

    function previewEnded(){
        $(".previewVideos").toggle();
        $(".previewImage").toggle();
    }
    function goback() {
        window.history.back();
    }
    function settimer(){
        var timeout = null;
        $(document).on("mousemove",function(){
        clearTimeout(timeout);
        $(".watchNav").fadeIn();

            timeout = setTimeout(function(){

                $(".watchNav").fadeOut();
            },2000);
        })
    }
    function intiVideo(videoId, username){
        settimer();
        setProgress(videoId,username);
        addprogress(videoId, username);
        
    }
    function addprogress(videoId, username) {
        addduration(videoId , username);

        var timer;
       $("video").on("playing",function(event){

        window.clearInterval(timer);

        timer = window.setInterval(function (){

            updateVideoProgress(videoId,username,event.target.currentTime);
        },3000);

       })
       .on("ended" , function(){
        setFinished(videoId,username);
        window.clearInterval(timer);
       })
}
    function addduration(videoId ,  username) {
    $.post("ajax/addduration.php", { videoId: videoId, username: username }, function(data){
        if(data !== null && data !== "" ){

            alert(data);
        }
    })

}
function updateVideoProgress(videoId,username,progress) {
    
    $.post("ajax/updateduration.php", { videoId: videoId, username: username , progress: progress }, 
                    function(data){

        if(data !== null && data !== "" ){

            alert(data);
        }
    })
}
function setFinished(videoId,username) {
    
    $.post("ajax/setFinished.php", { videoId: videoId, username: username},
                    function(data){
                        
        if(data !== null && data !== "" ){

            alert(data);
        }
    })
}

function setProgress(videoId,username) {
    
    $.post("ajax/setProgress.php", { videoId: videoId, username: username}, function(data){
        if(isNaN(data)){
            alert(data);
            return;
        }          
        
        $("video").on("canplay" , function () {
            this.currentTime = data;
            $("video").off("canplay");

        })
        
    })
}
function restartVideo() {
    $("video")[0].currentTime = 0;
    $("video")[0].play();
    $(".upNext").fadeOut();
}
function watchVideo(videoId) {
    window.location.href = "watch.php?id=" + videoId;
}
function showUpnext() {
    
    $(".upNext").fadeIn();
}