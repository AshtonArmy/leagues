{include file='header.tpl' menu='blog'}
{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats="player_stats"}
<ul class="block-nav">						
	<li {if $who=='all'}class="active"{/if}><a href="{$link_player_stats}/#tour-menu">{$aLang.plugin.vs.all}</a></li>
	<li {if $who=='attack'}class="active"{/if}><a href="{$link_player_stats}attack/#tour-menu">{$aLang.plugin.vs.forwards}</a></li>
	<li {if $who=='defence'}class="active"{/if}><a href="{$link_player_stats}defence/#tour-menu">{$aLang.plugin.vs.dmen}</a></li>
	<li {if $who=='goalkeeper'}class="active"{/if}><a href="{$link_player_stats}goalkeeper/#tour-menu">{$aLang.plugin.vs.goalies}</a></li>
	<li {if $who=='situation'}class="active"{/if}><a href="{$link_player_stats}situation/#tour-menu">{$aLang.plugin.vs.goalsit}</a></li>
</ul>
<table width="100%" cellspacing="0" class="raspisanie" id="allteams">
{if $who=='all' or $who=='attack' or $who=='defence'}
<thead> 
<tr> 
<th>&nbsp;</th>
    <th>Player</th> 
	<th>&nbsp;</th>
    <th>Team</th> 
    <th align="center" width="35">GP</th> 
    <th align="center" width="35">G</th> 
    <th align="center" width="35">A</th>
	<th align="center" width="35">P</th>
	<th  width="35">+/-</th>		
	<th>PiM</th>
	<th width="30">Gpp</th>
	<th width="30">Gsh</th>
	<th width="30">GW</th>
	<th>Hits</th>
	<th align="center" width="30">S</th>	
	<th width="30">%S</th>
	<th width="35">Star</th>	
</tr> 
</thead> 
{assign var=num value=1}
{foreach from=$aStats item=oStat name=el2}
<tr {if $oUserCurrent && $oUserCurrent->getUserId()==$oStat.user_id}class="my"{/if}> 
	<td width="20" align="center">{$num}</td>
	<td width="250" align="left"><span class="goalauthor"><a href="http://virtualsports.ru/profile/{$oStat.user_login}/" class="stream-author">{$oStat.user_login}</a> <span class="fio">{$oStat.fio}</span></td> 
	<td width="37">{if $oStat.team_id>0} <a href="{router page='team'}{$oStat.team_id}"> <img height="20" src="{cfg name='path.root.web'}/images/teams/{if $oStat.user_id==0}small{else}teamplay{/if}/{$oStat.team_logo}"/></a>{/if}</td>
	<td align="center"><a href="{router page='team'}{$oStat.team_id}" class="teamrasp">{$oStat.team_brief}</a></td>
	<td align="center">{$oStat.games}</td>
	<td align="center">{$oStat.goals}</td> 
	<td align="center">{$oStat.assist}</td> 

	<td align="center" class="points"><b>{$oStat.points}</b></td>
	<td align="center">{$oStat.plus_minus}</td>

	<td align="center">{$oStat.penalty}</td>
	<td align="center">{$oStat.pp}</td>
	<td align="center">{$oStat.pk}</td>
	<td align="center">{$oStat.win_goal}</td>
	<td align="center">{$oStat.hits}</td>
	<td align="center">{$oStat.shots}</td>
	<td align="center">{$oStat.prcnt}</td>
	<td align="center">{$oStat.mv}</td>						
</tr>
{assign var=num value=$num+1}
{/foreach}
{/if}
{if $who=='goalkeeper' }
<thead> 
<tr> 
    <th>&nbsp;</th>
    <th>Player</th> 
	<th>&nbsp;</th> 
    <th>Team</th> 
    <th>GP</th> 
    <th>W</th> 
    <th >L</th> 
    <th >GAA</th>
    <th >SA</th>
 	<th >GA</th>
	<th >S</th>		
	<th >%S</th>
	<th >SO</th>
	<th >G</th>	
	<th >A</th>
	<th  >PiM</th>
	<th  >Star</th>
</tr> 
</thead> 
{assign var=num value=1}
{foreach from=$aStats item=oStat name=el2}
<tr {if $oUserCurrent && $oUserCurrent->getUserId()==$oStat.user_id}class="my"{/if}> 
	<td width="20" align="center">{$num}</td>
	<td width="250" align="left"><span class="goalauthor"><a href="http://virtualsports.ru/profile/{$oStat.user_login}/" class="stream-author">{$oStat.user_login}</a> <span class="fio">{$oStat.fio}</span></td> 
	<td width="37"> <a href="{router page='team'}{$oStat.team_id}"> <img height="20" src="{cfg name='path.root.web'}/images/teams/{if $oStat.user_id==0}small{else}teamplay{/if}/{$oStat.team_logo}"/></a></td>
	<td align="center"><a href="{router page='team'}{$oStat.team_id}" class="teamrasp">{$oStat.team_brief}</a></td>
	<td align="center">{$oStat.games}</td>
	<td align="center">{$oStat.wins}</td> 
	<td align="center">{$oStat.loses}</td> 

	<td align="center" class="points"><b>{$oStat.sr_ga}</b></td>
	<td align="center">{$oStat.total_shots}</td>

	<td align="center">{$oStat.ga}</td>
	<td align="center">{$oStat.shots}</td>
	<td align="center">{$oStat.shots_prcn}</td>
	<td align="center">{$oStat.ibp}</td>
	<td align="center">{$oStat.goals}</td>
	<td align="center">{$oStat.assists}</td>
	<td align="center">{$oStat.penalty}</td>
	<td align="center">{$oStat.mv}</td>						
</tr>
{assign var=num value=$num+1}
{/foreach}
{/if}

{if $who=='situation'}
<thead> 
<tr> 
<th>&nbsp;</th>
    <th>Player</th> 
	<th>&nbsp;</th>
    <th>Team</th> 
    <th align="center" >T3+</th> 
    <th align="center" >T2</th> 
    <th align="center" >T1</th>
	<th align="center" >D</th>
	<th align="center" >L1</th>
	<th align="center" >L2</th>
	<th align="center" >L3+</th>
	<th align="center" >GW</th>
	<th align="center" >ENG</th>
	<th align="center" >PSG</th>
</tr> 
</thead> 
{assign var=num value=1}
{foreach from=$aStats item=oStat name=el2}
<tr {if $oUserCurrent && $oUserCurrent->getUserId()==$oStat.user_id}class="my"{/if}> 
	<td width="20" align="center">{$num}</td>
	<td width="250" align="left"><span class="goalauthor"><a href="http://virtualsports.ru/profile/{$oStat.user_login}/" class="stream-author">{$oStat.user_login}</a> <span class="fio">{$oStat.fio}</span></td> 
	<td width="37"> <a href="{router page='team'}{$oStat.team_id}"> <img height="20" src="{cfg name='path.root.web'}/images/teams/{if $oStat.user_id==0}small{else}teamplay{/if}/{$oStat.team_logo}"/></a></td>
	<td align="center"><a href="{router page='team'}{$oStat.team_id}" class="teamrasp">{$oStat.team_brief}</a></td>
	<td align="center">{$oStat.t3}</td>
	<td align="center">{$oStat.t2}</td> 
	<td align="center">{$oStat.t1}</td> 

	<td align="center">{$oStat.t}</td>
	<td align="center">{$oStat.l1}</td>

	<td align="center">{$oStat.l2}</td>
	<td align="center">{$oStat.l3}</td>
	<td align="center">{$oStat.gw}</td>
	<td align="center">{$oStat.eng}</td>
	<td align="center">{$oStat.psg}</td>
</tr>
{assign var=num value=$num+1}
{/foreach}
{/if}

</table>
{if $who=='situation'}
<ul> 
	<li>Т3+ — Trail by 3+ / при отставании в 3 шайбы и больше</li>
	<li>Т2 — Trail by 2 / при отставании в 2 шайбы</li>
	<li>Т1 — Trail by 1 / при отставании в 1 шайбу</li>
	<li>D — Draw (tied) / при равном счете</li>
	<li>L1 — Trail by 1 / при преимуществе в 1 шайбу</li>
	<li>L2 — Trail by 2 / при преимуществе в 2 шайбы</li>
	<li>L3+ — Trail by 3+ / при преимуществе в 3 шайбы и больше</li>
	<li>GW — Game winning goals / победные голы</li>
	<li>ENG — Empty net goals / голы в пустые ворота</li>
	<li>PSG — Penalty shot goals / голы со штрафного броска</li>
</ul>
{/if}
{literal}
<script type="text/javascript"> 
  	$(document).ready(function() 
		{ 
			$("#allteams").tablesorter(); 
		} 
	); 
</script> 
<style>

a.stream-author { color: #686868;
    font-weight: bold;
    padding-left: 13px;
    text-decoration: none;}
.fio {color: #AAAAAA;}
.period {font-family: 'PT Sans Narrow',sans-serif;
    font-size: 22px;
    font-weight: normal;}
.goals{color: #75A13F;font-weight: bold;}
.onegoal{margin-top: 7px; margin-bottom: 3px;}
.goaltime{font-size: 10px;padding-left: 13px;}
.my{background:#fff;}
</style>
{/literal}
{include file='footer.tpl'}