{include file='header.tpl' menu_content='tournament'}
{literal}
<style>
.column-container{
margin-left: 15px;
}
.column1 {
float: left;
width: 178px; 
}
.column1 .afc-block {
margin-top: 15px;
}
.column1 .game-tile {
margin-bottom: 45px;
}
.column2 {
float: left;
margin-left: 2px;
width: 178px;
}
.column2 .afc-block {
margin-top: 60px;
}
.column2 .game-tile {
margin-bottom: 145px;
}
.column3 {
float: left;
margin-left: 2px;
width: 178px;
}
.column3 .afc-block {
margin-top: 165px;
}
.column3 .game-tile {
margin-bottom: 350px;
}

.column4 {
float: left;
margin-left: 2px;
width: 178px;
}

.column4 .afc-block {
margin-top: 365px;
}
.column-container .cell {
/*background-color: #EDF5F8;*/
height: 18px;
margin-bottom: 7px;
padding: 7px 0 0 6px;
position: relative;
} 
</style>
{/literal}

<div class="column-container">
{if $aPlayoff}
{assign var=key value=0}
{assign var=round value=''}
{foreach from=$aPlayoff item=oPlayoff name=el2}
{if $round!=$oPlayoff.round and $round!=''}
		</div>
	</div>	
{/if}

{if $round!=$oPlayoff.round}
{assign var=key value=$key+1}
	<div class="column{$key}">
		<div class="afc-block">
{assign var=round value=$oPlayoff.round}
{/if}
			{if $oPlayoff.num % 2  == 1}		
			<div class="game-tile">
			{/if}
				<div class="cell">{if $oPlayoff.team_id!=0}<table><tr><td width="25"><img width="20" src="{cfg name='path.root.web'}/images/teams/small/{$oPlayoff.team->getLogo()}"/></td><td width="150"><a href="#" class="teamrasp">{$oPlayoff.team->getName()}</a></td><td width="20"> {$oPlayoff.wins|number_format}{/if}</td></tr></table></div>
			{if $oPlayoff.num % 2  == 0}	
			</div>
			{/if}


{/foreach}
		</div>
	</div>		
{/if}
</div>

{include file='footer.tpl'} 