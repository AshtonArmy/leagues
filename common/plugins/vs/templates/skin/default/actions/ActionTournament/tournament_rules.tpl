{include file='header.tpl' menu_content='tournament'}
 
<div class="content">
	{if $can_edit}
		<a href="{$oTournament->getUrlFull()}rules/edit/">Edit</a>
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