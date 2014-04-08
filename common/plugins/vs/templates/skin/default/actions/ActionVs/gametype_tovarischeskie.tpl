{include file='header.tpl' menu='blog'}
{assign var="Tovarki" value='1'}
{include file="$sTemplatePathPlugin/actions/ActionVs/gametype_menu.tpl"  whats="tovarki"}
<div class="login-form jqmWindow" id="tovarmatch_form">
	<a href="#" class="close jqmClose"></a>
	<div id="divmatchvyzov"></div><br />
	<form action="javascript:save_vyzov();" >
		<p>
			<textarea id="match_comment" class="comment_textarea" cols="1" rows="1"></textarea>
		</p>
		
		<input type="hidden" name="match_sopernik" id="match_sopernik"/>
		<input type="submit" name="submit_login" class="button" value="Вызвать" /><br />
	</form>
</div>

<div class="login-form jqmWindow" id="tovarmatch_otvet_form">
	<a href="#" class="close jqmClose"></a> 
	<form action="javascript:return false;" >
		<div id="divmatchvyzov_otvet"></div><br />
		<p>
			<textarea id="match_comment_your" class="comment_textarea" cols="1" rows="1"></textarea>
		</p>
		
		<input type="hidden" name="vyzov_id" id="vyzov_id"/>
		<input type="submit" name="submit_login" class="button" onClick="save_vyzov_otvet(2)" value="Отказать" /> 
		<input type="submit" name="submit_login" class="button" onClick="save_vyzov_otvet(1)" value="Принять" /><br />
	</form>
</div>

<div id="tovarki_table">
{insert name="block" block="tovarkitableloader" params=$par}
</div>
 
{include file='footer.tpl'}
 