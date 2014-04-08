$(document).ready(function() {
	ls.stream.getMoreEvents = function (tournament_id) {
		if (this.isBusy) {
			return;
		}
		var lastId = $('#stream_last_id').val();
		if (!lastId) return;
		$('#stream_get_more').addClass('stream_loading');
		this.isBusy = true;

		ls.ajax(aRouter['ajax']+'get_more_events/', {
			'last_id':lastId,
			'security_ls_key':LIVESTREET_SECURITY_KEY,
			'tournament_id':tournament_id


		}, function(data) {
			if (!data.bStateError && data.events_count) {
				$('#stream-list').append(data.result);
				$('#stream_last_id').attr('value', data.iStreamLastId);
			}
			if (!data.events_count) {
				$('#stream_get_more').css({
					'display':'none'
				});
			}
			$('#stream_get_more').removeClass('stream_loading');

			this.isBusy = false;
		}.bind(this));
	}
});