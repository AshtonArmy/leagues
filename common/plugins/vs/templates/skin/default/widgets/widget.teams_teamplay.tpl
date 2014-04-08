{if $Teams}
<ul class="stream-content">
{foreach from=$Teams item=oTeam}  
	{assign var="oBlog" value=$oTeam->getBlog()}
	{assign var="oGame" value=$oTeam->getGame()}
	<li><a href="{$oBlog->getTeamUrlFull()}">{$oTeam->getName()}</a> {if $oGame && $oGame->getPlatformId()==1}PS3{/if}{if $oGame && $oGame->getPlatformId()==2}Xbox{/if}</li> 
{/foreach}
</ul>
{else}
странно
{/if}