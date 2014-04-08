{include file='header.tpl' menu_content='tournament'}


		{*
		<ul class="block-nav">						
			<li><strong></strong><a href="#" id="block_stream_topic" onclick="ls.au.toggle(this,'weeks', {literal}{{/literal} tournament: {$tournament_id}, week:-1 {literal}}{/literal}); return false;">{$aLang.plugin.vs.pweek}</a></li>
			<li><a href="#" id="block_stream_topic" onclick="ls.au.toggle(this,'weeks', {literal}{{/literal} tournament: {$tournament_id}, week:0 {literal}}{/literal}); return false;">{$aLang.plugin.vs.cweek}</a></li>
			<li><a href="#" id="block_stream_topic" onclick="ls.au.toggle(this,'weeks', {literal}{{/literal} tournament: {$tournament_id}, week:1 {literal}}{/literal}); return false;">{$aLang.plugin.vs.nweek}</a></li>
			<li class="active"><a href="#" id="block_stream_comment" onclick="ls.au.toggle(this,'monthes', {literal}{{/literal} tournament: {$tournament_id} {literal}}{/literal}); return false;">{$aLang.plugin.vs.by_month}</a></li>						
			<li><a href="#" id="block_stream_comment" onclick="ls.au.toggle(this,'monthes', {literal}{{/literal} tournament: {$tournament_id}, monthes:0 {literal}}{/literal}); return false;">{$aLang.plugin.vs.all_games}</a><em></em></li>
			{if isset($myteam) and $myteam!=0}<li><a href="#" id="block_stream_topic" onclick="ls.au.toggle(this,'monthes', {literal}{{/literal} tournament: {$tournament_id}, monthes:0 , team:'{$oTeam->getShortname()}'{literal}}{/literal}); return false;">{$aLang.plugin.vs.my_games}</a></li>{/if}
			{if $admin=="yes"}<li><a href="#" id="block_stream_topic" onclick="ls.au.toggle(this,'dolg', {literal}{{/literal} tournament: {$tournament_id}, week:1 {literal}}{/literal}); return false;">{$aLang.plugin.vs.debt_games}</a></li>{/if}
			{if $admin=="yes"}<li><a href="#" id="block_stream_topic" onclick="ls.au.toggle(this,'willdolg', {literal}{{/literal} tournament: {$tournament_id}, week:1 {literal}}{/literal}); return false;">{$aLang.plugin.vs.will_debt_games}</a></li>{/if}
		</ul>					
		*}
		<div class="block-content" id="div_raspisanie">


		{$sRaspisanie}

		</div>

	<div class="bl"><div class="br"></div></div>


{include file='footer.tpl'}