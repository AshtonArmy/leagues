{include file='header.tpl' menu='blog'}
{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats='uchastniki'}
<br />
В данном турнире команда выдается <b>случайным</b> образом.
<br />
<p><b>{if !$oPlayerTournament and $Identifier!=""}Ваш {/if}
{if !$oPlayerTournament and $Identifier==""}Введите {/if}
{$Tag}:</b> <input type="text" id="psn" value="{if $oPlayerTournament}{$oPlayerTournament->getPsnid()}{/if}" onblur="savePsn()" /> 
{if !$oPlayerTournament and $Identifier!=""}<b>?</b> {/if}
<a href="javascript:savePsn()">{if !$oPlayerTournament and $Identifier!=""}Да{else}Сохранить{/if}</a></p>


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
					ls.msg.error('Error','необходимо указать {/literal}{$Tag}{literal}');
					$('#psn').focus();
				}
}
function Add(){
//alert($('#teams').val());
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
									ls.msg.error('Error','Please try again later');
								} else { 
									ls.msg.notice('Сохранено',' ');
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
</dd>

						<dd>
							<input type="submit" id="localSubmit" name="localSubmit" value="Сохранить список" />
						</dd>
					</dl>
				</form>

{/if}

{*
{literal}
<script type="text/javascript"> 
window.addEvent('domready', function() {
	mySortables = new Sortables('#widgetLeft, #widgetRight', {
        clone: true,
        opacity: 0.2,
        handle: '.widgetTitle',
        revert: true,
        constrain: false,
        onStart: function(w){
            w.addClass('widgetDrag');
        },
        onDrag: function(w){
 
        },
        onComplete: function(w){
            w.removeClass('widgetDrag');
 
            var left ='';
            var right = '';
 
            $$('#widgetLeft li').each(function(w){
                left = left + w.value + '|';
            });
 
            $$('#widgetRight li').each(function(w){
                right = right + w.value + '|';
            });
 
            //alert('left: '+ left + 'right: ' + right);
 
            /* Do a post request to save the positions */
                var params = new Hash();
                params['teams']=right;
                params['security_ls_key']=LIVESTREET_SECURITY_KEY;
{/literal}
				params['tournament']={$Tournament};
{literal}
			if($('psn').value !=''){
                new Request.JSON({
                	url: aRouter['ajax']+'setting/team/',
                	noCache: true,
                	data: params,
					onSuccess: function(result){
						msgNoticeBox.alert('Сохранено',' ');
					}
                }).send();
			}else{
					msgErrorBox.alert('Error','необходимо указать PSN ID / Gametag');
					$('psn').focus();
				}
			/* end send */
         }
		 
     });
 
     $$('.widgetButton').each(function(b){
        b.addEvent('click', function(){
            alert('tools');
        });
    });
});
{/literal}
	{if !$oPlayerTournament or $oPlayerTournament->getPsnid()==''}
		$('psn').value='{$Identifier}';
		//$('psn').focus();
	{/if}
{literal}
function send(form,sToLoad) {
	if (typeof(form)=='string') {
		form=$(form);
	}


}
function savePsn(){
				var params = new Hash();
				if($('psn').value !=''){
					params['psnid']= $('psn').value;
					params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	{/literal}
					params['tournament']={$Tournament};
	{literal}

					new Request.JSON({
						url: aRouter['ajax']+'setting/psn/',
						noCache: true,
						data: params,
						onSuccess: function(result){
							//msgNoticeBox.alert('Сохранено',' ');
							if (result.bStateError) {
								msgErrorBox.alert(result.sMsgTitle,result.sMsg);
							} else {
								msgNoticeBox.alert(result.sMsgTitle,result.sMsg);
							}
		{/literal}
							if("{if $oPlayerTournament}{$oPlayerTournament->getPsnid()}{/if}" == "")window.location.reload();
		{literal}
						}
					}).send();
				}else{
					msgErrorBox.alert('Error','необходимо указать {/literal}{$Tag}{literal}');
					$('psn').focus();
				}
}
</script> 
 
<style> 
* {
	margin: 0px;
	padding: 0px'
	}
	
.clear {
    clear: both;
    }
 
#widgetContainer {
    width: 600px;
    margin: 0px auto;
    padding-top: 20px;
    }
 
.widgetColumn {
    width: 245px;
    float: left;
{/literal}
	min-height:{$Vsego_css}px;
{literal}
    }
#widgetRight {
{/literal}
	min-height:{$Vsego_css}px;
{literal}
}

.widget {
    margin: 5px;
    width: 240px;
    border: 1px #6B6B6B solid;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    list-style-type: none;
    background: #EFEFEF;
    }
 
.widgetDrag {
    border: 1px #333 dashed;
    }
 
.widgetTitle h2 {
    background: #6B6B6B;
    color: #FFF;
    font: 16px Georgia, Times New Roman;
    text-decoration: none;
    padding: 2px;
    cursor: move;
	margin: 0px;
}
.smalltext{
	font: 10px Georgia, Times New Roman;
} 
.widgetButton {
    width: 12px;
    height: 12px;
    background: #666 url() center center no-repeat;
    cursor: pointer;
    float: right;
    margin: 4px 4px;
    }
 
.widgetText {
    padding: 5px;
	cursor: move;
	font: 16px Georgia, Times New Roman;
	vertical-align:middle;
    }
</style> 
{/literal}
{if $oPlayerTournament}
<div id="widgetContainer"> 
	<div class="widgetColumn"> 
	
	<p align="center">Свободные команды</p>
	<br/>
		<ul id="widgetLeft"> 

		</ul> 
	</div> 
	<div class="widgetColumn"> 
	<p align="center">Ваши предпочтения</p>
	<p align="center"><i>перетащите сюда команды</i></p>
		<ul id="widgetRight"> 

{if $aTeamPrioritet}
{foreach from=$aTeamPrioritet item=oTeamPrioritet name=el2}
	{assign var=oTeam value=$oTeamPrioritet->getTeam()}


	<li class="widget" style="height: 30px;" value="{$oTeam->getTeamId()}"> 
				<div class="widgetText">
					{if $oTeam->getLogo() !=""}<img height="20" src="{cfg name='path.root.web'}/images/teams/small/{$oTeam->getLogo()}"/>{/if}
					{$oTeam->getName()}
	{foreach from=$zanytue item=zanytaya}
		{if $oTeam->getTeamId()==$zanytaya}<span class="smalltext">Занято</span>{/if}
	{/foreach}
				</div>
	</li> 
{/foreach}
{/if}
		</ul> 
	</div> 
</div> 
{/if}
*}



{include file='footer.tpl'}