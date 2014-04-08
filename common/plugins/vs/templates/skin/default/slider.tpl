{if $aSliderTopics and count($aSliderTopics)}

<div> 

<ul id="test-slide">
{assign var="num" value=0}
		{foreach from=$aSliderTopics item=oTopic}
		{assign var="oUser" value=$oTopic->getUser()}
		{assign var="num" value=$num+1}
		
		<li>
			<div style="height:394px; width:700px;">
					{if $oTopic->getType()=='photoset'}
						{assign var=oMainPhoto value=$oTopic->getPhotosetMainPhoto()}
						{*<div class="topic-photo-preview" onclick="window.location='{$oTopic->getUrl()}#photoset'">
							<div class="topic-photo-count"><span>{$oTopic->getPhotosetCount()}</span></div>*}
							<a href="{$oTopic->getUrl()}#photoset" target="_blank">
								<img src="{$oMainPhoto->getWebPath('385crop')}" alt="image" />
							</a>
						{*</div>
						*}
					{elseif $oTopic->getType()=='video'}
						{$oTopic->getVideo()}
						 
					{elseif $oTopic->getPreviewImage()}
						<a href="{$oTopic->getUrl()}" target="_blank">
							<img src="{$oTopic->getPreviewImageWebPath('700crop')}" alt="image" /> 
							<div class="caption">{$oTopic->getTextShort()|strip_tags|truncate:450:'...'}</div>
						</a>
					{else}
						<a href="{$oTopic->getUrl()}" target="_blank">
						
						<img src="http://img.virtualsports.ru/{$oBlog->getBlogUrl()|lower}.jpg" alt="image" /> 
							<div style="height:394px;">
								<div class="caption">{$oTopic->getTextShort()|strip_tags|truncate:450:'...'}</div>
							</div>
						</a>
					{/if} 
			</div>		
		 </li>
	 
		{/foreach}
</ul>
</div>
 <div id="externalNav"> 
 <ul class="zagolovki">
{assign var="num" value=0}
{foreach from=$aSliderTopics item=oTopic}
{assign var="num" value=$num+1}
<li slide="#{$num}">{$oTopic->getTitle()|strip_tags|truncate:25:'...'}</li>
{/foreach}
</ul>
</div>


<link rel="stylesheet" href="http://virtualsports.ru/bot_test/anythingslider.css">
<script src="http://virtualsports.ru/bot_test/jquery.anythingslider.min.js"></script>
<script src="http://virtualsports.ru/bot_test/jquery.anythingslider.video.min.js"></script>
<script src="http://virtualsports.ru/bot_test/jquery.anythingslider.fx.min.js"></script>
<script src="http://virtualsports.ru/bot_test/jquery.easing.1.2.js"></script> 
<script src="http://virtualsports.ru/bot_test/swfobject.js"></script> 

<script>
$(function(){
 


var nav = $('.zagolovki li');
    updateNav = function(page){
        nav
            .removeClass('cur')
            .eq(page).addClass('cur');
    }

$('#test-slide').anythingSlider({ 
    buildNavigation: false,
	resizeContents : false, 
	buildStartStop : false,
	buildArrows                 : false,
	autoPlay            : true,
	delay               : 5000,
	resizeContents      : false, 
	hashTags            : false, 
    onInitialized: function(e, slider) {
        updateNav(slider.currentPage-1); 
    }, 
    onSlideBegin: function(e, slider) {
        updateNav(slider.targetPage-1);
    }
});
 
 
$(".zagolovki li").click(function () {
    var slide = $(this).attr('slide').substring(1);
    $('#test-slide').anythingSlider(slide);
    return false;
});

			 
		});

 
 
</script>
<style>
.zagolovki { 
list-style: none;  
margin: 0 auto; 
padding: 0 0px 20px 0px;
width: 700px;
background: -ms-linear-gradient(top,#2A2A2A 0,#494949 50%,#343434 50%,black 100%);
background: -moz-linear-gradient(top,#2A2A2A 0,#494949 50%,#343434 50%,black 100%);
background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#2A2A2A),color-stop(50%,#494949),color-stop(50%,#343434),color-stop(100%,black));
background: -webkit-linear-gradient(top,#2A2A2A 0,#494949 50%,#343434 50%,black 100%);
background: -o-linear-gradient(top,#2A2A2A 0,#494949 50%,#343434 50%,black 100%);
background: -ms-linear-gradient(top,#2A2A2A 0,#494949 50%,#343434 50%,black 100%);

}

.zagolovki li{
width:174px; 
padding: 0;
margin: 0;
float: left;
cursor:pointer;  

border-right: 1px solid #555;
height: 19px;
margin: 1px 0;
color: white;
text-align: center;
font: normal 12px/18px 'Arial narrow',sans-serif;

background: -ms-linear-gradient(top,#2A2A2A 0,#494949 50%,#343434 50%,black 100%);
background: -moz-linear-gradient(top,#2A2A2A 0,#494949 50%,#343434 50%,black 100%);
background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#2A2A2A),color-stop(50%,#494949),color-stop(50%,#343434),color-stop(100%,black));
background: -webkit-linear-gradient(top,#2A2A2A 0,#494949 50%,#343434 50%,black 100%);
background: -o-linear-gradient(top,#2A2A2A 0,#494949 50%,#343434 50%,black 100%);
background: -ms-linear-gradient(top,#2A2A2A 0,#494949 50%,#343434 50%,black 100%);
}


.zagolovki li.cur {
background: #0183DA;
background: -moz-linear-gradient(top,#44A0ED 50%,#037DD2 50%);
background-image: -webkit-gradient(linear,0% 0,0% 100%,color-stop(0.5,#44A0ED),color-stop(0.5,#037DD2));
border-radius: 4px;
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
border-right: 0;
border-left: 0; 
height: 18px;
line-height: 17px;
}
.caption {
    width: 690px;
    height: 70px;
    margin: 0 auto;
    padding: 5px;
    border-top: #44A0ED 5px solid; /* adjust border color and size here */
    text-align: left;
    background: rgba(80,80,80,.5); /* adjust caption background color here */
    color: #ddd;
    position: absolute;
    bottom: 0;
    left: 0;
    cursor: pointer;
}
#externalNav{
margin-bottom:10px;
}
</style>
{/if}