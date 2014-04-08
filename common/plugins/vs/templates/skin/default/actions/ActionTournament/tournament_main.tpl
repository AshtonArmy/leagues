{include file='header.tpl' menu_content='tournament'}
 
{if $bCloseBlog}
	<div class="padding">{$aLang.blog_close_show}</div>
{else}
	{include file='topic_list.tpl'}
{/if}


{include file='footer.tpl'}