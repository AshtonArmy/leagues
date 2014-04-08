	<strong>Настройки отображения элементов</strong>
	<p>
		<label><input {if $oUserCurrent->getSettingsShowTurnirs()}checked{/if} type="checkbox" id="settings_show_turnirs" name="settings_show_turnirs" value="1" class="checkbox" />показывать блок "Турниры" на всех страницах</label><br />
	</p>
	<p>
		<label>Ваш турнир по умолчанию (отображается на главной):</label><br />
		<select name="settings_what_turnir">
			<option value="0">-</option>
			{foreach from=$aTournament item=oTournament name=el2} 
				<option value="{$oTournament->getTournamentId()}" {if $oTournament->getTournamentId()==$oUserCurrent->getSettingsWhatTurnir()}selected{/if}>{$oTournament->getName()}</option>
			{/foreach}
		</select>
	</p>
	
	<p>
		<label>На главной показывать топики:</label><br />
		<select name="settings_show_only_blogs">
			<option value="0" {if $oUserCurrent->getSettingsShowOnlyBlogs()==0}SELECTED{/if}>со всего сайта</option>
			<option value="1" {if $oUserCurrent->getSettingsShowOnlyBlogs()==1}SELECTED{/if}>только из блогов в которых я состою</option>
		</select>
	</p>
	
	<p>
		<label>Сортировать топики:</label><br />
		<select name="settings_show_order">
			<option value="0" {if $oUserCurrent->getSettingsShowOrder()==0}SELECTED{/if}>в порядке создания</option>
			<option value="1" {if $oUserCurrent->getSettingsShowOrder()==1}SELECTED{/if}>в порядке последней активности</option>
		</select>
	</p>