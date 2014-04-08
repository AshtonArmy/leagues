{*{if $aPlayercards}

<table> 

{assign var=number value=1}
{foreach from=$positions item=position name=el2}
<tr>

	<td class="td_team_center">{$position.brief}:<select id="player{$number}" name="{$position.brief}">
									<option value="0">Бот</option>
									{foreach from=$aPlayercards item=oPlayercards name=el2}
									{assign var=oUser value=$oPlayercards->getUser()}									
									<option value="{$oPlayercards->getPlayercardId()}">{$oPlayercards->getFio()} ({$oUser->getLogin()})</option>
									{/foreach}
									
								</select></td>
</tr>
<tr>
	<td class="td_team_center">
		{foreach from=$position.params item=param key=key name=el2}
		
			{$param}:<input name="{$key}{$number}" type="text" id="{$key}{$number}" size="5" value="0">
		
		{/foreach}
	</td>
  </tr>
{assign var=number value=$number+1}
{/foreach}
</table> 

{/if}*}