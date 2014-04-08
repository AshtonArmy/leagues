{if isset($oTeam) && $oTeam && $oTeam->getBlogId()}  
{include file='header.tpl' menu_content='team' team_page=true} 
{else}
{include file='header.tpl' menu_content='team'} 
{/if}


{*

 
{assign var="oOwner" value=$oTeam->getOwner()}
*}

{if isset($oTeam) && $oTeam && $oTeam->getBlogId()}

{*
{insert name="block" block=simpleTopicsTop}

{include file="$sTPLvs/slider.tpl"}
*} 
{include file='topic_list.tpl'}	

			
{/if}				
			{if $oPlayers}
				<h1 class="line"></h1>
				<h1 class="title friends">Roster</h1>
				<table class="personal">  
				{foreach from=$oPlayers item=oPlayer name=el2}
				{assign var=oUser value=$oPlayer->getUser()}
				{assign var=oPlayercard value=$oPlayer->getPlayercard()}
				<tr>
					<td>
						{$oPlayercard->getFullFio()} (<a id="inline_userlink" href="{router page='profile'}{$oUser->getLogin()}" target="_new">{$oUser->getLogin()}</a></strong>) <b>{if $oPlayer->getCap()==1}A {/if}{if $oPlayer->getCap()==2}C {/if}</b>
					</td>
				</tr>
				{/foreach}
				</table>
			{/if}
				

				


{if $gametype_id==1}
<small>
<table width="100%" cellspacing="0" class="table table-striped table-bordered table-hover" id="allteams">
			<thead>
		<tr>
	
			<th class="cside">Player</th>
			<th class="cside">Event</th>	
			<th class="cside" align="center">G</th>
			<th class="cside" align="center">W</th>
			<th class="cside" align="center">WO</th>
			<th class="cside" align="center">WS</th>
			<th class="cside" align="center">LO</th>
			<th class="cside" align="center">LS</th>
			<th class="cside" align="center">L</th>
			<th class="cside" align="center">P</th>
			<th class="cside" align="center">SO</th>
			<th class="cside" align="center">LSO</th>
			<th class="cside" align="center">GF</th>
			<th class="cside" align="center">GA</th>
			<th class="cside" align="center">±</th>
			<th class="cside" align="center">GFA</th>
			<th class="cside" align="center">GAA</th>
			<th class="cside" align="center">%P</th> 

		</tr>
			</thead>
			<tbody>

{foreach from=$Playerstat item=oPlayerstat name=el2} 
{assign var=oUser value=$oPlayerstat->getUser()}
{assign var=oTournament value=$oPlayerstat->getTournament()}
{assign var=TotalMatches value=($oPlayerstat->getHomeW()+$oPlayerstat->getHomeL()+$oPlayerstat->getHomeT()+$oPlayerstat->getHomeWot()+$oPlayerstat->getHomeLot()+$oPlayerstat->getHomeWb()+$oPlayerstat->getHomeLb()+$oPlayerstat->getAwayW()+$oPlayerstat->getAwayL()+$oPlayerstat->getAwayT()+$oPlayerstat->getAwayWot()+$oPlayerstat->getAwayLot()+$oPlayerstat->getAwayWb()+$oPlayerstat->getAwayLb())}

{assign var=sumTotalMatches value=$sumTotalMatches+$TotalMatches}
{assign var=sumWins value=$sumWins+$oPlayerstat->getHomeW()+$oPlayerstat->getAwayW()}
{assign var=sumWinsOT value=$sumWinsOT+$oPlayerstat->getHomeWot()+$oPlayerstat->getAwayWot()}
{assign var=sumWinsWB value=$sumWinsWB+$oPlayerstat->getHomeWb()+$oPlayerstat->getAwayWb()}
{assign var=sumLOT value=$sumLOT+$oPlayerstat->getHomeLot()+$oPlayerstat->getAwayLot()}
{assign var=sumLB value=$sumLB+$oPlayerstat->getHomeLb()+$oPlayerstat->getAwayLb()}
{assign var=sumL value=$sumL+$oPlayerstat->getHomeL()+$oPlayerstat->getAwayL()}
{assign var=sumSuhW value=$sumSuhW+$oPlayerstat->getSuhW()}
{assign var=sumSuhL value=$sumSuhL+$oPlayerstat->getSuhL()}
{assign var=sumGf value=$sumGf+$oPlayerstat->getGf()}
{assign var=sumGa value=$sumGa+$oPlayerstat->getGa()}

<tr>

	<td class="{$className}">{if $oUser}<a class="author" href="{$oUser->getUserWebPath()}">{$oUser->getLogin()}</a>{else}Bot{/if}</td>
	<td class="{$className}" align="left">{if $oTournament}{$oTournament->getBrief()}{if $oPlayerstat->getRoundId()==1} (ПО){/if}{else}Friendlies{/if}</td>	
	<td class="{$className}" align="center">{$TotalMatches}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getHomeW()+$oPlayerstat->getAwayW()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getHomeWot()+$oPlayerstat->getAwayWot()}</td>
    <td class="{$className}" align="center">{$oPlayerstat->getHomeWb()+$oPlayerstat->getAwayWb()}</td>	
	<td class="{$className}" align="center">{$oPlayerstat->getHomeLot()+$oPlayerstat->getAwayLot()}</td>
    <td class="{$className}" align="center">{$oPlayerstat->getHomeLb()+$oPlayerstat->getAwayLb()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getHomeL()+$oPlayerstat->getAwayL()}</td>
	<td class="{$className}" align="center"><b>{if $oPlayerstat->getRoundId()!=1}{$oPlayerstat->getPoints()}{/if}</b></td>
	<td class="{$className}" align="center">{$oPlayerstat->getSuhW()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getSuhL()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getGf()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getGa()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getGf()-$oPlayerstat->getGa()}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oPlayerstat->getGf()/$TotalMatches)|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oPlayerstat->getGa()/$TotalMatches)|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{if ($TotalMatches*$oTournament->getWin())}{($oPlayerstat->getPoints()/($TotalMatches*$oTournament->getWin()) )|string_format:"%.2f"}{else}0{/if}</td>

</tr>
{/foreach}
<tr>
	<td class="{$className}"><b>Total</b></td>
	<td class="{$className}" align="left"></td>	
	<td class="{$className}" align="center"><b>{$sumTotalMatches}</b></td>
	<td class="{$className}" align="center"><b>{$sumWins}</b></td>
	<td class="{$className}" align="center"><b>{$sumWinsOT}</b></td>
    <td class="{$className}" align="center"><b>{$sumWinsWB}</b></td>	
	<td class="{$className}" align="center"><b>{$sumLOT}</b></td>
    <td class="{$className}" align="center"><b>{$sumLB}</b></td>
	<td class="{$className}" align="center"><b>{$sumL}</b></td>
	<td class="{$className}" align="center"></td>
	<td class="{$className}" align="center"><b>{$sumSuhW}</b></td>
	<td class="{$className}" align="center"><b>{$sumSuhL}</b></td>
	<td class="{$className}" align="center"><b>{$sumGf}</b></td>
	<td class="{$className}" align="center"><b>{$sumGa}</b></td>
	<td class="{$className}" align="center"><b>{$sumGf-$sumGa}</b></td>
	<td class="{$className}" align="center"><b>{if $sumTotalMatches>0}{($sumGf/$sumTotalMatches)|string_format:"%.2f"}{/if}</b></td>
	<td class="{$className}" align="center"><b>{if $sumTotalMatches>0}{($sumGa/$sumTotalMatches)|string_format:"%.2f"}{/if}</b></td>
	<td class="{$className}" align="center"></td>
</tr>
			</tbody>
		</table>
</small>
{/if}

{include file='footer.tpl'}
 