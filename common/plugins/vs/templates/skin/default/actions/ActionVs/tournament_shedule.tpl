{if $month}
<p align="right"><select  class="select_rapisanie" onchange="ls.au.simple_toggles(this,'monthes', {literal}{{/literal} tournament: {$tournament_id}, monthes:this.options[this.selectedIndex].value {if $teambrief}, team:'{$teambrief}'{/if} {literal}}{/literal}); return false;" name='choice'>  
  <option value='0'{if $month==0} SELECTED{/if}>-</option>
  <option value='1'{if $month==1} SELECTED{/if}>январь</option>  
  <option value='2'{if $month==2} SELECTED{/if}>февраль</option>  
  <option value='3'{if $month==3} SELECTED{/if}>март</option>   
  <option value='4'{if $month==4} SELECTED{/if}>апрель</option> 
  <option value='5'{if $month==5} SELECTED{/if}>май</option> 
  <option value='6'{if $month==6} SELECTED{/if}>июнь</option> 
  <option value='7'{if $month==7} SELECTED{/if}>июль</option> 
  <option value='8'{if $month==8} SELECTED{/if}>август</option> 
  <option value='9'{if $month==9} SELECTED{/if}>сентябрь</option> 
  <option value='10'{if $month==10} SELECTED{/if}>октябрь</option> 
  <option value='11'{if $month==11} SELECTED{/if}>ноябрь</option>   
  <option value='12'{if $month==12} SELECTED{/if}>декабрь</option>  
</select> 
</p>
{/if}
{literal}
<script>
function deletes(id){
var row = document.getElementById(id);
row.cells.item(1).innerHTML="aloha";
}
</script>
{/literal}
{*}
<table id="test">
	<tr id="match123">
		<td>1</td>
		<td>2</td>
		<td>3 <a href="javascript:deletes('match123');">test</td>
	</tr>
</table>

<style>
{literal} 
.match_num   { float:left; position: relative; width:30px; height:20px;}
.away_team   { float:left; position: relative; width:200px; height:20px;}
.home_team   { float:left; position: relative; width:200px; height:20px;}
.match_result   { float:left; position: relative; height:20px;}
.match_upr   { float:left;  position: relative; height:20px;}
.one_match    { clear:both; margin-top: 6px; position: relative; }
.match_date {clear:both; position: relative; margin-top: 6px; }
.div-light {background-color:#E3E3E3;}
.div-vlight {background-color:#F0F0F0;}

.clearer {clear:both;}
{/literal}
</style>


<div class="matches">
    {foreach from=$oMatches item=oMatch name=el2}
		{if $smarty.foreach.el2.iteration % 2  == 0}
			{assign var=className value='div-light'}
		{else}
			{assign var=className value='div-vlight'}
		{/if}
		{if $oMatch.dates != $dates_before}	
			<div class="match_date">{$oMatch.day_of_week}, {$oMatch.dates}</div>
		{/if}
		<div id="match_{$oMatch.match_id}" height="20" class="one_match">
			<div class="match_num {$className}" >{$oMatch.number}</div>
			<div class="away_team {$className}"><img height="20" src="/images/teams/small/{$oMatch.away_logo}"/> {$oMatch.away_name}</div>
			<div class="home_team {$className}"><img height="20" src="/images/teams/small/{$oMatch.home_logo}"/> {$oMatch.home_name}</div>
			<div class="match_result {$className}"></div>
			<div class="match_upr {$className}"></div>
		</div>
		{assign var=dates_before value=$oMatch.dates}
	{/foreach}
</div>	
{*}
{if $oMatches}
<table width="100%" cellspacing="0" class="raspisanie">
<thead>
<tr>
	<th class="lside" width="11"></th>		
	<th class="cside" align="center">№</th>
	<th class="cside">{if $oGame->getSportId()==2}Дома{else}Гости{/if}</th>
	<th class="cside">{if $oGame->getSportId()==2}Гости{else}Дома{/if}</th>
	<th class="cside"  align="center">Счет</th>
    <th class="cside"></th>
	<th class="cside" align="center"></th>
	<th class="rside" width="11"></th>
</tr>
</thead>
    {foreach from=$oMatches item=oMatch name=el2}
    {if $smarty.foreach.el2.iteration % 2  == 0}
     	{assign var=className value='light'}
    {else}
     	{assign var=className value='vlight'}
    {/if}
{*}	{if $oMatch.dates != $dates_before}  		
	<tr class="line">
		<td colspan="7"></td>
	</tr>
	{/if} 
{*}
	<tr>
	{if $oMatch.dates != $dates_before}	
{if $classDate=='date'}	{assign var=classDate value='dates'}{else}{assign var=classDate value='date'}{/if}
		
	{*}	<td width="100" rowspan="{$oMatch.match_day}" class="{$classDate}" align="center" border="1"><span class="datespan">{$oMatch.dates}</span></br>{$oMatch.day_of_week}</td>
{*}	<tr class="line" height="20">
		<td colspan="8"> {$oMatch.dates}, {$oMatch.day_of_week}</td>
	</tr>
{/if}
		<td width="11"   align="center"></td>
		<td class="{$className}" width="40" align="center">{$oMatch.number} {if $oMatch.round_id<>0}(ПО){/if}</td>
        <td class="{$className}" width="240">
			<img height="20" src="/images/teams/small/{$oMatch.away_logo}"/> <a href="#" onclick="ls.au.simple_toggles(this,{if isset($month)}'monthes'{/if}{if isset($week)}'weeks'{/if}, {literal}{{/literal} tournament: {$tournament_id} {if isset($month)}, monthes:{$month}{/if}{if isset($week)}, week:{$week}{/if}, team:'{$oMatch.away_brief}' {literal}}{/literal}); return false;" class="teamrasp {if $myteam==$oMatch.away}myteam{/if}">{$oMatch.away_name}</a>{*{if $admin=="yes"}<a href="javascript:result_edit({$oMatch.match_id},'divmatch{$oMatch.match_id}', 'vnesti{$oMatch.match_id}',{$oMatch.away});"><img src="/images/edit.png" /></a>{/if}{if $admin=="yes" && $oMatch.away_insert==1} <a href="javascript:result_team_delete({$oMatch.match_id} ,{$oMatch.away},'гостевой');"><img src="/images/delete.png" /></a>{/if} *} 
		</td>
		<td class="{$className}" width="240">
			<img height="20" src="/images/teams/small/{$oMatch.home_logo}"/> <a href="#" onclick="ls.au.simple_toggles(this,{if isset($month)}'monthes'{/if}{if isset($week)}'weeks'{/if}, {literal}{{/literal} tournament: {$tournament_id} {if isset($month)}, monthes:{$month}{/if}{if isset($week)}, week:{$week}{/if}, team:'{$oMatch.home_brief}' {literal}}{/literal}); return false;" class="teamrasp {if $myteam==$oMatch.home}myteam{/if}">{$oMatch.home_name}</a>{*{if $admin=="yes"}<a href="javascript:result_edit({$oMatch.match_id},'divmatch{$oMatch.match_id}', 'vnesti{$oMatch.match_id}',{$oMatch.home});"><img src="/images/edit.png" /></a>{/if}{if $admin=="yes" && $oMatch.home_insert==1} <a href="javascript:result_team_delete({$oMatch.match_id} ,{$oMatch.home},'домашней');"><img src="/images/delete.png" /></a>{/if}  *}
		</td>
		<td class="{$className}" width="80" align="center">
			{if $oMatch.played==1}
<div id="match{$oMatch.match_id}">{$oMatch.g_away} : {$oMatch.g_home}{if $oMatch.so==1} SO{/if}{if $oMatch.ot==1} ОТ{/if}{if $oMatch.teh==1} тех.{/if}</div>
				{*{if $admin=="yes"}<a href="javascript:result_anul({$oMatch.match_id});">уд</a> <a href="javascript:result_anul_without_pred({$oMatch.match_id});">уд/б.п.</a>{/if}*}
			{else}
			<div id="match{$oMatch.match_id}"></div>
				{if $oMatch.home_insert==1 && $oMatch.away_insert==1}не совпало{/if}
				{if $oMatch.home_insert != $oMatch.away_insert}ждемс{/if}
				{if $oMatch.myteam==1}					
					{if $oMatch.timetoplay != '0000-00-00 00:00:00'}<a href="{$link_match}{$oMatch.match_id}">{$oMatch.timetoplay|date_format :"%d %b %H:%M"}</a>{/if}
					{*{if $admin=="yes"}
						<a href="javascript:result_teh({$oMatch.match_id},'{$oMatch.away}','tehl');">пор</a> <a href="javascript:result_teh({$oMatch.match_id},'{$oMatch.away}','tehn');">нич</a> <a href="javascript:result_teh({$oMatch.match_id},'{$oMatch.home}','tehl');">пор</a>
					{/if}*}
				{else}
				{/if}
			{/if}
		</td>
		<td class="{$className}" width="90">
			{if ( 
			    (	
					( $oMatch.myteam==1) && 
					(
						(  $tournament_id!=19  && $tournament_id!=26  && $tournament_id!=33 && $tournament_id!=35 && $tournament_id!=51 && $tournament_id!=52 && $tournament_id!=63 && $tournament_id!=60 && $tournament_id!=61 &&  $tournament_id!=73  && $tournament_id!=74 && $tournament_id!=86 && $tournament_id!=93 ) || 
						( 
							( $tournament_id==19  || $tournament_id==52  ) && 
							($oMatch.currentweek<= "+3 days"|date_format:"%V" && $oMatch.currentyear<= "+3 days"|date_format:"%Y") || 
							($oMatch.currentweek> "+3 days"|date_format:"%V" && $oMatch.date_match< "+3 days"|date_format:"%Y%m%d")
						)
						|| 
						( 
							( $tournament_id==51 || $tournament_id==63 || $tournament_id==86  || $tournament_id==93) && 
							($oMatch.currentweek<= "+5 days"|date_format:"%V" && $oMatch.currentyear<= "+5 days"|date_format:"%Y") || 
							($oMatch.currentweek> "+5 days"|date_format:"%V" && $oMatch.date_match< "+5 days"|date_format:"%Y%m%d")
						)
						|| 
						( 
							( $tournament_id==1   ) && 
							($oMatch.currentweek<= "+1 days"|date_format:"%V" && $oMatch.currentyear<= "+1 days"|date_format:"%Y") || 
							($oMatch.currentweek> "+1 days"|date_format:"%V" && $oMatch.date_match< "+1 days"|date_format:"%Y%m%d")
						)
						|| 
						( 
							( $tournament_id==60 || $tournament_id==61 ) && 
							($oMatch.currentweek<= "+14 days"|date_format:"%V" && $oMatch.currentyear<= "+14 days"|date_format:"%Y") || 
							($oMatch.currentweek> "+14 days"|date_format:"%V" && $oMatch.date_match< "+14 days"|date_format:"%Y%m%d")
						)
						||
						( 
							( $tournament_id==73  ) && 
							($oMatch.date_match <= "20131211" )
						)
						||
						( 
							( $tournament_id==74  ) && 
							($oMatch.date_match <= "20131014" )
						)
						
				)) || $oMatch.played==1 && $oMatch.teh==0 || $admin=="yes")}
				<div class="dropdown left">
					<a class="buttons left" href="#" name="{$oMatch.match_id}"><span class="icon icon96"></span><span class="label"></span><span class="toggle"></span></a>
				</div>

			{/if}
	
		</td>
		{if $oMatch.played==0}
			{assign var=classprodlenie value=''}
			{if (( ( $smarty.now|date_format:"%Y"==$oMatch.prodlenyear && $smarty.now|date_format:"%V">$oMatch.prodlenweek  ) || ($smarty.now|date_format:"%Y">$oMatch.prodlenyear ) ))}
				{assign var=classprodlenie value='reds'}
			{/if}
			
			{if ( ($oMatch.prodlen>0) &&(( $smarty.now|date_format:"%Y"==$oMatch.prodlenyear && $smarty.now|date_format:"%V"<=$oMatch.prodlenweek  ) || ($smarty.now|date_format:"%Y"<$oMatch.prodlenyear )) )}
				{assign var=classprodlenie value='greens'}
			{/if}	
			
			<td width="11" class="{$classprodlenie}">{if $oMatch.prodlen>0}{$oMatch.prodlen}{/if}</td>
		{else}
			<td width="11"></td>
		{/if}
		<td width="11"></td>
	</tr>

	{assign var=dates_before value=$oMatch.dates}	
	{assign var=first value=0}
    {/foreach}

</table>
<div style="margin-top:70px;padding-top:70px;"></div>
{else}
<p align="center">за указанный период матчи отсутствуют</p>
{/if}
