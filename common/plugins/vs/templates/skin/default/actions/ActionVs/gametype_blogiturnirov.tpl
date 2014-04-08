{include file='header.tpl' menu='blog'}
{*<div class="turnirmenu">
	<ul>
		<li><a href="{$link}"><span class="bgl"></span><span class="bgi">{$aLang.plugin.in_blogs}</span><span class="bgr"></span></a></li>
		<li class="active"><a href="{$link_blogiturnirov}"><span class="bgl"></span><span class="bgi">{$aLang.plugin.events}</span><span class="bgr"></span></a></li>
		<li><a href="{$link_nastroiki}"><span class="bgl"></span><span class="bgi">{$aLang.plugin.vs.settings}</span><span class="bgr"></span></a></li>
		<li><a href="{$link_tovarki}"><span class="bgl"></span><span class="bgi">{$aLang.plugin.vs.friendlies}</span><span class="bgr"></span></a></li>
		<li><a href="{$link_rating}"><span class="bgl"></span><span class="bgi">{$aLang.plugin.vs.rankings}</span><span class="bgr"></span></a></li>
		<li><a href="{$link_ofrating}"><span class="bgl"></span><span class="bgi">{$aLang.plugin.vs.ofrankings}</span><span class="bgr"></span></a></li>
	</ul>
</div>*}
{include file="$sTemplatePathPlugin/actions/ActionVs/gametype_menu.tpl"  whats="blogiturnirov"}
<div class="page people top-blogs">	
{include file='blog_list.tpl'}
</div>

{include file='paging.tpl' aPaging=$aPaging}


{include file='footer.tpl'}