{if $oTeam && $oTeam->getBlogId()}  
{include file='header.tpl' menu_content='team' team_page=true} 
{else}
{include file='header.tpl' menu_content='team'} 
{/if}

<div class="wrapper-content">
{assign var="oOwner" value=$oTeam->getOwner()}
<h3>Slider settings</h3>
<form action="" method="POST">
	<dl class="form-item">
		<dt><label for="profile_name">Show slider</label></dt>
		<dd> 
			<input type="checkbox" class="input-checkbox" id="show_slider" name="show_slider"  class="checkbox" value="1" {if $oTeam->getShowSlider()}checked="yes"{/if} >
		</dd>
	</dl>

	<dl class="form-item">
		<dt><label for="profile_name">First slide</label></dt>
		<dd>
			<select id="slide1" name="slide1" class="input-width-250" >
			<option value="0">-</option>
			{if $aTopics}
				{foreach from=$aTopics item=oTopic name=el2}
				<option value="{$oTopic->getId()}" {if $oTopic->getTopicId()== $oTeam->getSlidebyNum(1)}selected="selected"{/if}>{$oTopic->getTitle()}</option>
				{/foreach}
			{/if}
			</select> 
		</dd>
	</dl>
	<dl class="form-item">
		<dt><label for="profile_name">Second slide</label></dt>
		<dd>
			<select id="slide2" name="slide2" class="input-width-250" >
			<option value="0">-</option>
			{if $aTopics}
				{foreach from=$aTopics item=oTopic name=el2}
				<option value="{$oTopic->getId()}" {if $oTopic->getTopicId()== $oTeam->getSlidebyNum(2)}selected="selected"{/if}>{$oTopic->getTitle()}</option>
				{/foreach}
			{/if}
			</select> 
		</dd>
	</dl>
	<dl class="form-item">
		<dt><label for="profile_name">Third slide</label></dt>
		<dd>
			<select id="slide3" name="slide3" class="input-width-250" >
			<option value="0">-</option>
			{if $aTopics}
				{foreach from=$aTopics item=oTopic name=el2}
				<option value="{$oTopic->getId()}" {if $oTopic->getTopicId()== $oTeam->getSlidebyNum(3)}selected="selected"{/if}>{$oTopic->getTitle()}</option>
				{/foreach}
			{/if}
			</select> 
		</dd>
	</dl>
	<dl class="form-item">
		<dt><label for="profile_name">Fourth slide</label></dt>
		<dd>
			<select id="slide4" name="slide4" class="input-width-250" >
			<option value="0">-</option>
			{if $aTopics}
				{foreach from=$aTopics item=oTopic name=el2}
				<option value="{$oTopic->getId()}" {if $oTopic->getTopicId()== $oTeam->getSlidebyNum(4)}selected="selected"{/if}>{$oTopic->getTitle()}</option>
				{/foreach}
			{/if}
			</select> 
		</dd>
	</dl>
	
	
	<button type="submit"  name="save_slider" class="button button-primary" />Save settings</button>
</form>		
<br/>
 
 <h3>Team settings</h3>
<form action="" method="POST">
<dl class="form-item">
		<dt><label>Jersey</dt>
		<dd>
			<select  name="forma_field">  
			{foreach from=$teams item=forma}			
				<option value="{$forma.img}" {if $oTeam && $forma.img==$oTeam->getFormaField()}SELECTED{/if}>{$forma.name}</option>
			{/foreach}
			</select>
		</dd>
	</dl>

	<button type="submit"  name="team_settings_save" class="button button-primary" />Save settings</button>
</form>		
<br/>

<h3>Roster</h3> 
	
{foreach from=$aSostav item=oSostav name=el2}
<dl class="form-item">
	<dt><label for="profile_name">{$oSostav->getPlayercard()->getFullFio()} <br/>{$oSostav->getPlayercard()->getUser()->getLogin()} </label></dt>
	<dd>
	{if $oUserCurrent->getIsAdministrator() || ($oPlayer && $oPlayer->getCap()==2)}
	<select class="sostav_players" id="{$oSostav->getPlayercardId()}" onchange="update_player_status(this); return false;">
		<option value="0" {if $oSostav->getCap()==0}selected="selected"{/if}> - </option>
		<option value="1" {if $oSostav->getCap()==1}selected="selected"{/if}>Assistant</option>
		<option value="2" {if $oSostav->getCap()==2}selected="selected"{/if}>Captain</option>
	</select>
	</dd>
	{/if}
	<a href="javascript:go_from({$oSostav->getId()},'team');">Delete from team</a> 
</dl> 
{/foreach}	

	
 
<h3>Invite players</h3>
<form action="" method="POST">
	<dl class="form-item">
		<dt><label for="profile_name">{$aLang.settings_profile_name}:</label></dt>
		<dd>
			<input type="text"  class="input-text input-width-300 autocomplete-playercard"  id="playercards" name="playercards" >
		</dd>
	</dl> 
	<dl class="form-item">
		<dt><label for="profile_name"></label></dt>
		<dd>
			<button type="submit"  name="submit_profile_edit" class="button button-primary" />Send invites</button>
		</dd>
	</dl> 	
</form>
{if $aInvites}
	<dl class="form-item">
		<dt><label for="profile_name">Waiting for response</label></dt>
		<dd>			
			{foreach from=$aInvites item=oInvite name=el2}
				{$oInvite->getPlayercard()->getFullFio()} - {$oInvite->getPlayercard()->getUser()->getLogin()}<br/>
			{/foreach}			
		</dd>
	</dl> 
{/if}	

{if $aInvitesFromPlayers} 
<h3>Incoming requests</h3>
	<dl class="form-item">
		<dt><label for="profile_name">Waiting confirmation</label></dt>
		<dd>			
			{foreach from=$aInvitesFromPlayers item=oInvite name=el2}
				{$oInvite->getPlayercard()->getFullFio()} - {$oInvite->getPlayercard()->getUser()->getLogin()}<br/> 
				<a href="javascript:answer_invite({$oInvite->getId()},'team',1)">Accept</a> <a href="javascript:answer_invite({$oInvite->getId()},'team',-1)">Decline</a><br/><br/>
			{/foreach}			
		</dd>
	</dl> 
{/if}	
</div>
{if $oBlog && ($oBlog->getTeam()==1 or $oBlog->getLeague()==1)}
<h3>Team logos</h3>
{literal}
<script type="text/javascript"> 

function  upload_logo(logo_type){  
	ls.ajaxSubmit(aRouter['ajax']+'au/upload_logo/', 'form_'+logo_type, function(result){
		if (!result) {
			ls.msg.error('Error','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error(result.sMsgTitle,result.sMsg);
		} else { 
			ls.msg.notice('Saved',' ');											
		}
	});		
}

function  delete_logo(logo_type){
	var params = {}; 
	params['blog_id']={/literal}{$oBlog->getId()} {literal}; 
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;							
	params['logo_type']=logo_type;
	ls.ajax(aRouter['ajax']+'au/delete_logo/', params, function(result){
		if (!result) {
			ls.msg.error('Error','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error(result.sMsgTitle,result.sMsg);
		} else { 
			ls.msg.notice('Saved',' ');	
		}
	}); 
}
</script> 
{/literal}

 <p>
	<label for="blog_small_logo">Small logo (32x32, only png):</label>
	<form method="post" id="form_small_logo" enctype="multipart/form-data"> 
		<input type="file" name="blog_small_logo" id="blog_small_logo" class="input-text" onchange="upload_logo('small_logo'); return false;"/>
		<input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}">
		<input type="hidden" name="blog_id" value="{$oBlog->getId()}">
		<input type="hidden" name="logo_type" value="small_logo">
	</form>
	<div id="brand_box_image">
	{if $oBlog->getLogoSmall()}
		<br/>
		<a href="{$oBlog->getLogoSmall()}"rel="[photoset]" title="" class="photoset-image"><img src="{cfg name='path.root.web'}/images/blog/{$oBlog->getUrl()}/{$oBlog->getLogoSmall()}" alt="" width="32"/></a>
		<label><input onchange="delete_logo('small_logo'); return false;" type="checkbox" id="blog_small_logo_delete" name="blog_small_logo_delete" value="on" class="input-checkbox"> Delete small logo</label>
	{/if}
	</div>
</p> 
<p>
	<label for="blog_full_logo">Full logo (200x200, only png):</label>
	<form method="post" id="form_full_logo" enctype="multipart/form-data"> 
		<input type="file" name="blog_full_logo" id="blog_full_logo" class="input-text" onchange="upload_logo('full_logo'); return false;"/>
		<input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}">
		<input type="hidden" name="blog_id" value="{$oBlog->getblogId()}">
		<input type="hidden" name="logo_type" value="full_logo">
	</form>
	<div id="brand_box_image">
	{if $oBlog->getLogoFull()}
		<br/>
		<a href="{$oBlog->getLogoFull()}"rel="[photoset]" title="" class="photoset-image"><img src="{cfg name='path.root.web'}/images/blog/{$oBlog->getUrl()}/{$oBlog->getLogoFull()}" alt="" /></a>
		<label><input onchange="delete_logo('full_logo'); return false;" type="checkbox" id="blog_full_logo_delete" name="blog_full_logo_delete" value="on" class="input-checkbox"> Delete full logo</label>

	{/if}
	</div>
</p>
{if $oBlog->getTeam()==1 && ($oUserCurrent && ($oUserCurrent->getLogin()=='Klaus' || $oUserCurrent->getLogin()=='2ManyFaces' || $oUserCurrent->getLogin()=='EstoniaDeluxe' || $oUserCurrent->getLogin()=='Rankaisija_' ))}
<p>
	<label for="blog_team_logo">Teamplay-style logo (100x54, only png):</label>
	<form method="post" id="form_team_logo" enctype="multipart/form-data"> 
		<input type="file" name="blog_team_logo" id="blog_team_logo" class="input-text" onchange="upload_logo('team_logo'); return false;"/>
		<input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}">
		<input type="hidden" name="blog_id" value="{$oBlog->getblogId()}">
		<input type="hidden" name="logo_type" value="team_logo">
	</form>
	<div id="brand_box_image">
	{if $oBlog->getLogoTeam()}
		<br/>
		<a href="{$oBlog->getLogoTeam()}"rel="[photoset]" title="" class="photoset-image"><img src="{cfg name='path.root.web'}/images/blog/{$oBlog->getUrl()}/{$oBlog->getLogoTeam()}" alt="" /></a>
		<label><input onchange="delete_logo('team_logo'); return false;" type="checkbox" id="blog_team_logo_delete" name="blog_team_logo_delete" value="on" class="input-checkbox"> Delete teamplay logo</label>

	{/if}
	</div>
</p>
{/if}
{/if}
<script type="text/javascript"> 
function  update_player_status(obj){
	//alert($(obj).val());
	
	var params = {};
	params['playercard_id']=$(obj).attr("id"); 
	params['id']=$(obj).val(); 
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	ls.ajax(aRouter['ajax']+'teamplay/newstatus/', params, function(result){
		if (!result) {
			ls.msg.error('Error5','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error(result.sMsgTitle,result.sMsg);	
		} else {  
			ls.msg.notice(result.sMsgTitle,result.sMsg); 
			if(params['id']==2)window.location.reload();	
		}
	});

}
</script>
{include file='footer.tpl'}