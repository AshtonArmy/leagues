<p> 
	<input type="text" class="input-wide autocomplete-teama" id="team" name="team"  />
	<a href="javascript:add_team(0,'team');">Добавить</a>
</p> 
{if $aTeams}
<table>
<tr>
<td></td>
<td>Родительская гр.</td>
<td>Гр.</td>
</tr>
{foreach from=$aTeams item=oTeamint name=el2}
<tr>
	<td>{$oTeamint->getTeam()->getName()}</td>
	<td>
		<select class="w200" id="p2_{$oTeamint->getTeamId()}" onchange="saveparentgroup('p2_{$oTeamint->getTeamId()}', {$oTeamint->getTeamId()}, {$oTeamint->getRoundId()});"> 
			{foreach from=$aGroups item=oGroup}
				<option value="{$oGroup->getGroupId()}" {if $oTeamint->getParentgroupId()==$oGroup->getGroupId()}SELECTED{/if}>{$oGroup->getName()}</option>
			{/foreach}
		</select>
	</td>
	<td>
		<select class="w200" id ="g2_{$oTeamint->getTeamId()}" onchange="savegroup('g2_{$oTeamint->getTeamId()}', {$oTeamint->getTeamId()}, {$oTeamint->getRoundId()});"> 
			{foreach from=$aGroups item=oGroup}
				<option value="{$oGroup->getGroupId()}" {if $oTeamint->getGroupId()==$oGroup->getGroupId()}SELECTED{/if}>{$oGroup->getName()}</option>
			{/foreach}
		</select>	
	</td>
	<td> <a href="javascript:delete_teamtournament({$oTeamint->getId()});">Удалить команду</a></td>
</tr>
{/foreach}
</table>
{/if}

<br/>
<br/>
{if $aTeams_second}
<p> 
	<input type="text" class="input-wide autocomplete-teama" id="team2" name="team2"  />
	<a href="javascript:add_team(2,'team2');">Добавить во 2 раунд</a>
</p> 

<table>
<tr>
<td></td>
<td>Родительская гр.</td>
<td>Гр.</td>
</tr>
{foreach from=$aTeams_second item=oTeamint name=el2}
<tr>
	<td>{$oTeamint->getTeam()->getName()}</td>
	<td>
		<select class="w200" id="p_{$oTeamint->getTeamId()}" onchange="saveparentgroup('p_{$oTeamint->getTeamId()}', {$oTeamint->getTeamId()}, {$oTeamint->getRoundId()});"> 
			{foreach from=$aGroups item=oGroup}
				<option value="{$oGroup->getGroupId()}" {if $oTeamint->getParentgroupId()==$oGroup->getGroupId()}SELECTED{/if}>{$oGroup->getName()}</option>
			{/foreach}
		</select>
	</td>
	<td>
		<select class="w200" id ="g_{$oTeamint->getTeamId()}" onchange="savegroup('g_{$oTeamint->getTeamId()}', {$oTeamint->getTeamId()}, {$oTeamint->getRoundId()});"> 
			{foreach from=$aGroups item=oGroup}
				<option value="{$oGroup->getGroupId()}" {if $oTeamint->getGroupId()==$oGroup->getGroupId()}SELECTED{/if}>{$oGroup->getName()}</option>
			{/foreach}
		</select>	
	</td>
</tr>
{/foreach}
</table>
{/if}