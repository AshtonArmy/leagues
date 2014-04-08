<ul class="header_turnirs" id="header_turnirs" style="display:none;">
{foreach from=$Tournaments item=oTournament} 
	{assign var="oBlog" value=$oTournament->getBlog()}
	<li><a href="{$oBlog->getUrlFull()}turnir/{$oTournament->getUrl()}">{$oTournament->getBrief()}</a></li> 
{/foreach}
</ul>