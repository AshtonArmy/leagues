<h1 class="title">Участие в турнирах</h1>
<table>
{assign var="oPreviousGame" value=""}
{foreach from=$aGameTournament item=oGameTournament}
{assign var="oGame" value=$oGameTournament.game}
{if $oGame!=$oPreviousGame && $oPreviousGame!=""}							
						</td>
					</tr>
{/if}
{if $oGame!=$oPreviousGame}
					<tr>
						<td class="var">{$oGame} ({$oGameTournament.platform})</td>
						<td>
{/if}

<a href="{cfg name='path.root.web'}/{$oGameTournament.bplatform}/{$oGameTournament.bgame}/{$oGameTournament.bgametype}/{$oGameTournament.blog_url}/">{$oGameTournament.tournament}</a>  ({$oGameTournament.psnid}, рейтинг {$oGameTournament.rating})
{if $oGame!=$oPreviousGame}<br/>{/if}

{assign var="oPreviousGame" value=$oGame}
{/foreach}
</table>
<br />