<style>
#content {
padding-top: 0px;
}
</style>
<div class="turnirmenu">
<div class="button_top underline">
		<div class="left active">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link}">Блог</a></div>
		</div>
		<div class="left">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_uchastniki}">Участники</a></div>
		</div>
		<div class="left">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_stats}">Статистика</a></div>
		</div>
{if $oTournament && $oTournament->getGametypeId()==3}
		<div class="left">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_player_stats}">Личная стат.</a></div>
		</div>
{/if}
{if isset($po)}
		<div class="left">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_po}">ПО</a></div>
		</div>
{/if}
		<div class="left">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_raspisanie}">Расписание</a></div>
		</div>
		<div class="left">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_sobytiya}">События</a></div>
		</div>
		<div class="left">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_reglament}">Регламент</a></div>
		</div>
{if $admin=="yes"}
		<div class="left">
			<div class="lefts"></div>
			<div class="rights"></div>
			<div class="mid"><a href="{$link_au}">АУ</a></div>
		</div>
{/if}	

</div>
</div>
</br>