<section class="block" id="newslist">

    <header class="block-header sep">
        <h3><a href="{router page='potok'}">{$aLang.plugin.vs.news_feed}</a></h3>
        {if $oUserCurrent}<a href="{router page='topic'}add" class="add js-write-window-show" id="modal_write_show"><span>{$aLang.plugin.vs.add}</span> +</a>{/if}
    </header>

    <div class="block-content">

        {if count($aNews)>0}
            {assign var="num_news" value=0}

            {foreach from=$aNews item=oTopic}
                {assign var="num_news" value=$num_news+1}
                <article {if $num_news<4}class="first"{/if}>
                    {if $num_news<4}
                        <a class="preview_img" href="{$oTopic->getUrl()}">
                            {if $oTopic->getPreviewImage()}
                                <img src="{$oTopic->getPreviewImageWebPath(80crop)}" alt="{$oTopic->getTitle()}" title="{$oTopic->getTitle()}"/>
                            {else}
                                <span class="no_preview_img"></span>
                            {/if}
                        </a>
                    {/if}
                    {if $LS->Topic_IsAllowTopicType($oTopic->getType())}
                        {assign var="sTopicTemplateName" value="topic_block_indexnews.tpl"}
                        {include file=$sTopicTemplateName bTopicList=true}
                    {/if}
                </article>
            {/foreach}

        {else}
            {$aLang.blog_no_topic}
        {/if}

    </div>

</section>