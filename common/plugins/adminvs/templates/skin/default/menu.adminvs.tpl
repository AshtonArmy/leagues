 {* <ul class="menu">
  <li {if $sMenuItemSelect=='tour'}class="active"{/if}>
        <a href="{router page='adminvs'}">Админка</a>
	{if $sMenuItemSelect=='tour'}*}
        <ul class="sub-menu" >
            <li {if $sMenuSubItemSelect=='platform' || $sMenuSubItemSelect==''}class="active"{/if}><div><a href="{router page='adminvs'}platform/">Платформы</a></div></li>
			<li {if $sMenuSubItemSelect=='sport'}class="active"{/if}><div><a href="{router page='adminvs'}sport/">Вид спорта</a></div></li>
			<li {if $sMenuSubItemSelect=='game'}class="active"{/if}><div><a href="{router page='adminvs'}game/">Игра</a></div></li>
			<li {if $sMenuSubItemSelect=='gametype'}class="active"{/if}><div><a href="{router page='adminvs'}gametype/">Тип турнира</a></div></li>
			<li {if $sMenuSubItemSelect=='turnir'}class="active"{/if}><div><a href="{router page='adminvs'}turnir/">Турнир</a></div></li>
			<li {if $sMenuSubItemSelect=='team'}class="active"{/if}><div><a href="{router page='adminvs'}team/">Команды</a></div></li>
			<li {if $sMenuSubItemSelect=='medal'}class="active"{/if}><div><a href="{router page='adminvs'}medal/">Медали</a></div></li>
			<li {if $sMenuSubItemSelect=='advert'}class="active"{/if}><div><a href="{router page='adminvs'}advert/">{$aLang.plugin.vs.announcements}</a></div></li>
		</ul>
{*	{/if}
    </li>
</ul>
*}
