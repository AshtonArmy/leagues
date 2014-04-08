{if $aBlockTopics}
{assign var="for_cookie" value="slider"}
<div class="widget-box transparent {if $smarty.cookies.$for_cookie=='1'}collapsed{/if}">
	<div class="widget-header">
		<h3>Слайдер</h3>
		<div class="widget-toolbar no-border ">  
			<a href="#" data-action="collapse" data-cookie="slider"><i class="icon-chevron-{if $smarty.cookies.$for_cookie=='1'}down{else}up{/if}"></i></a> 
		</div>
	</div>	
	<div class="widget-body">
		<div class="tabbable tabs-right custom tabs-shadow tabs-space">
		 <ul class="nav nav-tabs" id="myTab" style="width:30%;"> 
			{foreach from=$aBlockTopics item=oBlockTopic name=control}
				 <li class="{if $smarty.foreach.control.iteration==1}active{/if}"><a data-toggle="tab" href="#home{$oBlockTopic->getId()}">{$oBlockTopic->getTitle()|truncate:60:'...'}</a></li>
			 {/foreach}
						
		 </ul>
		 <div class="tab-content">
			{foreach from=$aBlockTopics item=oBlockTopic name=control}
				<div id="home{$oBlockTopic->getId()}" class="tab-pane {if $smarty.foreach.control.iteration==1}active{/if}">
				   <a href="{$oBlockTopic->getUrl()}"><img src="{$oBlockTopic->getPreviewImageWebPath('555crop')}"/></a>
				</div> 
			{/foreach}
			 
		 </div>
	  </div>
	</div>
</div> 
{literal}
<script>
$(function() {
    var tabCarousel = self.setInterval(function() {

        var tabs = $('#myTab.nav-tabs > li'),
            active = tabs.filter('.active'),
            next = active.next('li'),
            toClick = next.length ? next.find('a') : tabs.eq(0).find('a');

        toClick.trigger('click');
    }, 15000);
});
</script>
{/literal}
{/if}