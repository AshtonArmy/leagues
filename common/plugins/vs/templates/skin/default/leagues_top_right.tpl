<div class="logos-right">
{if $aBlogs} 
{foreach from=$aBlogs item=oLeague}
	{if $oLeague->getLogoSmall()}
		<a href="{$oLeague->getUrlFull()}" title="{$oLeague->getTitle()}" ><img src="{cfg name='path.root.web'}/images/blog/{$oLeague->getUrl()}/{$oLeague->getLogoSmall()}" alt="" height="23"/></a>
	{/if}
{/foreach}
{/if}
    </div>