{include file='header.tpl' menu_content='tournament'}


{assign var=oHome value=$oMatch->getHometeam()}
{assign var=oAway value=$oMatch->getAwayteam()}
<p align="center"><h2>{$aLang.plugin.vs.suggest_time}</h2></p>
№{$oMatch->getNumber()} <b>{$oAway->getName()}</b> at <b>{$oHome->getName()}</b> {$oMatch->getDates()|date_format:"%e %B %Y"}
<br/>
<br/>
{*<input name='suggestion_time' type='text' id="suggestion_time" value='{$oMatch->getDates()|date_format:"%d.%m.%Y"} @ 20:00' class='demo_ranged' readonly="readonly"/>*}

<div class="widget-main">

<div class="rows"> 
	<div id="datetimepicker0" class="input-append date">
		<input data-format="dd.MM.yyyy @ hh:mm" value='{$oMatch->getDates()|date_format:"%d.%m.%Y"} @ 20:00' type="text" readonly="readonly" name="suggestion_time" id="suggestion_time"></input>
		<span class="add-on">
			<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
		</span>
	</div> - CET
</div>

<div class="rows"> 
	<div id="datetimepicker1" class="input-append date">
		<input data-format="dd.MM.yyyy @ hh:mm" value='{$oMatch->getDates()|date_format:"%d.%m.%Y"} @ 21:00' type="text" readonly="readonly" name="suggestion_time" id="suggestion_time"></input>
		<span class="add-on">
			<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
		</span>
	</div> - FIN (CET+1)
</div>

<div class="rows"> 
	<div id="datetimepicker3" class="input-append date">
		<input data-format="dd.MM.yyyy @ hh:mm" value='{$oMatch->getDates()|date_format:"%d.%m.%Y"} @ 23:00' type="text" readonly="readonly" name="suggestion_time" id="suggestion_time"></input>
		<span class="add-on">
			<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
		</span>
	</div> - MSK (CET+3)
</div>



<div class="rows"> 
	<input name='suggestion_text' type='text' id='suggestion_text'  SIZE="70" maxlength="70"/>
	<a href="javascript:SaveTime()">{$aLang.plugin.vs.add}</a>
</div>


</div>
<script type="text/javascript">
Date.prototype.addHours= function(h){
    this.setHours(this.getHours()+h);
    return this;
}

$(function() {

	
	var gmts = new Array();
	gmts[0] = "0";
	gmts[1] = "1";
	gmts[2] = "3"; 
	
	for (var i = 0; i < gmts.length; i++) {
		$('#datetimepicker'+gmts[i]).datetimepicker();
		
		$('#datetimepicker'+gmts[i]).on('changeDate', function(e) {
		  set_other(e.localDate , this.id[this.id.length-1] );
		});
	
	}
	//var picker = $('#datetimepicker0').data('datetimepicker');
	//alert(picker.getLocalDate().addHours(-1));
	//picker.setLocalDate(picker.getLocalDate().addHours(-1));

function set_other (datetime, hours){
	for_datetime = datetime;
	for (var s = 0; s < gmts.length; s++) { 
		datetime = for_datetime;
		$('#datetimepicker'+gmts[s]).data('datetimepicker').setLocalDate(datetime.addHours(gmts[s]-hours));
		datetime.addHours(hours - gmts[s]);
		
	}
}

});

</script>


<br/>
<div class="matchtime">
<div class="cr">
<ul id="time_list">
{if $aMatchtime}
{foreach from=$aMatchtime item=oMatchtime name=el2}
		{if $smarty.foreach.el2.iteration % 2  == 0}
			{assign var=className value='odd'}
		{else}
			{assign var=className value='even'}
		{/if}
		
<li class="{$className}">
	{if $oUser->GetUserId()==$oMatchtime->getPlayerId() || $myteam==$oMatchtime->getTeamId()}
	{assign var=oUser1 value=$oMatchtime->getUser1()}
		<span><b>-> {$oMatchtime->getTimes()|date_format:"%d.%m.%Y at %H:%M"} CET</b>
		{*<small>({$oMatchtime->getLogTime()})</small>*}<a href="{router page='profile'}{$oUser1->getLogin()}/" class="ls-user">{$oUser1->getLogin()}</a>: "{$oMatchtime->getComment()}"
		{if $oMatchtime->getStatus()==0}
			({$aLang.plugin.vs.waiting_response})	
		{else}
			(<b>
			{if $oMatchtime->getStatus()==1}{$aLang.plugin.vs.accepted}{/if}
			{if $oMatchtime->getStatus()==2}{$aLang.plugin.vs.declined}{/if}
			</b>
			{if $oMatchtime->getPlayer2Id()!=0}
			{assign var=oUser2 value=$oMatchtime->getUser2()}			
			<a href="{router page='profile'}{$oUser2->getLogin()}/" class="ls-user">{$oUser2->getLogin()}</a>: "{$oMatchtime->getComment2()}" 
			{/if}

			)
		{/if}
		</span>
	{/if}
	{if $oUser->GetUserId()!=$oMatchtime->getPlayerId() && $myteam!=$oMatchtime->getTeamId() }
	{assign var=oUser1 value=$oMatchtime->getUser1()}
		<span id="{$oMatchtime->getId()}"><b><- {$oMatchtime->getTimes()|date_format:"%d.%m.%Y at %H:%M"} CET</b> {*<small>({($oMatchtime->getTimes() + 20*24*60*60)|date_format:"%d.%m.%Y %H:%M"} - FIN (CET+1))</small>*}
		{*<small>({$oMatchtime->getLogTime()})</small>*}<a href="{router page='profile'}{$oUser1->getLogin()}/" class="ls-user">{$oUser1->getLogin()}</a>: "{$oMatchtime->getComment()}"
		{if $oMatchtime->getStatus()==0}
			<br/>
			<input name='suggestion_text_{$oMatchtime->getId()}' type='text' id='suggestion_text_{$oMatchtime->getId()}'  SIZE="70" maxlength="70"/>
			<a href="javascript:SAnswer('{$oMatchtime->getId()}','deny')">{$aLang.plugin.vs.declined}</a> <a href="javascript:SAnswer('{$oMatchtime->getId()}','accept')">{$aLang.plugin.vs.accept}</a>
		{/if}
		{if $oMatchtime->getStatus()==1}
			<b>{$aLang.plugin.vs.accepted}</b> ({$oMatchtime->getComment2()})
		{/if}
		{if $oMatchtime->getStatus()==2}	
			(<b>{$aLang.plugin.vs.declined}</b> "{$oMatchtime->getComment2()}")
		{/if}
		</span>
	{/if}
</li>
{/foreach}
{/if}
</ul>
</div>
</div>
<script type="text/javascript">
{*{literal}
$('#suggestion_time').datetimepicker({
	dateFormat: 'dd.mm.yy',
	timeFormat: 'hh:mm',
	stepMinute: 5,
	separator: ' @ ',
{/literal}
	dayNamesMin: ['{$aLang.plugin.vs.sun}', '{$aLang.plugin.vs.mon}', '{$aLang.plugin.vs.tue}', '{$aLang.plugin.vs.wed}', '{$aLang.plugin.vs.thu}', '{$aLang.plugin.vs.fri}', '{$aLang.plugin.vs.sat}'],
		monthNames: ['{$aLang.plugin.vs.jan}', '{$aLang.plugin.vs.feb}', '{$aLang.plugin.vs.mar}', '{$aLang.plugin.vs.apr}', '{$aLang.plugin.vs.may}', '{$aLang.plugin.vs.jun}', '{$aLang.plugin.vs.jul}', '{$aLang.plugin.vs.aug}', '{$aLang.plugin.vs.sep}', '{$aLang.plugin.vs.oct}', '{$aLang.plugin.vs.nov}', '{$aLang.plugin.vs.dec}'],
		firstDay: 1

});*}
{literal}
function SaveTime(){
				var params = {};

				params['suggestion_time']= $('#suggestion_time').val();
				params['suggestion_text']= $('#suggestion_text').val();
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;
{/literal}
				params['match_id']={$oMatch->getMatchId()};
				params['team_id']={$myteam};
{literal}
				ls.ajax(aRouter['ajax']+'setting/matchtime/', params, function(result) {
					if (result.bStateError) {
						ls.msg.error(result.sMsgTitle,result.sMsg);
					} else {
						ls.msg.notice(result.sMsgTitle,result.sMsg);
						window.location.reload();
					}
				});
}
function SAnswer(id, whats){
				var params = {};
				params['whats']= whats;
				params['id']= id;
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;				
				params['suggestion_text']= $('#suggestion_text_'+id).val();
				ls.ajax(aRouter['ajax']+'setting/matchtime_otvet/', params, function(result) {
					if (result.bStateError) {
						ls.msg.error(result.sMsgTitle,result.sMsg);
					} else {
						ls.msg.notice(result.sMsgTitle,result.sMsg);
						window.location.reload();
					}
				});
				

}
{/literal}
</script>

{include file='footer.tpl'}