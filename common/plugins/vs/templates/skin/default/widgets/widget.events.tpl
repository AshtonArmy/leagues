<li class="nav-header">
	<i class="icon-envelope"></i> Items
</li>
{if $iUserCurrentCountTrack}
<li>
	<a href="{router page='feed'}track/new/">
		<div class="clearfix">
			<span class="pull-left">
				<i class="btn btn-primary no-hover btn-danger icon-comment"></i>
				New watched comments
			</span>
			<span class="pull-right badge badge-important">+{$iUserCurrentCountTrack}</span>
		</div>
	</a>
</li>
{/if}
<li>
	<a href="{router page='feed'}track/">
		<div class="clearfix">
			<span class="pull-left">
				<i class="btn btn-primary no-hover icon-comment"></i>
				Watched comments
			</span>
		</div>
	</a>
</li>

{if $iUserCurrentCountTopicDraft} 
<li>
	<a href="{router page='content'}saved/">
		<div class="clearfix">
			<span class="pull-left">
				<i class="btn btn-primary no-hover btn-danger icon-pencil"></i>
				{$aLang.topic_menu_saved}
			</span>
			<span class="pull-right badge badge-important">+{$iUserCurrentCountTopicDraft}</span>
		</div>
	</a>
</li>
{/if}
	
<li>
	<a href="{router page='talk'}">
		See all messages
		<i class="icon-arrow-right"></i>
	</a>
</li>