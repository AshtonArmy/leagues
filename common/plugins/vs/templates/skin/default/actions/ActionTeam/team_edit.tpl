{*{if $oTeam && $oTeam->getBlogId()}
{include file="$sTPLvs/actions/ActionTeam/header.tpl" menu="blog"} 
{else}
{include file='header.tpl' menu='blog'} 
{/if}*}
{include file='header.tpl'} 

{if $on_accept}
Your team must accept admin. Please wait mail with answer.
{else}
<div class="widget-box">
	<div class="widget-header widget-header-blue widget-header-flat">
		<h4 class="lighter">New Team</h4>

	</div>

	<div class="widget-body">
		<div class="widget-main">
		
<div id="add_team">
{if $oTeam}
		{if $oBlog}
			<form action="{$oBlog->getTeamUrlFull()}_edit" method="POST">
		{else}
			<form action="{router page='team'}{$oTeam->getTeamId()}/edit" method="POST">
		{/if}
		<input type="hidden" name="team_id" id="team_id" value="{$oTeam->getTeamId()}">	
{else}
	<form action="{router page='team'}create/{$sport}" method="POST">
{/if}	 
		<label>Team name<br/>
			<input name='team_name' type='text' id='team_name' class="input-text" SIZE='20' maxlength='40' {if $oTeam} value="{$oTeam->getName()}" {*disabled="disabled"*}{/if}/> <br/>
			{*<span class="note">Может состоять только из букв (A-Z a-z), цифр (0-9). Знак подчеркивания (_) лучше не использовать. Длина логина не может быть меньше 3 и больше 30 символов.
				</span>*}
		</label>
		<br/>
		<label>Short name<br/>
			<input name='team_brief' type='text' id='team_brief' class="input-text" style="width:50px;"  {if $oTeam} value="{$oTeam->getBrief()}" {*disabled="disabled"*}{/if} SIZE='3' maxlength='5'/><br/>	
		</label>
		<br/>
		<label>Game<br/>
			<select  name="game_id" {*{if !$admin_can_edit}disabled{/if}*}>
			{foreach from=$oGame item=Game}   
				<option value="{$Game->getId()}" {if $oTeam && $Game->getId()==$oTeam->getGameId()}SELECTED{/if}>{$Game->getName()}_{foreach from=$oPlatform item=Platform}   
									{if $Game->getPlatformId()== $Platform->getId()}{$Platform->getName()} {/if}{/foreach}</option>
			{/foreach}
			<option value="0" {if $oTeam && '0'==$oTeam->getGameId()}SELECTED{/if}>-</option>
			</select>
		</label><br/><br/>
		<label>Team type<br/>
			<select  name="gametype_id" {*{if !$admin_can_edit}disabled{/if}*}>   
				<option value="3" {if $oTeam && '3'==$oTeam->getGametypeId()}SELECTED{/if}>teamplay</option> 
				<option value="2" {if $oTeam && '2'==$oTeam->getGametypeId()}SELECTED{/if}>2 on 2</option>
				<option value="1" {if $oTeam && '1'==$oTeam->getGametypeId()}SELECTED{/if}>1 on 1</option>
			</select>
		</label>
		<br/>
		<br/>
		<label>Jersey<br/> 
		<select  name="forma_field">  
		{foreach from=$teams item=forma}			
			<option value="{$forma.img}" {if $oTeam && $forma.img==$oTeam->getFormaField()}SELECTED{/if}>{$forma.name}</option>
		{/foreach}
		</select>
			{*<input name='forma' type='text' id='forma' class="input-text" SIZE='20' maxlength='100' {if $oTeam} value="{$oTeam->getForma()}" {/if}/> <br/>
			*}{*<span class="note">Может состоять только из букв (A-Z a-z), цифр (0-9). Знак подчеркивания (_) лучше не использовать. Длина логина не может быть меньше 3 и больше 30 символов.
				</span>*}
		</label>
		<br/>
		<br/>
		<label>Link on ЕА<br/>
			<input name='links' type='text' id='links' class="input-text" SIZE='20' maxlength='100' {if $oTeam} value="{$oTeam->getLinks()}" {/if}/> <br/>
			{*<span class="note">Может состоять только из букв (A-Z a-z), цифр (0-9). Знак подчеркивания (_) лучше не использовать. Длина логина не может быть меньше 3 и больше 30 символов.
				</span>*}
		</label>
		
		<label>Choose team blog, if you create it for team<br/>
			<select name="blog_id" id="blog_id" >
				<option value="0">-</option>
				{foreach from=$aBlogsAllow item=oBlog}
					<option value="{$oBlog->getId()}" {if ($oTeam && $oTeam->getBlogId()==$oBlog->getId())}selected{/if}>{$oBlog->getTitle()|escape:'html'}</option>
				{/foreach}
			</select>
		</label>
		
		{* 
		<br/>
		<br/>		
		<label>Logo<br/>
			<input name='logo' type='text' id='logo' class="input-text" SIZE='20' maxlength='100' {if $oTeam} value="{$oTeam->getLogo()}" {/if} {if !$admin_can_edit}disabled{/if}/> <br/>
		</label>
		{if $admin_can_edit}
		 <p> 
			<select name="blog_id" id="blog_id" >
				<option value="0">-</option>
				{foreach from=$aBlogsAllow item=oBlog}
					<option value="{$oBlog->getId()}" {if ($oTeam && $oTeam->getBlogId()==$oBlog->getId())}selected{/if}>{$oBlog->getTitle()|escape:'html'}</option>
				{/foreach}
			</select> 
		</p>
		{/if}
		*}
		<br/>
		<br/>
		<input type="submit" value="Submit" class="button" name="submit_create_team">
	</form>
</div>
<br/>
		</div><!--/widget-main-->
	</div><!--/widget-body-->
</div> 
{/if}
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