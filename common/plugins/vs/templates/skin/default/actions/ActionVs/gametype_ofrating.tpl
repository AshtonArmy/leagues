{include file='header.tpl' menu='blog'}
{assign var=bNoSidebar value=true}
{literal}
<style>
#content {width:100%;}
#main-content{margin:0;}
</style>
{/literal}
{*<div class="turnirmenu">
	<ul>
		<li><a href="{$link}"><span class="bgl"></span><span class="bgi">В блогах</span><span class="bgr"></span></a></li>
		<li><a href="{$link_blogiturnirov}"><span class="bgl"></span><span class="bgi">Турниры</span><span class="bgr"></span></a></li>
		<li><a href="{$link_nastroiki}"><span class="bgl"></span><span class="bgi">Настройки</span><span class="bgr"></span></a></li>
		<li><a href="{$link_tovarki}"><span class="bgl"></span><span class="bgi">Товарищеские</span><span class="bgr"></span></a></li>
		<li><a href="{$link_rating}"><span class="bgl"></span><span class="bgi">Рейтинг</span><span class="bgr"></span></a></li>
		<li class="active"><a href="{$link_ofrating}"><span class="bgl"></span><span class="bgi">Оф.рейтинг</span><span class="bgr"></span></a></li>
	</ul>
</div>*}
{include file="$sTemplatePathPlugin/actions/ActionVs/gametype_menu.tpl"  whats="ofrating"}
<div align="center">
{if $aRating}

<table  cellspacing="0" class="raspisanie" id="allteams" width="100%">
<thead>
<tr>
	<th class="lside" width="11"></th>
	<th class="cside" align="center">№</th>
	<th class="cside" align="center">Ник</th>	
	<th class="cside">ID</th>
	<th class="cside" align="center">Рейтинг</th>
	<th class="cside" align="center">W</th>
	<th class="cside" align="center">L</th>
	<th class="cside" align="center">T</th>
	<th class="cside" align="center">Gp</th>
	<th class="cside" align="center">Gf</th>
	<th class="cside" align="center">Ga</th>
	<th class="cside" align="center">Agf</th>
	<th class="cside" align="center">Aga</th>
	<th class="cside" align="center">Hits</th>
	<th class="cside" align="center">Hpg</th>
	<th class="cside" align="center">Pimpg</th>
	<th class="cside" align="center">Pp</th>
	<th class="cside" align="center">Pk</th>	
	<th class="cside" align="center">Shtpg</th>
	<th class="cside" align="center">Shtp</th>
	<th class="cside" align="center">Atoa</th>
	<th class="cside" align="center">Papg</th>
	<th class="cside" align="center">Passp</th>
	<th class="cside" align="center">Fop</th>
	<th class="rside" width="11"></th>
</tr>
</thead>
{assign var=className value='vlight'}
{assign var=number value=1}
{foreach from=$aRating item=oRating name=el2}
{assign var=oUser value=$oRating->getUser()}
<tr>
	<td width="11"></td>
	<td class="{$className}" align="center" width="30">{$number}</td>
	<td class="{$className}" width="80"><a class="authors" href="http://virtualsports.ru/profile/{$oUser->getLogin()}/" target="_blank">{$oUser->getLogin()}</a></td>	
	<td class="{$className}" width="80"><b>{$oRating->getPsnid()}</b></td>
	<td class="{$className}" width="40" align="center"><b>{$oRating->getOvrskillpoints()}</b></td>
	<td class="{$className}" align="center">{$oRating->getWins()}</td>
	<td class="{$className}" align="center">{$oRating->getLosses()}</td>
	<td class="{$className}" align="center">{$oRating->getTies()}</td>
	<td class="{$className}" align="center">{$oRating->getGp()}</td>
	<td class="{$className}" align="center">{$oRating->getGf()}</td>
	<td class="{$className}" align="center">{$oRating->getGa()}</td>
	<td class="{$className}" align="center">{$oRating->getAgf()}</td>
	<td class="{$className}" align="center">{$oRating->getAga()}</td>
	<td class="{$className}" align="center">{$oRating->getHits()}</td>
	<td class="{$className}" align="center">{$oRating->getHitspg()}</td>
	<td class="{$className}" align="center">{$oRating->getPimpg()}</td>
	<td class="{$className}" align="center">{$oRating->getPp()}%</td>
	<td class="{$className}" align="center">{$oRating->getPk()}%</td>
	<td class="{$className}" align="center">{$oRating->getShtpg()}</td>
	<td class="{$className}" align="center">{$oRating->getShtp()}%</td>
	<td class="{$className}" align="center">{$oRating->getAtoa()}</td>
	<td class="{$className}" align="center">{$oRating->getPapg()}</td>
	<td class="{$className}" align="center">{$oRating->getPassp()}%</td>
	<td class="{$className}" align="center">{$oRating->getFop()}%</td>
	<td width="11"></td>
</tr>
{assign var=number value=$number+1}
{/foreach}
</table>
<span  class="smalltext">
 <b>W</b> - победы,
 <b>L</b> - поражения,
 <b>T</b> - поражения в дополнительное время,
 <b>Gp</b> - всего игр,
 <b>Gf</b> - голов забито,
 <b>Ga</b> - голов пропущено,
 <b>Agf</b> - в среднем забито за матч,
 <b>Aga</b> - в среднем пропущено за матч,
 <b>Hits</b> -хитов,
 <b>Hpg</b> - хитов за матч,
 <b>Pimpg</b> - штрафных минут за матч,
 <b>Pp</b> - процент реализации большиства,
 <b>Pk</b> - процент в меньшинстве,
 <b>Shtpg</b> - бросков за матч,
 <b>Shtp</b> - процент реализации бросков,
 <b>Atoa</b> - время в атаке,
 <b>Papg</b> - пасов за матч,
 <b>Passp</b> - процент успешных пасов,
 <b>Fop</b> - процент выйгранных вбрасываний
</span>
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