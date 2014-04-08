<ul class="item-list">
	{foreach from=$aComments item=oComment name="cmt"}
		{assign var="oUser" value=$oComment->getUser()}
		{assign var="oMatch" value=$oComment->getTarget()} 
{if $oMatch}	
		{assign var="oHomeTeam" value=$oMatch->getHometeam()}
		{assign var="oAwayTeam" value=$oMatch->getAwayteam()}
		{assign var="oTournament" value=$oMatch->getTournament()}

<li {*class="js-title-comment"*} title="{$oComment->getText()|strip_tags|trim|truncate:100:'...'|escape:'html'}">
            <a href="{$oUser->getUserWebPath()}"><img src="{$oUser->getProfileAvatarPath(48)}" alt="{$oUser->getLogin()}" title="{$oUser->getLogin()}" class="avatar" /></a>
			
			 <a href="{$oUser->getUserWebPath()}" class="author">{$oUser->getLogin()}</a> &rarr;
			 
            <a href="{$oTournament->getUrlFull()}" class="blog-name">{$oTournament->getName()|escape:'html'|truncate:16:'..'}</a> &rarr;
			  
			{*  
            <time datetime="{date_format date=$oComment->getDate() format='c'}" title="{date_format date=$oComment->getDate() format="j F Y, H:i"}">
                {date_format date=$oComment->getDate() hours_back="12" minutes_back="60" now="60" day="day H:i" format="d.m.y"}
            </time><br/>
*}
			<a href="{$oTournament->getUrlFull()}match_comment/{$oMatch->getMatchId()}" target="_blank"  class="stream-topic">№{$oMatch->getNumber()} {$oAwayTeam->getName()|truncate:20:'...'}-{$oHomeTeam->getName()|truncate:20:'...'} {$oMatch->getGoalsAway()} : {$oMatch->getGoalsHome()}
				{if $oMatch->getSo()==1} SO{/if}{if $oMatch->getOt()==1} ОТ{/if}{if $oMatch->getTeh()==1} тех.{/if}</a> 
			<p>
                    <time datetime="{date_format date=$oComment->getDate() format='c'}">{date_format date=$oComment->getDate() hours_back="12" minutes_back="60" now="60" day="day H:i" format="j F Y, H:i"}</time> |
                    {$oMatch->getCountComment()} {$oMatch->getCountComment()|declension:$aLang.comment_declension:'russian'}
                </p>
			{*	
			<span class="block-item-comments"><i class="icon-synio-comments-small"></i>{$oMatch->getCountComment()}</span>
			*}
		</li>
	{*	
		<li {if $smarty.foreach.cmt.iteration % 2 == 1}class="even"{/if}>
			<a href="{$oUser->getUserWebPath()}" class="stream-author">{$oUser->getLogin()}</a><br/>
			<span class="stream-comment-icon"></span>
			<a href="{$oBlog->getUrlFull()}turnir/{$oTournament->getUrl()}/_match_comment/{$oMatch->getMatchId()}" target="_blank"  class="stream-comment">№{$oMatch->getNumber()} {$oAwayTeam->getName()} - {$oHomeTeam->getName()} {$oMatch->getGoalsAway()} : {$oMatch->getGoalsHome()}
{if $oMatch->getSo()==1} SO{/if}
{if $oMatch->getOt()==1} ОТ{/if}
{if $oMatch->getTeh()==1} тех.{/if}</a> 
			<span> {$oMatch->getCountComment()}</span><br/>
			<a href="{$oTournament->getUrl()}" class="stream-blog">{$oTournament->getName()|escape:'html'}</a>
		</li> *}
{/if}
	{/foreach}
</ul>

					