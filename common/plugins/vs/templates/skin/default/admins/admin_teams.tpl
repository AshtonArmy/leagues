{literal}
<style> 

.widgetColumnL { 
    float: left;
    } 
.widgetColumnR { 
float: right; 
}

</style> 
{/literal}
{*}
<a href="#" id="block_stream_topic" onclick="lsAU.simple_toggle(this,'setteams', {literal}{{/literal} tournament: {$Tournament}, league:'1' {literal}}{/literal}); return false;">Команды нхл</a>
<br/>
<a href="#" id="block_stream_topic" onclick="lsAU.simple_toggle(this,'createstattable', {literal}{{/literal} tournament: {$Tournament} {literal}}{/literal}); return false;">Создать турнирку</a>
<br/>
<a href="#" id="block_stream_topic" onclick="lsAU.simple_toggle(this,'createshedule', {literal}{{/literal} tournament: {$Tournament} {literal}}{/literal}); return false;">Создать расписание</a>
{*}
<br/>
<p> 
	<input type="text" class="input-wide autocomplete-users" id="user" name="user"  />
	<a href="javascript:add_player();">Добавить игрока</a>
</p> 
<div class="widgetColumnL span8">
{if $aObjects}
<input type="hidden" value="0" id="secret" />
<small>
<table id="allusers" class="table table-striped table-hover">
<thead>
<tr>
	<th >$</th>
	<th >Логин</th>
	<th >Псн</th>	
	<th >Время</th>
	<th >Хот.</th>
	<th >Команда</th>
	
</tr>
</thead>
{foreach from=$aObjects item=oObject name=el2}
{assign var=oUser value=$oObject.user}
{assign var=oPlayertournament value=$oObject.playertournament}
<tr height="20">
<td>{$oObject.vznos}</td>
<td>
<a class="authors" target="_blank" href="http://virtualsports.ru/profile/{$oUser->getLogin()}/">{$oUser->getLogin()}</a></td>
<td>{$oPlayertournament->getPsnid()}</td>
<td>{$oPlayertournament->getDates()}</td>
<td align="center"><a href="javascript:get_zayavki('{$oPlayertournament->getTournamentId()}','{$oPlayertournament->getUserId()}');">>>>></a></td>
<td>
{if $oPlayertournament->getTeam()}
{assign var=oTeam value=$oPlayertournament->getTeam()}
<img height="20" src="http://virtualsports.ru/images/teams/small/{$oTeam->getLogo()}"> 
{$oTeam->getBrief()} <a href="javascript:delete_team('{$oPlayertournament->getTournamentId()}','{$oPlayertournament->getUserId()}','{$oTeam->getTeamId()}');">забрать</a> <a href="javascript:get_change('{$oPlayertournament->getTournamentId()}','{$oPlayertournament->getUserId()}');"><-></a>
{/if}
{if $oObject.team}
{assign var=oTeam value=$oObject.team}
<img height="20" src="http://virtualsports.ru/images/teams/small/{$oTeam->getLogo()}"> 
{$oTeam->getBrief()} <a href="javascript:delete_team('{$oPlayertournament->getTournamentId()}','{$oPlayertournament->getUserId()}','{$oTeam->getTeamId()}');">забрать</a> <a href="javascript:get_change('{$oPlayertournament->getTournamentId()}','{$oPlayertournament->getUserId()}');"><-></a>
{/if}
</td>
</tr>
{/foreach}
</table>
</small>
{/if}
<br/> 
<a href="javascript:delete_alone_teams();">удалить команды без хозяев</a>
</div>

<div class="widgetColumnR span3" id="zayavka">
выберите пользователя
</div>

