{include file='header.tpl' menu='adminvs'}
{if $do==''} 
<a href="{router page='adminvs'}advert/add/"><b>Добавить</b></a>
{if $aAdverts}
<table width="100%" cellspacing="0" class="admin-table">
<tr style="font-weight:bold;">
        <th>ID</th>
        <th>Текст</th>
		<th>От чьего имени</th>
		<th>Сортировка</th>
		<th>Действие</th>
    </tr>
    {foreach from=$aAdverts item=oAdvert name=el2}
		{assign var="oUser" value=$oAdvert->getUser()} 
	    <tr class="{$className}" >
        <td style="text-align:center;"><a href="{router page='adminvs'}advert/edit/{$oAdvert->getAdvertId()}">{$oAdvert->getAdvertId()}</a></td>
        <td style="text-align:center;">{$oAdvert->getText()}</td>
		<td style="text-align:center;">{$oAdvert->getUser()->getLogin()}</td>
		<td style="text-align:center;">{$oAdvert->getSorter()}</td>
		<td style="text-align:center;"><a href="{router page='adminvs'}advert/delete/{$oAdvert->getAdvertId()}">Удалить</a></td>
        
    </tr>
    {/foreach}
	
</table>
{else}
	пусто	
{/if}

{/if}
{if $do=='add' || $do=='edit' }
	<form action="{router page='adminvs'}advert/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
		<p>
           <input type="text" name="text" value="{if $oAdvert}{$oAdvert->getText()}{/if}" />&nbsp;Текст
        </p>
		<p>
            <input type="text" name="sort" value="{if $oAdvert}{$oAdvert->getSorter()}{/if}" />&nbsp;Сортировка
        </p>
		<p> 
			<input type="text" class="input-wide autocomplete-users" id="user" name="user" value="{if $oAdvert}{$oAdvert->getUser()->getLogin()}{/if}" />
			Юзер
        </p>
		<p>
			<select  name="topic_id">
			<option value="0">-</option>
			{foreach from=$aTopics item=oTopic}   
			<option value="{$oTopic->getTopicId()}" {if $oAdvert && $oAdvert->getTopicId()==$oTopic->getTopicId()} SELECTED{/if}>{$oTopic->getTitle()}</option>{/foreach}
			</select>&nbsp;Топик
        </p>
		{if $oAdvert}
			<input type="hidden" name="advert_id" value="{$oAdvert->getAdvertId()}" />	
		{/if}
		<p class="buttons">
            <input type="submit" name="4advert" value="{if $oAdvert}Сохранить{else}Добавить{/if}" />&nbsp;
        </p>
	</form>
{/if}

{if $do=='delete'}
	<form action="{router page='adminvs'}advert/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
	    <input type="hidden" name="advert_id" value="{$oAdvert->getAdvertId()}" />		
		<p>
           <input type="text" name="text" value="{$oAdvert->getText()}" disabled="disabled" />&nbsp;Текст
        </p> 
		<p class="buttons">
            <input type="submit" name="4advert" value="Удалить" />&nbsp;
        </p>
	</form>
{/if}
{include file='footer.tpl'}

