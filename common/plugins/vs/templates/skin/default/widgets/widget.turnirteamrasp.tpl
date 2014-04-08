<div class="block">

    <header class="block-header sep">
        <h3>Calendar</h3>
    </header>

    <div class="block-content">
        <div style="padding: 0!important;">

        {if $dates_array}
				<table cellpadding="0" cellspacing="0" class="calendar">
                    <thead>
                        <tr>
                            <th colspan="7">
                                <script language="JavaScript" type="text/javascript">
                                    var month_num={$month};
                                </script>
                                <a class="left" onclick="change_month( {$tournament_id}, {$month-1}, {$year},{$myteam}); return false;"><</a>
                                <a class="right" onclick="change_month( {$tournament_id}, {$month+1}, {$year},{$myteam}); return false;">></a>
                                <span>
                                    {if $month==1}January{/if}
                                    {if $month==2}February{/if}
                                    {if $month==3}March{/if}
                                    {if $month==4}April{/if}
                                    {if $month==5}May{/if}
                                    {if $month==6}June{/if}
                                    {if $month==7}July{/if}
                                    {if $month==8}August{/if}
                                    {if $month==9}September{/if}
                                    {if $month==10}October{/if}
                                    {if $month==11}November{/if}
                                    {if $month==12}December{/if}
                                </span>
                            </th>
                        </tr>
                    </thead>

				<tr class="calendar-row">
					<td class="calendar-day-head">Mo</td>
					<td class="calendar-day-head">Tu</td>
					<td class="calendar-day-head">We</td>
					<td class="calendar-day-head">Th</td>
					<td class="calendar-day-head">Fr</td>
					<td class="calendar-day-head">Sa</td>
					<td class="calendar-day-head">Su</td>
				</tr>
				{foreach from=$dates_array item=oWeek name=el2}
				<tr class="calendar-row">
					{foreach from=$oWeek item=oDay name=el2}
					{if $oDay.day==0}
						<td class="calendar-day-np">&nbsp;</td>
					{else}
					<td class="calendar-day{if $oDay.css}{$oDay.css}{/if}">
						<div class="day-number">
							<a href="javascript:return false;" class="{if isset($oDay.logo)}monthcalendar{else}no_match{/if}" {if isset($oDay.logo)}style="background-image: url(http://virtualsports.ru/images/teams/small/{$oDay.logo});background-size: 20px 20px;"{/if}>{$oDay.day}</a>
							{if $oDay.played==1}
								<span class="raspisanie_score">{$oDay.g_c}{* {$oDay.status} {$oDay.goals_away}-{$oDay.goals_home} {if $oDay.so==1}SO{/if}{if $oDay.ot==1}OT{/if}{if $oDay.teh==1}тех{/if}*}</span>
							{/if}
						</div>
					</td>
					{/if}
					{/foreach}	
				</tr>
				{/foreach}
				</table>
				<table class="calendar-legend">
					<tr>
						<td width="50"></td>
						<td width="25">
							<div class="homeGradient"></div> 
						</td>
						<td> 
							<div class="">Home</div>
						</td>
						<td width="25">
							<div class="awayGradient"></div>
						</td>
						<td> 
							<div class="">Away</div>
						</td>
						<td width="50"></td>
					</tr>
				</table>

				{/if}

        </div>
    </div>
</div>