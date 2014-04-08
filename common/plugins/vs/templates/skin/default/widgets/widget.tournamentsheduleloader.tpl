{if $oGame && $oGame->getSportId()==4}
{else}
	{if isset($dates_array)}

	<div class="block stats"> 
	<div class="vidget">
		
		<div class="t"></div>
		<div class="m"  id="monthrasp" align="center"> 
			{include file="{$sTPLvs}/widgets/widget.turnirteamrasp.tpl"}	
		
		</div>
				<div class="b"></div>
			</div>
		</div>		
{/if}
{literal}
	<script language="JavaScript" type="text/javascript"> 
$(document).ready(function()
{
	turn_on_hover();
});

function turn_on_hover(){	
 $('a.monthcalendar').each(function() {
      Tipped.create(this,  aRouter['ajax']+'day/info/',{
		skin: 'cloud',
		hook: 'topmiddle',
		maxWidth: 400, 
		showDelay: 300,
		ajax: { data: { 
					day: $(this).text(), 
					security_ls_key: LIVESTREET_SECURITY_KEY, 
					month: month_num, 
{/literal}
		{if isset($tournament_id)}tournament_id: {$tournament_id},{else}tournament_id: 11,{/if}
		{if isset($myteam)}team_id: {$myteam},{/if}
{literal}

}, type: 'post' }
      });
    });
	/*
	$('a.monthcalendar').each(function()
	{
		var params = {}; 
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;
		params['month']=month_num;
		params['tournament_id']=11; 
{/literal}
		{if isset($tournament_id)}params['tournament_id'] = {$tournament_id};{/if}
		{if isset($myteam)}params['tournament_id'] ={$myteam};{/if}
{literal}			

		params['day']=$(this).text();
		// We make use of the .each() loop to gain access to each element via the "this" keyword...
		$(this).qtip(
		{
					
			content: {
				// Set the text to an image HTML string with the correct src URL to the loading image you want to use
				text: 'Загружаем-с...',

				ajax: {
					 url: aRouter['ajax']+'day/info/', // URL to the local file
					 type: 'POST', // POST or GET
					 data: params, // Data to pass along with your request
					 success: function(data, status) {
						// Process the data 
						// Set the content manually (required!)
						this.set('content.text', data.sText);
					 }
				  }
			},
			position: {
				at: 'top center', // Position the tooltip above the link 
				viewport: $(window), // Keep the tooltip on-screen at all times
				effect: false // Disable positioning animation
			},
			show: {
				event: 'mouseover',
				solo: true ,
				delay: 200// Only show one tooltip at a time
			},
			hide: {
      fixed: true
   },
			style: {
				classes: 'ui-tooltip-wiki ui-tooltip-light ui-tooltip-shadow'
			}
		})
	}) ;
	*/
}
	

 
		
		function  change_month(tournament_id, month, year, team_id){
			var params = {};
			params['tournament_id']=tournament_id;
			params['month']=month;
			month_num=month;
			params['year']=year;
			params['team_id']=team_id;
			params['security_ls_key']=LIVESTREET_SECURITY_KEY;			
			/*new Request.JSON({
				url:  aRouter['ajax']+'raspisanie/month/',
				noCache: true,
				data: params,
				onSuccess: function(result){
					if (result.bStateError) {
						msgErrorBox.alert(result.sMsgTitle,result.sMsg);
					} else {
						//msgNoticeBox.alert(result.sMsgTitle,result.sMsg);
						$("monthrasp").innerHTML=result.sText;
					}
					
				},
				onFailure: function(){
					msgErrorBox.alert('Error','Please try again later');
				}
			}).send();*/
			
			ls.ajax(aRouter['ajax']+'raspisanie/month/', params, function(result) {
				if (result.bStateError) {
					ls.msg.error(result.sMsgTitle,result.sMsg);
				} else {
					$('#monthrasp').html(result.sText); 
					turn_on_hover();
				}
			});
		}
		
	</script>
{/literal}
{/if}