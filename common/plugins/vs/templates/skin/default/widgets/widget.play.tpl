
{if $aTournaments}
	<li class="nav-razd">
		<i class="icon-envelope"></i> Tournaments
	</li>
	{foreach from=$aTournaments item=oTournament}
	<li>
		<a href="{$oTournament->getUrlFull()}">
			<div class="clearfix">
				<span class="pull-left">
					{if $oTournament->getLogoSmall()}
						<img src="{cfg name='path.root.web'}/images/tournament/{$oTournament->getUrl()}/{$oTournament->getLogoSmall()}" alt="" width="32"/>
					{else}
						<img src="http://virtualsports.ru/images/teams/small/008_bid.png">
					{/if}
					{$oTournament->getName()} 
				</span>
			</div>
		</a>
	</li>
	{/foreach}
{/if}
{if $aFutureMatches}
	<li class="nav-razd">
		<i class="icon-envelope"></i> Future matches
	</li>
	{foreach from=$aFutureMatches item=oFutureMatch}
	{assign var=oAwayTeam value=$oFutureMatch->getAwayteam()}
	{assign var=oHomeTeam value=$oFutureMatch->getHometeam()}
	{assign var=oTournament value=$oFutureMatch->getTournament()}
	<li class="dropdown-hover">
		
			<img style="width:32px;"  src="{cfg name='path.root.web'}/images/teams/small/{$oAwayTeam->getLogo()}" alt="" align="absmiddle">
			-
			<img style="width:32px;" src="{cfg name='path.root.web'}/images/teams/small/{$oHomeTeam->getLogo()}" alt="" align="absmiddle">

		<span><a href="{$oTournament->getUrlFull()}match/{$oFutureMatch->getMatchId()}/">time</a></span>
		<span>/ <a href="{$oTournament->getUrlFull()}match_insert/{$oFutureMatch->getMatchId()}/">insert</a></span>
		
	</li>
	{/foreach}
{/if}
{if {cfg name='sys.site'} == 'ch'}
	<li class="nav-header">
		<i class="icon-envelope"></i> Items
	</li>
	<li>
		<a href="{router page='settings'}teamplay/hockey/ps3/">
			<div class="clearfix">
				<span class="pull-left">
					<i class="btn btn-primary no-hover icon-pencil"></i>
					Edit playercard PS3
				</span>
			</div>
		</a>
	</li>
	<li>
		<a href="{router page='settings'}teamplay/hockey/xbox/">
			<div class="clearfix">
				<span class="pull-left">
					<i class="btn btn-primary no-hover icon-pencil"></i>
					Edit playercard Xbox
				</span>
			</div>
		</a>
	</li>
	{if $aPlayerTournaments}
	{foreach from=$aPlayerTournaments item=oPlayerTournament }
	{assign var=oTeam value=$oPlayerTournament->getTeam()}
		{if $oTeam}
		<li>
			<a href="{$oTeam->getUrlFull()}">
				<div class="clearfix">
					<span class="pull-left">
						<img style="width:20px;" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/> {$oTeam->getName()}
					</span>
				</div>
			</a>
		</li>
		{/if}
	{/foreach}
	{/if}

	<li>
		<a href="{router page='team'}create/hockey/">
			<div class="clearfix">
				<span class="pull-left">
					<i class="btn btn-primary no-hover icon-plus"></i>
					Create team
				</span>
			</div>
		</a>
	</li>

	<li>
		<a href="{router page='profile'}{$oUserCurrent->getLogin()}/teamplay/">
			<div class="clearfix">
				<span class="pull-left">
					<i class="btn btn-primary no-hover icon-gamepad"></i>
					View playercard
				</span>
			</div>
		</a>
	</li>
{/if}