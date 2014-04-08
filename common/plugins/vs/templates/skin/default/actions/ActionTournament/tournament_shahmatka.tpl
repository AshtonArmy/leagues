{include file='header.tpl' menu_content='tournament' noSidebar=true }

{*<br/>
<a href="{$link_stats}#tour-menu">Перейти к турниру</a>
<br/><br/>*}
<small> 
{if $groups}
{foreach from=$groups item=group name=el2}
	{if $aGroups}
		{assign var=oGroup value=$aGroups.$group} 
		<h3>{$oGroup->getName()}</h3>
	{/if}
	<table  class="table table-striped table-bordered table-hover">
		<tr>
			<td width="32"></td>
			{foreach from=$teams.$group item=team} 
				<td><img style="height:32px;width:32px;" title="{$team.name}" src="{cfg name='path.root.web'}/images/teams/small/{$team.logo}"/></td>
			{/foreach}
		</tr>
	{foreach from=$teams.$group key=num_home item=i}
		{assign var=team_home_id value=$teams.$group[$num_home].team_id} 
		<tr>
			<td><img style="height:32px;width:32px;" title="{$teams.$group[$num_home].name}" src="{cfg name='path.root.web'}/images/teams/small/{$teams.$group[$num_home].logo}"/></td> 
			{foreach from=$teams.$group key=num_away item=i} 
				{assign var=team_away_id value=$teams.$group[$num_away].team_id} 
				<td style="vertical-align:top;{if $num_away==$num_home} background-color: #ccc;{/if}">  
				{if is_array($wins.$group[$team_home_id][$team_away_id])}
					{foreach from=$wins.$group[$team_home_id][$team_away_id] item=result}
						{$result}</br>
					{/foreach}
				{else}{/if}
				{if is_array($loses.$group[$team_home_id][$team_away_id])}
					{foreach from=$loses.$group[$team_home_id][$team_away_id] item=result}
						{$result}</br>
					{/foreach}
				{else}{/if} 
				</td>
			{/foreach}
		</tr>
	{/foreach}
	</table>
	<br/>
{/foreach} 
{/if}
</small>
{include file='footer.tpl'}