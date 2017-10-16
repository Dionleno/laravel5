
$(function(){

    if($(document).width()>500){
bioEp.init({
        width:500,
        html: $("#bio_ep_content").html(),
        css: '#bio_ep_content,#bio_ep{width:500px;height:450px;background: url(../images/px_azulescuro.png);color:#FFF;}.intro{padding:20px;}' +
            '#bio_ep_content {padding: 24px 0 0 0; font-family:"PT Sans", sans-serif;}',       
        cookieExp: 2,
        delay:5,
        showOnDelay:true
    });

    }
    
});