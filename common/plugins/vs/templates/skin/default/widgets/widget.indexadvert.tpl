<section class="block" id="advertlist">

    <header class="block-header sep">
        <h3>{$aLang.plugin.vs.announcements} <span></span></h3>
    </header>

    <div class="block-content">
        <ul>
            {foreach from=$aAdverts item=oAdvert}
                <li> 
					{assign var=topic_id value=$oAdvert->getTopicId()}
					{assign var=oTopic value=$ResultTopics.$topic_id} 
                    {*<a href="{$oUser->getUserWebPath()}" class="author"><i></i>{$oUser->getLogin()}</a>*}
                    <a href="{if $oTopic}{$oTopic->getUrl()}{else}#{/if}" class="txt">{$oAdvert->getText()|truncate:40:'...'}</a>
                </li>
            {/foreach}
        </ul>
    </div>

    <footer>
        {if $oUserCurrent && $oUserCurrent->isAdministrator()}<a href="{router page='adminvs'}advert/add" class="left add js-write-window-show" id="modal_write_show">+ <span>{$aLang.plugin.vs.add}</span></a>{/if}
        <a href="#" class="right">{$aLang.plugin.vs.archive}</a>
    </footer>

</section>
