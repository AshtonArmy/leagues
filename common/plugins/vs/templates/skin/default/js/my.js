
	ls.hook.add('ls_blog_load_info_after', function (idBlog, result) {

	    $('#tournament_id').find('option').remove();

	    $('#tournament_id')
	        .append($("<option></option>")
	            .attr("value", 0)
	            .text('-'));
 
		$.each(result.selectValues, function (key, value) {

	        if (topic_tournament != key) {
	            $('#tournament_id')
	                .append($("<option></option>")
	                    .attr("value", key)
	                    .text(value));

	        } else {
	            $('#tournament_id')
	                .append($("<option></option>")
	                    .attr("value", key)
	                    .attr("selected", true)
	                    .text(value));
	        }
	    });

	});
	jQuery(document).ready(function ($) {



	    ls.autocomplete.add($(".autocomplete-playercard"), aRouter['ajax'] + 'autocompleter/playercard/', true);
	    ls.autocomplete.add($(".autocomplete-team"), aRouter['ajax'] + 'autocompleter/team/', false);
	    if(ls.blocks){
			ls.blocks.options.type.stream_matches = {
				url: aRouter['ajax'] + 'stream/matches/'
			}
		}


	});

	function go_from(playertournament, who) {
	    var params = {};
	    params['playertournament_id'] = playertournament;
	    params['who'] = who;
	    params['security_ls_key'] = LIVESTREET_SECURITY_KEY;
	    ls.ajax(aRouter['ajax'] + 'go/from/', params, function (result) {
	        if (!result) {
	            ls.msg.error('Error5', 'Please try again later');
	        }
	        if (result.bStateError) {
	            ls.msg.error(result.sMsgTitle, result.sMsg);
	        } else {
	            ls.msg.notice(result.sMsgTitle, result.sMsg);
	            window.location.reload();
	        }
	    });

	}

	function answer_invite(invite, who, id) {
	    why = '';
	    if (id == -1) {
	        why = prompt('Why?', '');
	    }
	    var params = {};
	    params['invite_id'] = invite;
	    params['who'] = who;
	    params['id'] = id;
	    params['why'] = why;
	    params['security_ls_key'] = LIVESTREET_SECURITY_KEY;
	    ls.ajax(aRouter['ajax'] + 'answer/invite/', params, function (result) {
	        if (!result) {
	            ls.msg.error('Error5', 'Please try again later');
	        }
	        if (result.bStateError) {
	            ls.msg.error(result.sMsgTitle, result.sMsg);
	        } else {
	            ls.msg.notice(result.sMsgTitle, result.sMsg);
	            window.location.reload();
	        }
	    });
	}