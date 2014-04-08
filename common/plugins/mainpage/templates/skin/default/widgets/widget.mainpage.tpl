{if $aCategories}
{foreach from=$aCategories item=oCategory}
	{assign var="for_cookie" value=$oCategory->getCategoryUrl()|escape:'html'}
	<div class="widget-box transparent {if $smarty.cookies.$for_cookie=='1'}collapsed{/if}">
		<div class="widget-header">
			<h3><a href="{$oCategory->getUrl()}">{$oCategory->getTitle()|escape:'html'}</a></h3>
			<div class="widget-toolbar no-border ">  
				<a href="#" data-action="collapse" data-cookie="{$oCategory->getCategoryUrl()|escape:'html'}"><i class="icon-chevron-{if $smarty.cookies.$for_cookie=='1'}down{else}up{/if}"></i></a> 
			</div>
		</div>	
		<div class="widget-body">
			<div class="widget-main">
				{assign var="aTopics" value=$oCategory->getTopics('new',1,6)}
				{include file='topic_list.tpl' aTopics=$aTopics} 
			</div>
		</div>
	</div>
{/foreach}
{/if}

{if $aForums}
	{foreach from=$aForums item=oForum} 
	
	{assign var="for_cookie" value=$oForum->getUrl()|escape:'html'}
	<div class="widget-box transparent {if $smarty.cookies.$for_cookie=='1'}collapsed{/if}">
		<div class="widget-header">
			<h3><a href="{$oForum->getUrlFull()}">{$oForum->getTitle()|escape:'html'}</a></h3>
			<div class="widget-toolbar no-border ">  
				<a href="#" data-action="collapse" data-cookie="{$oForum->getUrl()|escape:'html'}"><i class="icon-chevron-{if $smarty.cookies.$for_cookie=='1'}down{else}up{/if}"></i></a> 
			</div>
		</div>	
		<div class="widget-body">
			<div class="widget-main">
			 
				{assign var="aSubForums" value=$oForum->getSubForums()}
				
				<ul class="nav nav-pills custom ">											
				{foreach from=$aSubForums.collection item=oSubForum}				
					<li >
						<a href="{$oSubForum->getUrlFull()}">{$oSubForum->getTitle()}</a>
					</li>					 
				{/foreach}
				</ul>
			{assign var="aTopics" value=$oForum->getSubTopics(1,6)}
			{include file='topic_list.tpl' aTopics=$aTopics} 
			</div>
		</div>
	</div>
	{/foreach}
{/if}