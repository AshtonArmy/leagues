{include file='header.tpl' menu_content='tournament'}



{*
{if $oTournament->getDatezayavki()!='0000-00-00' and $oTournament->getDatezayavki()|date_format:"%Y%m%d" >= $smarty.now|date_format:"%Y%m%d"}
<p align="right">Количество людей подавших заявки: <b>{if $count_aPlayercard}{$count_aPlayercard}{else}0{/if}</b></p>
<div id="zayavki"></div>
{/if}
*}
{if $aPlayercard}

<div id="users-list-search" style="display:none;"></div>

<div id="users-list-original"> 
	{assign var=sUsersRootPage value='http://virtualsports.ru/teams/players'}
	{include file='teamplay_list.tpl' aPlayercard=$aPlayercard bUsersUseOrder=false sUsersRootPage=$sUsersRootPage}
</div>
<p align="right">Количество людей подавших заявки: <b>{if $count_aPlayercard}{$count_aPlayercard}{else}0{/if}</b></p>
<div id="zayavki"></div>
{/if}



{*}
{if $aTeamTournament}
<table width="100%" cellspacing="0" class="uchastniki">
{foreach from=$aTeamTournament item=oTeamTournament name=el2}
	{assign var=oTeam value=$oTeamTournament->getTeam()}

    {if $smarty.foreach.el2.iteration % 2  == 0}
     	{assign var=className value=''}
    {else}
     	{assign var=className value='colored'}
    {/if}
	<tr class="{$className}" height="40">
        <td width="10">&nbsp;</td>	
		<td width="50">{if $oTeam->getLogo()!=""}<img height="40" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/>{/if}</td>
        <td width="200" class="name"><a class="title" href="#">{$oTeam->getName()}</a></td>
		<td class="name">{if $TeamZayavok[$oTeam->getTeamId()].zayavok>0} (заявок:{$TeamZayavok[$oTeam->getTeamId()].zayavok}){/if}</td>
		<td style="text-align:center;"></td>
        
    </tr>
{/foreach}
</table>
{/if}
{*}



{literal}
<script type="text/javascript"> 
	  	$(document).ready(function() 
		{ 
			$("#playerlist").tablesorter(); 
		} 
	); 

</script> 
{/literal}

{include file='footer.tpl'}