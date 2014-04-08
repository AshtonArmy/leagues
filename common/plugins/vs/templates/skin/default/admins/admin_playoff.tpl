Создать 
<select class="w70" id="add_round" onchange="createround();">
	<option value="0"></option>
	{if !$Teams32}<option value="32">1/32</option>{/if}
	{if !$Teams16}<option value="16">1/16</option>{/if}
	{if !$Teams8}<option value="8">1/8</option>{/if}
	{if !$Teams4}<option value="4">1/4</option>{/if}
	{if !$Teams2}<option value="2">1/2</option>{/if}
	{if !$Teams1}<option value="1">Final</option>{/if}
</select>
<br/>
{if $Teams1}
{assign var=num value=1}
<div>Финал<br/>
{if !isset($Matches1)}с <input name='1start_day' type='text' id="1start_day" value='{$smarty.now|date_format:"%d-%m-%Y"}' class='date demo_ranged' /> матчей <input type='text' id="1matches_in_day" SIZE="1" maxlength="1" class="input-mini"/> в день, игры через <input type='text' id="1matches_between_day" SIZE="1" maxlength="1" class="input-mini"/> дней, до <input type='text' id="1matches_to_win" SIZE="1" maxlength="1" class="input-mini"/> побед

 - <a href="#" onclick="createraspisanie(1);return false;">создать расп.</a>
 <a href="#" onclick="deleteround(1);return false;">удалить раунд</a>
 {else}
 <a href="#" onclick="deleteraspisanie(1);return false;">удалить расписание</a>
 {/if}
	<table>
	{foreach from=$Teams1 item=oTeams name=el2}
		<tr>
			<td> 
				<select class="w200" id="1_{$num}" onchange="saveround('1_{$num}');">
					<option value="0"></option>
					{foreach from=$aTeams item=oTeam}
						<option value="{$oTeam->getTeamId()}" {if $oTeam->getTeamId()==$oTeams}SELECTED{/if}>{$oTeam->getTeam()->getName()}</option>
					{/foreach}
				</select>
			</td>			
		</tr>
		{if $smarty.foreach.el2.iteration % 2  == 0}
			<tr>
				<td>&nbsp;
				</td>			
			</tr>
		{/if}
		{assign var=num value=$num+1}
	{/foreach}
	</table>
</div>
{/if}

{if $Teams2}
{assign var=num value=1}
<div>1/2<br/>
{if !isset($Matches2)}с <input name='2start_day' type='text' id="2start_day" value='{$smarty.now|date_format:"%d-%m-%Y"}' class='date demo_ranged' /> матчей <input type='text' id="2matches_in_day" SIZE="1" maxlength="1" class="input-mini"/> в день, игры через <input type='text' id="2matches_between_day" SIZE="1" maxlength="1" class="input-mini"/> дней, до <input type='text' id="2matches_to_win" SIZE="1" maxlength="1" class="input-mini"/> побед

 - <a href="#" onclick="createraspisanie(2);return false;">создать расп.</a>
 <a href="#" onclick="deleteround(2);return false;">удалить раунд</a>
 {else}
 <a href="#" onclick="deleteraspisanie(2);return false;">удалить расписание</a>
 {/if}
	<table>
	{foreach from=$Teams2 item=oTeams name=el2}
		<tr>
			<td> 
				<select class="w200" id="2_{$num}" onchange="saveround('2_{$num}');">
					<option value="0"></option>
					{foreach from=$aTeams item=oTeam}
						<option value="{$oTeam->getTeamId()}" {if $oTeam->getTeamId()==$oTeams}SELECTED{/if}>{$oTeam->getTeam()->getName()}</option>
					{/foreach}
				</select>
			</td>			
		</tr>
		{if $smarty.foreach.el2.iteration % 2  == 0}
			<tr>
				<td>&nbsp;
				</td>			
			</tr>
		{/if}
		{assign var=num value=$num+1}
	{/foreach}
	</table>
</div>
{/if}

{if $Teams4}
{assign var=num value=1}
<div>1/4<br/>
{if !isset($Matches4)}с <input name='4start_day' type='text' id="4start_day" value='{$smarty.now|date_format:"%d-%m-%Y"}' class='date demo_ranged' /> матчей <input type='text' id="4matches_in_day" SIZE="1" maxlength="1" class="input-mini"/> в день, игры через <input type='text' id="4matches_between_day" SIZE="1" maxlength="1" class="input-mini"/> дней, до <input type='text' id="4matches_to_win" SIZE="1" maxlength="1" class="input-mini"/> побед

 - <a href="#" onclick="createraspisanie(4);return false;">создать расп.</a>
 <a href="#" onclick="deleteround(4);return false;">удалить раунд</a>
 {else}
 <a href="#" onclick="deleteraspisanie(4);return false;">удалить расписание</a>
 {/if}
	<table>
	{foreach from=$Teams4 item=oTeams name=el2}
		<tr>
			<td> 
				<select class="w200" id="4_{$num}" onchange="saveround('4_{$num}');">
					<option value="0"></option>
					{foreach from=$aTeams item=oTeam}
						<option value="{$oTeam->getTeamId()}" {if $oTeam->getTeamId()==$oTeams}SELECTED{/if}>{$oTeam->getTeam()->getName()}</option>
					{/foreach}
				</select>
			</td>			
		</tr>
		{if $smarty.foreach.el2.iteration % 2  == 0}
			<tr>
				<td>&nbsp;
				</td>			
			</tr>
		{/if}
		{assign var=num value=$num+1}
	{/foreach}
	</table>
</div>
{/if}
{if $Teams8}
{assign var=num value=1}
<div>1/8<br/>
{if !isset($Matches8)}с <input name='8start_day' type='text' id="8start_day" value='{$smarty.now|date_format:"%d-%m-%Y"}' class='date demo_ranged' /> матчей <input type='text' id="8matches_in_day" SIZE="1" maxlength="1" class="input-mini"/> в день, игры через <input type='text' id="8matches_between_day" SIZE="1" maxlength="1" class="input-mini"/> дней, до <input type='text' id="8matches_to_win" SIZE="1" maxlength="1" class="input-mini"/> побед

 - <a href="#" onclick="createraspisanie(8);return false;">создать расп.</a>
 <a href="#" onclick="deleteround(8);return false;">удалить раунд</a>
 {else}
 <a href="#" onclick="deleteraspisanie(8);return false;">удалить расписание</a>
 {/if}
	<table>
	{foreach from=$Teams8 item=oTeams name=el2}
		<tr>
			<td> 
				<select class="w200" id="8_{$num}" onchange="saveround('8_{$num}');">
					<option value="0"></option>
					{foreach from=$aTeams item=oTeam}
						<option value="{$oTeam->getTeamId()}" {if $oTeam->getTeamId()==$oTeams}SELECTED{/if}>{$oTeam->getTeam()->getName()}</option>
					{/foreach}
				</select>
			</td>			
		</tr>
		{if $smarty.foreach.el2.iteration % 2  == 0}
			<tr>
				<td>&nbsp;
				</td>			
			</tr>
		{/if}
		{assign var=num value=$num+1}
	{/foreach}
	</table>
</div>
{/if}

{literal}
<script type="text/javascript">
 window.addEvent('load', function() {
new DatePicker('.demo_ranged', {
		pickerClass: 'datepicker_vista',
		inputOutputFormats: 'd-m-Y',
		timePicker: true, 
		formats: 'd-m-Y',
		yearPicker: false
	});
});	
</script> 
{/literal}
