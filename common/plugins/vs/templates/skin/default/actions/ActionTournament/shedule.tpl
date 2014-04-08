{*{if $month}
<p align="right"><select  class="select_rapisanie" onchange="ls.au.simple_toggles(this,'monthes', {literal}{{/literal} tournament: {$tournament_id}, monthes:this.options[this.selectedIndex].value {if $teambrief}, team:'{$teambrief}'{/if} {literal}}{/literal}); return false;" name='choice'>  
  <option value='0'{if $month==0} SELECTED{/if}>all</option>
  <option value='1'{if $month==1} SELECTED{/if}>january</option>  
  <option value='2'{if $month==2} SELECTED{/if}>february</option>  
  <option value='3'{if $month==3} SELECTED{/if}>march</option>   
  <option value='4'{if $month==4} SELECTED{/if}>april</option> 
  <option value='5'{if $month==5} SELECTED{/if}>may</option> 
  <option value='6'{if $month==6} SELECTED{/if}>june</option> 
  <option value='7'{if $month==7} SELECTED{/if}>july</option> 
  <option value='8'{if $month==8} SELECTED{/if}>august</option> 
  <option value='9'{if $month==9} SELECTED{/if}>september</option> 
  <option value='10'{if $month==10} SELECTED{/if}>october</option> 
  <option value='11'{if $month==11} SELECTED{/if}>november</option>   
  <option value='12'{if $month==12} SELECTED{/if}>december</option>  
</select> 
</p>
{/if}*}
{*
{literal}
<script>
function deletes(id){
var row = document.getElementById(id);
row.cells.item(1).innerHTML="aloha";
}
</script>
{/literal}
*}
{if $oMatches}
<table width="100%" cellspacing="0" class="table">
<thead>
<tr>
	<th class="lside"></th>		
	<th class="cside" align="center">№</th>
	<th class="cside">{if $oGame->getSportId()==2}Home{else}Away{/if}</th>
	<th class="cside">{if $oGame->getSportId()==2}Away{else}Home{/if}</th>
	<th class="cside" align="center">Score</th>
    <th class="cside" align="center"></th>
	<th class="cside" align="center"></th>
</tr>
</thead>
<tbody>
    {foreach from=$oMatches item=oMatch name=el2}
    {if $smarty.foreach.el2.iteration % 2  == 0}
     	{assign var=className value='light'}
    {else}
     	{assign var=className value='vlight'}
    {/if}
	<tr>
{*	{if $oMatch.dates != $dates_before}	
		{if $classDate=='date'}	{assign var=classDate value='dates'}{else}{assign var=classDate value='date'}{/if}
		
			<tr class="line" style="height:20px;width:20px;">
				<td colspan="8"> {$oMatch.dates}, {$oMatch.day_of_week}</td>
			</tr>

	{/if}*}
		<td align="center"><small>{$oMatch.dates}</small></td>
		<td class="{$className}" width="40" align="center">{$oMatch.number} {if $oMatch.round_id<>0}(ПО){/if}</td>
        <td class="{$className}" width="240">
			<img style="height:20px;width:20px;" src="/images/teams/small/{$oMatch.away_logo}"/> <a href="#" onclick="ls.au.simple_toggles(this,{if isset($month)}'monthes'{/if}{if isset($week)}'weeks'{/if}, {literal}{{/literal} tournament: {$tournament_id} {if isset($month)}, monthes:{$month}{/if}{if isset($week)}, week:{$week}{/if}, team:'{$oMatch.away_brief}' {literal}}{/literal}); return false;" class="teamrasp {if $myteam==$oMatch.away}myteam{/if}">{$oMatch.away_name}</a>{*{if $admin=="yes"}<a href="javascript:result_edit({$oMatch.match_id},'divmatch{$oMatch.match_id}', 'vnesti{$oMatch.match_id}',{$oMatch.away});"><img src="/images/edit.png" /></a>{/if}{if $admin=="yes" && $oMatch.away_insert==1} <a href="javascript:result_team_delete({$oMatch.match_id} ,{$oMatch.away},'гостевой');"><img src="/images/delete.png" /></a>{/if} *} 
		</td>
		<td class="{$className}" width="240">
			<img style="height:20px;width:20px;" src="/images/teams/small/{$oMatch.home_logo}"/> <a href="#" onclick="ls.au.simple_toggles(this,{if isset($month)}'monthes'{/if}{if isset($week)}'weeks'{/if}, {literal}{{/literal} tournament: {$tournament_id} {if isset($month)}, monthes:{$month}{/if}{if isset($week)}, week:{$week}{/if}, team:'{$oMatch.home_brief}' {literal}}{/literal}); return false;" class="teamrasp {if $myteam==$oMatch.home}myteam{/if}">{$oMatch.home_name}</a>{*{if $admin=="yes"}<a href="javascript:result_edit({$oMatch.match_id},'divmatch{$oMatch.match_id}', 'vnesti{$oMatch.match_id}',{$oMatch.home});"><img src="/images/edit.png" /></a>{/if}{if $admin=="yes" && $oMatch.home_insert==1} <a href="javascript:result_team_delete({$oMatch.match_id} ,{$oMatch.home},'домашней');"><img src="/images/delete.png" /></a>{/if}  *}
		</td>
		<td class="{$className}" width="80" align="center">
			{if $oMatch.played==1}
<div id="match{$oMatch.match_id}">{$oMatch.g_away} : {$oMatch.g_home}{if $oMatch.so==1} SO{/if}{if $oMatch.ot==1} ОТ{/if}{if $oMatch.teh==1} teh.{/if}</div>
			{else}
			<div id="match{$oMatch.match_id}"></div>
				{if $oMatch.home_insert==1 && $oMatch.away_insert==1}different{/if}
				{if $oMatch.home_insert != $oMatch.away_insert}wait{/if}
				{if $oMatch.myteam==1}					
					{if $oMatch.timetoplay != '0000-00-00 00:00:00'}<a href="{$link_match}{$oMatch.match_id}">{$oMatch.timetoplay|date_format :"%H:%M"} CET</a>{/if}
					{*{if $admin=="yes"}
						<a href="javascript:result_teh({$oMatch.match_id},'{$oMatch.away}','tehl');">пор</a> <a href="javascript:result_teh({$oMatch.match_id},'{$oMatch.away}','tehn');">нич</a> <a href="javascript:result_teh({$oMatch.match_id},'{$oMatch.home}','tehl');">пор</a>
					{/if}*}
				{else}
				{if $oMatch.timetoplay != '0000-00-00 00:00:00'}{$oMatch.timetoplay|date_format :"%H:%M"} CET{/if}
				{/if}
			{/if}
		</td>
		<td width="90">
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
							( $tournament_id==74  ) && 
							($oMatch.date_match <= "20131014" )
						)
						
				)) || $oMatch.played==1 && $oMatch.teh==0 || $isAdmin || $admin=="yes")}
				{*<div class="dropdown left">
					<a class="buttons left" href="#" name="{$oMatch.match_id}"><span class="icon icon96"></span><span class="label"></span><span class="toggle"></span></a>
				</div>*}
				<div class="btn-group">
					{if ( $oMatch.date_openrasp!='20000101' and $oMatch.date_openrasp>=$oMatch.date_match ) or $oMatch.date_openrasp == '20000101' }
					<button data-toggle="dropdown" class="btn btn-info btn-small ajaxer dropdown-toggle" data-ajaxer="match/getbuttons/" name="{$oMatch.match_id}">
						Action
						<i class="icon-angle-down icon-on-right"></i>
					</button>

					<ul class="dropdown-menu dropdown-default" id="{$oMatch.match_id}">
						{*<li>
							<a href="#">Action</a>
						</li>
						<li>
							<a href="#">Another action</a>
						</li>
						<li>
							<a href="#">Something else here</a>
						</li>
						<li class="divider"></li>
						<li class="dropdown-submenu">
							<a href="#">Separated link</a>
							<ul class="dropdown-menu dropdown-danger">
								<li>
									<a href="#" tabindex="-1">Second level link</a>
								</li>
								<li>
									<a href="#" tabindex="-1">Second level link</a>
								</li>
							</ul>
						</li>
					</ul>*}
					{/if}
				</div>
			{/if}
	{$isAdmin}
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
	</tr>

	{assign var=dates_before value=$oMatch.dates}	
	{assign var=first value=0}
    {/foreach}
</tbody>
</table>
<div style="margin-top:70px;padding-top:70px;"></div>
{else}
<p align="center">no matches</p>
{/if}
