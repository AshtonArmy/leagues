{if $aMedals}
<h2 class="header-table">Медали</h2>
<ul class="medal-list-avatar">
		{foreach from=$aMedals item=oMedal} 
			{assign var="oTournament" value=$oMedal->getTournament()} 
			{assign var="oGame" value=$oMedal->getGame()} 
			
			<li>
				<img src="http://img.virtualsports.ru/medals/{$oMedal->getLogo()}" width="70" alt="{$oMedal->getMedalText()} - {$oTournament->getBrief()} - {$oGame->getName()}" title="{$oMedal->getMedalText()} - {$oTournament->getBrief()} - {$oGame->getName()}" class="avatar" /></a>
			</li>
		{/foreach}
	</ul>
{/if}