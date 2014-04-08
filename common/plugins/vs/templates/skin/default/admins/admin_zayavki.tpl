<small><div align="center"><b>{$oUser->getLogin()}</b></div>

<table class="table table-striped table-hover">
{if $aZayvki}
{foreach from=$aZayvki item=oZayvka name=el2}
{assign var=oTeam value=$oZayvka->getTeam()}
{assign var=zanyato value=0}
{assign var=users value=$oZayvka->getUserId()}
{if $oTeam}
<tr>
	<td><img height="20" src="http://virtualsports.ru/images/teams/small/{$oTeam->getLogo()}">
	</td>
	<td>
{foreach from=$aTeams item=oTeams name=el2}
{if $oTeams.team_id==$oTeam->getTeamId()}
{assign var=zanyato value=1}
{/if}
{/foreach}
{$oZayvka->getPrioritet()} {$oTeam->getName()}{if $zanyato==0} <a href="javascript:set_team('{$oZayvka->getTournamentId()}','{$oZayvka->getUserId()}','{$oZayvka->getTeamId()}');">назначить</a>{else} <b>занята</b> {/if}
	</td>
</tr>
{/if}
{/foreach}
{/if}
{if $allTeams}
<tr>
	<td colspan="2" align="center"><b>свободные команды</b>
	</td>
</tr>
{foreach from=$allTeams item=oTeams name=el2}
{assign var=oTeam value=$oTeams->getTeam()}
{assign var=zanyato value=0}
{if $oTeam}
<tr>
	<td>
		<img height="20" src="http://virtualsports.ru/images/teams/small/{$oTeam->getLogo()}">
	</td>
	<td>
		{$oTeam->getName()}{if $zanyato==0} <a href="javascript:set_team('{$oTeams->getTournamentId()}','{$oUser->getUserId()}','{$oTeams->getTeamId()}');">назначить</a>{else} <b>занята</b> {/if}
	</td>
</tr>
{/if}
{/foreach}
{/if}

</table>
</small>

