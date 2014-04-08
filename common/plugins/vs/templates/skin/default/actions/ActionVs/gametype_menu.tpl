{*<div class="button_top underline">
		<div class="left {if $whats=="index"}active{/if}">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link}">В {$aLang.plugin.in_blogs}</a></div>
		</div>
		<div class="left {if $whats=="blogiturnirov"}active{/if}">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_blogiturnirov}">{$aLang.plugin.events}</a></div>
		</div>
{if $oGame->getSportId()!=4}
		<div class="left {if $whats=="nastroiki"}active{/if}">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_nastroiki}">{$aLang.plugin.vs.settings}</a></div>
		</div>
		<div class="left {if $whats=="tovarki"}active{/if}">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_tovarki}">{$aLang.plugin.vs.friendlies}</a></div>
		</div>
		<div class="left {if $whats=="rating"}active{/if}">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_rating}">{$aLang.plugin.vs.rankings}</a></div>
		</div>
		<div class="left {if $whats=="ofrating"}active{/if}">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_ofrating}">{$aLang.plugin.vs.ofrankings}</a></div>
		</div>
{/if}
</div>*}