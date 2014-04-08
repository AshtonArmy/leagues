{if $aMatches}
<table id=tbl style="padding: 0; width: 300px; margin: 0 0 5px 0; font-size:9px;">

{foreach from=$aMatches item=oMatch name=el2}
{assign var=oAwayTeam value=$oMatch->getAwayteam()}
{assign var=oHomeTeam value=$oMatch->getHometeam()}
{assign var=oAwayUser value=$oMatch->getAwayuser()}
{assign var=oHomeUser value=$oMatch->getHomeuser()}
<tr class="odd" height="10">
  <td class="mid" width="35" align="left"><img width="32" src="{cfg name='path.root.web'}/images/teams/small/{$oAwayTeam->getLogo()}" alt="" align="absmiddle"></td> 
  <td class="mid" align="left" width="40"><b>{$oAwayTeam->getName()}</b></td>
  <td class="mid" align="center" colspan="2" width="40">{if $oMatch->getPlayed()==1}<b><font color="#184e8d" size="4">{$oMatch->getGoalsAway()} : {$oMatch->getGoalsHome()}{if $oMatch->getSo()==1} SO{/if}{if $oMatch->getOt()==1} ОТ{/if}{if $oMatch->getTeh()==1} тех.{/if}</font></b>{else}<a class="ddm" href="{$link_match}{$oMatch->getMatchId()}"><span class="icon icon47" style="margin-left: 60px;"></span></a>{*<a class="ddm" href="javascript:result_insert({$oMatch->getMatchId()},{$myteam});"><span class="icon icon185"></span></a>*}{/if}</td>
  <td class="mid" align="right" width="40"><b>{$oHomeTeam->getName()}</b></td>
  <td class="mid" width="35" align="right"><img width="32" src="{cfg name='path.root.web'}/images/teams/small/{$oHomeTeam->getLogo()}" alt="" align="absmiddle"></td> 
</tr>

{/foreach}
</table>
{if isset($oUser)}
Ваш соперник <a class="authors" target="_blank" href="http://virtualsports.ru/profile/{$oUser->getLogin()}/">{$oUser->getLogin()}</a>
<br/>
ID в турнире: <b>{$oPlayerTournament->getPsnid()}</b>
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
			</div>
{else}
{if $oMatch->getGametypeId()!=3}
В данный момент у команды соперника нет владельца.
{/if}
{/if}
{/if}