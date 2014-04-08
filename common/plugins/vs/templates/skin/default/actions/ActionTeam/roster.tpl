{if $oTeam && $oTeam->getBlogId()}  
{include file='header.tpl' menu_content='team' team_page=true} 
{else}
{include file='header.tpl' menu_content='team'} 
{/if}
{if $aPlayers}
<table class="personal">
{foreach from=$aPlayers item=oPlayer name=el2}
{assign var=oUser value=$oPlayer->getUser()}
{assign var=oPlayercard value=$oPlayer->getPlayercard()}
<tr>
	<td>
		<a id="inline_userlink" href="{router page='profile'}{$oUser->getLogin()}/teamplay/" target="_new" data-rel="tooltip" data-html="true" data-title="<img src='{$oPlayercard->getFotoUrl()}'/>">{$oPlayercard->getFullFio()}</a> (<a id="inline_userlink" href="{router page='profile'}{$oUser->getLogin()}" target="_new" data-rel="tooltip" data-html="true" data-title="{literal}function(){return 'hello';}{/literal}">{$oUser->getLogin()}</a></strong>) <b>{if $oPlayer->getCap()==1}A {/if}{if $oPlayer->getCap()==2}C {/if}</b>
	</td>
</tr>
{/foreach}
{*				
{foreach from=$aPlayers item=oPlayer name=el2} 
	{assign var=oPlayercard value=$oPlayer->getPlayercard()}
	{assign var=oUser value=$oPlayercard->getUser()}	
	<tr>
		<td class="cell-name"> 
			<div class="name" >
				<a href="{$oUser->getUserWebPath()}" data-rel="tooltip" data-html="true" data-title="<img src='{$oPlayercard->getFotoUrl()}'/>">
					{$oUser->getLogin()} {$oPlayercard->getFullFio()}
				</a>
			</div>
		</td>
	</tr>
{/foreach}
*}
</table>
{/if}

{include file='footer.tpl'}