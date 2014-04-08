<div class="block">

    <header class="block-header sep">
        <h3><a class="links_head" href="{if $oTournament}{$oTournament->getUrlFull()}events/{/if}">Last played</a></h3>
    </header>
	<small>
	<table width="100%" cellspacing="0" class="table">
		<thead>
	<tr>
		<th class="lside">Date</th>		
		<th class="cside" align="center">№</th>
		<th class="cside">Away</th>
		<th class="cside">Home</th>
		<th class="cside" align="center">Score</th>
		<th class="cside" align="center">Report</th>
	</tr>
	</thead>
	<tbody>
	{foreach from=$Indexmatches item=oStreamEvent}
	{assign var=oTarget value=$oStreamEvent->getWhat()}
	{assign var=oTournament value=$oTarget->getTournament()}
	{assign var=oAwayTeam value=$oTarget->getAwayteam()}
	{assign var=oHomeTeam value=$oTarget->getHometeam()}
	{*{assign var=oAwayUser value=$oTarget->getAwayuser()}*}
	{*{assign var=oHomeUser value=$oTarget->getHomeuser()}*}
	<tr>	
		<td align="center">{date_format date=$oStreamEvent->getDateAdd() format="d M"}</td>
		<td class="{$className}"  align="center">{$oTarget->getNumber()}</td>
		<td class="{$className}" >
			<img style="height:32px;width:32px;" src="{cfg name='path.root.web'}/images/teams/small/{$oStreamEvent->getAwayLogo()}" title="{$oStreamEvent->getAwayName()}" /> </td>
		<td class="{$className}" >
			<img style="height:32px;width:32px;" src="{cfg name='path.root.web'}/images/teams/small/{$oStreamEvent->getHomeLogo()}" title="{$oStreamEvent->getHomeName()}" /> </td>
		<td class="{$className}" align="center">{$oTarget->getGoalsAway()} - {$oTarget->getGoalsHome()} {if $oTarget->getSo()==1} SO{/if}{if $oTarget->getOt()==1} ОТ{/if}{if $oTarget->getTeh()==1} тех.{/if} </td>
		<td><a title="Match comments №{$oTarget->getNumber()} tournament {$oStreamEvent->getTournamentName()}({$oTarget->getCountComment()})" href="{$oTournament->getUrlFull()}match_comment/{$oTarget->getMatchId()}/" target="_blank" ><span class="badge badge-custom-comments ">{$oTarget->getCountComment()}</span></a></td>
	</tr>	
	{/foreach}
	</tbody>
	</table>
	</small>
</div>
	{*<section class="block" id="matches-block">
{if count($Indexmatches)}
    <ul class="match-list" data-jcarousel="true" data-wrap="circular">
        {foreach from=$Indexmatches item=oStreamEvent}
            {assign var=oTarget value=$oStreamEvent->getWhat()}
            {assign var=oBlogs value=$oTarget->getBlog()}
            <li class="stream-item-type-{$oStreamEvent->getEventType()}" title="Матч №{$oTarget->getNumber()}, {date_format date=$oStreamEvent->getDateAdd()}">
                <div class="wraps">
                {if $oStreamEvent->getEventType()=="match_played"}
					{if $oTarget->getOt()==1 || $oTarget->getSo()==1 || $oTarget->getTeh()==1}
						<div class="info">{if $oTarget->getSo()==1} SO{/if}{if $oTarget->getOt()==1} ОТ{/if}{if $oTarget->getTeh()==1} тех.{/if}</div>
                    {/if}
					<ul class="colums">
                        <li class="away">
                            <img src="{cfg name='path.root.web'}/images/teams/small/{$oStreamEvent->getAwayLogo()}" title="{$oStreamEvent->getAwayName()}" />
                        </li>
                        <li class="score">
                            <span class="count"><strong>{$oTarget->getGoalsAway()}</strong><strong>{$oTarget->getGoalsHome()}</strong></span>
                        </li>
                        <li class="home">
                            <img src="{cfg name='path.root.web'}/images/teams/small/{$oStreamEvent->getHomeLogo()}" title="{$oStreamEvent->getHomeName()}" />
                        </li>
                    </ul>

                    <div class="blog-link">
                        {if $oBlogs}
                            <a title="Обсуждение матча №{$oTarget->getNumber()} турнира {$oStreamEvent->getTournamentName()}({$oTarget->getCountComment()})" href="{$oBlogs->getUrlFull()}turnir/{$oStreamEvent->getTournamentUrl()}/_match_comment/{$oTarget->getMatchId()}" target="_blank" ><i></i></a>
                        {/if}
                    </div>
                {/if}
                </div>
            </li>
        {/foreach}
    </ul>
{else}
    Нет матчей
{/if}
</section>
*}