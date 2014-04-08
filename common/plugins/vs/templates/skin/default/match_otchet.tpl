{if $oMatch}
{assign var="oAwayUser" value=$oMatch->getAwayuser()}
{assign var="oHomeUser" value=$oMatch->getHomeuser()}
{assign var="oAwayTeam" value=$oMatch->getAwayteam()}
{assign var="oHomeTeam" value=$oMatch->getHometeam()}
<p align="center"><h2>Результат матча</h2></p>
<h2><p align="center">{if $oMatch->getPlayed()==1}
				{$oMatch->getGoalsAway()} : {$oMatch->getGoalsHome()}
				{if $oMatch->getSo()==1} SO{/if}
				{if $oMatch->getOt()==1} ОТ{/if}
				{if $oMatch->getTeh()==1} тех.{/if} 
	{/if}</p></h2>

<p>
<a href="http://virtualsports.ru/profile/{$oAwayUser->getLogin()}/" class="ls-user">{$oAwayUser->getLogin()}</a>{if $oMatch->getAwayRating()>0}+{/if}{$oMatch->getAwayRating()} ({$oAwayTeam->getName()}) : {$oMatch->getAwayComment()}
</p>
<p>
<a href="http://virtualsports.ru/profile/{$oHomeUser->getLogin()}/" class="ls-user">{$oHomeUser->getLogin()}</a>{if $oMatch->getHomeRating()>0}+{/if}{$oMatch->getHomeRating()} ({$oHomeTeam->getName()}): {$oMatch->getHomeComment()}
</p>
<p align="center">
	<a href="#" class="jqmClose">Закрыть</a>
	</p>
{/if}