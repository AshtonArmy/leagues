{include file='header.tpl' menu='blog'}
{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats='uchastniki'}

<br/>
<form id="payform" action="javascript:pay();">
<input id="submit" type="submit" value="{if  $oPlayerTournament && $oPlayerTournament->getOtozvan()==0}Отозвать заявку{else}Подать заявку{/if}"/>
 
<br/>
	<i>необходимо заполнить  <a href="http://virtualsports.ru/settings/teamplay/hockey/ps3" target="_blank">карточку командного игрока</a></i>
 
</form>
 


<script type="text/javascript">
{literal}
$(function(){

 $(".multiselect").multiselect({}); 
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
{/literal}
	params['tournament_id']={$Tournament};
{literal}

	ls.ajax(aRouter['ajax']+'into/tournament/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg);
			} else { 
				ls.msg.notice(result.sMsgTitle,result.sMsg);
				if($('#submit').val()=='Отозвать заявку'){$text='Подать заявку';}else{$text='Отозвать заявку';}
				$('#submit').val($text); 
			}
		});	
});

</script>
{/literal}
{include file='footer.tpl'}