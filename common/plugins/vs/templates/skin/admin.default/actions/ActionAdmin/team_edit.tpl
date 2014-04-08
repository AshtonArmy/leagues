{extends file='_index.tpl'}

{block name="content-bar"}
    <div class="btn-group">
        <a href="{router page='admin'}newteams/" class="btn"><i class="icon-chevron-left"></i></a>
    </div>
{/block}

{block name="content-body"}

<div class="span12">

    <div class="b-wbox">
        <div class="b-wbox-header">
            <div class="b-wbox-header-title"> 
                {if $sMode=='edit'}
                    Edit team: {$_aRequest.name|strip_tags|escape:'html'}
                {else}
					New team                 
                {/if}
            </div>
        </div>
		
        <div class="b-wbox-content nopadding">
            <form action="{router page='admin'}newteams/" method="POST" class="form-horizontal uniform" enctype="multipart/form-data">
 
                <input type="hidden" name="security_ls_key" value="{$ALTO_SECURITY_KEY}"/>
                <input type="hidden" name="team_id" value="{if $sMode=='edit'}{$_aRequest.team_id}{/if}">
				
				<div class="control-group">
                    <label for="team_name" class="control-label">Name:</label>
                    <div class="controls">
                        <input type="text" id="team_name" class="input-text" name="team_name"
                               value="{if $_aRequest.name}{$_aRequest.name|strip_tags|escape:'html'}{/if}" />
                    </div>
                </div>
				<div class="control-group">
                    <label for="team_brief" class="control-label">Brief:</label>
                    <div class="controls">
                        <input type="text" id="team_brief" class="input-text" name="team_brief"
                               value="{if $_aRequest.brief}{$_aRequest.brief|strip_tags|escape:'html'}{/if}" />
                    </div>
                </div>
				<div class="control-group">
                    <label for="team_brief" class="control-label">Owner:</label>
                    <div class="controls">
                        <input type="text" id="owner" class="input-text autocomplete-users" name="owner"
                               value="{if $_aRequest.owner}{$_aRequest.owner|strip_tags|escape:'html'}{/if}" />
                    </div>
                </div>
				<div class="control-group">
					<label for="team_game_id" class="control-label">Game:</label>
					<div class="controls">
						<select  name="game_id">
						{foreach from=$oGame item=Game}   
							<option value="{$Game->getId()}" {if $Game->getId()==$_aRequest.game_id}SELECTED{/if}>{$Game->getName()}_{foreach from=$oPlatform item=Platform}   
												{if $Game->getPlatformId()== $Platform->getId()}{$Platform->getName()} {/if}{/foreach}</option>
						{/foreach}
						<option value="0" {if  '0'==$_aRequest.game_id}SELECTED{/if}>-</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label for="team_gametype_id" class="control-label">Gametype:</label>
					<div class="controls">
						<select  name="gametype_id" >   
							<option value="3" {if '3'==$_aRequest.gametype_id}SELECTED{/if}>teamplay</option> 
							<option value="2" {if '2'==$_aRequest.gametype_id}SELECTED{/if}>2 on 2</option>
							<option value="1" {if '1'==$_aRequest.gametype_id}SELECTED{/if}>1 on 1</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label for="team_forma_field" class="control-label">Forma:</label>
					<div class="controls">
						<select  name="forma_field">  
						{foreach from=$teams item=forma}			
							<option value="{$forma.img}" {if $forma.img==$_aRequest.forma_field}SELECTED{/if}>{$forma.name}</option>
						{/foreach}
						</select>
					</div>
				</div>
				<div class="control-group">
                    <label for="team_links" class="control-label">Link to EA:</label>
                    <div class="controls">
                        <input type="text" id="links" class="input-text" name="links"
                               value="{if $_aRequest.links}{$_aRequest.links|strip_tags|escape:'html'}{/if}" />
                    </div>
                </div>
				<div class="control-group">
                    <label for="team_blog_id" class="control-label">Blog:</label>
                    <div class="controls">
                        <select name="blog_id" id="blog_id" >
							<option value="0">-</option>
							{foreach from=$aBlogsAllow item=oBlog}
								<option value="{$oBlog->getId()}" {if ($_aRequest.blog_id==$oBlog->getId())}selected{/if}>{$oBlog->getTitle()|escape:'html'}</option>
							{/foreach}
						</select>
                    </div>
                </div>
				<div class="control-group"> 
					<label for="title_auto" class="control-label">{if $_aRequest.blog_id==0}<strong>{/if}Create blog:{if $_aRequest.blog_id==0}</strong>{/if}</label>
					<div class="controls">
						<label>
							<small>
								<input type="checkbox" id="create_blog" name="create_blog" value="1"
								   class="input-checkbox"
								   {if $_aRequest.blog_id!=0}disabled{/if}/> 
							</small>
						</label>						
					</div>
				</div>
				<div class="control-group">
                    <label for="team_status" class="control-label">Status:</label>
                    <div class="controls">
                        <select  name="status" onchange="toggleForm(this);" >   
							<option value="wait" {if 'wait'==$_aRequest.status}SELECTED{/if}>wait</option> 
							<option value="play" {if 'play'==$_aRequest.status}SELECTED{/if}>play</option>
							<option value="decline" {if 'decline'==$_aRequest.status}SELECTED{/if}>decline</option>
						</select>
                    </div>
                </div>
				<div class="control-group">
                    <label for="team_why" class="control-label">Why:</label>
                    <div class="controls">
                        <input type="text" id="why" class="input-text" name="why"
                               value="" disabled/>
                    </div>
                </div>
				
{literal}
	<script type="text/javascript">
		function toggleForm ( el ) {
			if($(el).val() == 'decline'){
				$('#why').prop("disabled", false);
			}else{
				$('#why').prop("disabled", true);
			}
		};
		jQuery(document).ready(function($){
			ls.autocomplete.add($(".autocomplete-users"), aRouter['ajax']+'autocompleter/user/', false);
		});
	</script>
{/literal}				
                {hook run='plugin_newteam_form_add_end'}
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"
                            name="submit_newteam_save">Save</button>
                </div>

            </form>
        </div>
    </div>

</div>

{/block}