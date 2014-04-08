{if $aTeamZayvki}
<p>
{foreach from=$aTeamZayvki key=k item=v}
<a class="authors" target="_blank" href="{router page='profile'}{$v}"> {$v}</a>
{/foreach}
</p>
{/if}