{if $superadmin}
<a href="#" id="" onclick="ls.au.simple_toggles(this,'createshedule', {literal}{{/literal} tournament: {$oTournament->getTournamentId()} {literal}}{/literal}); return false;">Создать расписание</a>
<br/>
<a href="#" id="" onclick="ls.au.simple_toggles(this,'deleteshedule', {literal}{{/literal} tournament: {$oTournament->getTournamentId()} {literal}}{/literal}); return false;">Удалить расписание</a>
{/if}