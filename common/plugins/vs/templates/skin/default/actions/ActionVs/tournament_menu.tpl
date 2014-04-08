{*<div class=""> 
	<ul class="nav nav-tabs">
		<li {if $whats=="index"}class="active"{/if}><a href="{$link}#tour-menu">{$aLang.plugin.vs.blog}</a></li>
		<li {if $whats=="uchastniki"}class="active"{/if}><a href="{$link_uchastniki}#tour-menu">{$aLang.plugin.vs.players}</a></li>
		<li {if $whats=="stats"}class="active"{/if}><a href="{$link_stats}#tour-menu">{$aLang.plugin.vs.standings}</a></li>

		{if $oTournament && ($oTournament->getGametypeId()==3 || $oTournament->getGametypeId()==7 ) }
			<li {if $whats=="player_stats"}class="active"{/if}><a href="{$link_player_stats}#tour-menu">{$aLang.plugin.vs.stats}</a></li>
		{/if}

		{if isset($po)}
			<li {if $whats=="po"}class="active"{/if}><a href="{$link_po}#tour-menu">{$aLang.plugin.vs.playoff}</a></li>
		{/if}

		<li {if $whats=="raspisanie"}class="active"{/if}><a href="{$link_raspisanie}#tour-menu">{$aLang.plugin.vs.schelude}</a></li>

		{if $oGame && $oGame->getSportId()!=4}
			<li {if $whats=="sobytiya"}class="active"{/if}><a href="{$link_sobytiya}#tour-menu">{$aLang.plugin.vs.games}</a></li>
		{/if}

		{if $admin=="yes"}
			<li {if $whats=="au"}class="active"{/if}><a href="{$link_au}#tour-menu">Admin</a></li>
		{/if}

		<li {if $whats=="reglament"}class="active"{/if}><a href="{$link_reglament}#tour-menu">{$aLang.plugin.vs.rules}</a></li>
	</ul>

</div> 
 *}