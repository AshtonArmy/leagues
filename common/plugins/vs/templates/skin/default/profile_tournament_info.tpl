<div class="">
<div class="span12">
	<div class="widget-box transparent">
		{*<div class="widget-header-small">
			<h4 class="title">Участие в турнирах</h4>
		</div>*}
		<div class="widget-body">
			<div class="widget-main">
{if $Playerstat}
<small>

{assign var=game_id value=0}

{foreach from=$Playerstat item=oPlayerstat name=el2}
{assign var=oTeam value=$oPlayerstat->getTeam()}
{assign var=oTournament value=$oPlayerstat->getTournament()}
{assign var=oGame value=$oPlayerstat->getGame()}
{assign var=oGametype value=$oPlayerstat->getGametype()}


{if $oPlayerstat->getGameId() != $game_id && $game_id!=0}
{if $oPreviousGame->getSportId()==2}
<tr>
	<td width="11"></td>
	<td class="{$className}" width="25"></td>
	<td class="{$className}"><b>Итого</b></td>
	<td class="{$className}" align="left"></td>	
	<td class="{$className}" align="center"><b>{$sumTotalMatches}</b></td>
	<td class="{$className}" align="center"><b>{$sumWins + $sumWinsOT + $sumWinsWB}</b></td>
	<td class="{$className}" align="center"><b>{$sumT}</b></td>
    <td class="{$className}" align="center"><b>{$sumL + $sumLOT + $sumLB}</b></td>	
	<td class="{$className}" align="center"></td>	
	<td class="{$className}" align="center"></td>
</tr>
{else}
<tr>
	<td width="11"></td>
	<td class="{$className}" width="25"></td>
	<td class="{$className}"><b>Итого</b></td>
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
	<td class="{$className}" align="center"><b>{($sumGf/$sumTotalMatches)|string_format:"%.2f"}</b></td>
	<td class="{$className}" align="center"><b>{($sumGa/$sumTotalMatches)|string_format:"%.2f"}</b></td>
 	<td width="11"></td>
</tr>
{/if}
			</tbody>
		</table>
	
{/if}
{assign var=oPreviousGame value=$oPlayerstat->getGame()}

{if $oPlayerstat->getGameId() != $game_id }
{assign var=game_id value=$oPlayerstat->getGameId()}
<h4 class="title">{$oGame->getName()}</h4>
<table width="100%" cellspacing="0" class="table table-striped table-bordered table-hover" id="allteams">
			<thead>
{if $oGame->getSportId()==2}
<tr>
	<th class="lside"></th>	
	<th class="cside" align="center"></th>
	<th class="cside">Команда</th>
	<th class="cside">Турнир</th>	
	<th class="cside" align="center">И</th>
	<th class="cside" align="center">В</th>
	<th class="cside" align="center">Н</th>
	<th class="cside" align="center">П</th>
	<th class="cside" align="center">Мячи</th>
	<th class="cside" align="center">О</th>
</tr>
{else}
<tr>
	<th class="lside"></th>	
	<th class="cside" align="center"></th>
	<th class="cside">Команда</th>
	<th class="cside">Турнир</th>	
	<th class="cside" align="center">И</th>
	<th class="cside" align="center">В</th>
	<th class="cside" align="center">ВО</th>
	<th class="cside" align="center">ВБ</th>
	<th class="cside" align="center">ПО</th>
	<th class="cside" align="center">ПБ</th>
	<th class="cside" align="center">П</th>
	<th class="cside" align="center">О</th>
	<th class="cside" align="center">СВ</th>
	<th class="cside" align="center">СП</th>
	<th class="cside" align="center">ШЗ</th>
	<th class="cside" align="center">ШП</th>
	<th class="cside" align="center">±</th>
	<th class="cside" align="center">ШЗМ</th>
	<th class="cside" align="center">ШПМ</th>
	<th class="cside" align="center">%</th> 
</tr>
{/if}
			</thead>
			<tbody>
			
{assign var=TotalMatches value=0}
{assign var=sumTotalMatches value=0}
{assign var=sumWins value=0}
{assign var=sumWinsOT value=0}
{assign var=sumWinsWB value=0}
{assign var=sumLOT value=0}
{assign var=sumLB value=0}
{assign var=sumL value=0}
{assign var=sumT value=0}
{assign var=sumSuhW value=0}
{assign var=sumSuhL value=0}
{assign var=sumGf value=0}
{assign var=sumGa value=0}
{/if}

{assign var=TotalMatches value=($oPlayerstat->getHomeW()+$oPlayerstat->getHomeL()+$oPlayerstat->getHomeT()+$oPlayerstat->getHomeWot()+$oPlayerstat->getHomeLot()+$oPlayerstat->getHomeWb()+$oPlayerstat->getHomeLb()+$oPlayerstat->getAwayW()+$oPlayerstat->getAwayL()+$oPlayerstat->getAwayT()+$oPlayerstat->getAwayWot()+$oPlayerstat->getAwayLot()+$oPlayerstat->getAwayWb()+$oPlayerstat->getAwayLb())}
{assign var=sumTotalMatches value=$sumTotalMatches+$TotalMatches}
{assign var=sumWins value=$sumWins+$oPlayerstat->getHomeW()+$oPlayerstat->getAwayW()}
{assign var=sumWinsOT value=$sumWinsOT+$oPlayerstat->getHomeWot()+$oPlayerstat->getAwayWot()}
{assign var=sumWinsWB value=$sumWinsWB+$oPlayerstat->getHomeWb()+$oPlayerstat->getAwayWb()}
{assign var=sumLOT value=$sumLOT+$oPlayerstat->getHomeLot()+$oPlayerstat->getAwayLot()}
{assign var=sumLB value=$sumLB+$oPlayerstat->getHomeLb()+$oPlayerstat->getAwayLb()}
{assign var=sumL value=$sumL+$oPlayerstat->getHomeL()+$oPlayerstat->getAwayL()}
{assign var=sumT value=$sumL+$oPlayerstat->getHomeT()+$oPlayerstat->getAwayT()}
{assign var=sumSuhW value=$sumSuhW+$oPlayerstat->getSuhW()}
{assign var=sumSuhL value=$sumSuhL+$oPlayerstat->getSuhL()}
{assign var=sumGf value=$sumGf+$oPlayerstat->getGf()}
{assign var=sumGa value=$sumGa+$oPlayerstat->getGa()}
{if $oGame->getSportId()==2}
<tr> 
	<td class="{$className}" align="center">{$oPlayerstat->getPosition()}</td>	
	<td class="{$className}" width="25"><img width="20" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/></td>
	<td class="{$className}"><a href="#" >{$oTeam->getName()}</a></td>
	<td class="{$className}" align="left"><a href="{$oTournament->getUrlFull()}">{$oTournament->getBrief()}{if $oPlayerstat->getRoundId()==100} Кубок{/if}</a></td>	
	<td class="{$className}" align="center">{$TotalMatches}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getHomeW()+$oPlayerstat->getAwayW()+$oPlayerstat->getHomeWot()+$oPlayerstat->getAwayWot()+$oPlayerstat->getHomeWb()+$oPlayerstat->getAwayWb()}</td>
    <td class="{$className}" align="center">{$oPlayerstat->getHomeT()+$oPlayerstat->getAwayT()}</td>	
	<td class="{$className}" align="center">{$oPlayerstat->getHomeL()+$oPlayerstat->getAwayL()+$oPlayerstat->getHomeLot()+$oPlayerstat->getAwayLot()+$oPlayerstat->getHomeLb()+$oPlayerstat->getAwayLb()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getGf()}-{$oPlayerstat->getGa()}</td>
	<td class="{$className}" align="center"><b>{$oPlayerstat->getPoints()}</b></td>
</tr>
{else}
<tr>
	<td width="11">{$oPlayerstat->getPosition()}</td>
	<td class="{$className}" width="25"><img width="20" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/></td>
	<td class="{$className}"><a href="#" >{$oTeam->getName()}</a></td>
	<td class="{$className}" align="left"><a href="{$oTournament->getUrlFull()}">{$oTournament->getBrief()}{if $oPlayerstat->getRoundId()==100} ПО{/if}</a></td>	
	<td class="{$className}" align="center">{$TotalMatches}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getHomeW()+$oPlayerstat->getAwayW()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getHomeWot()+$oPlayerstat->getAwayWot()}</td>
    <td class="{$className}" align="center">{$oPlayerstat->getHomeWb()+$oPlayerstat->getAwayWb()}</td>	
	<td class="{$className}" align="center">{$oPlayerstat->getHomeLot()+$oPlayerstat->getAwayLot()}</td>
    <td class="{$className}" align="center">{$oPlayerstat->getHomeLb()+$oPlayerstat->getAwayLb()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getHomeL()+$oPlayerstat->getAwayL()}</td>
	<td class="{$className}" align="center">{if $oPlayerstat->getRoundId()!=1}{$oPlayerstat->getPoints()}{/if}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getSuhW()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getSuhL()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getGf()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getGa()}</td>
	<td class="{$className}" align="center">{$oPlayerstat->getGf()-$oPlayerstat->getGa()}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oPlayerstat->getGf()/$TotalMatches)|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oPlayerstat->getGa()/$TotalMatches)|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{if $TotalMatches*$oTournament->getWin()}{($oPlayerstat->getPoints()/($TotalMatches*$oTournament->getWin()) )|string_format:"%.2f"}{else}0{/if}</td>
 
</tr>
{/if}
{/foreach}
{if $oGame->getSportId()==2}
<tr>
	<td width="11"></td>
	<td class="{$className}" width="25"></td>
	<td class="{$className}"><b>Итого</b></td>
	<td class="{$className}" align="left"></td>	
	<td class="{$className}" align="center"><b>{$sumTotalMatches}</b></td>
	<td class="{$className}" align="center"><b>{$sumWins + $sumWinsOT + $sumWinsWB}</b></td>
	<td class="{$className}" align="center"><b>{$sumT}</b></td>
    <td class="{$className}" align="center"><b>{$sumL + $sumLOT + $sumLB}</b></td>	
	<td class="{$className}" align="center"></td>	
	<td class="{$className}" align="center"></td>
</tr>
{else}
<tr>
	<td width="11"></td>
	<td class="{$className}" width="25"></td>
	<td class="{$className}"><b>Итого</b></td>
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
	<td class="{$className}" align="center"><b>{($sumGf/$sumTotalMatches)|string_format:"%.2f"}</b></td>
	<td class="{$className}" align="center"><b>{($sumGa/$sumTotalMatches)|string_format:"%.2f"}</b></td>
 	<td width="11"></td>
</tr>
{/if}
			</tbody>
		</table>
</small>
{/if}			
 
			</div>
		</div>
	</div>
</div>
</div>