{include file='header.tpl' menu_content='tournament'}
<small>

{if $Tournamentstat and ( $oTournament->getShowFullStatTable()!=0 || $oTournament->getShowFullStatTable()==null)}
<table width="100%" cellspacing="0" class="table table-striped table-bordered table-hover" id="allteams">
<thead>
<tr>
	<th class="cside" align="center">№</th>	
	<th class="cside" align="center"></th>
	<th class="cside">Команда</th>
	<th class="cside" align="center">И</th>
	<th class="cside" align="center">В</th>
{*	
    <th class="cside" align="center">ВО</th>
	<th class="cside" align="center">ВБ</th>
	<th class="cside" align="center">ПО</th>
	<th class="cside" align="center">ПБ</th>
*}	
	<th class="cside" align="center">Н</th>
	<th class="cside" align="center">П</th>
	<th class="cside" align="center">Мячи</th>
	<th class="cside" align="center">О</th>
	{*<th class="cside" align="center">СВ</th>
	<th class="cside" align="center">СП</th>
	<th class="cside" align="center">ГЗ</th>
	<th class="cside" align="center">ГП</th>
	<th class="cside" align="center">±</th>
	<th class="cside" align="center">ГЗМ</th>
	<th class="cside" align="center">ГПМ</th>
	<th class="cside" align="center">%</th>
	<th class="cside" align="center">П10</th>*}
</tr>
</thead>
{foreach from=$Tournamentstat item=oTournamentstat name=el2}
{assign var=oTeam value=$oTournamentstat->getTeam()}
{assign var=TotalMatches value=($oTournamentstat->getHomeW()+$oTournamentstat->getHomeL()+$oTournamentstat->getHomeT()+$oTournamentstat->getHomeWot()+$oTournamentstat->getHomeLot()+$oTournamentstat->getHomeWb()+$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayW()+$oTournamentstat->getAwayL()+$oTournamentstat->getAwayT()+$oTournamentstat->getAwayWot()+$oTournamentstat->getAwayLot()+$oTournamentstat->getAwayWb()+$oTournamentstat->getAwayLb())}
<tr> 
	<td class="{$className}" align="center">{$oTournamentstat->getPosition()}</td>	
	<td class="{$className}"><img width="20" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/></td>
	<td class="{$className}"><a href="#" class="teamrasp">{$oTeam->getName()}</a></td>
	<td class="{$className}" align="center">{$TotalMatches}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getHomeW()+$oTournamentstat->getAwayW()+$oTournamentstat->getHomeWot()+$oTournamentstat->getAwayWot()+$oTournamentstat->getHomeWb()+$oTournamentstat->getAwayWb()}</td>
{*	
	<td class="{$className}" align="center">{$oTournamentstat->getHomeWot()+$oTournamentstat->getAwayWot()}</td>
    <td class="{$className}" align="center">{$oTournamentstat->getHomeWb()+$oTournamentstat->getAwayWb()}</td>	
	<td class="{$className}" align="center">{$oTournamentstat->getHomeLot()+$oTournamentstat->getAwayLot()}</td>
    <td class="{$className}" align="center">{$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayLb()}</td>
*}	
    <td class="{$className}" align="center">{$oTournamentstat->getHomeT()+$oTournamentstat->getAwayT()}</td>	
	<td class="{$className}" align="center">{$oTournamentstat->getHomeL()+$oTournamentstat->getAwayL()+$oTournamentstat->getHomeLot()+$oTournamentstat->getAwayLot()+$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayLb()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getGf()}-{$oTournamentstat->getGa()}</td>
	<td class="{$className}" align="center"><b>{$oTournamentstat->getPoints()}</b></td>
	{*<td class="{$className}" align="center">{$oTournamentstat->getSuhW()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getSuhL()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getGf()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getGa()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getGf()-$oTournamentstat->getGa()}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oTournamentstat->getGf()/$TotalMatches)|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oTournamentstat->getGa()/$TotalMatches)|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oTournamentstat->getPoints()/($TotalMatches*$oTournament->getWin()) )|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getLastTen()}</td>*}
</tr>
{/foreach}


</table>
{literal}
<script type="text/javascript"> 
  /*window.addEvent('domready',function(){ 
	var allteams = new HtmlTable($('allteams'));
	allteams.enableSort();
  }); // addEvent 
  */
  	$(document).ready(function() 
		{ 
			$("#allteams").tablesorter(); 
		} 
	); 
</script> 
{/literal}
{/if}

{*по группам*}
{if $aTournamentstatparentgroup and ($oTournament->getShowParentStatTable()!=0 || $oTournament->getShowFullStatTable()==null )}
{assign var=Parentgroup value=0}
{assign var=Group value=0}
{assign var=PrevGroup value=0}
{assign var=Position value=1}
{foreach from=$aTournamentstatparentgroup item=oTournamentstat name=el2}

{assign var=oParentgroup value=$oTournamentstat->getParentgroup()}
{if $oParentgroup->getGroupId()!=0}
	{if $oParentgroup->getGroupId() != $Parentgroup and $Parentgroup !=0}
	</table>
	{literal}
	<script type="text/javascript"> 
	$(document).ready(function() 
		{ 
			$("#allteams{/literal}{$Parentgroup}{literal}").tablesorter(); 
		} 
	); 
	  /*window.addEvent('domready',function(){ 
		var allteams = new HtmlTable($('allteams{/literal}{$Parentgroup}{literal}'));
		allteams.enableSort();
	  }); // addEvent 
*/	  
	</script> 
	{/literal}
	{/if}
	
{if $oParentgroup->getGroupId() != $Parentgroup}
	{assign var=Position value=1}
	<br/>
	<p align="center"><b>{$oParentgroup->getName()}</b></p>	
	<table width="100%" cellspacing="0" class="table table-striped table-bordered table-hover" id="allteams{$oParentgroup->getGroupId()}">
	<thead>
	<tr> 
		<th class="cside" align="center">№</th>	
		<th class="cside" align="center"></th>
		<th class="cside">Команда</th>
		<th class="cside" align="center">И</th>
		<th class="cside" align="center">В</th>
	{*	
		<th class="cside" align="center">ВО</th>
		<th class="cside" align="center">ВБ</th>
		<th class="cside" align="center">ПО</th>
		<th class="cside" align="center">ПБ</th>
	*}	
		<th class="cside" align="center">Н</th>
		<th class="cside" align="center">П</th>
		<th class="cside" align="center">Мячи</th>
		<th class="cside" align="center">О</th>
		{*<th class="cside" align="center">СВ</th>
		<th class="cside" align="center">СП</th>
		<th class="cside" align="center">ГЗ</th>
		<th class="cside" align="center">ГП</th>
		<th class="cside" align="center">±</th>
		<th class="cside" align="center">ГЗМ</th>
		<th class="cside" align="center">ГПМ</th>
		<th class="cside" align="center">%</th>
		<th class="cside" align="center">П10</th>*} 
	</tr>
	</thead>
	{assign var=PrevGroup value=$Parentgroup}
	{assign var=Parentgroup value=$oParentgroup->getGroupId()}
{/if}	
{assign var=oTeam value=$oTournamentstat->getTeam()}
{assign var=TotalMatches value=($oTournamentstat->getHomeW()+$oTournamentstat->getHomeL()+$oTournamentstat->getHomeT()+$oTournamentstat->getHomeWot()+$oTournamentstat->getHomeLot()+$oTournamentstat->getHomeWb()+$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayW()+$oTournamentstat->getAwayL()+$oTournamentstat->getAwayT()+$oTournamentstat->getAwayWot()+$oTournamentstat->getAwayLot()+$oTournamentstat->getAwayWb()+$oTournamentstat->getAwayLb())}
 
<tr>
	<td class="{$className}" width="25" align="center">{$Position}{if $oTournamentstat->getGrouplead()==1}*{/if}</td>	
	<td class="{$className}" width="25"><img width="20" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/></td>
	<td class="{$className}"><a href="#" class="teamrasp">{$oTeam->getName()}</a></td>
	<td class="{$className}" align="center">{$TotalMatches}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getHomeW()+$oTournamentstat->getAwayW()+$oTournamentstat->getHomeWot()+$oTournamentstat->getAwayWot()+$oTournamentstat->getHomeWb()+$oTournamentstat->getAwayWb()}</td>
{*	
	<td class="{$className}" align="center">{$oTournamentstat->getHomeWot()+$oTournamentstat->getAwayWot()}</td>
    <td class="{$className}" align="center">{$oTournamentstat->getHomeWb()+$oTournamentstat->getAwayWb()}</td>	
	<td class="{$className}" align="center">{$oTournamentstat->getHomeLot()+$oTournamentstat->getAwayLot()}</td>
    <td class="{$className}" align="center">{$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayLb()}</td>
*}	
    <td class="{$className}" align="center">{$oTournamentstat->getHomeT()+$oTournamentstat->getAwayT()}</td>	
	<td class="{$className}" align="center">{$oTournamentstat->getHomeL()+$oTournamentstat->getAwayL()+$oTournamentstat->getHomeLot()+$oTournamentstat->getAwayLot()+$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayLb()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getGf()}-{$oTournamentstat->getGa()}</td>
	<td class="{$className}" align="center"><b>{$oTournamentstat->getPoints()}</b></td>
	{*<td class="{$className}" align="center">{$oTournamentstat->getSuhW()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getSuhL()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getGf()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getGa()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getGf()-$oTournamentstat->getGa()}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oTournamentstat->getGf()/$TotalMatches)|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oTournamentstat->getGa()/$TotalMatches)|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oTournamentstat->getPoints()/($TotalMatches*$oTournament->getWin()) )|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getLastTen()}</td>*}

</tr>
{assign var=Position value=$Position+1}
{/if}
{/foreach}
{if $Parentgroup !=0 }
</table>
{/if}

</table>
{literal}
<script type="text/javascript"> 
  	$(document).ready(function() 
		{ 
			$("#allteams{/literal}{$Parentgroup}{literal}").tablesorter(); 
		} 
	); 
 /* window.addEvent('domready',function(){ 
	var allteams = new HtmlTable($('allteams{/literal}{$Parentgroup}{literal}'));
	allteams.enableSort();
  }); // addEvent 
 */  
</script> 
{/literal}
{/if}
{*по группам*}

{*по подгруппам*}
{assign var=Parentgroup value=0}
{assign var=Group value=0}
{assign var=PrevGroup value=0}
{assign var=Position value=1}

{if $aTournamentstatgroup and ($oTournament->getShowGroupStatTable()!=0 || $oTournament->getShowGroupStatTable()==null)}
{foreach from=$aTournamentstatgroup item=oTournamentstat name=el2}
{assign var=oParentgroup value=$oTournamentstat->getParentgroup()}
{assign var=oGroup value=$oTournamentstat->getGroup()}
{if $oGroup->getGroupId()!=0}
	{if $oGroup->getGroupId() != $Group and $Group !=0}
	</table>
	{literal}
	<script type="text/javascript"> 
	  	$(document).ready(function() 
		{ 
			$("#allteams{/literal}{$Group}{literal}").tablesorter(); 
		} 
	); 
	/*  window.addEvent('domready',function(){ 
		var allteams = new HtmlTable($('allteams{/literal}{$Group}{literal}'));
		allteams.enableSort();
	  }); // addEvent 
	*/  
	</script> 
	{/literal}
	{/if}

	{if $oGroup->getGroupId() != $Group}
	{assign var=Position value=1}
	<br/>
	<p align="center"><b>{$oGroup->getName()}</b></p>
	<table width="100%" cellspacing="0" class="table table-striped table-bordered table-hover" id="allteams{$oGroup->getGroupId()}">
	<thead>
	<tr> 
		<th class="cside" align="center">№</th>	
		<th class="cside" align="center"></th>
		<th class="cside">Команда</th>
		<th class="cside" align="center">И</th>
		<th class="cside" align="center">В</th>
	{*	
		<th class="cside" align="center">ВО</th>
		<th class="cside" align="center">ВБ</th>
		<th class="cside" align="center">ПО</th>
		<th class="cside" align="center">ПБ</th>
	*}	
		<th class="cside" align="center">Н</th>
		<th class="cside" align="center">П</th>
		<th class="cside" align="center">Мячи</th>
		<th class="cside" align="center">О</th>
		{*<th class="cside" align="center">СВ</th>
		<th class="cside" align="center">СП</th>
		<th class="cside" align="center">ГЗ</th>
		<th class="cside" align="center">ГП</th>
		<th class="cside" align="center">±</th>
		<th class="cside" align="center">ГЗМ</th>
		<th class="cside" align="center">ГПМ</th>
		<th class="cside" align="center">%</th>
		<th class="cside" align="center">П10</th> *}
	</tr>
	</thead>
	{assign var=PrevGroup value=$Group}
	{assign var=Group value=$oGroup->getGroupId()}
	{/if}
{assign var=oTeam value=$oTournamentstat->getTeam()}
{assign var=TotalMatches value=($oTournamentstat->getHomeW()+$oTournamentstat->getHomeL()+$oTournamentstat->getHomeT()+$oTournamentstat->getHomeWot()+$oTournamentstat->getHomeLot()+$oTournamentstat->getHomeWb()+$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayW()+$oTournamentstat->getAwayL()+$oTournamentstat->getAwayT()+$oTournamentstat->getAwayWot()+$oTournamentstat->getAwayLot()+$oTournamentstat->getAwayWb()+$oTournamentstat->getAwayLb())}
<tr>
	<td class="{$className}" width="25" align="center">{$Position}</td>	
	<td class="{$className}" width="25"><img width="20" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/></td>
	<td class="{$className}" width="200"><a href="#" class="teamrasp">{$oTeam->getName()}</a></td>
	<td class="{$className}" align="center">{$TotalMatches}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getHomeW()+$oTournamentstat->getAwayW()+$oTournamentstat->getHomeWot()+$oTournamentstat->getAwayWot()+$oTournamentstat->getHomeWb()+$oTournamentstat->getAwayWb()}</td>
{*	
	<td class="{$className}" align="center">{$oTournamentstat->getHomeWot()+$oTournamentstat->getAwayWot()}</td>
    <td class="{$className}" align="center">{$oTournamentstat->getHomeWb()+$oTournamentstat->getAwayWb()}</td>	
	<td class="{$className}" align="center">{$oTournamentstat->getHomeLot()+$oTournamentstat->getAwayLot()}</td>
    <td class="{$className}" align="center">{$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayLb()}</td>
*}	
    <td class="{$className}" align="center">{$oTournamentstat->getHomeT()+$oTournamentstat->getAwayT()}</td>	
	<td class="{$className}" align="center">{$oTournamentstat->getHomeL()+$oTournamentstat->getAwayL()+$oTournamentstat->getHomeLot()+$oTournamentstat->getAwayLot()+$oTournamentstat->getHomeLb()+$oTournamentstat->getAwayLb()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getGf()}-{$oTournamentstat->getGa()}</td>
	<td class="{$className}" align="center"><b>{$oTournamentstat->getPoints()}</b></td>
	{*<td class="{$className}" align="center">{$oTournamentstat->getSuhW()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getSuhL()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getGf()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getGa()}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getGf()-$oTournamentstat->getGa()}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oTournamentstat->getGf()/$TotalMatches)|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oTournamentstat->getGa()/$TotalMatches)|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{if $TotalMatches}{($oTournamentstat->getPoints()/($TotalMatches*$oTournament->getWin()) )|string_format:"%.2f"}{else}0{/if}</td>
	<td class="{$className}" align="center">{$oTournamentstat->getLastTen()}</td>*}
</tr>
{assign var=Position value=$Position+1}
{/if}
{/foreach}

{if $Group !=0 }
</table>
{/if}


{literal}
<script type="text/javascript"> 
	  	$(document).ready(function() 
		{ 
			$("#allteams{/literal}{$Group}{literal}").tablesorter(); 
		} 
	); 
 /* window.addEvent('domready',function(){ 
	var allteams = new HtmlTable($('allteams{/literal}{$Group}{literal}'));
	allteams.enableSort();
  }); // addEvent 
  */
</script> 
{/literal}
{/if}
</small>
{*по подгруппам*}
<script language="JavaScript" type="text/javascript">


</script>
{include file='footer.tpl'}