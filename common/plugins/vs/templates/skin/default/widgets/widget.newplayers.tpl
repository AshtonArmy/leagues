<div class="block" id="block_blogs">
	<header class="block-header">
		<h3>New players</h3>
	</header>
	
	
	<div class="block-content">
		
		<div class="js-block-blogs-content">
			<ul class="item-list">
				{foreach from=$aPlayercards item=oPlayercard}
				{assign var=oPlatform value=$oPlayercard->getPlatform()}
				{assign var=oTeam value=$oPlayercard->getTeam()}
				{assign var=oUser value=$oPlayercard->getUser()}
					<li>
						<a href="{$oUser->getUserWebPath()}teamplay/{if $oPlayercard->getSportId()==1}hockey{/if}/{$oPlatform->getBrief()}/"><img class="avatar3" alt="{$oPlayercard->getFamily()}'s Avatar" id="avatar3" src="{$oPlayercard->getFotoUrl()}"></a>
						
						<a href="{$oUser->getUserWebPath()}teamplay/{if $oPlayercard->getSportId()==1}hockey{/if}/{$oPlatform->getBrief()}/" class="author">{$oPlayercard->getFullFio()|escape:'html'}</a> &rarr; {$oPlatform->getName()}
						
						{if $oTeam} &rarr; <a href="{$oTeam->getUrlFull()}" >{$oTeam->getName()}</a>{/if}
						<p>
							<time datetime="{date_format date=$oPlayercard->getTimes() format='c'}">{date_format date=$oPlayercard->getTimes() hours_back="12" minutes_back="60" now="60" day="day H:i" format="j F Y, H:i"}</time>
							
						</p>
					</li>
				{/foreach}
			</ul>
		</div>

	</div>
</div>