{assign var="sidebarPosition" value='left'}
{assign var="sMenuItemSelect" value='teamplay'}
{assign var="oGeoTarget" value=$oUserProfile->getGeoTarget()}

{include file='header.tpl' }

{if $oPlayercard}
<ul class="nav nav-pills"> 
	{foreach from=$aPlayercards item=Card name=el2} 
		{assign var=Platform value=$Card->getPlatform()}
		<li {if $oPlayercard->getPlayercardId()==$Card->getPlayercardId()}class="active"{/if}><a href="{$oUserProfile->getUserWebPath()}teamplay/{if $Card->getSportId()==1}hockey{/if}/{$Platform->getBrief()}/">{if $Card->getSportId()==1}Hockey{/if} {$Platform->getBrief()}</a></li>
	{/foreach}
</ul>

{*<img src="{$oPlayercard->getFotoUrl()}" id="playerphoto-img" /><br/>

{$oPlayercard->getName()} {$oPlayercard->getFamily()}<br/>
{$oPlayercard->getNumber()}<br/>
{$oPlayercard->getPlayTime()}<br/>
{$oPlayercard->getAbout()}<br/>*}

<div class="row-fluid">
	<div class="span3 center">
		<span class="profile-picture">
			<img class="editable" alt="{$oPlayercard->getFamily()}'s Avatar" id="avatar2" src="{$oPlayercard->getFotoUrl()}">
		</span>
{if $oPlayerTournament}
{assign var="oPlayerTeam" value=$oPlayerTournament->getTeam()}
{/if}
{if $oPlayerTeam}
		<div class="space space-4"></div>
		<div class="tshirt_box" style="background: url('http://img.virtualsports.ru/field/home/{$oPlayerTeam->getFormaField()}') repeat scroll 0 0 transparent;">
			<div class="family lightcol">{$oPlayercard->getFamily()|upper}</div>
			<div class="number lightcol">{$oPlayercard->getNumber()}</div>
		</div>
{/if}
{*
		<a href="#" class="btn btn-small btn-block btn-success">
			<i class="icon-plus-sign bigger-110"></i>
			Add as a friend
		</a>

		<a href="#" class="btn btn-small btn-block btn-primary">
			<i class="icon-envelope-alt"></i>
			Send a message
		</a>*}
	</div><!--/span-->

	<div class="span9">
		<h4 class="blue">
			<span class="middle">{$oPlayercard->getName()} {$oPlayercard->getFamily()}</span>
			{if $oUserProfile->isOnline()}
			<span class="label label-purple arrowed-in-right">			
				<i class="icon-circle smaller-80"></i>
				online
			</span>
			{/if}
		</h4>

		<div class="profile-user-info">
			<div class="profile-info-row">
				<div class="profile-info-name"> Username </div>

				<div class="profile-info-value">
					<span>{$oPlayercard->getUser()->getLogin()}</span>
				</div>
			</div>
			
			{if $oGeoTarget}
			<div class="profile-info-row">
				<div class="profile-info-name"> Location </div>

				<div class="profile-info-value">
					<i class="icon-map-marker light-orange bigger-110"></i>
					{if $oGeoTarget && $oGeoTarget->getCountryId()}
						<a href="{router page='people'}country/{$oGeoTarget->getCountryId()}/" itemprop="country-name">{$oUserProfile->getProfileCountry()|escape:'html'}</a>{if $oGeoTarget->getCityId()},{/if}
					{/if}
					
					{if $oGeoTarget && $oGeoTarget->getCityId()}
						<a href="{router page='people'}city/{$oGeoTarget->getCityId()}/" itemprop="locality">{$oUserProfile->getProfileCity()|escape:'html'}</a>
					{/if} 
				</div>
			</div>
			{/if}
			{*<div class="profile-info-row">
				<div class="profile-info-name"> Age </div>

				<div class="profile-info-value">
					<span>38</span>
				</div>
			</div>*}
			{if $oPlayercard->getNumber()}
			<div class="profile-info-row">
				<div class="profile-info-name"> Number </div>

				<div class="profile-info-value">
					<span>{$oPlayercard->getNumber()}</span>
				</div>
			</div>
			{/if}
			<div class="profile-info-row">
				<div class="profile-info-name"> Team </div>

				<div class="profile-info-value">
					<span>{if $oPlayerTeam}<a href="{$oPlayerTeam->getUrlFull()}" ><img style="height:20px;" src="{cfg name='path.root.web'}/images/teams/teamplay/{$oPlayerTeam->getLogo()}"/> {$oPlayerTeam->getName()}</a>{else}-{/if}</span>
				</div>
			</div>
			
			{if $oPlayercard->getPlayTime()}
			<div class="profile-info-row">
				<div class="profile-info-name"> Play time </div>

				<div class="profile-info-value">
					<span>{$oPlayercard->getPlayTime()}</span>
				</div>
			</div>
			{/if}
			{if $oPlayercard->getAbout()}
			<div class="profile-info-row">
				<div class="profile-info-name"> About </div>

				<div class="profile-info-value">
					<span>{$oPlayercard->getAbout()}</span>
				</div>
			</div>
			{/if}
			{*<div class="profile-info-row">
				<div class="profile-info-name"> Joined </div>

				<div class="profile-info-value">
					<span>20/06/2010</span>
				</div>
			</div>

			<div class="profile-info-row">
				<div class="profile-info-name"> Last Online </div>

				<div class="profile-info-value">
					<span>3 hours ago</span>
				</div>
			</div>*}
		</div>

		<div class="hr hr-8 dotted"></div>

		<div class="profile-user-info">
 
{assign var="aUserFieldContactValues" value=$oUserProfile->getUserFieldValues(true,array('contact','social'))}
{if $aUserFieldContactValues}
	{*<h2 class="header-table">{$aLang.profile_contacts}</h2>
	
	<table class="table table-profile-info">*}
		{foreach from=$aUserFieldContactValues item=oField}
			<div class="profile-info-row">
				{if {$oField->getName()}=='facebook'}
					<div class="profile-info-name">
						<i class="middle icon-facebook-sign bigger-150 blue"></i>
					</div>
				{elseif {$oField->getName()}=='twitter'}
					<div class="profile-info-name">
						<i class="middle icon-twitter-sign bigger-150 light-blue"></i>
					</div>
				{else}
					<div class="profile-info-name">{$oField->getTitle()|escape:'html'}:</div>
				{/if}
				<div class="profile-info-value">
					<a href="#" target="_blank">{$oField->getValue(true,true)}</a>
				</div>
			</div>
			{*
			<tr>
				<td class="cell-label"><i class="icon-contact icon-contact-{$oField->getName()}"></i> {$oField->getTitle()|escape:'html'}:</td>
				<td>{$oField->getValue(true,true)}</td>
			</tr>*}
		{/foreach}
	{*</table>*}
{/if}
		</div>
	</div><!--/span-->
</div>
<small>
<table width="100%" cellspacing="0" class="table table-striped table-bordered table-hover" id="allteams">
{if $aStats}
<thead> 
<tr> 
<th>&nbsp;</th>
    <th>Player</th> 
	<th>&nbsp;</th>
    <th>Team</th> 
    <th align="center" width="35">GP</th> 
    <th align="center" width="35">G</th> 
    <th align="center" width="35">A</th>
	<th align="center" width="35">P</th>
	<th  width="35">+/-</th>		
	<th>PiM</th>
	<th width="30">Gpp</th>
	<th width="30">Gsh</th>
	<th width="30">GW</th>
	<th>Hits</th>
	<th align="center" width="30">S</th>	
	<th width="30">%S</th>
	<th width="35">Star</th>	
</tr> 
</thead> 
{assign var=num value=1}
{foreach from=$aStats item=oStat name=el2}
{assign var=team_id value=$oStat.team_id}
{assign var=oTeam value=$aTeams.$team_id}
{assign var=tournament_id value=$oStat.tournament_id}
{assign var=oTournament value=$aTournaments.$tournament_id}
<tr> 
	<td width="20" align="center">{$num}</td>
	<td width="250" align="left"><a href="{$oTournament->getUrlFull()}" title="{$oTournament->getName()}">{$oTournament->getName()} ({$oStat.round_name})</a></td> 
	<td width="37">{if $oStat.team_id>0}<a href="{$oTeam->getUrlFull()}" title="{$oTeam->getName()}"> <img style="height:20px;"  src="{cfg name='path.root.web'}/images/teams/{if $oStat.user_id==0}small{else}teamplay{/if}/{$oStat.team_logo}" alt="{$oTeam->getName()}"/></a>{/if}</td>
	<td align="center">{if $oStat.team_id>0}<a href="{$oTeam->getUrlFull()}" class="teamrasp" title="{$oTeam->getName()}">{$oStat.team_brief}</a>{/if}</td>
	<td align="center">{$oStat.games}</td>
	<td align="center">{$oStat.goals}</td> 
	<td align="center">{$oStat.assist}</td> 

	<td align="center" class="points"><b>{$oStat.points}</b></td>
	<td align="center">{$oStat.plus_minus}</td>

	<td align="center">{$oStat.penalty}</td>
	<td align="center">{$oStat.pp}</td>
	<td align="center">{$oStat.pk}</td>
	<td align="center">{$oStat.win_goal}</td>
	<td align="center">{$oStat.hits}</td>
	<td align="center">{$oStat.shots}</td>
	<td align="center">{$oStat.prcnt}</td>
	<td align="center">{$oStat.mv}</td>						
</tr>
{assign var=num value=$num+1}
{/foreach}
{/if}

{if $aStats_Goalkeeper}
<thead> 
<tr> 
    <th>&nbsp;</th>
    <th>Goalkeeper</th> 
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
{foreach from=$aStats_Goalkeeper item=oStat name=el2}
{assign var=team_id value=$oStat.team_id}
{assign var=oTeam value=$aTeams.$team_id}
{assign var=tournament_id value=$oStat.tournament_id}
{assign var=oTournament value=$aTournaments.$tournament_id}
<tr> 
	<td width="20" align="center">{$num}</td>
	<td width="250" align="left"><a href="{$oTournament->getUrlFull()}" title="{$oTournament->getName()}">{$oTournament->getName()} ({$oStat.round_name})</a></td> 
	<td width="37">{if $oStat.team_id>0}<a href="{$oTeam->getUrlFull()}" title="{$oTeam->getName()}"> <img style="height:20px;" src="{cfg name='path.root.web'}/images/teams/{if $oStat.user_id==0}small{else}teamplay{/if}/{$oStat.team_logo}" alt="{$oTeam->getName()}"/></a>{/if}</td>
	<td align="center">{if $oStat.team_id>0}<a href="{$oTeam->getUrlFull()}" class="teamrasp" title="{$oTeam->getName()}">{$oStat.team_brief}</a>{/if}</td>
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
{/if}
</table>
</small>
<link href="http://fonts.googleapis.com/css?family=Asap:700" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet" type="text/css">
<style>
            .tshirt_box {

                height: 99px;
                margin: 0 auto;
                width: 120px;
            }
            .tshirt_box .number {
                font-size: 32px;
                padding-top: 1px;
                text-align: center;
                font-family: 'Asap', sans-serif;
            }
            .tshirt_box .family {
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
</style>
{/if}
{include file='footer.tpl'}