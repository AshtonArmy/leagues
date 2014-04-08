{if $oBlog}  
<ul class="nav nav-tabs">
	<li {if $sMenuSubItemSelect=="index"}class="active"{/if}><a href="{$oBlog->getTeamUrlFull()}">Home</a></li>
	<li {if $sMenuSubItemSelect=="blog"}class="active"{/if}><a href="{$oBlog->getUrlFull()}">Blog</a></li>
</ul>
{/if}