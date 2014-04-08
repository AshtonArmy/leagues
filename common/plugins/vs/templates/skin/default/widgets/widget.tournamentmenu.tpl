<div>
{include file='menu.tournament.content.tpl'} 
{*
	<ul class="nav nav-tabs">
		<li {if $whats==""}class="active"{/if}><a href="{$oTournament->getUrlFull()}">{$aLang.plugin.vs.blog}</a></li>
		<li {if $whats=="_uchastniki"}class="active"{/if}><a href="{$oTournament->getUrlFull()}/_uchastniki">{$aLang.plugin.vs.players}</a></li>
		<li {if $whats=="_stats"}class="active"{/if}><a href="{$link_stats}#tour-menu">{$aLang.plugin.vs.standings}</a></li>

		{if $oTournament && ($oTournament->getGametypeId()==3 || $oTournament->getGametypeId()==7 ) }
			<li {if $whats=="_player_stats"}class="active"{/if}><a href="{$oTournament->getUrlFull()}/_player_stats">{$aLang.plugin.vs.stats}</a></li>
		{/if}

		{if isset($po)}
			<li {if $whats=="_po"}class="active"{/if}><a href="{$oTournament->getUrlFull()}/_po">{$aLang.plugin.vs.playoff}</a></li>
		{/if}

		<li {if $whats=="_raspisanie"}class="active"{/if}><a href="{$oTournament->getUrlFull()}/_raspisanie">{$aLang.plugin.vs.schelude}</a></li>

		{if $oGame && $oGame->getSportId()!=4}
			<li {if $whats=="_sobytiya"}class="active"{/if}><a href="{$oTournament->getUrlFull()}/_sobytiya">{$aLang.plugin.vs.games}</a></li>
		{/if}

		{if $admin=="yes"}
			<li {if $whats=="_au"}class="active"{/if}><a href="{$oTournament->getUrlFull()}/_au">Admin</a></li>
		{/if}

		<li {if $whats=="_reglament"}class="active"{/if}><a href="{$oTournament->getUrlFull()}/_reglament">{$aLang.plugin.vs.rules}</a></li>
	</ul>
*}
</div> 
 