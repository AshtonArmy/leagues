{if $oBlogEdit && (  $oBlogEdit->getLeague()==1)}
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
	params['blog_id']={/literal}{$oBlogEdit->getId()} {literal}; 
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
	<label for="blog_small_logo">Загрузить маленькое лого (32x32):</label>
	<form method="post" id="form_small_logo" enctype="multipart/form-data"> 
		<input type="file" name="blog_small_logo" id="blog_small_logo" class="input-text" onchange="upload_logo('small_logo'); return false;"/>
		<input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}">
		<input type="hidden" name="blog_id" value="{$oBlogEdit->getId()}">
		<input type="hidden" name="logo_type" value="small_logo">
	</form>
	<div id="brand_box_image">
	{if $oBlogEdit->getLogoSmall()}
		<br/>
		<a href="{$oBlogEdit->getLogoSmall()}"rel="[photoset]" title="" class="photoset-image"><img src="{cfg name='path.root.web'}/images/blog/{$oBlogEdit->getUrl()}/{$oBlogEdit->getLogoSmall()}" alt="" width="32"/></a>
		<label><input onchange="delete_logo('small_logo'); return false;" type="checkbox" id="blog_small_logo_delete" name="blog_small_logo_delete" value="on" class="input-checkbox"> Удалить маленький лого</label>
	{/if}
	</div>
</p> 
<p>
	<label for="blog_full_logo">Загрузить Большое лого (200x200):</label>
	<form method="post" id="form_full_logo" enctype="multipart/form-data"> 
		<input type="file" name="blog_full_logo" id="blog_full_logo" class="input-text" onchange="upload_logo('full_logo'); return false;"/>
		<input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}">
		<input type="hidden" name="blog_id" value="{$oBlogEdit->getblogId()}">
		<input type="hidden" name="logo_type" value="full_logo">
	</form>
	<div id="brand_box_image">
	{if $oBlogEdit->getLogoFull()}
		<br/>
		<a href="{$oBlogEdit->getLogoFull()}"rel="[photoset]" title="" class="photoset-image"><img src="{cfg name='path.root.web'}/images/blog/{$oBlogEdit->getUrl()}/{$oBlogEdit->getLogoFull()}" alt="" /></a>
		<label><input onchange="delete_logo('full_logo'); return false;" type="checkbox" id="blog_full_logo_delete" name="blog_full_logo_delete" value="on" class="input-checkbox"> Удалить большое лого</label>

	{/if}
	</div>
</p>
{*{if $oBlogEdit->getTeam()==1 && ($oUserCurrent && ($oUserCurrent->getLogin()=='Klaus' || $oUserCurrent->getLogin()=='2ManyFaces'))}
<p>
	<label for="blog_team_logo">Загрузить Командное лого (100x54):</label>
	<form method="post" id="form_team_logo" enctype="multipart/form-data"> 
		<input type="file" name="blog_team_logo" id="blog_team_logo" class="input-text" onchange="upload_logo('team_logo'); return false;"/>
		<input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}">
		<input type="hidden" name="blog_id" value="{$oBlogEdit->getblogId()}">
		<input type="hidden" name="logo_type" value="team_logo">
	</form>
	<div id="brand_box_image">
	{if $oBlogEdit->getLogoTeam()}
		<br/>
		<a href="{$oBlogEdit->getLogoTeam()}"rel="[photoset]" title="" class="photoset-image"><img src="{cfg name='path.root.web'}/images/blog/{$oBlogEdit->getUrl()}/{$oBlogEdit->getLogoTeam()}" alt="" /></a>
		<label><input onchange="delete_logo('team_logo'); return false;" type="checkbox" id="blog_team_logo_delete" name="blog_team_logo_delete" value="on" class="input-checkbox"> Удалить командное лого</label>

	{/if}
	</div>
</p>
{/if}*}
{/if}