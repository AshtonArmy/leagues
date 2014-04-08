
{if $oUserCurrent->isAdministrator()}
	<p><label><input type="checkbox" id="blog_team" name="blog_team" class="input-checkbox" value="1" {if $oBlogEdit && $oBlogEdit->getTeam()==1}checked{/if} />
	<span class="lbl"> Блог команды</span></label>
	<small class="note">У блога будет оформление как командной страницы</small></p>
	<p><label><input type="checkbox" id="blog_league" name="blog_league" class="input-checkbox" value="1" {if $oBlogEdit && $oBlogEdit->getLeague()==1}checked{/if} />
	<span class="lbl"> Блог лиги</span></label>
	<small class="note">У блога будет оформление как у страницы лиги</small></p>
{else}
	<input type="checkbox" id="blog_team" name="blog_team" style="display:none;" value="1" {if $oBlogEdit && $oBlogEdit->getTeam()==1}checked{/if} />
	<input type="checkbox" id="blog_league" name="blog_league" style="display:none;" value="1" {if $oBlogEdit && $oBlogEdit->getLeague()==1}checked{/if} />
{/if}