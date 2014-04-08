{include file='header.tpl' menu_content='tournament'}
<br />
<p><b>{if !$oPlayerTournament and $Identifier!=""}Ваш {/if}
{if !$oPlayerTournament and $Identifier==""}Введите {/if}
{$Tag}:</b> <input type="text" id="psn" value="{if $oPlayerTournament}{$oPlayerTournament->getPsnid()}{/if}" onblur="savePsn()" /> 
{if !$oPlayerTournament and $Identifier!=""}<b>?</b> {/if}
<a href="javascript:savePsn();">{if !$oPlayerTournament and $Identifier!=""}Да{else}Сохранить{/if}</a></p>
{if $oPlayerTournament}
<form id="payform" action="javascript:pay();">
{if $oTournament->getVznos()>0}Участие в данном турнире стоит <b>{$oTournament->getVznos()|string_format:"%.2f"}</b> {if $oOperation}<br/>Вами уже внесено {abs($oOperation->getSumma())}{/if} <br/>
<input id="summa_vznosa" type="text" value="{if $oOperation}0{else}{$oTournament->getVznos()|string_format:"%.2f"}{/if}">
<input id="submit" type="submit" value="{if $Oplatil=='yes'}Доплатить{else}Оплатить{/if}" {*{if $Oplatil=='yes'}disabled="disabled"{/if}*}/>
	{if $Oplatil=='no'}
	<br/>
	<i>необходимо наличие данной суммы в <a href="http://virtualsports.ru/purse/" target="_blank">кошельке</a>. Как пополнить кошелек можно узнать на <a href="http://virtualsports.ru/page/koshelek" target="_blank">данной</a> страинце</i>
	{/if}
{/if}
</form>
{/if}
<script type="text/javascript">
{literal}
$(function(){

 $(".multiselect").multiselect({height:300}); 
  {/literal}
	{if !$oPlayerTournament or $oPlayerTournament->getPsnid()==''}
		$('#psn').val('{$Identifier}'); 
	{/if}
{literal}

});

function pay(){
}

$('#payform').submit(function(){
	var params = {};
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	params['summa_vznosa']=$('#summa_vznosa').val();
{/literal}
	params['tournament_id']={$Tournament};
{literal}

	ls.ajax(aRouter['ajax']+'pay/vznos/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg);
			} else { 
				ls.msg.notice(result.sMsgTitle,result.sMsg);
				location.reload();
				//$('#submit').attr('disabled', 'disabled');
			}
		});	
});

function savePsn(){
				var params = {};
				if($('#psn').val() !=''){
					params['psnid']= $('#psn').val();
					params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	{/literal}
					params['tournament']={$Tournament};
	{literal}
				ls.ajax(aRouter['ajax']+'setting/psn/', params, function(result){
								if (!result) {
									ls.msg.error('Error','Please try again later');
								}
								if (result.bStateError) {
									ls.msg.error('Error','Please try again later');
								} else { 
									ls.msg.notice(result.sMsgTitle,result.sMsg);
				{/literal}
									if("{if $oPlayerTournament}{$oPlayerTournament->getPsnid()}{/if}" == "")window.location.reload();
				{literal}
								}
							});

				}else{
					ls.msg.error('Error','необходимо указать {/literal}{$Tag}{literal}');
					$('#psn').focus();
				}
}
function Add(){
				var params = {};
				
					params['teams']= $('#teams').val();
					params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	{/literal}
					params['tournament']={$Tournament};
	{literal}
	
						ls.ajax(aRouter['ajax']+'setting/team/', params, function(result){
								if (!result) {
									ls.msg.error('Error','Please try again later');
								}
								if (result.bStateError) {
									ls.msg.error(result.sMsgTitle,result.sMsg);
								} else { 
									ls.msg.notice(result.sMsgTitle,result.sMsg);
								}
							});
							
}
{/literal}
</script>



{if isset($hut) && $hut==1}

	{if $gametype_id==4 }
	<i>1. Создайте клуб с тем же названием и аббревиатурой что и в игре. Кнопка "Добавить команду" ниже<br/>
2. Добавьте созданный клуб в приоритеты и нажмите сохранить</i>
	<br/>
	
	<a href="javascript:ShowAddTeam()"><b>{$aLang.plugin.vs.add_team}</b></a><br/>
	<div id="add_team" style="display: none; "></div>
	<br/>
	<div id="edit_team" style="display: none;"></div>
	<br/>
	
	<ul id="time_list">
		{foreach from=$aTeams item=oTeam name=el2}
			{if $smarty.foreach.el2.iteration % 2  == 0}
				{assign var=className value='odd'}
			{else}
				{assign var=className value='even'}
			{/if}
			<li>{if $oTeam->getLogo()!=''}<span ><img src="/images/teams/small/{$oTeam->getLogo()}" /></span>{/if} <span id="logo_{$oTeam->getTeamId()}" class="smalltext">{$oTeam->getLogo()}</span> <b><span id="name_{$oTeam->getTeamId()}">{$oTeam->getName()}</span></b> (<span id="brief_{$oTeam->getTeamId()}">{$oTeam->getBrief()}</span>) <a href="javascript:ShowEditTeam({$oTeam->getTeamId()});"><img src="/images/edit.png" /></a> <a href="javascript:delete_team({$oTeam->getTeamId()});"><img src="/images/delete.png" /></a></li>
		{/foreach}		
	</ul>



	{literal}
	<script type="text/javascript">
		function ShowAddTeam(){
			$('#edit_team').html('');
			$('#add_team').html("{/literal}<select id='team_logo' class='w70'>{foreach from=$aLogos item=oLogo name=el2}<option value='{$oLogo.logo}'>{$oLogo.logo}</option>{/foreach}</select> - логотип<br/>{literal}<input name='team_name' type='text' id='team_name' SIZE='20' maxlength='40'/> - полное наименование<br/><input name='team_brief' type='text' id='team_brief'   class='input-mini' SIZE='3' maxlength='4'/> - аббревиатура<br/>	<a href='javascript:SaveTeam(0)'>Создать</a> ");
			$('#add_team').toggle();
		}
		function ShowEditTeam(team_id){
			names=$('#name_'+team_id).html();
			briefs=$('#brief_'+team_id).html();
			logos=$('#logo_'+team_id).html();
			$('#add_team').html('');
			$('#edit_team').html("{/literal}<select id='team_logo' class='w70'><option value='"+logos+"'>"+logos+"</option>{foreach from=$aLogos item=oLogo name=el2}<option value='{$oLogo.logo}'>{$oLogo.logo}</option>{/foreach}</select> - логотип<br/>{literal}<input name='team_name' type='text' id='team_name' value='"+names+"' SIZE='20' maxlength='40'/> - полное название<br/><input name='team_brief' type='text' id='team_brief'  class='input-mini' value='"+briefs+"' SIZE='3' maxlength='4'/> - аббревиатура<br/>	<a href='javascript:SaveTeam("+team_id+")'>Сохранить</a> ");
			$('#edit_team').toggle();
		}

		function delete_team(team_id ){
			var params = {}; 
			params['team_id']=team_id;
			params['security_ls_key']=LIVESTREET_SECURITY_KEY;		
			ls.ajax(aRouter['ajax']+'setting/delete_hut_team/', params, function(result){
				if (!result) {
					ls.msg.error('Error','Please try again later');
				}
				if (result.bStateError) {
					ls.msg.error(result.sMsgTitle,result.sMsg);
				} else { 
			{/literal}
					ls.msg.notice('{$aLang.plugin.vs.saved}','');
			{literal}
					location.reload(true);
				}
			});	

		}
								
		function SaveTeam(team_id){
			var params = {};

			params['team_name']= $('#team_name').val(); 
			params['team_brief']= $('#team_brief').val();
			params['team_logo']= $('#team_logo').val();
			params['team_id']= team_id;
			params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	{/literal}
			params['sport_id']= {$oGame->getSportId()};
			params['gametype_id']= {$gametype_id};
			params['game_id']= {$oGame->getGameId()};
	{literal}

			ls.ajax(aRouter['ajax']+'setting/hut_team/', params, function(result){
				if (!result) {
					ls.msg.error('Error','Please try again later');
				}
				if (result.bStateError) {
					ls.msg.error(result.sMsgTitle,result.sMsg);
				} else { 
				{/literal}
					ls.msg.notice('{$aLang.plugin.vs.saved}','');
				{literal}
					location.reload(true);
				}
			});	

		}
	</script>
	{/literal}


	{/if}

{/if}
{if $oPlayerTournament}
<br/>
<form action="javascript:Add();" style="border: none;">
					<dl>
						<dt>Выберите предпочитаемые команды :</dt>
						<dd>
<br/>						
<select id="teams" class="multiselect" multiple="multiple" name="teams[]">
{if $aTeamPrioritet}
	{foreach from=$aTeamPrioritet item=oTeamPrioritet name=el2}
		{assign var=oTeam value=$oTeamPrioritet->getTeam()}
		{if $oTeam}
			 <option value="{$oTeam->getTeamId()}" selected="selected">{if $oTeam->getLogo() !=""}<img height="20" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/>{/if}{$oTeam->getName()}
			 {foreach from=$zanytue item=zanytaya}
				{if $oTeam->getTeamId()==$zanytaya}<span class="smalltext">Занято</span>{/if}
			{/foreach}</option>
		{/if}
	{/foreach}
{/if}

{if $aTeamInTournament}

{foreach from=$aTeamInTournament item=oTeamInTournament name=el2}
{assign var=oTeam value=$oTeamInTournament->getTeam()}
  <option value="{$oTeam->getTeamId()}">{if $oTeam->getLogo() !=""}<img height="20" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/>{/if}{$oTeam->getName()}</option>
 {/foreach}

{/if}

{if $aTeamHutInTournament}

	{foreach from=$aTeamHutInTournament item=oTeam name=el2}
		<option value="{$oTeam->getTeamId()}">{if $oTeam->getLogo() !=""}<img height="20" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/>{/if}{$oTeam->getName()}</option>
	{/foreach}

{/if}

</select>
</dd>

						<dd>
							<input type="submit" id="localSubmit" name="localSubmit" value="Сохранить список" />
						</dd>
					</dl>
				</form>

{/if}




{include file='footer.tpl'}