var ls = ls || {};

/**
* Динамическая подгрузка блоков
*/
ls.au = (function ($) {
	/**
	* Опции
	*/
	this.options = {
		active: 'active',
		loader: DIR_STATIC_SKIN + '/images/loader.gif',
		type: {
                comment_stream: {
                        url: aRouter['ajax']+'stream/comment/'
                },
                topic_stream: {
                        url: aRouter['ajax']+'ajax/topic/'
                },
                blogs_top: {
                        url: aRouter['ajax']+'blogs/top/'
                },
                blogs_join: {
                        url: aRouter['ajax']+'blogs/join/'
                },
                blogs_self: {
                        url: aRouter['ajax']+'blogs/self/'
                },
                tournament: {
                        url: aRouter['ajax']+'au/tournament/'
                },
				teams: {
                        url: aRouter['ajax']+'au/teams/'
                },
				playoff: {
                        url: aRouter['ajax']+'au/playoff/'
                },
				players: {
                        url: aRouter['ajax']+'au/players/'
                },
				createstattable: {
                        url: aRouter['ajax']+'au/createstattable/'
                },
				createshedule: {
                        url: aRouter['ajax']+'au/createshedule/'
                },
				deleteshedule: {
                        url: aRouter['ajax']+'au/deleteshedule/'
                },
				setteams: {
                        url: aRouter['ajax']+'au/setteams/'
                },
				weeks: {
                        url: aRouter['ajax']+'raspisanie/weeks/'
                },
				monthes: {
                        url: aRouter['ajax']+'raspisanie/monthes/'
                },
				map: {
                        url: aRouter['ajax']+'raspisanie/map/'
                },
				group: {
                        url: aRouter['ajax']+'au/group/'
                },
				raspisanie: {
                        url: aRouter['ajax']+'au/raspisanie/'
                }
        }
	}

	this.onLoad = function(result, blockContent) {
			blockContent.html('');
			if (!result) {
                ls.msg.error('Error','Please try again later');
        	}
        	if (result.bStateError) {
                //ls.msg.error(result.sMsgTitle,result.sMsg);
        	} else {
        		blockContent.html(result.sText);
				//turn_on_hover_team();
				$('.date-picker').datepicker({
					dateFormat: 'dd.mm.yy',
					dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
					monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
					firstDay: 1
				});	
				if(1==1){ 
					ls.autocomplete.add($(".autocomplete-teama"), aRouter['ajax']+'autocompleter/teama/', false);
					ls.autocomplete.add($(".autocomplete-users"), aRouter['ajax']+'autocompleter/user/', false);
				}
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
											ls.msg.error('Error','Please try again later');
										}
										if (result.bStateError) {
											ls.msg.error('Error','Please try again later');
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
							
        	}
		},
	this.toggle = function(obj,type,params) {
 
			if (!this.options.type[type]) return false;
            thisObj=this;
            this.obj=$(obj);
            if(type=='weeks' || type=='monthes') {
				var liCurrent=this.obj.parent();
				var blockNav=liCurrent.parent();
				var liList=blockNav.children('li');

				liList.each(function(index, item) {   
					$(item).removeClass('active');        		
				});

				liCurrent.addClass('active');
			
				var blockContent=$('#div_raspisanie');
			}else{			
				//var blockContent=thisObj.obj.parent('div');
				var blockContent=$('#div_au');
			}
        	this.showProgress(blockContent);
        	     
        	if(!params) {
        		params={ security_ls_key: LIVESTREET_SECURITY_KEY };   	
        	} else {
        		params['security_ls_key']=LIVESTREET_SECURITY_KEY;
        	}
        	//alert(type);
			ls.ajax(this.options.type[type].url, params, function(result) {
				if (!result) {
						ls.msg.error('Error','Please try again later');
					}
					if (result.bStateError) {
						ls.msg.error(result.sMsgTitle,result.sMsg);
					} else {
						this.onLoad(result, blockContent);
					}
			}.bind(this));		
             

		}	
		
	this.simple_toggles = function(obj,type,params) {
 
			if (!this.options.type[type]) return false;
            thisObj=this;
            this.obj=$(obj);
             
            if(type=='weeks' || type=='monthes' || type=="map") {
				var blockContent=$('#div_raspisanie');
			}else{			
				var blockContent=thisObj.obj.parent('div');
			}
        	this.showProgress(blockContent);
        	    
			
        	if(!params) {
        		params={ security_ls_key: LIVESTREET_SECURITY_KEY };   	
        	} else {
        		params['security_ls_key']=LIVESTREET_SECURITY_KEY;
        	}
			if(type=="map"){
				params['mapintournament']=this.obj.val(); 
			}
        	//alert(type);
			ls.ajax(this.options.type[type].url, params, function(result) {
				this.onLoad(result, blockContent);

if(type=="map"){				
$("#gonka_list").sortable({ 
    update : function () { 
	var params = {};
	params['kval_gonka']= 0;
	params['mapintournament_id']=$('#speedB').val();
    params['order']  = $('#gonka_list').sortable('serialize');   
	  ls.ajax(aRouter['ajax']+'map/order/', params, function(result){
					if (!result) {
						ls.msg.error('Error14','Please try again later');
					}
					if (result.bStateError) {
						ls.msg.error('Error15','Please try again later');
					} else {

					}
				});	
    } 
  });
  
 $("#kval_list").sortable({ 
    update : function () { 
	var params = {};
	params['kval_gonka']= 0;
	params['mapintournament_id']=$('#speedB').val();
    params['order']  = $('#kval_list').sortable('serialize');   
	  ls.ajax(aRouter['ajax']+'map/order/', params, function(result){
					if (!result) {
						ls.msg.error('Error14','Please try again later');
					}
					if (result.bStateError) {
						ls.msg.error('Error15','Please try again later');
					} else {

					}
				});	
    } 
  });
}
 
			}.bind(this));		
                    
		}
		
	this.showProgress = function(content) {
			content.html($('<div />').css('text-align','center').append($('<img>', {src: this.options.loader})));
		};		

	return this;
}).call(ls.au || {},jQuery);