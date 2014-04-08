/*

functions.js

javascript functionality for the NHL 12 player creator

*/

function set_error(errstr) {
	
}

function load_player() {
	
	player = jQuery('#player_type').val();
	player_attr = (player + "_attr").toLowerCase();
	
	player_arr = window[player_attr];

	for (var i= 0; i < attributes.length; i++) {

		attr_name = attributes[i][0];

		jQuery("#" + attr_name + "_base_value").text(player_arr[i][0]);
		jQuery("#" + attr_name + "_total_cap").text(player_arr[i][2]);
		if(player_arr[i][1] == 99) {
			jQuery("#" + attr_name + "_cost_multi").text("");
		} else {
			jQuery("#" + attr_name + "_cost_multi").text(player_arr[i][1]);
		}		
		calc_xp(attr_name);
	}
	calc_overall();
}

function add_xp(attr_name) {
	
	cur_val = parseInt(jQuery("#" + attr_name + "_qty").val());
	
	base_val = parseInt(jQuery('#' + attr_name + "_base_value").text());
	boost_val = parseInt(jQuery('#' + attr_name + "_boost_amt").text());
	cap_val = parseInt(jQuery("#" + attr_name + "_total_cap").text());
	
	if(boost_val == 0) {
		jQuery('#' + attr_name + '_boost_avg').text("0");
		jQuery('#' + attr_name + '_boost_total').text("0");
	}
	
	new_val = cur_val + 1;
	
	total_ovr = base_val + new_val + boost_val;
	total_no_boost = base_val + new_val;
	if(total_ovr > cap_val) {
		total_ovr = cap_val;
		new_val = cur_val;
	}
	
	jQuery("#" + attr_name + "_qty").val(new_val);
	
	jQuery('#' + attr_name + "_total").text(total_ovr);
	
	set_boosts();
	calc_xp(attr_name);
	window.getSelection().removeAllRanges();
}

function remove_xp (attr_name) {
	
	cur_val = parseInt(jQuery("#" + attr_name + "_qty").val());
	
	new_val = cur_val - 1;
	if(new_val < 0) new_val = 0;
	jQuery("#" + attr_name + "_qty").val(new_val);	
	
	base_val = parseInt(jQuery('#' + attr_name + "_base_value").text());
	boost_val = parseInt(jQuery('#' + attr_name + "_boost_amt").text());
	
	total_ovr = base_val + new_val + boost_val;
	jQuery('#' + attr_name + "_total").text(total_ovr);
	
	set_boosts();
	calc_xp(attr_name);
	window.getSelection().removeAllRanges();
}

function calc_xp(attr_name) {
	
	for (var i= 0; i < attributes.length; i++) {
		if(attr_name == attributes[i][0]) {
			cat_name = attributes[i][1];
		}
	}
	
	xp_rem = parseInt(jQuery("#" + cat_name + "_xp_rem").text());
	xp_used = parseInt(jQuery('#' + cat_name + "_xp_used").text());
	
	cur_xp = parseInt(jQuery('#' + attr_name + "_total_xp").text());

	cur_qty =  parseInt(jQuery("#" + attr_name + "_qty").val());
	base_val = parseInt(jQuery('#' + attr_name + "_base_value").text());
	boost_val = parseInt(jQuery('#' + attr_name + "_boost_amt").text());
	
	cur_total = parseInt(jQuery('#' + attr_name + "_total").text());

		
	if(cur_qty < 0) {
	
		jQuery("#" + attr_name + "_qty").val(0);
		calc_xp(attr_name);
	
	} else {

		multiplier = parseInt(jQuery("#" + attr_name + "_cost_multi").text());
		if (!multiplier) multiplier = 99;
			
		multi_steps = Math.floor(cur_qty / multiplier);
		next_cost = (multi_steps * 10) + 10;
		jQuery('#' + attr_name + "_next_cost").text(next_cost);
	
		var xp_cost = 0;
	
		for(var n=1; n <= multi_steps; n++) {
			xp_cost += multiplier * n * 10;
		}

		if(cur_qty % multiplier) {
			xp_cost += ((cur_qty % multiplier) * next_cost);
		}

		jQuery("#" + attr_name + "_total_xp").text(xp_cost);
	
		if(boost_val > 0) {
	
			boost_qty = cur_qty + boost_val;
			boost_multi_steps = Math.floor(boost_qty / multiplier);
			boost_next_cost = (boost_multi_steps * 10) + 10;

			var boost_xp_cost = 0;
		
			for(var n=1; n <= boost_multi_steps; n++) {
				boost_xp_cost += multiplier * n * 10;
			}

			if(boost_qty % multiplier) {
				boost_xp_cost += ((boost_qty % multiplier) * boost_next_cost);
			}
	
			boost_xp_val = boost_xp_cost - xp_cost;

			boost_xp_avg = Math.floor((boost_xp_val / boost_val)*100)/100;
	
			jQuery("#" + attr_name + "_boost_avg").text(boost_xp_avg);
			jQuery("#" + attr_name + "_boost_total").text(boost_xp_val);
			
		}
	
		xp_adj = xp_cost - cur_xp;
		new_xp_rem = xp_rem - xp_adj;
		new_xp_used = xp_used + xp_adj;
	
		jQuery("#" + cat_name + "_xp_rem").text(new_xp_rem);
		jQuery('#' + cat_name + "_xp_used").text(new_xp_used);
		if(new_xp_rem < 0) {
			jQuery("#" + cat_name + "_xp_rem").toggleClass("btn-danger", true);
		} else {
			jQuery("#" + cat_name + "_xp_rem").toggleClass("btn-danger", false);
		}
		
	}
	
	base_val = parseInt(jQuery('#' + attr_name + "_base_value").text());
	points_val = parseInt(jQuery('#' + attr_name + "_qty").val());

	total_ovr = base_val + boost_val + points_val;
	jQuery('#' + attr_name + "_total").text(total_ovr);
	calc_overall();
}

function calc_overall() {

	var ovr = 0;

	for (var o= 0; o < attributes.length; o++) {
	
		attr_name = attributes[o][0];
		attr_val = parseInt(jQuery('#' + attr_name + "_total").text());

		ovr += attr_val;
	}	

	ovr = ovr/24
	ovr = Math.round(ovr);
	jQuery("#off_overall").text(ovr);
	jQuery("#ath_overall").text(ovr);
	jQuery("#def_overall").text(ovr);
}

function change_card() {
	
	var card_xp = parseInt(jQuery('#card_type').val());
	var prev_xp = parseInt(jQuery('#xp').val());
	
	if( jQuery('#off_xp_rem').text() < prev_xp ) {
		new_xp = parseInt(jQuery('#off_xp_rem').text()) + (card_xp - prev_xp);
		jQuery('#off_xp_rem').text( new_xp ).toggleClass('btn-danger',false);
	} else {
		jQuery('#off_xp_rem').text( card_xp );
	}
	
	if( jQuery('#def_xp_rem').text() < prev_xp ) {
		new_xp = parseInt(jQuery('#def_xp_rem').text()) + (card_xp - prev_xp);
		jQuery('#def_xp_rem').text( new_xp ).toggleClass('btn-danger',false);
	} else {
		jQuery('#def_xp_rem').text( card_xp );
	}
	
	if( jQuery('#ath_xp_rem').text() < prev_xp ) {
		new_xp = parseInt(jQuery('#ath_xp_rem').text()) + (card_xp - prev_xp);
		jQuery('#ath_xp_rem').text( new_xp ).toggleClass('btn-danger',false);
	} else {
		jQuery('#ath_xp_rem').text( card_xp );
	}
	
	jQuery('#xp').val(card_xp);
}

function boost_menu(slot, attr_type) {
	
	// get previous attribute & points value for menu resets
	prev_attr = jQuery("#" + slot + "_attr").val();
	prev_boost_val = parseInt(jQuery("#" + slot + "_boost_val").val());
	// set attribute value for tracking
	jQuery("#" + slot + "_attr").val(attr_type);
	
	// reset selected buttons
	
	jQuery('#' + slot + "_btn_3, #" + slot + "_btn_5,#" + slot + "_btn_7").toggleClass('btn-success',false).removeAttr("disabled");
	jQuery('#' + slot + '_boost_val').val(0);
	
	// reset any previously disabled buttons
	for (var n=0; n<boost_slots.length; n++) {
		nslot = boost_slots[n];
		check_attr = jQuery("#" + nslot + "_attr").val();
		check_val = parseInt(jQuery("#" + nslot + "_boost_val").val());
		if(check_attr == prev_attr && nslot != slot) {
			jQuery("#" + nslot + "_btn_" + prev_boost_val).removeAttr('disabled');
		}
		if(check_attr == attr_type) {
			if(check_val > 0) {
				jQuery('#' + slot + "_btn_" + check_val).attr('disabled','disabled');
			}
		}
	}

	set_boosts();
	
}

function boost_buttons (slot,slot_val) {
	
	boost_attr = jQuery("#" + slot + "_attr").val();
	
	if(slot_val == 3) {
		jQuery('#' + slot + "_btn_3").toggleClass('btn-success',true).attr("disabled",'disabled');
		jQuery('#' + slot + "_btn_5").toggleClass('btn-success',false).removeAttr('disabled');
		jQuery('#' + slot + "_btn_7").toggleClass('btn-success',false).removeAttr('disabled');
	} else if(slot_val == 5) {
		jQuery('#' + slot + "_btn_5").toggleClass('btn-success',true).attr("disabled",'disabled');
		jQuery('#' + slot + "_btn_3").toggleClass('btn-success',false).removeAttr('disabled');
		jQuery('#' + slot + "_btn_7").toggleClass('btn-success',false).removeAttr('disabled');
	} else if(slot_val == 7) {
		jQuery('#' + slot + "_btn_7").toggleClass('btn-success',true).attr("disabled",'disabled');
		jQuery('#' + slot + "_btn_3").toggleClass('btn-success',false).removeAttr('disabled');
		jQuery('#' + slot + "_btn_5").toggleClass('btn-success',false).removeAttr('disabled');
	}
	
	prev_boost_val = parseInt(jQuery("#" + slot + "_boost_val").val());
	
	for (var n=0; n<boost_slots.length; n++) {
		nslot = boost_slots[n];
		check_attr = jQuery("#" + nslot + "_attr").val();
		if(check_attr == boost_attr && nslot != slot) {
			jQuery("#" + nslot + "_btn_" + slot_val).attr('disabled','true');
			jQuery("#" + nslot + "_btn_" + prev_boost_val).removeAttr('disabled');
			nboost_val = parseInt(jQuery("#" + nslot + "_boost_val").val());
			if(nboost_val > 0) {
				jQuery('#' + slot + "_btn_" + nboost_val).attr('disabled','true');
			}
		}
	}
	
	jQuery("#" + slot + "_boost_val").val(slot_val);
	
	set_boosts();
	
}

function set_boosts() {
	
	var boost_vals = [];
	for(var a=0; a<attributes.length; a++) {
		
		attr = attributes[a][0];
		jQuery("#" + attr + "_boost_amt").text("0");
		calc_xp(attr);
		
	}
	
	for(var b=0;b<boost_slots.length;b++) {
	
		slot = boost_slots[b];
		
		boost_val = parseInt(jQuery('#' + slot + "_boost_val").val());
		
		boost_type = jQuery('#' + slot + "_attr").val();

		cur_boost = parseInt(jQuery("#" + boost_type + "_boost_amt").text());
		
		new_boost = boost_val + cur_boost;
		
		/* new for 14 - caps include boost values */
		att_cap = 0;
		cur_points = 0;
		capped_boost = 0;
		att_cap = parseInt(jQuery('#' + boost_type + '_total_cap').text());
		cur_points = parseInt(jQuery('#' + boost_type + "_base_value").text()) + parseInt(jQuery('#' + boost_type + "_qty").val());
		capped_boost = att_cap - cur_points;
		/* alert ("capped = " + capped_boost + " and att_cap = " + att_cap + " cur_points = " + cur_points + " and new_boost = " + new_boost); */
		if(new_boost > capped_boost) {
			jQuery("#" + boost_type + "_boost_amt").text(capped_boost).attr('class','warn');
		} else {
			jQuery("#" + boost_type + "_boost_amt").text(new_boost).removeAttr('class');
		}
		
		calc_xp(boost_type);

	}
}


load_player();
//jQuery("th").tooltip();
jQuery('.boost').change(function() {
	var boost_id = jQuery(this).attr('id');
	var attr_name = jQuery('select#' + boost_id + " option:selected").val();

	boost_menu(boost_id,attr_name);
});
var xp_action = true;
jQuery('.addxp').mousedown(function() {
	var xp_action = true;
	var attr_name = jQuery(this).attr('name');
	add_xp(attr_name);
	timeout = setInterval(function () {
		add_xp(attr_name);
	}, 150);
	return false;
}).mouseup(function () {
	if(typeof timeout !== 'undefined') {
		clearInterval(timeout);
	}
	return false;
}).mouseout(function () {
	if(typeof timeout !== 'undefined') {
		clearInterval(timeout);
	}
	return false;
});

jQuery('.remxp').mousedown(function() {
	var xp_action = true;
	var attr_name = jQuery(this).attr('name');
	remove_xp(attr_name);
	timeout = setInterval(function () {
		remove_xp(attr_name);
	}, 150);
	return false;
}).mouseup(function () {
	if(typeof timeout !== 'undefined') {
		clearInterval(timeout);
	}
	return false;
}).mouseout(function () {
	if(typeof timeout !== 'undefined') {
		clearInterval(timeout);
	}
	return false;
});
// clear any mousedown effects if they are still running for some reason
jQuery(document).mouseup(function(){
	if(typeof timeout !== 'undefined') {
	    clearInterval(timeout);
	}
    return false;
});
jQuery("#share_button").click(function() {
	player_type = jQuery("#player_type option:selected").text();
	player_short_type = jQuery("#player_type option:selected").val();
	card_type = jQuery("#card_type option:selected").text();
	card_short_type = jQuery("#card_type option:selected").val();
	overall = jQuery("#off_overall").text();
	
	build_title = player_short_type + " - " + card_type + " - " + overall + " OVR";
		
	var text_code = "";
	var markdown_code = "";
	
	markdown_code = player_type + " - " + card_type + "\n\n";
	markdown_code += "|Attribute|Boost|Total|\n" + "|:-|:-:|:-:|\n";
	
	text_code = player_type + " - " + card_type + "\n\n";
	var post_attr = "";
	var post_boosts = "";
	
	for (var i= 0; i < attributes.length; i++) {

		attr_name = attributes[i][0];
		attr_full_name = attributes[i][2];
		
		attr_qty = jQuery("#" + attr_name + "_qty").val();
		boost_val = parseInt(jQuery("#" + attr_name + "_boost_amt").text());
		total_val = parseInt(jQuery("#" + attr_name + "_total").text());
		
		if(post_attr.length > 0) {
			post_attr += ", ";
			post_attr += attr_qty;
		} else {
			post_attr = "" + attr_qty;
		}
		
		text_code += attr_full_name;
		markdown_code += "|" + attr_full_name + "|";
		if(boost_val > 0) {
			text_code += " (+" + boost_val + ")";
			markdown_code += "+" + boost_val;
		}
		markdown_code += "|" + total_val + "|\n";
		text_code += ": " + total_val + "\n";
	}
	
	for(var b=0; b<boost_slots.length; b++) {
		
		boost_name = boost_slots[b];
		boost_type = jQuery("#"+boost_name+" option:selected").val();
		boost_val = jQuery("#"+boost_name+"_boost_val").val();
		
		if(post_boosts.length > 0) {
			post_boosts += ";" + boost_name + "," + boost_type + "," + boost_val;
		} else {
			post_boosts = ""+ boost_name + "," + boost_type + "," + boost_val;
		}
	}
//	foo = build_title + "\n" + player_short_type + "\n" + card_short_type + "\n" + post_attr + "\n" + post_boosts;
//	jQuery("#debug").text(foo);
	
	jQuery.post('http://virtualsports.ru/params/set_build/', { security_ls_key:LIVESTREET_SECURITY_KEY , build_title: build_title, build_player_type: player_short_type, build_xp_value: card_short_type, build_attributes: post_attr, build_boosts: post_boosts}, function(result) {
		
		if (result.bStateError) {
			ls.msg.error('Error','Please try again later');
		} else { 
			post_unique_id = result.Num;
			share_url = 'http://virtualsports.ru/params/builder/' + post_unique_id;
			jQuery('#share_url').val(share_url);
			
			//markdown_code += "([Built at pixelhockey.net](" + jQuery('#share_url').val() + "))";
			//text_code += "Built at " + jQuery('#share_url').val();

			jQuery("#build_markdown").val(markdown_code);
			jQuery("#build_text").val(text_code);
		}
										
		/*								
		if(post_unique_id.length <= 8) {
			share_url = 'http://virtualsports.ru/params/builder/' + post_unique_id;
			jQuery('#share_url').val(share_url);
			
			markdown_code += "([Built at pixelhockey.net](" + jQuery('#share_url').val() + "))";
			text_code += "Built at " + jQuery('#share_url').val();

			jQuery("#build_markdown").val(markdown_code);
			jQuery("#build_text").val(text_code);
			
		} else {

			jQuery('#share_url').val("Error saving build.").attr("disabled","true");
			share_url = "http://virtualsports.ru/params/builder/";
			markdown_code += "([Built at pixelhockey.net](" + share_url + "))";
			text_code += "Built at " + share_url;
			jQuery("#build_markdown").val(markdown_code);
			jQuery("#build_text").val(text_code);
		}*/
	});
	
	
	
	
});