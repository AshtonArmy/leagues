{if $Tournaments}
<ul class="stream-content">
{foreach from=$Tournaments item=oTournament} 
	{assign var="oBlog" value=$oTournament->getBlog()}
	<li><a href="{$oBlog->getUrlFull()}turnir/{$oTournament->getUrl()}">{$oTournament->getBrief()}</a></li> 
{/foreach}
</ul>
{else}
Вы не участвуете ни в одном турнире<br/>

Страницы со списком турниров пока нет
{*Со списком блогов вы можете ознакомиться на <a href="http://virtualsports.ru/blogs/">данной странице</a>*}
{/if}