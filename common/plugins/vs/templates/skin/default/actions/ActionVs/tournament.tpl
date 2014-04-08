{include file='header.tpl' menu='blog'}
{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats="index"}
{assign var="oUserOwner" value=$oBlog->getOwner()}
{assign var="oVote" value=$oBlog->getVote()}




{if $bCloseBlog}
	<div class="padding">{$aLang.blog_close_show}</div>
{else}
	{include file='topic_list.tpl'}
{/if}


{include file='footer.tpl'}