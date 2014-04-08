{include file='header.tpl' noSidebar=true}
{*
<form action="" method="POST" id="form-users-search" onsubmit="return false;">
	<input type="text" placeholder="{$aLang.user_search_title_hint}" autocomplete="off" name="user_login" value="" onkeyup="ls.timer.run(ls.user.searchUsers,'users_search',['form-users-search'],1000);">
</form>
*}

{assign var=Team value='1'}
{if $aPlayercard} 
<h3 class="header smaller lighter blue">Teamplay players</h3>

<table id="sample-table-2" class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			{*<th width="50"></th>*}
			<th>Num</th>
			<th width="170">{if $oPlayercard.team_name!=''}<a href="{router page='team'}{$oPlayercard.team_id}" class="teamrasp" style="color:white;"><b>{$oPlayercard.team_name}</b></a>{else}Игрок{/if}</th>
			<th width="130">User</th>
			<th>Plat.</th>
			<th>Team</th>
			<th>Team</th>
			<th>LW</th>
			<th>C</th>
			<th>RW</th>
			<th>LD</th>
			<th>RD</th>
			<th>G</th>
			<th>Город</th>
			<th>Уд. время</th>
		</tr>
</thead>
{foreach from=$aPlayercard item=oPlayercard} 
{assign var=team_id value=$oPlayercard.team_id}
{assign var=oTeam value=$aTeams.$team_id}
 <tr>
	{*<td class="avatars"><a href="{router page='profile'}{$oPlayercard.user_login}">{if $oPlayercard.user_profile_avatar}<img class="rounded" src="{$oPlayercard.user_profile_avatar}" alt="" class="avatar" />{/if}</a></td>
	*}<td >{$oPlayercard.number}</td>
	<td ><a href="{router page='profile'}{$oPlayercard.user_login}/teamplay/" class="username">{$oPlayercard.family} {$oPlayercard.name}</a></td>
	<td ><a href="{router page='profile'}{$oPlayercard.user_login}" class="username">{$oPlayercard.user_login}</a></td>
	<td>{$oPlayercard.platform_brief}</td>
	<td >{if $oPlayercard.team_id>0}<a href="{$oTeam->getUrlFull()}" title="{$oTeam->getName()}">{if $oTeam->getLogo()}<img style="height:20px;" src="{cfg name='path.root.web'}/images/teams/teamplay/{$oTeam->getLogo()}" alt="{$oTeam->getName()}"/>{/if}</a>{/if}</td>
	<td >{if $oPlayercard.team_id>0}<a href="{$oTeam->getUrlFull()}" title="{$oTeam->getName()}">{$oTeam->getBrief()}</a>{/if}</td>
	<td class="al_c w_25">{if $oPlayercard.lw==1}LW{/if}</td>
	<td class="al_c w_25">{if $oPlayercard.c==1}C{/if}</td>
	<td class="al_c w_25">{if $oPlayercard.rw==1}RW{/if}</td>
	<td class="al_c w_25">{if $oPlayercard.ld==1}LD{/if}</td>
	<td class="al_c w_25">{if $oPlayercard.rd==1}RD{/if}</td>
	<td class="al_c w_25">{if $oPlayercard.g==1}G{/if}</td>
	<td class="al_c">{$oPlayercard.user_profile_city}</td>
	<td class="al_c">{$oPlayercard.play_time}</td>
	 
</tr>

{/foreach}
{/if}

</table>


{literal}
<script src="http://virtualsports.ru/templates/skin/btch/themes/default/js/jquery.dataTables.min.js"></script>
<script src="http://virtualsports.ru/templates/skin/btch/themes/default/js/jquery.dataTables.bootstrap.js"></script>
<script type="text/javascript">
			jQuery(function($) {
				var oTable1 = $('#sample-table-2').dataTable({
					"iDisplayLength": 100
					});
			});
</script>
{/literal}
{include file='footer.tpl'}