{assign var=HomeTeam value=$oMatch->getHometeam()}
{assign var=AwayTeam value=$oMatch->getAwayteam()}
{if $oMatch->getPlayed()==1}	
	{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
		<li><a class="ddm" href="{$oTournament->getUrlFull()}match_comment/{$oMatch->getMatchId()}">{$aLang.plugin.vs.commentsg}</a></li>
		<li><a class="ddm" href="javascript:result_otchet({$oMatch->getMatchId()});">{$aLang.plugin.vs.game_report}</a></li>
	{else}	
		<li><a class="ddm" href="{$oTournament->getUrlFull()}match_comment/{$oMatch->getMatchId()}">{$aLang.plugin.vs.game_report}</a></li>
	{/if}
{/if}
{if $oMatch->getPlayed()==0 && $myteam!=0}
	{if $myteam==$oMatch->getAway() && $oMatch->getAwayInsert()==0} 
		<li><a class="ddm" href="{$oTournament->getUrlFull()}match/{$oMatch->getMatchId()}">{$aLang.plugin.vs.suggest_time}</a></li>
		{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
			<li><a class="ddm" href="javascript:result_insert({$oMatch->getMatchId()},{$myteam},0);">{$aLang.plugin.vs.submit_result}</a></li>
		{else}	
			<li><a class="ddm" href="{$oTournament->getUrlFull()}match_insert/{$oMatch->getMatchId()}">{$aLang.plugin.vs.submit_result}</a></li>
		{/if}
	{/if}
	{if $myteam==$oMatch->getHome() && $oMatch->getHomeInsert()==0}
		<li><a class="ddm" href="{$oTournament->getUrlFull()}match/{$oMatch->getMatchId()}">{$aLang.plugin.vs.suggest_time}</a>
		{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
			<li><a class="ddm" href="javascript:result_insert({$oMatch->getMatchId()},{$myteam},0);">{$aLang.plugin.vs.submit_result}</a></li>
		{else}	
			<li><a class="ddm" href="{$oTournament->getUrlFull()}match_insert/{$oMatch->getMatchId()}">{$aLang.plugin.vs.submit_result}</a></li>
		{/if}
	{/if}
{/if}
{if $myteam==$oMatch->getAway() || $isAdmin || $myteam==$oMatch->getHome()}
	<li><a class="ddm" href="javascript:result_insertvideo({$oMatch->getMatchId()});">{$aLang.plugin.vs.add_video}</a></li>
{/if}
{if $isAdmin==1}	
	{if $oMatch->getAwayInsert()==0}		
		{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
			<li><a class="ddm" href="javascript:result_edit({$oMatch->getMatchId()},{$oMatch->getAway()});">{$aLang.plugin.vs.submit} {$AwayTeam->getName()}</a></li>
		{else}	
			<li><a class="ddm" href="{$oTournament->getUrlFull()}match_insert/{$oMatch->getMatchId()}/{$oMatch->getAway()}">{$aLang.plugin.vs.submit} {$AwayTeam->getName()}</a></li>
		{/if}
	{else}
		{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
			<li><a class="ddm" href="javascript:result_edit({$oMatch->getMatchId()},{$oMatch->getAway()});">{$aLang.plugin.vs.edit} {$AwayTeam->getName()}</a></li>
		{else}	
			<li><a class="ddm" href="{$oTournament->getUrlFull()}match_insert/{$oMatch->getMatchId()}/{$oMatch->getAway()}">{$aLang.plugin.vs.edit} {$AwayTeam->getName()}</a></li>
		{/if}
		<li><a class="ddm" href="javascript:result_team_delete({$oMatch->getMatchId()},{$oMatch->getAway()});">{$aLang.plugin.vs.delete} {$AwayTeam->getName()}</a></li>
	{/if}
	{if $oMatch->getHomeInsert()==0}
		{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
			<li><a class="ddm" href="javascript:result_edit({$oMatch->getMatchId()},{$oMatch->getHome()});">{$aLang.plugin.vs.submit} {$HomeTeam->getName()}</a></li>
		{else}	
			<li><a class="ddm" href="{$oTournament->getUrlFull()}match_insert/{$oMatch->getMatchId()}/{$oMatch->getHome()}">{$aLang.plugin.vs.submit} {$HomeTeam->getName()}</a></li>
		{/if}
	{else}
		{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
			<li><a class="ddm" href="javascript:result_edit({$oMatch->getMatchId()},{$oMatch->getHome()});">{$aLang.plugin.vs.edit} {$HomeTeam->getName()}</a></li>
		{else}	
			<li><a class="ddm" href="{$oTournament->getUrlFull()}match_insert/{$oMatch->getMatchId()}/{$oMatch->getHome()}">{$aLang.plugin.vs.edit} {$HomeTeam->getName()}</a></li>
		{/if}		
		<li><a class="ddm" href="javascript:result_team_delete({$oMatch->getMatchId()},{$oMatch->getHome()});">{$aLang.plugin.vs.delete} {$HomeTeam->getName()}</a></li>
	{/if}
		<li><a class="ddm" href="javascript:match_lookup({$oMatch->getMatchId()});">{$aLang.plugin.vs.timelog}</a></li>
	{if $oMatch->getPlayed()==1}			
		<li><a class="ddm" href="javascript:result_anul({$oMatch->getMatchId()});">{$aLang.plugin.vs.delete_result}</a></li>
		<li><a class="ddm" href="javascript:result_anul_without_pred({$oMatch->getMatchId()});">{$aLang.plugin.vs.delete_result_keep}</a></li>
	{/if}
	
	{if $oMatch->getAwayInsert()==0 && $oMatch->getHomeInsert()==0}
		<li><a class="ddm" href="javascript:match_prolong({$oMatch->getMatchId()});">{$aLang.plugin.vs.prolong_game}</a></li>
	{/if}
		<li><a class="ddm" href="javascript:match_perenos({$oMatch->getMatchId()}, {$oMatch->getDates()|date_format:"%Y,%m,%d,%k,%M"});">{$aLang.plugin.vs.redate_game}</a></li>
	
{/if}
{*{assign var=HomeTeam value=$oMatch->getHometeam()}
{assign var=AwayTeam value=$oMatch->getAwayteam()}
<div class="dropdown-slider" style="display: none;"> 
{if $oMatch->getPlayed()==1}	
	{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
		<a class="ddm" href="{$link_turnir}/_match_comment/{$oMatch->getMatchId()}"><span class="icon icon137"><span class="label">{$aLang.plugin.vs.commentsg}</a>
		<a class="ddm" href="javascript:result_otchet({$oMatch->getMatchId()});"><span class="icon icon137"><span class="label">{$aLang.plugin.vs.game_report}</a>
	{else}	
		<a class="ddm" href="{$link_turnir}/_match_comment/{$oMatch->getMatchId()}"><span class="icon icon137"><span class="label">{$aLang.plugin.vs.game_report}</a>
	{/if}
{/if}
{if $oMatch->getPlayed()==0 && $myteam!=0}
	{if $myteam==$oMatch->getAway() && $oMatch->getAwayInsert()==0} 
		<a class="ddm" href="{$link_match}{$oMatch->getMatchId()}"><span class="icon icon47"><span class="label">{$aLang.plugin.vs.suggest_time}</a>
		{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
			<a class="ddm" href="javascript:result_insert({$oMatch->getMatchId()},{$myteam},0);"><span class="icon icon185"><span class="label">{$aLang.plugin.vs.submit_result}</a>
		{else}	
			<a class="ddm" href="{$link_match_insert}{$oMatch->getMatchId()}"><span class="icon icon185"><span class="label">{$aLang.plugin.vs.submit_result}</a>
		{/if}
	{/if}
	{if $myteam==$oMatch->getHome() && $oMatch->getHomeInsert()==0}
		<a class="ddm" href="{$link_match}{$oMatch->getMatchId()}"><span class="icon icon47"><span class="label">{$aLang.plugin.vs.suggest_time}</a>
		{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
			<a class="ddm" href="javascript:result_insert({$oMatch->getMatchId()},{$myteam},0);"><span class="icon icon185"><span class="label">{$aLang.plugin.vs.submit_result}</a>
		{else}	
			<a class="ddm" href="{$link_match_insert}{$oMatch->getMatchId()}"><span class="icon icon185"><span class="label">{$aLang.plugin.vs.submit_result}</a>
		{/if}
	{/if}
{/if}
{if $myteam==$oMatch->getAway() || $isAdmin || $myteam==$oMatch->getHome()}
	<a class="ddm" href="javascript:result_insertvideo({$oMatch->getMatchId()});"><span class="icon icon149"><span class="label">{$aLang.plugin.vs.add_video}</a>
{/if}		
{if $isAdmin==1}	
	{if $oMatch->getAwayInsert()==0}		
		{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
			<a class="ddm" href="javascript:result_edit({$oMatch->getMatchId()},{$oMatch->getAway()});"><span class="icon icon185"><span class="label">{$aLang.plugin.vs.submit} {$AwayTeam->getName()}</a>
		{else}	
			<a class="ddm" href="{$link_turnir}/_match_insert/{$oMatch->getMatchId()}/{$oMatch->getAway()}"><span class="icon icon185"><span class="label">{$aLang.plugin.vs.submit} {$AwayTeam->getName()}</a>
		{/if}
	{else}
		{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
			<a class="ddm" href="javascript:result_edit({$oMatch->getMatchId()},{$oMatch->getAway()});"><span class="icon icon145"><span class="label">{$aLang.plugin.vs.edit} {$AwayTeam->getName()}</a>
		{else}	
			<a class="ddm" href="{$link_turnir}/_match_insert/{$oMatch->getMatchId()}/{$oMatch->getAway()}"><span class="icon icon145"><span class="label">{$aLang.plugin.vs.edit} {$AwayTeam->getName()}</a>
		{/if}
		<a class="ddm" href="javascript:result_team_delete({$oMatch->getMatchId()},{$oMatch->getAway()});"><span class="icon icon58"><span class="label">{$aLang.plugin.vs.delete} {$AwayTeam->getName()}</a>
	{/if}
	{if $oMatch->getHomeInsert()==0}
		{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
			<a class="ddm" href="javascript:result_edit({$oMatch->getMatchId()},{$oMatch->getHome()});"><span class="icon icon185"><span class="label">{$aLang.plugin.vs.submit} {$HomeTeam->getName()}</a>
		{else}	
			<a class="ddm" href="{$link_turnir}/_match_insert/{$oMatch->getMatchId()}/{$oMatch->getHome()}"><span class="icon icon185"><span class="label">{$aLang.plugin.vs.submit} {$HomeTeam->getName()}</a>
		{/if}
	{else}
		{if $oMatch->getGametypeId()!=3 && $oMatch->getGametypeId()!=7}
			<a class="ddm" href="javascript:result_edit({$oMatch->getMatchId()},{$oMatch->getHome()});"><span class="icon icon145"><span class="label">{$aLang.plugin.vs.edit} {$HomeTeam->getName()}</a>
		{else}	
			<a class="ddm" href="{$link_turnir}/_match_insert/{$oMatch->getMatchId()}/{$oMatch->getHome()}"><span class="icon icon145"><span class="label">{$aLang.plugin.vs.edit} {$HomeTeam->getName()}</a>
		{/if}		
		<a class="ddm" href="javascript:result_team_delete({$oMatch->getMatchId()},{$oMatch->getHome()});"><span class="icon icon58"><span class="label">{$aLang.plugin.vs.delete} {$HomeTeam->getName()}</a>
	{/if}
		<a class="ddm" href="javascript:match_lookup({$oMatch->getMatchId()});"><span class="icon icon47"><span class="label">{$aLang.plugin.vs.timelog}</a>
	{if $oMatch->getPlayed()==1}			
		<a class="ddm" href="javascript:result_anul({$oMatch->getMatchId()});"><span class="icon icon58"><span class="label">{$aLang.plugin.vs.delete_result}</a>
		<a class="ddm" href="javascript:result_anul_without_pred({$oMatch->getMatchId()});"><span class="icon icon58"><span class="label">{$aLang.plugin.vs.delete_result_keep}</a>
	{/if}
	
	{if $oMatch->getAwayInsert()==0 && $oMatch->getHomeInsert()==0}
		<a class="ddm" href="javascript:match_prolong({$oMatch->getMatchId()});"><span class="icon icon189"><span class="label">{$aLang.plugin.vs.prolong_game}</a>
	{/if}
		<a class="ddm" href="javascript:match_perenos({$oMatch->getMatchId()}, {$oMatch->getDates()|date_format:"%Y,%m,%d,%k,%M"});"><span class="icon icon189"><span class="label">{$aLang.plugin.vs.redate_game}</a>
	
{/if}

</div>*}