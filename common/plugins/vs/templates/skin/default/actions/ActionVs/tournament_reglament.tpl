{include file='header.tpl' menu='blog'}
{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats="reglament"}
 
<div class="content">
{if $can_edit}
<a href="{$link_reglament_edit}">Редактировать</a>
{/if}
<article class="topic topic-type-topic js-topic">
<div class="topic-content text">
{if $Reglament}
{$Reglament}
{/if}
</div>
</article>
 
</div>
{include file='footer.tpl'}