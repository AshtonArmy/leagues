{if count($aStreamEvents)}
		{foreach from=$aStreamEvents item=oStreamEvent}	
		<li class="stream-item-type-{$oStreamEvent->getEventType()}">
			{assign var=oTarget value=$oStreamEvent->getWhat()}
{if $oStreamEvent->getEventType()=="match_played"}
	{assign var=oTournament value=$oTarget->getTournament()}
	{assign var=oAwayTeam value=$oTarget->getAwayteam()}
	{assign var=oHomeTeam value=$oTarget->getHometeam()}
	{assign var=oAwayUser value=$oTarget->getAwayuser()}
	{assign var=oHomeUser value=$oTarget->getHomeuser()}	
	{assign var=oBlogs value=$oTarget->getBlog()}
			<span class="date" title="{date_format date=$oStreamEvent->getDateAdd()}">{date_format date=$oStreamEvent->getDateAdd() hours_back="12" minutes_back="60" now="60" day="day H:i" format="j F Y, H:i"} ({$aLang.plugin.vs.match} №{$oTarget->getNumber()}) {if $oBlogs}<a href="{$oTournament->getUrlFull()}match_comment/{$oTarget->getMatchId()}" target="_blank" >{$aLang.plugin.vs.game_report} ({$oTarget->getCountComment()})</a> {/if}</span> 

			<table id="myTable" width="100%">
<tbody>
<tr class="odd" height="10">
<td class="mid" width="40" align="left">{if $oAwayTeam}<img width="32" src="{cfg name='path.root.web'}/images/teams/small/{$oAwayTeam->getLogo()}" alt="" align="absmiddle">{/if}</td> 
  <td class="mid" align="left" width="40%"><b><font size="3">{if $oAwayTeam}{$oAwayTeam->getName()}{else}Любая{/if}</font></b> ({if $oTarget->getAwayRating()>0}+{/if}{$oTarget->getAwayRating()})</td>
  <td class="mid" align="center" colspan="2" width="60"><b><font color="#184e8d" size="4">{$oTarget->getGoalsAway()} : {$oTarget->getGoalsHome()}{if $oTarget->getSo()==1} SO{/if}{if $oTarget->getOt()==1} ОТ{/if}{if $oTarget->getTeh()==1} тех.{/if}</font> <font color="#184e8d"></font></b></td>
  <td class="mid" align="right" width="40%">({if $oTarget->getHomeRating()>0}+{/if}{$oTarget->getHomeRating()}) <b><font size="3">{if $oHomeTeam}{$oHomeTeam->getName()}{else}Любая{/if}</font></b></td>
  <td class="mid" width="40" align="right">{if $oHomeTeam}<img width="32" src="{cfg name='path.root.web'}/images/teams/small/{$oHomeTeam->getLogo()}" alt="" align="absmiddle">{/if}</td> 
</tr>
<tr>
  <td colspan="3" width="50%" style="vertical-align: top;">{if $oAwayUser}<b>{$oAwayUser->getLogin()}</b>:{/if} {$oTarget->getAwayComment()}</td>
  <td colspan="3" width="50%" style="vertical-align: top;">{if $oHomeUser}<b>{$oHomeUser->getLogin()}</b>:{/if} {$oTarget->getHomeComment()}</td>
</tr>
</tbody></table>
{/if}
{if $oStreamEvent->getEventType()=="teh_penalty"}
{assign var=oUser value=$oTarget->getPlayer()}
{assign var=oMatch value=$oTarget->getMatch()}
<span class="date" title="{date_format date=$oStreamEvent->getDateAdd()}">{date_format date=$oStreamEvent->getDateAdd() hours_back="12" minutes_back="60" now="60" day="day H:i" format="j F Y, H:i"}</span> 
	<a href="{$oUser->getUserWebPath()}"><img src="{$oUser->getProfileAvatarPath(48)}" alt="avatar" class="avatar" /></a>
	<a href="{$oUser->getUserWebPath()}"><strong>{$oUser->getLogin()}</strong></a> получает штраф за техничку в матче №{$oMatch->getNumber()}
{/if}
		</li>	
		{/foreach}

{/if}