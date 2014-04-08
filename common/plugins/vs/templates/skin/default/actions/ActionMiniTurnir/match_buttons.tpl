{assign var=HomeUser value=$oMatch->getHomeuser()}
{assign var=AwayUser value=$oMatch->getAwayuser()}
<div class="dropdown-slider" style="display: none;">
{if $oMatch->getPlayed()==1}
	<a class="ddm" href="javascript:result_otchet({$oMatch->getMatchId()});"><span class="icon icon137"></span><span class="label">Game report</span></a>
{/if}
{if $oMatch->getPlayed()==0 && $userid!=0} 
	{if $userid==$oMatch->getAwayPlayer() && $oMatch->getAwayInsert()==0} 
		{*<a class="ddm" href="{$link_match}{$oMatch->getMatchId()}"><span class="icon icon47"></span><span class="label">Suggest time</span></a>*}
		<a class="ddm" href="javascript:result_insert_user({$oMatch->getMatchId()},{$userid});"><span class="icon icon185"></span><span class="label">Submit result</span></a>
	{/if}
	{if $userid==$oMatch->getHomePlayer() && $oMatch->getHomeInsert()==0}
		{*<a class="ddm" href="{$link_match}{$oMatch->getMatchId()}"><span class="icon icon47"></span><span class="label">Suggest time</span></a>*}
		<a class="ddm" href="javascript:result_insert_user({$oMatch->getMatchId()},{$userid});"><span class="icon icon185"></span><span class="label">Submit result</span></a>
	{/if}
{/if}
{if $isAdmin==1 && 1==0}
	
	{if $oMatch->getAwayInsert()==0}
		<a class="ddm" href="javascript:result_edit({$oMatch->getMatchId()},{$oMatch->getAway()});"><span class="icon icon185"></span><span class="label">Submit {$AwayUser->getLogin()}</span></a>
	{else}
		<a class="ddm" href="javascript:result_edit({$oMatch->getMatchId()},{$oMatch->getAway()});"><span class="icon icon145"></span><span class="label">Edit {$AwayUser->getLogin()}</span></a>
		<a class="ddm" href="javascript:result_team_delete({$oMatch->getMatchId()},{$oMatch->getAway()});"><span class="icon icon58"></span><span class="label">Delete {$AwayUser->getLogin()}</span></a>
	{/if}
	{if $oMatch->getHomeInsert()==0}
		<a class="ddm" href="javascript:result_edit({$oMatch->getMatchId()},{$oMatch->getHome()});"><span class="icon icon185"></span><span class="label">Submit {$HomeUser->getLogin()}</span></a>
	{else}
		<a class="ddm" href="javascript:result_edit({$oMatch->getMatchId()},{$oMatch->getHome()});"><span class="icon icon145"></span><span class="label">Edit {$HomeUser->getLogin()}</span></a>
		<a class="ddm" href="javascript:result_team_delete({$oMatch->getMatchId()},{$oMatch->getHome()});"><span class="icon icon58"></span><span class="label">Delete {$HomeUser->getLogin()}</span></a>
	{/if}
		{*<a class="ddm" href="{$link_match}{$oMatch->getMatchId()}" target="_blank"><span class="icon icon47"></span><span class="label">Time suggestion history </span></a>*}
		{*<a class="ddm" href="javascript:match_lookup({$oMatch->getMatchId()});"><span class="icon icon47"></span><span class="label">Time suggestion history</span></a>*}
	{if $oMatch->getPlayed()==1}			
		<a class="ddm" href="javascript:result_anul({$oMatch->getMatchId()});"><span class="icon icon58"></span><span class="label">Delete result</span></a>
		<a class="ddm" href="javascript:result_anul_without_pred({$oMatch->getMatchId()});"><span class="icon icon58"></span><span class="label">Delete result (keep warnings)</span></a>
	{/if}
	{*
	{if $oMatch->getAwayInsert()==0 && $oMatch->getHomeInsert()==0}
		<a class="ddm" href="javascript:match_prolong({$oMatch->getMatchId()});"><span class="icon icon189"></span><span class="label">Prolong result</span></a>
	{/if}
	*}
{/if}
{*	<a class="ddm" href="#"><span class="label">Lock</span></a>
	<a class="ddm" href="#"><span class="icon icon123"></span><span class="label">Unlock</span></a>
*}
</div>