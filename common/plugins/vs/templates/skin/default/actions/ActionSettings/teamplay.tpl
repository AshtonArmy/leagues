{assign var="sidebarPosition" value='left'}
{include file='header.tpl'}

{include file='menu.settings.tpl'}
{*
<div class="button_top underline">
		<div class="left {if $game=="hockey"}active{/if}">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="http://virtualsports.ru/settings/teamplay/hockey/ps3">Hockey player card PS3 </a></div>
		</div>
		<div class="left {if $game=="battlefield"}active{/if}">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="http://virtualsports.ru/settings/teamplay/battlefield/ps3">Card of Battlefield PS3</a></div>
		</div> 
</div>		
*}

{if $game=='' }<br/>
Choose which card you want to edit
{/if}
{if $game=='hockey' && ($platform=='ps3' || $platform=='xbox')}
<form action="{router page='settings'}teamplay/{$game}/{$platform}/{if isset($UserLogin)}{$UserLogin}{/if}" method="POST" class="form-profile" enctype="multipart/form-data">	
<div class="wrapper-content">	
		<p id="profile_user_field_template" style="display:none;" class="js-user-field-item">
			<select name="profile_user_field_type[]" onchange="ls.userfield.changeFormField(this);">
			{foreach from=$aUserFieldsContact item=oFieldAll}
				<option value="{$oFieldAll->getId()}">{$oFieldAll->getTitle()|escape:'html'}</option>
			{/foreach}
			</select>
			<input type="text" name="profile_user_field_value[]" value="" class="input-text input-width-200">
			<a class="icon-synio-remove" title="{$aLang.user_field_delete}" href="#" onclick="return ls.userfield.removeFormField(this);"></a>
		</p>
	<input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />
	<input type="hidden" name="sport_id" value="{$sport_id}" />
	
<script type="text/javascript">
	jQuery(function($){
		$('#playerphoto-upload').file({ name:'playerphoto' }).choose(function(e, input) {
			ls.user.uploadPlayerPhoto(null,input);
		});		
		ls.userfield.iCountMax='{cfg name="module.user.userfield_max_identical"}';
	});
</script>
<div id="user-profile-1" class="user-profile row-fluid">
	<div class="span8">

	<div id="add_card">		
		
<fieldset class="info-contener">
		<legend>Player info</legend>
		
		<dl class="form-item">
			<dt><label for="profile_name">Name</label></dt>
			<dd>
				<input name="settings_name" type="text" class="input-text input-width-250" id="settings_name" size="40" maxlength="70" value="{if $oPlayercard}{$oPlayercard->getName()}{/if}">
			</dd>
		</dl>
 
 		<dl class="form-item">
			<dt><label for="profile_name">Surname</label></dt>
			<dd>
				<input name="settings_family" type="text" class="input-text input-width-250" id="settings_family" size="40" maxlength="70" value="{if $oPlayercard}{$oPlayercard->getFamily()}{/if}">
			</dd>
		</dl>

		<dl class="form-item">
			<dt><label for="profile_name">Number</label></dt>
			<dd>
				<input name="settings_number" type="text" class="input-text input-width-50" id="settings_number" size="2" maxlength="2" value="{if $oPlayercard}{$oPlayercard->getNumber()}{/if}">
			</dd>
		</dl>
		
		<dl class="form-item">
			<dt><label for="profile_name">Position</label></dt>
			<dd>
				<label><input type="checkbox" class="input-checkbox ace" {if $oPlayercard && $oPlayercard->getLw()}checked{/if} id="settings_lw" name="settings_lw" value="1"><span class="lbl"> - LW </span></label>
				<label><input type="checkbox" class="input-checkbox ace" {if $oPlayercard && $oPlayercard->getC()}checked{/if} id="settings_c" name="settings_c" value="1"><span class="lbl"> - C </span></label>
				<label><input type="checkbox" class="input-checkbox ace" {if $oPlayercard && $oPlayercard->getRw()}checked{/if} id="settings_rw" name="settings_rw" value="1"><span class="lbl"> - RW </span></label>
				<label><input type="checkbox" class="input-checkbox ace" {if $oPlayercard && $oPlayercard->getLd()}checked{/if} id="settings_ld" name="settings_ld" value="1"><span class="lbl"> - LD </span></label>
				<label><input type="checkbox" class="input-checkbox ace" {if $oPlayercard && $oPlayercard->getRd()}checked{/if} id="settings_rd" name="settings_rd" value="1"><span class="lbl"> - RD </span></label>
				<label><input type="checkbox" class="input-checkbox ace" {if $oPlayercard && $oPlayercard->getG()}checked{/if} id="settings_g" name="settings_g" value="1"><span class="lbl"> - G </span></label> 
			</dd>
		</dl>
		
		<dl class="form-item">
			<dt><label for="profile_name">Timezone</label></dt>
			<dd>
				<input name="settings_time" type="text" class="input-text input-width-250" id="settings_time" size="20" maxlength="20"  value="{if $oPlayercard}{$oPlayercard->getPlayTime()}{/if}">
			</dd>
		</dl>
		
		<dl class="form-item">
			<dt><label for="profile_name">History</label></dt>
			<dd>
				<textarea cols="50" rows="5" name="settings_about" class="input-text input-width-full" id="settings_about">{if $oPlayercard}{$oPlayercard->getAbout()}{/if}</textarea>
			</dd>
		</dl>
		

		<dl class="form-item">
			<dt><label for="profile_name">Looking for club</label></dt>
			<dd>
				<label><input type="checkbox" class="input-checkbox ace" id="settings_looking" {if $oPlayercard && $oPlayercard->getLooking()}checked{/if} name="settings_looking" value="1" ><span class="lbl"></span></label>
			</dd>
		</dl>

		<dl class="form-item">
			<dt><label for="profile_name">Retired</label></dt>
			<dd>
				<label><input type="checkbox" class="input-checkbox ace" id="settings_end" {if $oPlayercard && $oPlayercard->getEndGames()}checked{/if} name="settings_end" value="1"><span class="lbl"></span></label>
			</dd>
		</dl>
</fieldset>
{assign var="aUserFieldValues" value=$User->getUserFieldValues(false,'')}
{if count($aUserFieldValues)}
	{foreach from=$aUserFieldValues item=oField}
		<dl class="form-item">
			<dt><label for="profile_user_field_{$oField->getId()}">{$oField->getTitle()|escape:'html'}:</label></dt>
			<dd><input type="text" class="input-text input-width-300" name="profile_user_field_{$oField->getId()}" id="profile_user_field_{$oField->getId()}" value="{$oField->getValue()|escape:'html'}"/></dd>
		</dl>
	{/foreach}
{/if}
		
<fieldset class="contact-contener">
		<legend>{$aLang.settings_profile_section_contacts}</legend>

		{assign var="aUserFieldContactValues" value=$oUserCurrent->getUserFieldValues(true,array('contact','social'))}
		<div id="user-field-contact-contener">
		{foreach from=$aUserFieldContactValues item=oField}
			<p class="js-user-field-item">
				<select name="profile_user_field_type[]"  onchange="ls.userfield.changeFormField(this);">
				{foreach from=$aUserFieldsContact item=oFieldAll}
					<option value="{$oFieldAll->getId()}" {if $oFieldAll->getId()==$oField->getId()}selected="selected"{/if}>{$oFieldAll->getTitle()|escape:'html'}</option>
				{/foreach}
				</select>
				<input type="text" name="profile_user_field_value[]" value="{$oField->getValue()|escape:'html'}" class="input-text input-width-200">
				<a class="icon-remove" title="{$aLang.user_field_delete}" href="#" onclick="return ls.userfield.removeFormField(this);"></a>
			</p>
		{/foreach}
		</div>
		{if $aUserFieldsContact}
			<a href="#" onclick="return ls.userfield.addFormField();" class="btn btn-primary btn-small"><i class="icon-hand-up icon-white"></i>{$aLang.user_field_add}</a>
		{/if}
	</fieldset>
		{*
		{if count($aUserFields)}
			{foreach from=$aUserFields item=oField}
				<p><label for="profile_user_field_{$oField->getId()}">{$oField->getTitle()|escape:'html'}:</label><br /><input type="text" class="input-200" name="profile_user_field_{$oField->getId()}" id="profile_user_field_{$oField->getId()}" value="{$oField->getValue()|escape:'html'}"/></p>
			{/foreach}
		{/if}*}
 
		<input type="submit" class="btn btn-primary btn-small" name="submit_settings_teamplay" value="Save settings"> 
		{if $oPlayercard}
		<input type="submit" class="btn btn-primary btn-small" name="delete_settings_teamplay" value="Delete player card"></div>
		{/if}
</div>


{if $oPlayercard}
<div class="span4">	
<fieldset class="team-contener">
		<legend>Player photo</legend>
<div class="playerphoto-change">
	<div class="playerphoto"><img src="{$oPlayercard->getFotoUrl()}" id="playerphoto-img" /></div>

	<div>
		<a href="#" id="playerphoto-upload" class="link-dotted">{if $oPlayercard->getFotoUrl()}Change photo{else}{$aLang.settings_profile_avatar_upload}{/if}</a><br />
		<a href="#" id="playerphoto-remove" class="link-dotted" onclick="return ls.user.removePlayerPhoto();" style="{if !$oUserCurrent->getProfileAvatar()}display:none;{/if}">{$aLang.settings_profile_avatar_delete}</a>
	</div>
	
	<div id="playerphoto-resize" class="modal modal-upload-playerphoto">
		<header class="modal-header">
			<h3>Photo of gaming profile</h3>
		</header>
		
		<div class="modal-content">
			<div class="clearfix">
				<div class="image-border">
					<img src="" alt="" id="playerphoto-resize-original-img">
				</div>
			</div>
			<button type="submit"  class="button button-primary" onclick="return ls.user.resizePlayerPhoto();">{$aLang.settings_profile_avatar_resize_apply}</button>
			<button type="submit"  class="button" onclick="return ls.user.cancelPlayerPhoto();">{$aLang.settings_profile_avatar_resize_cancel}</button>
		</div>
	</div>
</div>
<style>
{literal}
.modal-upload-playerphoto{width:600px; margin-left: -300px;}
{/literal}
</style>
 
		<legend>Teams</legend>
		
<div class="playercard-invites">


{if $oPlayerTournament && $oPlayerTournament->getTeamId()!=0}

<b>{if $oPlayerTournament->getTeam()}<a href="{$oPlayerTournament->getTeam()->getUrlFull()}">{$oPlayerTournament->getTeam()->getName()}</a>{else}{$oPlayerTournament->getTeam()->getName()}{/if}</b> <a href="javascript:go_from({$oPlayerTournament->getId()},'player');">Leave</a> <br/>
{/if}	
{if $aInvites}	
	You have been invited<br/>	

		{foreach from=$aInvites item=oInvite name=el2}
		<a href="{$oInvite->getTeam()->getUrlFull()}"><b>{$oInvite->getTeam()->getName()}</b></a><br/>
		<a href="javascript:answer_invite({$oInvite->getId()},'player',1)">Join</a> <a href="javascript:answer_invite({$oInvite->getId()},'player',-1)">Decline</a><br/><br/>
		{/foreach}

	<br/>
{/if}
	 
	Send request for join to club<br/>
	<input type="text" class="input-text input-width-200 autocomplete-team" id="teams" name="teams"  /><br/>
	<input type="submit" class="btn btn-primary btn-small" name="send_invites" value="Send"> 
</fieldset>	 
	
	
	
</div>

</div>

{/if}
</div>
</form>
{/if}
{include file='footer.tpl'}