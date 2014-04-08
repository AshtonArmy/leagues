{include file='header.tpl' menu='blog'} 
 <div class="span9">
	<ul class="nav nav-pills">						
		<li><strong></strong><a href="#" id="block_stream_topic" onclick="ls.au.toggle(this,'tournament', {literal}{{/literal} tournament: {$tournament_id} {literal}}{/literal}); return false;">{$aLang.plugin.vs.event_au}</a></li>
		<li><a href="#" id="link_teams" onclick="ls.au.toggle(this,'teams', {literal}{{/literal} tournament: {$tournament_id} {literal}}{/literal}); return false;">{$aLang.plugin.vs.teams}</a></li>
		<li><a href="#" id="block_stream_topic" onclick="ls.au.toggle(this,'players', {literal}{{/literal} tournament: {$tournament_id} {literal}}{/literal}); return false;">{$aLang.plugin.vs.players}</a></li>
		<li><a href="#" id="link_playoff" onclick="ls.au.toggle(this,'playoff', {literal}{{/literal} tournament: {$tournament_id} {literal}}{/literal}); return false;">{$aLang.plugin.vs.playoff}</a><em></em></li>
		<li><a href="#" id="link_group" onclick="ls.au.toggle(this,'group', {literal}{{/literal} tournament: {$tournament_id} {literal}}{/literal}); return false;">{$aLang.plugin.vs.groups}</a><em></em></li>
		<li><a href="#" id="link_raspisanie" onclick="ls.au.toggle(this,'raspisanie', {literal}{{/literal} tournament: {$tournament_id} {literal}}{/literal}); return false;">{$aLang.plugin.vs.schelude}</a><em></em></li>
	</ul>					
		
	<div class="block-content" id="div_au">
	</div>
 </div>

{literal}
<script type="text/javascript"> 
function  update_tournament(){
	var params = {};
	params['tournament_id']={/literal}{$tournament_id} {literal};
	params['known_teams']=$('#known_teams').val();
	params['league_name']=$('#league_name').val();
	params['league_pass']=$('#league_pass').val();
	params['datezayavki']=$('#datezayavki').val();
	params['datestart']=$('#datestart').val();
	params['dateopenrasp']=$('#dateopenrasp').val();
	params['win']=$('#win').val();
	params['lose']=$('#lose').val();
	if($('#exist_o').is(':checked')){params['exist_o']=1;}else{params['exist_o']=0;}
	params['win_o']=$('#win_o').val();
	params['lose_o']=$('#lose_o').val();
	if($('#exist_b').is(':checked')){params['exist_b']=1;}else{params['exist_b']=0;}
	params['win_b']=$('#win_b').val();
	params['lose_b']=$('#lose_b').val();
	if($('#exist_n').is(':checked')){params['exist_n']=1;}else{params['exist_n']=0;}
	params['points_n']=$('#points_n').val();
	if($('#exist_yard').is(':checked')){params['exist_yard']=1;}else{params['exist_yard']=0;}
	if($('#zakryto').is(':checked')){params['zakryto']=1;}else{params['zakryto']=0;}
	params['goals_teh_w']=$('#goals_teh_w').val();
	params['goals_teh_l']=$('#goals_teh_l').val();
	params['goals_teh_n']=$('#goals_teh_n').val();
	if($('#zavershen').is(':checked')){params['zavershen']=1;}else{params['zavershen']=0;}			
	if($('#autosubmit').is(':checked')){params['autosubmit']=1;}else{params['autosubmit']=0;}	
	params['submithours']=$('#submithours').val();
	params['prodlenie']=$('#prodlenie').val();
	params['waitlist']=$('#waitlist').val();
	params['prolong']=$('#prolong').val();
	
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	
	ls.ajax(aRouter['ajax']+'au/update_tournament/', params, function(result){
		if (!result) {
			ls.msg.error('Error','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error(result.sMsgTitle,result.sMsg);
		} else { 
			ls.msg.notice('Сохранено',' ');											
		}
	});		
}

function  upload_logo(logo_type){ 
	//var params = new FormData($('#form_'+logo_type)); 
	//alert($('#form_'+logo_type).serialize()); 
	ls.ajaxSubmit(aRouter['ajax']+'au/upload_logo/', 'form_'+logo_type, function(result){
		if (!result) {
			ls.msg.error('Error','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error(result.sMsgTitle,result.sMsg);
		} else { 
			ls.msg.notice('Сохранено',' ');	
			ls.au.toggle($('link_teams'),'tournament', {{/literal} tournament: {$tournament_id} {literal}});											
						
		}
	});		
}

function  delete_logo(logo_type){
	var params = {};
	params['tournament_id']={/literal}{$tournament_id} {literal}; 
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;							
	params['logo_type']=logo_type;
	ls.ajax(aRouter['ajax']+'au/delete_logo/', params, function(result){
		if (!result) {
			ls.msg.error('Error','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error(result.sMsgTitle,result.sMsg);
		} else { 
			ls.msg.notice('Сохранено',' ');	
			ls.au.toggle($('link_teams'),'tournament', {{/literal} tournament: {$tournament_id} {literal}});											
						
		}
	});
 
}

function  update_tournament_stat(){
	var params = {};
	params['tournament_id']={/literal}{$tournament_id} {literal}; 
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;							
	 
	ls.ajax(aRouter['ajax']+'au/tournamentrating/', params, function(result){
		if (!result) {
			ls.msg.error('Error','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error(result.sMsgTitle,result.sMsg);
		} else { 
			ls.msg.notice('Пересчитали',' ');											
		}
	});
 
}

function  update_stattable(num){
	var params = {};
	params['tournament_id']={/literal}{$tournament_id} {literal};
	params['round_id']=$('#round_id').val();
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;							
	if(params['round_id'] != 99999){
		ls.ajax(aRouter['ajax']+'au/update_stattable/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg);
			} else { 
				ls.msg.notice('Пересчитали',' ');											
			}
		});

	}	
}
function  get_zayavki(tournament_id,user_id){
	$('#zayavka').html('<img src="'+DIR_STATIC_SKIN+'/images/loader.gif" >');
	var params = {};
	params['tournament_id']=tournament_id;
	params['user_id']=user_id;
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	ls.ajax(aRouter['ajax']+'au/zayavki/', params, function(result){
		if (!result) {
			ls.msg.error('Error','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error(result.sMsgTitle,result.sMsg);
		} else { 
			$('#zayavka').html(result.sText);											
		}
	});
									
}
function  get_change(tournament_id,user_id){
	$('#zayavka').html('<img src="'+DIR_STATIC_SKIN+'/images/loader.gif" >');
	var params = {};
	params['tournament_id']=tournament_id;
	params['user_id']=user_id;
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	
	ls.ajax(aRouter['ajax']+'au/change/', params, function(result){
		if (!result) {
			ls.msg.error('Error','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error(result.sMsgTitle,result.sMsg);
		} else { 
			$('#zayavka').html(result.sText);											
		}
	});
}
						
function  set_team(tournament_id, user_id, team_id){
		//lsAU.toggle(this,'teams', { tournament: {/literal}{$tournament_id} {literal}});
		
		var params = {};
		params['tournament_id']=tournament_id;
		params['user_id']=user_id;
		params['team_id']=team_id;
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;
		
		ls.ajax(aRouter['ajax']+'au/setteam/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg);
			} else { 
				ls.au.toggle($('link_teams'),'teams', {{/literal} tournament: {$tournament_id} {literal}});											
			}
		});												
	}

function  add_team(round_id,team){ 
		var params = {};
		params['team'] = $('#'+team).val(); 
		params['tournament_id'] = {/literal}{$tournament_id} {literal};
		params['security_ls_key'] = LIVESTREET_SECURITY_KEY;
		params['round_id'] = round_id;
		ls.ajax(aRouter['ajax']+'au/addteam/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg);
			} else { 
				ls.au.toggle($('link_teams'),'group', {{/literal} tournament: {$tournament_id} {literal}});											
			}
		});												
	}

	
function  tehnarim(){ 
		var params = {}; 
		params['tournament_id']={/literal}{$tournament_id} {literal};
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;
		
		ls.ajax(aRouter['ajax']+'match/teh_massovo/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg);
			} else { 
				ls.msg.notice('Сохранено',' ');		
				//ls.au.toggle($('link_teams'),'group', {{/literal} tournament: {$tournament_id} {literal}});											
			}
		});												
	}
function  annulim(){ 
		var params = {}; 
		params['tournament_id']={/literal}{$tournament_id} {literal};
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;
		
		ls.ajax(aRouter['ajax']+'match/anul_massovo/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg);
			} else { 
				ls.msg.notice('Сохранено',' ');		
				//ls.au.toggle($('link_teams'),'group', {{/literal} tournament: {$tournament_id} {literal}});											
			}
		});												
	}	
function  delete_team(tournament_id, user_id, team_id){
	//lsAU.toggle(this,'teams', { tournament: {/literal}{$tournament_id} {literal}});
	
	var params = {};
	params['tournament_id']=tournament_id;
	params['user_id']=user_id;
	params['team_id']=team_id;
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	
	
	ls.ajax(aRouter['ajax']+'au/deleteteam/', params, function(result){
		if (!result) {
			ls.msg.error('Error','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error(result.sMsgTitle,result.sMsg);
		} else { 
			ls.au.toggle($('link_teams'),'teams', {{/literal} tournament: {$tournament_id} {literal}});										
		}
	});
								
}
function  change_team(tournament_id, user_id, user2_id){
	//lsAU.toggle(this,'teams', { tournament: {/literal}{$tournament_id} {literal}});
	
	var params = {};
	params['tournament_id']=tournament_id;
	params['user_id']=user_id;
	params['user2_id']=user2_id;
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	
	ls.ajax(aRouter['ajax']+'au/changeteam/', params, function(result){
		if (!result) {
			ls.msg.error('Error','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error(result.sMsgTitle,result.sMsg);
		} else { 
			ls.au.toggle($('link_teams'),'teams', {{/literal} tournament: {$tournament_id} {literal}});									
		}
	});
	
}
function  delete_alone_teams(){
	var params = {};
	params['tournament_id']={/literal}{$tournament_id} {literal};
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;			
	
	ls.ajax(aRouter['ajax']+'au/delete_alone_teams/', params, function(result){
		if (!result) {
			ls.msg.error('Error','Please try again later');
		}
		if (result.bStateError) {
			ls.msg.error(result.sMsgTitle,result.sMsg);
		} else { 
			ls.au.toggle($('link_teams'),'teams', {{/literal} tournament: {$tournament_id} {literal}});								
		}
	});
									
}
function  save_tournament(){ 
	var params = {};
	params['tournament_id']={/literal}{$tournament_id}{literal};
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	
	ls.ajax(aRouter['ajax']+'au/zayavki/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg);
			} else { 
				$('#zayavka').html(result.sText);
			}
		});
							
}
function  createround(){
	var params = {};
	params['tournament_id']={/literal}{$tournament_id} {literal};
	params['round']=$('#add_round').val();
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	
	if(params['round']>0){
		ls.ajax(aRouter['ajax']+'au/createround/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg);
			} else { 
				ls.au.toggle($('link_playoff'),'playoff', {{/literal} tournament: {$tournament_id} {literal}});				
			}
		});							
		
	}	
}

function  deleteround(round_po){
	var params = {};
	params['tournament_id']={/literal}{$tournament_id} {literal};
	params['round']=round_po;
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	
	if(params['round']>0){
		ls.ajax(aRouter['ajax']+'au/deleteround/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg); 
			} else { 
				ls.au.toggle($('link_playoff'),'playoff', {{/literal} tournament: {$tournament_id} {literal}});				
			}
		});							
		
	}	
}


function  saveparentgroup(el,team_id,round_id){
		var params = {};
		params['tournament_id']={/literal}{$tournament_id} {literal}; 
		params['group_id']=$('#'+el).val();
		params['team_id']=team_id;
		params['round_id']=round_id;
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;
		ls.ajax(aRouter['ajax']+'au/setparentgroup/', params, function(result){
				if (!result) {
					ls.msg.error('Error','Please try again later');
				}
				if (result.bStateError) {
					ls.msg.error(result.sMsgTitle,result.sMsg); 
				} else { 
					ls.msg.notice('Сохранено',' ');			
				}
			});				
	}

function  savegroup(el,team_id,round_id){
		var params = {};
		params['tournament_id']={/literal}{$tournament_id} {literal}; 
		params['group_id']=$('#'+el).val();
		params['team_id']=team_id;
		params['round_id']=round_id;
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;	
		ls.ajax(aRouter['ajax']+'au/setgroup/', params, function(result){
				if (!result) {
					ls.msg.error('Error','Please try again later');
				}
				if (result.bStateError) {
					ls.msg.error(result.sMsgTitle,result.sMsg); 
				} else { 
					ls.msg.notice('Сохранено',' ');			
				}
			});				
	}
	
function  saveround(el){
		var params = {};
		params['tournament_id']={/literal}{$tournament_id} {literal};
		params['round_num']=el;
		params['team_id']=$('#'+el).val();
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;							
		
			
		ls.ajax(aRouter['ajax']+'au/saveround/', params, function(result){
				if (!result) {
					ls.msg.error('Error','Please try again later');
				}
				if (result.bStateError) {
					ls.msg.error(result.sMsgTitle,result.sMsg); 
				} else { 
					ls.msg.notice('Сохранено',' ');			
				}
			});	
			
	}
		
	function  createraspisanie(num){
		var params = {};
		params['tournament_id']={/literal}{$tournament_id} {literal};
		params['round']=num;
		params['start_day']=$('#'+num+'start_day').val();
		params['matches_in_day']=$('#'+num+'matches_in_day').val();
		params['matches_between_day']=$('#'+num+'matches_between_day').val();
		params['matches_to_win']=$('#'+num+'matches_to_win').val();
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;							
		
		ls.ajax(aRouter['ajax']+'au/createraspisanie/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg); 
			} else { 
				ls.au.toggle($('link_playoff'),'playoff', {{/literal} tournament: {$tournament_id} {literal}});
			}
		});	

			
	}
						
	function  deleteraspisanie(num){
		var params = {};
		params['tournament_id']={/literal}{$tournament_id} {literal};
		params['round']=num;
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;							
		
		ls.ajax(aRouter['ajax']+'au/deleteraspisanie/', params, function(result){
			if (!result) {
				ls.msg.error('Error','Please try again later');
			}
			if (result.bStateError) {
				ls.msg.error(result.sMsgTitle,result.sMsg); 
			} else { 
				ls.au.toggle($('link_playoff'),'playoff', {{/literal} tournament: {$tournament_id} {literal}});
			}
		});				
	}
	
	
		  	window.addEventListener("load", function(e) {
			document.addEventListener('DOMNodeInserted', function(e) {
			
					if($('#allusers') && $('#secret').val()==0){
						$("#allusers").tablesorter(); 
						$('#secret').val(1);
					}
			},
			false);
		},
		false);				
						
</script> 
{/literal}

{include file='footer.tpl'}