{include file='header.tpl' menu='adminvs'}
{if $do==''} 
<a href="{router page='adminvs'}turnir/add/"><b>Добавить</b></a>
{if $oTournaments}
<table width="100%" cellspacing="0" class="admin-table">
<tr style="font-weight:bold;">
        <th>ID</th>
        <th>Полное название</th>
		<th>Сокращенное</th>
		<th>Действие</th>
    </tr>
    {foreach from=$oTournaments item=oTournament name=el2}
    {if $smarty.foreach.el2.iteration % 2  == 0}
     	{assign var=className value=''}
    {else}
     	{assign var=className value='colored'}
    {/if}
	    <tr class="{$className}" >
        <td style="text-align:center;"> <a href="{router page='adminvs'}turnir/edit/{$oTournament.tournament_id}">{$oTournament.tournament_id}</a></td>
        <td style="text-align:center;"> {$oTournament.name} &nbsp;</td>
		<td style="text-align:center;"> {$oTournament.url} &nbsp;</td>
		<td style="text-align:center;"> <a href="{router page='adminvs'}turnir/delete/{$oTournament.tournament_id}">Удалить</a></td>
        
    </tr>
    {/foreach}
	
</table>
{else}
	пусто	
{/if}

{/if}
{if $do=='add'}
	<form action="{router page='adminvs'}turnir/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
		<p>
           <input type="text" name="name" value="" />&nbsp;Название
        </p>
		<p>
            <input type="text" name="brief" value="" />&nbsp;Сокращенное
        </p>
		<p>
            <input type="text" name="url" value="" />&nbsp;URL
        </p>
		<p>
			<select  name="gametype_id">
			{foreach from=$oGametype item=Gametype}   
				<option value="{$Gametype->getId()}">{$Gametype->getName()}</option>
			{/foreach}
			</select>&nbsp;Тип турнира
        </p>
		<p>
			<select  name="game_id">
			{foreach from=$oGame item=Game}   
				<option value="{$Game->getId()}">{$Game->getName()}_{foreach from=$oPlatform item=Platform}   
									{if $Game->getPlatformId()== $Platform->getId()}{$Platform->getName()} {/if}{/foreach}</option>
			{/foreach}
			</select>&nbsp;Игра
        </p>
		<p>
			<select  name="blog_id">
			<option value="0">-</option>
			{foreach from=$aBlogs item=oBlog}   
			<option value="{$oBlog->getBlogId()}">{$oBlog->getTitle()}</option>{/foreach}
			</select>&nbsp;Блог
        </p>
{*
		<p>
            <input type="text" name="win" value="" size="1"/>&nbsp;Очки за победу
        </p>
		<p>
            <input type="text" name="win_o" value="" size="1"/>&nbsp;Очки за победу в ОТ
        </p>
		<p>
            <input type="text" name="lose_o" value="" size="1"/>&nbsp;Очки за поражение в ОТ
        </p>
		<p>
            <input type="text" name="points_n" value="" size="1"/>&nbsp;Очки за ничью
        </p>
		<p>
            <input type="text" name="goals_teh_w" value="" size="1"/>&nbsp;Голов за тех. победу
        </p>
		<p>
            <input type="text" name="goals_teh_l" value="" size="1"/>&nbsp;Голов за тех. поражение
        </p>
		<p>
            <input type="text" name="goals_teh_n" value="" size="1"/>&nbsp;Голов за тех. ничью
        </p>
		<p>
		<input type="checkbox" id="nichya" name="nichya" class="checkbox" value="1"> - ничьи возможны
		</p>
*}
		<p class="buttons">
            <input type="submit" name="4tournament" value="Добавить" />&nbsp;
        </p>
	</form>
{/if}
{if $do=='edit'}
	
	<form action="{router page='adminvs'}turnir/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
		<input type="hidden" name="tournament_id" value="{$oTournament->getTournamentId()}" />
		<p>
           <input type="text" name="name" value="{$oTournament->getName()}" />&nbsp;Название
        </p>
		<p>
            <input type="text" name="brief" value="{$oTournament->getBrief()}" />&nbsp;Сокращенное
        </p>
		<p>
            <input type="text" name="url" value="{$oTournament->getUrl()}" />&nbsp;URL
        </p>
		<p>
			<select  name="gametype_id">
			{foreach from=$oGametype item=Gametype}   
				<option value="{$Gametype->getId()}" {if $Gametype->getId()==$oTournament->getGametype()} SELECTED{/if}>{$Gametype->getName()}</option>
			{/foreach}
			</select>&nbsp;Тип турнира
        </p>
		<p>
			<select  name="game_id">
			{foreach from=$oGame item=Game}   
				<option value="{$Game->getId()}" {if $Game->getId()==$oTournament->getGameId()} SELECTED{/if}>{$Game->getName()}_{foreach from=$oPlatform item=Platform}   
									{if $Game->getPlatformId()== $Platform->getId()}{$Platform->getName()} {/if}{/foreach}</option>
			{/foreach}
			</select>&nbsp;Игра
        </p>
		<p>
			<select  name="blog_id">
			<option value="0">-</option>
			{foreach from=$aBlogs item=oBlog}   
			<option value="{$oBlog->getBlogId()}" {if $oBlog->getBlogId()==$oTournament->getBlogId()} SELECTED{/if}>{$oBlog->getTitle()}</option>{/foreach}
			</select>&nbsp;Блог
        </p>
		<p> 
			<input type="text" class="input-wide autocomplete-users-sep" id="users" name="users"  value="{$aUsers}"/>
			Админы
        </p>
		<p class="buttons">
            <input type="submit" name="4tournament" value="Сохранить" />&nbsp;
        </p>
	</form>
{/if}
{if $do=='delete'}
	<form action="{router page='adminvs'}turnir/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
	    <input type="hidden" name="tournament_id" value="{$oTournament->getId()}" />		
		<p>
           <input type="text" name="name" value="{$oTournament->getName()}" disabled="disabled" />&nbsp;Название
        </p>
		<p>
            <input type="text" name="brief" value="{$oTournament->getBrief()}" disabled="disabled" />&nbsp;Сокращенное
        </p>
		<p class="buttons">
            <input type="submit" name="4tournament" value="Удалить" />&nbsp;
        </p>
	</form>
{/if}
{include file='footer.tpl'}

