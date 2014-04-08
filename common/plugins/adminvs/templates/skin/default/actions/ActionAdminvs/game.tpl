{include file='header.tpl' menu='adminvs'}
{if $do==''} 
<a href="{router page='adminvs'}game/add/"><b>Добавить</b></a>
{if $oGames}
<table width="100%" cellspacing="0" class="admin-table">
<tr style="font-weight:bold;">
        <th>ID</th>
        <th>Полное название</th>
		<th>Сокращенное</th>
		<th>Действие</th>
    </tr>
    {foreach from=$oGames item=oGame name=el2}
    {if $smarty.foreach.el2.iteration % 2  == 0}
     	{assign var=className value=''}
    {else}
     	{assign var=className value='colored'}
    {/if}
	    <tr class="{$className}" >
        <td style="text-align:center;"> <a href="{router page='adminvs'}game/edit/{$oGame.game_id}">{$oGame.game_id}</a></td>
        <td style="text-align:center;"> {$oGame.name} &nbsp;</td>
		<td style="text-align:center;"> {$oGame.brief} &nbsp;</td>
		<td style="text-align:center;"> <a href="{router page='adminvs'}game/delete/{$oGame.game_id}">Удалить</a></td>
        
    </tr>
    {/foreach}
	
</table>
{else}
	пусто	
{/if}

{/if}
{if $do=='add'}
	<form action="{router page='adminvs'}game/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
		<p>
           <input type="text" name="name" value="" />&nbsp;Название
        </p>
		<p>
            <input type="text" name="brief" value="" />&nbsp;Сокращенное
        </p>
		<p>
			<select  name="platform_id">
			{foreach from=$oPlatform item=Platform}   
				<option value="{$Platform->getId()}">{$Platform->getName()}</option>
			{/foreach}
			</select>&nbsp;Платформа
        </p>
		<p>
			<select  name="sport_id">
			{foreach from=$oSport item=Sport}   
				<option value="{$Sport->getId()}">{$Sport->getName()}</option>
			{/foreach}
			</select>&nbsp;Спорт
        </p>
		<p>
		<input type="checkbox" id="oneplay" name="oneplay" class="checkbox" value="1"> - 1 на 1
		</p>
		<p>
		<input type="checkbox" id="hut" name="hut" class="checkbox" value="1"> - HUT
		</p>
		<p>
		<input type="checkbox" id="twoplay" name="twoplay" class="checkbox" value="1"> - 2 на 2
		</p>
		<p>
		<input type="checkbox" id="teamplay" name="teamplay" class="checkbox" value="1"> - тимплей
		</p>
		<p class="buttons">
            <input type="submit" name="4game" value="Добавить" />&nbsp;
        </p>
	</form>
{/if}
{if $do=='edit'}
	<form action="{router page='adminvs'}game/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
	    <input type="hidden" name="game_id" value="{$oGame->getId()}" />		
		<p>
           <input type="text" name="name" value="{$oGame->getName()}" />&nbsp;Название
        </p>
		<p>
            <input type="text" name="brief" value="{$oGame->getBrief()}" />&nbsp;Сокращенное
        </p>
		<p>
			<select  name="platform_id">
			{foreach from=$oPlatform item=Platform}   
				<option value="{$Platform->getId()}" {if $Platform->getId()==$oGame->getPlatformId()} SELECTED{/if}>{$Platform->getName()}</option>
			{/foreach}
			</select>&nbsp;Платформа
        </p>
		<p>
			<select  name="sport_id">
			{foreach from=$oSport item=Sport}   
				<option value="{$Sport->getId()}"{if $Sport->getId()==$oGame->getSportId()} SELECTED{/if}>{$Sport->getName()}</option>
			{/foreach}
			</select>&nbsp;Спорт
        </p>
		<p>
		<input type="checkbox" id="oneplay" name="oneplay" class="checkbox" value="1" {if $oGame->getOneplay()}checked="yes"{/if} > - 1 на 1
		</p>
		<p>
		<input type="checkbox" id="hut" name="hut" class="checkbox" value="1" {if $oGame->getHut()}checked="yes"{/if} > - HUT
		</p>
		<p>
		<input type="checkbox" id="twoplay" name="twoplay" class="checkbox" value="1" {if $oGame->getTwoplay()}checked="yes"{/if}> - 2 на 2
		</p>
		<p>
		<input type="checkbox" id="teamplay" name="teamplay" class="checkbox" value="1" {if $oGame->getTeamplay()}checked="yes"{/if}> - тимплей
		</p>		
		
		<p class="buttons">
            <input type="submit" name="4game" value="Сохранить" />&nbsp;
        </p>
	</form>
{/if}
{if $do=='delete'}
	<form action="{router page='adminvs'}game/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
	    <input type="hidden" name="game_id" value="{$oGame->getId()}" />		
		<p>
           <input type="text" name="name" value="{$oGame->getName()}" disabled="disabled" />&nbsp;Название
        </p>
		<p>
            <input type="text" name="brief" value="{$oGame->getBrief()}" disabled="disabled" />&nbsp;Сокращенное
        </p>
		<p class="buttons">
            <input type="submit" name="4game" value="Удалить" />&nbsp;
        </p>
	</form>
{/if}
{include file='footer.tpl'}

