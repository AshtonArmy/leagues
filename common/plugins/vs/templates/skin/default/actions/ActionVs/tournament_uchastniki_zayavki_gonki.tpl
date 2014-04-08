{include file='header.tpl' menu='blog'}
{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats='uchastniki'}
<br />
<p><b>{if !$oPlayerTournament and $Identifier!=""}Ваш {/if}
{if !$oPlayerTournament and $Identifier==""}Введите {/if}
PSN ID / Gametag:</b> <input type="text" id="psn" value="{if $oPlayerTournament}{$oPlayerTournament->getPsnid()}{/if}" onblur="savePsn()" /> 
{if !$oPlayerTournament and $Identifier!=""}<b>?</b> {/if}
<a href="javascript:savePsn();">{if !$oPlayerTournament and $Identifier!=""}Да{else}Сохранить{/if}</a></p>

<script type="text/javascript">
{literal}
$(function(){


	
  // choose either the full version
 // $(".multiselect").multiselect();
  // or disable some features
  //$(".multiselect").multiselect({sortable: true, searchable: true});
 $(".multiselect").multiselect({}); 
  {/literal}
	{if !$oPlayerTournament or $oPlayerTournament->getPsnid()==''}
		$('#psn').val('{$Identifier}');
		//$('psn').focus();
	{/if}
{literal}

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
					ls.msg.error('Error','необходимо указать PSN ID / Gametag');
					$('#psn').focus();
				}
}
function Add(){
//alert($('#teams').val());
				var params = {};
				
					params['teams']= [0];
					params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	{/literal}
					params['tournament']={$Tournament};
	{literal}
	
						ls.ajax(aRouter['ajax']+'setting/team/', params, function(result){
								if (!result) {
									ls.msg.error('Error','Please try again later');
								}
								if (result.bStateError) {
									ls.msg.error('Error','Please try again later');
								} else { 
									ls.msg.notice('Сохранено',' ');
								}
							});
							
}
{/literal}
</script>




{if $oPlayerTournament}
{*
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
*}
<form action="javascript:Add();" style="border: none;">
					<dl>
 

						<dd> 
							<br/><input type="submit" id="localSubmit" name="localSubmit" value="Подать заявку в турнир" />
						</dd>
					</dl>
				</form>

{/if}




{include file='footer.tpl'}