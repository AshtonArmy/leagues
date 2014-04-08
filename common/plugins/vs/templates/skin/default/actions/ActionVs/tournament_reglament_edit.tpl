{include file='header.tpl' menu='blog'}
{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats="reglament"}
 
<div class="content">
 {include file='editor.tpl'}
 <form action="" method="POST" enctype="multipart/form-data" id="form-topic-add" class="wrapper-content">
 <label for="topic_text">Регламент:</label>
	<textarea name="topic_text" id="topic_text" class="mce-editor markitup-editor input-width-full" rows="20">{$oTournamentReglament->getReglamentSource()}</textarea>
	<button type="submit"  name="submit_preview" onclick="ls.topic.preview('form-topic-add','text_preview'); return false;" class="button">{$aLang.topic_create_submit_preview}</button>
	<button type="submit"  name="submit_topic_publish" id="submit_topic_publish" class="button button-primary fl-r">Сохранить</button>
	<input type="hidden" name="topic_type" value="topic" />
	<input type="hidden" id="topic_title" name="topic_title" value="регламент"   />
	<input type="hidden" name="security_ls_key" value="{$ALTO_SECURITY_KEY}" />
	<input type="hidden" id="topic_tags" name="topic_tags" value="регламент" class="input-text input-width-full autocomplete-tags-sep" />
	
</form>	

	
<div class="topic-preview" style="display: none;" id="text_preview"></div>
	
</div>
{include file='footer.tpl'}