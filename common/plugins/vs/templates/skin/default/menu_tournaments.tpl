<div class="wrap">
	<ul class="list">
		<li class="colum past">
			<div class="wraps">
				<h5>Прошедшие</h5>
				<div class="lists">
					{foreach from=$PastTournaments item=oTournament} 
						{assign var="oBlog" value=$oTournament->getBlog()}
						<a href="{$oBlog->getUrlFull()}turnir/{$oTournament->getUrl()}">{$oTournament->getBrief()}</a>
					{/foreach}
					{*<a href="#">WaterPolo CUP 2010</a>
					<a href="#">Tenis World Champ 2012</a>
					<a href="#">WaterPolo CUP 2010</a>
					<a href="#">Tenis World Champ 2012</a>
					<a href="#">WaterPolo CUP 2010</a>
					<a href="#">WaterPolo CUP 2010</a>
					<a href="#">Tenis World Champ 2012</a>
					<a href="#">WaterPolo CUP 2010</a>*}
				</div>
			</div>
		</li>
		<li class="colum real">
			<div class="wraps">
				<h5>Текущие</h5>
				<div class="lists">
					{foreach from=$NowTournaments item=oTournament} 
						{assign var="oBlog" value=$oTournament->getBlog()}
						<a href="{$oBlog->getUrlFull()}turnir/{$oTournament->getUrl()}">{$oTournament->getBrief()}{if $oTournament->getGametypeId()==6} (GM){/if}</a>
					{/foreach}
					{*<a href="#">WaterPolo CUP 2010</a>
					<a href="#">Tenis World Champ 2012</a>
					<a href="#" class="select">WaterPolo CUP 2010</a>
					<a href="#">Tenis World Champ 2012</a>
					<a href="#">WaterPolo CUP 2010</a>*}
				</div>
			</div>
		</li>
		<li class="colum future">
			<div class="wraps">
				<h5>Будущие</h5>
				<div class="lists">
					{foreach from=$FutureTournaments item=oTournament} 
						{assign var="oBlog" value=$oTournament->getBlog()}
						<a href="{$oBlog->getUrlFull()}turnir/{$oTournament->getUrl()}">{$oTournament->getBrief()}</a>
					{/foreach}
					{*<a href="#">WaterPolo CUP 2010</a>
					<a href="#">Tenis World Champ 2012</a>
					<a href="#">WaterPolo CUP 2010</a>
					<a href="#">Tenis World Champ 2012</a>
					<a href="#">WaterPolo CUP 2010</a>*}
				</div>
			</div>
		</li>
		<li class="block">
			<div class="wraps">
				<ul class="info">
					<li class="logo">
						<img src="{cfg name='path.static.skin'}/images/module/top_block/logo.jpg">
						<h4>Summer Cup 2010 Pro</h4>
					</li>
					<li class="text-info">
						<div class="box">
							<ul class="list-1">
								<li>Матчей сыграно: <strong>100 / 250</strong></li>
								<li>Позиция: <strong>10 / 25</strong></li>
							</ul>
							<ul class="list-2">
								<li class="titles">Последнии матчи:</li>
								<li class="match">
									<span class="command-1">Команда красных</span>
									<span class="score">2:0</span>
									<span class="command-2">Синия команда</span>
								</li>
								<li class="match">
									<span class="command-1">Команда красных</span>
									<span class="score">2:0</span>
									<span class="command-2">Синия команда</span>
								</li>
								<li class="match">
									<span class="command-1">Команда красных</span>
									<span class="score">2:0</span>
									<span class="command-2">Синия команда</span>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</li>
	</ul>
</div>