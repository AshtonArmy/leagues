{include file='header.tpl' menu='blog'}
{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats="stats"}
{assign var=className value='vlight'}

{if $Tournamentstat}
<div style="float:left;">
<table   cellspacing="0" class="raspisanie" id="allteams">
<thead>
<tr>
	<th class="lside"></th>
	<th class="cside" align="center">№</th>	
	<th class="cside" align="center"></th>
	<th class="cside" align="left">Команда</th>
	<th class="cside" align="center">О</th>

	<th class="rside"></th>
</tr>
</thead>
{foreach from=$Tournamentstat item=oTournamentstat name=el2}
{assign var=oTeam value=$oTournamentstat->getTeam()}
{assign var=TotalMatches value=($oTournamentstat->getHomeW()+$oTournamentstat->getHomeL()+$oTournamentstat->getHomeT()+$oTournamentstat->getHomeWot()+$oTournamentstat->getHomeLot()+$oTournamentstat->getHomeWb()+$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayW()+$oTournamentstat->getAwayL()+$oTournamentstat->getAwayT()+$oTournamentstat->getAwayWot()+$oTournamentstat->getAwayLot()+$oTournamentstat->getAwayWb()+$oTournamentstat->getAwayLb())}
<tr>
	<td width="11"></td>
	<td class="{$className}" width="25" align="center">{$oTournamentstat->getPosition()}</td>	
	<td class="{$className}" width="140"><img  src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/></td>
	<td class="{$className}" width="130"><a href="#" class="teamrasp">{$oTeam->getName()}</a></td>
	<td class="{$className}" align="center">{$oTournamentstat->getPoints()}</td>
	
	<td width="11"></td>
</tr>
{/foreach}


</table>
</div>
{if $PlayerTable}
<div style="float:right;">
<table   cellspacing="0" class="raspisanie" id="allteams2">
<thead>
<tr>
	<th class="lside"></th>
	<th class="cside" align="center">№</th>	
	<th class="cside" align="center"></th>
	<th class="cside" align="left">Гонщик</th>
	<th class="cside" align="center">О</th>

	<th class="rside"></th>
</tr>
</thead>
{assign var=num value=1}
{foreach from=$PlayerTable item=oTournamentstat name=el2}
{assign var=oTeam value=$oTournamentstat->getTeam()}
{assign var=oUser value=$oTournamentstat->getUser()}
{assign var=TotalMatches value=($oTournamentstat->getHomeW()+$oTournamentstat->getHomeL()+$oTournamentstat->getHomeT()+$oTournamentstat->getHomeWot()+$oTournamentstat->getHomeLot()+$oTournamentstat->getHomeWb()+$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayW()+$oTournamentstat->getAwayL()+$oTournamentstat->getAwayT()+$oTournamentstat->getAwayWot()+$oTournamentstat->getAwayLot()+$oTournamentstat->getAwayWb()+$oTournamentstat->getAwayLb())}
<tr>
	<td width="11"></td>
	<td class="{$className}" width="25" align="center">{$num}</td>	
	<td class="{$className}" width="140"><img  src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/></td>
	<td class="{$className}" width="130"><a class="author" href="http://virtualsports.ru/profile/{$oUser->getLogin()|escape:"html"}/"><b>{$oUser->getLogin()|escape:"html"}</b></a></td>
	<td class="{$className}" align="center">{$oTournamentstat->getPoints()}</td>
	
	<td width="11"></td>
</tr>
{assign var=num value=$num+1}
{/foreach}


</table>
</div>
{/if}
{literal}
<script type="text/javascript"> 

  	$(document).ready(function() 
		{ 
			$("#allteams").tablesorter(); 
		} 
	); 
</script> 
{/literal}
{/if}


<script language="JavaScript" type="text/javascript">


</script>
{include file='footer.tpl'}