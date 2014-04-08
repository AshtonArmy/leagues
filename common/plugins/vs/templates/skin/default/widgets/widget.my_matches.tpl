{if $aMatches}
<ul class="stream-content">
{foreach from=$aMatches item=oMatch}  
{assign var=oAwayTeam value=$oMatch->getAwayteam()}
{assign var=oHomeTeam value=$oMatch->getHometeam()}
{assign var=oAwayUser value=$oMatch->getAwayuser()}
{assign var=oHomeUser value=$oMatch->getHomeuser()}
{assign var=tournament_id value=$oMatch->getTournamentId()}

	<li> 
		<img width="32" src="{cfg name='path.root.web'}/images/teams/small/{$oAwayTeam->getLogo()}" alt="" align="absmiddle">
		{$oAwayTeam->getName()}
		{if $oMatch->getPlayed()==1}<b>{$oMatch->getGoalsAway()} : {$oMatch->getGoalsHome()}{if $oMatch->getSo()==1} SO{/if}{if $oMatch->getOt()==1} ОТ{/if}{if $oMatch->getTeh()==1} тех.{/if}</b>
		{else}
		{*<a class="ddmm" href="{$link_match}{$oMatch->getMatchId()}"><span class="icon icon47"></span></a>*}
		<a class="ddmm" href="javascript:result_insert({$oMatch->getMatchId()},{$tournament_team.$tournament_id});"><span class="icon icon185"></span></a>
		{/if}
		{$oHomeTeam->getName()}
		<img width="32" src="{cfg name='path.root.web'}/images/teams/small/{$oHomeTeam->getLogo()}" alt="" align="absmiddle">
	</li> 

{/foreach}
</ul>
{else}
нет у вас матчей
{/if}