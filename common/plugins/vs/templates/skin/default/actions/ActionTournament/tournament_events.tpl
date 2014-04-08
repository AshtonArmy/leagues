{include file='header.tpl' menu_content='tournament'}

	<ul class="stream-list" id="stream-list">
		{*{include file="$sTemplatePathPlugin/actions/ActionTournament/events.tpl"}*}
		{$sTextEvents}
	</ul>
	   {if !$bDisableGetMoreButton}
        <input type="hidden" id="stream_last_id" value="{$iStreamLastId}" />
        <a class="stream-get-more" id="stream_get_more" href="javascript:ls.stream.getMoreEvents({$oTournament->getTournamentId()})">{$aLang.stream_get_more} &darr;</a>
		
    {/if}

{literal}
<script>
	jQuery(function($){
		 
		$(window).scroll(function(){
			if  ($(document).height()-$(window).height() < $(window).scrollTop()+100) { 
				ls.stream.getMoreEvents({/literal}{$oTournament->getTournamentId()}{literal});
			}
		});
 
	});
</script>	
{/literal}
{include file='footer.tpl'}