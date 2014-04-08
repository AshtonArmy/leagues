{include file='header.tpl' menu='settings' showWhiteBack=true}

{if isset($results)}
<b>Userbars:</b> <br/>
{foreach from=$results item=result name=el2}
<br/>
For insert on forums use next this link: <br/>
<i>[url=http://virtualsports.ru/] [IMG]http://img.virtualsports.ru/user/{$result.platform}/{$result.game}/{$result.gametype}/{$oUserCurrent->getLogin()|escape:'html'}.png[/IMG][/url]</i><br/>
<img src="http://img.virtualsports.ru/user/{$result.platform}/{$result.game}/{$result.gametype}/{$oUserCurrent->getLogin()|escape:'html'}.png" />
{/foreach}
{else}
Sorry, you haven't own userbar, because you haven't played yet.
{/if}

{include file='footer.tpl'}