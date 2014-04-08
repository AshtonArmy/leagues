{include file='header.tpl' menu_content='tournament'}

{assign var=oHome value=$oMatch->getHometeam()}
{assign var=oAway value=$oMatch->getAwayteam()}

<div id="match-com">

    {*Заголовок*}
    <h2>{$aLang.plugin.vs.game_report}</h2>

    {assign var="oAwayUser" value=$oMatch->getAwayuser()}
    {assign var="oHomeUser" value=$oMatch->getHomeuser()}
    {assign var="oAwayTeam" value=$oMatch->getAwayteam()}
    {assign var="oHomeTeam" value=$oMatch->getHometeam()}

    {*Номер матча и дата*}
    <div class="num-date">
        №{$oMatch->getNumber()} | {$oMatch->getDates()|date_format:"%e %B %Y"}
    </div>

    {*Счет и название коммант и лого*}
    <div class="name-logo-command">
        <ul class="commands">
            <li class="away">
                <span class="logo">
                  {if $oMatch->getGametypeId()==3}  <img style="height:54px;" src="http://img.virtualsports.ru/teams/{$oAway->getLogo()}">{else}<img style="height:54px;" src="http://img.virtualsports.ru/teams/{$oAway->getLogo()}">{/if}
                </span>
                <span class="name">{$oAway->getName()}</span>
            </li>
            <li class="home">
                <span class="name">{$oHome->getName()}</span>
                <span class="logo">
                    {if $oMatch->getGametypeId()==3}  <img style="height:54px;" src="http://img.virtualsports.ru/teams/{$oHome->getLogo()}">{else}<img style="height:54px;" src="http://img.virtualsports.ru/teams/{$oHome->getLogo()}">{/if}
                </span>
            </li>
        </ul>
        <div class="count-math">
            {if $oMatch->getPlayed()==1}
                <span class="count">{$oMatch->getGoalsAway()}</span>
                <span class="info">
                    {if $oMatch->getSo()==1}SO<br/>{/if}
                    {if $oMatch->getOt()==1}ОТ<br/>{/if}
                    {if $oMatch->getTeh()==1}тех.{/if}
                </span>
                <span class="count">{$oMatch->getGoalsHome()}</span>
            {/if}
        </div>
    </div>

{if $oMatch->getGametypeId()==3 || $oMatch->getGametypeId()==7}
    {*Ледовое поле*}
    <div class="icefield">
        {if $players && $oMatch->getPlayed()==1 && $oMatch->getGametypeId()==3  }

        {assign var="awayForm" value='los.png'}
        {assign var="homeForm" value='njd.png'}
        {if $oAwayTeam->getFormaField()!=''}{assign var="awayForm" value=$oAwayTeam->getFormaField()}{/if}
        {if $oHomeTeam->getFormaField()!=''}{assign var="homeForm" value=$oHomeTeam->getFormaField()}{/if}

        <link href='http://fonts.googleapis.com/css?family=Asap:700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>
        <div align="center">

        <div class="ice_players">
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;" ></div></td>
                <td><div style="position: absolute;">
                    <div class="in_margin">
                    <a class="link_player_field" player="{$players.away.lw.playercard_id}" href="{if $players.away.lw.user_login!='Bot'}{router page='profile'}{$players.away.lw.user_login}/{else}#{/if}">
                        <div class="tshirt_box"  style="background: url('http://img.virtualsports.ru/field/away/{$awayForm}') repeat scroll 0 0 transparent;">
                            <div class="family darkcol">{$players.away.lw.family|upper}</div>
                            <div class="number darkcol">{$players.away.lw.number}</div>
                        </div>
                    </a>
                    </div></div>
                </td>
                <td class="small_td"></td>
                <td><div style="position: absolute;">
                    <div class="in_margin">
                    <a class="link_player_field" player="{$players.home.rw.playercard_id}" href="{if $players.home.rw.user_login!='Bot'}{router page='profile'}{$players.home.rw.user_login}/{else}#{/if}">
                        <div class="tshirt_box"  style="background: url('http://img.virtualsports.ru/field/home/{$homeForm}') repeat scroll 0 0 transparent;">
                            <div class="family lightcol">{$players.home.rw.family|upper}</div>
                            <div class="number lightcol">{$players.home.rw.number}</div>
                        </div>
                    </a>
                    </div></div>
                </td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;" ></div></td>
            </tr>
            <tr>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;">
                    <div class="in_margin">
                    <a class="link_player_field" player="{$players.away.ld.playercard_id}" href="{if $players.away.ld.user_login!='Bot'}{router page='profile'}{$players.away.ld.user_login}/{else}#{/if}">
                        <div class="tshirt_box"  style="background: url('http://img.virtualsports.ru/field/away/{$awayForm}') repeat scroll 0 0 transparent;">
                            <div class="family darkcol">{$players.away.ld.family|upper}</div>
                            <div class="number darkcol">{$players.away.ld.number}</div>
                        </div>
                    </a>
                    </div>
                </div></td>
                <td><div style="position: absolute;" ></div></td>
                <td><div style="position: absolute;"></div></td>
                <td class="small_td"></td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;">
                    <div class="in_margin">
                    <a class="link_player_field" player="{$players.home.rd.playercard_id}" href="{if $players.home.rd.user_login!='Bot'}{router page='profile'}{$players.home.rd.user_login}/{else}#{/if}">
                        <div class="tshirt_box"  style="background: url('http://img.virtualsports.ru/field/home/{$homeForm}') repeat scroll 0 0 transparent;">
                            <div class="family lightcol">{$players.home.rd.family|upper}</div>
                            <div class="number lightcol">{$players.home.rd.number}</div>
                        </div>
                    </a>
                    </div>
                </div></td>
                <td><div style="position: absolute;" ></div></td>
            </tr>
        <tr></tr>
        <tr></tr>
            <tr>
                <td><div style="position: absolute;">
                    <div class="in_margin">
                    <a class="link_player_field" player="{$players.away.g.playercard_id}" href="{if $players.away.g.user_login!='Bot'}{router page='profile'}{$players.away.g.user_login}/{else}#{/if}">
                        <div class="tshirt_box"  style="background: url('http://img.virtualsports.ru/field/away/{$awayForm}') repeat scroll 0 0 transparent;">
                            <div class="family darkcol">{$players.away.g.family|upper}</div>
                            <div class="number darkcol">{$players.away.g.number}</div>
                        </div>
                    </a>
                    </div></div></td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;" >
                    <div class="in_margin">
                    <a class="link_player_field" player="{$players.away.c.playercard_id}" href="{if $players.away.c.user_login!='Bot'}{router page='profile'}{$players.away.c.user_login}/{else}#{/if}">
                        <div class="tshirt_box"  style="background: url('http://img.virtualsports.ru/field/away/{$awayForm}') repeat scroll 0 0 transparent;">
                            <div class="family darkcol">{$players.away.c.family|upper}</div>
                            <div class="number darkcol">{$players.away.c.number}</div>
                        </div>
                    </a>
                    </div></div></td>
                <td><div style="position: absolute;"></div></td>
                <td class="small_td"></td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;" >
                    <div class="in_margin">
                    <a class="link_player_field" player="{$players.home.c.playercard_id}" href="{if $players.home.c.user_login!='Bot'}{router page='profile'}{$players.home.c.user_login}/{else}#{/if}">
                        <div class="tshirt_box"  style="background: url('http://img.virtualsports.ru/field/home/{$homeForm}') repeat scroll 0 0 transparent;">
                            <div class="family lightcol">{$players.home.c.family|upper}</div>
                            <div class="number lightcol">{$players.home.c.number}</div>
                        </div>
                    </a>
                    </div></div></td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;">
                    <div class="in_margin">
                    <a class="link_player_field" player="{$players.home.g.playercard_id}" href="{if $players.home.g.user_login!='Bot'}{router page='profile'}{$players.home.g.user_login}/{else}#{/if}">
                        <div class="tshirt_box"  style="background: url('http://img.virtualsports.ru/field/home/{$homeForm}') repeat scroll 0 0 transparent;">
                            <div class="family lightcol">{$players.home.g.family|upper}</div>
                            <div class="number lightcol">{$players.home.g.number}</div>
                        </div>
                    </a>
                    </div></div></td>
            </tr>
        <tr></tr>
        <tr></tr>
            <tr>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;">
                    <div class="in_margin">
                    <a class="link_player_field" player="{$players.away.rd.playercard_id}" href="{if $players.away.rd.user_login!='Bot'}{router page='profile'}{$players.away.rd.user_login}/{else}#{/if}">
                        <div class="tshirt_box" style="background: url('http://img.virtualsports.ru/field/away/{$awayForm}') repeat scroll 0 0 transparent;">
                            <div class="family darkcol">{$players.away.rd.family|upper}</div>
                            <div class="number darkcol">{$players.away.rd.number}</div>
                        </div>
                    </a>
                    </div>
                </div></td>
                <td><div style="position: absolute;" ></div></td>
                <td><div style="position: absolute;"></div></td>
                <td class="small_td"></td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;">
                    <div class="in_margin">
                    <a class="link_player_field" player="{$players.home.ld.playercard_id}" href="{if $players.home.ld.user_login!='Bot'}{router page='profile'}{$players.home.ld.user_login}/{else}#{/if}">
                        <div class="tshirt_box"  style="background: url('http://img.virtualsports.ru/field/home/{$homeForm}') repeat scroll 0 0 transparent;">
                            <div class="family lightcol">{$players.home.ld.family|upper}</div>
                            <div class="number lightcol">{$players.home.ld.number}</div>
                        </div>
                    </a>
                    </div>
                </div></td>
                <td><div style="position: absolute;" ></div></td>
            </tr>
            <tr>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;" ></div></td>
                <td><div style="position: absolute;">
                    <div class="in_margin">
                    <a class="link_player_field" player="{$players.away.rw.playercard_id}" href="{if $players.away.rw.user_login!='Bot'}{router page='profile'}{$players.away.rw.user_login}/{else}#{/if}">
                        <div class="tshirt_box"  style="background: url('http://img.virtualsports.ru/field/away/{$awayForm}') repeat scroll 0 0 transparent;">
                            <div class="family darkcol">{$players.away.rw.family|upper}</div>
                            <div class="number darkcol">{$players.away.rw.number}</div>
                        </div>
                    </a>
                    </div></div></td>
                <td class="small_td"></td>
                <td><div style="position: absolute;">
                    <div class="in_margin">
                    <a class="link_player_field" player="{$players.home.lw.playercard_id}" href="{if $players.home.lw.user_login!='Bot'}{router page='profile'}{$players.home.lw.user_login}/{else}#{/if}">
                        <div class="tshirt_box"  style="background: url('http://img.virtualsports.ru/field/home/{$homeForm}') repeat scroll 0 0 transparent;">
                            <div class="family lightcol">{$players.home.lw.family|upper}</div>
                            <div class="number lightcol">{$players.home.lw.number}</div>
                        </div>
                    </a>
                    </div></div>
                </td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;"></div></td>
                <td><div style="position: absolute;" ></div></td>
            </tr>
        </table>
        </div>
        </div>

        <style>
            .ice_players {
                background: url("http://img.virtualsports.ru/field/ice.png") no-repeat scroll 0 0 transparent;
                height: 351px;
                width: 700px;
            }
            .ice_players tr {
                height: 29px;
            }
            .ice_players td .tshirt_box {

                height: 99px;
                margin-left: -25px;
                width: 120px;
            }
            .ice_players TD .tshirt_box .number {
                font-size: 32px;
                padding-top: 1px;
                text-align: center;
                font-family: 'Asap', sans-serif;
            }
            .ice_players TD .tshirt_box .family {
                font-size: 10px;
                padding-top: 15px;
                text-align: center;
                font-family: 'Oswald', sans-serif;
            }
            .lightcol {
            color: white;
            }
            .darkcol {
            color: black;
            }
            .ice_players TD {
                height: 29px;
                text-align: center;
                vertical-align: middle;
                width: 70px;
            }
            .ice_players TD.small_td {
                width: 22px;
            }
            .link_player_field {
            text-decoration:none;
            }
        </style>

        {/if}

    </div> <!-- /.icefield-->

    <div class="listin-and-starts">
    {*Листинг игры*}
    <div class="goal-listing">
        {if $aMatchgoal}
            <table class="raspisanie" width="100%">
            <tbody>
                {assign var=Period value=0}
                {assign var=homegoal value=0}
                {assign var=awaygoal value=0}
                {foreach from=$aMatchgoal item=oMatchgoal}

                    {assign var="oGoal" value=$oMatchgoal->getGoal()}
                    {assign var="oAssist" value=$oMatchgoal->getAssist()}
                    {assign var="oAssist2" value=$oMatchgoal->getAssist2()}

                    {if $aPlayer.$oGoal}{assign var="oUserGoal" value=$aPlayer.$oGoal->getUser()}{/if}
                    {if $aPlayer.$oAssist}{assign var="oUserAssist" value=$aPlayer.$oAssist->getUser()} {/if}
                    {if $aPlayer.$oAssist2}{assign var="oUserAssist2" value=$aPlayer.$oAssist2->getUser()} {/if}
                    {if $oMatch->getAway()==$oMatchgoal->getTeamId()}
                        {assign var=awaygoal value=$awaygoal+1}
                    {else}
                        {assign var=homegoal value=$homegoal+1}
                    {/if}

                    {if $Period!=$oMatchgoal->getPeriod()}
                        <tr class="period">
                            <td colspan="4">
                                <h3>{if $oMatchgoal->getPeriod()<4}{$oMatchgoal->getPeriod()} {$aLang.plugin.vs.period}{else}OT{/if}</h3>
                                {assign var=Period value=$oMatchgoal->getPeriod()}
                            </td>
                        </tr>
                        <tr class="head">
							<td></td>
                            <td>{$aLang.plugin.vs.score}</td>
                            <td>{$aLang.plugin.vs.time}</td>
                            <td>{$aLang.plugin.vs.scorer}</td>
                            <td>{$aLang.plugin.vs.assistants}</td>
                        </tr>
                    {/if}

                    <tr>
						<td>
						{if $oMatch->getAway()==$oMatchgoal->getTeamId()}
							<img style="height:20px;" src="http://img.virtualsports.ru/teams/{if $oMatch->getGametypeId()!=3}small{else}teamplay{/if}/{$oAway->getLogo()}" alt="Логотип комманды">
						{else}
							<img style="height:20px;" src="http://img.virtualsports.ru/teams/{if $oMatch->getGametypeId()!=3}small{else}teamplay{/if}/{$oHome->getLogo()}" alt="Логотип комманды">
						{/if}
						</td>
                        <td class="goals">
                            {$awaygoal}-{$homegoal}
                        </td>
                        <td class="goaltime">
                            {if $oMatchgoal->getMinute()<10}0{/if}{$oMatchgoal->getMinute()}:{if $oMatchgoal->getSecunde()<10}0{/if}{$oMatchgoal->getSecunde()}
                        </td>
						{if $oMatch->getGametypeId()==3}
							<td class="goalauthor">
								{if $oMatchgoal->getGoal()!=0}
									<a href="{router page='profile'}{$oUserGoal->getLogin()}/teamplay/" class="stream-author">{$aPlayer.$oGoal->getName()} {$aPlayer.$oGoal->getFamily()}</a>
									<span class="nick">{$oUserGoal->getLogin()}</span>
								{else}
									<span class="onlyname">{$aLang.plugin.vs.bot}</span>
								{/if}
							</td>
							<td class="goalassist">
								{if $oMatchgoal->getAssist()==0}
									<span class="onlyname">{$aLang.plugin.vs.bot}</span>
								{elseif $oMatchgoal->getAssist()==-1}
									...
								{else}
									<a href="{router page='profile'}{$oUserAssist->getLogin()}/teamplay/" class="stream-author">{$aPlayer.$oAssist->getName()|truncate:2:'.'} {$aPlayer.$oAssist->getFamily()}</a>
									<span class="nick">{$oUserAssist->getLogin()}</span>
								{/if}

								{if $oMatchgoal->getAssist2()==0}
									<br/>
									<span class="onlyname">{$aLang.plugin.vs.bot}</span>
								{elseif $oMatchgoal->getAssist2()==-1}
								{else}
									<br/>
									<a href="{router page='profile'}{$oUserAssist2->getLogin()}/teamplay/" class="stream-author">{$aPlayer.$oAssist2->getName()|truncate:2:'.'} {$aPlayer.$oAssist2->getFamily()}</a>
									<span class="nick">{$oUserAssist2->getLogin()}</span>
								{/if}
							</td>
						{/if}
						{if $oMatch->getGametypeId()==7}
							<td class="goalauthor">
								{if $oMatchgoal->getGoal()!=0}
									{$aPlayer.$oGoal->getName()} {$aPlayer.$oGoal->getFamily()}
								{else}
									<span class="onlyname">{$aLang.plugin.vs.bot}</span>
								{/if}
							</td>
							<td class="goalassist">
								{if $oMatchgoal->getAssist()==0}
									<span class="onlyname">{$aLang.plugin.vs.bot}</span>
								{elseif $oMatchgoal->getAssist()==-1}
									...
								{else}
									{$aPlayer.$oAssist->getName()|truncate:2:'.'} {$aPlayer.$oAssist->getFamily()}
								{/if}

								{if $oMatchgoal->getAssist2()==0}
									<br/>
									<span class="onlyname">{$aLang.plugin.vs.bot}</span>
								{elseif $oMatchgoal->getAssist2()==-1}
								{else}
									<br/>
									{$aPlayer.$oAssist2->getName()|truncate:2:'.'} {$aPlayer.$oAssist2->getFamily()}
								{/if}
							</td>
						{/if}
                    </tr>

                {/foreach}
            </tbody>
            </table>
        {/if}

    </div><!-- /.goal-listing -->


    {*Звезды матча*}
    <div class="stars-match">
        <h3>{$aLang.plugin.vs.stars}</h3>
        {assign var="oStar1" value=$aStar.0.star1}
        {assign var="oStar2" value=$aStar.0.star2}
        {assign var="oStar3" value=$aStar.0.star3}
		


        {if $aPlayer.$oStar1}{assign var="oUserStar1" value=$aPlayer.$oStar1->getUser()}{/if}
        {if $aPlayer.$oStar2}{assign var="oUserStar2" value=$aPlayer.$oStar2->getUser()}{/if}
        {if $aPlayer.$oStar3}{assign var="oUserStar3" value=$aPlayer.$oStar3->getUser()}{/if}

{if $oMatch->getGametypeId()==3}
        {if $aPlayer.$oStar1 || $aPlayer.$oStar2 || $aPlayer.$oStar3}
            <ul>
{*Первая звезда*}
			{if isset($aMatchplayerstat_away.$oStar1)} 
				<li>
					{if $oUserStar1}<span class="ava"><a href="{$oUserStar1->getUserWebPath()}"><img class="rounded" src="{$aPlayer.$oStar1->getFotoUrl()}" alt="" class="avatar" /></a></span>{/if}
					<span class="logo"><img src="http://img.virtualsports.ru/teams/teamplay/{$oAway->getLogo()}" alt="Название комманды"></span>
					<span class="gonschik">{if $aStar.0.star1!=0}<a href="{router page='profile'}{$oUserStar1->getLogin()}/" class="star-author">{$aPlayer.$oStar1->getName()} {$aPlayer.$oStar1->getFamily()}</a> <br/>
					<span class="nick">{$oUserStar1->getLogin()}</span> {else}<span class="onlyname">{$aLang.plugin.vs.bot}</span>{/if}</span>
					<span class="score">G:{$aMatchplayerstat_away.$oStar1->getGoals()} A:{$aMatchplayerstat_away.$oStar1->getAssists()} P:{$aMatchplayerstat_away.$oStar1->getGoals() + $aMatchplayerstat_away.$oStar1->getAssists()}</span>
				</li>
			{/if}
			{if isset($aMatchplayerstat_home.$oStar1)} 
				<li>
					{if $oUserStar1}<span class="ava"><a href="{$oUserStar1->getUserWebPath()}"><img class="rounded" src="{$aPlayer.$oStar1->getFotoUrl()}" alt="" class="avatar" /></a></span>{/if}
					<span class="logo"><img src="http://img.virtualsports.ru/teams/teamplay/{$oHome->getLogo()}" alt="Название комманды"></span>
					<span class="gonschik">{if $aStar.0.star1!=0}<a href="{router page='profile'}{$oUserStar1->getLogin()}/" class="star-author">{$aPlayer.$oStar1->getName()} {$aPlayer.$oStar1->getFamily()}</a> <br/>
					<span class="nick">{$oUserStar1->getLogin()}</span> {else}<span class="onlyname">{$aLang.plugin.vs.bot}</span>{/if}</span>
					<span class="score">G:{$aMatchplayerstat_home.$oStar1->getGoals()} A:{$aMatchplayerstat_home.$oStar1->getAssists()} P:{$aMatchplayerstat_home.$oStar1->getGoals() + $aMatchplayerstat_home.$oStar1->getAssists()}</span>
				</li>
			{/if}
{*Первая звезда*}

{*Вторая звезда*}
			{if isset($aMatchplayerstat_away.$oStar2)} 
                <li>
                    {if $oUserStar2}<span class="ava"><a href="{$oUserStar2->getUserWebPath()}"><img class="rounded" src="{$aPlayer.$oStar2->getFotoUrl()}" alt="" class="avatar" /></a></span>{/if}
                    <span class="logo"><img src="http://img.virtualsports.ru/teams/teamplay/{$oAway->getLogo()}" alt="Название комманды"></span>
                    <span class="gonschik">{if $aStar.0.star2!=0}<a href="{router page='profile'}{$oUserStar2->getLogin()}/" class="star-author">{$aPlayer.$oStar2->getName()} {$aPlayer.$oStar2->getFamily()}</a> <br/>
                    <span class="nick">{$oUserStar2->getLogin()}</span> {else}<span class="onlyname">{$aLang.plugin.vs.bot}</span>{/if}</span>
                    <span class="score">G:{$aMatchplayerstat_away.$oStar2->getGoals()} A:{$aMatchplayerstat_away.$oStar2->getAssists()} P:{$aMatchplayerstat_away.$oStar2->getGoals() + $aMatchplayerstat_away.$oStar2->getAssists()}</span>
                </li>
			{/if}
			{if isset($aMatchplayerstat_home.$oStar2)} 
                <li>
                    {if $oUserStar2}<span class="ava"><a href="{$oUserStar2->getUserWebPath()}"><img class="rounded" src="{$aPlayer.$oStar2->getFotoUrl()}" alt="" class="avatar" /></a></span>{/if}
                    <span class="logo"><img src="http://img.virtualsports.ru/teams/teamplay/{$oHome->getLogo()}" alt="Название комманды"></span>
                    <span class="gonschik">{if $aStar.0.star2!=0}<a href="{router page='profile'}{$oUserStar2->getLogin()}/" class="star-author">{$aPlayer.$oStar2->getName()} {$aPlayer.$oStar2->getFamily()}</a> <br/>
                    <span class="nick">{$oUserStar2->getLogin()}</span> {else}<span class="onlyname">{$aLang.plugin.vs.bot}</span>{/if}</span>
                    <span class="score">G:{$aMatchplayerstat_home.$oStar2->getGoals()} A:{$aMatchplayerstat_home.$oStar2->getAssists()} P:{$aMatchplayerstat_home.$oStar2->getGoals() + $aMatchplayerstat_home.$oStar2->getAssists()}</span>
                </li>
			{/if}
{*Вторая звезда*}
{*Третья звезда*}
			{if isset($aMatchplayerstat_away.$oStar3)} 
                <li>
                    {if $oUserStar3}<span class="ava"><a href="{$oUserStar3->getUserWebPath()}"><img class="rounded" src="{$aPlayer.$oStar3->getFotoUrl()}" alt="" class="avatar" /></a></span>{/if}
                    <span class="logo"><img src="http://img.virtualsports.ru/teams/teamplay/{$oAway->getLogo()}" alt="Название комманды"></span>
                    <span class="gonschik">{if $aStar.0.star3!=0}<a href="{router page='profile'}{$oUserStar3->getLogin()}/" class="star-author">{$aPlayer.$oStar3->getName()} {$aPlayer.$oStar3->getFamily()}</a> <br/>
                    <span class="nick">{$oUserStar3->getLogin()}</span> {else}<span class="onlyname">{$aLang.plugin.vs.bot}</span>{/if}</span>
                    <span class="score">G:{$aMatchplayerstat_away.$oStar3->getGoals()} A:{$aMatchplayerstat_away.$oStar3->getAssists()} P:{$aMatchplayerstat_away.$oStar3->getGoals() + $aMatchplayerstat_away.$oStar3->getAssists()}</span>
                </li>
			{/if}
			{if isset($aMatchplayerstat_home.$oStar3)} 
                <li>
                    {if $oUserStar3}<span class="ava"><a href="{$oUserStar3->getUserWebPath()}"><img class="rounded" src="{$aPlayer.$oStar3->getFotoUrl()}" alt="" class="avatar" /></a></span>{/if}
                    <span class="logo"><img src="http://img.virtualsports.ru/teams/teamplay/{$oHome->getLogo()}" alt="Название комманды"></span>
                    <span class="gonschik">{if $aStar.0.star3!=0}<a href="{router page='profile'}{$oUserStar3->getLogin()}/" class="star-author">{$aPlayer.$oStar3->getName()} {$aPlayer.$oStar3->getFamily()}</a> <br/>
                    <span class="nick">{$oUserStar3->getLogin()}</span> {else}<span class="onlyname">{$aLang.plugin.vs.bot}</span>{/if}</span>
                    <span class="score">G:{$aMatchplayerstat_home.$oStar3->getGoals()} A:{$aMatchplayerstat_home.$oStar3->getAssists()} P:{$aMatchplayerstat_home.$oStar3->getGoals() + $aMatchplayerstat_home.$oStar3->getAssists()}</span>
                </li>
			{/if}
{*Третья звезда*}
            </ul>
			{/if}

	

{/if}
{if $oMatch->getGametypeId()==7}
        {if $aPlayer.$oStar1 || $aPlayer.$oStar2 || $aPlayer.$oStar3}
            <ul>
{*Первая звезда*}
			{if isset($aMatchplayerstat_away.$oStar1)} 
				<li>
					<span class="ava"><img class="rounded" src="{$aPlayer.$oStar1->getFotoUrl()}" alt="" class="avatar" /></span>
					<span class="logo"><img src="http://img.virtualsports.ru/teams/{$oAway->getLogo()}"  alt="Название комманды"></span>
					<span class="gonschik">{$aPlayer.$oStar1->getName()} {$aPlayer.$oStar1->getFamily()}<br/>

					<span class="score">G:{$aMatchplayerstat_away.$oStar1->getGoals()} A:{$aMatchplayerstat_away.$oStar1->getAssists()} P:{$aMatchplayerstat_away.$oStar1->getGoals() + $aMatchplayerstat_away.$oStar1->getAssists()}</span>
				</li>
			{/if}
			{if isset($aMatchplayerstat_home.$oStar1)} 
				<li>
					<span class="ava"><img class="rounded" src="{$aPlayer.$oStar1->getFotoUrl()}" alt="" class="avatar" /></a></span>
					<span class="logo"><img src="http://img.virtualsports.ru/teams/{$oHome->getLogo()}" alt="Название комманды"></span>
					<span class="gonschik">{$aPlayer.$oStar1->getName()} {$aPlayer.$oStar1->getFamily()} <br/>

					<span class="score">G:{$aMatchplayerstat_home.$oStar1->getGoals()} A:{$aMatchplayerstat_home.$oStar1->getAssists()} P:{$aMatchplayerstat_home.$oStar1->getGoals() + $aMatchplayerstat_home.$oStar1->getAssists()}</span>
				</li>
			{/if}
{*Первая звезда*}

{*Вторая звезда*}
			{if isset($aMatchplayerstat_away.$oStar2)} 
                <li>
                    <span class="ava"><img class="rounded" src="{$aPlayer.$oStar2->getFotoUrl()}" alt="" class="avatar" /></a></span>
                    <span class="logo"><img src="http://img.virtualsports.ru/teams/{$oAway->getLogo()}" alt="Название комманды"></span>
                    <span class="gonschik">{$aPlayer.$oStar2->getName()} {$aPlayer.$oStar2->getFamily()} <br/>
                     <span class="score">G:{$aMatchplayerstat_away.$oStar2->getGoals()} A:{$aMatchplayerstat_away.$oStar2->getAssists()} P:{$aMatchplayerstat_away.$oStar2->getGoals() + $aMatchplayerstat_away.$oStar2->getAssists()}</span>
                </li>
			{/if}
			{if isset($aMatchplayerstat_home.$oStar2)} 
                <li>
                    <span class="ava"><img class="rounded" src="{$aPlayer.$oStar2->getFotoUrl()}" alt="" class="avatar" /></a></span>
                    <span class="logo"><img src="http://img.virtualsports.ru/teams/{$oHome->getLogo()}" alt="Название комманды"></span>
                    <span class="gonschik">{$aPlayer.$oStar2->getName()} {$aPlayer.$oStar2->getFamily()}<br/>

                    <span class="score">G:{$aMatchplayerstat_home.$oStar2->getGoals()} A:{$aMatchplayerstat_home.$oStar2->getAssists()} P:{$aMatchplayerstat_home.$oStar2->getGoals() + $aMatchplayerstat_home.$oStar2->getAssists()}</span>
                </li>
			{/if}
{*Вторая звезда*}
{*Третья звезда*}
			{if isset($aMatchplayerstat_away.$oStar3)} 
                <li>
                    <span class="ava"><img class="rounded" src="{$aPlayer.$oStar3->getFotoUrl()}" alt="" class="avatar" /></a></span>
                    <span class="logo"><img src="http://img.virtualsports.ru/teams/{$oAway->getLogo()}" alt="Название комманды"></span>
                    <span class="gonschik">{$aPlayer.$oStar3->getName()} {$aPlayer.$oStar3->getFamily()} <br/>

                    <span class="score">G:{$aMatchplayerstat_away.$oStar3->getGoals()} A:{$aMatchplayerstat_away.$oStar3->getAssists()} P:{$aMatchplayerstat_away.$oStar3->getGoals() + $aMatchplayerstat_away.$oStar3->getAssists()}</span>
                </li>
			{/if}
			{if isset($aMatchplayerstat_home.$oStar3)} 
                <li>
                    <span class="ava"><img class="rounded" src="{$aPlayer.$oStar3->getFotoUrl()}" alt="" class="avatar" /></a></span>
                    <span class="logo"><img src="http://img.virtualsports.ru/teams/{$oHome->getLogo()}" alt="Название комманды"></span>
                    <span class="gonschik">{$aPlayer.$oStar3->getName()} {$aPlayer.$oStar3->getFamily()}<br/>

                    <span class="score">G:{$aMatchplayerstat_home.$oStar3->getGoals()} A:{$aMatchplayerstat_home.$oStar3->getAssists()} P:{$aMatchplayerstat_home.$oStar3->getGoals() + $aMatchplayerstat_home.$oStar3->getAssists()}</span>
                </li>
			{/if}
{*Третья звезда*}
            </ul>
        {/if}
	{/if}
    </div><!-- /.stars-match -->

    </div>

    {*Кто играл в коммандах*}
    <div class="who-plays">
        <h3>{$aLang.plugin.vs.team_stats}</h3>
        {* Away player stats*}
        {if isset($aMatchplayerstat_away) && $oMatch->getPlayed()==1 && $oMatch->getGametypeId()==3  }
        <div class="away_stat">
        <table id="awayplayerstats" class="raspisanie">
        <thead>
        <tr>
            <th width="200">Player</th>
            <th align="center" width="26">Pos</th>
            <th align="center" width="26">G</th>
            <th align="center" width="26">A</th>
            <th align="center" width="26">P</th>
            <th align="center" width="26">+/-</th>
            <th align="center" width="26">PiM</th>
            <th align="center" width="26">PP</th>
            <th align="center" width="26">SH</th>
            <th align="center" width="26">Hits</th>
            <th align="center" width="26">S</th>
            <th align="center" width="26">%S</th>
            {*<th align="center" width="26">Star</th>	*}
        </tr>

        </thead>
        <tbody>
        {foreach from=$aMatchplayerstat_away item=oMatchplayerstat_away}

        {assign var="oPlayerForStat" value=$oMatchplayerstat_away->getPlayercardId()}
        {if $aPlayer.$oPlayerForStat}{assign var="oUserForStat" value=$aPlayer.$oPlayerForStat->getUser()}{/if}
        {if $oMatchplayerstat_away->getPosition()!="Bot" or ($oMatchplayerstat_away->getPosition()!="Bot" and ($oMatchplayerstat_away->getGoals() + $oMatchplayerstat_away->getAssists())>0 )}
        <tr>
            <td width="300">{if $oPlayerForStat!=0}{*<a href="{router page='profile'}{$oUserForStat->getLogin()}/" class="stream-author">{$oUserForStat->getLogin()}</a> <span class="fio">*}
			{$aPlayer.$oPlayerForStat->getName()} {$aPlayer.$oPlayerForStat->getFamily()}{*</span> *}{else}<span class="onlyname">{$aLang.plugin.vs.bot}</span>{/if}</td>
            <td align="center">{$oMatchplayerstat_away->getPosition()}</td>
            <td align="center">{$oMatchplayerstat_away->getGoals()}</td>
            <td align="center">{$oMatchplayerstat_away->getAssists()}</td>
            <td align="center">{$oMatchplayerstat_away->getGoals() + $oMatchplayerstat_away->getAssists()}</td>
            <td align="center">{$oMatchplayerstat_away->getPlusMinus()}</td>
            <td align="center">{$oMatchplayerstat_away->getPenalty()}</td>
            <td align="center">{$oMatchplayerstat_away->getPp()}</td>
            <td align="center">{$oMatchplayerstat_away->getPk()}</td>
            <td align="center">{$oMatchplayerstat_away->getHits()}</td>
            <td align="center">{$oMatchplayerstat_away->getShots()}</td>
            <td align="center">{if $oMatchplayerstat_away->getShots()==0}0,0{else}{($oMatchplayerstat_away->getGoals()/$oMatchplayerstat_away->getShots()*100)|string_format:"%.1f"}{/if}</td>
            {*<td align="center">0</td>*}
        </tr>
        {/if}
        {/foreach}
        </tbody>
        </table>
        </div>
        {/if}

        {if isset($aMatchplayerstat_home) && $oMatch->getPlayed()==1 && $oMatch->getGametypeId()==3  }
        {* Home player stats*}
        <div class="home_stat">
        <table id="homeplayerstats" class="raspisanie">
        <thead>
        <tr>
            <th width="200">Player</th>
            <th align="center" width="26">Pos</th>
            <th align="center" width="26">G</th>
            <th align="center" width="26">A</th>
            <th align="center" width="26">P</th>
            <th align="center" width="26">+/-</th>
            <th align="center" width="26">PiM</th>
            <th align="center" width="26">PP</th>
            <th align="center" width="26">SH</th>
            <th align="center" width="26">Hits</th>
            <th align="center" width="26">S</th>
            <th align="center" width="26">%S</th>
            {*<th align="center" width="26">Star</th>	*}
        </tr>

        </thead>
        <tbody>
        {foreach from=$aMatchplayerstat_home item=oMatchplayerstat_home}

        {assign var="oPlayerForStat" value=$oMatchplayerstat_home->getPlayercardId()}
        {if $aPlayer.$oPlayerForStat}{assign var="oUserForStat" value=$aPlayer.$oPlayerForStat->getUser()}{/if}
        {if $oMatchplayerstat_home->getPosition()!="Bot" or ($oMatchplayerstat_home->getPosition()!="Bot" and ($oMatchplayerstat_home->getGoals() + $oMatchplayerstat_home->getAssists())>0 )}
        <tr>
            <td width="300">{if $oPlayerForStat!=0}{*<a href="{router page='profile'}{$oUserForStat->getLogin()}/" class="stream-author">{$oUserForStat->getLogin()}</a> <span class="fio">*}
			{$aPlayer.$oPlayerForStat->getName()} {$aPlayer.$oPlayerForStat->getFamily()}{*</span> *}{else}<span class="onlyname">{$aLang.plugin.vs.bot}</span>{/if}</td>
            <td align="center">{$oMatchplayerstat_home->getPosition()}</td>
            <td align="center">{$oMatchplayerstat_home->getGoals()}</td>
            <td align="center">{$oMatchplayerstat_home->getAssists()}</td>
            <td align="center">{$oMatchplayerstat_home->getGoals() + $oMatchplayerstat_home->getAssists()}</td>
            <td align="center">{$oMatchplayerstat_home->getPlusMinus()}</td>
            <td align="center">{$oMatchplayerstat_home->getPenalty()}</td>
            <td align="center">{$oMatchplayerstat_home->getPp()}</td>
            <td align="center">{$oMatchplayerstat_home->getPk()}</td>
            <td align="center">{$oMatchplayerstat_home->getHits()}</td>
            <td align="center">{$oMatchplayerstat_home->getShots()}</td>
            <td align="center">{if $oMatchplayerstat_home->getShots()==0}0,0{else}{($oMatchplayerstat_home->getGoals()/$oMatchplayerstat_home->getShots()*100)|string_format:"%.1f"}{/if}</td>
            {*<td align="center">0</td>*}
        </tr>
        {/if}
        {/foreach}
        </tbody>
        </table>
        </div>
        {/if}
{if $aStats}
	<table width="100%">
	<thead> 
	<tr> 
		<th>&nbsp;</th>
		<th>Goalkeepers</th> 
		<th>&nbsp;</th> 
		<th>Team</th> 
		<th>GP</th> 
		<th>W</th> 
		<th >L</th> 
		<th >GAA</th>
		<th >SA</th>
		<th >GA</th>
		<th >S</th>		
		<th >%S</th>
		<th >SO</th>
		<th >G</th>	
		<th >A</th>
		<th  >PiM</th>
		<th  >Star</th>
	</tr> 
	</thead> 
	{assign var=num value=1}
	{foreach from=$aStats item=oStat name=el2}
	{assign var=team_id value=$oStat.team_id}
	{assign var=oTeam value=$aTeams.$team_id}
	<tr {if $oUserCurrent && $oUserCurrent->getUserId()==$oStat.user_id}class="my"{/if}> 
		<td width="20" align="center">{$num}</td>
		<td width="250" align="left"><span class="goalauthor"><a href="{router page='profile'}{$oStat.user_login}/teamplay/" class="stream-author">{$oStat.user_login}</a> <span class="fio">{$oStat.fio}</span></td> 
		<td width="37">{if $oStat.team_id>0} <a href="{$oTeam->getUrlFull()}"> <img style="height:20px;" src="{cfg name='path.root.web'}/images/teams/{if $oStat.user_id==0}small{else}teamplay{/if}/{$oStat.team_logo}"/></a>{/if}</td>
		<td align="center">{if $oStat.team_id>0}<a href="{$oTeam->getUrlFull()}" class="teamrasp">{$oStat.team_brief}</a>{/if}</td>
		<td align="center">{$oStat.games}</td>
		<td align="center">{$oStat.wins}</td> 
		<td align="center">{$oStat.loses}</td> 

		<td align="center" class="points"><b>{$oStat.sr_ga}</b></td>
		<td align="center">{$oStat.total_shots}</td>

		<td align="center">{$oStat.ga}</td>
		<td align="center">{$oStat.shots}</td>
		<td align="center">{$oStat.shots_prcn}</td>
		<td align="center">{$oStat.ibp}</td>
		<td align="center">{$oStat.goals}</td>
		<td align="center">{$oStat.assists}</td>
		<td align="center">{$oStat.penalty}</td>
		<td align="center">{$oStat.mv}</td>						
	</tr>
	{assign var=num value=$num+1}
	{/foreach}
	</table>
	{/if}
    </div><!-- /.who-plays -->
{/if}
    {*Последнее слово*}
    <div class="users-says">
        <h3>{$aLang.plugin.vs.press}</h3>
        {if $oAwayUser && $oHomeUser}
            <ul id="stream-list" class="stream-list">

                <li class="stream-item-type-match_played">
                    <table width="100%" id="myTable">
                    <tbody>
                            <tr>
                              <td colspan="3" width="50%" style="vertical-align: top;">{if $oAwayUser}<b>{$oAwayUser->getLogin()}</b>:{/if} {$oMatch->getAwayComment()}</td>
                              <td colspan="3" width="50%" style="vertical-align: top;">{if $oHomeUser}<b>{$oHomeUser->getLogin()}</b>:{/if} {$oMatch->getHomeComment()}</td>
                            </tr>
                    </tbody>
                    </table>
                </li>
            </ul>
        {/if}
    </div><!-- /.users-says -->
 
</div> <!-- /match-com -->

{if $aMatchVideos}
<div class="users-says">
<h3>Video</h3>
Exists video of this match, watch and comment video you can by this 
{assign var=num value=1}
{foreach from=$aMatchVideos item=oMatchVideo}
	<a target='_blank' href="{$oMatchVideo->getUrl()}">link{if $num>1}{$num}{/if}</a> 
	{assign var=num value=$num+1}
{/foreach}
</div>
</br>
{/if}


{if !$bNoComments}
{if $oMatchUser}
{include
	file='comment_tree.tpl'
	iTargetId=$oMatch->getMatchId()
	sTargetType='match'
	iCountComment=$oMatch->getCountComment()
	sDateReadLast=$oMatchUser->getDateLast()
	sNoticeCommentAdd=$aLang.topic_comment_add
	bNoCommentFavourites=true}
{else}
{include
	file='comment_tree.tpl'
	iTargetId=$oMatch->getMatchId()
	sTargetType='match'
	iCountComment=$oMatch->getCountComment() 
	sNoticeCommentAdd=$aLang.topic_comment_add
	bNoCommentFavourites=true}
{/if}
{/if}

{include file='footer.tpl'}