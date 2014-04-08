<aside class="toolbar" id="toolbar-left">
    <section class="toolbar-block">
		{foreach from=$Tournaments item=oTournament} 
			{assign var="oBlog" value=$oTournament->getBlog()}
			<a href="{$oBlog->getUrlFull()}turnir/{$oTournament->getUrl()}" title="{$oTournament->getBrief()}">
				{if $oTournament->getLogoSmall()}
					<img src="{cfg name='path.root.web'}/images/tournament/{$oTournament->getUrl()}/{$oTournament->getLogoSmall()}" alt="" width="32"/>
				{else}
					<img src="http://virtualsports.ru/images/teams/small/008_bid.png">
				{/if}
			</a> 
		{/foreach}
    </section>
</aside>

{*
	<div class="user_tours">
		<div class="wrap">
			<ul>
				<li class="title">Ваши турниры</li>
				<li class="panel_bar">
					<ul class="pagi">
						{if count($Tournaments)>5}<li class="prev"><a></a></li>{/if}
						<li class="tour_link">
						{foreach from=$Tournaments item=oTournament} 
							{assign var="oBlog" value=$oTournament->getBlog()}
							<a href="{$oBlog->getUrlFull()}turnir/{$oTournament->getUrl()}">{$oTournament->getBrief()}</a>
						{/foreach}							
						</li>
						{if count($Tournaments)>5}<li class="next"><a></a></li>{/if}
					</ul>
				</li>
			</ul>
		</div>
	</div>
*}