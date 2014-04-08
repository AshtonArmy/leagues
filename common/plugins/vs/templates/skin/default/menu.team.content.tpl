{if isset($oTeam) && $oTeam && $oTeam->getBlogId() && isset($oBlog) && $oBlog}  
<ul class="nav nav-tabs">
	<li {if $sMenuSubItemSelect=="index"}class="active"{/if}><a href="{$oBlog->getTeamUrlFull()}">Home</a></li>
	<li {if $sMenuSubItemSelect=="blog"}class="active"{/if}><a href="{$oBlog->getUrlFull()}">Blog</a></li>
	<li {if $sMenuSubItemSelect=="video"}class="active"{/if}><a href="{$oBlog->getTeamUrlFull()}_video">Video</a></li>
	<li {if $sMenuSubItemSelect=="roster"}class="active"{/if}><a href="{$oBlog->getTeamUrlFull()}_roster">Roster</a></li>
	<li {if $sMenuSubItemSelect=="stats"}class="active"{/if}><a href="#">Stats</a></li>
	<li {if $sMenuSubItemSelect=="history"}class="active"{/if}><a href="#">History</a></li>		
	{if isset($can_edit) && $can_edit}		<li {if $sMenuSubItemSelect=="au"}class="active"{/if}><a href="{$oBlog->getTeamUrlFull()}_au">Admin</a></li>{/if}

    {*<li {if $sMenuSubItemSelect=="index"}class="active"{/if}><a href="{$oTournament->getUrlFull()}">{$aLang.plugin.vs.blog}</a></li>
	<li {if $sMenuSubItemSelect=="players"}class="active"{/if}><a href="{$oTournament->getUrlFull()}players/">{$aLang.plugin.vs.players}</a></li>
	<li {if $sMenuSubItemSelect=="stats"}class="active"{/if}><a href="{$oTournament->getUrlFull()}stats/">{$aLang.plugin.vs.standings}</a></li>

	{if $oTournament && ($oTournament->getGametypeId()==3 || $oTournament->getGametypeId()==7 ) }
		<li {if $sMenuSubItemSelect=="player_stats"}class="active"{/if}><a href="{$oTournament->getUrlFull()}player_stats/">{$aLang.plugin.vs.stats}</a></li>
	{/if}

	{if isset($po)}
		<li {if $sMenuSubItemSelect=="po"}class="active"{/if}><a href="{$oTournament->getUrlFull()}po/">{$aLang.plugin.vs.playoff}</a></li>
	{/if}

	<li {if $sMenuSubItemSelect=="shedule"}class="active"{/if}><a href="{$oTournament->getUrlFull()}shedule/">{$aLang.plugin.vs.schelude}</a></li>

	{if $oGame && $oGame->getSportId()!=4}
		<li {if $sMenuSubItemSelect=="sobytiya"}class="active"{/if}><a href="{$oTournament->getUrlFull()}events/">{$aLang.plugin.vs.games}</a></li>
	{/if}

	{if $admin=="yes"}
		<li {if $sMenuSubItemSelect=="au"}class="active"{/if}><a href="{$oTournament->getUrlFull()}au/">Admin</a></li>
	{/if}

	<li {if $sMenuSubItemSelect=="reglament"}class="active"{/if}><a href="{$oTournament->getUrlFull()}reglament/">{$aLang.plugin.vs.rules}</a></li>
*}
</ul>
{/if}