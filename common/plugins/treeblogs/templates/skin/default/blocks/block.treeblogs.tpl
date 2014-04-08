{if $aTree|@count}
    <div class="block stream">
        <div class="tl"><div class="tr"></div></div>
        <div class="cl"><div class="cr">
        <h1>{$aLang.plugin.treeblogs.block_menutree_title}</h1>
            <div class="menutree">
                <ul class="active level0">
                    {include file="treeblogs-level.tpl" aTree=$aTree level=0}
                </ul>
            </div>
        </div></div>
        <div class="bl"><div class="br"></div></div>
    </div>
{/if}
Получаем три уровня, Раздел - Форум - подфорумы<br/>
{if $aForums}
	{foreach from=$aForums item=oForum}
		-{$oForum->getTitle()}</br>
			{assign var="aSubForums" value=$oForum->getSubForums()}
			{foreach from=$aSubForums.collection item=oSubForum}
				--{$oSubForum->getTitle()}</br>
					{assign var="aSubSubForums" value=$oSubForum->getSubForums()}
					{foreach from=$aSubSubForums.collection item=oSubSubForum}
						---{$oSubSubForum->getTitle()}</br>
					{/foreach}
			{/foreach}
	{/foreach}
{/if}