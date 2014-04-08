<div class="bar_games">
	<div class="wrap">
		<ul class="pagi">
			<li class="prev"><a></a></li>
			<li class="game_link">
				{foreach from=$aGames item=oGame} 
					<a id="{$oGame->getBrief()}" href="#"></a>
				{/foreach}
				{*<a id="fifa12" class="select" href="#"></a>
				<a id="nhl11" href="#"></a>
				<a id="nhl12" href="#"></a>
				<a id="gt5" href="#"></a>
				<a id="nba2k11" href="#"></a>
				<a id="nba2k12" href="#"></a>
				<a id="nfl13" href="#"></a>*}
			</li>
			<li class="next"><a></a></li>
		</ul>
	</div>
</div>
<div class="list_tours"></div>