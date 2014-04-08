function turn_on_hover_team(){
	
d0 = new Date();
 $('a.teamrasp').mouseover(function() {
 Tipped.create(this,  aRouter['ajax']+'team/info/',{
		skin: 'cloud',
		hook: 'topleft',
		maxWidth: 300,
		showDelay: 100, 
		ajax: { data: { 
					team: $(this).text(), 
					security_ls_key: LIVESTREET_SECURITY_KEY, 
					tournament_id: tournament_for_hover,
					game_id: miniturnir_game_for_hover,
					gametype_id: miniturnir_gametype_for_hover
				}, type: 'post' }
      });
    });
d1 = new Date();
d2=d1-d0; 

}
function ajax_teamrasp(name){
	var params = {}; 
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	params['team']=name; 
	params['tournament_id']= tournament_for_hover;
	params['game_id']= miniturnir_game_for_hover;
	params['gametype_id']= miniturnir_gametype_for_hover;
	ls.ajax(aRouter['ajax']+'team/info/', params, function(result){
				if (!result) {
					ls.msg.error('Error1','Please try again later');
				}
				if (result.bStateError) {
					ls.msg.error('Error2','Please try again later');
				} else { 
					return result.sText;	 
				}
			});

}
function turn_on_hover_user(){	

 $('a.author, a.stream-author, a.author-comment, a.ls-user, a.user, a.username').mouseover(function() {
      Tipped.create(this,  aRouter['ajax']+'user/info/',{
		skin: 'cloud',
		hook: 'topleft',
		maxWidth: 300,
		showDelay: 300,
		ajax: { data: { UserLogin: $(this).text(), security_ls_key:LIVESTREET_SECURITY_KEY }, type: 'post' }
      });
    });
}
 

$(document).ready(function() {
	//turn_on_hover_user();
	$('#resultmatch_form').jqm();
	$('#otchetmatch_form').jqm();
	$('#prolongmatch_form').jqm();
	$('#perenos_form').jqm();
	$('#video_form').jqm();
	$('#teamplay_form').jqm();
	
	 

	// Toggle the dropdown menu's
	$(".dropdown .buttons, .dropdown buttons").click(function () {
	
		
		if (!$(this).find('span.toggle').hasClass('active')) {
			$('.dropdown-slider').slideUp();
			$('span.toggle').removeClass('active');
			var params = {}; 
			params['security_ls_key']=LIVESTREET_SECURITY_KEY;
			params['match_id']=$(this).attr("name"); 
			var name_of_this=$(this);  

			ls.ajax(aRouter['ajax']+'match/getbuttons/', params, function(result){
				if (!result) {
					ls.msg.error('Error1','Please try again later');
				}
				if (result.bStateError) {
					ls.msg.error('Error2','Please try again later');
				} else { 
					$(name_of_this).parent().append(result.sText);
					$(name_of_this).parent().find('.dropdown-slider').slideToggle('fast');
					$(name_of_this).find('span.toggle').toggleClass('active');	 
				}
			});

			
			
		}else{
			$(this).parent().find('.dropdown-slider').remove();
			$(this).parent().find('.dropdown-slider').slideToggle('fast');
			$(this).find('span.toggle').toggleClass('active');
		}
		return false;
	});
	$(document).bind('click', function (e) {
		if (e.target.id != $('.dropdown').attr('class')) {
			$('.dropdown-slider').slideUp();
			$('span.toggle').removeClass('active');
		}
	});


	$(function() {
		$('#navigation a').stop().animate({'marginLeft':'-85px'},1000);

		$('#navigation > li').hover(
			function () {
				$('a',$(this)).stop().animate({'marginLeft':'-2px'},200);
			},
			function () {
				$('a',$(this)).stop().animate({'marginLeft':'-85px'},200);
			}
		);
	});
     

 
	 $('#navigation li.blogs a').each(function() {
      Tipped.create(this,  aRouter['ajax']+'my/blogs/',{
		skin: 'cloud',
		hook: 'righttop',
		maxWidth: 400, 
		hideDelay: 1000,
		showOn: 'click',
		ajax: { data: {  
					security_ls_key: LIVESTREET_SECURITY_KEY,   
				}, type: 'post' }
      });
    });
	$('#navigation li.teams a').each(function() {
      Tipped.create(this,  aRouter['ajax']+'teams/teamplay/',{
		skin: 'cloud',
		hook: 'righttop',
		maxWidth: 400, 
		hideDelay: 1000,
		showOn: 'click',
		ajax: { data: {  
					security_ls_key: LIVESTREET_SECURITY_KEY,   
				}, type: 'post' }
      });
    });
	
	 $('#navigation li.tournaments a').each(function() {
      Tipped.create(this,  aRouter['ajax']+'my/tournaments/',{
		skin: 'cloud',
		hook: 'righttop',
		maxWidth: 400, 
		hideDelay: 1000,
		showOn: 'click',
		ajax: { data: {  
					security_ls_key: LIVESTREET_SECURITY_KEY,   
				}, type: 'post' }
      });
    });
	
 	$('#navigation li.matches a').each(function() {
      Tipped.create(this,  aRouter['ajax']+'my/matches/',{
		skin: 'cloud',
		hook: 'righttop',
		maxWidth: 400, 
		hideDelay: 1000,
		showOn: 'click',
		ajax: { data: {  
					security_ls_key: LIVESTREET_SECURITY_KEY,   
				}, type: 'post' }
      });
    });
	
	
   
});
			function prolong_save(){
				var params = {};
				var params_get = {};
				params['match_id']=$('#match_id').val();
				params['prichina']=$('#prichina').val();
				params['srok']=$('#srok').val();
				//alert (params['match_id'] +' '+ params['prichina'] + ' '+params['srok']);
				ls.ajax(aRouter['ajax']+'match/prolonset/', params, function(result){
					if (!result) {
						ls.msg.error('Error3','Please try again later');
					}
					if (result.bStateError) {
						ls.msg.error('Error4','Please try again later');
					} else { 
						$('#prolongmatch_form').jqmHide();
						ls.msg.notice(result.sMsgTitle,result.sMsg);											
					}
				});
			}
			
			function perenos_save(){
				var params = {};
				var params_get = {};
				params['match_id']=$('#match_id').val(); 
				params['perenos_time']= $('#perenos_time').val(); 
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;
				 
				ls.ajax(aRouter['ajax']+'perenos/set/', params, function(result){
					if (!result) {
						ls.msg.error('Error31','Please try again later');
					}
					if (result.bStateError) {
						ls.msg.error(result.sMsgTitle,result.sMsg);
					} else { 
						$('#perenos_form').jqmHide();
						ls.msg.notice(result.sMsgTitle,result.sMsg);											
					}
				});
			}
			
			function video_save(){
				var params = {};
				var params_get = {};
				params['match_id']=$('#match_id').val(); 
				params['video_url']=$('#video_url').val();
				//alert (params['match_id'] +' '+ params['prichina'] + ' '+params['srok']);
				ls.ajax(aRouter['ajax']+'match/video/', params, function(result){
					if (!result) {
						ls.msg.error('Error3','Please try again later');
					}
					if (result.bStateError) {
						ls.msg.error('Error4','Please try again later');
					} else { 
						$('#video_form').jqmHide();
						ls.msg.notice(result.sMsgTitle,result.sMsg);											
					}
				});
			}
			
			function result_saves_admin(){

				var params = {};
				var params_get = {};
				params['match_id']=$('#match_id').val();
				params_get['match_id']=$('#match_id').val();
				params['away_goals']=parseInt($('#inputaway').val());
				params['home_goals']=parseInt($('#inputhome').val());
				params['comment']=$('#comment').val();
				if($('#ot').is(':checked')){params['ot']=1;}else{params['ot']=0;}
				if($('#so').is(':checked')){params['so']=1;}else{params['so']=0;}
				params['team_id']=$('#team_id').val();
				
				if(params['comment'].length==0)params['comment']='';
				if(isNaN(params['away_goals']))params['away_goals']=0;
				if(isNaN(params['home_goals']))params['home_goals']=0; 
				
				if(params['ot']==1){ot=" OT";}else{ot=""; params['ot']=0;}
				if(params['so']==1){so=" SO";}else{so=""; params['so']=0;} 
				
				params['yard']=parseInt($('#yard').val());
				if(isNaN(params['yard']))params['yard']=0;
				
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;
				params_get['security_ls_key']=LIVESTREET_SECURITY_KEY;
				
				if(parseInt($('#inputaway').val())>=0 && parseInt($('#inputhome').val())>=0 && ((params['ot'] == params['so'] && params['so']==0) || (params['ot'] != params['so'] && Math.abs(parseInt($('#inputhome').val())-parseInt($('#inputaway').val()))==1 ))){
					ls.ajax(aRouter['ajax']+'match/resultedit/', params, function(result){
						if (!result) {
							ls.msg.error('Error5','Please try again later');
						}
						if (result.bStateError) {
							ls.msg.error('Error6','Please try again later');
						} else { 
							$('#resultmatch_form').jqmHide();
							ls.msg.notice(result.sMsgTitle,result.sMsg);											
						}
					});

				}else{
					ls.msg.error('Ошибка','Проверьте правильность ввода');
				}
											
			}
			
			function result_saves(){
				
				var params = {};
				var params_get = {};
				params['match_id']=$('#match_id').val();
				params_get['match_id']=$('#match_id').val();
				params['away_goals']=parseInt($('#inputaway').val());
				params['home_goals']=parseInt($('#inputhome').val());
				params['comment']=$('#comment').val();
				if($('#ot').is(':checked')){params['ot']=1;}else{params['ot']=0;}
				if($('#so').is(':checked')){params['so']=1;}else{params['so']=0;}
				params['team_id']=$('#team_id').val();
				params['user_id']=$('#user_id').val();
				
				if(params['comment'].length==0)params['comment']='';
				if(isNaN(params['away_goals']))params['away_goals']=0;
				if(isNaN(params['home_goals']))params['home_goals']=0; 
				
				if(params['ot']==1){ot=" OT";}else{ot=""; params['ot']=0;}
				if(params['so']==1){so=" SO";}else{so=""; params['so']=0;} 
				
				params['yard']=parseInt($('#yard').val());
				if(isNaN(params['yard']))params['yard']=0;
				
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;
				params_get['security_ls_key']=LIVESTREET_SECURITY_KEY;
				
				if(parseInt($('#inputaway').val())>=0 && parseInt($('#inputhome').val())>=0 && ((params['ot'] == params['so'] && params['so']==0) || (params['ot'] != params['so'] && Math.abs(parseInt($('#inputhome').val())-parseInt($('#inputaway').val()))==1 ))){
				$( "#dialog:ui-dialog" ).dialog( "destroy" );

				$('#span_exist_o').hide();
				$('#span_exist_b').hide();
				$('#span_exist_yard').hide();
				ls.ajax(aRouter['ajax']+'match/resultget/', params, function(result){
					if (!result) {
						ls.msg.error(result.sMsgTitle,result.sMsg);
					}
					if (result.bStateError) {
						ls.msg.error(result.sMsgTitle,result.sMsg);
					} else {
						if(result.exist_o==1)$('#span_exist_o').show();
						if(result.exist_b==1)$('#span_exist_b').show();
						if(result.exist_yard==1)$('#span_exist_yard').show();
						//$("#match_teams").html(result.away_team+" - " +result.home_team);
						if(result.away_team!==undefined){
									$("#match_teams").html(result.away_team+" - " +result.home_team);
									var miniturnir=0;
								}else{
									var miniturnir=1;
									$("#match_teams").html(result.away_user+" - " +result.home_user);
								}
						if(result.yess){
							ot="";
							so="";
							if(result.ot==1)ot=" OT";
							if(result.so==1)so=" SO";
							$("#vvel").html("(" +result.away+" : " +result.home+ot+so+")");
							
							if(parseInt($('#inputaway').val())!=result.away || parseInt($('#inputhome').val())!=result.home || params['ot'] !=result.ot || params['so']!=result.so){
								$('#error_text').html('Соперник ввел (' +result.away+' : ' +result.home+ot+so+'). Вы уверены в правильности ввода? ');
								$( "#dialog-confirm" ).dialog({
									resizable: false,
									height:140,
									modal: true,
									buttons: {
										"Да": function() {
											ls.ajax(aRouter['ajax']+'match/resultset/', params, function(result){
												if (!result) {
													ls.msg.error(result.sMsgTitle,result.sMsg);
												}
												if (result.bStateError) {
													ls.msg.error(result.sMsgTitle,result.sMsg);
												} else { 
													$('#resultmatch_form').jqmHide();
													ls.msg.notice(result.sMsgTitle,result.sMsg);
								if(miniturnir==1)	updatetableTovarki(0,global_stavka);												
												}
											});
											$( this ).dialog( "close" );
										},
										"Не уверен": function() {
											$( this ).dialog( "close" );
										}
									}
								});

							}else{
								ls.ajax(aRouter['ajax']+'match/resultset/', params, function(result){
									if (!result) {
										ls.msg.error(result.sMsgTitle,result.sMsg);
									}
									if (result.bStateError) {
										ls.msg.error(result.sMsgTitle,result.sMsg);
									} else { 
										$('#resultmatch_form').jqmHide();
										ls.msg.notice(result.sMsgTitle,result.sMsg);
								if(miniturnir==1)	updatetableTovarki(0,global_stavka);	
									}
								});
							}
						
						}else{
							ls.ajax(aRouter['ajax']+'match/resultset/', params, function(result){
								if (!result) {
									ls.msg.error(result.sMsgTitle,result.sMsg);
								}
								if (result.bStateError) {
									ls.msg.error(result.sMsgTitle,result.sMsg);
								} else { 
									$('#resultmatch_form').jqmHide();
									ls.msg.notice(result.sMsgTitle,result.sMsg);	
						if(miniturnir==1)	updatetableTovarki(0,global_stavka);	
								}
							});
						}
					}
				});
						
				
				}else{
					//msgErrorBox.alert('Ошибка','Проверьте правильность ввода');
					ls.msg.error('Ошибка','Проверьте правильность ввода');
				}
											
			}
			function result_save_case(){
				if($('#result_edit').val()==1){
					result_saves_admin();
				}else{
					result_saves();
				}
			}
			
			function  match_prolong(id){
				$('#prolongmatch_form').jqmShow();
				$('.dropdown-slider').slideUp();
				$('span.toggle').removeClass('active'); 
				var params = {};
				params['match_id']=id;
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;	
				
				$('#match_id').val(id);						
			}
			
			function  match_perenos(id, y,m,d,h,mi){
				$('#perenos_form').jqmShow();
				$('.dropdown-slider').slideUp();
				$('span.toggle').removeClass('active'); 
				
				var params = {};
				params['match_id']=id;
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;	
				
				if (m>0){m=m-1;}else{m=11;}
				$('#match_id').val(id);		 
				$('#perenos_time').datetimepicker('setDate', (new Date(y,m,d,h,mi)) ) ;
			}
			
			
			function  result_insertvideo(id){
				$('#video_form').jqmShow();
				$('.dropdown-slider').slideUp();
				$('span.toggle').removeClass('active'); 
				var params = {};
				params['match_id']=id;
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;	
				
				$('#match_id').val(id);						
			}
			function  result_insert(id, team_id, teamplay){
				$('#resultmatch_form').jqmShow();
				$('.dropdown-slider').slideUp();
				$('span.toggle').removeClass('active'); 
				
				var params = {};
				params['match_id']=id;
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;
				$('#team_id').val(team_id);
				$('#match_id').val(id);
				$('#inputaway').val('');
				$('#inputhome').val('');
				$('#comment').val('');
				$('#vvel').html('');
				$("#match_teams").html('');
				
				$('#result_edit').val(0);
				$('#ot').removeAttr("checked");
				$('#so').removeAttr("checked");
				$("#teamplayform").html('');
				$('#span_exist_o').hide();
				$('#span_exist_b').hide();
				$('#span_exist_yard').hide();
				$('#yard').val('');
				ls.ajax(aRouter['ajax']+'match/resultget/', params, function(result){
							if (!result) {
								ls.msg.error('Error15','Please try again later');
							}
							if (result.bStateError) {
								ls.msg.error('Error16','Please try again later');
							} else {
								//$("#match_teams").html(result.away_team+" - " +result.home_team);
								if(result.exist_o==1)$('#span_exist_o').show();
								if(result.exist_b==1)$('#span_exist_b').show();
								if(result.exist_yard==1)$('#span_exist_yard').show();
								if(result.away_team!==undefined){
									$("#match_teams").html(result.away_team+" - " +result.home_team);
								}else{
									$("#match_teams").html(result.away_user+" - " +result.home_user);
								}
								if(result.yess){
									ot="";
									so="";
									if(result.ot==1)ot=" OT";
									if(result.so==1)so=" SO";
									$("#vvel").html("(" +result.away+" : " +result.home+ot+so+")");									 
								}
								if(teamplay==1)$("#teamplayform").html(result.Teamplay);
							}
						});
			}
			
			function  result_insert_user(id, user_id){
				$('#resultmatch_form').jqmShow();
				$('.dropdown-slider').slideUp();
				$('span.toggle').removeClass('active'); 
				
				var params = {};
				params['match_id']=id;
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;
				$('#user_id').val(user_id);
				$('#team_id').val(0);
				$('#match_id').val(id);
				$('#inputaway').val('');
				$('#inputhome').val('');
				$('#comment').val('');
				$('#vvel').html('');
				$("#match_teams").html('');
				
				$('#result_edit').val(0);
				$('#ot').removeAttr("checked");
				$('#so').removeAttr("checked");
				$('#span_exist_o').hide();
				$('#span_exist_b').hide();
				$('#span_exist_yard').hide();
				$('#yard').val('');
				ls.ajax(aRouter['ajax']+'match/resultget/', params, function(result){
							if (!result) {
								ls.msg.error('Error15','Please try again later');
							}
							if (result.bStateError) {
								ls.msg.error('Error16','Please try again later');
							} else {								
								if(result.exist_o==1)$('#span_exist_o').show();
								if(result.exist_b==1)$('#span_exist_b').show();
								if(result.exist_yard==1)$('#span_exist_yard').show();
								if(result.away_team!==undefined){
									$("#match_teams").html(result.away_team+" - " +result.home_team);
								}else{
									$("#match_teams").html(result.away_user+" - " +result.home_user);
								}
								if(result.yess){
									ot="";
									so="";
									if(result.ot==1)ot=" OT";
									if(result.so==1)so=" SO";
									$("#vvel").html("(" +result.away+" : " +result.home+ot+so+")");
									
								}
							}
						});
			}
			
			function  result_edit(id, team_id){
				$('#resultmatch_form').jqmShow();
				$('.dropdown-slider').slideUp();
				$('span.toggle').removeClass('active'); 
				
				var params = {};
				params['match_id']=id;
				params['team_id']=team_id;
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;
				$('#team_id').val(team_id);
				$('#match_id').val(id);
				$('#inputaway').val('');
				$('#inputhome').val('');
				$('#comment').val('');
				$('#vvel').html('');
				$('#match_teams').html('');
				$('#result_edit').val(1);
				$('#ot').removeAttr("checked");
				$('#so').removeAttr("checked");
				$('#span_exist_o').hide();
				$('#span_exist_b').hide();
				$('#span_exist_yard').hide();				
				$('#yard').val('');
				ls.ajax(aRouter['ajax']+'match/resultgetadmin/', params, function(result){
							if (!result) {
								ls.msg.error('Error17','Please try again later');
							}
							if (result.bStateError) {
								ls.msg.error('Error18','Please try again later');
							} else {
								if(result.exist_o==1)$('#span_exist_o').show();
								if(result.exist_b==1)$('#span_exist_b').show();
								if(result.exist_yard==1)$('#span_exist_yard').show();
								//$("#match_teams").html(result.away_team+" - " +result.home_team);
								if(result.away_team!==undefined){
									$("#match_teams").html(result.away_team+" - " +result.home_team);
								}else{
									$("#match_teams").html(result.away_user+" - " +result.home_user);
								}
								if(result.yess){
									ot="";
									so="";
									if(result.ot==1)ot=" OT";
									if(result.so==1)so=" SO";
									$("#vvel").html("(" +result.away+" : " +result.home+ot+so+")");
								}
								if(result.team_yess){
									$('#inputaway').val(result.team_away);
									$('#inputhome').val(result.team_home);
									$('#yard').val(result.yard);
									if(result.team_ot==1)$('#ot').attr("checked","checked");
									if(result.team_so==1)$('#so').attr("checked","checked");
									$('#comment').val(result.team_comment);
								}
							}
						});							
			}
			


	function match_lookup(id){
		
		$('.dropdown-slider').slideUp();
		$('span.toggle').removeClass('active');
				var params = {};
				params['match_id']=id;
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;							

				ls.ajax(aRouter['ajax']+'match/lookup/', params, function(result){
							if (!result) {
								ls.msg.error('Error19','Please try again later');
							}
							if (result.bStateError) {
								ls.msg.error('Error20','Please try again later');
							} else {
								$("#divmatchotchet").html(result.sText);
								$('#otchetmatch_form').jqmShow();
							}
						});		
			}

			
	function result_otchet(id){
		
		$('.dropdown-slider').slideUp();
		$('span.toggle').removeClass('active');
				var params = {};
				params['match_id']=id;
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;							

				ls.ajax(aRouter['ajax']+'match/otchet/', params, function(result){
							if (!result) {
								ls.msg.error('Error21','Please try again later');
							}
							if (result.bStateError) {
								ls.msg.error('Error22','Please try again later');
							} else {
								$("#divmatchotchet").html(result.sText);
								$('#otchetmatch_form').jqmShow();
							}
						});		
			}


function result_teh(id, team_id, texts){

				var params = {};
				params['match_id']=id;
				params['team_id']=team_id;	
				params['texts']=texts;								
				
				params['security_ls_key']=LIVESTREET_SECURITY_KEY;
				ask='';
				if (texts=='tehl')ask='Вы точно хотите влепить техническое поражение команде?';
				if (texts=='tehn')ask='Вы точно хотите влепить техническую ничью командам?';
				
				$('#error_text').html(ask);
				$( "#dialog-confirm" ).dialog({
					resizable: false,
					height:140,
					modal: true,
					buttons: {
						"Да": function() {
							ls.ajax(aRouter['ajax']+'match/teh/', params, function(result){
								if (!result) {
									ls.msg.error('Error23','Please try again later');
								}
								if (result.bStateError) {
									ls.msg.error('Error24','Please try again later');
								} else { 
									$('#otchetmatch_form').jqmHide();
									ls.msg.notice(result.sMsgTitle,result.sMsg);											
								}
							});
							$( this ).dialog( "close" );
						},
						"Не уверен": function() {
							$( this ).dialog( "close" );
						}
					}
				});
					
			}
	function result_anul(id){
		//$('#resultmatch_form').jqmShow();
		$('.dropdown-slider').slideUp();
		$('span.toggle').removeClass('active');
		var params = {};
		params['match_id']=id;							
		
		params['security_ls_key']=LIVESTREET_SECURITY_KEY;
		params['del_preduprezhdenie']=1;
		
		$('#error_text').html('Вы точно хотите анулировать результат матча вместе с предупреждениями?');
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				"Да": function() {
					ls.ajax(aRouter['ajax']+'match/anul/', params, function(result){
						if (!result) {
							ls.msg.error('Error','Please try again later');
						}
						if (result.bStateError) {
							ls.msg.error('Error','Please try again later');
						} else { 
							$('#resultmatch_form').jqmHide();
							ls.msg.notice(result.sMsgTitle,result.sMsg);											
						}
					});
					$( this ).dialog( "close" );
				},
				"Не уверен": function() {
					$( this ).dialog( "close" );
				}
			}
		});
	}
function result_anul_without_pred(id){
	//$('#resultmatch_form').jqmShow();
	$('.dropdown-slider').slideUp();
	$('span.toggle').removeClass('active');
	var params = {};
	params['match_id']=id;							
	
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	params['del_preduprezhdenie']=0;
	$('#error_text').html('Вы точно хотите анулировать результат матча оставив предупреждения?');
	$( "#dialog-confirm" ).dialog({
		resizable: false,
		height:140,
		modal: true,
		buttons: {
			"Да": function() {
				ls.ajax(aRouter['ajax']+'match/anul/', params, function(result){
					if (!result) {
						ls.msg.error('Error','Please try again later');
					}
					if (result.bStateError) {
						ls.msg.error('Error','Please try again later');
					} else { 
						$('#resultmatch_form').jqmHide();
						ls.msg.notice(result.sMsgTitle,result.sMsg);											
					}
				});
				$( this ).dialog( "close" );
			},
			"Не уверен": function() {
				$( this ).dialog( "close" );
			}
		}
	});
		
}
function result_team_delete(id, team_id){

	$('.dropdown-slider').slideUp();
	$('span.toggle').removeClass('active');
	var params = {};
	params['match_id']=id;
	params['team_id']=team_id;							
	
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	$('#error_text').html('Вы точно хотите удалить результат?');
	$( "#dialog-confirm" ).dialog({
		resizable: false,
		height:140,
		modal: true,
		buttons: {
			"Да": function() {
				ls.ajax(aRouter['ajax']+'match/resultdelete/', params, function(result){
					if (!result) {
						ls.msg.error('Error','Please try again later');
					}
					if (result.bStateError) {
						ls.msg.error('Error','Please try again later');
					} else { 
						$('#resultmatch_form').jqmHide();
						ls.msg.notice(result.sMsgTitle,result.sMsg);											
					}
				});
				$( this ).dialog( "close" );
			},
			"Не уверен": function() {
				$( this ).dialog( "close" );
			}
		}
	});
	
}