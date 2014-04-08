{*<ul class="nav nav-pills mb-0">*}
<ul class="nav nav-tabs">
    <li {if $sMenuSubItemSelect=="index"}class="active"{/if}><a href="{$oTournament->getUrlFull()}">{$aLang.plugin.vs.blog}</a></li>
	<li {if $sMenuSubItemSelect=="players"}class="active"{/if}><a href="{$oTournament->getUrlFull()}players/">{$aLang.plugin.vs.players}</a></li>
	<li {if $sMenuSubItemSelect=="stats"}class="active"{/if}><a href="{$oTournament->getUrlFull()}stats/">{$aLang.plugin.vs.standings}</a></li>
	<li {if $sMenuSubItemSelect=="stats_sh"}class="active"{/if}><a href="{$oTournament->getUrlFull()}stats_sh/">{$aLang.plugin.vs.shahmatka}</a></li>

	{if $oTournament && ($oTournament->getGametypeId()==3 || $oTournament->getGametypeId()==7 ) }
		<li {if $sMenuSubItemSelect=="player_stats"}class="active"{/if}><a href="{$oTournament->getUrlFull()}player_stats/">{$aLang.plugin.vs.stats}</a></li>
	{/if}

	{if isset($po)}
		<li {if $sMenuSubItemSelect=="po"}class="active"{/if}><a href="{$oTournament->getUrlFull()}po/">{$aLang.plugin.vs.playoff}</a></li>
	{/if}

	<li {if $sMenuSubItemSelect=="shedule"}class="active"{/if}><a href="{$oTournament->getUrlFull()}shedule/">{$aLang.plugin.vs.schelude}</a></li>

	{if $oGame && $oGame->getSportId()!=4}
		<li {if $sMenuSubItemSelect=="events"}class="active"{/if}><a href="{$oTournament->getUrlFull()}events/">{$aLang.plugin.vs.games}</a></li>
	{/if}	

	<li {if $sMenuSubItemSelect=="rules"}class="active"{/if}><a href="{$oTournament->getUrlFull()}rules/">{$aLang.plugin.vs.rules}</a></li>

	{if $admin=="yes"}
		<li {if $sMenuSubItemSelect=="admin"}class="active"{/if}><a href="{$oTournament->getUrlFull()}admin/">Admin</a></li>
	{/if}
</ul>