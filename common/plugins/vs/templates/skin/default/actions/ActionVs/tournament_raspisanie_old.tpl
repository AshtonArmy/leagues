{include file='header.tpl' menu='blog'}
{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats="raspisanie"}
{assign var=dates_before value=''}
{assign var=first value=1}
{assign var=classDate value='dates'}
<a href="{$link_raspisanie}" class="teamrasp">{$aLang.plugin.vs.all_games}</a>
<a href="{$link_raspisanie}weekbefore" class="teamrasp">{$aLang.plugin.vs.pweek}</a>
<a href="{$link_raspisanie}currentweek" class="teamrasp">{$aLang.plugin.vs.cweek}</a>
<a href="{$link_raspisanie}nextweek" class="teamrasp">{$aLang.plugin.vs.nweek}</a>
<select class="select_rapisanie" onchange="location = '{$link_raspisanie}month/'+this.options[this.selectedIndex].value" name='choice'>  
  <option value='0'>-</option>
  <option value='1'>{$aLang.plugin.vs.jan}</option>  
  <option value='2'>{$aLang.plugin.vs.feb}</option>  
  <option value='3'>{$aLang.plugin.vs.mar}</option>   
  <option value='4'>{$aLang.plugin.vs.apr}</option> 
  <option value='5'>{$aLang.plugin.vs.may}</option> 
  <option value='6'>{$aLang.plugin.vs.jun}</option> 
  <option value='7'>{$aLang.plugin.vs.jul}</option> 
  <option value='8'>{$aLang.plugin.vs.aug}</option> 
  <option value='9'>{$aLang.plugin.vs.sep}</option> 
  <option value='10'>{$aLang.plugin.vs.oct}</option> 
  <option value='11'>{$aLang.plugin.vs.nov}</option>   
  <option value='12'>{$aLang.plugin.vs.dec}</option>  
</select> 
{if $oMatches}
{*$oTournament->getName()*}

<table width="100%" cellspacing="0" class="raspisanie">
<tr>
	<th class="lside"></th>
	<th class="cside" align="center">{$aLang.plugin.vs.date}</th>	
	<th class="cside" align="center">№</th>
	<th class="cside">Команды</th>
	<th class="cside"  align="center">{$aLang.plugin.vs.score}</th>
    <th class="cside"></th>
	<th class="rside"></th>
</tr>
    {foreach from=$oMatches item=oMatch name=el2}
    {if $smarty.foreach.el2.iteration % 2  == 0}
     	{assign var=className value='light'}
    {else}
     	{assign var=className value='vlight'}
    {/if}
	{if $oMatch.dates != $dates_before}  		
	<tr class="line">
		<td colspan="8"></td>
	</tr>
	{/if}
	<tr>
	{if $oMatch.dates != $dates_before}	
{if $classDate=='date'}	{assign var=classDate value='dates'}{else}{assign var=classDate value='date'}{/if}
		<td width="11" rowspan="{$oMatch.match_day}" align="center"></td>
		<td width="100" rowspan="{$oMatch.match_day}" class="{$classDate}" align="center" border="1"><span class="datespan">{$oMatch.dates}</span></br>{$oMatch.day_of_week}</td>
	{/if}
		<td class="{$className}" width="50" align="center">{$oMatch.number}</td>
        <td class="{$className}" width="250"><a href="{$link_raspisanie}team/{$oMatch.away_brief}" class="teamrasp">{$oMatch.away_name}</a> - <a href="{$link_raspisanie}team/{$oMatch.home_brief}"  class="teamrasp">{$oMatch.home_name}</a></td>
		<td class="{$className}" width="100" align="center">{if $oMatch.played==1}{$oMatch.g_away} : {$oMatch.g_home}{if $oMatch.OT==1}ОТ{/if}{if $oMatch.teh==1}тех.{/if}{else} - : - {/if}</td>
		<td class="{$className}" >{if $oMatch.played==1 && $oMatch.teh==0}отчет{/if}{if $oMatch.played==0 and $oMatch.myteam==1}внести результат{/if}</td>
		<td width="11"></td>
	</tr>

	{assign var=dates_before value=$oMatch.dates}	
	{assign var=first value=0}
    {/foreach}

</table>
{else}
<p>за указанный период матчи отсутствуют</p>
{/if}
{include file='footer.tpl'}