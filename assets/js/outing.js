/*KDMHS Outing Application System JS*/

/*REDIRECT IF IE USER*/
if(navigator.appName.indexOf("Internet Explorer")!=-1 || navigator.userAgent.match(/Trident.*rv[ :]*11\./))
{
    //This user uses Internet Explorer
    window.location = "./no_ie.html";
}

/*Scroll To TOP*/
var timeOut;
function scrollToTop() {
    if (document.body.scrollTop!=0 || document.documentElement.scrollTop!=0){
        window.scrollBy(0,-10);
        timeOut=setTimeout('scrollToTop()',10);
    }
    else clearTimeout(timeOut);
}

$(document).ready(function(){

    var mq = window.matchMedia("(min-width:769px)");
    var mq2 = window.matchMedia("(max-width:480px)"); //FOR VIDEO
    var mq3 = window.matchMedia("(max-width:412px)"); //FOR MOBILE_OUTING_PRINT

    if(mq2.matches) $("body").addClass("body_img");

    if(mq3.matches) $("#print_permit").css('visibility','collapse');

    /*SET DATE PROPERTIES*/
    var rad_weekday = $("#weekday");
    var rad_weekend = $("#weekend");

    if(rad_weekday.attr("checked") == true) $("#apply_notice").innerHTML="학년부장선생님/담임선생님의 허가 하에 승인 후 외출이 가능합니다.";
    else if(rad_weekend.attr("checked") == true) $("#apply_notice").innerHTML="잔류감독선생님의 허가 하에 승인 후 외출이 가능합니다.";

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = yyyy+'-'+mm+'-'+dd;
    var max = yyyy+'-12-31';

    $('#date').attr('value', today);
    $('#inquiry_date').attr('value', today);
    $('#date').attr('min', today);
    $('#date').attr('max', today);
    //$("#date").datepicker();

    /*SET VIDEOCLIP PROPERTIES*/
    var vid = document.getElementById("bgvid").addEventListener('ended', removeVid, false);
    function removeVid(e){
        $('#bgvid').css('visibility', 'collapse');
        $('body').addClass('body_img');
     }
});