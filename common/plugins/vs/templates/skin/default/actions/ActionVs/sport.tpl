{include file='header.tpl' menu='adminvs'}
{if $do==''}

<a href="{router page='adminvs'}sport/add/"><b>{$aLang.plugin.vs.add}</b></a>
{if $oSports}
<table width="100%" cellspacing="0" class="admin-table">
<tr style="font-weight:bold;">
        <th>ID</th>
        <th>{$aLang.plugin.vs.full_name}</th>
		<th>{$aLang.plugin.vs.short_name}</th>
		<th>{$aLang.plugin.vs.action}</th>
    </tr>
    {foreach from=$oSports item=oSport name=el2}
    {if $smarty.foreach.el2.iteration % 2  == 0}
     	{assign var=className value=''}
    {else}
     	{assign var=className value='colored'}
    {/if}
	    <tr class="{$className}" >
        <td style="text-align:center;"> <a href="{router page='adminvs'}sport/edit/{$oSport.sport_id}">{$oSport.sport_id}</a></td>
        <td style="text-align:center;"> {$oSport.name} &nbsp;</td>
		<td style="text-align:center;"> {$oSport.brief} &nbsp;</td>
		<td style="text-align:center;"> <a href="{router page='adminvs'}sport/delete/{$oSport.sport_id}">{$aLang.plugin.vs.delete}</a></td>
        
    </tr>
    {/foreach}
	
</table>
{else}
	пусто	
{/if}

{/if}
{if $do=='add'}
	<form action="{router page='adminvs'}sport/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
		<p>
           <input type="text" name="name" value="" />&nbsp;{$aLang.plugin.vs.name}
        </p>
		<p>
            <input type="text" name="brief" value="" />&nbsp;{$aLang.plugin.vs.short_name}
        </p>
		<p class="buttons">
            <input type="submit" name="4sport" value="{$aLang.plugin.vs.add}" />&nbsp;
        </p>
	</form>
{/if}
{if $do=='edit'}
	<form action="{router page='adminvs'}sport/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
	    <input type="hidden" name="sport_id" value="{$oSport->getId()}" />		
		<p>
           <input type="text" name="name" value="{$oSport->getName()}" />&nbsp;{$aLang.plugin.vs.name}
        </p>
		<p>
            <input type="text" name="brief" value="{$oSport->getBrief()}" />&nbsp;{$aLang.plugin.vs.short_name}
        </p>
		<p class="buttons">
            <input type="submit" name="4sport" value="{$aLang.plugin.vs.save}" />&nbsp;
        </p>
	</form>
{/if}
{if $do=='delete'}
	<form action="{router page='adminvs'}sport/" method="POST">
	    <input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
	    <input type="hidden" name="sport_id" value="{$oSport->getId()}" />		
		<p>
           <input type="text" name="name" value="{$oSport->getName()}" disabled="disabled" />&nbsp;{$aLang.plugin.vs.name}
        </p>
		<p>
            <input type="text" name="brief" value="{$oSport->getBrief()}" disabled="disabled" />&nbsp;{$aLang.plugin.vs.short_name}
        </p>
		<p class="buttons">
            <input type="submit" name="4sport" value="{$aLang.plugin.vs.delete}" />&nbsp;
        </p>
	</form>
{/if}
{include file='footer.tpl'}

