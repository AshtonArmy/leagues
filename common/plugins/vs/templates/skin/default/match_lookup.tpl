{if $oMatch}
	{assign var=oHome value=$oMatch->getHometeam()}
	{assign var=oAway value=$oMatch->getAwayteam()}
	<p align="center"><h2>Time suggestion</h2></p>
	№{$oMatch->getNumber()} <b>{$oAway->getName()}</b> at <b>{$oHome->getName()}</b> <span class="small_text">{$oMatch->getDates()|date_format:"%e %B %Y"}</span>
	<br/>
	<br/>

	<ul id="time_list" class="time_list">
	{if $aMatchtime}
	{foreach from=$aMatchtime item=oMatchtime name=el2}
			{if $smarty.foreach.el2.iteration % 2  == 0}
				{assign var=className value='odd'}
			{else}
				{assign var=className value='even'}
			{/if}
			
	<li class="{$className}">
		{if $oUser->GetUserId()==$oMatchtime->getPlayerId()}
		{assign var=oUser1 value=$oMatchtime->getUser1()} 
		<span class="myteam">
				{if $oMatch->getAway()==$oMatchtime->getTeamId()}<b>{$oAway->getName()}</b><br/>{/if}
				{if $oMatch->getHome()==$oMatchtime->getTeamId()}<b>{$oHome->getName()}</b><br/>{/if}
		</span>
			<span class="smalltext">({$oMatchtime->getLogTime()|date_format:"%d.%m.%Y %H:%M"})</span>
			<span class="small_text"><b>{$oMatchtime->getTimes()|date_format:"%d.%m.%Y at %H:%M"}</b>
			<a href="http://virtualsports.ru/profile/{$oUser1->getLogin()}/" class="ls-user">{$oUser1->getLogin()}</a>: "{$oMatchtime->getComment()}"
			{if $oMatchtime->getStatus()==0}
				
			{else}
				<br/>
				
				{if $oMatchtime->getStatus()==1 || $oMatchtime->getStatus()==2}<span class="smalltext">({$oMatchtime->getAnswerTime()|date_format:"%d.%m.%Y %H:%M"})</span>{/if}
				<b>
				{if $oMatchtime->getStatus()==1}accepted{/if}
				{if $oMatchtime->getStatus()==2}declined{/if}
				</b>
				{if $oMatchtime->getPlayer2Id()!=0}
				{assign var=oUser2 value=$oMatchtime->getUser2()}			
				<a href="http://virtualsports.ru/profile/{$oUser2->getLogin()}/" class="ls-user">{$oUser2->getLogin()}</a>: "{$oMatchtime->getComment2()}" 
				{/if}

				
			{/if}
			</span>
		{/if}
		{if $oUser->GetUserId()!=$oMatchtime->getPlayerId()}
		{assign var=oUser1 value=$oMatchtime->getUser1()}
		<span class="myteam">
				{if $oMatch->getAway()==$oMatchtime->getTeamId()}<b>{$oAway->getName()}</b><br/>{/if}
				{if $oMatch->getHome()==$oMatchtime->getTeamId()}<b>{$oHome->getName()}</b><br/>{/if}
		</span>
			<span class="smalltext">({$oMatchtime->getLogTime()|date_format:"%d.%m.%Y %H:%M"})</span>
			<span class="small_text" id="{$oMatchtime->getId()}"><b>{$oMatchtime->getTimes()|date_format:"%d.%m.%Y at %H:%M"}</b> 
			<a href="http://virtualsports.ru/profile/{$oUser1->getLogin()}/" class="ls-user">{$oUser1->getLogin()}</a>: "{$oMatchtime->getComment()}"
			<br/>
			
				{if $oMatchtime->getStatus()==1 || $oMatchtime->getStatus()==2}<span class="smalltext">({$oMatchtime->getAnswerTime()|date_format:"%d.%m.%Y %H:%M"})</span>{/if}
				<b>
				{if $oMatchtime->getStatus()==1}accepted{/if}
				{if $oMatchtime->getStatus()==2}declined{/if}
				</b>
				{if $oMatchtime->getPlayer2Id()!=0}
				{assign var=oUser2 value=$oMatchtime->getUser2()}			
				<a href="http://virtualsports.ru/profile/{$oUser2->getLogin()}/" class="ls-user">{$oUser2->getLogin()}</a>: "{$oMatchtime->getComment2()}" 
				{/if}

				
			</span>
		{/if}
	</li>
	{/foreach}
	{/if}
	</ul>
	
<br/>
{if $oMatch->getPlayed()==0}
<a href="javascript:result_teh({$oMatch->getMatchId()},'{$oMatch->getAway()}','tehl');">set technical lose {$oAway->getName()}</a> 
<br/>
<a href="javascript:result_teh({$oMatch->getMatchId()},'{$oMatch->getAway()}','tehn');">set technical draw</a> 
<br/><a href="javascript:result_teh({$oMatch->getMatchId()},'{$oMatch->getHome()}','tehl');">set technical lose {$oHome->getName()}</a>
{/if}
{/if}