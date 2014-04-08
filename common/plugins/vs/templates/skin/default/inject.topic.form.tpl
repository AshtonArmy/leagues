{if $oUserCurrent}
	<p><label><input type="checkbox" id="topic_slider_add" name="topic_slider_add" class="input-checkbox" value="1" {if $oTopicEdit && $oTopicEdit->getSliderAdd()}checked="checked"{/if} />
	{$aLang.plugin.vs.slider_add}</label></p>
	
	<p><label><input type="checkbox" id="topic_sticky" name="topic_sticky" class="input-checkbox" value="1" {if $oTopicEdit && $oTopicEdit->getSticky()}checked="checked"{/if} />
	{$aLang.plugin.vs.sticky}</label></p>
	
	<p><label><input type="checkbox" id="topic_faq" name="topic_faq" class="input-checkbox" value="1" {if $oTopicEdit && $oTopicEdit->getFaq()}checked="checked"{/if} />
	{$aLang.plugin.vs.faq}</label></p>
{/if}