<div class="block">

    <header class="block-header sep">
        <h3><a class="links_head" href="{$oTournament->getUrlFull()}stats/">Top {$number}</a></h3>
    </header>
 

{if $oGame && $oGame->getSportId()==4}
{if $PlayerTable} 
	<table width="100%" cellspacing="0" class="table table-striped table-bordered table-hover">
	<thead>
	<tr>
		<th class="cside" align="center">№</th>	 
		<th class="cside" align="center">Гонщик</th> 
		<th class="cside" align="center"></th>
		<th class="cside" align="center">O</th>
	</tr>
	</thead>
	{assign var=num value=1}
	{foreach from=$PlayerTable item=oTournamentstat name=el2}
	{if $smarty.foreach.el2.iteration % 2  == 0}
		{assign var=className value='odd'}
	{else}
		{assign var=className value='even'}
	{/if}
	{assign var=oTeam value=$oTournamentstat->getTeam()}
	{assign var=oUser value=$oTournamentstat->getUser()}
	{assign var=TotalMatches value=($oTournamentstat->getHomeW()+$oTournamentstat->getHomeL()+$oTournamentstat->getHomeT()+$oTournamentstat->getHomeWot()+$oTournamentstat->getHomeLot()+$oTournamentstat->getHomeWb()+$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayW()+$oTournamentstat->getAwayL()+$oTournamentstat->getAwayT()+$oTournamentstat->getAwayWot()+$oTournamentstat->getAwayLot()+$oTournamentstat->getAwayWb()+$oTournamentstat->getAwayLb())}
	<tr class="{$className}">
		<td width="25" align="center">{$num}</td>	
		<td><a class="author" href="{router page='profile'}{$oUser->getLogin()|escape:"html"}/"><b>{$oUser->getLogin()|escape:"html"}</b></a></td>
		<td width="25"><img width="70" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/></td>
		<td align="center" width="20">{$oTournamentstat->getPoints()}</td>
	</tr>
	{assign var=num value=$num+1}
	{/foreach}


	</table> 
	
{/if}
{else}
{if $TournamentTable}
	 
	<table width="100%" cellspacing="0" class="table table-striped table-bordered table-hover">
	<thead>
	<tr>
		<th class="cside" align="center">№</th>	
		<th class="cside" align="center"></th>
		<th class="cside" align="left">Team</th>
		<th class="cside" align="center">M</th>
		<th class="cside" align="center">P</th>
	</tr>
	</thead>
	{foreach from=$TournamentTable item=oTournamentstat name=el2}
	{if $smarty.foreach.el2.iteration % 2  == 0}
		{assign var=className value='odd'}
	{else}
		{assign var=className value='even'}
	{/if}
	{assign var=oTeam value=$oTournamentstat->getTeam()}
	{assign var=TotalMatches value=($oTournamentstat->getHomeW()+$oTournamentstat->getHomeL()+$oTournamentstat->getHomeT()+$oTournamentstat->getHomeWot()+$oTournamentstat->getHomeLot()+$oTournamentstat->getHomeWb()+$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayW()+$oTournamentstat->getAwayL()+$oTournamentstat->getAwayT()+$oTournamentstat->getAwayWot()+$oTournamentstat->getAwayLot()+$oTournamentstat->getAwayWb()+$oTournamentstat->getAwayLb())}
	<tr class="{$className}">
		<td width="25" align="center">{$oTournamentstat->getPosition()}</td>	
		<td width="25"><img style="height:20px;" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/></td>
		<td><a href="{if $oTeam->getBlog()}{$oTeam->getBlog()->getTeamUrlFull()}{else}{router page='team'}{$oTeam->getTeamId()}{/if}" class="teamrasp">{$oTeam->getName()}</a></td>
		<td align="center" width="20">{$TotalMatches}</td>
		<td align="center" width="20">{$oTournamentstat->getPoints()}</td>
	</tr>
	{/foreach}


	</table>
			
 
	
{/if}

{/if}
 
</div>