{foreach from=$aBlogsTree item=oTree name=tree}
    {*<li class="active"><a href="{$oTree->getUrlFull()}" class="topic-blog">{$oTree->getTitle()|escape:'html'}</a><li>*}
	<li class="active"><span class="divider"><i class="icon-angle-right"></i></span> <a href="{$oTree->getUrlFull()}">{$oTree->getTitle()|escape:'html'}</a></li>
	
{/foreach}
