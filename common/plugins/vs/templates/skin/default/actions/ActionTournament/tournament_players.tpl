{include file='header.tpl' menu_content='tournament'}
{if $aTeams}
{*$oTournament->getName()*}
<table width="100%" cellspacing="0" class="uchastniki">
<tr style="font-weight:bold;">
    </tr>
    {foreach from=$aTeams item=oTeam name=el2}
	{if $oTeam->getPlayer1()}{assign var="oUser" value=$oTeam->getUser()}{/if}
    {if $smarty.foreach.el2.iteration % 2  == 0}
     	{assign var=className value=''}
    {else}
     	{assign var=className value='colored'}
    {/if}
	<tr class="{$className}" >
        <td width="20">&nbsp;</td>	
        <td width="70"> <img  width="32" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"></td>
        <td width="200" class="name"><a class="title" href="#">{$oTeam->getName()}</a></td>
		<td class="name">{if $oTeam->getPlayer1()}<a class="author" target="_blank" href="{$oUser->getUserWebPath()}"> {$oUser->getLogin()}</a>{/if} </td>
		<td style="text-align:center;"></td>
        
    </tr>
    {/foreach}

</table>
{/if}
{if $oTournament->getDatezayavki()!='0000-00-00' and $oTournament->getDatezayavki()|date_format:"%Y%m%d" >= $smarty.now|date_format:"%Y%m%d"}
<p align="right">Количество людей подавших заявки: <b>{if $Zayavok}{$Zayavok}{else}0{/if}</b>{if $Zayavok} <a href="javascript:showZayavki()"><span id="zayavki_link">показать</span></a>{/if}</p>
<div id="zayavki"></div>
{/if}
{if $aObjects}
<table width="100%" cellspacing="0" class="uchastniki">
{foreach from=$aObjects item=oObject name=el2}
	{assign var=oTeamInTournament value=$oObject.oTeamInTournament}
	{assign var=aUserFields value=$oObject.aUserFields}
	{assign var=oPlayerTournament value=$oObject.oPlayerTournament}
	
	{assign var=oTeam value=$oTeamInTournament->getTeam()}
	{if $oTeamInTournament->getPlayerId()} {assign var=oUser1 value=$oTeamInTournament->getUser1()}{/if}
    {if $smarty.foreach.el2.iteration % 2  == 0}
     	{assign var=className value=''}
    {else}
     	{assign var=className value='colored'}
    {/if}
	<tr class="{$className}" height="60">
        <td width="10">&nbsp;</td>	
		<td width="50">{if $oTeam->getLogo()!=""}<img width="32" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/>{/if}</td>
        <td width="170" class="name"><a class="teamrasp" href="#">{$oTeam->getName()}</a></td>
		<td class="name" width="110">{if $oTeamInTournament->getPlayerId()}<a class="author" target="_blank" href="{$oUser1->getUserWebPath()}"> {$oUser1->getLogin()}</a>{/if} 
						{if $oTeamInTournament->getPlayerId()==0}
							{if $oTournament->getZakryto()==0}	
							{if !$HasTeam}
									{if $login != ''}<a href="{$link_zayavki}"> подай заявку</a>{else}команда свободна{/if}{if $TeamZayavok[$oTeam->getTeamId()] >0} (заявок:{$TeamZayavok[$oTeam->getTeamId()]}){/if}
								{/if}
							{/if}
						{/if}
					</td>
		<td width="170">{if $oPlayerTournament}<ul class="uch"><li class="{$platforms}">{$oPlayerTournament->getPsnid()}</li></ul>{/if}</td>
		<td width="80">{if $oPlayerTournament}{if $oPlayerTournament->getPenalties()>0}<ul class="uch"><li class="kartochki">{$oPlayerTournament->getPenalties()|number_format}</li></ul>{/if}{/if}</td>
		<td align="left">
			<ul class="uch">
			{if $oTeamInTournament->getUser1()}
			
				{if $oUser1->getProfileIcq()!=''}
					<li class="icq">{$oUser1->getProfileIcq()}</li>
				{/if}			
			{/if}
			{if $aUserFields}
				{foreach from=$aUserFields item=oField}					
					{if $oField->getName(true,true)=='skype'}					
						<li class="skype">{$oField->getValue(true,true)}</li>
					{/if}
				{/foreach}
			{/if}
			
			</ul>
		</td>
        
    </tr>
{/foreach}
</table>
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
{if $aTeamTournament}
<table width="100%" cellspacing="0" class="uchastniki">
{foreach from=$aTeamTournament item=oTeam name=el2}

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
<script type="text/javascript"> 
{literal}
function showZayavki() {
if($('#zayavki').html()=="")
{
		var params = {};
{/literal}
		params['tournament']={$oTournament->getTournamentId()};
{literal}
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;
		
	ls.ajax(aRouter['ajax']+'tournament/zayavki/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error('Error','Please try again later');
			} else { 
				$('#zayavki').html(result.sText);
				$('#zayavki_link').val('скрыть');
			}
		});

}else{
	$('#zayavki').html('');
	$('#zayavki_link').val('показать');
}
}
{/literal}
</script> 
{include file='footer.tpl'}