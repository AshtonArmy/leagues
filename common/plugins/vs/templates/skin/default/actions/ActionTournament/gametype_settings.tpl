{include file='header.tpl' menu_content='tournament'  }
 
{if $authorise}
<br />
<p><b>{if !$oTovarki and $Identifier!=""}{$aLang.plugin.vs.your} {/if}
{if !$oTovarki and $Identifier==""}{$aLang.plugin.vs.input} {/if}
PSN ID / Gametag:</b> <input type="text" id="psn" value="{if $oTovarki}{$oTovarki->getPsnid()}{/if}" /> 
{if !$oTovarki and $Identifier!=""}<b>?</b> {/if}
{if !$oTovarki and $Identifier!=""}<a href="javascript:saveTovarki()">Да</a>{/if}</p>
<br/>
{if !$oTovarki and $Identifier!=""}{else}<a href="javascript:saveTovarki()">{$aLang.plugin.vs.save}</a>{/if}

<script type="text/javascript"> 

	{if !$oTovarki or $oTovarki->getPsnid()==''}
		$('#psn').val('{$Identifier}');
	{/if}
{literal}	
 
function saveTovarki(){
				var params = {};
				if($('#psn').val() !=''){
					params['psnid']= $('#psn').val();
					params['security_ls_key']=LIVESTREET_SECURITY_KEY;
					if($('#wantplay'))if($('#wantplay').is(':checked')){params['wantplay']=1;}else{params['wantplay']=0;}
	{/literal}
					params['game_id']={$game_id};
					params['gametype_id']={$gametype_id};
					
{if $oTovarki}
					params['datestart']= $('#datestart').val();
					params['dateend']= $('#dateend').val();
{/if}
	{literal}
	ls.ajax(aRouter['ajax']+'setting/tovarki/', params, function(result){
		if (!result) {
			ls.msg.error('Error','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error('Error','Please try again later');
		} else { 
			ls.msg.notice(result.sMsgTitle,result.sMsg);
		{/literal}
							if("{if $oTovarki}{$oTovarki->getPsnid()}{/if}" == "")window.location.reload();
		{literal}
		}
	});	

				}else{
					ls.msg.error('Error','{$aLang.plugin.vs.need_enter} PSN ID / Gametag');
					$('#psn').focus();
				}
}


{/literal}			
</script> 

{if $gametype_id==4 && $oTovarki}
	<br/>
	
	<a href="javascript:ShowAddTeam()">{$aLang.plugin.vs.add_team}</a><br/>
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
			$('#add_team').html("{/literal}<select id='team_logo' class='w70'><option value=''>-</option>{foreach from=$aLogos item=oLogo name=el2}<option value='{$oLogo.logo}'>{$oLogo.logo}</option>{/foreach}</select>{literal}<input name='team_name' type='text' id='team_name' SIZE='20' maxlength='40'/>  (<input name='team_brief' type='text' id='team_brief'   SIZE='3' maxlength='5'/>)	<a href='javascript:SaveTeam(0)'>Добавить</a> ");
			$('#add_team').toggle();
		}
		function ShowEditTeam(team_id){
			names=$('#name_'+team_id).html();
			briefs=$('#brief_'+team_id).html();
			logos=$('#logo_'+team_id).html();
			$('#add_team').html('');
			$('#edit_team').html("{/literal}<select id='team_logo' class='w70'><option value='"+logos+"'>"+logos+"</option><option value=''>-</option>{foreach from=$aLogos item=oLogo name=el2}<option value='{$oLogo.logo}'>{$oLogo.logo}</option>{/foreach}</select>{literal}<input name='team_name' type='text' id='team_name' value='"+names+"' SIZE='20' maxlength='40'/>  (<input name='team_brief' type='text' id='team_brief' value='"+briefs+"' SIZE='3' maxlength='5'/>)	<a href='javascript:SaveTeam("+team_id+")'>Сохранить</a> ");
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
{include file='footer.tpl'}