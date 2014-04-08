
{if $oFutureMatch}
{assign var=oAwayTeam value=$oFutureMatch->getAwayteam()}
{assign var=oHomeTeam value=$oFutureMatch->getHometeam()} 
<table width="100%">
<tr>
<td colspan="4" align="center"><b>Next match</b></td>
</th>
<tr class="odd" height="10">
  <td class="mid" width="35" align="left"><img width="32" src="{cfg name='path.root.web'}/images/teams/small/{$oAwayTeam->getLogo()}" alt="" align="absmiddle"></td> 
  {*<td class="mid" align="left" width="40"><b>{$oAwayTeam->getName()}</b></td>*}
  <td class="mid" align="center" colspan="2" width="40">{if $oFutureMatch->getPlayed()==1}<b><font color="#184e8d" size="4">{$oFutureMatch->getGoalsAway()} : {$oFutureMatch->getGoalsHome()}{if $oFutureMatch->getSo()==1} SO{/if}{if $oFutureMatch->getOt()==1} ОТ{/if}{if $oFutureMatch->getTeh()==1} тех.{/if}</font></b>{else}{/if}</td>
  {*<td class="mid" align="right" width="40"><b>{$oHomeTeam->getName()}</b></td>*}
  <td class="mid" width="35" align="right"><img width="32" src="{cfg name='path.root.web'}/images/teams/small/{$oHomeTeam->getLogo()}" alt="" align="absmiddle"></td> 
</tr>
</table>
{/if}

{if $aLastMatch}


<table width="100%">
<tr>
<td colspan="4" align="center"><b>Last matches</b></td>
</th>
{foreach from=$aLastMatch item=oLastMatch name=el2}
{assign var=oAwayTeam value=$oLastMatch->getAwayteam()}
{assign var=oHomeTeam value=$oLastMatch->getHometeam()} 
<tr class="odd" height="10">
  <td class="mid" width="35" align="left"><img width="32" src="{cfg name='path.root.web'}/images/teams/small/{$oAwayTeam->getLogo()}" alt="" align="absmiddle"></td> 
  {*<td class="mid" align="left" width="40"><b>{$oAwayTeam->getName()}</b></td>*}
  <td class="mid" align="center" colspan="2" width="40">{if $oLastMatch->getPlayed()==1}<b><font color="#184e8d" size="4">{$oLastMatch->getGoalsAway()} : {$oLastMatch->getGoalsHome()}{if $oLastMatch->getSo()==1} SO{/if}{if $oLastMatch->getOt()==1} ОТ{/if}{if $oLastMatch->getTeh()==1} тех.{/if}</font></b>{else}{/if}</td>
  {*<td class="mid" align="right" width="40"><b>{$oHomeTeam->getName()}</b></td>*}
  <td class="mid" width="35" align="right"><img width="32" src="{cfg name='path.root.web'}/images/teams/small/{$oHomeTeam->getLogo()}" alt="" align="absmiddle"></td> 
</tr>
{/foreach}
</table>
{/if}
{if $oPlayers}
	<table id=tbl style="padding: 0; width: 100%; margin: 0 0 5px 0;">
	{foreach from=$oPlayers item=oPlayer name=el2}
	{assign var=oUser value=$oPlayer->getUser()}
	{assign var=oPlayercard value=$oPlayer->getPlayercard()}
	<tr>
		<td>
			<img class="rounded" width="20" src="{$oPlayercard->getFotoUrl()}" alt="" class="avatar" />
		</td>
		<td>
			{$oPlayercard->getFullFio()} (<a id="inline_userlink" href="{router page='profile'}{$oUser->getLogin()}" target="_new">{$oUser->getLogin()}</a></strong>) <b>{if $oPlayer->getCap()==1}A {/if}{if $oPlayer->getCap()==2}C {/if}</b>
		</td>
	</tr>
	{/foreach}
	</table>
{/if}
{if $oTeamsintournament}
{assign var=oUser value=$oTeamsintournament->getUser1()}
{assign var=oTeam value=$oTeamsintournament->getTeam()}
{if $oTeamsintournament->getUser1()}
<table id=tbl style="padding: 0; width: 100%; margin: 0 0 5px 0;">
	<tr id=tbl_tr>
		<td id="td_text_head">
			<p id=inga style="background-color: white; height:65px; padding: 5px 0 5px 69px; background: url({$oUser->getProfileAvatarPath(64)}) left top no-repeat;">
			<strong id=inga style="font-size: 18px; font-family: Verdana, Tahoma, sans-serif; letter-spacing: -1px; color: #aaa; ">
			<a id="inline_userlink" href="{router page='profile'}{$oUser->getLogin()}" target="_new">{$oUser->getLogin()}</a></strong><br/>
			<span class="small_text">Зарегистрирован: {$oUser->getDateRegister()|date_format:"%e %B %Y"}</span>
			</p>
		</td>
	</tr>
	<tr>
		<td>
			<strong>Rating</strong>: {$rating} {if isset($position)}({$position}-й){/if}<br/>
			<strong>ID (в турнире)</strong>: {$psnid} <br/>
		 
			{assign var="aUserFieldContactValues" value=$oUser->getUserFieldValues(true,array('contact'))}
			{if $aUserFieldContactValues}
				<h2 class="header-table">{$aLang.profile_contacts}</h2>
				
				<table class="">
					{foreach from=$aUserFieldContactValues item=oField}
						<tr>
							<td class="cell-label"><i class="icon-contact icon-contact-{$oField->getName()}"></i> {$oField->getTitle()|escape:'html'}:</td>
							<td>{$oField->getValue(true,true)}</td>
						</tr>
					{/foreach}
				</table>
			{/if}
{*
				<ul>
				{if $oUser->getProfileIcq()}				
					{if $oUser->getProfileIcq()}
						<li class="icq"><a href="http://www.icq.com/people/about_me.php?uin={$oUser->getProfileIcq()|escape:'html'}" target="_blank">{$oUser->getProfileIcq()}</a></li>
					{/if}					
				
				{/if}
				{if count($aUserFields)}
                    {foreach from=$aUserFields item=oField}
                            <li class="{$oField->getName()|escape:'html'}">{$oField->getValue(true,true)}</li>
                    {/foreach}
                {/if}
				</ul>
*}
			 
		</td>
	</tr>
</table>
{else}
У команды нет владельца
{/if}
{else}
{/if}
{if $Users} 
{if $oUser}
<table id=tbl style="padding: 0; width: 100%; margin: 0 0 5px 0;">
	<tr id=tbl_tr>
		<td id="td_text_head">
			<p id=inga style="background-color: white; height:65px; padding: 5px 0 5px 69px; background: url({$oUser->getProfileAvatarPath(64)}) left top no-repeat;">
			<strong id=inga style="font-size: 18px; font-family: Verdana, Tahoma, sans-serif; letter-spacing: -1px; color: #aaa; ">
			<a id="inline_userlink" href="http://virtualsports.ru/profile/{$oUser->getLogin()}" target="_new">{$oUser->getLogin()} </a></strong><br/>
			<span class="small_text">Зарегистрирован: {$oUser->getDateRegister()|date_format:"%e %B %Y"}</span>
			</p>
		</td>
	</tr>
	<tr>
		<td>
			<strong>ID (in tournament)</strong>: {$psnid} <br/>
			{assign var="aUserFieldContactValues" value=$oUser->getUserFieldValues(true,array('contact'))}
			{if $aUserFieldContactValues}
				<h2 class="header-table">{$aLang.profile_contacts}</h2>
				
				<table class="">
					{foreach from=$aUserFieldContactValues item=oField}
						<tr>
							<td class="cell-label"><i class="icon-contact icon-contact-{$oField->getName()}"></i> {$oField->getTitle()|escape:'html'}:</td>
							<td>{$oField->getValue(true,true)}</td>
						</tr>
					{/foreach}
				</table>
			{/if}
			{*
			<div class="block contacts">
				<ul>
				{if $oUser->getProfileIcq()}				
					{if $oUser->getProfileIcq()}
						<li class="icq"><a href="http://www.icq.com/people/about_me.php?uin={$oUser->getProfileIcq()|escape:'html'}" target="_blank">{$oUser->getProfileIcq()}</a></li>
					{/if}					
				
				{/if}
				{if count($aUserFields)}
                    {foreach from=$aUserFields item=oField}
                            <li class="{$oField->getName()|escape:'html'}">{$oField->getValue(true,true)}</li>
                    {/foreach}
                {/if}
				</ul>
			</div>*}
		</td>
	</tr>
</table>
{else}
У команды нет владельца
{/if}
{else}
{/if}