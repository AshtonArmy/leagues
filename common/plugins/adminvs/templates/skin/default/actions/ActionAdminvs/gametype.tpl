{include file='header.tpl' menu='adminvs'}
{if $do==''} 
<a href="{router page='adminvs'}gametype/add/"><b>Добавить</b></a>
{if $oGametypes}
<table width="100%" cellspacing="0" class="admin-table">
<tr style="font-weight:bold;">
        <th>ID</th>
        <th>Полное название</th>
		<th>Сокращенное</th>
		<th>Действие</th>
    </tr>
    {foreach from=$oGametypes item=oGametype name=el2}
    {if $smarty.foreach.el2.iteration % 2  == 0}
     	{assign var=className value=''}
    {else}
     	{assign var=className value='colored'}
    {/if}
	    <tr class="{$className}" >
        <td style="text-align:center;"> <a href="{router page='adminvs'}gametype/edit/{$oGametype.gametype_id}">{$oGametype.gametype_id}</a></td>
        <td style="text-align:center;"> {$oGametype.name} &nbsp;</td>
		<td style="text-align:center;"> {$oGametype.brief} &nbsp;</td>
		<td style="text-align:center;"> <a href="{router page='adminvs'}gametype/delete/{$oGametype.gametype_id}">Удалить</a></td>
        
    </tr>
    {/foreach}
	
</table>
{else}
	пусто	
{/if}

{/if}
{if $do=='add'}
	<form action="{router page='adminvs'}gametype/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
		<p>
           <input type="text" name="name" value="" />&nbsp;Название
        </p>
		<p>
            <input type="text" name="brief" value="" />&nbsp;Сокращенное
        </p>
		<p class="buttons">
            <input type="submit" name="4gametype" value="Добавить" />&nbsp;
        </p>
	</form>
{/if}
{if $do=='edit'}
	<form action="{router page='adminvs'}gametype/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
	    <input type="hidden" name="gametype_id" value="{$oGametype->getId()}" />		
		<p>
           <input type="text" name="name" value="{$oGametype->getName()}" />&nbsp;Название
        </p>
		<p>
            <input type="text" name="brief" value="{$oGametype->getBrief()}" />&nbsp;Сокращенное
        </p>
		<p class="buttons">
            <input type="submit" name="4gametype" value="Сохранить" />&nbsp;
        </p>
	</form>
{/if}
{if $do=='delete'}
	<form action="{router page='adminvs'}gametype/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
	    <input type="hidden" name="gametype_id" value="{$oGametype->getId()}" />		
		<p>
           <input type="text" name="name" value="{$oGametype->getName()}" disabled="disabled" />&nbsp;Название
        </p>
		<p>
            <input type="text" name="brief" value="{$oGametype->getBrief()}" disabled="disabled" />&nbsp;Сокращенное
        </p>
		<p class="buttons">
            <input type="submit" name="4gametype" value="Удалить" />&nbsp;
        </p>
	</form>
{/if}
{include file='footer.tpl'}

