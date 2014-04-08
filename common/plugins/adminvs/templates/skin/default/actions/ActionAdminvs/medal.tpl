{include file='header.tpl' menu='adminvs'}
{if $do==''} 
<a href="{router page='adminvs'}medal/add/"><b>Добавить</b></a>
{if $aMedals}
<table width="100%" cellspacing="0" class="admin-table">
<tr style="font-weight:bold;">
        <th>ID</th>
        <th>Какая</th>
		<th>Кому</th>
		<th>Кому</th>
		<th>Кому</th>
		<th>Турнир</th>
		<th></th>
    </tr>
    {foreach from=$aMedals item=oMedal name=el2}
    {if $smarty.foreach.el2.iteration % 2  == 0}
     	{assign var=className value=''}
    {else}
     	{assign var=className value='colored'}
    {/if}
		{assign var="oUser" value=$oMedal->getUser()} 
		{assign var="oTournament" value=$oMedal->getTournament()} 
		{assign var="oTeam" value=$oMedal->getTeam()}
		{assign var="oPlayercard" value=$oMedal->getPlayercard()}
		
	<tr class="{$className}" >
        <td style="text-align:center;"> <a href="{router page='adminvs'}medal/edit/{$oMedal->getMedalId()}">{$oMedal->getMedalId()}</a></td>
        <td style="text-align:center;"> {$oMedal->getMedal()} &nbsp;</td>
		<td style="text-align:center;"> {if $oUser}<a href="{router page='profile'}{$oUser->getLogin()}">{$oUser->getLogin()}</a> &nbsp;{/if}</td>
		<td style="text-align:center;"> {if $oTeam}{$oTeam->getName()}&nbsp;{/if}</td>
		<td style="text-align:center;"> {if $oPlayercard}{$oPlayercard->getFamily()} {$oPlayercard->getName()}&nbsp;{/if}</td>
		<td style="text-align:center;"> {$oTournament->getBrief()} &nbsp;</td>
		<td style="text-align:center;"> {$oMedal->getMedalText()} <a href="{router page='adminvs'}medal/delete/{$oMedal->getMedalId()}">Удалить</a></td>
        
    </tr>
    {/foreach}
	
</table>
{else}
	пусто	
{/if}

{/if}
{if $do=='add'}
	<form action="{router page='adminvs'}medal/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
		<p>
           <input type="text" class="input-wide" name="medal_text" value="" />&nbsp;За что
        </p>
		<p> 
			<input type="text" class="input-wide autocomplete-team" id="teams" name="teams"  />
			Команда
        </p>
		<p> 
			<input type="text" class="input-wide autocomplete-users" id="users" name="users"  />
			Юзер
        </p>
		
		<p> 
			<input type="text" class="input-wide autocomplete-playercard" id="playercards" name="playercards"  />
			Карточка игрока тимплея
        </p>
		
		<p>
			<select  name="tournament_id">
			{foreach from=$aTournament item=oTournament}   
				<option value="{$oTournament->getTournamentId()}">{$oTournament->getBrief()}</option>
			{/foreach}
			</select>&nbsp;Турнир
        </p>
{*		<p>
			<select  name="medal">   
				<option value="gold">gold</option>
				<option value="silver">silver</option>
				<option value="bronze">bronze</option>
			</select>&nbsp;медаль
        </p>
*}
		<p>
		<select name="prise" id="prise" onChange="showprise()">
			<option value="asc.gif" selected>Mimo =)</option>
			{foreach from=$medals item=medal}   
				<option value="{$medal}">{$medal}</option>
			{/foreach}
		</select>
		</p>
		<img src="cameraname.gif" border="0" name="icons" id="icons">
		<br/>
		<p class="buttons">
            <input type="submit" name="4medal" value="Добавить" />&nbsp;
        </p>
	</form>
{/if}
{if $do=='edit'}
{assign var="oUser" value=$oMedal->getUser()}
{assign var="oTeam" value=$oMedal->getTeam()}
{assign var="oPlayercard" value=$oMedal->getPlayercard()}
	<form action="{router page='adminvs'}medal/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" /> 
		 <input type="hidden" name="medal_id" value="{$oMedal->getMedalId()}" />	
		<p>
           <input type="text" class="input-wide" name="medal_text" value="{$oMedal->getMedalText()}" />&nbsp;За что
        </p>
		<p> 
			<input type="text" class="input-wide autocomplete-team" id="teams" name="teams"  value="{if $oTeam}{$oTeam->getName()}{/if}" />
			Команда
        </p>
		<p> 
			<input type="text" class="input-wide autocomplete-users" id="users" name="users" value="{if $oUser}{$oUser->getLogin()}{/if}" />
			Юзер
        </p>
		
		<p> 
			<input type="text" class="input-wide autocomplete-playercard" id="playercards" name="playercards" value="{if $oPlayercard}{$oPlayercard->getFamily()} {$oPlayercard->getName()}{/if}" />
			Карточка игрока тимплея
        </p>
{*		
		<p>
			<select  name="user_id">
			{foreach from=$aUser item=oUser}   
				<option value="{$oUser->getId()}" {if $oUser->getId()==$oMedal->getUserId()} SELECTED{/if}>{$oUser->getLogin()}</option>
			{/foreach}
			</select>&nbsp;Юзер
        </p>
*}
		<p>
			<select  name="tournament_id">
			{foreach from=$aTournament item=oTournament}   
				<option value="{$oTournament->getTournamentId()}" {if $oTournament->getTournamentId()==$oMedal->getTournamentId()} SELECTED{/if}>{$oTournament->getBrief()}</option>
			{/foreach}
			</select>&nbsp;Турнир
        </p>
{*		<p>
			<select  name="medal">   
				<option value="gold"{if "gold"==$oMedal->getMedal()} SELECTED{/if}>gold</option>
				<option value="silver"{if "silver"==$oMedal->getMedal()} SELECTED{/if}>silver</option>
				<option value="bronze"{if "bronze"==$oMedal->getMedal()} SELECTED{/if}>bronze</option>
			</select>&nbsp;медаль
        </p>
*}
		<p>
		<select name="prise" id="prise" onChange="showprise()"> 
			{foreach from=$medals item=medal}   
				<option value="{$medal}" {if $oMedal->getLogo()==$medal}SELECTED{/if}>{$medal}</option>
			{/foreach}
		</select>
		</p>
		<img src="http://img.virtualsports.ru/medals/{$oMedal->getLogo()}" border="0" name="icons" id="icons">
		<br/>
		<p class="buttons">
            <input type="submit" name="4medal" value="Сохранить" />&nbsp;
        </p>
	</form>
{/if}
{if $do=='delete'}
	<form action="{router page='adminvs'}medal/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
	    <input type="hidden" name="medal_id" value="{$oMedal->getMedalId()}" />
		{assign var="oUser" value=$oMedal->getUser()} 
		{assign var="oTournament" value=$oMedal->getTournament()} 		
		<p>
           <input type="text" name="name" value="{$oMedal->getMedalText()}" disabled="disabled" />&nbsp;Название
        </p>
		<p>
            <input type="text" name="brief" value="{$oUser->getLogin()}" disabled="disabled" />&nbsp;Сокращенное
        </p>
		<p class="buttons">
            <input type="submit" name="4medal" value="Удалить" />&nbsp;
        </p>
	</form>
{/if}
{literal}
<script language="JavaScript" type="text/javascript">
function showprise() {
	prisename = $('#prise').val();
	$('#icons') .attr("src","http://img.virtualsports.ru/medals/"+prisename); 

}
</script>
{/literal}
{include file='footer.tpl'}

