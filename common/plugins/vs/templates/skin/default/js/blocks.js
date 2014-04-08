var ls = ls || {};

/**
* Динамическая подгрузка блоков
*/
ls.blocks = (function ($) {
	/**
	* Опции
	*/
	this.options = {
		active: 'active',
		loader: DIR_STATIC_SKIN + '/images/loader.gif',
		type: {
			block_stream_item_comment: {
				url: aRouter['ajax']+'stream/comment/'
			},
			block_stream_item_topic: {
				url: aRouter['ajax']+'stream/topic/'
			},
			block_blogs_item_top: {
				url: aRouter['ajax']+'blogs/top/'
			},
			block_blogs_item_join: {
				url: aRouter['ajax']+'blogs/join/'
			},
			block_blogs_item_self: {
				url: aRouter['ajax']+'blogs/self/'
			},
			block_turnirs_item_my: {
				url: aRouter['ajax']+'turnirs/my/'
			},
			block_turnirs_item_complete: {
				url: aRouter['ajax']+'turnirs/complete/'
			},
			block_turnirs_item_now: {
				url: aRouter['ajax']+'turnirs/now/'
			},
			block_turnirs_item_future: {
				url: aRouter['ajax']+'turnirs/future/'
			}
		}
	};

	/**
	* Метод загрузки содержимого блока
	*/
	this.load = function(obj, block, params){
		var id = $(obj).attr('id');
		params=$.extend(true,{},this.options.type[id].params || {},params || {});
		
		if(block=='block_turnirs'){
			var content = $('#horiz_container_inner');
		}else{
			var content = $('#'+block+'_content');
		}
		
		this.showProgress(content);
 
			var divSmall= $(obj).parent('div');
			var divCurrent=divSmall.parent('div');
			var divMenu=divCurrent.parent('div');
			var divList=divMenu.children('div');
			divList.each(function(index, item) {   
            	$(item).removeClass('active');        		
        	});
			divCurrent.addClass(this.options.active);
			
		$('[id^="'+block+'_item"]').removeClass(this.options.active);
		$(obj).addClass(this.options.active);

		ls.ajax(this.options.type[id].url, params, function(result){
			this.onLoad(content,id,result);
		}.bind(this));
	};

	/**
	* Отображение процесса загрузки
	*/
	this.showProgress = function(content) {
		content.html($('<div />').css('text-align','center').append($('<img>', {src: this.options.loader})));
	};

	/**
	* Обработка результатов загрузки
	*/
	this.onLoad = function(content,id,result) {
		$(this).trigger('loadSuccessful',[content,id,result]);
		content.empty();
		if (result.bStateError) {
			ls.msg.error(null, result.sMsg);
		} else {
			content.html(result.sText);
			if(result.sElements>=6){				
					$('.spisok_turnir').css('width',(200*result.sElements)+'px');
					//$('knob').css('width',(940/result.sElements)+'px');
					$('.turnir_element').css('width','200px');
					$('#horiz_container_outer').horizontalScroll();
				}else{
					$('.spisok_turnir').css('width','100%');
					//$('knob').css('width','100%');
					$('.turnir_element').css('width',Math.round(100/result.sElements)+'%');
					$('#horiz_container_outer').horizontalScroll();
				}
		}
	};

	return this;
}).call(ls.blocks || {},jQuery);

/**
* Подключаем действующие блоки
*/
jQuery(document).ready(function($){
	$('[id^="block_stream_item"]').click(function(){
		ls.blocks.load(this, 'block_stream');
		return false;
	});

	$('[id^="block_blogs_item"]').click(function(){
		ls.blocks.load(this, 'block_blogs');
		return false;
	});
	$('[id^="block_turnirs_item"]').click(function(){
		ls.blocks.load(this, 'block_turnirs');
		return false;
	});
});