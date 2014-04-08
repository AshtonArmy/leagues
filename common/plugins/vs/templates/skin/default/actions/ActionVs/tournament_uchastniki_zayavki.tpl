{include file='header.tpl' menu='blog'}
{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats='uchastniki'}
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

 $(".multiselect").multiselect({height:auto;}); 
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




{if $oPlayerTournament}
<br/>
<form action="javascript:Add();" style="border: none;">
					<dl>
						<dt>Выберите предпочитаемые команды :</dt>
						<dd>
<br/>						
<select id="teams" class="multiselect" multiple="multiple" name="teams[]" style="height:500px;">
{if $aTeamPrioritet}
{foreach from=$aTeamPrioritet item=oTeamPrioritet name=el2}
	{assign var=oTeam value=$oTeamPrioritet->getTeam()}
 <option value="{$oTeam->getTeamId()}" selected="selected">{if $oTeam->getLogo() !=""}<img height="20" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/>{/if}{$oTeam->getName()}
 {foreach from=$zanytue item=zanytaya}
		{if $oTeam->getTeamId()==$zanytaya}<span class="smalltext">Занято</span>{/if}
	{/foreach}</option>

{/foreach}
{/if}

{if $aTeamInTournament}

{foreach from=$aTeamInTournament item=oTeamInTournament name=el2}
{assign var=oTeam value=$oTeamInTournament->getTeam()}
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