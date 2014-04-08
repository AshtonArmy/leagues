{include file='header.tpl' menu='blog' noSidebar=true}
{*{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats="stats"}*}
<br/>
<a href="{$link_stats}#tour-menu">Перейти к турниру</a>
<br/><br/>
<div style="width:100%;overflow-x: auto; overflow-y: hidden; text-align:left;">
<table border=1 style="font-size: 8px;">
	<tr>
		<td width="32"></td>
		{foreach from=$teams item=team} 
			<td><img title="{$team.name}" src="{cfg name='path.root.web'}/images/teams/small/{$team.logo}"/></td>
		{/foreach}
	</tr>
{foreach from=$teams key=num_home item=i}
	{assign var=team_home_id value=$teams[$num_home].team_id} 
	<tr>
		<td><img title="{$teams[$num_home].name}" src="{cfg name='path.root.web'}/images/teams/small/{$teams[$num_home].logo}"/></td> 
		{foreach from=$teams key=num_away item=i} 
			{assign var=team_away_id value=$teams[$num_away].team_id} 
			<td style="vertical-align:top;{if $num_away==$num_home} background-color: #ccc;{/if}">  
			{if is_array($wins[$team_home_id][$team_away_id])}
				{foreach from=$wins[$team_home_id][$team_away_id] item=result}
					{$result}</br>
				{/foreach}
			{else}{/if}
			{if is_array($loses[$team_home_id][$team_away_id])}
				{foreach from=$loses[$team_home_id][$team_away_id] item=result}
					{$result}</br>
				{/foreach}
			{else}{/if} 
			</td>
		{/foreach}
	</tr>
{/foreach}
</table>
</div>
{include file='footer.tpl'}