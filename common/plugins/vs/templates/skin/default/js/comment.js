jQuery(document).ready(function($){
	
	// Вставка комментария
/*
	ls.comments.inject = function(idCommentParent, idComment, sHtml) {
		if (idCommentParent) {
			classes = $('#comment_id_'+idCommentParent).attr("class").split(' ');
			parent_level = 0;  
			for(var i=0, l = classes.length; i < l; i++){
				if(classes[i].substring(0,14)=='comment_level_'){
					parent_level = classes[i].substring(14);
				}
			}
			our_level = parseInt(parent_level) + 1; 
			if(our_level > this.options.max_level)our_level = this.options.max_level;
		}else{
			our_level = '0';
		}
		var newComment = $('<div>', {'class': 'comment comment_level_'+our_level+' comment comment-new', id: 'comment_id_'+idComment}).html(sHtml);
		if (idCommentParent) {
			posted = 0;
			idToPost=idCommentParent;  
			comment_level = 0;
			$('#comment_id_'+idCommentParent).nextAll().each( function() {  
				classes = $(this).attr("class").split(' ');
				for(var i=0, l = classes.length; i < l; i++){
					if(classes[i].substring(0,14)=='comment_level_'){
						comment_level = classes[i].substring(14);
					}
				} 
				if(comment_level<our_level){
					newComment.insertAfter('#comment_id_'+idToPost);
					posted++;
					return false;
				}
				idToPost=parseInt($(this).attr("id").substring(11));
			}); 
		    if (posted==0)newComment.insertAfter('#comment_id_'+idToPost); 
		} else {
			$('#comments').append(newComment);
		}		 
	}
*/
// Показывает/скрывает форму комментирования
/*
	ls.comments.toggleCommentForm = function(idComment, bNoFocus) {
		var reply=$('#reply');
		if(!reply.length){
			return;
		}
		$('#comment_preview_' + this.iCurrentShowFormComment).remove();

		if (this.iCurrentShowFormComment==idComment && reply.is(':visible')) {
			reply.hide();
			return;
		}
		if (this.options.wysiwyg) {
			tinyMCE.execCommand('mceRemoveControl',true,'form_comment_text');
		}
		reply.insertAfter('#comment_id_'+idComment).show();
		$('#form_comment_text').val('');
		$('#form_comment_reply').val(idComment);
		
		this.iCurrentShowFormComment = idComment;
		if (this.options.wysiwyg) {
			tinyMCE.execCommand('mceAddControl',true,'form_comment_text');
		}
		if (!bNoFocus) $('#form_comment_text').focus();
		
		if ($('html').hasClass('ie7')) {
			var inputs = $('input.input-text, textarea');
			ls.ie.bordersizing(inputs);
		}
		if($('#form_comment textarea').val() == ''){ 
			if($('#comment_id_'+idComment+' ul.comment-info li.comment-author a').text() != '')$('#form_comment textarea').val( $('#comment_id_'+idComment+' ul.comment-info li.comment-author a').text() +', ' );
		}
	};	
*/
	ls.comments.toggleCommentForm = function(idComment, bNoFocus, mode) {
        var replyForm = this.getReplyForm();
		if(!replyForm){
			return;
		}
        if (!mode) mode = 'reply';
		$('#comment_preview_' + this.iCurrentShowFormComment).remove();

		if (this.iCurrentShowFormComment==idComment && replyForm.is(':visible')) {
            $('#comment_id_'+idComment + ' .comment-actions [class|=comment]').removeClass('active');
            if (replyForm.find('[name=comment_mode]').val() == mode) {
                this.hideCommentForm();
                return false;
            }
		}
		if (this.options.wysiwyg) {
			tinyMCE.execCommand('mceRemoveControl',true,'form_comment_text');
		}
        replyForm.insertAfter('#comment_id_'+idComment).show();

		this.iCurrentShowFormComment = idComment;
		if (this.options.wysiwyg) {
			tinyMCE.execCommand('mceAddControl',true,'form_comment_text');
            if (!bNoFocus) tinyMCE.activeEditor.focus();
		} else {
            if (!bNoFocus) $('#form_comment_text').focus();
        }
        this.formCommentText('');
        replyForm.find('[name=comment_mode]').val(mode);
        $('#form_comment_reply').val(idComment);

		if ($('html').hasClass('ie7')) {
			var inputs = $('input.input-text, textarea');
			ls.ie.bordersizing(inputs);
		}
        if (mode == 'edit') {
            //replyForm.find('.btn-reply').hide();
            //replyForm.find('.btn-edit').show();
            $('#comment-button-submit').hide();
            $('#comment-button-edit').show();
            replyForm.find('.reply-notice-add').hide();
            replyForm.find('.reply-notice-edit').show();
            $('#comment_id_'+idComment + ' .comment-actions .comment-reply').removeClass('active');
            $('#comment_id_'+idComment + ' .comment-actions .comment-edit').addClass('active');
        } else {
            //replyForm.find('.btn-reply').show();
            //replyForm.find('.btn-edit').hide();
            $('#comment-button-submit').show();
            $('#comment-button-edit').hide();
            replyForm.find('.reply-notice-add').show();
            replyForm.find('.reply-notice-edit').hide();
            $('#comment_id_'+idComment + ' .comment-actions .comment-reply').addClass('active');
            $('#comment_id_'+idComment + ' .comment-actions .comment-edit').removeClass('active');
        }
        if (!idComment) {
            $('.comment-actions [class|=comment]').removeClass('active');
        }
		if($('#form_comment textarea').val() == '' && mode!='edit'){ 
			if($('#comment_id_'+idComment+' ul.comment-info li.comment-author a').text() != '')$('#form_comment textarea').val( $('#comment_id_'+idComment+' ul.comment-info li.comment-author a').text() +', ' );
		}
        return true;
    };
});