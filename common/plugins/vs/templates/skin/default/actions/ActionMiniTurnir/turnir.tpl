{include file='header.tpl' menu='blog'}
{assign var="Tovarki" value='1'}
{*{include file="$sTemplatePathPlugin/actions/ActionVs/gametype_menu.tpl"  whats="tovarki"}*}
<div class="button_top underline">
{foreach from=$aGametype item=oGametypeOne name=el2}
		<div class="left {if $whats==$oGametypeOne.brief}active{/if}">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href=" /miniturnir/{$oGame->getBrief()}/{$oGametypeOne.brief}">{$oGametypeOne.name}</a></div>
		</div>
{/foreach}
</div>

<ul class="block-nav">	
{foreach from=$aStavki item=oStavki name=el2}
<li {if $oStavki.stavka==$aStavka}class="active"{/if}><a href="#" id="block_stream_topic" onclick="updatetableTovarki(this,{$oStavki.stavka}); return false;">{$oStavki.stavka} р.</a></li>
{/foreach}
 </ul>			
<div class="login-form jqmWindow" id="tovarmatch_form">
	<a href="#" class="close jqmClose"></a>
	<div id="divmatchvyzov"></div><br />
	<form action="javascript:save_vyzov();" >
		<p>
			<textarea id="match_comment" class="comment_textarea" cols="1" rows="1"></textarea>
		</p>
		
		<input type="hidden" name="match_sopernik" id="match_sopernik"/>
		<input type="submit" name="submit_login" class="button" value="Challenge" /><br />
	</form>
</div>

<div class="login-form jqmWindow" id="tovarmatch_otvet_form">
	<a href="#" class="close jqmClose"></a> 
	<form action="javascript:return false;" >
		<div id="divmatchvyzov_otvet"></div><br />
		<p>
			<textarea id="match_comment_your" class="comment_textarea" cols="1" rows="1"></textarea>
		</p>
		
		<input type="hidden" name="vyzov_id" id="vyzov_id"/>
		<input type="submit" name="submit_login" class="button" onClick="save_vyzov_otvet(2)" value="Decline" /> 
		<input type="submit" name="submit_login" class="button" onClick="save_vyzov_otvet(1)" value="Accept" /><br />
	</form>
</div>

<div id="tovarki_table">
{insert name="block" block="tovarkitableloader" params=$par}
</div>

<style>
{literal}
h1.line {
    border-bottom: 1px solid #BFBFBF;
}
{/literal}
</style>

<script>
{literal}
var global_stavka={/literal}{$aStavka}{literal};
var miniturnir_game_for_hover={/literal}{$oGame->getGameId()}{literal};
var miniturnir_gametype_for_hover={/literal}{$oGameType->getGametypeId()}{literal};
var tournament_for_hover=0;

function pay_miniturnir(miniturnir_id,stavka){
		var params = {}; 
		params['miniturnir_id']=miniturnir_id;
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;
 
		ls.ajax(aRouter['ajax']+'pay/stavka/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg);
			} else { 
				ls.msg.notice(result.sMsgTitle,result.sMsg); 
				updatetableTovarki(0,stavka);
			}
		});	
}
function change_status(miniturnir_id,stavka){
		var params = {}; 
		params['miniturnir_id']=miniturnir_id;
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;
 
		ls.ajax(aRouter['ajax']+'change/status/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg);
			} else { 
				ls.msg.notice(result.sMsgTitle,result.sMsg); 
				updatetableTovarki(0,stavka);
			}
		});	
}
function back(miniturnir_id,stavka){
		var params = {}; 
		params['miniturnir_id']=miniturnir_id;
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;
 
		ls.ajax(aRouter['ajax']+'change/back/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg);
			} else { 
				ls.msg.notice(result.sMsgTitle,result.sMsg);
				updatetableTovarki(0,stavka);				
			}
		});	
}
{/literal}
</script>
{include file='footer.tpl'}
 