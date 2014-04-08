{include file='header.tpl' menu='blog'}


<div id="add_team">
	<form action="{router page='teams'}create/" method="POST">	 
	 
		<label>Team name<br/>
			<input name='team_name' type='text' id='team_name' class="input-text" SIZE='20' maxlength='40'/> <br/>
			{*<span class="note">Может состоять только из букв (A-Z a-z), цифр (0-9). Знак подчеркивания (_) лучше не использовать. Длина логина не может быть меньше 3 и больше 30 символов.
				</span>*}
		</label>
		<br/>
		<label>Short name<br/>
			<input name='team_brief' type='text' id='team_brief' class="input-text" style="width:50px;"  SIZE='3' maxlength='5'/><br/>	
		</label>
		<br/>
		<label>Game<br/>
			<select  name="game_id">
			{foreach from=$oGame item=Game}   
				<option value="{$Game->getId()}">{$Game->getName()}_{foreach from=$oPlatform item=Platform}   
									{if $Game->getPlatformId()== $Platform->getId()}{$Platform->getName()} {/if}{/foreach}</option>
			{/foreach}
			</select>
		</label><br/><br/>
		<label>Team type<br/>
			<select  name="gametype_id">   
				<option value="2">2 on 2</option>
				<option value="3">teamplay</option> 
			</select>
		</label>
		<br/>
		<br/>
		<input type="submit" value="Submit" class="button" name="submit_create_team">
	</form>
</div>
<br/>
 

{literal}
<script type="text/javascript">

var lastCheckedName = '';
var lastCheckedBrief = '';


$('input[name=team_name]').live("blur", function(){
    
    var log = $('input[name=team_name]');
    if ( !log.val() || lastCheckedName ==  log.val()){
        return;
    }
    log.addClass('ajax-loading').removeClass('success').removeClass('error');
    
    ls.ajax(aRouter['ajax']+'check/creation/', {'var': log.val(),'do': 'name', 'sport_id':'{/literal}{$sport_id}{literal}'}, function(response){
        lastCheckedName = log.val();
        log.removeClass('ajax-loading');
        if (!response.bStateError) {
                log.removeClass('error').addClass('success');
        } else {
                log.addClass('error');
                ls.msg.error(ls.lang.get('error'),response.sMsg);
        }
    });

});

$('input[name=team_brief]').live("blur", function(){
    
    var log = $('input[name=team_brief]');
    if ( !log.val() || lastCheckedBrief ==  log.val()){
        return;
    }
    log.addClass('ajax-loading').removeClass('success').removeClass('error');
    
    ls.ajax(aRouter['ajax']+'check/creation/', {'var': log.val(),'do': 'brief', 'sport_id':'{/literal}{$sport_id}{literal}'}, function(response){
        lastCheckedBrief = log.val();
        log.removeClass('ajax-loading');
        if (!response.bStateError) {
                log.removeClass('error').addClass('success');
        } else {
                log.addClass('error');
                ls.msg.error(ls.lang.get('error'),response.sMsg);
        }
    });

});


</script>
<style>
.input-text {
    border: 1px solid #CCCCCC;
    font-family: Arial,sans-serif;
    font-size: 18px;
    padding: 4px 6px;
    width: 386px;
}

input.ajax-loading {
    background: url("http://virtualsports.ru/templates/skin/vs-new/images/update_act.gif") no-repeat scroll right center transparent;
}
input.error {
    background: none repeat scroll 0 0 #F6D2DA !important;
    border: 1px solid #CC0000 !important;
}
input.success {
    background: none repeat scroll 0 0 #C9FFCD !important;
    border: 1px solid #00CC00 !important;
}
</style>
{/literal}
{include file='footer.tpl'}