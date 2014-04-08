<section class="block" id="videolist">

    <header class="block-header sep">
        <h3><a href="#">{$aLang.plugin.vs.video_channel}</a></h3>
        <a href="{router page='video'}add" class="add js-write-window-show" id="modal_write_show"><span>{$aLang.plugin.vs.add}</span> +</a>
		
    </header>

    <div class="block-content">

        {if count($aVideos)>0}

            {foreach from=$aVideos item=oTopic}
                <article>
                    <a class="preview_img" href="{$oTopic->getUrl()}">
                        {if $oTopic->getPreviewImage()}
                            <img src="{$oTopic->getPreviewImageWebPath(385crop)}" alt="{$oTopic->getTitle()}" title="{$oTopic->getTitle()}"/>
                        {else}
                            <span class="no_preview_img"></span>
                        {/if}
                    </a>
                    {if $LS->Topic_IsAllowTopicType($oTopic->getType())}
                        {assign var="sTopicTemplateName" value="topic_block_indexvideo.tpl"}
                        {include file=$sTopicTemplateName bTopicList=true}
                    {/if}
                </article>
            {/foreach}

        {else}
            {$aLang.blog_no_topic}
        {/if}

    </div>

</section>