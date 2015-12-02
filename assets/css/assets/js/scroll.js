$(document).ready(function() {
    var mNav = $('#mNav');
    var Logo = $('#logo');
    var lnb = $('#lnb');
    $(window).scroll(function () {
        if ($(this).scrollTop() > ($('#logo').height()) / 3) {
            mNav.css('visibility', 'visible');
            Logo.css('visibility', 'collapse');
            lnb.css('visibility', 'collapse');
            Logo.addClass("float-menu");
            mNav.addClass("slide");
        } else {
            mNav.css('visibility', 'collapse');
            Logo.css('visibility', 'visible');
            lnb.css('visibility', 'visible');
            Logo.removeClass("float-menu");
        }
    });
});