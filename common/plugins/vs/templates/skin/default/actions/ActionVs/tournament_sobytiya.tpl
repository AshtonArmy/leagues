{include file='header.tpl' menu='blog'}
{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats="sobytiya"}
{if count($aStreamEvents)}
	<ul class="stream-list" id="stream-list">
		{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_events.tpl"}
	</ul>
	   {if !$bDisableGetMoreButton}
        <input type="hidden" id="stream_last_id" value="{$iStreamLastId}" />
        <a class="stream-get-more" id="stream_get_more" href="javascript:ls.stream.getMoreEvents({$tournament_id})">{$aLang.stream_get_more} &darr;</a>
		
    {/if}
{/if}
{literal}
<script>
	jQuery(function($){
		 
		$(window).scroll(function(){
			if  ($(document).height()-$(window).height() < $(window).scrollTop()+100) { 
				ls.stream.getMoreEvents({/literal}{$tournament_id}{literal});
			}
		});
 
	});
</script>	
{/literal}
{include file='footer.tpl'}