<li class="nav-header">
	<i class="icon-envelope"></i> {$iUserCurrentCountTalkNew} Messages
</li>
{if $aTalks}
{foreach from=$aTalks item=oTalk}
{assign var="oUser" value=$oTalk->getUserLast()}
<li>
	<a href="{router page='talk'}read/{$oTalk->getId()}/"> 
		<img src="{$oUser->getProfileAvatarPath(48)}" alt="Avatar {$oUser->getLogin()}" class="msg-photo" />
		<span class="msg-body">
			<span class="msg-title">
				<span class="blue">{$oUser->getLogin()}:</span>
				{if !$oTalk->getTextLast()}{$oTalk->getTitle()}{else}{$oTalk->getTextLast()|strip_tags|truncate:75:'...'|escape:'html'}{/if}
			</span>
			<span class="msg-time">
				<i class="icon-time"></i> <span>{date_format date=$oTalk->getDate() format="j F Y, H:i"}</span>
			</span>
		</span>
	</a>
</li>
{/foreach}
{/if}
<li>
	<a href="{router page='talk'}">
		See all messages
		<i class="icon-arrow-right"></i>
	</a>
</li>