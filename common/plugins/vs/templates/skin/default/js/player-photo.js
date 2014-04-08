var ls = ls || {};

/**
 * Управление пользователями
 */
ls.user = (function ($) {
 
	this.jcropPlayerPhoto=null;

	/**
	 * Загрузка временной аватарки
	 * @param form
	 * @param input
	 */
	this.uploadPlayerPhoto = function(form,input) {
		if (!form && input) {
			var form = $('<form method="post" enctype="multipart/form-data"></form>').css({
				'display': 'none'
			}).appendTo('body');
			var clone=input.clone(true);
			input.hide();
			clone.insertAfter(input);
			input.appendTo(form);
		}

		ls.ajaxSubmit(aRouter['settings']+'profiles/upload-playerphoto/',form,function(data){
			if (data.bStateError) {
				ls.msg.error(data.sMsgTitle,data.sMsg);
			} else {
				this.showResizePlayerPhoto(data.sTmpFile);
			}
		}.bind(this));
	};

	/**
	 * Показывает форму для ресайза аватарки
	 * @param sImgFile
	 */
	this.showResizePlayerPhoto = function(sImgFile) {
		if (this.jcropPlayerPhoto) {
			this.jcropPlayerPhoto.destroy();
		}
		$('#playerphoto-resize-original-img').attr('src',sImgFile+'?'+Math.random());
		$('#playerphoto-resize').jqmShow();
		var $this=this;
		$('#playerphoto-resize-original-img').Jcrop({
			aspectRatio: 0.6667,
			minSize: [100,150]
		},function(){
			$this.jcropPlayerPhoto=this;
			this.setSelect([0,0,500,500]);
		});
	};

	/**
	 * Выполняет ресайз аватарки
	 */
	this.resizePlayerPhoto = function() {
		if (!this.jcropPlayerPhoto) {
			return false;
		}
		var url = aRouter.settings+'profiles/resize-playerphoto/';
		var params = {size: this.jcropPlayerPhoto.tellSelect()};

		ls.hook.marker('resizePlayerPhotoBefore');
		ls.ajax(url, params, function(result) {
			if (result.bStateError) {
				ls.msg.error(null,result.sMsg);
			} else {
				$('#playerphoto-img').attr('src',result.sFile+'?'+Math.random());
				$('#playerphoto-resize').jqmHide();
				$('#playerphoto-remove').show();
				$('#playerphoto-upload').text(result.sTitleUpload);
				ls.hook.run('ls_user_resize_avatar_after', [params, result]);
			}
		});

		return false;
	};

	/**
	 * Удаление аватарки
	 */
	this.removePlayerPhoto = function() {
		var url = aRouter.settings+'profiles/remove-playerphoto/';
		var params = {};

		ls.hook.marker('removePlayerPhotoBefore');
		ls.ajax(url, params, function(result) {
			if (result.bStateError) {
				ls.msg.error(null,result.sMsg);
			} else {
				$('#playerphoto-img').attr('src',result.sFile+'?'+Math.random());
				$('#playerphoto-remove').hide();
				$('#playerphoto-upload').text(result.sTitleUpload);
				ls.hook.run('ls_user_remove_avatar_after', [params, result]);
			}
		});

		return false;
	};

	/**
	 * Отмена ресайза аватарки, подчищаем временный данные
	 */
	this.cancelPlayerPhoto = function() {
		var url = aRouter.settings+'profiles/cancel-playerphoto/';
		var params = {};

		ls.hook.marker('cancelPlayerPhotoBefore');
		ls.ajax(url, params, function(result) {
			if (result.bStateError) {
				ls.msg.error(null,result.sMsg);
			} else {
				$('#playerphoto-resize').jqmHide();
				ls.hook.run('ls_user_cancel_avatar_after', [params, result]);
			}
		});

		return false;
	};

	return this;
}).call(ls.user || {},jQuery);