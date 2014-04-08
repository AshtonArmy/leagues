{include file='header.tpl' menu='blog'}
{*<div class="turnirmenu">
	<ul>
		<li><a href="{$link}"><span class="bgl"></span><span class="bgi">В блогах</span><span class="bgr"></span></a></li>
		<li><a href="{$link_blogiturnirov}"><span class="bgl"></span><span class="bgi">Турниры</span><span class="bgr"></span></a></li>
		<li><a href="{$link_nastroiki}"><span class="bgl"></span><span class="bgi">Настройки</span><span class="bgr"></span></a></li>
		<li><a href="{$link_tovarki}"><span class="bgl"></span><span class="bgi">Товарищеские</span><span class="bgr"></span></a></li>
		<li class="active"><a href="{$link_rating}"><span class="bgl"></span><span class="bgi">Рейтинг</span><span class="bgr"></span></a></li>
		<li><a href="{$link_ofrating}"><span class="bgl"></span><span class="bgi">Оф.рейтинг</span><span class="bgr"></span></a></li>
	</ul>
</div>*}
{*{include file="$sTemplatePathPlugin/actions/ActionVs/gametype_menu.tpl"  whats="rating"}*}
<div align="center">
{if $aRating}

<table  cellspacing="0" class="raspisanie" id="allteams">
<thead>
<tr>
	<th class="lside" width="11"></th>
	<th class="cside" align="center">№</th>
	<th class="cside" align="center">Ник</th>	
	<th class="cside" align="center">Рейтинг</th>
	<th class="cside">Кол-во матчей</th>
	<th class="rside" width="11"></th>
</tr>
</thead>
{assign var=className value='vlight'}
{assign var=number value=1}
{foreach from=$aRating item=oRating name=el2}
{assign var=oUser value=$oRating->getUser()}
<tr>
	<td  width="11"></td>
	<td class="{$className}" align="center" width="30">{$number}</td>
	<td class="{$className}" width="150"><a class="authors" href="http://virtualsports.ru/profile/{$oUser->getLogin()}/" target="_blank">{$oUser->getLogin()}</a></td>	
	<td class="{$className}" width="80" align="center"><b>{$oRating->getRating()}</b></td>
	<td class="{$className}" width="100" align="center">{$oRating->getMatches()}</td>
	<td width="11"></td>
</tr>
{assign var=number value=$number+1}
{/foreach}
</table>
{literal}
<script type="text/javascript"> 
	  	$(document).ready(function() 
			{ 
				$("#allteams").tablesorter(); 
			} 
		); 
 
</script> 
{/literal}
{else}
Извините, пока в рейтинге по данному типу турнира никого нет.
{/if}
</div>
{include file='footer.tpl'}