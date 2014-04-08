<section class="block block-type-stream" id="streams">
	{hook run='block_stream_nav_item' assign="sItemsHook"}
	<header class="block-header sep">
		<h3><a href="{router page='comments'}" title="{$aLang.block_stream_comments_all}">{$aLang.block_stream}</a></h3>
		<div class="block-update js-block-stream-update"></div>

	</header>
<script>
 var stream_count={if $stream_count}{$stream_count}{else}0{/if};
 var stream_lang='{if $stream_lang}{$stream_lang}{else}all{/if}';
 var stream_sport={if $stream_sport}{$stream_sport}{else}0{/if};
</script>	
	<div class="block-content">
        <div>
            <div class="js-block-stream-content">
                {$sStreamComments}
            </div>
        </div>
	</div>

    <ul class="nav nav-pills js-block-stream-nav" {*{if $sItemsHook}style="display: none;"{/if}*}>
        <li class="active js-block-stream-item" data-type="comment"><a href="#" title="Новости"></a></li>
        <li class="js-block-stream-item" data-type="forum"><a href="#" title="Форум"></a></li>
        <li class="js-block-stream-item" data-type="matches"><a href="#" title="Матчи"></a></li>

    </ul>

</section>

