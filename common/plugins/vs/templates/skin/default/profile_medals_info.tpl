{if $aMedals}
<div class="span6">
	<div class="widget-box transparent">
		<div class="widget-header-small">
			<h4 class="header-table">Медали</h4>
		</div>
		<div class="widget-body">
			<div class="widget-main">
<ul class="medal-list-avatar user-list-avatar">
		{foreach from=$aMedals item=oMedal} 
			{assign var="oTournament" value=$oMedal->getTournament()} 
			{assign var="oGame" value=$oMedal->getGame()} 
			
			<li>
				<img src="http://img.virtualsports.ru/medals/{$oMedal->getLogo()}" width="70" alt="{$oMedal->getMedalText()} - {$oTournament->getBrief()} - {$oGame->getName()}" title="{$oMedal->getMedalText()} - {$oTournament->getBrief()} - {$oGame->getName()}" class="avatar" /></a>
			</li>
		{/foreach}
	</ul>
			</div>
		</div>
	</div>
</div>
{/if}