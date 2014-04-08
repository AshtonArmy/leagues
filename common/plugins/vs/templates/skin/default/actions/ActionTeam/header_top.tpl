<header id="header" role="banner">

    {include file='header_top_part.tpl'}


{*	
 <ul id="navigation">
            <li class="home"><a href="http://virtualsports.ru" title="To main page" style="margin-left: -85px; "></a></li>			
{if ($oUserCurrent)}
            <li class="blogs"><a href="#" onclick="return false;" title="My blogs" style="margin-left: -85px; "></a></li>
            <li class="tournaments"><a href="#" onclick="return false;" title="My events" style="margin-left: -85px; "></a></li>
            <li class="matches"><a href="#" onclick="return false;" title="My games" style="margin-left: -85px; "></a></li>
{/if}
        <li class="teams"><a href="#" onclick="return false;" title="Teams" style="margin-left: -85px; "></a></li>
        </ul>
*}

{hook run='main_menu'}

{hook run='header_banner_end'}
</header>


<div id="header_logo">
</div>
{if $oTeam && $oTeam->getBlogId()}  
<div id="m_menu">
    <ul>
        <li><a href="{$oBlog->getTeamUrlFull()}">Home</a></li>
        <li><a href="{$oBlog->getUrlFull()}">Blog</a></li>
        <li><a href="{$oBlog->getTeamUrlFull()}_video">Video</a></li>
        <li><a href="{$oBlog->getTeamUrlFull()}_roster">Roster</a></li>
        <li>Stats</li>
        <li>History</li>		
		{if isset($can_edit) && $can_edit}		<li><a href="{$oBlog->getTeamUrlFull()}_au">АУ</a></li>{/if}
    </ul>
</div>
{/if}
{*
<ul id="navigation">
    <li class="home"><a href="http://virtualsports.ru" title="To main page" style="margin-left: -85px; "></a></li>
{if ($oUserCurrent)}
    <li class="blogs"><a href="#" onclick="return false;" title="My blogs" style="margin-left: -85px; "></a></li>
    <li class="tournaments"><a href="#" onclick="return false;" title="My events" style="margin-left: -85px; "></a>
    </li>
    <li class="matches"><a href="#" onclick="return false;" title="My games" style="margin-left: -85px; "></a></li>
{/if}
    <li class="teams"><a href="#" onclick="return false;" title="Teams" style="margin-left: -85px; "></a></li>
</ul>
*}

<style>

#header_logo{ 
    height: 250px;
    width: 100%;
    margin: -39px 0 0 0;
}

{if $oBlog->getStyle()}
{$oBlog->getStyle()}
{else}
#header_logo{
background: url("http://img.virtualsports.ru/default-head.png") top center;
}

{/if}
{literal} 
 

#menu {
    height: 60px;
}

.profile-user {
    margin-left: 10px;
}

#wrapper {
    background: #F2F2F2 url("http://virtualsports.ru/templates/skin/virtsports/images/bg2.png");
    margin-bottom: 0;
    padding-bottom: 60px
}
#footer {
    background: #F2F2F2 url("http://virtualsports.ru/templates/skin/virtsports/images/bg2.png");
    padding-left: 20px;
    border-radius: 0 0 10px 10px;
}

#wrapper .inn {
    margin: 0 -304px 0 0;
}

#sidebar {
    margin-right: 10px;
}

#m_menu {
    height: 32px;
    line-height: 32px;
    overflow: hidden;
    display: block;
    padding-bottom: 30px;
    background: #F2F2F2 url("http://virtualsports.ru/templates/skin/virtsports/images/bg2.png");
}

#m_menu ul, #m_menu ul li {
    margin: 0;
    padding: 0;
    list-style: none;
}

#m_menu ul li {
    float: left;
    display: block;

    margin: 0 2px;

    border-radius: 0 0 5px 5px;

    width: 130px;
    text-align: center;

    box-shadow: 0 1px 3px -1px black;

    background: #262626; /* Old browsers */
    background: -moz-linear-gradient(top,  #262626 47%, #3f3f3f 50%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(47%,#262626), color-stop(50%,#3f3f3f)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  #262626 47%,#3f3f3f 50%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  #262626 47%,#3f3f3f 50%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  #262626 47%,#3f3f3f 50%); /* IE10+ */
    background: linear-gradient(to bottom,  #262626 47%,#3f3f3f 50%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#262626', endColorstr='#3f3f3f',GradientType=0 ); /* IE6-9 */
}
#m_menu ul li:hover {
    background: #383838; /* Old browsers */
    background: -moz-linear-gradient(top,  #383838 47%, #4c4c4c 51%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(47%,#383838), color-stop(51%,#4c4c4c)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  #383838 47%,#4c4c4c 51%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  #383838 47%,#4c4c4c 51%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  #383838 47%,#4c4c4c 51%); /* IE10+ */
    background: linear-gradient(to bottom,  #383838 47%,#4c4c4c 51%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#383838', endColorstr='#4c4c4c',GradientType=0 ); /* IE6-9 */
}
#m_menu ul li:active {
    box-shadow: 0 0 3px -1px black;
}

#m_menu ul li a {
    color: #fff;
    text-decoration: none;
    display: block;
}



.topic {
    margin-left: 10px;
}
</style>
{/literal}

 