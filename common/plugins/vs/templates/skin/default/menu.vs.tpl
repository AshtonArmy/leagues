<ul class="menu">
    <li {if $sMenuItemSelect=='tour'}class="active"{/if}>
        <a href="{router page='adminvs'}">Админка</a>
	{if $sMenuItemSelect=='tour'}
        <ul class="sub-menu" >
            <li {if $sMenuSubItemSelect=='platform' || $sMenuSubItemSelect==''}class="active"{/if}><div><a href="{router page='adminvs'}platform/">Платформы</a></div></li>
			<li {if $sMenuSubItemSelect=='sport'}class="active"{/if}><div><a href="{router page='adminvs'}sport/">Вид спорта</a></div></li>
			<li {if $sMenuSubItemSelect=='game'}class="active"{/if}><div><a href="{router page='adminvs'}game/">Игра</a></div></li>
			<li {if $sMenuSubItemSelect=='game_type'}class="active"{/if}><div><a href="{router page='adminvs'}game_type/">Тип турнира</a></div></li>
			<li {if $sMenuSubItemSelect=='tournament'}class="active"{/if}><div><a href="{router page='adminvs'}tournament/">Турнир</a></div></li>
		</ul>
	{/if}
    </li>
</ul>