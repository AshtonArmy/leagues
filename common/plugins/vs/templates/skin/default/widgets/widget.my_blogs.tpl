{if $aBlogs}
<ul class="stream-content">
	{foreach from=$aBlogs item=oBlog name="cmt"} 
		<li> 
			<a href="{$oBlog->getUrlFull()}" class="stream-blog">{$oBlog->getTitle()}</a>
		</li>
	{/foreach}
</ul>
{else}
Вы не состоите ни в одном блоге <br/>

Со списком блогов вы можете ознакомиться на <a href="http://virtualsports.ru/blogs/">данной странице</a>
{/if}