{literal}
<style> 

.widgetColumnL {
    width: 70%;
    float: left;
    } 
.widgetColumnR {
width: 25%;
float: left;
padding-left: 15px;
}

</style> 
{/literal}

<br/>

<div class="widgetColumnL">
{if $aTeams}
<input type="hidden" value="0" id="secret" />
<table id="allusers" class="table table-striped table-hover">
<thead>
<tr>
	<th >Команда</th> 
	<th >Хотелка</th> 
	
</tr>
</thead>
{foreach from=$aTeams item=aTeam name=el2}
{assign var=oTeam value=$aTeam->getTeam()}
<tr height="20">
<td>{$oTeam->getName()}</td>
<td align="center"><a href="javascript:get_players('{$aTeam->getTournamentId()}');">>>>></a></td>

</tr>
{/foreach}
</table>
{/if}
<br/> 
</div>

<div class="widgetColumnR" id="zayavka">
выберите тиму
</div>

