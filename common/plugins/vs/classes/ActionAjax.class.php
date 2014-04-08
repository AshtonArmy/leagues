<?php

class PluginVs_ActionAjax extends PluginVs_Inherit_ActionAjax {	
	
	
	public function Init() {
		parent::Init();
		$this->oUserCurrent=$this->User_GetUserCurrent();
	}
	
	protected function RegisterEvent() {	
		parent::RegisterEvent();
		 
		$this->AddEvent('talk_get','EventGetTalk');
		$this->AddEvent('events_get','EventGetEvents');
		$this->AddEvent('play_get','EventGetPlay');
		
		$this->AddEventPreg('/^match$/i','/^video$/','EvenAddMatchVideo'); //klaus
		$this->AddEventPreg('/^raspisanie$/i','/^map$/','EventRaspisanieMap'); //klaus
		$this->AddEventPreg('/^answer$/i','/^invite$/','EventAnswerInvite'); //klaus
		$this->AddEventPreg('/^go$/i','/^from$/','EventGoFrom'); //klaus
		$this->AddEventPreg('/^teamplay$/i','/^newstatus$/','EventTeamplayNewStatus'); //klaus
		$this->AddEventPreg('/^in$/i','/^money$/','EventInMoney'); //klaus
		$this->AddEventPreg('/^pay$/i','/^vznos$/','EventPayVznos'); //klaus
		$this->AddEventPreg('/^pay$/i','/^stavka$/','EventPayStavka'); //klaus
		$this->AddEventPreg('/^change$/i','/^status$/','EventChangeStatus'); //klaus
		$this->AddEventPreg('/^change$/i','/^back$/','EventChangeBack'); //klaus
		
		$this->AddEventPreg('/^menu$/i','/^tournaments$/','EvenMenuTournaments'); //klaus
		$this->AddEventPreg('/^menu$/i','/^one_tournament$/','EvenMenuTournament'); //klaus
		
		$this->AddEventPreg('/^setting$/i','/^team$/','EventSettingTeam'); //klaus
		$this->AddEventPreg('/^setting$/i','/^unknown_team$/','EventSettingUnknownTeam'); //klaus
		$this->AddEventPreg('/^setting$/i','/^psn$/','EventSettingPsn'); //klaus
		$this->AddEventPreg('/^setting$/i','/^tovarki$/','EventSettingTovarki'); //klaus
		$this->AddEventPreg('/^setting$/i','/^get_tovarki_table$/','EventGetTovarkiTable'); //klaus
		$this->AddEventPreg('/^setting$/i','/^matchtime$/','EventSettingMatchTime'); //klaus
		$this->AddEventPreg('/^setting$/i','/^hut_team$/','EventSettingHutTeam'); //klaus
		$this->AddEventPreg('/^setting$/i','/^delete_hut_team$/','EventDeleteHutTeam'); //klaus
		$this->AddEventPreg('/^setting$/i','/^matchtime_otvet$/','EventSettingMatchTimeOtvet'); //klaus
		$this->AddEventPreg('/^vote$/i','/^whotopic$/','EventWhoTopic'); //klaus
		$this->AddEventPreg('/^vote$/i','/^whocomment$/','EventWhoComment'); //klaus
		$this->AddEventPreg('/^au$/i','/^tournament$/','EventAuTournament'); //klaus
		$this->AddEventPreg('/^au$/i','/^teams$/','EventAuTeams'); //klaus
		
		$this->AddEventPreg('/^au$/i','/^playoff$/','EventAuPlayoff'); //klaus
		
		$this->AddEventPreg('/^au$/i','/^zayavki$/','EventAuZayavki'); //klaus
		$this->AddEventPreg('/^au$/i','/^change$/','EventAuChange'); //klaus
		$this->AddEventPreg('/^au$/i','/^setteam$/','EventAuSetTeam'); //klaus
		$this->AddEventPreg('/^au$/i','/^addteam$/','EventAuAddTeam'); //klaus
		$this->AddEventPreg('/^au$/i','/^deleteteamtournament$/','EventDeleteTeamTournament'); //klaus
		$this->AddEventPreg('/^au$/i','/^addplayer$/','EventAuAddPlayer'); //klaus
		$this->AddEventPreg('/^au$/i','/^deleteteam$/','EventAuDeleteTeam'); //klaus
		$this->AddEventPreg('/^au$/i','/^changeteam$/','EventAuChangeTeam'); //klaus
		$this->AddEventPreg('/^au$/i','/^players$/','EventAuPlayers'); //klaus 
		$this->AddEventPreg('/^au$/i','/^createstattable$/','EventCreateStatTable'); //klaus
		$this->AddEventPreg('/^au$/i','/^createround$/','EventCreateRound'); //klaus
		
		$this->AddEventPreg('/^au$/i','/^group$/','EventAuGroup'); //klaus 
		$this->AddEventPreg('/^au$/i','/^raspisanie$/','EventAuRaspisanie'); //klaus 
		$this->AddEventPreg('/^au$/i','/^setgroup$/','EventAuSetGroup'); //klaus 
		$this->AddEventPreg('/^au$/i','/^setparentgroup$/','EventAuSetParentGroup'); //klaus 
		
		$this->AddEventPreg('/^au$/i','/^createraspisanie$/','EventCreateRaspisanie'); //klaus
		$this->AddEventPreg('/^au$/i','/^deleteraspisanie$/','EventDeleteRaspisanie'); //klaus
		$this->AddEventPreg('/^au$/i','/^deleteround$/','EventDeleteRound'); //klaus
		
		$this->AddEventPreg('/^au$/i','/^update_stattable$/','EventUpdateStattable'); //klaus
		$this->AddEventPreg('/^au$/i','/^delete_alone_teams$/','EventDeleteAloneTeams'); //klaus
		
		$this->AddEventPreg('/^au$/i','/^saveround$/','EventSaveRound'); //klaus
		$this->AddEventPreg('/^au$/i','/^setteams$/','EventSetTeams'); //klaus
		$this->AddEventPreg('/^au$/i','/^createshedule$/','EventCreateShedule'); //klaus
		$this->AddEventPreg('/^au$/i','/^deleteshedule$/','EventDeleteShedule'); //klaus
		
		$this->AddEventPreg('/^au$/i','/^update_tournament$/','EventUpdateTournament'); //klaus
		$this->AddEventPreg('/^au$/i','/^autosubmit$/','AutoSubmit'); //klaus
		//$this->AddEvent('AutoSubmit','AutoSubmit');
		$this->AddEventPreg('/^au$/i','/^upload_logo$/','EventUploadLogo'); //klaus
		$this->AddEventPreg('/^au$/i','/^delete_logo$/','EventDeleteLogo'); //klaus
		
		$this->AddEventPreg('/^perenos$/i','/^set$/','EventPerenosSet'); //klaus
		$this->AddEventPreg('/^team$/i','/^info$/','EventTeamInfo'); //klaus
		$this->AddEventPreg('/^day$/i','/^info$/','EventDayInfo'); //klaus
		$this->AddEventPreg('/^user$/i','/^info$/','EventUserInfo'); //klaus
		$this->AddEventPreg('/^raspisanie$/i','/^month$/','EventRaspisanieMonth'); //klaus
		$this->AddEventPreg('/^get_more_events$/','EventGetMoreEvents'); //klaus
		$this->AddEventPreg('/^get$/i','/^player_stat$/','EventGetPlayerStat'); //klaus
		
		$this->AddEventPreg('/^turnirs$/i','/^future$/','EventTurnirsFuture'); //klaus
		$this->AddEventPreg('/^turnirs$/i','/^now$/','EventTurnirsNow'); //klaus
		$this->AddEventPreg('/^turnirs$/i','/^complete$/','EventTurnirsComplete'); //klaus
		$this->AddEventPreg('/^turnirs$/i','/^my$/','EventTurnirsMy'); //klaus
		$this->AddEventPreg('/^vyzovy$/i','/^refresh$/','EventVyzovyRefresh'); //klaus
		
		$this->AddEventPreg('/^raspisanie$/i','/^filter/','EventRaspisanieFilter'); //klaus
		$this->AddEventPreg('/^raspisanie$/i','/^weeks/','EventRaspisanieWeeks'); //klaus
		$this->AddEventPreg('/^raspisanie$/i','/^monthes$/','EventRaspisanieMonthes'); //klaus
		$this->AddEventPreg('/^raspisanie$/i','/^my/','EventRaspisanieMy'); //klaus
		$this->AddEventPreg('/^raspisanie$/i','/^dolg/','EventRaspisanieDolg'); //klaus
		$this->AddEventPreg('/^raspisanie$/i','/^willdolg/','EventRaspisanieWillDolg'); //klaus
		$this->AddEventPreg('/^match$/i','/^resultset$/','EventMatchResultSet'); //klaus
		$this->AddEventPreg('/^match$/i','/^teh$/','EventMatchTeh'); //klaus
		$this->AddEventPreg('/^match$/i','/^teh_massovo$/','EventMatchTehMassovo'); //klaus
		$this->AddEventPreg('/^match$/i','/^anul$/','EventMatchAnul'); //klaus
		$this->AddEventPreg('/^match$/i','/^anul_massovo$/','EventMatchAnulMassovo'); //klaus
		
		$this->AddEventPreg('/^match$/i','/^set_vyzov$/','EventSetVyzov'); //klaus
		$this->AddEventPreg('/^match$/i','/^set_vyzov_otvet$/','EventSetVyzovOtvet'); //klaus
		$this->AddEventPreg('/^match$/i','/^get_vyzov$/','EventGetVyzov'); //klaus
		
		$this->AddEventPreg('/^match$/i','/^getbuttons$/','EventGetMatchButtons'); //klaus
		$this->AddEventPreg('/^match$/i','/^prolonset$/','EventGetProlongSet'); //klaus
		
		$this->AddEventPreg('/^match$/i','/^resultedit$/','EventMatchResultEdit'); //klaus
		$this->AddEventPreg('/^match$/i','/^resultget$/','EventMatchResultGet'); //klaus 
		$this->AddEventPreg('/^match$/i','/^resultget_teamplay$/','EventMatchResultGetTeamplay');
		
		$this->AddEventPreg('/^match$/i','/^otchet$/','EventMatchOtchet'); //klaus
		$this->AddEventPreg('/^match$/i','/^lookup$/','EventMatchLookup'); //klaus
		$this->AddEventPreg('/^match$/i','/^resultgetadmin$/','EventMatchResultGetAdmin'); //klaus
		$this->AddEventPreg('/^match$/i','/^resultdelete$/','EventMatchResultDelete'); //klaus
		$this->AddEventPreg('/^autocompleter$/i','/^teamname$/','EventAutocompleterTeamname'); //klaus
		$this->AddEventPreg('/^autocompleter$/i','/^team$/','EventAutocompleterTeam'); //klaus
		$this->AddEventPreg('/^autocompleter$/i','/^teama$/','EventAutocompleterTeama'); //klaus
		$this->AddEventPreg('/^autocompleter$/i','/^playercard$/','EventAutocompleterPlayercard'); //klaus
		$this->AddEventPreg('/^tournament$/i','/^zayavki$/','EventTournamentZayavki'); //klaus
		
		$this->AddEventPreg('/^map$/i','/^fill_uch$/','EventMapFillUch'); //klaus
		$this->AddEventPreg('/^map$/i','/^resultkvalget$/','EventResultKvalGet'); //klaus
		$this->AddEventPreg('/^map$/i','/^kvaldelete$/','EventKvalDelete'); //klaus
		$this->AddEventPreg('/^map$/i','/^resultkvalset$/','EventResultKvalSet'); //klaus
		$this->AddEventPreg('/^map$/i','/^resultgonkaget$/','EventResultGonkaGet'); //klaus
		$this->AddEventPreg('/^map$/i','/^resultgonkaset$/','EventResultGonkaSet'); //klaus

		$this->AddEventPreg('/^map$/i','/^resultcommentget$/','EventResultCommentGet'); //klaus
		$this->AddEventPreg('/^map$/i','/^resultcommentset$/','EventResultCommentSet'); //klaus
		
		$this->AddEventPreg('/^map$/i','/^order$/','EventMapOrder'); //klaus
		$this->AddEventPreg('/^stream$/i','/^matches$/','EventStreamMatches');
		$this->AddEventPreg('/^my$/i','/^blogs$/','EventMyBlogs');
		$this->AddEventPreg('/^my$/i','/^tournaments$/','EventMyTournaments');
		$this->AddEventPreg('/^my$/i','/^matches$/','EventMyMatches');
		$this->AddEventPreg('/^teams$/i','/^teamplay$/','EventTeamsTeamplay');
		
		$this->AddEventPreg('/^check$/i','/^creation$/','EventCheckCreation');
		$this->AddEventPreg('/^into$/i','/^tournament$/','EventIntoTournament');
		$this->AddEventPreg('/^au$/i','/^tournamentrating$/','EventUpdateTournamentRating');
		
		$this->AddEvent('ajaxaddcomment','AjaxAddComment');
		$this->AddEvent('ajaxresponsecomment','AjaxResponseComment');
		
		$this->AddEventPreg('/^stream$/i','/^comment$/','EventStreamComment');
		$this->AddEventPreg('/^stream$/i','/^topic$/','EventStreamTopic');
	}
	
	
	protected function EventGetPlay(){
		if (!$this->User_IsAuthorization()) {
            $this->Message_AddErrorSingle($this->Lang_Get('not_access'));
            return Router::Action('error');
        }
		$team[]=0;
		$oViewer=$this->Viewer_GetLocalViewer();
		$oViewer->Assign('oUserCurrent', $this->oUserCurrent);
		if( $aPlayercards = $this->PluginVs_Stat_GetPlayercardItemsByFilter(array(
						'user_id' => $this->oUserCurrent->getUserId()
					)) ){
					
			$playercards = array();
			foreach($aPlayercards as $oPlayercard){
				$playercards[]=$oPlayercard->getPlayercardId();			
			}

			if($aPlayerTournaments = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
				'playercard_id in' => $playercards,
				'tournament_id'         => '0'	,
				'#with'         => array('team'),
			)))
			{		
				$oViewer->Assign('aPlayerTournaments',$aPlayerTournaments);
				foreach($aPlayerTournaments as $oPlayerTournament){
					$team[]=$oPlayerTournament->getTeamId();
				}
				//print_r($aPlayerTournaments);
			}
		
		}
		
		if (false === ($aTournaments = $this->Cache_Get("my_turnirs_".$this->oUserCurrent->GetUserId()))) {
			$sql="SELECT t.tournament_id
			FROM tis_stat_teamsintournament tt, tis_stat_tournament t
			WHERE tt.player_id =  '".$this->oUserCurrent->GetUserId()."'
				AND t.zavershen =  '0'
				AND t.site='".Config::Get('sys.site')."'
				AND t.tournament_id = tt.tournament_id
			union
			SELECT t.tournament_id
			FROM tis_stat_playertournament pt, tis_stat_tournament t
			WHERE pt.user_id =  '".$this->oUserCurrent->GetUserId()."'
				AND pt.team_id <> 0
				AND t.zavershen =  '0'
				AND t.site='".Config::Get('sys.site')."'
				AND t.tournament_id = pt.tournament_id
			union
			SELECT t.tournament_id
			FROM tis_stat_tournamentadmin ta, tis_stat_tournament t
			WHERE ta.user_id =  '".$this->oUserCurrent->GetUserId()."'
				AND t.zavershen =  '0'
				AND t.site='".Config::Get('sys.site')."'
				AND t.tournament_id = ta.tournament_id";
			$aTournaments=Engine::GetInstance()->PluginVs_Stat_GetAll($sql);
			$this->Cache_Set($aTournaments, "my_turnirs_".$this->oUserCurrent->GetUserId(), array("PluginVs_ModuleStat_EntityPlayertournament_save","PluginVs_ModuleStat_EntityTeamsintournament_save"), 60*60*6);
		}	
		$tournament=array();
		//print_r($aTournaments);
		if($aTournaments){
			foreach($aTournaments as $oTournament){
				$tournament[]=$oTournament['tournament_id'];
			}
			$mytournaments=1;
			if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
				'tournament_id in' => $tournament,
				'zavershen' => '0',
				'site' => Config::Get('sys.site'),
				//'#with'         => array('blog'),
				'#order' =>array('datestart'=>'asc'),
				'#limit' =>array('0','10')
			))
				)
			{  	
				$oViewer->Assign('aTournaments',$Tournaments);
				$oViewer->Assign('li_elements',count($Tournaments));
				//return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'spisok_turnirov.tpl');
			}
			$aFutureMatches = $this->PluginVs_Stat_GetMatchesItemsByFilter(array(
								//'dates >=' => date("Y-m-d"),
								'played' => '0',
								'tournament_id in' => $tournament,
								'gametype_id' => '3',
								'#where' => array('(away in (?a) or home in (?a) )' => array($team, $team)),				
								'#with'         => array('hometeam','awayteam','tournament'),
								'#order' =>array('dates'=>'asc','number'=>'asc'),
								'#limit' =>array('0','10'),
								));
			$oViewer->Assign('aFutureMatches',$aFutureMatches);
				
		}
		
		$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."widgets/widget.play.tpl");
		$this->Viewer_AssignAjax('sText',$sTextResult);
	}
	protected function EventGetEvents(){
	
		if (!$this->User_IsAuthorization()) {
            $this->Message_AddErrorSingle($this->Lang_Get('not_access'));
            return Router::Action('error');
        }		 
		
		$oViewer=$this->Viewer_GetLocalViewer();
		$oViewer->Assign(
                'iUserCurrentCountTrack', $this->Userfeed_GetCountTrackNew($this->oUserCurrent->getId())
            );
		$oViewer->Assign(
                'iUserCurrentCountTopicDraft', $this->Topic_GetCountDraftTopicsByUserId($this->oUserCurrent->getId())
            );	
		if (false === ($aTournaments = $this->Cache_Get("my_turnirs_".$this->oUserCurrent->GetUserId()))) {
			$sql="SELECT t.tournament_id
			FROM tis_stat_teamsintournament tt, tis_stat_tournament t
			WHERE tt.player_id =  '".$this->oUserCurrent->GetUserId()."'
				AND t.zavershen =  '0'
				AND t.site='".Config::Get('sys.site')."'
				AND t.tournament_id = tt.tournament_id
			union
			SELECT t.tournament_id
			FROM tis_stat_playertournament pt, tis_stat_tournament t
			WHERE pt.user_id =  '".$this->oUserCurrent->GetUserId()."'
				AND pt.team_id <> 0
				AND t.zavershen =  '0'
				AND t.site='".Config::Get('sys.site')."'
				AND t.tournament_id = pt.tournament_id
			union
			SELECT t.tournament_id
			FROM tis_stat_tournamentadmin ta, tis_stat_tournament t
			WHERE ta.user_id =  '".$this->oUserCurrent->GetUserId()."'
				AND t.zavershen =  '0'
				AND t.site='".Config::Get('sys.site')."'
				AND t.tournament_id = ta.tournament_id";
			$aTournaments=Engine::GetInstance()->PluginVs_Stat_GetAll($sql);
			$this->Cache_Set($aTournaments, "my_turnirs_".$this->oUserCurrent->GetUserId(), array("PluginVs_ModuleStat_EntityPlayertournament_save","PluginVs_ModuleStat_EntityTeamsintournament_save"), 60*60*6);
		}	
		$tournament=array();
		//print_r($aTournaments);
		if($aTournaments){
			foreach($aTournaments as $oTournament){
				$tournament[]=$oTournament['tournament_id'];
			}
			$mytournaments=1;
			if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
				'tournament_id in' => $tournament,
				'zavershen' => '0',
				'site' => Config::Get('sys.site'),
				//'#with'         => array('blog'),
				'#order' =>array('datestart'=>'asc'),
				'#limit' =>array('0','10')
			))
				)
			{  	
				$oViewer->Assign('aTournaments',$Tournaments);
				$oViewer->Assign('li_elements',count($Tournaments));
				//return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'spisok_turnirov.tpl');
			}
		}
		
		
		$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."widgets/widget.events.tpl");
		$this->Viewer_AssignAjax('sText',$sTextResult);
	
	
	}
	
	protected function EventRaspisanieFilter() 	{
		$Setmonth = 0;
		$Setcurrentweek = 0;
		$Setteam = 0;
		$Setyear = 0;		
		//$tournament_id=getRequest('tournament',null,'post');
		if (func_check(getRequest('tournament',null,'post'),'id',1,3))$tournament_id=getRequest('tournament',null,'post');
		
		$week=0;
		$month=0;
		$teambrief='';
		
		$timestamp = time() + (7 * 24 * 60 * 60) * getRequest('week',0,'post');
		$week = date('W', $timestamp);
		
		$myteam=0;
		$userid=0;
		if ($this->User_IsAuthorization()) {
			$aTeam = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
			'tournament_id' => $tournament_id,
			'player_id' => $this->oUserCurrent->GetUserId()		
			));
			if($aTeam){$myteam=$aTeam->getTeamId();}	
			$userid=$this->oUserCurrent->getId();
		}
		if (getRequest('team',null,'post'))
		{
			if (func_check(getRequest('team',null,'post'),'text',2,30))
			{ 
				$Setteam = 1;
				$teambrief = getRequest('team',null,'post');
			}
		}

		//$oMatches=$this->PluginVs_Stat_GetAll($sql);
		$aFilter['team'] = $myteam;
		$oMatches=$this->PluginVs_Stat_MatchesSQL($myteam, $userid, $Setteam, $teambrief, $month, $Setcurrentweek, $week, $tournament_id);
		
			$oViewer=$this->Viewer_GetLocalViewer();
			$oViewer->Assign('oMatches',$oMatches);
			$oViewer->Assign('currentweek',date('W', time()));
			$oViewer->Assign('week',$week-date('W', time()));
			$oViewer->Assign('myteam',$myteam);
			
			$admin='no';
			if ($this->User_IsAuthorization()) {
				$aAdmin = $this->PluginVs_Stat_GetTournamentadminItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'user_id' => $this->oUserCurrent->GetUserId(),
					'#page' => 'count',
					'expire >='   => date("Y-m-d")
				));
				if($aAdmin['count']>0)$admin='yes';
				if($this->oUserCurrent->isAdministrator())$admin='yes';
			}
			$oViewer->Assign('admin',$admin);
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
			$oGame= $this->PluginVs_Stat_GetGameByGameId($oTournament->getGameId());
			$oViewer->Assign('oGame',$oGame);
			
			$oBlog=$this->Blog_GetBlogByTournamentId($tournament_id);
			//$oViewer->Assign('link_match',Config::Get('path.root.web')."/".$oBlog->getPlatform()."/".$oBlog->getGame()."/".$oBlog->getGametype()."/".$oBlog->getBlogUrl()."/_match/");
			if($Setteam) $oViewer->Assign('teambrief',$teambrief);
			$oViewer->Assign('tournament_id',$tournament_id);
			if($this->oUserCurrent && ($this->oUserCurrent->isAdministrator() || $this->PluginVs_Stat_IsTournamentAdmin($oTournament)))$oViewer->Assign('admin','yes');
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."actions/ActionTournament/shedule.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);

	}	
	
	protected function EventGetTalk(){
	
		if (!$this->User_IsAuthorization()) {
            $this->Message_AddErrorSingle($this->Lang_Get('not_access'));
            return Router::Action('error');
        }
		$iPerPage = Config::Get('module.talk.per_page');
        /**
         * Формируем фильтр для поиска сообщений
         */
        //$aFilter = $this->BuildFilter();
		$aFilter = array(
            'user_id' => $this->oUserCurrent->getId(),
        );
		$aFilter['only_new'] = true;
        /**
         * Если только новые, то добавляем условие в фильтр
         */
		 /*
        if ($this->GetParam(0) == 'new') {
            $this->sMenuSubItemSelect = 'new';
            $aFilter['only_new'] = true;
            $iPerPage = 50; // новых отображаем только последние 50 писем, без постраничности
        }
		*/
        /**
         * Передан ли номер страницы
         */
        $iPage = preg_match("/^page([1-9]\d{0,5})$/i", $this->getParam(0), $aMatch) ? $aMatch[1] : 1;
        /**
         * Получаем список писем
         */
        $aResult = $this->Talk_GetTalksByFilter(
            $aFilter, 1, 5
        );

        $aTalks = $aResult['collection'];
		
		$oViewer=$this->Viewer_GetLocalViewer();
		$oViewer->Assign('aTalks',$aTalks);
		$oViewer->Assign('iUserCurrentCountTalkNew', $this->Talk_GetCountTalkNew($this->oUserCurrent->getId()));
		$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."widgets/widget.talk.tpl");
		$this->Viewer_AssignAjax('sText',$sTextResult);
	
	
	}
	/**
	 * Обработка получения последних комментов
	 * Используется в блоке "Прямой эфир"
	 *
	 */
	protected function EventStreamComment() {
		$stream_count = Config::Get('block.stream.row');
		if (func_check(getRequest('stream_count',null,'post'),'id',1,2))$stream_count=getRequest('stream_count',null,'post');
		if ($aComments=$this->Comment_GetCommentsOnline('topic',$stream_count)) {
			$oViewer=$this->Viewer_GetLocalViewer();
			$oViewer->Assign('aComments',$aComments);
			$sTextResult=$oViewer->Fetch("widgets/widget.stream_comment.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
		} else {
			$this->Message_AddErrorSingle($this->Lang_Get('block_stream_comments_no'),$this->Lang_Get('attention'));
			return;
		}
	}
	/**
	 * Обработка получения последних топиков
	 * Используется в блоке "Прямой эфир"
	 *
	 */
	protected function EventStreamTopic() {
		$stream_count = Config::Get('block.stream.row');
		if (func_check(getRequest('stream_count',null,'post'),'id',1,2))$stream_count=getRequest('stream_count',null,'post');
		if ($oTopics=$this->Topic_GetTopicsLast($stream_count)) {
			$oViewer=$this->Viewer_GetLocalViewer();
			$oViewer->Assign('oTopics',$oTopics);
			$sTextResult=$oViewer->Fetch("widgets/widget.stream_topic.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
		} else {
			$this->Message_AddErrorSingle($this->Lang_Get('block_stream_topics_no'),$this->Lang_Get('attention'));
			return;
		}
	}
	
	protected function checkTopicFields($oTopic) {
		$this->Security_ValidateSendForm();

		$bOk=true;
		if (!$oTopic->_Validate()) {
			$this->Message_AddError($oTopic->_getValidateError(),$this->Lang_Get('error'));
			$bOk=false;
		}
		/**
		 * Выполнение хуков
		 */
		$this->Hook_Run('check_link_fields', array('bOk'=>&$bOk));
		return $bOk;
	}
	protected function EvenAddMatchVideo(){ 
		$match_id=intval(getRequest('match_id',null,'post'));
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		if (func_check(getRequest('video_url',null,'post'),'text',2,3000))$video_url=getRequest('video_url',null,'post');
		
		$title = 'Video of match №'.$oMatch->getNumber().' between '.$oMatch->getAwayteam()->getName().' and '.$oMatch->getHometeam()->getName();
		$text = 'Video of tournament '.$oMatch->getTournament()->getName().' match №'.$oMatch->getNumber().' between '.$oMatch->getAwayteam()->getName().' and '.$oMatch->getHometeam()->getName()."<br/><video>".$video_url."</video>";
		$oTopic=Engine::GetEntity('Topic');
		$oTopic->_setValidateScenario('topic');
		$oTopic->setBlogId($oMatch->getBlogId());
		$oTopic->setTitle(strip_tags($title));
		$oTopic->setTextSource($text);
		$oTopic->setTags("video");
		$oTopic->setUserId($this->oUserCurrent->getId());
		$oTopic->setType('video');
		$oTopic->setLinkUrl($video_url);
		$oTopic->setDateAdd(date("Y-m-d H:i:s"));
		$oTopic->setUserIp(func_getIp());
		$oTopic->setPublish(1);
		$oTopic->setPublishDraft(1);
		$oTopic->setForbidComment(0);
		$oTopic->setMatchId($match_id);
		$oTopic->setPublishIndex(0);
		$oTopic->setText($this->Text_Parser($oTopic->getTextSource()));
		$oTopic->setTextShort($oTopic->getText());
		$oTopic->setCutText(null);
		$oTopic->setTournamentId($oMatch->getTournamentId());
		
		$_POST['blog_id'] = $oMatch->getBlogId() ;
		$_REQUEST['blog_id'] = $oMatch->getBlogId() ;
		
		$_POST['tournament_id'] = $oMatch->getTournamentId() ;
		$_REQUEST['tournament_id'] = $oMatch->getTournamentId() ;
		
		$oBlog=$this->Blog_GetBlogById($oMatch->getBlogId());
		
		$sTopicUrl = $this->Topic_CorrectTopicUrl($oTopic->getTitleTranslit());
        $oTopic->setTopicUrl($sTopicUrl);
		
		if (!$this->checkTopicFields($oTopic)) {
			return false;
		}
		
		$this->Topic_AddTopic($oTopic);
		$this->Hook_Run('topic_add_after', array('oTopic' => $oTopic, 'oBlog' => $oBlog));
		$oMatch->setWithVideo(1);
		$oMatch->Save();
		
	}
	protected function EventGoFrom(){ 
		$playertournament_id=intval(getRequest('playertournament_id',null,'post'));
		if (func_check(getRequest('who',null,'post'),'text',2,30))$who=getRequest('who',null,'post');
		
		$oPlayertournament = $this->PluginVs_Stat_GetPlayertournamentById($playertournament_id);
		$oTeam=$this->PluginVs_Stat_GetTeamByTeamId($oPlayertournament->getTeamId());
		
		$oPlayer = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
				'playercard_id' => $oPlayertournament->getPlayercardId(),
				'tournament_id'         => 0	,
			));
		if($who=='player' && $oPlayertournament->getTeamId()!=0 && ($oPlayer->getTeamId() == $oPlayertournament->getTeamId() || $this->oUserCurrent->getIsAdministrator()) ){
				
			$Transfer_add = Engine::GetEntity('PluginVs_Stat_Transfer');
			$Transfer_add->setTeamId($oPlayertournament->getTeamId()); 	
			$Transfer_add->setPlayercardId($oPlayertournament->getPlayercardId()); 
			$Transfer_add->setTimes(date("Y-m-d H:i:s"));
			$Transfer_add->setWho($this->oUserCurrent->GetUserId()); 
			$Transfer_add->setAction('leave_team'); 
			$Transfer_add->Add();			 
					
			$oPlayertournament->setTeamId(0);
			$oPlayertournament->setCap(0);
			$oPlayertournament->Save();		
			
			$aUsers=array();
			if($oPlayertournament = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
					'team_id' => $oTeam->getTeamId(),
					'tournament_id' => 0	,
					'cap >' => 0
				)))
				{	
					foreach($oPlayertournament as $oPlayertournament){
						$oUserTarget=$this->User_GetUserById($oPlayertournament->getUserId());
						$aUsers[]=$oUserTarget;
					}													
					$oTalk = $this->Talk_SendTalk('Player leave team', '', $this->oUserCurrent, $aUsers);
				}
			$this->Message_AddNoticeSingle(" ","Saved");			
		}
		
		if($who=='team' && $oPlayertournament->getTeamId()!=0 ){
				
			$Transfer_add = Engine::GetEntity('PluginVs_Stat_Transfer'); 
			$Transfer_add->setTeamId($oPlayertournament->getTeamId()); 	
			$Transfer_add->setPlayercardId($oPlayertournament->getPlayercardId()); 
			$Transfer_add->setTimes(date("Y-m-d H:i:s"));
			$Transfer_add->setWho($oPlayertournament->getUserId()); 
			$Transfer_add->setAction('leave_team'); 
			$Transfer_add->Add();			 
					
			$oPlayertournament->setTeamId(0);
			$oPlayertournament->setCap(0);
			$oPlayertournament->Save();	
			
			$aUsers=array();
			$oUserTarget=$this->User_GetUserById($oPlayertournament->getUserId());
			$aUsers[0]=$oUserTarget;					
			$oTalk=$this->Talk_SendTalk($this->Lang_Get('plugin.vs.retired') , '', $this->oUserCurrent,$aUsers);
			$this->Message_AddNoticeSingle(" ","Saved");	
		}
		
	}
	protected function EventTeamplayNewStatus(){
		$id=intval(getRequest('id',null,'post'));
		$playercard_id=intval(getRequest('playercard_id',null,'post'));
		
		$oPlayer = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
				'user_id' => $this->oUserCurrent->GetUserId(),
				'tournament_id'         => 0	,
			));
		if( ($oPlayer && $oPlayer->getCap()==2) || $this->oUserCurrent->getIsAdministrator()){		
			if($oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
					'playercard_id' => $playercard_id,
					'tournament_id'         => 0	,
				)))
			{
				if($oPlayer->getTeamId()==$oPlayerTournament->getTeamId() || $this->oUserCurrent->getIsAdministrator()){
					if($id!=2){
						$oPlayerTournament->setCap($id);
						$oPlayerTournament->Save();
						$this->Message_AddNoticeSingle(" ","Saved");
					}
					
					if($id==2){
						if($aCap = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
							'cap' => 2,
							'team_id' => $oPlayerTournament->getTeamId(),
							'tournament_id'         => 0	,
						)) ) {
						
							foreach( $aCap as $oCap){
								$oCap->setCap(1);
								$oCap->Save();
							}						
						}					
						$oPlayerTournament->setCap($id);
						$oPlayerTournament->Save();
						$this->Message_AddNoticeSingle(" ","Saved");
					}
					
				
				}else{
					$this->Message_AddErrorSingle($this->Lang_Get('plugin.vs.player_not_in_your_team') ,$this->Lang_Get('error'));
					return;				
				}
			
			}else{
				$this->Message_AddErrorSingle($this->Lang_Get('plugin.vs.no_such_player') ,$this->Lang_Get('error'));
				return;				
			}
		}else{
			$this->Message_AddErrorSingle($this->Lang_Get('plugin.vs.no_such_rights'),$this->Lang_Get('error'));
			return;			
		}
	}
	protected function EventAnswerInvite(){
		$why='';
		$answer='';
		if (func_check(getRequest('who',null,'post'),'text',2,30))$who=getRequest('who',null,'post');
		if (func_check(getRequest('why',null,'post'),'text',0,255))$why=getRequest('why',null,'post');
		$id=intval(getRequest('id',null,'post'));
		if (func_check(getRequest('invite_id',null,'post'),'id',1,11))$invite_id=getRequest('invite_id',null,'post');
				
		$oInvite = $this->PluginVs_Stat_GetInviteById($invite_id);
		$oTeam=$this->PluginVs_Stat_GetTeamByTeamId($oInvite->getTeamId());
		$oPlayercard = $this->PluginVs_Stat_GetPlayercardByPlayercardId($oInvite->getPlayercardId());
		
		if(!$oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
				'playercard_id' => $oPlayercard->getPlayercardId(),
				'tournament_id'         => 0	,
			)))
		{		
			$oPlayerTournament = Engine::GetEntity('PluginVs_Stat_Playertournament');
			$oPlayerTournament->setPsnid('');	
			$oPlayerTournament->setUserId($oPlayercard->getUserId());
			$oPlayerTournament->setPlayercardId($oPlayercard->getPlayercardId());	
			$oPlayerTournament->setTeamId(0);
			$oPlayerTournament->setTournamentId(0);	
			$oPlayerTournament->setDates(date("Y-m-d H:i:s"));	
			$oPlayerTournament->setOtozvan('0');
			$oPlayerTournament->Add();
			
			$oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
				'playercard_id' => $oPlayercard->getPlayercardId(),
				'tournament_id'         => 0	,
			));
		}
		
		if($oInvite->getTournamentId()==0){
			if($who=='player' && $oInvite->getPlayerSubmit()==0){
				if($id==1){				
					$oInvite->setPlayerSubmit(1);
					$oInvite->setSubmit(1);
					$oInvite->setTimesSubmit(date("Y-m-d H:i:s"));
					$oInvite->Save();
					 
					if($oPlayerTournament->getTeamId()!=0 && $oPlayerTournament->getTeamId()!=$oTeam->getTeamId()){
						$Transfer_add = Engine::GetEntity('PluginVs_Stat_Transfer');
						$Transfer_add->setTeamId($oPlayerTournament->getTeamId()); 	
						$Transfer_add->setPlayercardId($oPlayercard->getPlayercardId()); 
						$Transfer_add->setTimes(date("Y-m-d H:i:s"));
						$Transfer_add->setWho($oPlayercard->getUserId()); 
						$Transfer_add->setAction('leave_team'); 
						$Transfer_add->Add();							
					}
						
					$Transfer_add = Engine::GetEntity('PluginVs_Stat_Transfer');
					$Transfer_add->setTeamId($oTeam->getTeamId()); 	
					$Transfer_add->setPlayercardId($oPlayercard->getPlayercardId()); 
					$Transfer_add->setTimes(date("Y-m-d H:i:s"));
					$Transfer_add->setWho($oPlayercard->getUserId()); 
					$Transfer_add->setAction('join_team'); 
					$Transfer_add->Add();
						
					$oPlayerTournament->setTeamId($oTeam->getTeamId());
					$oPlayerTournament->setCap(0);
					$oPlayerTournament->Save();	
					$answer='Player '.$oPlayercard->getFullFio().' join club';
					$why='';
				}
				if($id==-1){				
					$oInvite->setPlayerSubmit(-1);
					$oInvite->setSubmit(0);
					$oInvite->setTimesSubmit(date("Y-m-d H:i:s"));
					$oInvite->Save();
					
					 	
					$Transfer_add = Engine::GetEntity('PluginVs_Stat_Transfer');
					$Transfer_add->setTeamId($oTeam->getTeamId()); 	
					$Transfer_add->setPlayercardId($oPlayercard->getPlayercardId()); 
					$Transfer_add->setTimes(date("Y-m-d H:i:s"));
					$Transfer_add->setWho($oPlayercard->getUserId()); 
					$Transfer_add->setAction('reject_team'); 
					$Transfer_add->Add();
						
					$answer='Player '.$oPlayercard->getFullFio().' decline invite ';
					if($why!='')$why=' "'.$why.'"';
				}
					$aUsers=array();
					if($aPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
							'team_id' => $oTeam->getTeamId(),
							'tournament_id' => 0	,
							'cap >' => 0
						)))
						{	
							if(count($aPlayerTournament)>0){
								foreach($aPlayerTournament as $osPlayerTournament){
									$oUserTarget=$this->User_GetUserById($osPlayerTournament->getUserId());
									$aUsers[]=$oUserTarget;
								}													
								$oTalk = $this->Talk_SendTalk($answer, $why, $this->oUserCurrent, $aUsers);
							}
						}			
			}
			
			if($who=='team' && $oInvite->setTeamSubmit()==0){
				if($id==1){	
				
					$oInvite->setTeamSubmit(1);
					$oInvite->setSubmit(1);
					$oInvite->setTimesSubmit(date("Y-m-d H:i:s"));
					$oInvite->Save();
					
					if($oPlayerTournament->getTeamId()!=0 && $oPlayerTournament->getTeamId()!=$oTeam->getTeamId()){
						$Transfer_add = Engine::GetEntity('PluginVs_Stat_Transfer');
						$Transfer_add->setTeamId($oPlayerTournament->getTeamId()); 	
						$Transfer_add->setPlayercardId($oPlayercard->getPlayercardId()); 
						$Transfer_add->setTimes(date("Y-m-d H:i:s"));
						$Transfer_add->setWho($oPlayercard->getUserId()); 
						$Transfer_add->setAction('leave_team'); 
						$Transfer_add->Add();							
					}
					
					$Transfer_add = Engine::GetEntity('PluginVs_Stat_Transfer');
					$Transfer_add->setTeamId($oTeam->getTeamId()); 	
					$Transfer_add->setPlayercardId($oPlayercard->getPlayercardId()); 
					$Transfer_add->setTimes(date("Y-m-d H:i:s"));
					$Transfer_add->setWho($this->oUserCurrent->GetUserId()); 
					$Transfer_add->setAction('join_team'); 
					$Transfer_add->Add();
							
					$oPlayerTournament->setTeamId($oTeam->getTeamId());
					$oPlayerTournament->setCap(0);
					$oPlayerTournament->Save();	
					$answer=''.$oPlayercard->getFullFio().' add to club';
					$why='';
				}
				if($id==-1){				
					$oInvite->setTeamSubmit(-1);
					$oInvite->setSubmit(0);
					$oInvite->setTimesSubmit(date("Y-m-d H:i:s"));
					$oInvite->Save();
					 
					$Transfer_add = Engine::GetEntity('PluginVs_Stat_Transfer');
					$Transfer_add->setTeamId($oTeam->getTeamId()); 	
					$Transfer_add->setPlayercardId($oPlayercard->getPlayercardId()); 
					$Transfer_add->setTimes(date("Y-m-d H:i:s"));
					$Transfer_add->setWho($oPlayercard->getUserId()); 
					$Transfer_add->setAction('reject_user'); 
					$Transfer_add->Add();
					
					$answer='Club decline '.$oPlayercard->getFullFio().'';
					if($why!='')$why='"'.$why.'"';
				}
					$aUsers=array();
					$oUserTarget=$this->User_GetUserById($oPlayercard->getUserId());
					$aUsers[0]=$oUserTarget;					
					$oTalk=$this->Talk_SendTalk($answer, $why, $this->oUserCurrent,$aUsers);		
			}
		}	
		$this->Message_AddNoticeSingle(" ","Done");		
	}
	
	protected function EvenMenuTournaments() {
		$game='';
		if (func_check(getRequest('game',null,'post'),'text',2,30))$game=getRequest('game',null,'post');
		if ($oGame = $this->PluginVs_Stat_GetGameByBrief($game) ){
			$oViewer=$this->Viewer_GetLocalViewer();
			$FutureTournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					'datestart >' => date("Y-m-d"),	
					'game_id' => $oGame->getGameId(),
					'#with'         => array('gametype','blog'),
					'#order' =>array('datestart'=>'desc') 
				));
			$oViewer->Assign('FutureTournaments',$FutureTournaments); 	 
			
			$NowTournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					'datestart <=' => date("Y-m-d"),
					'zavershen' => '0',
					'game_id' => $oGame->getGameId(),
					'#with'         => array('gametype','blog'),
					'#order' =>array('datestart'=>'desc') 
				));
			$oViewer->Assign('NowTournaments',$NowTournaments); 
			
			$PastTournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					'zavershen' => '1',
					'game_id' => $oGame->getGameId(),
					'#with'         => array('gametype','blog'),
					'#order' =>array('datestart'=>'desc') 
				));
			$oViewer->Assign('PastTournaments',$PastTournaments); 
			
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."menu_tournaments.tpl" ); 
			$this->Viewer_AssignAjax('sText',$sTextResult);
		}
		
	}
	
	protected function EvenMenuTournament() {
		
		
	}
	
    protected function EventIntoTournament() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
		$oGame= $this->PluginVs_Stat_GetGameByGameId($oTournament->getGameId());
		
		if(!$oPlayercard = $this->PluginVs_Stat_GetPlayercardByFilter(array(
						'user_id' => $this->oUserCurrent->GetUserId(), 
						'sport_id' => $oGame->getSportId(), 
						'platform_id' => $oGame->getPlatformId()
					))){
			$this->Message_AddErrorSingle('Before create playercard',$this->Lang_Get('error'));
            return;			
		}
					
		if($oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
					'user_id' => $this->oUserCurrent->GetUserId(),
					'tournament_id'         => $tournament_id					
				)))
		{
		
			if($oPlayerTournament->getOtozvan()==0)
				$oPlayerTournament->setOtozvan('1');
			else
				$oPlayerTournament->setOtozvan('0'); 
			$oPlayerTournament->Save();
		}else{
			$oPlayerTournament =  Engine::GetEntity('PluginVs_Stat_Playertournament');
			$oPlayerTournament->setPsnid('');	
			$oPlayerTournament->setUserId($this->oUserCurrent->GetUserId());
			$oPlayerTournament->setPlayercardId($oPlayercard->getPlayercardId());			
			$oPlayerTournament->setTournamentId($tournament_id);	
			$oPlayerTournament->setDates(date("Y-m-d H:i:s"));	
			$oPlayerTournament->setOtozvan('0');
			$oPlayerTournament->Add();
		}
		$this->Message_AddNoticeSingle(" ","Saved");
	}
    protected function EventCheckCreation() {
        $this->Viewer_SetResponseAjax('json');
		$var='';
		if (func_check(getRequest('var',null,'post'),'text',2,30))$var=getRequest('var',null,'post');
		if (func_check(getRequest('sport_id',null,'post'),'id',1,11))$sport_id=getRequest('sport_id',null,'post');
		
        // Проверяем все-ли переменные дошли
        if (!getRequest('var') || !getRequest('do')) {
               $this->Message_AddErrorSingle($this->Lang_Get('system_error'),$this->Lang_Get('error'));
               return;
        }
        if (getRequest('do') == 'name'){
				
				if($var==''){
					$this->Message_AddNoticeSingle('Название клуба должно быть более 3 символов и не длинее 30',$this->Lang_Get('error'));
                    return;
				}
				if( $this->PluginVs_Stat_GetTeamByFilter(array(
						'gametype_id <>' => '1',
						'sport_id' => $sport_id,
						'name'         => $var
					)) ){
					   $this->Message_AddErrorSingle('Данное название клуба уже занято',$this->Lang_Get('error'));
                        return;					
				}
                $this->Message_AddNoticeSingle('Название клуба свободно',$this->Lang_Get('error'));
        }
        

    }
	protected function EventMyBlogs() {
		$this -> Viewer_SetResponseAjax ('my');
		$sostoit=array();
		$sozdal =array();
		$sostoit = $this->Blog_GetBlogUsersByUserId($this->oUserCurrent->GetUserId(), null,true);		
		$sozdal = $this->Blog_GetBlogsByOwnerId($this->oUserCurrent->GetUserId(),true);
		 
		$blogs = array_merge  ($sostoit,  $sozdal); 
		
		$aBlogs = $this->Blog_GetBlogsByArrayId($blogs,array('blog_title'=>'asc'));
		 
		$oViewer=$this->Viewer_GetLocalViewer();
		$oViewer->Assign('aBlogs',$aBlogs);
		$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."widgets/widget.my_blogs.tpl"); 
		$this->Viewer_AssignAjax('sText',$sTextResult);
	}
	
	protected function EventTeamsTeamplay() {
		$this -> Viewer_SetResponseAjax ('my');
		$oViewer=$this->Viewer_GetLocalViewer();
		
		if( $Teams = $this->PluginVs_Stat_GetTeamItemsByFilter(array( 
			'blog_id <>' => 0, 
			'#with'         => array('blog','game'), 
			'#order' =>array('name'=>'asc') 
		))
			)
		{  	
		//	print_r($Teams);
			$oViewer->Assign('Teams',$Teams); 
		}
		
		$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."widgets/widget.teams_teamplay.tpl"); 
		$this->Viewer_AssignAjax('sText',$sTextResult);
		
	}
	
	protected function EventMyMatches() {
		$this -> Viewer_SetResponseAjax ('my');
		$oViewer=$this->Viewer_GetLocalViewer();
		
		
$sql="  
select tt.tournament_id, tt.team_id from tis_stat_teamsintournament  tt, tis_stat_tournament t
where tt.player_id='".$this->oUserCurrent->GetUserId()."'
and t.zavershen=0
and tt.tournament_id=t.tournament_id
union 
select pt.tournament_id, pt.team_id from tis_stat_playertournament pt, tis_stat_tournament t
where pt.user_id='".$this->oUserCurrent->GetUserId()."' and pt.team_id<>0
and t.zavershen=0
and pt.tournament_id=t.tournament_id
 ";
		$aTournaments=$this->PluginVs_Stat_GetAll($sql);
		$aMatches=array();
		$aMatch=array(); 
		$tournament_team = array();
		foreach($aTournaments as $tournament){
			$tournament_team[$tournament['tournament_id']]= $tournament['team_id'];
			$tournament_id = $tournament['tournament_id'];
			$myteam=0;
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);			
		
			if($oTeamsintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
						'tournament_id' => $tournament_id,
						'player_id' => $this->oUserCurrent->GetUserId()
						))  )	
			$myteam=$oTeamsintournament->getTeamId();
			
			if($myteam==0 && $oTournament->getGametypeId()==3){
					if($aTeam = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
					'tournament_id' => $oTournament->getTournamentId(),
					'user_id' => $this->oUserCurrent->GetUserId()		
					 ))	)
					$myteam=$aTeam->getTeamId();
				}
					if ( $aMatch=$this->PluginVs_Stat_GetMatchesItemsByFilter(array( 
						'tournament_id'=> $tournament_id,
						'#where' => array('(home = (?d) or away = (?d) ) and week(dates)=?d ' => array($myteam, $myteam, date('W'))),	
						'#with' => array('hometeam','awayteam','tournament')
					)) ){
						$aMatches=array_merge($aMatches, $aMatch);		
					}
				
		}
		
		$oViewer->Assign('aMatches', $aMatches);
		$oViewer->Assign('tournament_team', $tournament_team); 
		$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."widgets/widget.my_matches.tpl"); 
		$this->Viewer_AssignAjax('sText',$sTextResult);
	}
	protected function EventMyTournaments() {
		$this -> Viewer_SetResponseAjax ('my');
		$oViewer=$this->Viewer_GetLocalViewer();
		if($this->User_IsAuthorization()){
		
			$sql="select tournament_id from tis_stat_teamsintournament where player_id='".$this->oUserCurrent->GetUserId()."'
			union select tournament_id from tis_stat_tournamentadmin where user_id='".$this->oUserCurrent->GetUserId()."'
			union select tournament_id from tis_stat_playertournament where user_id='".$this->oUserCurrent->GetUserId()."' and team_id<>0";
			$aTournaments=$this->PluginVs_Stat_GetAll($sql);
			$tournament=array();
			if($aTournaments){
				foreach($aTournaments as $oTournament){
					$tournament[]=$oTournament['tournament_id'];
				}
				$mytournaments=1;
				if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array( 
					'tournament_id in' => $tournament,
					'zavershen' => '0',
					'#with'         => array('blog'),
					'#order' =>array('datestart'=>'asc') 
				))
					)
				{  	
					$oViewer->Assign('Tournaments',$Tournaments); 
				}
				
			}
			
		}
		
		
		$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."widgets/widget.my_turnirs.tpl"); 
		$this->Viewer_AssignAjax('sText',$sTextResult);
		
	}
	
	protected function EventStreamMatches() {
		$stream_count = Config::Get('block.stream.row');
		if (func_check(getRequest('stream_count',null,'post'),'id',1,2))$stream_count=getRequest('stream_count',null,'post');
		
		if ($aComments=$this->Comment_GetCommentsOnline('match',$stream_count)) {
			$oViewer=$this->Viewer_GetLocalViewer();
			$oViewer->Assign('aComments',$aComments);
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."widgets/widget.stream_matches.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
		} else {
			$this->Message_AddErrorSingle($this->Lang_Get('block_stream_comments_no'),$this->Lang_Get('attention'));
			return;
		}
	}
	
	protected function MiniturnirVyplata($oMiniturnir, $user_id, $summa, $komiss) {
		//$this->Viewer_AssignAjax('win',3);
	$oUser_to_pay=$this->User_GetUserById('1');
	$oUser_to_comis=$this->User_GetUserById('2');
	
	$bPurse = $this->PluginPurse_Purse_APIPay($oUser_to_pay,   $summa,
			'out',   'Выплата за участие в минитурнире '.$oMiniturnir->getName()
			);
			
	$oUser_to_pay=$this->User_GetUserById('1');
	
	$bPurse = $this->PluginPurse_Purse_APIPay( $this->oUserCurrent ,   $summa,
		'in',   'Выплата участия в минитурнире '.$oMiniturnir->getName().' '.$this->oUserCurrent->getLogin(),'', '');  

		
		
	$bPurse = $this->PluginPurse_Purse_APIPay($oUser_to_pay,   $komiss,
			'out',   'Комиссия за участие в минитурнире '.$oMiniturnir->getName()
			);
			
	$oUser_to_pay=$this->User_GetUserById('1');
	
	$bPurse = $this->PluginPurse_Purse_APIPay( $oUser_to_comis ,   $komiss,
		'in',   'Комиссия участия в минитурнире '.$oMiniturnir->getName().' '.$this->oUserCurrent->getLogin(),'', ''); 
			 
	}
	protected function MiniturnirUser($oPlayerMiniturnir, $win) {
		$oMiniturnir=$this->PluginVs_Stat_GetMiniturnirByMiniturnirId($oPlayerMiniturnir->getMiniturnirId());
		  $this -> Viewer_AssignAjax ('sText'.$oPlayerMiniturnir->getUserId(), $win.'-'.$oPlayerMiniturnir->getWins().'-'.$oMiniturnir->getOneWin());
		if($win==1){
				
			if($oPlayerMiniturnir->getWins()==2){
				if($oMiniturnir->getThirdWin()>0){
					$this->MiniturnirVyplata($oMiniturnir, $oPlayerMiniturnir->getUserId(),$oMiniturnir->getThirdWin(), $oMiniturnir->getThirdComis());
					$oPlayerMiniturnir->setWins(0);
					$oPlayerMiniturnir->setStatus(0);
					$oPlayerMiniturnir->setOplatil(0);
				}				
			}
			if($oPlayerMiniturnir->getWins()==1){
				if($oMiniturnir->getSecondWin()>0){
					$this->MiniturnirVyplata($oMiniturnir, $oPlayerMiniturnir->getUserId(),$oMiniturnir->getSecondWin(), $oMiniturnir->getSecondComis());
					$oPlayerMiniturnir->setWins(0);
					$oPlayerMiniturnir->setStatus(0);
					$oPlayerMiniturnir->setOplatil(0);
				}else{
					$oPlayerMiniturnir->setWins(2);
					$oPlayerMiniturnir->setStatus(2);
				}				
			}	
			
			if($oPlayerMiniturnir->getWins()==0){ 
				if($oMiniturnir->getOneWin()>0){ 
					$this->MiniturnirVyplata($oMiniturnir, $oPlayerMiniturnir->getUserId(),$oMiniturnir->getOneWin(), $oMiniturnir->getOneComis());
					$oPlayerMiniturnir->setWins(0);
					$oPlayerMiniturnir->setStatus(0);
					$oPlayerMiniturnir->setOplatil(0);
				}else{
					$oPlayerMiniturnir->setWins(1);
					$oPlayerMiniturnir->setStatus(2);
				}				
			}			
				
			$oPlayerMiniturnir->Save();
		} 
		if($win==0){ 
			if($oPlayerMiniturnir->getWins()==2){
					if($oMiniturnir->getThirdLose()>0){
						$this->MiniturnirVyplata($oMiniturnir, $oPlayerMiniturnir->getUserId(),$oMiniturnir->getThirdLose(), $oMiniturnir->getThirdComis());
					}				
				}
			
			if($oPlayerMiniturnir->getWins()==1){
				if($oMiniturnir->getSecondLose()>0){
					$this->MiniturnirVyplata($oMiniturnir, $oPlayerMiniturnir->getUserId(),$oMiniturnir->getSecondLose(), $oMiniturnir->getSecondComis());
				}				
			}
			
			$oPlayerMiniturnir->setWins(0);
			$oPlayerMiniturnir->setStatus(0);
			$oPlayerMiniturnir->setOplatil(0);
		
		}
		
		//$oPlayerMiniturnir->setStatus(0);
		//$oPlayerMiniturnir->setOplatil(0);
		$oPlayerMiniturnir->Save();
		
	}
	protected function CheckMiniTurnir($match_id) {
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		
		$oMiniturnir=$this->PluginVs_Stat_GetMiniturnirByMiniturnirId($oMatch->getMiniturnirId());
		  
		$oPlayerMiniturnir = $this->PluginVs_Stat_GetPlayerminiturnirByFilter(array( 
				'miniturnir_id' => $oMiniturnir->getMiniturnirId(),
				'user_id' => $oMatch->getHomePlayer()
			));
		if($oMatch->getGoalsHome()>$oMatch->getGoalsAway()){
	 
			$this->MiniturnirUser($oPlayerMiniturnir, 1);
		}
		
		if($oMatch->getGoalsHome()<$oMatch->getGoalsAway()){
			$this->MiniturnirUser($oPlayerMiniturnir, 0);
		}
		
		$oPlayerMiniturnir = $this->PluginVs_Stat_GetPlayerminiturnirByFilter(array( 
				'miniturnir_id' => $oMiniturnir->getMiniturnirId(),
				'user_id' => $oMatch->getAwayPlayer()
			));
		if($oMatch->getGoalsAway()>$oMatch->getGoalsHome()){		 
			
			$this->MiniturnirUser($oPlayerMiniturnir, 1);
		}
		
		if($oMatch->getGoalsAway()<$oMatch->getGoalsHome()){
			$this->MiniturnirUser($oPlayerMiniturnir, 0);
		} 
		
	}
	
protected function EventMapOrder () {
	if (func_check(getRequest('mapintournament_id',null,'post'),'id',1,11))$mapintournament_id=getRequest('mapintournament_id',null,'post');
	$order=getRequest('order',null,'post');
	$this->Viewer_AssignAjax('order',$order);
	$prioritet=1;
	$items = explode("&", $order);
	foreach ($items as $fields ){ 
	//$this->Viewer_AssignAjax('position',$position);
		$field = explode("=", $fields);
		//$field[0] 
		$oZaezd=$this->PluginVs_Stat_GetZaezdByZaezdId($field[1]) ;
		$oZaezd->setPrioritet($prioritet);
		$oZaezd->Save();
		$prioritet++;		
	}
}

protected function EventResultKvalGet () {
	if (func_check(getRequest('kval_id',null,'post'),'id',1,11))$kval_id=getRequest('kval_id',null,'post');
	$oZaezd=$this->PluginVs_Stat_GetZaezdByZaezdId($kval_id) ;
	$this->Viewer_AssignAjax('best_lap',$oZaezd->getBestLap());
}

protected function EventKvalDelete () {
	if (func_check(getRequest('kval_id',null,'post'),'id',1,11))$kval_id=getRequest('kval_id',null,'post');
	$oZaezd=$this->PluginVs_Stat_GetZaezdByZaezdId($kval_id);
	$oZaezd->Delete();
	
}

protected function EventResultKvalSet () {
	if (func_check(getRequest('kval_id',null,'post'),'id',1,11))$kval_id=getRequest('kval_id',null,'post');

		$best_lap=getRequest('best_lap',null,'post');
		
			
		$oZaezd=$this->PluginVs_Stat_GetZaezdByZaezdId($kval_id) ;
		$oZaezd->setBestLap($best_lap);
		$oZaezd->Save();
		
}

protected function EventResultCommentGet () {
	if (func_check(getRequest('kval_id',null,'post'),'id',1,11))$kval_id=getRequest('kval_id',null,'post');
	$oZaezd=$this->PluginVs_Stat_GetZaezdByZaezdId($kval_id) ;
	$this->Viewer_AssignAjax('comment',$oZaezd->getComment());
}

protected function EventResultCommentSet () {
	if (func_check(getRequest('kval_id',null,'post'),'id',1,11))$kval_id=getRequest('kval_id',null,'post');

		$comment=getRequest('comment',null,'post'); 	
		$oZaezd=$this->PluginVs_Stat_GetZaezdByZaezdId($kval_id) ;
		
		$oZaezd->setComment($this->Text_Parser($comment));
		$oZaezd->Save(); 
}

protected function EventResultGonkaGet () {
	if (func_check(getRequest('kval_id',null,'post'),'id',1,11))$kval_id=getRequest('kval_id',null,'post');
	$oZaezd=$this->PluginVs_Stat_GetZaezdByZaezdId($kval_id) ;
	$this->Viewer_AssignAjax('best_lap',$oZaezd->getBestLap());
	$this->Viewer_AssignAjax('times',$oZaezd->getTimes());
	$this->Viewer_AssignAjax('points',$oZaezd->getPoints());
}

protected function EventResultGonkaSet () {
	if (func_check(getRequest('kval_id',null,'post'),'id',1,11))$kval_id=getRequest('kval_id',null,'post');

		$best_lap=getRequest('best_lap',null,'post');
		$points=getRequest('points',null,'post');
		$times=getRequest('times',null,'post');
		
		$this->PluginVs_Stat_DeletePlayerStatGonka($kval_id);	
		$oZaezd=$this->PluginVs_Stat_GetZaezdByZaezdId($kval_id) ;
		$oZaezd->setBestLap($best_lap);
		$oZaezd->setTimes($times);
		$oZaezd->setPoints($points);
		$oZaezd->Save();
		$this->PluginVs_Stat_CalcPlayerStatGonka($kval_id);
		$this->PluginVs_Stat_CalcPositionGonka($kval_id);
}

protected function CalcPlayerStatGonka($zaezd_id) {

		$oZaezd = $this->PluginVs_Stat_GetZaezdByZaezdId($zaezd_id);		
		$oMapintournament = $this->PluginVs_Stat_GetMapsintournamentById($oZaezd->getMapintournamentId());
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMapintournament->getTournamentId());
		
		if(!$this->PluginVs_Stat_GetPlayerstatByFilter(array(
				'tournament_id' => $oTournament->getTournamentId(),
				'round_id' => '0',
				'game_id' => $oTournament->getGameId(),
				'gametype_id' => $oTournament->getGametypeId(),
				'user_id' => $oZaezd->getUserId()
				)))
		{
			$this->EventCreatePlayerStatTableByZaezdId($zaezd_id);
		}
		
		
		$oHomeStat = $this->PluginVs_Stat_GetPlayerstatByFilter(array(
				'tournament_id' => $oTournament->getTournamentId(),
				'round_id' => '0',
				'team_id' => $oZaezd->getTeamId(),
				'user_id' => $oZaezd->getUserId()					
				));
		$oHomeStat->setPoints($oZaezd->getPoints()+$oHomeStat->getPoints());

		$oHomeStat->Save();
		
		$oHomeStat = $this->PluginVs_Stat_GetTournamentstatByFilter(array(
					'tournament_id' => $oTournament->getTournamentId(),
					'round_id' => '0',
					'team_id' => $oZaezd->getTeamId()			
					));
		$oHomeStat->setPoints($oZaezd->getPoints()+$oHomeStat->getPoints());

		$oHomeStat->Save();			
		//$this->PluginVs_Stat_CalcPosition($match_id);
	
	}

	protected function DeletePlayerStatGonka($zaezd_id) {
		$oZaezd = $this->PluginVs_Stat_GetZaezdByZaezdId($zaezd_id);		
		$oMapintournament = $this->PluginVs_Stat_GetMapsintournamentById($oZaezd->getMapintournamentId());
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMapintournament->getTournamentId());
		
		if(!$this->PluginVs_Stat_GetPlayerstatByFilter(array(
				'tournament_id' => $oTournament->getTournamentId(),
				'round_id' => '0',
				'game_id' => $oTournament->getGameId(),
				'gametype_id' => $oTournament->getGametypeId(),
				'user_id' => $oZaezd->getUserId(),
				'team_id' => $oZaezd->getTeamId()
				)))
		{
			$this->EventCreatePlayerStatTableByZaezdId($zaezd_id);
		}
		
		
		$oHomeStat = $this->PluginVs_Stat_GetPlayerstatByFilter(array(
				'tournament_id' => $oTournament->getTournamentId(),
				'round_id' => '0',
				'team_id' => $oZaezd->getTeamId(),
				'user_id' => $oZaezd->getUserId()					
				));
		$oHomeStat->setPoints($oHomeStat->getPoints() - $oZaezd->getPoints());

		$oHomeStat->Save();
		
		$oHomeStat = $this->PluginVs_Stat_GetTournamentstatByFilter(array(
					'tournament_id' => $oTournament->getTournamentId(),
					'round_id' => '0',
					'team_id' => $oZaezd->getTeamId()			
					));
		$oHomeStat->setPoints($oHomeStat->getPoints() - $oZaezd->getPoints());

		$oHomeStat->Save();	
		
	}
	protected function EventCreatePlayerStatTableByZaezdId($zaezd_id) {
	
		$oZaezd = $this->PluginVs_Stat_GetZaezdByZaezdId($zaezd_id);		
		$oMapintournament = $this->PluginVs_Stat_GetMapsintournamentById($oZaezd->getMapintournamentId());
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMapintournament->getTournamentId());
		
		$aTournamentStat = $this->PluginVs_Stat_GetPlayerstatItemsByFilter(array(
				'tournament_id' => $oTournament->getTournamentId(),
				'round_id' => '0',
				'game_id' => $oTournament->getGameId(),
				'team_id' => $oZaezd->getTeamId(),
				'gametype_id' => $oTournament->getGametypeId(),
				'user_id' => $oZaezd->getUserId()
		));
		/*foreach($aTournamentStat as $oTournamentStat) {
			$oTournamentStat->delete();
		}*/
		if(!$aTournamentStat)
		{			
			$Stat_add =  Engine::GetEntity('PluginVs_Stat_Playerstat');
			$Stat_add->setTournamentId($oTournament->getTournamentId());
			$Stat_add->setRoundId('0'); 
			$Stat_add->setTeamId($oZaezd->getTeamId());
			$Stat_add->setUserId($oZaezd->getUserId());
			$Stat_add->setGameId($oTournament->getGameId());
			$Stat_add->setGametypeId($oTournament->getGametypeId());
			$Stat_add->Add();
		}
		
	}	
	
	protected function CalcPositionGonka($zaezd_id) {
		
		$groups=array();
		$oZaezd = $this->PluginVs_Stat_GetZaezdByZaezdId($zaezd_id);		
		$oMapintournament = $this->PluginVs_Stat_GetMapsintournamentById($oZaezd->getMapintournamentId());
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMapintournament->getTournamentId());
		 
		$aStats = $this->PluginVs_Stat_GetTournamentstatItemsByFilter(array(
			'tournament_id' => $oTournament->getTournamentId(),
			'round_id' => '0',
			'#order' =>array('points'=>'desc', '(home_w+home_wot+away_w+away_wot)'=>'desc', '(gf-ga)'=>'desc'),		
		));
		foreach($aStats as $oStats)
		{
			$group_exist=0;
			foreach($groups as $group)
			{
				if($group==$oStats->getGroupId())$group_exist=1;
				$oStats->setGrouplead(0);
			}
			if($group_exist==0){
				$groups[]=$oStats->getGroupId();
				$oStats->setGrouplead(1);
			}
			
			//$oStats->setPosition($position);
			$oStats->Save();
		}
		
		$aStats = $this->PluginVs_Stat_GetTournamentstatItemsByFilter(array(
			'tournament_id' => $oTournament->getTournamentId(),
			'round_id' => '0',
			'#order' =>array( 'points'=>'desc', '(home_w+home_wot+away_w+away_wot)'=>'desc', '(gf-ga)'=>'desc'),		
		));
		$position=1;
		foreach($aStats as $oStats)
		{
			$oStats->setPosition($position);
			$oStats->Save();
			$position++;
		}
	}
public function SearchSopernikByUser ($miniturnir_id, $user_id) {
	$sql="SELECT pm.user_id as user_id 
				FROM `tis_stat_playerminiturnir` pm, `tis_stat_playerminiturnir` pm_we   
				WHERE pm.status=1 and pm.oplatil=1 
				and pm_we.status=1 and pm_we.oplatil=1
				and pm_we.user_id='".$user_id."'
				and pm_we.miniturnir_id='".$miniturnir_id."'
				
				and pm_we.wins=pm.wins
				and pm.user_id<>'".$user_id."'
				and pm.miniturnir_id='".$miniturnir_id."'
				LIMIT 0,1				 ";						 
	$aUser=$this->PluginVs_Stat_GetAll($sql);
	if($aUser){
		return $aUser[0]['user_id'];
	}else{
		return 0;
	}
}	

protected function EventChangeStatus () {
if (func_check(getRequest('miniturnir_id',null,'post'),'id',1,11))$miniturnir_id=getRequest('miniturnir_id',null,'post');
	
	if($oMiniturnir=$this->PluginVs_Stat_GetMiniturnirByMiniturnirId($miniturnir_id) ){
		  
		if($oPlayerMiniturnir = $this->PluginVs_Stat_GetPlayerminiturnirByFilter(array( 
				'miniturnir_id' => $oMiniturnir->getMiniturnirId(),
				'user_id' => $this->oUserCurrent->GetUserId()
			)) ){
			
			$status=$oPlayerMiniturnir->getStatus();
			if($status==1){
				$oPlayerMiniturnir->setStatus('2');
				$oPlayerMiniturnir->Save();
				$this->Message_AddNoticeSingle(" ","приостановлено");
			}
			if($status==3){ 
				$this->Message_AddErrorSingle(" ","у вас уже идет матч");
			}
			
			if($status==2){
				$oPlayerMiniturnir->setStatus('1');
				$oPlayerMiniturnir->Save();
				$this->Message_AddNoticeSingle(" ","продолжаем");
				$sopernik=$this->SearchSopernikByUser ($miniturnir_id, $this->oUserCurrent->GetUserId());
				if($sopernik!=0){
					if(rand(0,1)>0.5){
						$user1=$sopernik;
						$user2=$this->oUserCurrent->GetUserId();
					}else{
						$user2=$sopernik;
						$user1=$this->oUserCurrent->GetUserId();					
					}
					$sql="select max(number) as num from tis_stat_matches where tournament_id='0' and miniturnir_id='".$oMiniturnir->getMiniturnirId()."' union select 0 as num order by num desc";
					if ($aNum=$this->PluginVs_Stat_GetAll($sql)) $num=$aNum[0]['num']; 
					$num++;
			
					$oMatch_add =  Engine::GetEntity('PluginVs_Stat_Matches');			
					$oMatch_add->setTournamentId(0);
					$oMatch_add->setRoundId(0);
					$oMatch_add->setGameId($oMiniturnir->getGameId());
					$oMatch_add->setGametypeId($oMiniturnir->getGametypeId());
					$oMatch_add->setMiniturnirId($oMiniturnir->getMiniturnirId());
					$oMatch_add->setDates(date("Y-m-d"));
					$oMatch_add->setHome(0);
					$oMatch_add->setAway(0);
					$oMatch_add->setHomeComment('');
					$oMatch_add->setAwayComment('');
					$oMatch_add->setHomePlayer($user1);
					$oMatch_add->setAwayPlayer($user2);
					$oMatch_add->setNumber($num);
					$oMatch_add->setBlogId(0);
					$oMatch_add->Add();
					
					
					$oPlayerMiniturnir->setStatus('3');
					$oPlayerMiniturnir->Save();
					
					$oPlayerMiniturnir = $this->PluginVs_Stat_GetPlayerminiturnirByFilter(array( 
						'miniturnir_id' => $oMiniturnir->getMiniturnirId(),
						'user_id' => $sopernik
					));
					$oPlayerMiniturnir->setStatus('3');
					$oPlayerMiniturnir->Save();
					
					$aUsers=array();
					$oUserTarget=$this->User_GetUserById($sopernik);
					$aUsers[0]=$oUserTarget;
					$aUsers[1]=$this->oUserCurrent;
					
					$oAdmin=$this->User_GetUserById(1);
					
					$oGameType= $this->PluginVs_Stat_GetGametypeByGametypeId($oMiniturnir->getGametypeId());
					$oGame= $this->PluginVs_Stat_GetGameByGameId($oMiniturnir->getGameId());		
					$link=Config::Get('path.root.web')."/miniturnir/".$oGame->getBrief()."/".$oGameType->getBrief();
					$oTalk=$this->Talk_SendTalk('Соперник для матча найден','Пройдите по <a href="'.$link.'">ссылке</a>',$oAdmin,$aUsers);
					
					$chat='<a href="'.$link.'" target="_blank" title="'.$link.'">http://virtualsports.r.../1vs1</a>';
					
					$sql="INSERT INTO `db_vs`.`cometchat` (`id`, `from`, `to`, `message`, `sent`, `read`, `direction`) VALUES (NULL, '".$user1."', '".$user2."', 'ваш соперник (робот) ".$chat."', '".time()."', '0', '0');";
					$insert=$this->PluginVs_Stat_GetAll($sql);
					
					$sql="INSERT INTO `db_vs`.`cometchat` (`id`, `from`, `to`, `message`, `sent`, `read`, `direction`) VALUES (NULL, '".$user2."', '".$user1."', 'ваш соперник (робот) ".$chat."', '".time()."', '0', '0');";
					$insert=$this->PluginVs_Stat_GetAll($sql);
					
					
				}
				
			}	
			
		 }else{
			$this->Message_AddErrorSingle('Ошибка','обратитесь к администратору, что-то странное');
			return;
		} 
	}
}

protected function EventChangeBack () {
if (func_check(getRequest('miniturnir_id',null,'post'),'id',1,11))$miniturnir_id=getRequest('miniturnir_id',null,'post');
	
	if($oMiniturnir=$this->PluginVs_Stat_GetMiniturnirByMiniturnirId($miniturnir_id) ){
		  
		if($oPlayerMiniturnir = $this->PluginVs_Stat_GetPlayerminiturnirByFilter(array( 
				'miniturnir_id' => $oMiniturnir->getMiniturnirId(),
				'user_id' => $this->oUserCurrent->GetUserId()
			)) ){
			
			
			$oUser_to_pay=$this->User_GetUserById('1');
			
			if (($bPurse = $this->PluginPurse_Purse_APIPay($oUser_to_pay,   $oMiniturnir->getStavka(),
					'out',   'Возврат за участие в минитурнире '.$oMiniturnir->getName()
			        ))) { 
					
				$oUser_to_pay=$this->User_GetUserById('1');
				
				$bPurse = $this->PluginPurse_Purse_APIPay( $this->oUserCurrent ,   $oMiniturnir->getStavka(),
					'in',   'Возврат участия в минитурнире '.$oMiniturnir->getName().' '.$this->oUserCurrent->getLogin(),'', '');  
			
				$oPlayerMiniturnir->setOplatil('0');
				$oPlayerMiniturnir->setStatus('0');
				$oPlayerMiniturnir->Save();
				
				$this->Message_AddNoticeSingle(" ","Отозвано");
				
			}else{ 
				$this->Message_AddErrorSingle('Ошибка','странно');
				return;
			}

		 }else{
			$this->Message_AddErrorSingle('Ошибка','обратитесь к администратору, что-то странное');
			return;
		} 
	}
}

protected function EventPayStavka () {
	if (func_check(getRequest('miniturnir_id',null,'post'),'id',1,11))$miniturnir_id=getRequest('miniturnir_id',null,'post');
	
	if($oMiniturnir=$this->PluginVs_Stat_GetMiniturnirByMiniturnirId($miniturnir_id) ){
		 
		/*if (!$this->PluginPurse_Purse_APICheckPay($this->oUserCurrent, 'tournament', $tournament_id)) {*/
		if($oPlayerMiniturnir = $this->PluginVs_Stat_GetPlayerminiturnirByFilter(array( 
				'miniturnir_id' => $oMiniturnir->getMiniturnirId(),
				'user_id' => $this->oUserCurrent->GetUserId()
			)) ){
			
			if (!$this->PluginPurse_Purse_APICheckSum($this->oUserCurrent,   $oMiniturnir->getStavka() )) {
				$this->Message_AddErrorSingle('Ошибка','Недостаточно средств');
				return;
			}
			if ($oPlayerMiniturnir->getOplatil()==1) {
				$this->Message_AddErrorSingle('Ошибка','Уже оплачено');
				return;
			}
			
			if (($bPurse = $this->PluginPurse_Purse_APIPay($this->oUserCurrent,   $oMiniturnir->getStavka(),
					'out',   'Оплата за участие в минитурнире '.$oMiniturnir->getName()
			        ))) { 
					
				$oUser_to_pay=$this->User_GetUserById('1');
				
				$bPurse = $this->PluginPurse_Purse_APIPay( $oUser_to_pay,   $oMiniturnir->getStavka(),
					'in',   'Оплата участия в минитурнире '.$oMiniturnir->getName().' '.$this->oUserCurrent->getLogin(),'', '');  
			
				//$oTournament->setFond($oMiniturnir->getFond()+$oMiniturnir->getStavka());
				//$oTournament->Save();
				$oPlayerMiniturnir->setOplatil('1');
				$oPlayerMiniturnir->setStatus('1');
				$oPlayerMiniturnir->Save();
				$sopernik=$this->SearchSopernikByUser ($miniturnir_id, $this->oUserCurrent->GetUserId());
				if($sopernik!=0){
					if(rand(0,1)>0.5){
						$user1=$sopernik;
						$user2=$this->oUserCurrent->GetUserId();
					}else{
						$user2=$sopernik;
						$user1=$this->oUserCurrent->GetUserId();					
					}
					$sql="select max(number) as num from tis_stat_matches where tournament_id='0' and miniturnir_id='".$oMiniturnir->getMiniturnirId()."' union select 0 as num order by num desc";
					if ($aNum=$this->PluginVs_Stat_GetAll($sql)) $num=$aNum[0]['num']; 
					$num++;
			
					$oMatch_add =  Engine::GetEntity('PluginVs_Stat_Matches');			
					$oMatch_add->setTournamentId(0);
					$oMatch_add->setRoundId(0);
					$oMatch_add->setGameId($oMiniturnir->getGameId());
					$oMatch_add->setGametypeId($oMiniturnir->getGametypeId());
					$oMatch_add->setMiniturnirId($oMiniturnir->getMiniturnirId());
					$oMatch_add->setDates(date("Y-m-d"));
					$oMatch_add->setHome(0);
					$oMatch_add->setAway(0);
					$oMatch_add->setHomeComment('');
					$oMatch_add->setAwayComment('');
					$oMatch_add->setHomePlayer($user1);
					$oMatch_add->setAwayPlayer($user2);
					$oMatch_add->setNumber($num);
					$oMatch_add->setBlogId(0);
					$oMatch_add->Add();
					
					
					$oPlayerMiniturnir->setStatus('3');
					$oPlayerMiniturnir->Save();
					
					$aUsers=array();
					$oUserTarget=$this->User_GetUserById($sopernik);
					$aUsers[0]=$oUserTarget;
					$aUsers[1]=$this->oUserCurrent;
					
					$oAdmin=$this->User_GetUserById(1);
					
					$oGameType= $this->PluginVs_Stat_GetGametypeByGametypeId($oMiniturnir->getGametypeId());
					$oGame= $this->PluginVs_Stat_GetGameByGameId($oMiniturnir->getGameId());		
					$link=Config::Get('path.root.web')."/miniturnir/".$oGame->getBrief()."/".$oGameType->getBrief();
					$oTalk=$this->Talk_SendTalk('Соперник для матча найден','Пройдите по <a href="'.$link.'">ссылке</a>',$oAdmin,$aUsers);
					
					
					$chat='<a href="'.$link.'" target="_blank" title="'.$link.'">http://virtualsports.r.../1vs1</a>';
					
					$sql="INSERT INTO `db_vs`.`cometchat` (`id`, `from`, `to`, `message`, `sent`, `read`, `direction`) VALUES (NULL, '".$user1."', '".$user2."', 'ваш соперник (робот) ".$chat."', '".time()."', '0', '0');";
					$insert=$this->PluginVs_Stat_GetAll($sql);
					
					$sql="INSERT INTO `db_vs`.`cometchat` (`id`, `from`, `to`, `message`, `sent`, `read`, `direction`) VALUES (NULL, '".$user2."', '".$user1."', 'ваш соперник (робот) ".$chat."'', '".time()."', '0', '0');";
					$insert=$this->PluginVs_Stat_GetAll($sql);
					
					$oPlayerMiniturnir = $this->PluginVs_Stat_GetPlayerminiturnirByFilter(array( 
						'miniturnir_id' => $oMiniturnir->getMiniturnirId(),
						'user_id' => $sopernik
					));
					$oPlayerMiniturnir->setStatus('3');
					$oPlayerMiniturnir->Save();
				}
				$this->Message_AddNoticeSingle(" ","Оплачено");
				
			}else{ 
				$this->Message_AddErrorSingle('Ошибка','странно');
				return;
			}

		 }else{
			$this->Message_AddErrorSingle('Ошибка','обратитесь к администратору, что-то странное');
			return;
		} 
	}
}

protected function EventPayVznos () {
	$summa_vznosa=0;
	if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
	if (func_check(getRequest('summa_vznosa',null,'post'),'text',1,11))$summa_vznosa=getRequest('summa_vznosa',null,'post');
	
	if($summa_vznosa<=0){
		$this->Message_AddErrorSingle('странная сумма взноса','Ошибка');
		return;
	}
	if($oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id) ){
		$aFilter = array(
						'user_id' => $this->oUserCurrent->GetUserId(),
						'operation_subject_type' => 'tournament',
						'operation_subject_id' => $oTournament->getTournamentId()
					);
		$aResult = $this->PluginLspurse_Purse_GetOperationByFilter($aFilter, 1, 1);
		$aOperations = $aResult['collection']; 
		if(count($aOperations)==0){			
			$aResult = $this->PluginLspurse_Api_Pay($this->oUserCurrent, $summa_vznosa, 'Оплата участия в турнире '.$oTournament->getName().' '.$this->oUserCurrent->getLogin(), 'out', 'tournament', $tournament_id);
		}else{
			/**
			 * Проверяем хватает ли средств
			 */
			if ($summa_vznosa > $this->PluginLspurse_Purse_GetBalanceByUserId( $this->oUserCurrent->GetUserId() )) {
				$this->Message_AddErrorSingle('Ошибка',$this->Lang_Get('plugin.lspurse.purse_error_api_no_balance'));
				return $aResult;
			}
			$oOperation = array_shift($aOperations);
			$oOperation->setSumma( $oOperation->getSumma() - $summa_vznosa);
			$this->PluginLspurse_Purse_UpdateOperation($oOperation);
		}
		/*
		if (!$this->PluginPurse_Purse_APICheckPay($this->oUserCurrent, 'tournament', $tournament_id)) {

			if (!$this->PluginPurse_Purse_APICheckSum($this->oUserCurrent,   $oTournament->getVznos() )) {
				//$this->Message_AddErrorSingle(  'Недостаточно средств');
				//return Router::Action('error');
				$this->Message_AddErrorSingle('Ошибка','Недостаточно средств');
				return;
			}

			if (($bPurse = $this->PluginPurse_Purse_APIPay($this->oUserCurrent,   $oTournament->getVznos(),
					'out',   'Оплата за участие в турнире',
			 'tournament', $tournament_id))) { 
					
				$oUser_to_pay=$this->User_GetUserById('1');
				
				$bPurse = $this->PluginPurse_Purse_APIPay( $oUser_to_pay,   $oTournament->getVznos(),
					'in',   'Оплата участия в турнире '.$oTournament->getName().' '.$this->oUserCurrent->getLogin(),'', '');  
			
				$oTournament->setFond($oTournament->getFond()+$oTournament->getVznos());
				$oTournament->Save();
				$this->Message_AddNoticeSingle(" ","Оплачено");
				
			}else{ 
				$this->Message_AddErrorSingle('Ошибка','странно');
				return;
			}

		}else{
			$this->Message_AddErrorSingle('Ошибка','Вы уже оплатили');
			return;
		}*/
	}
}
	
public function isAdminTest($tournament_id){
	$admin='no';
	if ($this->User_IsAuthorization()) {
		$aAdmin = $this->PluginVs_Stat_GetTournamentadminItemsByFilter(array(
			'tournament_id' => $tournament_id,
			'user_id' => $this->oUserCurrent->GetUserId(),
			'#page' => 'count',
			'expire >='   => date("Y-m-d")
		));
		if($aAdmin['count']>0)$admin='yes';
		if($this->oUserCurrent->isAdministrator())$admin='yes';
	}
	return $admin;
}
public function EventInMoney(){
	if (func_check(getRequest('user_id',null,'post'),'id',1,11))$user_id=getRequest('user_id',null,'post');
	$sum=getRequest('howmuch',null,'post');
	
	if ($this->oUserCurrent->GetUserId()!=4)  {
			$this->Message_AddError($this->Lang_Get('system_error'),$this->Lang_Get('error'));
			return;
		}
	if (!($bPurse = $this->PluginPurse_Purse_APIPay($user_id,   $sum,
			'in',   'Пополнение счета через платежные системы',
			'', ''))) { 
			$this->Message_AddErrorSingle('Ошибка','странно');
	}else{
		$this->Message_AddNoticeSingle(" ","Пополнил");
	}
		
}

protected function EventMapFillUch () {	

	if (func_check(getRequest('mapintournament_id',null,'post'),'id',1,11))$mapintournament_id=getRequest('mapintournament_id',null,'post');
	
	$oMapsInTournament = $this->PluginVs_Stat_GetMapsintournamentById($mapintournament_id);
	
	if($this->isAdminTest($oMapsInTournament->getTournamentId())=='yes') 
		{
				
			
			$aTeam = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
				'tournament_id' => $oMapsInTournament->getTournamentId(),
				'player_id !=' => '0'		
			));
			
			foreach($aTeam as $oTeam){
				//zaezd_id 	mapintournament_id 	team_id 	best_lap 	times 	prioritet 	kval_gonka 	points 	user_id 	comment 
				
				$oZaezd_add =  Engine::GetEntity('PluginVs_Stat_Zaezd');
				$oZaezd_add->setMapintournamentId($mapintournament_id);
				$oZaezd_add->setTeamId($oTeam->getTeamId());
				$oZaezd_add->setUserId($oTeam->getPlayerId());
				$oZaezd_add->setBestLap('-');
				$oZaezd_add->setTimes('-');
				$oZaezd_add->setPrioritet('0');
				$oZaezd_add->setKvalGonka('0');
				$oZaezd_add->setPoints('0');
				$oZaezd_add->setComment(''); 
				$oZaezd_add->Add();
				$n=2;
			}
			
			foreach($aTeam as $oTeam){
				//zaezd_id 	mapintournament_id 	team_id 	best_lap 	times 	prioritet 	kval_gonka 	points 	user_id 	comment 
				
				$oZaezd_add =  Engine::GetEntity('PluginVs_Stat_Zaezd');
				$oZaezd_add->setMapintournamentId($mapintournament_id);
				$oZaezd_add->setTeamId($oTeam->getTeamId());
				$oZaezd_add->setUserId($oTeam->getPlayerId());
				$oZaezd_add->setBestLap('-');
				$oZaezd_add->setTimes('-');
				$oZaezd_add->setPrioritet('0');
				$oZaezd_add->setKvalGonka('1');
				$oZaezd_add->setPoints('0');
				$oZaezd_add->setComment(''); 
				$oZaezd_add->Add();
			
			}
			$this->Message_AddNoticeSingle("Ок","Fill");
		}
	
}


 protected function EventUserInfo () {
    $this -> Viewer_SetResponseAjax ('my');
	if (func_check(getRequest('UserLogin',null,'post'),'text',3,20))$UserLogin=getRequest('UserLogin',null,'post');

    $oUser = $this -> User_GetUserByLogin ($UserLogin);
    if (!$oUser) return false;
    
		$iCountTopicUser = $this -> Topic_GetCountTopicsPersonalByUser ($oUser -> getId (), 1);
		$iCountCommentUser = $this -> Comment_GetCountCommentsByUserId ($oUser -> getId (), 'topic');
		
		// fetch template
    $oViewer = $this -> Viewer_GetLocalViewer ();
    $oViewer -> Assign ('oUser', $oUser);
    $oViewer -> Assign ('iCountTopicUser', $iCountTopicUser);
    $oViewer -> Assign ('iCountCommentUser', $iCountCommentUser);
    $oViewer -> Assign ('oUserCurrent', $this -> oUserCurrent);
    
	$sTextResult=$oViewer->Fetch("user_info.tpl"); 
    $this -> Viewer_AssignAjax ('sText', $sTextResult);
	}
	
	protected function EventGetPlayerStat() {
		if (func_check(getRequest('game_id',null,'post'),'id',1,11))$game_id=getRequest('game_id',null,'post');
		if (func_check(getRequest('user_id',null,'post'),'id',1,11))$user_id=getRequest('user_id',null,'post');
	
		$oGame = $this->PluginVs_Stat_GetGameByGameId($game_id);
		
		if($Playerstat = $this->PluginVs_Stat_GetPlayerstatItemsByFilter(array(
				'user_id' => $user_id,
				'game_id' => $game_id,
				'#with'         => array('team','tournament', 'gametype'),
				'#order' =>array('tournament_id'=>'desc','round_id'=>'asc') 
			))){
/*			$oViewer=$this->Viewer_GetLocalViewer();	
			$oViewer->Assign('Playerstat',$Playerstat); 
			$oViewer->Assign('game_id',$game_id);  
			 
			
			$sTextResult=$oViewer->Fetch("block.playerstat_table.tpl");
			$this->Viewer_Assign('sTextResult',$sTextResult); 
			$this->Viewer_Assign('aGames',$aGames);
			$this->Viewer_Assign('game_id',$game_id);	*/
//-------------
			$oViewer=$this->Viewer_GetLocalViewer();	
			
			$aEvents = $this->PluginVs_Stat_StreamRead(5, 0,0,$user_id,$game_id );
			$oViewer->Assign('aStreamEvents', $aEvents);
			if (count($aEvents)) {
				$oEvenLast=end($aEvents);
				$oViewer->Assign('iStreamLastId', $oEvenLast->getId());
			}
			$oGame = $this->PluginVs_Stat_GetGameByFilter(array( 
				'game_id'       => $game_id,
				'#with'         => array('platform')
			));
			$oUser=$this->User_GetUserById($user_id);
			$oPlayerRatings=$this->PluginVs_Stat_PlayerRatings($user_id,$game_id, 1);
			
			$oViewer->Assign('oGame',$oGame);
			$oViewer->Assign('oUser',$oUser);	
			
			if(isset($oPlayerRatings))$oViewer->Assign('oPlayerRatings',$oPlayerRatings);	
			
			$oViewer->Assign('Playerstat',$Playerstat); 
			$oViewer->Assign('game_id',$game_id);  
			$oViewer->Assign('sport_id',$oGame->getSportId());
			$sTextResult=$oViewer->Fetch("block.playerstat_table.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);			
		}
	}
	protected function EventGetProlongSet() {
		$prichina='';
		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');
		if (func_check(getRequest('srok',null,'post'),'text',1,3))$srok=getRequest('srok',null,'post');
		if (func_check(getRequest('prichina',null,'post'),'text',1,250))$prichina=getRequest('prichina',null,'post');
		$user_id=0;
		$admin_id=0;
		if (isTournamentAdmin($match_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) 		
		{
			$admin_id=$this->oUserCurrent->GetUserId();
			$oProlong_add =  Engine::GetEntity('PluginVs_Stat_Prolong');
			$oProlong_add->setMatchId($match_id);
			$oProlong_add->setSrok($srok);
			$oProlong_add->setUserId($user_id);
			$oProlong_add->setAdminId($admin_id);
			$oProlong_add->setStatus('1');
			$oProlong_add->setPrichina($prichina);
			$oProlong_add->setDates(date("Y-m-d H:i:s"));
			$oProlong_add->Add();
			
			$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
			$oMatch->setProdlen($oMatch->getProdlen() + $srok);
			$oMatch->Save();			
						
			$this->Message_AddNoticeSingle("Ок","Продлили");
		}else{
			$this->Message_AddErrorSingle('Ошибка','у вас нет прав');
				
		}
		
	}
	protected function EventGetMatchButtons() {
		 
		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');
		$oViewer=$this->Viewer_GetLocalViewer();			
		
		$oMatch = $this->PluginVs_Stat_GetMatchesByFilter(array(
						'match_id' => $match_id,
						'#with'         => array('awayuser','homeuser','hometeam','awayteam'),
						));
		
		
		$myteam=0;
		$userid=0;
		$isAdmin=0;
		if ($this->User_IsAuthorization()) {
			$aTeam = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
			'tournament_id' => $oMatch->getTournamentId(),
			'player_id' => $this->oUserCurrent->GetUserId()		
			));
			if($aTeam){$myteam=$aTeam->getTeamId();}	
			
			if($myteam==0 && $oMatch->getGametypeId()==3){
				if($aTeam = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
				'tournament_id' => $oMatch->getTournamentId(),
				'user_id' => $this->oUserCurrent->GetUserId()		
				 ))	)
				$myteam=$aTeam->getTeamId();
			}
			$userid=$this->oUserCurrent->getId();
			if (isTournamentAdmin($oMatch->getTournamentId(),$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) 		
					{
						$isAdmin=1;
					}		
		}
		$oViewer->Assign('oMatch',$oMatch);
		$oViewer->Assign('isAdmin',$isAdmin);
		$oViewer->Assign('myteam',$myteam);
		$oViewer->Assign('userid',$userid);
		
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());	
if($oTournament){		
		$oBlog=$this->Blog_GetBlogById($oTournament->getBlogId());		
			//$link=$oBlog->getUrlFull()."turnir/".$oTournament->getUrl()."/_match/".$match_id;
			
			//$oBlog=$this->Blog_GetBlogByTournamentId($tournament_id);
		$oViewer->Assign('link_match',$oTournament->getUrlFull()."match/" /*$oBlog->getUrlFull()."turnir/".$oTournament->getUrl()."/_match/"*/);
		$oViewer->Assign('link_match_insert',$oTournament->getUrlFull()."match_insert/" /*$oBlog->getUrlFull()."turnir/".$oTournament->getUrl()."/_match_insert/" */ );	
		$oViewer->Assign('link_turnir', $oTournament->getUrlFull() /*$oBlog->getUrlFull()."turnir/".$oTournament->getUrl()*/);
		$oViewer->Assign('oTournament', $oTournament);
		//$oBlog=$this->Blog_GetBlogByTournamentId($oMatch->getTournamentId());
		//$oViewer->Assign('link_match',Config::Get('path.root.web')."/".$oBlog->getPlatform()."/".$oBlog->getGame()."/".$oBlog->getGametype()."/".$oBlog->getBlogUrl()."/_match/");
}	
		if($oMatch->getTournamentId()!=0){
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."actions/ActionVs/match_buttons.tpl");
		}else{ 
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."actions/ActionMiniTurnir/match_buttons.tpl");
		}	
		$this->Viewer_AssignAjax('sText',$sTextResult);
	}
	
	protected function EventGetMoreEvents() {
		$this->Viewer_SetResponseAjax('json');
		/**
		 * Необходимо передать последний просмотренный ID событий
		 */
		$iFromId = getRequest('last_id');
		$tournament_id = getRequest('tournament_id');
		if (!$iFromId)  {
			$this->Message_AddError($this->Lang_Get('system_error'),$this->Lang_Get('error'));
			return;
		}
		/**
		 * Получаем события
		 */
		//$aEvents = $this->Stream_Read(null, $iFromId);
		
		$aEvents = $this->PluginVs_Stat_StreamRead(null, $iFromId,$tournament_id);
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
		$oBlog=$this->Blog_GetBlogById($oTournament->getBlogId());
		
		$oViewer=$this->Viewer_GetLocalViewer();
		$oViewer->Assign('aStreamEvents', $aEvents);
		$oViewer->Assign('oBlog', $oBlog);
		if (count($aEvents)) {
			$oEvenLast=end($aEvents);
			$this->Viewer_AssignAjax('iStreamLastId', $oEvenLast->getId());
		}
		/**
		 * Возвращаем данные в ajax ответе
		 */
		//$this->Viewer_AssignAjax('result', $oViewer->Fetch('actions/ActionStream/events.tpl'));
		$this->Viewer_AssignAjax('result', $oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."actions/ActionVs/tournament_events.tpl"));
		
		$this->Viewer_AssignAjax('events_count', count($aEvents));
	}
	public function AutoSubmit() {
		$this->PluginVs_Stat_AutoSubmit();
	}	

	protected function EventDayInfo() {
		$this -> Viewer_SetResponseAjax ('my');
		$team_id=0;
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if (func_check(getRequest('day',null,'post'),'id',1,2))$day=getRequest('day',null,'post');
		if (func_check(getRequest('month',null,'post'),'id',1,2))$month=getRequest('month',null,'post');
		
		$myteam=0;
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);			
		
		if($team_id==0){
			if($oTeamsintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
						'tournament_id' => $tournament_id,
						'player_id' => $this->oUserCurrent->GetUserId()
						))  )	
			$myteam=$oTeamsintournament->getTeamId();
			
			if($myteam==0 && $oTournament->getGametypeId()==3){
					if($aTeam = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
					'tournament_id' => $oTournament->getTournamentId(),
					'user_id' => $this->oUserCurrent->GetUserId()		
					 ))	)
					$myteam=$aTeam->getTeamId();
				}
		}else{
			$myteam = $team_id;
		}		
		$aMatches=$this->PluginVs_Stat_GetMatchesItemsByFilter(array(
			'tournament_id' => $tournament_id,
			'#where' => array('(home = (?d) or away = (?d) ) and month(dates)=?d and day(dates)=?d' => array($myteam,$myteam, $month, $day)),	
			'#with' => array('awayuser','homeuser','hometeam','awayteam'),
			'#order'         => array("number") 
		));
		$team=array();
		foreach($aMatches as $oMatch)
		{
			if($myteam != $oMatch->getHome()){$team[]=$oMatch->getHome();}else{$team[]=$oMatch->getAway();}
		}
		if(isset($team[0])){
			$oTeamsintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
						'tournament_id' => $tournament_id,
						'team_id' => $team[0]
						));
						
			if($oTeamsintournament){
				$aUserFields = $this->User_getUserFieldsValues($oTeamsintournament->getPlayerId());
				$oUser=$this->User_GetUserById($oTeamsintournament->getPlayerId());
				$oPlayerTournament=$this->PluginVs_Stat_GetPlayertournamentByFilter(array(
						'tournament_id' => $tournament_id,
						'user_id' => $oTeamsintournament->getPlayerId()
						));
			}
			$oViewer=$this->Viewer_GetLocalViewer();	
			$oViewer->Assign('aMatches',$aMatches);
			if(isset($aUserFields))$oViewer->Assign('aUserFields',$aUserFields);
			if(isset($oUser))$oViewer->Assign('oUser',$oUser);
			$oViewer->Assign('myteam',$myteam);  
			if(isset($oPlayerTournament))$oViewer->Assign('oPlayerTournament',$oPlayerTournament);
			$oBlog=$this->Blog_GetBlogByTournamentId($tournament_id);
			//$oViewer->Assign('link_match',Config::Get('path.root.web')."/".$oBlog->getPlatform()."/".$oBlog->getGame()."/".$oBlog->getGametype()."/".$oBlog->getBlogUrl()."/_match/");
			
			$oViewer->Assign('link_match', $oTournament->getUrlFull()."match/" /*DIR_WEB_ROOT."/turnir/".$oTournament->getUrl()."/_match/"*/);
		
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."day_info.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
		}
					
	}	
	protected function EventTeamInfo() {
		$this -> Viewer_SetResponseAjax ('my');
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('team',null,'post'),'text',1,70))$team=getRequest('team',null,'post');
		if (func_check(getRequest('game_id',null,'post'),'id',1,11))$game_id=getRequest('game_id',null,'post');
		if (func_check(getRequest('gametype_id',null,'post'),'id',1,11))$gametype_id=getRequest('gametype_id',null,'post');
		
	
			
			$sql="select tt.team_id from tis_stat_teamsintournament tt, tis_stat_team t where  tt.tournament_id='".$tournament_id."' and t.team_id=tt.team_id and ( t.name = '".htmlspecialchars($team, ENT_QUOTES)."' or t.brief = '".htmlspecialchars($team, ENT_QUOTES)."')";
			$ids=$this->PluginVs_Stat_GetAll($sql);
			$team_id=$ids[0]['team_id'];
				
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
			
		if($oTournament->getGametypeId()!=3){	
			
			if($game_id!=0 && $gametype_id!=0 && $tournament_id==0){
					
							 
							$oUser=$this->User_GetUserByLogin($team);
							$rating='';
							$psnid='';
							
							$rating='-';
							
							if($oUser)
							if( $oTovarki = $this->PluginVs_Stat_GetTovarkiByFilter(array(
							'game_id' => $game_id,
							'gametype_id' => $gametype_id,
							'user_id' => $oUser->getUserId())) 
								)
							{
								$psnid=$oTovarki->getPsnid();
							}
							
						if($oUser)$aUserFields = $this->User_getUserFieldsValues($oUser->getUserId());
						
						$oViewer=$this->Viewer_GetLocalViewer();	
						 
						if(isset($aUserFields))$oViewer->Assign('aUserFields',$aUserFields);
						if(isset($position))$oViewer->Assign('position',$position);					
						$oViewer->Assign('psnid',$psnid);
						$oViewer->Assign('rating',$rating);
						$oViewer->Assign('Users',1);
						$oViewer->Assign('oUser',$oUser);
						$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."team_info.tpl");
						$this->Viewer_AssignAjax('sText',$sTextResult);
			}
			if( $oTeam = $this->PluginVs_Stat_GetTeamByTeamId($team_id)
				){
					if( $oTeamsintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
						'team_id' => $oTeam->getTeamId(),
						'tournament_id' => $tournament_id,
						'#with'         => array('user1','team','tournament')
						)) )
					{
							$oTournament=$oTeamsintournament->getTournament();
							$oUser=$oTeamsintournament->getUser1();
							$rating='';
							$psnid='';
							if($oUser)
							if( $oRating = $this->PluginVs_Stat_GetRatingByFilter(array(
								'game_id' => $oTournament->getGameId(),
								'gametype_id' => $oTournament->getGametypeId(),
								'user_id' => $oUser->getUserId())) 
								)
							{
								$rating=$oRating->getRating();
								
								if( $oRating_more = $this->PluginVs_Stat_GetRatingItemsByFilter(array(
								'game_id' => $oTournament->getGameId(),
								'gametype_id' => $oTournament->getGametypeId(),
								'rating >' => $rating,
								'#page' => 'count'
								)) 
								)
								{
									$position = $oRating_more['count']+1;
								}
							}
							else{
								$rating='-';
							}
							if($oUser)
							if( $oPlayertournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
							'tournament_id' => $tournament_id,
							'user_id' => $oUser->getUserId())) 
								)
							{
								$psnid=$oPlayertournament->getPsnid();
							}
							
						if($oUser)$aUserFields = $this->User_getUserFieldsValues($oUser->getUserId());
						
						$oViewer=$this->Viewer_GetLocalViewer();	
						$oViewer->Assign('oTeamsintournament',$oTeamsintournament);
						if(isset($aUserFields))$oViewer->Assign('aUserFields',$aUserFields);
						if(isset($position))$oViewer->Assign('position',$position);					
						$oViewer->Assign('psnid',$psnid);
						$oViewer->Assign('rating',$rating);
						$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."team_info.tpl");
						$this->Viewer_AssignAjax('sText',$sTextResult);
					}
				}
		}else{
			//if($oTeam = $this->PluginVs_Stat_GetTeamByTeamId($team_id)){
				$oPlayers = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
								'team_id' => $team_id,
								'tournament_id' => $tournament_id,
								'#with'         => array('user','playercard'),
								'#order'		 => array('cap'=>'desc')
								));
				$oViewer=$this->Viewer_GetLocalViewer();	
				$oViewer->Assign('oPlayers',$oPlayers);
				
				
				$oFutureMatch = $this->PluginVs_Stat_GetMatchesByFilter(array(
								'dates >=' => date("Y-m-d"),
								'played' => '0',
								'tournament_id' => $tournament_id,
								'#where' => array('(away = (?d) or home = (?d) )' => array($team_id, $team_id)),				
								'#with'         => array('hometeam','awayteam')
								));
				$oViewer->Assign('oFutureMatch',$oFutureMatch);
				
				$aLastMatch = $this->PluginVs_Stat_GetMatchesItemsByFilter(array(
								'dates <=' => date("Y-m-d"),
								'played' => '1',
								'tournament_id' => $tournament_id,
								'#where' => array('(away = (?d) or home = (?d) )' => array($team_id, $team_id)),				
								'#with'         => array('hometeam','awayteam','tournament'), 
								'#order' =>array('dates'=>'desc'),
								'#limit' =>array('0','5'),
								));
				$oViewer->Assign('aLastMatch',$aLastMatch);
				
				$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."team_info.tpl");
				$this->Viewer_AssignAjax('sText',$sTextResult);
			//}
		}
	}
	protected function EventTournamentZayavki() {
		if (func_check(getRequest('tournament',null,'post'),'id',1,11))$tournament=getRequest('tournament',null,'post');
		if($tournament)
		if( $aTeamZayvki = $this->PluginVs_Stat_TeamZayavki($tournament)
			)
		{		
		//print_r($aTeamZayvki);
			$oViewer=$this->Viewer_GetLocalViewer();	
			$oViewer->Assign('aTeamZayvki',$aTeamZayvki);
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."spisok_zayavok.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
		} else {
			$this->Message_AddErrorSingle('либо отсутствуют заявки, либо чертовщина',$this->Lang_Get('attention'));
			return;
		}
	}
	protected function EventRaspisanieMonth() {
		$tournament = 0;
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('month',null,'post'),'id',1,2))$month=getRequest('month',null,'post');
		if (func_check(getRequest('year',null,'post'),'id',1,4))$year=getRequest('year',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if(isset($team_id) && $team_id>0){
			$myteam=$team_id;
		}else{
			$myteam=0;
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament);
			
			if ($this->User_IsAuthorization()) {
				$aTeam = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
				'tournament_id' => $tournament,
				'player_id' => $this->oUserCurrent->GetUserId()		
				));		
				if($aTeam){$myteam=$aTeam->getTeamId();}		
			}
			if($myteam==0 && $oTournament && $oTournament->getGametypeId()==3){
				if($aTeam = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
				'tournament_id' => $oTournament->getTournamentId(),
				'user_id' => $this->oUserCurrent->GetUserId()		
				 ))	)
				$myteam=$aTeam->getTeamId();
			}
		}
		if($myteam<>0){
		$oViewer=$this->Viewer_GetLocalViewer();	
		$oViewer->Assign('myteam',$myteam);
		
		//$month=intval(date('n', time()));
		//$year=intval(date('Y', time()));
		if($month>12){$month=1;$year++; }
		if($month<1){$month=12;$year--;}
		
		$aMatches=$this->PluginVs_Stat_MonthMatches($tournament, $myteam, $month);
		
		
		$running_day = date('w',mktime(0,0,0,$month,1,$year));
		$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
		$days_in_this_week = 1;
		$day_counter = 0;
		$dates_array = array();
		if($running_day==0)$running_day=7;
		for($x = 1; $x < $running_day; $x++){
			$dates_array[1][$x]['day']=0;
			$days_in_this_week++;
		}
		$week=1;
	  /* keep going with days.... */
		for($list_day = 1; $list_day <= $days_in_month; $list_day++){
			$x++;
			$dates_array[$week][$x]['day']=$list_day;
			  /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/	
				foreach($aMatches as $oMatch) {
						//if($oMatch['day']==$list_day)$dates_array[$week][$x]['logo']=$oMatch['logo'];
						if($oMatch['day']==$list_day){
							$dates_array[$week][$x]['logo']=$oMatch['logo'];
							$dates_array[$week][$x]['css']=$oMatch['css'];							
							$dates_array[$week][$x]['played']=$oMatch['played'];
							$dates_array[$week][$x]['status']=$oMatch['status'];
							$dates_array[$week][$x]['ot']=$oMatch['ot'];
							$dates_array[$week][$x]['so']=$oMatch['so'];
							$dates_array[$week][$x]['teh']=$oMatch['teh'];
							$dates_array[$week][$x]['goals_home']=$oMatch['goals_home'];
							$dates_array[$week][$x]['goals_away']=$oMatch['goals_away'];
							$dates_array[$week][$x]['g_c']=$oMatch['g_c'];
						}
						
				}	
			if($running_day == 7){
				if(($day_counter+1) != $days_in_month){
					$week++;
				}
				$running_day = 0;
				$days_in_this_week = 0;
			}
			$days_in_this_week++; $running_day++; $day_counter++;
		}

	  /* finish the rest of the days in the week */
	  
	  if($days_in_this_week < 8 && $days_in_this_week<>1){
		for($x = 1; $x <= (8 - $days_in_this_week); $x++){
		  $dates_array[$week][$x]['day']=0;
		}
	  }
	  $oViewer->Assign('dates_array',$dates_array);
	  $oViewer->Assign('tournament_id',$tournament);
	  $oViewer->Assign('month',$month);
	  $oViewer->Assign('year',$year);
	  $sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."widgets/widget.turnirteamrasp.tpl");
	  $this->Viewer_AssignAjax('sText',$sTextResult);
	  
	  }
	}
	
	protected function EventSettingUnknownTeam() {
		
		if (func_check(getRequest('team_name',null,'post'),'text',2,50))$team_name=getRequest('team_name',null,'post');
		if($oTeam = $this->PluginVs_Stat_GetTeamByName($team_name)){
			$this->Viewer_AssignAjax('team_id',$oTeam->getTeamId());
			
			$oViewer=$this->Viewer_GetLocalViewer();	
			$oViewer->Assign('oTeam',$oTeam);
			$sTextResult=$oViewer->Fetch("one_team_zayavka.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
			
		}else{
			$this->Viewer_AssignAjax('team_id',0);
		}
		
	}	
	
	protected function EventAutocompleterTeama() {
		if (!($sValue=getRequest('value',null,'post'))) {
			return ;
		}
		if (func_check(getRequest('sport',null,'get'),'id',1,4))$sport=getRequest('sport',null,'get');
		if (func_check(getRequest('game_type',null,'get'),'id',1,4))$game_type=getRequest('game_type',null,'get');
		$aItems=array();
		if( $aTeams = $this->PluginVs_Stat_GetTeamItemsByFilter(array(
				//'sport_id' => $sport,
				//'gametype_id' => $game_type,
				'#where' => array("name LIKE ?" => array("%".$sValue."%")),
				'status' => 'play'
				))
			)
		{
			foreach ($aTeams as $oTeam) {
				$aItems[]=$oTeam->getName().':'.$oTeam->getSport()->getBrief().':'.$oTeam->getGametype()->getBrief();
			}
			$this->Viewer_AssignAjax('aItems',$aItems);
		}
	}
	
	protected function EventAutocompleterTeamname() {
		if (!($sValue=getRequest('value',null,'post'))) {
			return ;
		}
		if (func_check(getRequest('sport',null,'get'),'id',1,4))$sport=getRequest('sport',null,'get');
		if (func_check(getRequest('game_type',null,'get'),'id',1,4))$game_type=getRequest('game_type',null,'get');
		$aItems=array();
		if( $aTeams = $this->PluginVs_Stat_GetTeamItemsByFilter(array(
				'sport_id' => $sport,
				'gametype_id' => $game_type,
				'#where' => array("name LIKE ?" => array("%".$sValue."%"))			
				))
			)
		{
			foreach ($aTeams as $oTeam) {
				$aItems[]=$oTeam->getName();
			}
			$this->Viewer_AssignAjax('aItems',$aItems);
		}
	}
	protected function EventAutocompleterTeam() {
		if (!($sValue=getRequest('value',null,'post'))) {
			return ;
		}
		$aItems=array();
		if( $aTeams = $this->PluginVs_Stat_GetTeamItemsByFilter(array(
				'gametype_id' => 3,
				'#where' => array("name LIKE ?" => array("%".$sValue."%"))			
				))
			)
		{
			foreach ($aTeams as $oTeam) {
				$aItems[]=$oTeam->getName();
			}
			$this->Viewer_AssignAjax('aItems',$aItems);
		}
	}
	protected function EventAutocompleterPlayercard() {
		if (!($sValue=getRequest('value',null,'post'))) {
			return ;
		}
		$aItems=array();
		if( $aPlayers = $this->PluginVs_Stat_GetPlayercardItemsByFilter(array(
				'#where' => array("(concat(family,' ', name) like ? ) or exists (select 1 from tis_user where user_id=tis_stat_playercard.user_id and user_login like ?)" => array("%".$sValue."%", "%".$sValue."%"))			
				))
			)
		{
			foreach ($aPlayers as $oPlayer) {
				$aItems[]=$oPlayer->getFamily().' '.$oPlayer->getName().'^'.$oPlayer->getUser()->getLogin();
			}
			$this->Viewer_AssignAjax('aItems',$aItems);
		}
	}
	

	
	

	
	
	 
	protected function EventMatchAnul() 	{

		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');
		if (func_check(getRequest('del_preduprezhdenie',null,'post'),'id',1,2))$del_preduprezhdenie=getRequest('del_preduprezhdenie',null,'post');
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		
		if (isTournamentAdmin($oMatch->getTournamentId(),$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {		
			$this->PluginVs_Stat_DeleteStat($match_id);
			
			if( $aMatchResult = $this->PluginVs_Stat_GetMatchresultItemsByFilter(array(
							'match_id' => $match_id 		
							)) 
						)
				{
					foreach($aMatchResult as $oMatchResult){
							$oMatchResult->Delete();
						}
					if( $oRating = $this->PluginVs_Stat_GetRatingByFilter(array(
							'game_id' => $oMatch->getGameId(),
							'gametype_id' => $oMatch->getGametypeId(),
							'user_id' => $oMatch->getHomePlayer())) 
							)
						{
							$oRating->setRating(($oRating->getRating()-$oMatch->getHomeRating()));
							$oRating->Save(); 
						}
					if( $oRating = $this->PluginVs_Stat_GetRatingByFilter(array(
							'game_id' => $oMatch->getGameId(),
							'gametype_id' => $oMatch->getGametypeId(),
							'user_id' => $oMatch->getAwayPlayer())) 
							)
						{
							 $oRating->setRating(($oRating->getRating()-$oMatch->getAwayRating()));
							 $oRating->Save();
						}
						
					$oMatch->setHomeInsert(0);					
					$oMatch->setAwayInsert(0);
					$oMatch->setHomeRating(0);					
					$oMatch->setAwayRating(0);		
					$oMatch->setHomePlayer(0);					
					$oMatch->setAwayPlayer(0);
					$oMatch->setHomeComment('');
					$oMatch->setAwayComment('');
					$oMatch->setOt(0);
					$oMatch->setSo(0);
					$oMatch->setTeh(0);
					$oMatch->setGoalsHome(0);
					$oMatch->setGoalsAway(0);
					$oMatch->setPlayed(0);
					$oMatch->Save();
					if($del_preduprezhdenie==1)
					if($aPenalty = $this->PluginVs_Stat_GetPenaltyItemsByFilter(array(
							'match_id' => $match_id		
							)) 
					){
						foreach($aPenalty as $oPenalty){
							$oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
								'user_id' => $oPenalty->getUserId(),
								'tournament_id'  => $oMatch->getTournamentId() ));
								
							$oPlayerTournament->setPenalties($oPlayerTournament->getPenalties()-1);
							$oPlayerTournament->Save();	
							
							if($oStream = $this->PluginVs_Stat_GetStreamByFilter(array(
								'event_type' => 'teh_penalty',
								'what_id'  => $oPenalty->getId() )))
							{
								$oStream->Delete();
							}
							$oPenalty->Delete();						
						}
					}
					if($oStream = $this->PluginVs_Stat_GetStreamByFilter(array(
								'event_type' => 'match_played',
								'what_id'  => $match_id )) 
					){
						$oStream->Delete();
					}
					
					$this->Message_AddNoticeSingle("Ок","результат удален");
				}else{
					$this->Message_AddErrorSingle('Ошибка','нет внесенного результата этого матча');
				
				}
		}
		
		return;
	}

	
	protected function EventMatchResultDelete() 	{

		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		
		if (isTournamentAdmin($oMatch->getTournamentId(),$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {		
			$this->PluginVs_Stat_DeleteStat($match_id);
			
			if( $oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
							'match_id' => $match_id,
							'team_id' => $team_id			
							)) 
						)
				{
					$oMatchResult->Delete();
					
					
					if($oMatch->getHome()==$team_id){
						$oMatch->setHomeInsert(0);
						//$oMatch->setHomePlayer(0);
					}
					if($oMatch->getAway()==$team_id){
						$oMatch->setAwayInsert(0);
						//$oMatch->setAwayPlayer(0);
					}
					$oMatch->setHomeComment('');
					$oMatch->setAwayComment('');
					$oMatch->setOt(0);
					$oMatch->setSo(0);
					$oMatch->setTeh(0);
					$oMatch->setGoalsHome(0);
					$oMatch->setGoalsAway(0);
					$oMatch->setPlayed(0);
					$oMatch->Save();
					if($aPenalty = $this->PluginVs_Stat_GetPenaltyItemsByFilter(array(
							'match_id' => $match_id		
							)) 
					){
						foreach($aPenalty as $oPenalty){
							$oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
								'user_id' => $oPenalty->getUserId(),
								'tournament_id'  => $oMatch->getTournamentId() ));
								
							$oPlayerTournament->setPenalties($oPlayerTournament->getPenalties()-1);
							$oPlayerTournament->Save();	
							
							if($oStream = $this->PluginVs_Stat_GetStreamByFilter(array(
								'event_type' => 'teh_penalty',
								'what_id'  => $oPenalty->getId() )))
							{
								$oStream->Delete();
							}
							$oPenalty->Delete();						
						}
					}
					if($oStream = $this->PluginVs_Stat_GetStreamByFilter(array(
								'event_type' => 'match_played',
								'what_id'  => $match_id )) 
					){
						$oStream->Delete();
					}
					$this->Message_AddNoticeSingle("Ок","результат удален");
				}else{
					if($oMatch->getHome()==$team_id){
						$oMatch->setHomeInsert(0);
						$oMatch->Save();
						//$oMatch->setHomePlayer(0);
					}
					if($oMatch->getAway()==$team_id){
						$oMatch->setAwayInsert(0);
						$oMatch->Save();
						//$oMatch->setAwayPlayer(0);
					}
					
					$this->Message_AddErrorSingle('Ошибка','нет внесенного результата этой команды');
				
				}
		}
		
		return;
	}
protected function EventMatchResultEdit() 	{
	//$this->Message_AddNoticeSingle("турнирная таблица создана",$this->Lang_Get('attention'));
		//$zhaloba=0;
		$comment="";
		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');
		if (func_check(getRequest('away_goals',null,'post'),'id',1,11))$away_goals=getRequest('away_goals',null,'post');
		if (func_check(getRequest('home_goals',null,'post'),'id',1,11))$home_goals=getRequest('home_goals',null,'post');
		if (func_check(getRequest('ot',null,'post'),'id',1,2))$ot=getRequest('ot',null,'post');
		if (func_check(getRequest('so',null,'post'),'id',1,2))$so=getRequest('so',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');//prava dodelat
		if (func_check(getRequest('zhaloba',null,'post'),'id',1,2))$zhaloba=getRequest('zhaloba',null,'post');
		if (func_check(getRequest('comment',null,'post'),'text',1,3000))$comment=getRequest('comment',null,'post');
		if (func_check(getRequest('yard',null,'post'),'id',1,11))$yard=getRequest('yard',null,'post');
		
		$good=1;
		if($ot!=0 && $so!=0)$good=0;
		if(($ot!=0 || $so!=0) && abs($away_goals-$home_goals)!=1)$good=0;
		
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		
		if (isTournamentAdmin($oMatch->getTournamentId(),$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) 
		{	
			if( (!$oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
						'match_id' => $match_id,
						'team_id' => $team_id			
						))) && $good==1
					)
			{
			$user_id=$this->oUserCurrent->GetUserId();
			if( $oTeamintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
						'team_id' => $team_id,
						'tournament_id' => $oMatch->getTournamentId()			
						))
			)$user_id=$oTeamintournament->getPlayerId();
				
				$oMatchResult_add =  Engine::GetEntity('PluginVs_Stat_Matchresult');
				$oMatchResult_add->setMatchId($match_id);
				$oMatchResult_add->setUserId($user_id);
				$oMatchResult_add->setTeamId($team_id);
				$oMatchResult_add->setAway($away_goals);
				$oMatchResult_add->setHome($home_goals);
				$oMatchResult_add->setComment($this->Text_Parser($comment)); 
				$oMatchResult_add->setDates(date("Y-m-d H:i:s"));
				if(isset($ot))$oMatchResult_add->setOt($ot);
				if(isset($so))$oMatchResult_add->setSo($so);
				if(isset($zhaloba))$oMatchResult_add->setZhaloba($zhaloba);
				$oMatchResult_add->Add();
				
				$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
				if($oMatch->getHome()==$team_id){
					$oMatch->setHomeInsert(1);
					$oMatch->setHomeYard($yard);
					$oMatch->Save();
				}
				if($oMatch->getAway()==$team_id){
					$oMatch->setAwayInsert(1);
					$oMatch->setAwayYard($yard);
					$oMatch->Save();
				}
				$this->PluginVs_Stat_CheckResult($match_id);
				$this->Message_AddNoticeSingle("Ок","результат внесен");
			}elseif(($oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
						'match_id' => $match_id,
						'team_id' => $team_id			
						))) && $good==1 ){
				$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
				if($oMatch->getPlayed()==0){
				//echo $oMatchResult;
					$oMatchResult->setAway($away_goals);
					$oMatchResult->setHome($home_goals);
					$oMatchResult->setComment($this->Text_Parser($comment));
					if(isset($ot))$oMatchResult->setOt($ot);
					if(isset($so))$oMatchResult->setSo($so);
					$oMatchResult->Save();
					
					if($oMatch->getHome()==$team_id){ 
						$oMatch->setHomeYard($yard);
						$oMatch->Save();
					}
					if($oMatch->getAway()==$team_id){ 
						$oMatch->setAwayYard($yard);
						$oMatch->Save();
					}
				
					$this->PluginVs_Stat_CheckResult($match_id);
				}else{
					$this->PluginVs_Stat_DeleteStat($match_id);
					
					$oMatch->setHomeComment('');
					$oMatch->setAwayComment('');
					$oMatch->setOt(0);
					$oMatch->setSo(0);
					$oMatch->setGoalsHome(0);
					$oMatch->setGoalsAway(0);
					$oMatch->setPlayed(0);
					
					if($oMatch->getHome()==$team_id){ 
						$oMatch->setHomeYard($yard); 
					}
					if($oMatch->getAway()==$team_id){ 
						$oMatch->setAwayYard($yard); 
					}
					
					$oMatch->Save();
					
					$oMatchResult->setAway($away_goals);
					$oMatchResult->setHome($home_goals);
					$oMatchResult->setComment($this->Text_Parser($comment));
					if(isset($ot))$oMatchResult->setOt($ot);
					if(isset($so))$oMatchResult->setSo($so);
					$oMatchResult->Save();
					
					$this->PluginVs_Stat_CheckResult($match_id);
				}
				$this->Message_AddNoticeSingle("Ок","результат внесен");
			}else{
				$this->Message_AddErrorSingle('Ошибка','Что-то вы намудрили с результатом');
			
			}
		}
		
		return;
	}
	protected function EventMatchAnulMassovo() 	{
		
		$tournament_id = 0;
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,3))$tournament_id=getRequest('tournament_id',null,'post');
		
		
		$sql="SELECT m.match_id, 
		CASE WHEN t.away_w =1
		THEN m.home
		ELSE m.away
		END AS team, 
		CASE WHEN (
		t.away_w + t.home_w
		) >0
		THEN  'tehl'
		ELSE  'tehn'
		END AS TEXT, t.num
		FROM teh t, tis_stat_matches m
		WHERE m.number = t.num
		AND m.tournament_id ='".$tournament_id."'
		AND m.played =1
		AND teh =1
		ORDER BY t.num";
		$aMatches=$this->PluginVs_Stat_GetAll($sql);
		foreach($aMatches as $Match){			
			
			$match_id = $Match['match_id'];
			
			$del_preduprezhdenie=1;
			$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
			
			if (isTournamentAdmin($oMatch->getTournamentId(),$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {		
				$this->PluginVs_Stat_DeleteStat($match_id);
				
				if( $aMatchResult = $this->PluginVs_Stat_GetMatchresultItemsByFilter(array(
								'match_id' => $match_id 		
								)) 
							)
					{
						foreach($aMatchResult as $oMatchResult){
								$oMatchResult->Delete();
							}
						if( $oRating = $this->PluginVs_Stat_GetRatingByFilter(array(
								'game_id' => $oMatch->getGameId(),
								'gametype_id' => $oMatch->getGametypeId(),
								'user_id' => $oMatch->getHomePlayer())) 
								)
							{
								$oRating->setRating(($oRating->getRating()-$oMatch->getHomeRating()));
								$oRating->Save(); 
							}
						if( $oRating = $this->PluginVs_Stat_GetRatingByFilter(array(
								'game_id' => $oMatch->getGameId(),
								'gametype_id' => $oMatch->getGametypeId(),
								'user_id' => $oMatch->getAwayPlayer())) 
								)
							{
								 $oRating->setRating(($oRating->getRating()-$oMatch->getAwayRating()));
								 $oRating->Save();
							}
							
						$oMatch->setHomeInsert(0);					
						$oMatch->setAwayInsert(0);
						$oMatch->setHomeRating(0);					
						$oMatch->setAwayRating(0);		
						$oMatch->setHomePlayer(0);					
						$oMatch->setAwayPlayer(0);
						$oMatch->setHomeComment('');
						$oMatch->setAwayComment('');
						$oMatch->setOt(0);
						$oMatch->setSo(0);
						$oMatch->setTeh(0);
						$oMatch->setGoalsHome(0);
						$oMatch->setGoalsAway(0);
						$oMatch->setPlayed(0);
						$oMatch->Save();
						if($del_preduprezhdenie==1)
						if($aPenalty = $this->PluginVs_Stat_GetPenaltyItemsByFilter(array(
								'match_id' => $match_id		
								)) 
						){
							foreach($aPenalty as $oPenalty){
								$oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
									'user_id' => $oPenalty->getUserId(),
									'tournament_id'  => $oMatch->getTournamentId() ));
									
								$oPlayerTournament->setPenalties($oPlayerTournament->getPenalties()-1);
								$oPlayerTournament->Save();	
								
								if($oStream = $this->PluginVs_Stat_GetStreamByFilter(array(
									'event_type' => 'teh_penalty',
									'what_id'  => $oPenalty->getId() )))
								{
									$oStream->Delete();
								}
								$oPenalty->Delete();						
							}
						}
						if($oStream = $this->PluginVs_Stat_GetStreamByFilter(array(
									'event_type' => 'match_played',
									'what_id'  => $match_id )) 
						){
							$oStream->Delete();
						}
						
						$this->Message_AddNoticeSingle("Ок","результат удален");
					}else{
						$this->Message_AddErrorSingle('Ошибка','нет внесенного результата этого матча');
					
					}
			}
		}
		return;
	}
	
	protected function EventMatchTehMassovo() 	{
		$tournament_id = 0;
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,3))$tournament_id=getRequest('tournament_id',null,'post');
		$sql="select m.match_id,
			case when t.away_w=1 then m.home else m.away end as team,
			case when (t.away_w+t.home_w)>0 then 'tehl' else 'tehn' end as text,
			t.num
			from teh t, tis_stat_matches m
			where m.number=t.num
			and m.tournament_id='".$tournament_id."'
			and m.played=0
			order by t.num";
		$aMatches=$this->PluginVs_Stat_GetAll($sql);
		foreach($aMatches as $Match){			
			
			$match_id = $Match['match_id'];
			$team_id = $Match['team'];
			$texts = $Match['text'];
			
			$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());
			if (isTournamentAdmin($oMatch->getTournamentId(),$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) 
			{
				if($oMatch->getAway()==$team_id){
					if($texts=='tehl'){$away_goals=$oTournament->getGoalsTehL();}else{$away_goals=$oTournament->getGoalsTehN();}
					if($texts=='tehl'){$home_goals=$oTournament->getGoalsTehW();}else{$home_goals=$oTournament->getGoalsTehN();}
					if($texts=='tehl'){$home_comment='техническая победа';}else{$home_comment='техническая ничья';}
					if($texts=='tehl'){$away_comment='техническое поражение';}else{$away_comment='техническая ничья';}
				}
				if($oMatch->getHome()==$team_id){
					if($texts=='tehl'){$home_goals=$oTournament->getGoalsTehL();}else{$home_goals=$oTournament->getGoalsTehN();}
					if($texts=='tehl'){$away_goals=$oTournament->getGoalsTehW();}else{$away_goals=$oTournament->getGoalsTehN();}
					if($texts=='tehl'){$away_comment='техническая победа';}else{$away_comment='техническая ничья';}
					if($texts=='tehl'){$home_comment='техническое поражение';}else{$home_comment='техническая ничья';}
				}
				$user_id=$this->oUserCurrent->GetUserId();
				if( $oTeamintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'team_id' => $oMatch->getAway(),
							'tournament_id' => $oMatch->getTournamentId()			
							))
					){				
						$user_id=$oTeamintournament->getPlayerId();
						if($user_id!=0 && ($oMatch->getAway()==$team_id || $texts=='tehn')){
							$oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
							'user_id' => $user_id,
							'tournament_id'  => $oMatch->getTournamentId() ));
							$oPlayerTournament->setPenalties($oPlayerTournament->getPenalties()+1);
							$oPlayerTournament->Save();
							
							$oPenalty_add =  Engine::GetEntity('PluginVs_Stat_Penalty');
							$oPenalty_add->setUserId($user_id);
							$oPenalty_add->setTournamentId($oMatch->getTournamentId());
							$oPenalty_add->setMatchId($oMatch->getMatchId());
							$oPenalty_add->setWhy('');
							$oPenalty_add->Add();	
							
							$oPenalty = $this->PluginVs_Stat_GetPenaltyByFilter(array(
								'match_id' => $match_id,
								'user_id'=> $user_id
								));
								
							$oEvent =  Engine::GetEntity('PluginVs_Stat_Stream');
							$oEvent->setEventType('teh_penalty');
							$oEvent->setWhatId($oPenalty->getId());
							$oEvent->setTournamentId($oMatch->getTournamentId());
							$oEvent->setDateAdd(date("Y-m-d H:i:s"));
							$oEvent->Add();
							
						}
					}
					
				if( !$oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
						'match_id' => $match_id,
						'team_id' => $oMatch->getAway()			
						)) 
					)
				{
					$oMatchResult_add =  Engine::GetEntity('PluginVs_Stat_Matchresult');
					$oMatchResult_add->setMatchId($match_id);
					$oMatchResult_add->setUserId($user_id);
					$oMatchResult_add->setTeamId($oMatch->getAway());
					$oMatchResult_add->setAway($away_goals);
					$oMatchResult_add->setHome($home_goals);
					$oMatchResult_add->setComment($away_comment);
					$oMatchResult_add->setDates(date("Y-m-d H:i:s"));
					$oMatchResult_add->Add();
				}else{				
					$oMatchResult->setUserId($user_id);
					$oMatchResult->setAway($away_goals);
					$oMatchResult->setHome($home_goals);
					$oMatchResult->setComment($away_comment);
					$oMatchResult->setDates(date("Y-m-d H:i:s"));
					$oMatchResult->Save();			
				}
				
				$user_id=$this->oUserCurrent->GetUserId();
				if($oTeamintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'team_id' => $oMatch->getHome(),
							'tournament_id' => $oMatch->getTournamentId()			
							))
					){				
						$user_id=$oTeamintournament->getPlayerId();
						
						if($user_id!=0 && ($oMatch->getHome()==$team_id || $texts=='tehn')){
							$oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
								'user_id' => $user_id,
								'tournament_id'  => $oMatch->getTournamentId() ));
							$oPlayerTournament->setPenalties($oPlayerTournament->getPenalties()+1);
							$oPlayerTournament->Save();
							
							$oPenalty_add =  Engine::GetEntity('PluginVs_Stat_Penalty');
							$oPenalty_add->setUserId($user_id);
							$oPenalty_add->setTournamentId($oMatch->getTournamentId());
							$oPenalty_add->setMatchId($oMatch->getMatchId());
							$oPenalty_add->setWhy('');
							$oPenalty_add->Add();

							$oPenalty = $this->PluginVs_Stat_GetPenaltyByFilter(array(
								'match_id' => $match_id,
								'user_id'=> $user_id
								));
								
							$oEvent =  Engine::GetEntity('PluginVs_Stat_Stream');
							$oEvent->setEventType('teh_penalty');
							$oEvent->setWhatId($oPenalty->getId());
							$oEvent->setTournamentId($oMatch->getTournamentId());
							$oEvent->setDateAdd(date("Y-m-d H:i:s"));
							$oEvent->Add();
				
						}
					}
					
				if( !$oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
						'match_id' => $match_id,
						'team_id' => $oMatch->getHome()			
						)) 
					)
				{
					$oMatchResult_add =  Engine::GetEntity('PluginVs_Stat_Matchresult');
					$oMatchResult_add->setMatchId($match_id);
					$oMatchResult_add->setUserId($user_id);
					$oMatchResult_add->setTeamId($oMatch->getHome());
					$oMatchResult_add->setAway($away_goals);
					$oMatchResult_add->setHome($home_goals);
					$oMatchResult_add->setComment($home_comment);
					$oMatchResult_add->setDates(date("Y-m-d H:i:s"));
					$oMatchResult_add->Add();
				}else{				
					$oMatchResult->setUserId($user_id);
					$oMatchResult->setAway($away_goals);
					$oMatchResult->setHome($home_goals);
					$oMatchResult->setComment($home_comment);
					$oMatchResult->setDates(date("Y-m-d H:i:s"));
					$oMatchResult->Save();			
				}
				$oMatch->setAwayInsert(1);
				$oMatch->setHomeInsert(1);
				$oMatch->setTeh(1);
				$oMatch->Save();
				$this->PluginVs_Stat_CheckResult($match_id);
				
								
				$this->Message_AddNoticeSingle("Ок","результат внесен");
			}else{
				$this->Message_AddErrorSingle('Ошибка','вы не админ');
				
			}
		}
	}
	
	protected function EventMatchTeh() 	{
		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if (func_check(getRequest('texts',null,'post'),'text',1,11))$texts=getRequest('texts',null,'post');
		
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());
		if (isTournamentAdmin($oMatch->getTournamentId(),$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) 
		{
			if($oMatch->getAway()==$team_id){
				if($texts=='tehl'){$away_goals=$oTournament->getGoalsTehL();}else{$away_goals=$oTournament->getGoalsTehN();}
				if($texts=='tehl'){$home_goals=$oTournament->getGoalsTehW();}else{$home_goals=$oTournament->getGoalsTehN();}
				if($texts=='tehl'){$home_comment='техническая победа';}else{$home_comment='техническая ничья';}
				if($texts=='tehl'){$away_comment='техническое поражение';}else{$away_comment='техническая ничья';}
			}
			if($oMatch->getHome()==$team_id){
				if($texts=='tehl'){$home_goals=$oTournament->getGoalsTehL();}else{$home_goals=$oTournament->getGoalsTehN();}
				if($texts=='tehl'){$away_goals=$oTournament->getGoalsTehW();}else{$away_goals=$oTournament->getGoalsTehN();}
				if($texts=='tehl'){$away_comment='техническая победа';}else{$away_comment='техническая ничья';}
				if($texts=='tehl'){$home_comment='техническое поражение';}else{$home_comment='техническая ничья';}
			}
			$user_id=$this->oUserCurrent->GetUserId();
			if( $oTeamintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
						'team_id' => $oMatch->getAway(),
						'tournament_id' => $oMatch->getTournamentId()			
						))
				){				
					$user_id=$oTeamintournament->getPlayerId();
					if($user_id!=0 && ($oMatch->getAway()==$team_id || $texts=='tehn')){
						$oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
						'user_id' => $user_id,
						'tournament_id'  => $oMatch->getTournamentId() ));
						$oPlayerTournament->setPenalties($oPlayerTournament->getPenalties()+1);
						$oPlayerTournament->Save();
						
						$oPenalty_add =  Engine::GetEntity('PluginVs_Stat_Penalty');
						$oPenalty_add->setUserId($user_id);
						$oPenalty_add->setTournamentId($oMatch->getTournamentId());
						$oPenalty_add->setMatchId($oMatch->getMatchId());
						$oPenalty_add->setWhy('');
						$oPenalty_add->Add();	
						
						$oPenalty = $this->PluginVs_Stat_GetPenaltyByFilter(array(
							'match_id' => $match_id,
							'user_id'=> $user_id
							));
							
						$oEvent =  Engine::GetEntity('PluginVs_Stat_Stream');
						$oEvent->setEventType('teh_penalty');
						$oEvent->setWhatId($oPenalty->getId());
						$oEvent->setTournamentId($oMatch->getTournamentId());
						$oEvent->setDateAdd(date("Y-m-d H:i:s"));
						$oEvent->Add();
						
					}
				}
				
			if( !$oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
					'match_id' => $match_id,
					'team_id' => $oMatch->getAway()			
					)) 
				)
			{
				$oMatchResult_add =  Engine::GetEntity('PluginVs_Stat_Matchresult');
				$oMatchResult_add->setMatchId($match_id);
				$oMatchResult_add->setUserId($user_id);
				$oMatchResult_add->setTeamId($oMatch->getAway());
				$oMatchResult_add->setAway($away_goals);
				$oMatchResult_add->setHome($home_goals);
				$oMatchResult_add->setComment($away_comment);
				$oMatchResult_add->setDates(date("Y-m-d H:i:s"));
				$oMatchResult_add->Add();
			}else{				
				$oMatchResult->setUserId($user_id);
				$oMatchResult->setAway($away_goals);
				$oMatchResult->setHome($home_goals);
				$oMatchResult->setComment($away_comment);
				$oMatchResult->setDates(date("Y-m-d H:i:s"));
				$oMatchResult->Save();			
			}
			
			$user_id=$this->oUserCurrent->GetUserId();
			if($oTeamintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
						'team_id' => $oMatch->getHome(),
						'tournament_id' => $oMatch->getTournamentId()			
						))
				){				
					$user_id=$oTeamintournament->getPlayerId();
					
					if($user_id!=0 && ($oMatch->getHome()==$team_id || $texts=='tehn')){
						$oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
							'user_id' => $user_id,
							'tournament_id'  => $oMatch->getTournamentId() ));
						$oPlayerTournament->setPenalties($oPlayerTournament->getPenalties()+1);
						$oPlayerTournament->Save();
						
						$oPenalty_add =  Engine::GetEntity('PluginVs_Stat_Penalty');
						$oPenalty_add->setUserId($user_id);
						$oPenalty_add->setTournamentId($oMatch->getTournamentId());
						$oPenalty_add->setMatchId($oMatch->getMatchId());
						$oPenalty_add->setWhy('');
						$oPenalty_add->Add();

						$oPenalty = $this->PluginVs_Stat_GetPenaltyByFilter(array(
							'match_id' => $match_id,
							'user_id'=> $user_id
							));
							
						$oEvent =  Engine::GetEntity('PluginVs_Stat_Stream');
						$oEvent->setEventType('teh_penalty');
						$oEvent->setWhatId($oPenalty->getId());
						$oEvent->setTournamentId($oMatch->getTournamentId());
						$oEvent->setDateAdd(date("Y-m-d H:i:s"));
						$oEvent->Add();
			
					}
				}
				
			if( !$oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
					'match_id' => $match_id,
					'team_id' => $oMatch->getHome()			
					)) 
				)
			{
				$oMatchResult_add =  Engine::GetEntity('PluginVs_Stat_Matchresult');
				$oMatchResult_add->setMatchId($match_id);
				$oMatchResult_add->setUserId($user_id);
				$oMatchResult_add->setTeamId($oMatch->getHome());
				$oMatchResult_add->setAway($away_goals);
				$oMatchResult_add->setHome($home_goals);
				$oMatchResult_add->setComment($home_comment);
				$oMatchResult_add->setDates(date("Y-m-d H:i:s"));
				$oMatchResult_add->Add();
			}else{				
				$oMatchResult->setUserId($user_id);
				$oMatchResult->setAway($away_goals);
				$oMatchResult->setHome($home_goals);
				$oMatchResult->setComment($home_comment);
				$oMatchResult->setDates(date("Y-m-d H:i:s"));
				$oMatchResult->Save();			
			}
			$oMatch->setAwayInsert(1);
			$oMatch->setHomeInsert(1);
			$oMatch->setTeh(1);
			$oMatch->Save();
			$this->PluginVs_Stat_CheckResult($match_id);
			
							
			$this->Message_AddNoticeSingle("Ок","результат внесен");
		}else{
			$this->Message_AddErrorSingle('Ошибка','вы не админ');
			
		}
	}
	protected function EventMatchResultSet() 	{
	//$this->Message_AddNoticeSingle("турнирная таблица создана",$this->Lang_Get('attention'));
		//$zhaloba=0;
		$comment="";
		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');
		if (func_check(getRequest('away_goals',null,'post'),'id',1,11))$away_goals=getRequest('away_goals',null,'post');
		if (func_check(getRequest('home_goals',null,'post'),'id',1,11))$home_goals=getRequest('home_goals',null,'post');
		if (func_check(getRequest('ot',null,'post'),'id',1,2))$ot=getRequest('ot',null,'post');
		if (func_check(getRequest('so',null,'post'),'id',1,2))$so=getRequest('so',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');//prava dodelat
		if (func_check(getRequest('user_id',null,'post'),'id',1,11))$user_id=getRequest('user_id',null,'post');
		if (func_check(getRequest('zhaloba',null,'post'),'id',1,2))$zhaloba=getRequest('zhaloba',null,'post');
		if (func_check(getRequest('comment',null,'post'),'text',1,3000))$comment=getRequest('comment',null,'post');
		
		if (func_check(getRequest('yard',null,'post'),'id',1,11))$yard=getRequest('yard',null,'post');
		
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		
		$good=1;
		if($ot!=0 && $so!=0)$good=0;
		if(($ot!=0 || $so!=0) && abs($away_goals-$home_goals)!=1)$good=0;
		If( $oMatch->getMiniturnirId()!=0 && abs($away_goals-$home_goals)==0)$good=2;
/*		
		if( $oTeamintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
						'team_id' => $team_id,
						'player_id' => $this->oUserCurrent->GetUserId()			
						)) 
					)
		{
*/			if($good==1){
				if( !$oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
							'match_id' => $match_id,
							'user_id' => $this->oUserCurrent->GetUserId()			
							))  
						)
				{
					$oMatchResult_add =  Engine::GetEntity('PluginVs_Stat_Matchresult');
					$oMatchResult_add->setMatchId($match_id);
					$oMatchResult_add->setUserId($this->oUserCurrent->GetUserId());
					$oMatchResult_add->setTeamId($team_id);
					$oMatchResult_add->setAway($away_goals);
					$oMatchResult_add->setHome($home_goals);
					$oMatchResult_add->setComment($this->Text_Parser($comment));
					$oMatchResult_add->setDates(date("Y-m-d H:i:s"));
					if(isset($ot))$oMatchResult_add->setOt($ot);
					if(isset($so))$oMatchResult_add->setSo($so);
					if(isset($zhaloba))$oMatchResult_add->setHome($zhaloba);
					$oMatchResult_add->Add();
					
					
					if($team_id!=0){
						if($oMatch->getHome()==$team_id){
							$oMatch->setHomeInsert(1);
							$oMatch->setHomeYard($yard);
							$oMatch->Save();
						}
						if($oMatch->getAway()==$team_id){
							$oMatch->setAwayInsert(1);
							$oMatch->setAwayYard($yard);
							$oMatch->Save();
						}
					}elseif($user_id!=0){
						if($oMatch->getHomePlayer()==$user_id){
							$oMatch->setHomeInsert(1);
							$oMatch->setHomeYard($yard);
							$oMatch->Save();
						}
						if($oMatch->getAwayPlayer()==$user_id){
							$oMatch->setAwayInsert(1);
							$oMatch->setAwayYard($yard);
							$oMatch->Save();
						}
					
					}
					$this->PluginVs_Stat_CheckResult($match_id);
					
					$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
					
					$this->Viewer_AssignAjax('test',0);
					$this->Viewer_AssignAjax('getMiniturnirId',$oMatch->getMiniturnirId());
					$this->Viewer_AssignAjax('getPlayed',$oMatch->getPlayed());
					$this->Viewer_AssignAjax('absg',abs($away_goals-$home_goals)); 
					$this->Viewer_AssignAjax('good',$good); 
		 
					
					if($oMatch->getMiniturnirId()!=0 && $oMatch->getPlayed()==1){
						$this->CheckMiniTurnir($match_id);
						$this->Viewer_AssignAjax('checkminiturnir',1);
					}
					$this->Message_AddNoticeSingle("Ок","результат внесен");
				}else{
					 $this->Message_AddErrorSingle('Ошибка','вы уже внесли результат данного матча');
					
				}
			}else{
				if($good==0)$this->Message_AddErrorSingle('Что-то не сходится в счете, либо разница мячей большая для ОТ, толи ещё что-то','Ошибка');
				if($good==2)$this->Message_AddErrorSingle('В матчах на деньги не бывает ничейного результата','Ошибка');
			
			}
	/*	} */
		return;
	}

	protected function EventMatchLookup() 	{
		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');
		
		$oMatch=$this->PluginVs_Stat_GetMatchesByFilter(array(
				'match_id' => $match_id,	
				'#with'         => array('hometeam','awayteam')
				));
				
		if (isTournamentAdmin($oMatch->getTournamentId(),$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {		
		
			$aMatchtime=$this->PluginVs_Stat_GetMatchtimeItemsByFilter(array(
				'match_id' => $match_id,
				'#with'         => array('user1','user2')
			));
			$oViewer=$this->Viewer_GetLocalViewer();
			$oViewer->Assign('oMatch',$oMatch);
			$oViewer->Assign('aMatchtime',$aMatchtime);
			$oViewer->Assign('oUser',$this->oUserCurrent);
			
			
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."match_lookup.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
				
		}
	}
	
	protected function EventMatchOtchet() 	{
		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');

		if($oMatch = $this->PluginVs_Stat_GetMatchesByFilter(array(
						'match_id' => $match_id,
						'#with'         => array('awayuser','homeuser','hometeam','awayteam'),
						)))
		{
			$oViewer=$this->Viewer_GetLocalViewer();	

			$oViewer->Assign('oMatch',$oMatch);
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."match_otchet.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
		}			

	}
	
	protected function EventMatchResultGet() 	{
		$team_id=0;
		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if ($this->User_IsAuthorization()) {

			
			if( $oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
						'match_id' => $match_id,
						'user_id !=' => $this->oUserCurrent->GetUserId() 
						))
					)
				{					
					$this->Viewer_AssignAjax('away',$oMatchResult->getAway());
					$this->Viewer_AssignAjax('home',$oMatchResult->getHome());
					$this->Viewer_AssignAjax('ot',$oMatchResult->getOt());
					$this->Viewer_AssignAjax('so',$oMatchResult->getSo());
					$this->Viewer_AssignAjax('comment',$oMatchResult->getComment());
					
				
					
					$this->Viewer_AssignAjax('yess',1);
				}
		}
			$oMatch = $this->PluginVs_Stat_GetMatchesByFilter(array(
						'match_id' => $match_id, 
						'#with'         => array('hometeam','awayteam','homeuser','awayuser')
						));	
			if($oMatch->getTournamentId()!=0){
				$this->Viewer_AssignAjax('home_team',$oMatch->getHometeam()->getName());
				$this->Viewer_AssignAjax('away_team',$oMatch->getAwayteam()->getName());
				
				$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());	 
				$this->Viewer_AssignAjax('exist_o',$oTournament->getExistO());
				$this->Viewer_AssignAjax('exist_b',$oTournament->getExistB());
				$this->Viewer_AssignAjax('exist_yard',$oTournament->getExistYard());
			}else{
				$this->Viewer_AssignAjax('home_user',$oMatch->getHomeuser()->getLogin());
				$this->Viewer_AssignAjax('away_user',$oMatch->getAwayuser()->getLogin());
				$this->Viewer_AssignAjax('exist_o',1);
				$this->Viewer_AssignAjax('exist_b',1);
				$this->Viewer_AssignAjax('exist_yard',0);
			}
			
			
			/*
			if($oMatch->getGametypeId()==3){
				$oViewer=$this->Viewer_GetLocalViewer();	

				$oViewer->Assign('oMatch',$oMatch);
				
				$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());				
				$oPlayercard=$this->PluginVs_Stat_GetPlayercardByFilter(array(
							'user_id' => $this->oUserCurrent->GetUserId(),
							'sport_id' => $oTournament->getGame()->getSportId(),
							'platform_id' => $oTournament->getGame()->getPlatformId()							
						));

				if($oPlayertournament=$this->PluginVs_Stat_GetPlayertournamentByFilter(array(
							'playercard_id' => $oPlayercard->getPlayercardId(), 
							'tournament_id' => $oTournament->getTournamentId(),
							'cap in' => array('1','2')
						)) )
				{
					$sql="select playercard_id from tis_stat_playertournament where tournament_id='".$oMatch->getTournamentId()."' and team_id = '".$oPlayertournament->getTeamId()."'";
					$aPlayers=$this->PluginVs_Stat_GetAll($sql);
					$players=array();
					if($aPlayers){
						foreach($aPlayers as $oPlayers){
							$players[]=$oPlayers['playercard_id'];
						}
						$aPlayercards=$this->PluginVs_Stat_GetPlayercardItemsByFilter(array(
							'playercard_id in' => $players,
							'#with'         => array('user')	
						));
						$oViewer->Assign('aPlayercards',$aPlayercards);
					}	
					
					$oViewer->Assign('positions',Config::Get('plugin.vs.teamplay_nhl')); 
					
					$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."match_teamplay_hockey.tpl");
					$this->Viewer_AssignAjax('Teamplay',$sTextResult);
					
				}else{
					$this->Viewer_AssignAjax('Teamplay','');	
				}
			
				
			}*/
		//$this->Message_AddErrorSingle('делаем','не трогайте');
		return;
	}

	protected function EventMatchResultGetTeamplay() 	{
		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');

		if ($this->User_IsAuthorization()) {

			
			if( $oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
						'match_id' => $match_id,
						'user_id !=' => $this->oUserCurrent->GetUserId() 
						))
					)
				{					
					$this->Viewer_AssignAjax('away',$oMatchResult->getAway());
					$this->Viewer_AssignAjax('home',$oMatchResult->getHome());
					$this->Viewer_AssignAjax('ot',$oMatchResult->getOt());
					$this->Viewer_AssignAjax('so',$oMatchResult->getSo());
					$this->Viewer_AssignAjax('comment',$oMatchResult->getComment());
					
				
					
					$this->Viewer_AssignAjax('yess',1);
				}
		}
			$oMatch = $this->PluginVs_Stat_GetMatchesByFilter(array(
						'match_id' => $match_id, 
						'#with'         => array('hometeam','awayteam','homeuser','awayuser')
						));	
			if($oMatch->getTournamentId()!=0){
				$this->Viewer_AssignAjax('home_team',$oMatch->getHometeam()->getName());
				$this->Viewer_AssignAjax('away_team',$oMatch->getAwayteam()->getName());
			}else{
				$this->Viewer_AssignAjax('home_user',$oMatch->getHomeuser()->getLogin());
				$this->Viewer_AssignAjax('away_user',$oMatch->getAwayuser()->getLogin());
			}
			
		//$this->Message_AddErrorSingle('делаем','не трогайте');
		return;
	}
	
	
	
	
		protected function EventMatchResultGetAdmin() 	{
		$team_id=0;
		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if ($this->User_IsAuthorization()) {

			$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
			
			if( $oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
						'match_id' => $match_id,
						'team_id !=' => $team_id,
						'#with'         => array('hometeam','awayteam')
						
						))
					)
				{					
					$this->Viewer_AssignAjax('away',$oMatchResult->getAway());
					$this->Viewer_AssignAjax('home',$oMatchResult->getHome());
					$this->Viewer_AssignAjax('ot',$oMatchResult->getOt());
					$this->Viewer_AssignAjax('so',$oMatchResult->getSo());
					$this->Viewer_AssignAjax('comment',$oMatchResult->getComment());
					$this->Viewer_AssignAjax('yess',1);
				}
				
			if( $oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
						'match_id' => $match_id,
						'team_id' => $team_id,
						'#with'         => array('hometeam','awayteam')		
						))
					)
				{					
					$this->Viewer_AssignAjax('team_away',$oMatchResult->getAway());
					$this->Viewer_AssignAjax('team_home',$oMatchResult->getHome());
					$this->Viewer_AssignAjax('team_ot',$oMatchResult->getOt());
					$this->Viewer_AssignAjax('team_so',$oMatchResult->getSo());
					$this->Viewer_AssignAjax('team_comment',$oMatchResult->getComment());
					$this->Viewer_AssignAjax('team_yess',1);
				}

		}
			$oMatch = $this->PluginVs_Stat_GetMatchesByFilter(array(
						'match_id' => $match_id, 
						'#with'         => array('hometeam','awayteam')
						));	
			$this->Viewer_AssignAjax('home_team',$oMatch->getHometeam()->getName());
			$this->Viewer_AssignAjax('away_team',$oMatch->getAwayteam()->getName());
			
			if($oMatch->getHome()==$team_id)$this->Viewer_AssignAjax('yard',$oMatch->getHomeYard());
			if($oMatch->getAway()==$team_id)$this->Viewer_AssignAjax('yard',$oMatch->getAwayYard());
			
			if($oMatch->getTournamentId()!=0){ 
				$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());	 
				$this->Viewer_AssignAjax('exist_o',$oTournament->getExistO());
				$this->Viewer_AssignAjax('exist_b',$oTournament->getExistB());
				$this->Viewer_AssignAjax('exist_yard',$oTournament->getExistYard());
			}else{ 
				$this->Viewer_AssignAjax('exist_o',1);
				$this->Viewer_AssignAjax('exist_b',1);
				$this->Viewer_AssignAjax('exist_yard',0);
			}
			
		//$this->Message_AddErrorSingle('делаем','не трогайте');
		return;
	}
	
	protected function EventSetteams() 	{
	if (func_check(getRequest('tournament',null,'post'),'id',1,3))$tournament_id=getRequest('tournament',null,'post');
	if (func_check(getRequest('league',null,'post'),'id',1,4))$league=getRequest('league',null,'post');
/*
insert `tis_stat_teamsintournament` 
select 9, 0, team_id, parentgroup_id, group_id,0
FROM `tis_stat_realleagueteams`
where league_id=8
*/	
	if( $aTeams = $this->PluginVs_Stat_GetRealleagueteamsItemsByFilter(array(
					'league_id ' => $league
				))
			)
		{
			foreach($aTeams as $oTeams){
				$oTeam_add =  Engine::GetEntity('PluginVs_Stat_Teamsintournament');
				$oTeam_add->setTeamId($oTeams->getTeamId());
				$oTeam_add->setParentgroupId($oTeams->getParentgroupId());
				$oTeam_add->setGroupId($oTeams->getGroupId());
				$oTeam_add->setTournamentId($tournament_id);
				$oTeam_add->Add();
				
			}
			$this->Message_AddNoticeSingle("команды внесены в турнир",$this->Lang_Get('attention'));
		}else{
			$this->Message_AddErrorSingle('не получилось',$this->Lang_Get('attention'));		
		}
	}
	
		protected function EventRaspisanieMap() 	{
		
			if (func_check(getRequest('mapintournament',null,'post'),'id',1,3))$mapintournament_id=getRequest('mapintournament',null,'post');
			 
			$oMapsInTournament = $this->PluginVs_Stat_GetMapsintournamentById($mapintournament_id);
	
			$admin=$this->isAdminTest($oMapsInTournament->getTournamentId());
	
			$aZaezd_kval = $this->PluginVs_Stat_GetZaezdItemsByFilter(array(
					'mapintournament_id' => $mapintournament_id, 
					'kval_gonka' => '0',
					'#with'         => array('user','team'), 
					'#order' => array('prioritet' => 'asc')
				));	
			$aZaezd_gonka = $this->PluginVs_Stat_GetZaezdItemsByFilter(array(
					'mapintournament_id' => $mapintournament_id, 
					'kval_gonka' => '1',
					'#with'         => array('user','team'), 
					'#order' =>array('prioritet'=>'asc')
				));	
			//print_r(  $aMapsInTournament);
			//$oMatches=$this->PluginVs_Stat_MatchesSQL($myteam, $userid, $Setteam, $teambrief, $month, $Setcurrentweek, $week, $oBlog->GetTournamentId());
			
			
			
			$myteam=0;
			if ($this->User_IsAuthorization()) {
				$aTeam = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
				'tournament_id' => $oMapsInTournament->getTournamentId(),
				'player_id' => $this->oUserCurrent->GetUserId()		
				));		
				if($aTeam){$myteam=$aTeam->getTeamId();}		
			}
		
			if(isset($myteam) && $myteam!=0){
				$oTeam=$this->PluginVs_Stat_GetTeamByTeamId($myteam);
				$this->Viewer_Assign('oTeam',$oTeam); 
				//echo $oTeam->getName();
			}
			$oViewer=$this->Viewer_GetLocalViewer();
			$oViewer->Assign('admin',$admin); 
			$oViewer->Assign('myteam',$myteam);
			$oViewer->Assign('aZaezd_kval',$aZaezd_kval);
			$oViewer->Assign('aZaezd_gonka',$aZaezd_gonka);
			$oViewer->Assign('oUserCurrent',$this->oUserCurrent);
			
			$oViewer->Assign('tournament_id',$oMapsInTournament->getTournamentId());
			$oViewer->Assign('mapintournament_id',$mapintournament_id);
			 $sTextResult=$oViewer->Fetch("turnir_gonki.tpl"); 	 
			$this->Viewer_AssignAjax('sText',$sTextResult);
			
			//---------------------------------------------------------------------------
		

	}
	
	
	protected function EventRaspisanieMonthes() 	{
		$Setmonth = 0;
		$Setcurrentweek = 0;
		$Setteam = 0;
		$Setyear = 0;
		$week=0;
		//$month=0;
		$aFilter['month'] = 0;
		$teambrief='';
		if (func_check(getRequest('tournament',null,'post'),'id',1,3))$tournament_id=getRequest('tournament',null,'post');
		//$month=-1;
		$aFilter['month'] = -1;
		if (func_check(getRequest('monthes',null,'post'),'id',1,2))$aFilter['month']=getRequest('monthes',null,'post');
		
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
		
		$myteam=0;
		$aFilter['my_team_id'] =0;
		//$userid=0;
		$aFilter['user_id'] = 0;
		if ($this->User_IsAuthorization()) {
			$aTeam = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
			'tournament_id' => $tournament_id,
			'player_id' => $this->oUserCurrent->GetUserId()		
			));
			//if(!$aTeam)$aTeam = $this->PluginVs_Stat_GetTeamsintournamentByPlayersId($this->oUserCurrent->GetUserId());
			if($aTeam){$aFilter['my_team_id']=$aTeam->getTeamId();}	
			//$userid=$this->oUserCurrent->getId();
			$aFilter['user_id'] = $this->oUserCurrent->getId();		
		}
		
		if($aFilter['my_team_id']==0 && $oTournament->getGametypeId()==3 && $this->User_IsAuthorization()){
			if($aTeam = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
			'tournament_id' => $oTournament->getTournamentId(),
			'user_id' => $this->oUserCurrent->GetUserId()		
			 ))	)
			$aFilter['my_team_id']=$aTeam->getTeamId();
		}
			
		if($aFilter['month']==-1){
			//$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
			//$month = date('m',  strtotime($oTournament->getDatestart()));
			if( date('m',strtotime($oTournament->getDatestart())) > date('m',time()) && date('y',strtotime($oTournament->getDatestart())) > date('y',time()) ){
				$aFilter['month'] = date('m',  strtotime($oTournament->getDatestart()));
			}else{
				$aFilter['month'] = date('m',time());
			}

		
		}	
		
		if (getRequest('team',null,'post'))
		{
			if (func_check(getRequest('team',null,'post'),'text',2,30))
			{ 
				$Setteam = 1;
				//$teambrief = getRequest('team',null,'post');
				$aFilter['team_brief'] = getRequest('team',null,'post');
			}
		}
		$aFilter['tournament_id'] = $tournament_id;
		$oMatches=$this->PluginVs_Stat_MatchesSQL($aFilter);
		
			$oViewer=$this->Viewer_GetLocalViewer();
			$oViewer->Assign('oMatches',$oMatches);
			$oViewer->Assign('currentweek',date('W', time()));
			$oViewer->Assign('month',$aFilter['month']);
			$oViewer->Assign('tournament_id',$aFilter['tournament_id']);
			$oViewer->Assign('myteam',$aFilter['my_team_id']);
			
			$admin='no';
			if ($this->User_IsAuthorization()) {
				$aAdmin = $this->PluginVs_Stat_GetTournamentadminItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'user_id' => $this->oUserCurrent->GetUserId(),
					'#page' => 'count',
					'expire >='   => date("Y-m-d")
				));
				if($aAdmin['count']>0)$admin='yes';
				if($this->oUserCurrent->isAdministrator())$admin='yes';
			}
			$oViewer->Assign('admin',$admin);
$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
$oGame= $this->PluginVs_Stat_GetGameByGameId($oTournament->getGameId());
$oViewer->Assign('oGame',$oGame);
			
			//$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);			
			//$oBlog=$this->Blog_GetBlogById($oTournament->getBlogId());		
			//$link=$oBlog->getUrlFull()."turnir/".$oTournament->getUrl()."/_match/".$match_id;
			
			//$oBlog=$this->Blog_GetBlogByTournamentId($tournament_id);
			//$oViewer->Assign('link_match',$oBlog->getUrlFull()."turnir/".$oTournament->getUrl()."/_match/");
			if($Setteam) $oViewer->Assign('teambrief',$teambrief);
			$isAdmin=$this->PluginVs_Stat_IsTournamentAdmin($oTournament);
			$oViewer->Assign('isAdmin',$isAdmin);
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."actions/ActionTournament/shedule.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);

	}
	protected function EventRaspisanieWeeks() 	{
		$Setmonth = 0;
		$Setcurrentweek = 0;
		$Setteam = 0;
		$Setyear = 0;		
		//$tournament_id=getRequest('tournament',null,'post');
		if (func_check(getRequest('tournament',null,'post'),'id',1,3))$tournament_id=getRequest('tournament',null,'post');
		
		$week=0;
		$month=0;
		$teambrief='';
		
		$timestamp = time() + (7 * 24 * 60 * 60) * getRequest('week',0,'post');
		$week = date('W', $timestamp);
		
		$myteam=0;
		$userid=0;
		if ($this->User_IsAuthorization()) {
			$aTeam = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
			'tournament_id' => $tournament_id,
			'player_id' => $this->oUserCurrent->GetUserId()		
			));
			//if(!$aTeam)$aTeam = $this->PluginVs_Stat_GetTeamsintournamentByPlayersId($this->oUserCurrent->GetUserId());
			if($aTeam){$myteam=$aTeam->getTeamId();}	
			$userid=$this->oUserCurrent->getId();
		}
		if (getRequest('team',null,'post'))
		{
			if (func_check(getRequest('team',null,'post'),'text',2,30))
			{ 
				$Setteam = 1;
				$teambrief = getRequest('team',null,'post');
			}
		}

		//$oMatches=$this->PluginVs_Stat_GetAll($sql);
		$oMatches=$this->PluginVs_Stat_MatchesSQL($myteam, $userid, $Setteam, $teambrief, $month, $Setcurrentweek, $week, $tournament_id);
		
			$oViewer=$this->Viewer_GetLocalViewer();
			$oViewer->Assign('oMatches',$oMatches);
			$oViewer->Assign('currentweek',date('W', time()));
			$oViewer->Assign('week',$week-date('W', time()));
			$oViewer->Assign('myteam',$myteam);
			
			$admin='no';
			if ($this->User_IsAuthorization()) {
				$aAdmin = $this->PluginVs_Stat_GetTournamentadminItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'user_id' => $this->oUserCurrent->GetUserId(),
					'#page' => 'count',
					'expire >='   => date("Y-m-d")
				));
				if($aAdmin['count']>0)$admin='yes';
				if($this->oUserCurrent->isAdministrator())$admin='yes';
			}
			$oViewer->Assign('admin',$admin);
$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
$oGame= $this->PluginVs_Stat_GetGameByGameId($oTournament->getGameId());
$oViewer->Assign('oGame',$oGame);
			
			$oBlog=$this->Blog_GetBlogByTournamentId($tournament_id);
			//$oViewer->Assign('link_match',Config::Get('path.root.web')."/".$oBlog->getPlatform()."/".$oBlog->getGame()."/".$oBlog->getGametype()."/".$oBlog->getBlogUrl()."/_match/");
			if($Setteam) $oViewer->Assign('teambrief',$teambrief);
			$oViewer->Assign('tournament_id',$tournament_id);			
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."actions/ActionTournament/shedule.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);

	}	
	
	protected function EventRaspisanieMy() 	{
		$Setmonth = 0;
		$Setcurrentweek = 0;
		$Setteam = 0;
		$Setyear = 0;		
		$tournament_id=getRequest('tournament',null,'post');
		if (func_check(getRequest('tournament',null,'post'),'id',1,3))$tournament_id=getRequest('tournament',null,'post');
		$week=0;
		$month=0;
		$teambrief='';
		
		$timestamp = time() + (7 * 24 * 60 * 60) * getRequest('week',0,'post');
		//$week = date('W', $timestamp);
		
		$myteam=0;
		$userid=0;
		if ($this->User_IsAuthorization()) {
			$aTeam = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
			'tournament_id' => $tournament_id,
			'player_id' => $this->oUserCurrent->GetUserId(),
			'#with'         => array('team'),			
			));
			//if(!$aTeam)$aTeam = $this->PluginVs_Stat_GetTeamsintournamentByPlayersId($this->oUserCurrent->GetUserId());
			if($aTeam){$myteam=$aTeam->getTeamId(); $teambrief=$aTeam->getTeam()->getShortname(); $Setteam = 1;}	
			$userid=$this->oUserCurrent->getId();
		}
		
		//$oMatches=$this->PluginVs_Stat_GetAll($sql);
		$oMatches=$this->PluginVs_Stat_MatchesSQL($myteam, $userid, $Setteam, $teambrief, $month, $Setcurrentweek, $week, $tournament_id);
		
			$oViewer=$this->Viewer_GetLocalViewer();
			$oViewer->Assign('oMatches',$oMatches);
			$oViewer->Assign('currentweek',date('W', time()));
			$oViewer->Assign('week',$week-date('W', time()));
			$oViewer->Assign('myteam',$myteam);
			
			$admin='no';
			if ($this->User_IsAuthorization()) {
				$aAdmin = $this->PluginVs_Stat_GetTournamentadminItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'user_id' => $this->oUserCurrent->GetUserId(),
					'#page' => 'count',
					'expire >='   => date("Y-m-d")
				));
				if($aAdmin['count']>0)$admin='yes';
				if($this->oUserCurrent->isAdministrator())$admin='yes';
			}
			$oViewer->Assign('admin',$admin);
$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
$oGame= $this->PluginVs_Stat_GetGameByGameId($oTournament->getGameId());
$oViewer->Assign('oGame',$oGame);			
			$oBlog=$this->Blog_GetBlogByTournamentId($tournament_id);
			$oViewer->Assign('link_match',Config::Get('path.root.web')."/".$oBlog->getPlatform()."/".$oBlog->getGame()."/".$oBlog->getGametype()."/".$oBlog->getBlogUrl()."/_match/");
			$oViewer->Assign('link_match_insert', Config::Get('path.root.web')."/".$oBlog->getPlatform()."/".$oBlog->getGame()."/".$oBlog->getGametype()."/".$oBlog->getBlogUrl()."/_match_insert/");
			
			if($Setteam) $oViewer->Assign('teambrief',$teambrief);
			$oViewer->Assign('tournament_id',$tournament_id);			
			$sTextResult=$oViewer->Fetch("turnir_raspisanie.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);

	}	
	protected function EventRaspisanieDolg() 	{}
	
	protected function EventRaspisanieWillDolg() 	{}
	protected function EventTurnirsFuture() {
		if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					'datestart >' => date("Y-m-d"),	
					'#with'         => array('gametype','blog'),
					'#order' =>array('datestart'=>'asc'),
					'#limit' =>array('0','10')
				))
			)
		{
		
			$oViewer=$this->Viewer_GetLocalViewer();	
			$oViewer->Assign('Tournaments',$Tournaments);
			$sTextResult=$oViewer->Fetch("block.turnirs_future.tpl");
			$this->Viewer_AssignAjax('sElements',count($Tournaments));
			$this->Viewer_AssignAjax('sText',$sTextResult);
		} else {
			//$this->Message_AddErrorSingle($this->Lang_Get('block_stream_comments_no'),$this->Lang_Get('attention'));
			return;
		}
	}
	protected function EventTurnirsNow() {
		if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					'datestart <=' => date("Y-m-d"),
					'zavershen' => '0',
					'#with'         => array('gametype','blog'),
					'#order' =>array('datestart'=>'asc'),
					'#limit' =>array('0','10')
				))
			)
		{
		
			$oViewer=$this->Viewer_GetLocalViewer();	
			$oViewer->Assign('Tournaments',$Tournaments);
			$sTextResult=$oViewer->Fetch("block.turnirs_now.tpl");
			$this->Viewer_AssignAjax('sElements',count($Tournaments));
			$this->Viewer_AssignAjax('sText',$sTextResult);
		} else {
			$this->Message_AddErrorSingle($this->Lang_Get('block_stream_comments_no'),$this->Lang_Get('attention'));
			return;
		}
	}
	protected function EventTurnirsComplete() {
		if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					'datestart <=' => date("Y-m-d"),
					'zavershen' => '1',
					'#with'         => array('gametype','blog'),
					'#order' =>array('datestart'=>'desc'),
					'#limit' =>array('0','10')
				))
			)
		{
		
			$oViewer=$this->Viewer_GetLocalViewer();	
			$oViewer->Assign('Tournaments',$Tournaments);
			$sTextResult=$oViewer->Fetch("block.turnirs_complete.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
			$this->Viewer_AssignAjax('sElements',count($Tournaments));
		} else {
			$this->Message_AddErrorSingle($this->Lang_Get('block_stream_comments_no'),$this->Lang_Get('attention'));
			return;
		}
	}
	protected function EventTurnirsMy() {
		/*if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					'datestart <=' => date("Y-m-d"),
					'zakryto' =>'0',					
					'#with'         => array('gametype','blog'),
					'#order' =>array('datestart'=>'asc'),
					'#limit' =>array('0','10')
				))
			)
		{
		
			$oViewer=$this->Viewer_GetLocalViewer();	
			$oViewer->Assign('Tournaments',$Tournaments);
			$sTextResult=$oViewer->Fetch("block.turnirs_my.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
		} else {
			$this->Message_AddErrorSingle($this->Lang_Get('block_stream_comments_no'),$this->Lang_Get('attention'));
			return;
		}*/
		
		
		$this->oUserCurrent = $this->User_GetUserCurrent();
		if($this->User_IsAuthorization()){	

			$sql="select tournament_id from tis_stat_teamsintournament where player_id='".$this->oUserCurrent->GetUserId()."'";
			$aTournaments=$this->PluginVs_Stat_GetAll($sql);
			$tournament=array();
			if($aTournaments){
				foreach($aTournaments as $oTournament){
					$tournament[]=$oTournament['tournament_id'];
				}
				$mytournaments=1;
				if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					//'datestart >' => date("Y-m-d"),	
					'tournament_id in' => $tournament,
					'zavershen' => '0',
					'#with'         => array('gametype','blog'),
					'#order' =>array('datestart'=>'asc'),
					'#limit' =>array('0','10')
				))
					)
				{
				//echo 23;

					
					$oViewer=$this->Viewer_GetLocalViewer();	
					$oViewer->Assign('Tournaments',$Tournaments);
					$sTextResult=$oViewer->Fetch("block.turnirs_my.tpl");
					$this->Viewer_AssignAjax('sText',$sTextResult);
					$this->Viewer_AssignAjax('sElements',count($Tournaments));
			
				}else {
					$this->Message_AddErrorSingle('Вы не участвуете в турнирах',$this->Lang_Get('attention'));
					return;
				}
				
			}else {
			$this->Message_AddErrorSingle('Вы не участвуете в турнирах',$this->Lang_Get('attention'));
			return;
			}
		}else {
			$this->Message_AddErrorSingle('Вы не авторизованы',$this->Lang_Get('attention'));
			return;
			}
			
	}
	
	/**
	 * Обработка получения последних комментов
	 *
	 */
	protected function EventVyzovyRefresh(){
		if (func_check(getRequest('game_id',null,'post'),'id',1,11))$game_id=getRequest('game_id',null,'post');
		if (func_check(getRequest('gametype_id',null,'post'),'id',1,11))$gametype_id=getRequest('gametype_id',null,'post');
	
		$oGameType= $this->PluginVs_Stat_GetGametypeByGametypeId($gametype_id);
		$oGame= $this->PluginVs_Stat_GetGameByGameId($game_id);
		$this->oUserCurrent = $this->User_GetUserCurrent();
		
		$aVyzovy_vy = $this->PluginVs_Stat_GetVyzovItemsByFilter(array(
			'game_id' => $oGame->getGameId(),
			'gametype_id' => $oGameType->getGametypeId(),
			'user_id'=>$this->oUserCurrent->GetUserId(),
			'status <' => '10',
			'#with'         => array('user1','user2')
			));
			
		$aVyzovy_vas = $this->PluginVs_Stat_GetVyzovItemsByFilter(array(
			'game_id' => $oGame->getGameId(),
			'gametype_id' => $oGameType->getGametypeId(),
			'user2_id'=>$this->oUserCurrent->GetUserId(),
			//'#where' => array('(user_id = (?d) or user2_id = (?d) ) ' => array($this->oUserCurrent->GetUserId(), $this->oUserCurrent->GetUserId())),				
			'status <' => '10',
			'#with'         => array('user1','user2')
			));
			
		
		$oViewer=$this->Viewer_GetLocalViewer();	 
		$oViewer->Assign('aVyzovy_vy',$aVyzovy_vy);
		$oViewer->Assign('aVyzovy_vas',$aVyzovy_vas);
		$sTextResult=$oViewer->Fetch("block.tovarki_vyzov.tpl");
		$this->Viewer_AssignAjax('sText',$sTextResult);
		
	}
	
	protected function EventAuRaspisanie() {
		$oViewer=$this->Viewer_GetLocalViewer();
		if (func_check(getRequest('tournament',null,'post'),'id',1,11))$tournament_id=getRequest('tournament',null,'post');
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
		
		$oViewer->Assign('oTournament',$oTournament);
		if($this->oUserCurrent->getLogin()=='Klaus' || $this->oUserCurrent->getLogin()=='2ManyFaces')$oViewer->Assign('superadmin',1);
		$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."admins/admin_raspisanie.tpl");
		$this->Viewer_AssignAjax('sText',$sTextResult);
	
	
	}
	
	protected function EventAuTournament() {

		 	$oViewer=$this->Viewer_GetLocalViewer();


		 		
			if (func_check(getRequest('tournament',null,'post'),'id',1,11))$tournament_id=getRequest('tournament',null,'post');
			$oViewer->Assign('Tournament',$tournament_id);
			
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
			/*$oTournament = $this->PluginVs_Stat_GetTournamentByFilter(array(
			'tournament_id' => $tournament_id, 
			'#with'         => array('waitlist','prolong')
			));*/
			
			$aFilter=array(
				'topic_publish' => 1,
				'blog_id' => $oTournament->getBlogId(),
			);
			$aTopics=$this->Topic_GetTopicsByFilter($aFilter);
			
			$oViewer->Assign('oTournament',$oTournament);
			$oViewer->Assign('aTopics',$aTopics['collection']);
			
			$aRounds=array();
			
			$sql="select distinct round_id from tis_stat_teamsintournament where tournament_id=".$tournament_id;
			$aRounds=$this->PluginVs_Stat_GetAll($sql);
			
			$Rounds=array();
			if($aRounds){
				foreach($aRounds as $oRound){
					$Rounds[]=$oRound['round_id'];
				}
				$sql="select distinct 1 from tis_stat_playoff where tournament_id=".$tournament_id;
				if($this->PluginVs_Stat_GetAll($sql))$Rounds[count($Rounds)]='1';
				
				//print_r($Rounds);
				$aRound = $this->PluginVs_Stat_GetRoundItemsByFilter(array(
						'round_id in' => $Rounds
						));
				$oViewer->Assign('aRound',$aRound);
			}
			$aLeagues = $this->PluginVs_Stat_GetLeagueItemsByFilter(array(
						'name <>' => ' '
						));
			$oViewer->Assign('aLeagues',$aLeagues);
			//if($this->oUserCurrent->isAdministrator())$oViewer->Assign('superadmin',1);
			if($this->oUserCurrent->getLogin()=='Klaus' || $this->oUserCurrent->getLogin()=='2ManyFaces')$oViewer->Assign('superadmin',1);
		
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."admins/admin_tournament.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);

	}
	
	protected function EventDeleteTeamTournament() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('teamtournament_id',null,'post'),'id',1,11))$teamtournament_id=getRequest('teamtournament_id',null,'post');
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
			if($oTeamsintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'id' => $teamtournament_id,
							'tournament_id' => $tournament_id					
						))
				){
					$oTeamsintournament->Delete();				
				}
			
		}else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
	}
	protected function EventAuDeleteTeam() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('user_id',null,'post'),'id',1,11))$user_id=getRequest('user_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
			if($oTeamsintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'team_id' => $team_id,
							'player_id' => $user_id,
							'tournament_id' => $tournament_id					
						))
				){
					$oTeamsintournament->setPlayerId(0);
					$oTeamsintournament->Save();
				
				}else{
						//$this->Message_AddErrorSingle('что-то странное вы хотите',$this->Lang_Get('attention'));				
					}
					/*тимплей*/
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
			$oPlayercard=$this->PluginVs_Stat_GetPlayercardByFilter(array(
							'user_id' => $user_id,
							'sport_id' => $oTournament->getGame()->getSportId(),
							'platform_id' => $oTournament->getGame()->getPlatformId()							
						));
			if($oPlayercard)
			if($oPlayertournament=$this->PluginVs_Stat_GetPlayertournamentByFilter(array(
							'playercard_id' => $oPlayercard->getPlayercardId(), 
							'tournament_id' => $oTournament->getTournamentId()							
						)) )
			{
				$oPlayertournament->setTeamId(0);
				$oPlayertournament->Save();
				
			}	
			
		}else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
	}
	protected function EventAuChangeTeam() {
	
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('user_id',null,'post'),'id',1,11))$user_id=getRequest('user_id',null,'post');
		if (func_check(getRequest('user2_id',null,'post'),'id',1,11))$user2_id=getRequest('user2_id',null,'post');
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
			if($oTeamsintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'player_id' => $user_id,
							'tournament_id' => $tournament_id					
						))
				){
					$oTeamsintournament->setPlayerId(0);
					$team_id=$oTeamsintournament->getTeamId();
					$oTeamsintournament->Save();
				}else{
					$this->Message_AddErrorSingle('у команды не нашлось владельца',$this->Lang_Get('attention'));				
				}
				if($oTeamsintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'player_id' => $user2_id,
							'tournament_id' => $tournament_id					
						))
				){
					$oTeamsintournament->setPlayerId($user_id);
					$oTeamsintournament->Save();
				}else{
					$this->Message_AddErrorSingle('у команды не нашлось владельца',$this->Lang_Get('attention'));				
				}
				
				if($oTeamsintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'team_id' => $team_id,
							'tournament_id' => $tournament_id					
						))
				){
					$oTeamsintournament->setPlayerId($user2_id);
					$oTeamsintournament->Save();
					
				}else{
					$this->Message_AddErrorSingle('у команды не нашлось владельца',$this->Lang_Get('attention'));				
				}
				
		}else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
	}
	
	
	protected function EventAuAddPlayer() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('user_login',null,'post'),'text',1,40))$user_login=getRequest('user_login',null,'post');
		if (!($oUser=$this->User_GetUserByLogin($user_login))) {
				$this->Message_AddErrorSingle('No such user',$this->Lang_Get('error'));
				return;
			}
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
			$oGame = $oTournament->getGame();
			$oPlatform = $this->PluginVs_Stat_GetPlatformByPlatformId($oGame->getPlatformId());
	 
			if($oPlatform->getBrief()=='pc'){
				$what_identifier = 'EA';
			}else{
				$what_identifier = $oPlatform->getBrief();
			}
			$Tag='';
			if($what_identifier=='ps3')$Tag='PSN ID';
			if($what_identifier=='xbox')$Tag='GameTag';
			if($what_identifier=='EA')$Tag='EA';
			$this->Viewer_Assign('Tag',$Tag);
			$Identifier=$this->User_getUserFieldValueByName($oUser->GetUserId(), $what_identifier);
			if(!$Identifier)$Identifier = '';
			
			if($oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
					'user_id' => $oUser->GetUserId(),
					'tournament_id'         => $tournament_id					
				)))
			{
				$this->Message_AddErrorSingle('Exist such player in tournament',$this->Lang_Get('error'));
				return;
			
			}else{
		
				$oPlayerTournament =  Engine::GetEntity('PluginVs_Stat_Playertournament');
				$oPlayerTournament->setPsnid($Identifier);	
				$oPlayerTournament->setUserId($oUser->GetUserId());	
				$oPlayerTournament->setTournamentId($tournament_id);	
				$oPlayerTournament->setDates(date("Y-m-d H:i:s"));	
				$oPlayerTournament->Add();
			}
			/*$data = explode(":", $team);
			$oGameType= $this->PluginVs_Stat_GetGametypeByBrief($data[2]);
			$oSport= $this->PluginVs_Stat_GetSportByBrief($data[1]);  
			
			if( $oTeam = $this->PluginVs_Stat_GetTeamByFilter(array(
						'name' => $data[0],
						'sport_id' =>  $oSport->getSportId(),
						'gametype_id' =>  $oGameType->getGametypeId(),
					)) ){
					
				$oTeamsintournament =  Engine::GetEntity('PluginVs_Stat_Teamsintournament');
				$oTeamsintournament->setTournamentId($tournament_id);	
				$oTeamsintournament->setTeamId($oTeam->getTeamId()); 
				$oTeamsintournament->setPlayerId(0); 
				$oTeamsintournament->setRoundId($round_id); 
				$oTeamsintournament->Add();		
			*/	
				$this->Message_AddNoticeSingle(" ","Saved");
		}			
	}
	
	
	protected function EventAuAddTeam() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('round_id',null,'post'),'id',1,11))$round_id=getRequest('round_id',null,'post');
		if (func_check(getRequest('team',null,'post'),'text',1,80))$team=getRequest('team',null,'post');
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
			$data = explode(":", $team);
			$oGameType= $this->PluginVs_Stat_GetGametypeByBrief($data[2]);
			$oSport= $this->PluginVs_Stat_GetSportByBrief($data[1]);  
			
			if( $oTeam = $this->PluginVs_Stat_GetTeamByFilter(array(
						'name' => $data[0],
						'sport_id' =>  $oSport->getSportId(),
						'gametype_id' =>  $oGameType->getGametypeId(),
						'status' => 'play'
					)) ){
					
				$oTeamsintournament =  Engine::GetEntity('PluginVs_Stat_Teamsintournament');
				$oTeamsintournament->setTournamentId($tournament_id);	
				$oTeamsintournament->setTeamId($oTeam->getTeamId()); 
				$oTeamsintournament->setPlayerId(0); 
				$oTeamsintournament->setRoundId($round_id); 
				$oTeamsintournament->Add();		
				
				$this->Message_AddNoticeSingle(" ","Saved");
			}			
		}
	}
	protected function EventAuSetTeam() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('user_id',null,'post'),'id',1,11))$user_id=getRequest('user_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
		if($oTournament->getGametypeId()!=3){
			if($oTeamsintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'team_id' => $team_id,
							'player_id' => 0,
							'tournament_id' => $tournament_id					
						))
				){
					if(! $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'player_id' => $user_id,
							'tournament_id' => $tournament_id					
						))
					){
						$oTeamsintournament->setPlayerId($user_id);
						$oTeamsintournament->Save();
					
					}else{
						$this->Message_AddErrorSingle('у человека уже есть команда',$this->Lang_Get('attention'));				
					}
				}elseif( ! $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'team_id' => $team_id, 
							'tournament_id' => $tournament_id					
						))
				){
					if(! $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'player_id' => $user_id,
							'tournament_id' => $tournament_id					
						))
					){					
						$oTeamsintournament =  Engine::GetEntity('PluginVs_Stat_Teamsintournament');
						$oTeamsintournament->setTournamentId($tournament_id);	
						$oTeamsintournament->setTeamId($team_id); 
						$oTeamsintournament->setPlayerId($user_id); 
						$oTeamsintournament->Add();
					}
				
				}else{
					$this->Message_AddErrorSingle('у данной команды есть владелец',$this->Lang_Get('attention'));				
				}
		}else{
			$oPlayercard=$this->PluginVs_Stat_GetPlayercardByFilter(array(
							'user_id' => $user_id,
							'sport_id' => $oTournament->getGame()->getSportId(),
							'platform_id' => $oTournament->getGame()->getPlatformId()							
						));
			if($oPlayertournament=$this->PluginVs_Stat_GetPlayertournamentByFilter(array(
							'playercard_id' => $oPlayercard->getPlayercardId(), 
							'tournament_id' => $oTournament->getTournamentId()							
						)) )
			{
				$oPlayertournament->setTeamId($team_id);
				$oPlayertournament->Save();
				
			} /*else{
				$oPlayerteamtournament =  Engine::GetEntity('PluginVs_Stat_Playerteamtournament');
				$oPlayerteamtournament->setPlayercardId($oPlayercard->getPlayercardId());
				$oPlayerteamtournament->setTournamentId($oTournament->getTournamentId());
				$oPlayerteamtournament->setTeamId($team_id); 	
				$oPlayerteamtournament->Add();
				
				
			}*/
			
		}
				
		}else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
	}
	protected function EventAuChange() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('user_id',null,'post'),'id',1,11))$user_id=getRequest('user_id',null,'post');
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
			$oViewer=$this->Viewer_GetLocalViewer();
			
			$oUser=$this->User_GetUserById($user_id);
			if( $aTeamsintournament = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'#where' => array('player_id not in (?d,?d)' => array( 0,$user_id)),
					'#with'         => array('team', 'user1'),
					'#order' =>array('team_id'=>'asc')
					))
				){
					$oViewer->Assign('aTeamsintournament',$aTeamsintournament);
				}
			
			$oViewer->Assign('oUser',$oUser);
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."admins/admin_changeteam.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
		}else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
	}


	protected function EventAuZayavki() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('user_id',null,'post'),'id',1,11))$user_id=getRequest('user_id',null,'post');
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
			$oViewer=$this->Viewer_GetLocalViewer();
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
			$oUser=$this->User_GetUserById($user_id);
			if( $aZayvki = $this->PluginVs_Stat_GetZayavkiItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'user_id' => $user_id,
					'#with'         => array('team'),
					'#order' =>array('prioritet'=>'asc')
					))
				){
					$oViewer->Assign('aZayvki',$aZayvki);				
					
				}
			$sql="select distinct team_id from tis_stat_teamsintournament where player_id<>0 and tournament_id=".$tournament_id;
					$aTeams=$this->PluginVs_Stat_GetAll($sql);
					$oViewer->Assign('aTeams',$aTeams);
			if($oTournament->getGametypeId()!=3){	
				$allTeams = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'player_id'=>0,
					'#with'         => array('team'),
					'#order' =>array('team_id'=>'asc')
					));
					$oViewer->Assign('allTeams',$allTeams);
			}else{
				$allTeams = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id' => $tournament_id, 
					'#with'         => array('team'),
					'#order' =>array('team_id'=>'asc')
					));
					$oViewer->Assign('allTeams',$allTeams);
			}
			$oViewer->Assign('oUser',$oUser);
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."admins/admin_zayavki.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
		}else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
	}
	
	
	protected function EventDeleteRound() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('round',null,'post'),'id',1,3))$round=getRequest('round',null,'post');
		$oViewer=$this->Viewer_GetLocalViewer();
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
		
			$rounds=array();
			$rounds[1]='1';
			$rounds[2]='1/2';
			$rounds[4]='1/4';
			$rounds[8]='1/8';
			$rounds[16]='1/16';
			$rounds[32]='1/32';
			
			$sql="SELECT *	FROM `tis_stat_playoff` 
						WHERE tournament_id = ".$tournament_id."
						and round='".$rounds[$round]."'	";
						
			if( $this->PluginVs_Stat_GetAll($sql)){
				$sql="SELECT distinct 1	FROM `tis_stat_matches` WHERE tournament_id = ".$tournament_id." and round_po='".$rounds[$round]."' ";
			 
				if(!$this->PluginVs_Stat_GetAll($sql))
				{
					$aPlayoff = $this->PluginVs_Stat_GetPlayoffItemsByFilter(array(
							'tournament_id ' => $tournament_id, 
							'round'         => $rounds[$round]
						));
					foreach($aPlayoff as $oPlayoff){
						$oPlayoff->Delete();					
					}
				
				}else{
					$this->Message_AddErrorSingle('Удалите сначала матчи',$this->Lang_Get('attention'));
					return;				
				}
				
			}
			
		}else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
	}
	
	
	protected function EventCreateRound() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('round',null,'post'),'id',1,3))$round=getRequest('round',null,'post');
		$oViewer=$this->Viewer_GetLocalViewer();
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
		
			$rounds=array();
			$rounds[1]='1';
			$rounds[2]='1/2';
			$rounds[4]='1/4';
			$rounds[8]='1/8';
			$rounds[16]='1/16';
			$rounds[32]='1/32';
			
			$sql="SELECT *	FROM `tis_stat_playoff` 
						WHERE tournament_id = ".$tournament_id."
						and round='".$rounds[$round]."'	";
						
			if( !$this->PluginVs_Stat_GetAll($sql)){
				if($round==1){$par=2;}else{$par=$round;} //матч за 3 место, давно надо было сделать
				for($i=1; $i<=$par*2; $i++){

					$oPlayoff =  Engine::GetEntity('PluginVs_Stat_Playoff');
					$oPlayoff->setTournamentId($tournament_id);	
					$oPlayoff->setTeamId(0);
					$oPlayoff->setNum($i);	
					$oPlayoff->setRound($rounds[$round]);
					$oPlayoff->Add();				
				}
			}
			
		}else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
	}
	
	protected function EventDeleteRaspisanie() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('round',null,'post'),'id',1,5))$round=getRequest('round',null,'post');
		$oViewer=$this->Viewer_GetLocalViewer();
		$rounds=array();
		$rounds[1]='1';
		$rounds[2]='1/2';
		$rounds[4]='1/4';
		$rounds[8]='1/8';
		$rounds[16]='1/16';
		$rounds[32]='1/32';
				
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
			$sql="SELECT distinct 1	FROM `tis_stat_matches` WHERE tournament_id = ".$tournament_id." and round_po='".$rounds[$round]."' and played=1";
			 
			if(!$this->PluginVs_Stat_GetAll($sql))
			{									
				$aMatches=$this->PluginVs_Stat_GetMatchesItemsByFilter(array(
					'tournament_id'=> $tournament_id,
					'round_id'=> 100,
					'round_po'=> $rounds[$round]
				));
				
				foreach($aMatches as $oMatches)
				{
					$oMatches->Delete();				
				}
				
			}else {
				$this->Message_AddErrorSingle('есть сыгранные матчи',$this->Lang_Get('attention'));
				return;
			}
		}else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
	}
	protected function EventCreateRaspisanie() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('round',null,'post'),'id',1,5))$round=getRequest('round',null,'post');
		if (func_check(getRequest('start_day',null,'post'),'text',10,10))$start_day=getRequest('start_day',null,'post');
		if (func_check(getRequest('matches_in_day',null,'post'),'id',1,5))$matches_in_day=getRequest('matches_in_day',null,'post');
		if (func_check(getRequest('matches_between_day',null,'post'),'id',1,5))$matches_between_day=getRequest('matches_between_day',null,'post');
		if (func_check(getRequest('matches_to_win',null,'post'),'id',1,5))$matches_to_win=getRequest('matches_to_win',null,'post');
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
		
		$oViewer=$this->Viewer_GetLocalViewer();
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
			$rounds=array();
			$rounds[1]='1';
			$rounds[2]='1/2';
			$rounds[4]='1/4';
			$rounds[8]='1/8';
			$rounds[16]='1/16';
			$rounds[32]='1/32';
			
			if(trim($start_day) != '' ){
				$res=explode('-', $start_day);
				$day=mktime(0, 0, 0, $res[1], $res[0], $res[2]);
			}
			
			$sql="SELECT distinct 1	FROM `tis_stat_matches` WHERE tournament_id = ".$tournament_id." and round_id=100 and round_po='".$rounds[$round]."' ";
			if(!$this->PluginVs_Stat_GetAll($sql) && $matches_in_day>0 && $matches_to_win>0)
			{
					$num=1;
					if($round==1){$par=2;}else{$par=$round;} //матч за 3 место, давно надо было сделать
					for($i=1; $i<$par*2; $i=$i+2)
					{	
						$oPlayoff_1 = $this->PluginVs_Stat_GetPlayoffByFilter(array(
							'tournament_id ' => $tournament_id,
							'num'         => $i,
							'round'         => $rounds[$round]
						));
						$oPlayoff_2 = $this->PluginVs_Stat_GetPlayoffByFilter(array(
							'tournament_id ' => $tournament_id,
							'num'         => ($i+1),
							'round'         => $rounds[$round]
						));
						$this_pair_days=$day;
						
						$matches=0;
						$matches_this_day=0;
						
						if($matches_to_win != 9){
							$total_team_matches = $matches_to_win*2-1;
							$def_matches_to_win = $matches_to_win;
						}else{
							$total_team_matches = 2; 
							$def_matches_to_win =2;
						}
						
						if($oPlayoff_1->getTeamId()<>0 && $oPlayoff_2->getTeamId()<>0)
						while($matches<$total_team_matches)
						{
							if($matches_this_day==$matches_in_day){
								$this_pair_days = DateAdd('d', $matches_between_day, $this_pair_days);
								$matches_this_day=0;
							}
							
							$oMatch_add =  Engine::GetEntity('PluginVs_Stat_Matches');			
							$oMatch_add->setTournamentId($tournament_id);
							$oMatch_add->setRoundId('100');
							$oMatch_add->setRoundPo($rounds[$round]);
							$oMatch_add->setGameId($oTournament->getGameId());
							$oMatch_add->setGametypeId($oTournament->getGametypeId());
							$oMatch_add->setDates(date("Y-m-d", $this_pair_days));
							if($def_matches_to_win>2){
								if($matches<2){
									$oMatch_add->setHome($oPlayoff_1->getTeamId());
									$oMatch_add->setAway($oPlayoff_2->getTeamId());
								}
								if($matches>=2 && $matches<4){
									$oMatch_add->setHome($oPlayoff_2->getTeamId());
									$oMatch_add->setAway($oPlayoff_1->getTeamId());
								}
								if($matches==4){
									$oMatch_add->setHome($oPlayoff_1->getTeamId());
									$oMatch_add->setAway($oPlayoff_2->getTeamId());
								}
								if($matches==5){
									$oMatch_add->setHome($oPlayoff_2->getTeamId());
									$oMatch_add->setAway($oPlayoff_1->getTeamId());
								}
								if($matches==6){
									$oMatch_add->setHome($oPlayoff_1->getTeamId());
									$oMatch_add->setAway($oPlayoff_2->getTeamId());
								}
							}else{
								if($matches % 2==0 ){
									$oMatch_add->setHome($oPlayoff_1->getTeamId());
									$oMatch_add->setAway($oPlayoff_2->getTeamId());
								}else{
									$oMatch_add->setHome($oPlayoff_2->getTeamId());
									$oMatch_add->setAway($oPlayoff_1->getTeamId());
								}							
							}
							
							$oMatch_add->setBlogId($oTournament->getBlogId());
							$oMatch_add->setHomeComment('');
							$oMatch_add->setAwayComment('');
							$oMatch_add->setNumber($num);
							$oMatch_add->Add();
							
							$matches++;
							$matches_this_day++;
							$num++;
	
						}
					}
			}
			
		}else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
		
	}
	protected function EventSaveRound() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if (func_check(getRequest('round_num',null,'post'),'text',1,5))$round_num=getRequest('round_num',null,'post');
		$tmp = explode("_", $round_num);
		$round=$tmp[0];
		$num=$tmp[1];
		
		//if (func_check(getRequest('round',null,'post'),'id',1,3))$round=getRequest('round',null,'post');
		$oViewer=$this->Viewer_GetLocalViewer();
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
		
			$rounds=array();
			$rounds[1]='1';
			$rounds[2]='1/2';
			$rounds[4]='1/4';
			$rounds[8]='1/8';
			$rounds[16]='1/16';
			$rounds[32]='1/32';
			
			$oPlayoff = $this->PluginVs_Stat_GetPlayoffByFilter(array(
					'tournament_id ' => $tournament_id,
					'num'         => $num,
					'round'         => $rounds[$round]
					));
			$oPlayoff->setTeamId($team_id);
			$oPlayoff->Save();
			/*$sql="SELECT *	FROM `tis_stat_playoff` 
						WHERE tournament_id = ".$tournament_id."
						and round='".$rounds[$round]."'	";
						
			if( !$this->PluginVs_Stat_GetAll($sql)
					)
				{
				for($i=1; $i<=$round*2; $i++){

					$oPlayoff =  Engine::GetEntity('PluginVs_Stat_Playoff');
					$oPlayoff->setTournamentId($tournament_id);	
					$oPlayoff->setTeamId(0);
					$oPlayoff->setNum($i);	
					$oPlayoff->setRound($rounds[$round]);
					$oPlayoff->Add();				
				}
			}*/
			
		}else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
	}

	protected function EventAuGroup() {
		if (func_check(getRequest('tournament',null,'post'),'id',1,11))$tournament_id=getRequest('tournament',null,'post');
		$oViewer=$this->Viewer_GetLocalViewer();
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
			$aTeams = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id ' => $tournament_id,
					'round_id'		=> '0',
					'#with'         => array('team'),
					'#order' =>array('team_id'=>'asc')
					));
			$oViewer->Assign('aTeams',$aTeams);	
			
			$aTeams_second = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id ' => $tournament_id,
					'round_id'		=> '2',
					'#with'         => array('team'),
					'#order' =>array('team_id'=>'asc')
					));
			$oViewer->Assign('aTeams_second',$aTeams_second);	
			
			$aGroups = $this->PluginVs_Stat_GetGroupItemsByFilter(array(
					'#order' =>array('name'=>'asc')
					));
			$oViewer->Assign('aGroups',$aGroups);	
			
			
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."admins/admin_group.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
			
			
		}else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
		
	}
	protected function EventAuSetGroup() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if (func_check(getRequest('group_id',null,'post'),'id',1,11))$group_id=getRequest('group_id',null,'post');		
		if (func_check(getRequest('round_id',null,'post'),'id',1,11))$round_id=getRequest('round_id',null,'post');
		
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
			if ($oTeam = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
					'tournament_id ' => $tournament_id,
					'team_id ' => $team_id,
					'round_id ' => $round_id 
					)) ){
						
				$oTeam->setGroupId($group_id);
				$oTeam->Save();
			
			}else{
				$this->Message_AddErrorSingle('странно',$this->Lang_Get('attention'));
				return;			
			}
		
		}else{
				$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
				return;			
			}		 
	}
	protected function EventAuSetParentGroup() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if (func_check(getRequest('group_id',null,'post'),'id',1,11))$group_id=getRequest('group_id',null,'post');		
		if (func_check(getRequest('round_id',null,'post'),'id',1,11))$round_id=getRequest('round_id',null,'post');
		
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
			if ($oTeam = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
					'tournament_id ' => $tournament_id,
					'team_id ' => $team_id,
					'round_id ' => $round_id 
					)) ){
						
				$oTeam->setParentgroupId($group_id);
				$oTeam->Save();
			
			}else{
				$this->Message_AddErrorSingle('странно',$this->Lang_Get('attention'));
				return;			
			}
		
		}else{
				$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
				return;			
			}	
	}
	
	protected function EventAuPlayoff() {
		if (func_check(getRequest('tournament',null,'post'),'id',1,11))$tournament_id=getRequest('tournament',null,'post');
		$oViewer=$this->Viewer_GetLocalViewer();
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {
		

			$aTeams = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id ' => $tournament_id,
					'#with'         => array('team'),
					'#order' =>array('team_id'=>'asc')
					));
			$oViewer->Assign('aTeams',$aTeams);	
			
			$sql="SELECT num, team_id	FROM `tis_stat_playoff` WHERE tournament_id = ".$tournament_id." and round='1' order by num";
			if( $aRoundPosition = $this->PluginVs_Stat_GetAll($sql)
					)
				{
					$aObjects=array();
					foreach($aRoundPosition as $oRoundPosition){	
						$aObjects[$oRoundPosition['num']]=$oRoundPosition['team_id'];			
				
					}
					$oViewer->Assign('Teams1',$aObjects);	
					
					$sql="SELECT distinct 1	FROM `tis_stat_matches` WHERE tournament_id = ".$tournament_id." and round_id=100 and round_po='1' ";
					if($this->PluginVs_Stat_GetAll($sql) )$oViewer->Assign('Matches1',1);
				}
				
				
			$sql="SELECT num, team_id	FROM `tis_stat_playoff` WHERE tournament_id = ".$tournament_id." and round='1/2' order by num";
			if( $aRoundPosition = $this->PluginVs_Stat_GetAll($sql)
					)
				{
					$aObjects=array();
					foreach($aRoundPosition as $oRoundPosition){	
						$aObjects[$oRoundPosition['num']]=$oRoundPosition['team_id'];			
				
					}
					$oViewer->Assign('Teams2',$aObjects);	
					
					$sql="SELECT distinct 1	FROM `tis_stat_matches` WHERE tournament_id = ".$tournament_id." and round_id=100 and round_po='1/2' ";
					if($this->PluginVs_Stat_GetAll($sql) )$oViewer->Assign('Matches2',1);
				}
				
			$sql="SELECT num, team_id	FROM `tis_stat_playoff` WHERE tournament_id = ".$tournament_id." and round='1/4' order by num";
			if( $aRoundPosition = $this->PluginVs_Stat_GetAll($sql)
					)
				{
					$aObjects=array();
					foreach($aRoundPosition as $oRoundPosition){	
						$aObjects[$oRoundPosition['num']]=$oRoundPosition['team_id'];			
				
					}
					$oViewer->Assign('Teams4',$aObjects);	
					
					$sql="SELECT distinct 1	FROM `tis_stat_matches` WHERE tournament_id = ".$tournament_id." and round_id=100 and round_po='1/4' ";
					if($this->PluginVs_Stat_GetAll($sql) )$oViewer->Assign('Matches4',1);
				}
			$sql="SELECT num, team_id 	FROM `tis_stat_playoff` WHERE tournament_id = ".$tournament_id." and round='1/8' order by num";
			if( $aRoundPosition = $this->PluginVs_Stat_GetAll($sql)
					)
				{
					$aObjects=array();
					foreach($aRoundPosition as $oRoundPosition){	
						$aObjects[$oRoundPosition['num']]=$oRoundPosition['team_id'];						
					}
					$oViewer->Assign('Teams8',$aObjects);	
					$sql="SELECT distinct 1	FROM `tis_stat_matches` WHERE tournament_id = ".$tournament_id." and round_id=100 and round_po='1/8' ";
					if($this->PluginVs_Stat_GetAll($sql) )$oViewer->Assign('Matches8',1);
				}

			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."admins/admin_playoff.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
		} else {
			$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
			return;
		}
	}
	
	protected function EventAuTeams() {
		
		if (func_check(getRequest('tournament',null,'post'),'id',1,11))$tournament_id=getRequest('tournament',null,'post');
		
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || ($this->oUserCurrent->isAdministrator() && $this->oUserCurrent->getLogin()=='Klaus')) {		
			$oViewer=$this->Viewer_GetLocalViewer();
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
			
			$sql='SELECT DISTINCT sz.user_id as user_id, ifnull( (
							SELECT team_id
							FROM tis_stat_teamsintournament
							WHERE tournament_id = sz.tournament_id
							AND player_id = sz.user_id
						), 0 ) AS haveteam,
						sp.dates as dates
						FROM `tis_stat_zayavki` sz, `tis_stat_playertournament` sp
						WHERE sz.tournament_id = '.$tournament_id.' 
						and sz.user_id=sp.user_id
						and sz.tournament_id=sp.tournament_id
					union 
					SELECT DISTINCT sp.user_id as user_id, ifnull( (
							SELECT team_id
							FROM tis_stat_teamsintournament
							WHERE tournament_id = sp.tournament_id
							AND player_id = sp.user_id
						), 0 ) AS haveteam,
						sp.dates as dates
						FROM `tis_stat_playertournament` sp
						WHERE sp.tournament_id = '.$tournament_id.' 
						and not exists (select 1 from `tis_stat_zayavki` where user_id=sp.user_id and tournament_id=sp.tournament_id)
						
						
						order by dates asc';
			if( /*$aZayvki = $this->PluginVs_Stat_GetZayvkiByFilter(array(
					'tournament_id' => $tournament_id,
					'#with'         => array('user','team')
					)) */
					$aZayvki = $this->PluginVs_Stat_GetAll($sql)
					)
				{
					$aObjects=array();
					foreach($aZayvki as $oZayvka){						
						
						$oUser=$this->User_GetUserById($oZayvka['user_id']);
						$oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
							'user_id' => $oZayvka['user_id'],
							'tournament_id' => $tournament_id,
							'#with'         => array('team')
						));
						if($oZayvka['haveteam']>0){
							$oTeam = $this->PluginVs_Stat_GetTeamByTeamId($oZayvka['haveteam']);
							$aObjects[$oZayvka['user_id']]['team']=$oTeam;
						}
						
						$aObjects[$oZayvka['user_id']]['vznos']=0;
						$aFilter = array(
							'user_id' => $oZayvka['user_id'],
							'operation_subject_type' => 'tournament',
							'operation_subject_id' => $tournament_id
						);
						
						if( $aResult = $this->PluginLspurse_Purse_GetOperationByFilter($aFilter, 1, 1) ){
							$aOperations = $aResult['collection'];  
							$oOperation = array_shift($aOperations);
							if($oOperation){
								$aObjects[$oZayvka['user_id']]['vznos']=abs($oOperation->getSumma());
							}
						}
					
						$aObjects[$oZayvka['user_id']]['user']=$oUser;
						$aObjects[$oZayvka['user_id']]['playertournament']=$oPlayerTournament;
					}
					//$aUser=$this->User_GetUsersByArrayId($Users);
				
					
					$oViewer->Assign('aObjects',$aObjects);
				}
				
			$oViewer->Assign('Tournament',$tournament_id);
			$oViewer->Assign('oTournament',$oTournament);
			//$oViewer->Assign('aComments',$aComments);
			//$sTextResult=$oViewer->Fetch("block.stream_comment.tpl");
			$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."admins/admin_teams.tpl");
			$this->Viewer_AssignAjax('sText',$sTextResult);
		} else {
			$this->Message_AddErrorSingle('вы не админ турнира',$this->Lang_Get('attention'));
			return;
		}
	}

	protected function EventAuPlayers() {
	
		if (func_check(getRequest('tournament',null,'post'),'id',1,11))$tournament_id=getRequest('tournament',null,'post');
			
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {		
		
		$aTeams = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id' => $tournament_id, 
					'#with'         => array('team') 
					));
						
				$oViewer=$this->Viewer_GetLocalViewer();
				$oViewer->Assign('Tournament',$tournament_id);
				$oViewer->Assign('aTeams',$aTeams);
				
				$sTextResult=$oViewer->Fetch(Plugin::GetTemplatePath(__CLASS__)."admins/admin_players.tpl");
				$this->Viewer_AssignAjax('sText',$sTextResult);
			} else {
				$this->Message_AddErrorSingle('вы не админ',$this->Lang_Get('attention'));
				return;
			}
		
	}	
	/**
	 * Команды klaus
	 *
	 */
	protected function EventSettingTeam() { 
		if (!$this->oUserCurrent) {
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
			return;
		}

		$sText=getRequest('text',null,'post');
		$bSave=getRequest('save',null,'post');
		$Teams=getRequest('teams',null,'post');
		if (func_check(getRequest('tournament',null,'post'),'id',1,11))$tournament=getRequest('tournament',null,'post');		
		
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament);
		if($oTournament->getVznos()>0 /*&& 
			(!$this->PluginPurse_Purse_APICheckPay($this->oUserCurrent, 'tournament', $tournament) ) */){
			
			$aFilter = array(
						'user_id' => $this->oUserCurrent->GetUserId(),
						'operation_subject_type' => 'tournament',
						'operation_subject_id' => $oTournament->getTournamentId()
					);
			$aResult = $this->PluginLspurse_Purse_GetOperationByFilter($aFilter, 1, 1);
			$aOperations = $aResult['collection'];

			$oOperation = array_shift($aOperations);
			if( !$oOperation ){
				$this->Message_AddErrorSingle('этот турниры платный, вы не сделали взнос','Ошибка');
				return;
			}
			if(  abs($oOperation->getSumma()) < $oTournament->getVznos()){
				$this->Message_AddErrorSingle('этот турниры платный, вы не полностью внесли деньги, необходимо как минимум добавить '.($oTournament->getVznos() -abs($oOperation->getSumma()) ),'Ошибка');
				return;
			}
		}
		$this->PluginVs_Stat_CheckZayavkaTime($this->oUserCurrent->getId(), $tournament);		
		$this->PluginVs_Stat_DelZayavki($this->oUserCurrent->getId(), $tournament);

		$numbers=$Teams;
		$k=1;
		if($numbers!='null')
		foreach($numbers as $number){
			if(is_numeric($number))
			{
				$oZayavki =  Engine::GetEntity('PluginVs_Stat_Zayavki');
				$oZayavki->setUserId($this->oUserCurrent->GetUserId());	
				$oZayavki->setTournamentId($tournament);	
				$oZayavki->setTeamId($number);
				$oZayavki->setPrioritet($k);	
				$oZayavki->Add();
				$k++;
			}
		}
		$this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,array('PluginVs_ModuleStat_EntityZayavki_save'));	
		$this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,array('PluginVs_ModuleStat_EntityPlayertournament_save'));	
		
		$this->Message_AddNoticeSingle(" ","Saved");
	}
	
	protected function EventSettingPsn() { 
		if (!$this->oUserCurrent) {
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
			return;
		}
		$sText=getRequest('text',null,'post');
		$bSave=getRequest('save',null,'post');
		$PsnID=htmlspecialchars(getRequest('psnid',null,'post'));
		if (func_check(getRequest('tournament',null,'post'),'id',1,11))$tournament=getRequest('tournament',null,'post');		
		
		if($oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
					'user_id' => $this->oUserCurrent->GetUserId(),
					'tournament_id'         => $tournament					
				)))
		{
			//$this->PluginVs_Stat_CheckSetZayavkaTime($this->oUserCurrent->getId(), $tournament, $PsnID);
			$oPlayerTournament->setPsnid($PsnID);	
			$oPlayerTournament->Save();
			
			
			$this->Message_AddNoticeSingle(" ","Saved");
		}else{
			$oPlayerTournament =  Engine::GetEntity('PluginVs_Stat_Playertournament');
			$oPlayerTournament->setPsnid($PsnID);	
			$oPlayerTournament->setUserId($this->oUserCurrent->GetUserId());	
			$oPlayerTournament->setTournamentId($tournament);	
			$oPlayerTournament->setDates(date("Y-m-d H:i:s"));	
			$oPlayerTournament->Add();
			
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament);
			if($oTournament->getKnownTeams()==2){
				if( $aTeams = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id ' => $tournament,
					'#where' => array('ifnull(player_id,0) = (?d)' => array( 0)),
					))
				)
				{
					
					$d=0;
					foreach($aTeams as $oTeams) {
						$d++;
					}
					$d--;
					$random=rand(0,$d);
					$f=0;
					foreach($aTeams as $oTeams) {
						if($f==$random)$oTeam=$oTeams;
						$f++;
					}
		
					//$oTeam=$aTeams[$random];
					//$oTeam->setPlayerId($this->oUserCurrent->GetUserId());
					if($oTournamentTeam = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
						'tournament_id' => $tournament,
						'team_id' => $oTeam->getTeamId()
							)))
					{
						$oTournamentTeam->setPlayerId($this->oUserCurrent->GetUserId());
						$oTournamentTeam->Save();
					}
					
					
					$oZayavki =  Engine::GetEntity('PluginVs_Stat_Zayavki');
					$oZayavki->setUserId($this->oUserCurrent->GetUserId());	
					$oZayavki->setTournamentId($tournament);	
					$oZayavki->setTeamId($oTeam->getTeamId());
					$oZayavki->setPrioritet(1);	
					$oZayavki->Add();
				

				}
			}
			
			$this->Message_AddNoticeSingle(" ","Saved");
		}
		
	}
	
	protected function EventGetTovarkiTable() {
		if (func_check(getRequest('game_id',null,'post'),'id',1,11))$game_id=getRequest('game_id',null,'post');
		if (func_check(getRequest('gametype_id',null,'post'),'id',1,11))$gametype_id=getRequest('gametype_id',null,'post');
		if (func_check(getRequest('stavka',null,'post'),'id',1,4))$stavka=getRequest('stavka',null,'post');
		
		/*$aTovarki = $this->PluginVs_Stat_GetTovarkiItemsByFilter(array(
			'game_id' => $game_id,
			'gametype_id' => $gametype_id,
			'#with'         => array('user')
			));
			$oViewer=$this->Viewer_GetLocalViewer();	 
			$oViewer->Assign('aTovarki',$aTovarki); 
		*/
		$oViewer=$this->Viewer_GetLocalViewer();	
		$oGameType= $this->PluginVs_Stat_GetGametypeByGametypeId($gametype_id);
		$oGame= $this->PluginVs_Stat_GetGameByGameId($game_id);
		$oPlatform= $this->PluginVs_Stat_GetPlatformByPlatformId($oGame->getPlatformId()); 	 
	 
		 $this->Viewer_Assign('aStavka',$stavka);
		
		if($aMiniTurnirs = $this->PluginVs_Stat_GetMiniturnirItemsByFilter(array( 
			'gametype_id' => $oGameType->getGametypeId(),
			'game_id' => $oGame->getGameId(),
			'open' => '1',
			'stavka' => $stavka
		))
		){
			$oViewer->Assign('aMiniTurnirs',$aMiniTurnirs);				
		} 
		
		foreach ($aMiniTurnirs as $oMiniTurnir){
			if(!$oPlayerMiniturnir = $this->PluginVs_Stat_GetPlayerminiturnirByFilter(array( 
				'miniturnir_id' => $oMiniTurnir->getMiniturnirId(),
				'user_id' => $this->oUserCurrent->GetUserId()
			))
			){				
				$oPlayerMiniturnir_add =  Engine::GetEntity('PluginVs_Stat_Playerminiturnir');
				$oPlayerMiniturnir_add->setMiniturnirId($oMiniTurnir->getMiniturnirId());
				$oPlayerMiniturnir_add->setUserId($this->oUserCurrent->GetUserId());  	
				$oPlayerMiniturnir_add->Add();				
			} 
			$Miniturnir_array[]=$oMiniTurnir->getMiniturnirId();
		}
		$aPlayerMiniturnir = $this->PluginVs_Stat_GetPlayerminiturnirItemsByFilter(array( 
				'miniturnir_id in' => $Miniturnir_array,
				'user_id' => $this->User_GetUserCurrent()->GetUserId()
			));
		$oViewer->Assign('aPlayerMiniturnir',$aPlayerMiniturnir);
		$oViewer->Assign('oGame',$oGame);
		$this->Viewer_Assign('oGameType',$oGameType);
 
$sql="SELECT mt.miniturnir_id, sum(case when pm.status in (1,2,3) then 1 else 0 end) as users ,
sum(case when pm.status=1 then 1 else 0 end) as status_1,
sum(case when pm.status=2 then 1 else 0 end) as status_2,
sum(case when pm.status=3 then 1 else 0 end) as status_3,
sum(case when pm.status=4 then 1 else 0 end) as status_4
FROM `tis_stat_miniturnir` mt 
left join  `tis_stat_playerminiturnir` pm
	on pm.miniturnir_id=mt.miniturnir_id
	and pm.oplatil=1 
WHERE   mt.game_id='".$oGame->getGameId()."'
	and mt.gametype_id='".$oGameType->getGametypeId()."' 
	and mt.open=1
group by mt.miniturnir_id";
 /*
		$sql="SELECT pm.miniturnir_id, count(*) as users 
				FROM `tis_stat_playerminiturnir` pm, `tis_stat_miniturnir` mt 
				WHERE pm.status in (1,3) and pm.oplatil=1 
				and pm.miniturnir_id=mt.miniturnir_id
				and mt.game_id='".$oGame->getGameId()."' and mt.gametype_id='".$oGameType->getGametypeId()."' and mt.open=1
				group by pm.miniturnir_id
			union
			SELECT mt.miniturnir_id, 0 as users 
				FROM  `tis_stat_miniturnir` mt 
				WHERE   mt.game_id='".$oGame->getGameId()."' and mt.gametype_id='".$oGameType->getGametypeId()."' and mt.open=1
				and not exists (select distinct 1 from tis_stat_playerminiturnir where miniturnir_id=mt.miniturnir_id and status in (1,3) and oplatil=1)
				 ";		*/				 
		$aGamers=$this->PluginVs_Stat_GetAll($sql);
		if($aGamers)
		foreach ($aGamers as $oGamers){
			$gamers[$oGamers['miniturnir_id']]=$oGamers['users'];
			$gamers_1[$oGamers['miniturnir_id']]=$oGamers['status_1'];
			$gamers_2[$oGamers['miniturnir_id']]=$oGamers['status_2'];
			$gamers_3[$oGamers['miniturnir_id']]=$oGamers['status_3'];
		}
		
		$oViewer->Assign('gamers',$gamers);
		$oViewer->Assign('gamers_1',$gamers_1);
		$oViewer->Assign('gamers_2',$gamers_2);
		$oViewer->Assign('gamers_3',$gamers_3);
		
		$aMatches=$this->PluginVs_Stat_GetMatchesItemsByFilter(array(
			'miniturnir_id in' => $Miniturnir_array,	
			'played'=> '0',
			'#where' => array('(home_player = (?d) or away_player = (?d) )  ' => array($this->oUserCurrent->GetUserId(), $this->oUserCurrent->GetUserId())),
			'#with'         => array('hometeam','awayteam','homeuser','awayuser')
		));
		$oViewer->Assign('aMatches',$aMatches);

		if(!$oTovarki = $this->PluginVs_Stat_GetTovarkiByFilter(array(
		'game_id' => $oGame->getGameId(),
		'gametype_id' => $oGameType->getGametypeId(),
		'user_id' => $this->oUserCurrent->GetUserId()		
		))
		){
			$oViewer->Assign('NoProfile',1);					
		}	 
		
		
		$sTextResult=$oViewer->Fetch("block.tovarki_table.tpl");
		$this->Viewer_AssignAjax('sText',$sTextResult);
		
			
	}
	protected function EventSettingTovarki() { 
		if (!$this->oUserCurrent) {
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
			return;
		}
		$sText=getRequest('text',null,'post');
		$bSave=getRequest('save',null,'post');
		$PsnID=htmlspecialchars(getRequest('psnid',null,'post'));
		$datestart=htmlspecialchars(getRequest('datestart','00:00','post'));
		$dateend=htmlspecialchars(getRequest('dateend','00:00','post'));
		$wantplay=0;
		
		if (func_check(getRequest('game_id',null,'post'),'id',1,11))$game_id=getRequest('game_id',null,'post');
		if (func_check(getRequest('gametype_id',null,'post'),'id',1,11))$gametype_id=getRequest('gametype_id',null,'post');
		if (func_check(getRequest('wantplay',null,'post'),'id',1,11))$wantplay=getRequest('wantplay',null,'post');
		
		if($oTovarki = $this->PluginVs_Stat_GetTovarkiByFilter(array(
					'user_id' => $this->oUserCurrent->GetUserId(),
					'game_id'         => $game_id,
					'gametype_id'     => $gametype_id
				)))
		{
			//$this->PluginVs_Stat_CheckSetZayavkaTime($this->oUserCurrent->getId(), $tournament, $PsnID);
			$oTovarki->setPsnid($PsnID);
			$oTovarki->setTimeStart($datestart);
			$oTovarki->setTimeEnd($dateend);	
			$oTovarki->setWant($wantplay);				
			
			$oTovarki->Save();
			$this->Message_AddNoticeSingle(" ","Saved");
		}else{
			$oTovarki =  Engine::GetEntity('PluginVs_Stat_Tovarki');
			$oTovarki->setUserId($this->oUserCurrent->GetUserId());	
			$oTovarki->setGameId($game_id);
			$oTovarki->setGametypeId($gametype_id);
			$oTovarki->setPsnid($PsnID);
			$oTovarki->setTimeStart($datestart);
			$oTovarki->setTimeEnd($dateend);	
			$oTovarki->setWant($wantplay);
			$oTovarki->Add();
			$this->Message_AddNoticeSingle(" ","Saved");
		}
		
	}

	protected function EventDeleteHutTeam(){
		if (!$this->oUserCurrent) {
				$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
				return;
			}
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');	
		if($oTeam = $this->PluginVs_Stat_GetTeamByFilter(array(
						'owner_id' => $this->oUserCurrent->GetUserId(),
						'team_id'         => $team_id
					)))
			{
				if(!$aMatches=$this->PluginVs_Stat_GetMatchesItemsByFilter(array( 
					'#where' => array('(home = (?d) or away = (?d) ) ' => array($oTeam->getTeamId(),$oTeam->getTeamId())) 
				  ))  )
				 {
					
					if(!$aTeamPrioritet = $this->PluginVs_Stat_GetZayavkiItemsByFilter(array(
						'team_id' => $oTeam->getTeamId()
						
					)) ){
						if(!$aTeamPrioritet = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
						'team_id' => $oTeam->getTeamId(),
						'player_id <>'=>'0'
						
						)) ){
							$oTeam->Delete();
						}else{					
							$this->Message_AddErrorSingle('Данная команда кому то присвоена, нужно попросить админа отвязать её.',$this->Lang_Get('error'));
						}
						

					}else{					
						$this->Message_AddErrorSingle('Данная команды была добавлена в приоритеты, сначала удалите её из приоритетов.',$this->Lang_Get('error'));
					}
					
				}else{
					$this->Message_AddErrorSingle('Данная команды была заявлена хотя бы на один матч, мы не можем её удалить',$this->Lang_Get('error'));
				}			
			}
	}			
	protected function EventSettingHutTeam(){
		if (!$this->oUserCurrent) {
				$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
				return;
			}
		$team_logo="";
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if (func_check(getRequest('sport_id',null,'post'),'id',1,11))$sport_id=getRequest('sport_id',null,'post');
		if (func_check(getRequest('gametype_id',null,'post'),'id',1,11))$gametype_id=getRequest('gametype_id',null,'post');
		if (func_check(getRequest('game_id',null,'post'),'id',1,11))$game_id=getRequest('game_id',null,'post');
		if (func_check(getRequest('team_name',null,'post'),'text',1,40))$team_name=getRequest('team_name',null,'post');
		if (func_check(getRequest('team_logo',null,'post'),'text',1,20))$team_logo=getRequest('team_logo',null,'post');
		if (func_check(getRequest('team_brief',null,'post'),'text',1,10))$team_brief=getRequest('team_brief',null,'post');
		if ($team_id==0){
			if(!$oTeam = $this->PluginVs_Stat_GetTeamByFilter(array(
						'owner_id' => $this->oUserCurrent->GetUserId(),
						'name'         => $team_name,
						'gametype_id' => $gametype_id,
						'game_id' => $game_id,
						'sport_id' => $sport_id
					)))
			{
				$oTeam =  Engine::GetEntity('PluginVs_Stat_Team');
					
				$oTeam->setSportId($sport_id);	
				$oTeam->setGametypeId($gametype_id);	
				$oTeam->setGameId($game_id);
				$oTeam->setName($team_name);	
				$oTeam->setShortname($team_name);	
				$oTeam->setBrief($team_brief);	
				$oTeam->setLogo($team_logo);
				$oTeam->setSmalllogo($team_logo); 
				$oTeam->setOwnerId($this->oUserCurrent->GetUserId());			
				$oTeam->Add();
			}else{
				$this->Message_AddErrorSingle('у вас уже зарегистрирована команда с таким названием',$this->Lang_Get('error'));
			}
		}else{
			if($oTeam = $this->PluginVs_Stat_GetTeamByFilter(array(
						'owner_id' => $this->oUserCurrent->GetUserId(),
						'team_id'         => $team_id
					)))
			{
				if(!$aMatches=$this->PluginVs_Stat_GetMatchesItemsByFilter(array( 
					'#where' => array('(home = (?d) or away = (?d) ) ' => array($oTeam->getTeamId(),$oTeam->getTeamId())) 
				  ))  )
				 {
					$oTeam->setName($team_name);	
					$oTeam->setShortname($team_name);	
					$oTeam->setBrief($team_brief);	
					$oTeam->setLogo($team_logo);
					$oTeam->setSmalllogo($team_logo);
					$oTeam->Save();
				}else{
					
					$oTeam->setLogo($team_logo);
					$oTeam->setSmalllogo($team_logo);
					$oTeam->Save();
					$this->Message_AddErrorSingle('команда заявлена как минимум в один матч, смена названия и аббревиатуры невозможно, только логотипа',$this->Lang_Get('error'));
				}
				
				
			}
		
		
		}
	
	}

	protected function EventGetVyzov() { 
		if (!$this->oUserCurrent) {
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
			return;
		} 
		if (func_check(getRequest('vyzov_id',null,'post'),'id',1,11))$vyzov_id=getRequest('vyzov_id',null,'post');
		
		$oVyzov=$this->PluginVs_Stat_GetVyzovByVyzovId($vyzov_id);
		$this->Viewer_AssignAjax('user1_name',$oVyzov->getUser1()->getLogin());
		$this->Viewer_AssignAjax('user2_name',$oVyzov->getUser2()->getLogin());
		$this->Viewer_AssignAjax('comment',$oVyzov->getComment());
		$this->Viewer_AssignAjax('comment2',$oVyzov->getComment2());
		$this->Viewer_AssignAjax('bid',$oVyzov->getBid());
		$this->Viewer_AssignAjax('coef',$oVyzov->getCoef());
	}
	
	protected function EventSetVyzovOtvet() { 
		if (!$this->oUserCurrent) {
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
			return;
		}
		
		
		$comment2='';
		$otvet=0; 
		if (func_check(getRequest('otvet',null,'post'),'id',1,1))$otvet=getRequest('otvet',null,'post');
		if (func_check(getRequest('comment2',null,'post'),'text',1,450))$comment2=getRequest('comment2',null,'post');
		if (func_check(getRequest('vyzov_id',null,'post'),'id',1,11))$vyzov_id=getRequest('vyzov_id',null,'post');
		
		$oVyzov=$this->PluginVs_Stat_GetVyzovByVyzovId($vyzov_id);
		 
		$oVyzov->setComment2($this->Text_Parser($comment2));
		$oVyzov->setStatus($otvet);		
		$oVyzov->setDateOtvet(date("Y-m-d H:i:s"));
		$oVyzov->Save();
		if ($otvet==1){
			$num=0;
			$sql="select max(number) as num from tis_stat_matches where tournament_id='0' and game_id='".$oVyzov->getGameId()."' and gametype_id='".$oVyzov->getGametypeId()."' union select 0 as num order by num desc";
			if ($aNum=$this->PluginVs_Stat_GetAll($sql)) $num=$aNum[0]['num']; 
			
			
			$oMatch_add =  Engine::GetEntity('PluginVs_Stat_Matches');			
			$oMatch_add->setTournamentId(0);
			$oMatch_add->setRoundId(0);
			$oMatch_add->setGameId($oVyzov->getGameId());
			$oMatch_add->setGametypeId($oVyzov->getGametypeId());
			$oMatch_add->setDates(date("Y-m-d"));
			$oMatch_add->setHome(0);
			$oMatch_add->setAway(0);
			$oMatch_add->setHomeComment('');
			$oMatch_add->setAwayComment('');
			$oMatch_add->setBlogId(0);
			if(rand(0,1)>0.5){
				$oMatch_add->setHomePlayer($oVyzov->getUserId());
				$oMatch_add->setAwayPlayer($oVyzov->getUser2Id());
			}else{
				$oMatch_add->setHomePlayer($oVyzov->getUser2Id());
				$oMatch_add->setAwayPlayer($oVyzov->getUserId());		
			}
			$oMatch_add->setNumber($num);
			$oMatch_add->Add();
		}
		$this->Message_AddNoticeSingle(" ","Ответили");	
	}
	
	
	protected function EventSetVyzov() { 
		if (!$this->oUserCurrent) {
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
			return;
		}
		$sopernik='';
		$comment='';
		if (func_check(getRequest('game_id',null,'post'),'id',1,11))$game_id=getRequest('game_id',null,'post');
		if (func_check(getRequest('gametype_id',null,'post'),'id',1,11))$gametype_id=getRequest('gametype_id',null,'post');
		if (func_check(getRequest('sopernik',null,'post'),'text',1,40))$sopernik=getRequest('sopernik',null,'post');
		if (func_check(getRequest('comment',null,'post'),'text',1,450))$comment=getRequest('comment',null,'post');
		
		if($sopernik!=''){
			if (!($oSopernik=$this->User_GetUserByLogin($sopernik))) {
				$this->Message_AddErrorSingle('Паника',$this->Lang_Get('error'));
				return;
			}
		}
		$oVyzov =  Engine::GetEntity('PluginVs_Stat_Vyzov');
		$oVyzov->setUserId($this->oUserCurrent->GetUserId());	
		$oVyzov->setUser2Id($oSopernik->getUserId());
		$oVyzov->setComment($this->Text_Parser($comment));
		$oVyzov->setGameId($game_id);
		$oVyzov->setGametypeId($gametype_id);
		$oVyzov->setDateZapros(date("Y-m-d H:i:s"));
		$oVyzov->Add();
		$this->Message_AddNoticeSingle(" ","Вызвали");	
	}
	
	protected function EventPerenosSet() { 
		if (!$this->oUserCurrent) {
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
			return;
		}
		
		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');
		if (func_check(getRequest('perenos_time',null,'post'),'text',1,40))$perenos_time=getRequest('perenos_time',null,'post');
		
		$time=substr($perenos_time,6,4)."-".substr($perenos_time,3,2)."-".substr($perenos_time,0,2)." ".substr($perenos_time,13,5);
		
		 
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		if (isTournamentAdmin($oMatch->getTournamentId(),$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) 
		{
			$oMatch->setDates($time);
			if($oMatch->getTimetoplay()!="0000-00-00 00:00:00")$oMatch->setTimetoplay($time);
			$oMatch->Save();
			$this->Message_AddNoticeSingle(" ","Saved");	
		}else{
			$this->Message_AddNoticeSingle(" ","У вас нет прав");	
		}
		
	}
	
	protected function EventSettingMatchTime() { 
		if (!$this->oUserCurrent) {
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
			return;
		}
		if (func_check(getRequest('match_id',null,'post'),'id',1,11))$match_id=getRequest('match_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		
		$suggestion_text="";
		if (func_check(getRequest('suggestion_time',null,'post'),'text',1,40))$suggestion_time=getRequest('suggestion_time',null,'post');
		if (func_check(getRequest('suggestion_text',null,'post'),'text',1,350))$suggestion_text=getRequest('suggestion_text',null,'post');
		
		$time=substr($suggestion_time,6,4)."-".substr($suggestion_time,3,2)."-".substr($suggestion_time,0,2)." ".substr($suggestion_time,13,5);
		
		$sopernik=0;
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		if($oMatch->getHome()==$team_id)$sopernik=$oMatch->getAway();
		if($oMatch->getAway()==$team_id)$sopernik=$oMatch->getHome();
		if($sopernik!=0){
			$oMatchTime =  Engine::GetEntity('PluginVs_Stat_Matchtime');
			$oMatchTime->setPlayerId($this->oUserCurrent->GetUserId());	
			$oMatchTime->setMatchId($match_id);
			$oMatchTime->setTeamId($team_id);
			$oMatchTime->setComment($suggestion_text);
			$oMatchTime->setTimes($time);
			$oMatchTime->setTeam2Id($sopernik);
			$oMatchTime->setComment2('');
			$oMatchTime->setLogTime(date("Y-m-d H:i:s"));
			$oMatchTime->Add();
			
			if($oSopernik = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
					'team_id' => $sopernik,
					'player_id <>' => '0',
					'tournament_id' => $oMatch->getTournamentId()//,
					//'round_id'     => $oMatch->getRoundId()
				))){
				
					$aUsers=array();
					$oUserTarget=$this->User_GetUserById($oSopernik->getPlayerId());
					$aUsers[0]=$oUserTarget;
					
					$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());
					
					$oBlog=$this->Blog_GetBlogById($oTournament->getBlogId());		
					
					$link=$oTournament->getUrlFull()."match/".$match_id."/"; //$oBlog->getUrlFull()."turnir/".$oTournament->getUrl()."/_match/".$match_id;
					$oTalk=$this->Talk_SendTalk('Time suggestion','To see suggestion time please go to <a href="'.$link.'">link</a>',$this->oUserCurrent,$aUsers);
				}elseif($aSopernik = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
					'team_id' => $sopernik,
					'cap <>' => '0',
					'tournament_id' => $oMatch->getTournamentId(),
					'#with'        => array('user')
				))  ){
					$aUsers=array();
					foreach ($aSopernik as $oSopernik){
						$aUsers[]=$oSopernik->getUser();
					}
					//$oUserTarget=$this->User_GetUserById($oSopernik->getPlayerId());
					//$aUsers[0]=$oUserTarget;
					
					$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());
					
					$oBlog=$this->Blog_GetBlogById($oTournament->getBlogId());		
					
					$link=$oTournament->getUrlFull()."match/".$match_id."/"; // $oBlog->getUrlFull()."turnir/".$oTournament->getUrl()."/_match/".$match_id;
					$oTalk=$this->Talk_SendTalk('Time suggestion','To see suggestion time please go to <a href="'.$link.'">link</a>',$this->oUserCurrent,$aUsers);
				
				
				
				}
				
				
			$this->Message_AddNoticeSingle(" ","Saved");	
		}else{
			$this->Message_AddErrorSingle('не удалось найти соперника, сообщите администратору',$this->Lang_Get('error'));
		}
		
	
		
	}
	protected function EventSettingMatchTimeOtvet() { 
		if (!$this->oUserCurrent) {
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
			return;
		}
		if (func_check(getRequest('id',null,'post'),'id',1,11))$id=getRequest('id',null,'post');
		
		$suggestion_text="";
		if (func_check(getRequest('whats',null,'post'),'text',1,40))$whats=getRequest('whats',null,'post');
		if (func_check(getRequest('suggestion_text',null,'post'),'text',1,350))$suggestion_text=getRequest('suggestion_text',null,'post');
		
		
		$title="";
		if($oMatchTime = $this->PluginVs_Stat_GetMatchtimeById($id) ){
			$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($oMatchTime->getMatchId());
			if($whats=='accept'){
				$oMatchTime->setStatus(1);
				$title="Suggestion time '".$oMatchTime->getTimes()."' accepted";
				
				if($oMatch->getGametypeId()==3){
					
					
					if($oSparMatch = $this->PluginVs_Stat_GetMatchesByFilter(array(
						'home' => $oMatch->getAway(),
						'away' => $oMatch->getHome(),
						'dates' => $oMatch->getDates(),
						'tournament_id' => $oMatch->getTournamentId()
					)) ){
						$oSparMatch->setDates($oMatchTime->getTimes());
						$oSparMatch->setTimetoplay($oMatchTime->getTimes());
						$oSparMatch->Save();
					}
					$oMatch->setDates($oMatchTime->getTimes());
				}
				$oMatch->setTimetoplay($oMatchTime->getTimes());
				$oMatch->Save();
				
				if($aMatchTimes = $this->PluginVs_Stat_GetMatchtimeItemsByFilter(array(
					'match_id' => $oMatchTime->getMatchId(),
					'status'         => '0',
					'id !=' => $id
				))){
					foreach($aMatchTimes as $oMatchTimes){
						$oMatchTimes->setStatus(2);
						$oMatchTimes->Save();
					}
				
				}
				
			}
			if($whats=='deny'){
				$oMatchTime->setStatus(2);
				$title="Suggestion time '".$oMatchTime->getTimes()."' declined";
			}
			$oMatchTime->setComment2($suggestion_text);
			$oMatchTime->setPlayer2Id($this->oUserCurrent->GetUserId());
			$oMatchTime->setAnswerTime(date("Y-m-d H:i:s"));
			$oMatchTime->Save();
			
			$aUsers=array();
			
			if($aSopernik = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
					'team_id' => $oMatchTime->getTeamId(),
					'cap <>' => '0',
					'tournament_id' => $oMatch->getTournamentId(),
					'#with'        => array('user')
				))  ){
					$aUsers=array();
					foreach ($aSopernik as $oSopernik){
						$aUsers[]=$oSopernik->getUser();
					}
			}else{
				$oUserTarget=$this->User_GetUserById($oMatchTime->getPlayerId());
				$aUsers[0]=$oUserTarget;			
			}
			//$oBlog=$this->Blog_GetBlogByTournamentId($oMatch->getTournamentId());			
			//$link=Config::Get('path.root.web')."/".$oBlog->getPlatform()."/".$oBlog->getGame()."/".$oBlog->getGametype()."/".$oBlog->getBlogUrl()."/_match/".$oMatchTime->getMatchId();	
	
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());
			
			$oBlog=$this->Blog_GetBlogById($oTournament->getBlogId());		
			
			//$link=$oBlog->getUrlFull()."turnir/".$oTournament->getUrl()."/_match/".$oMatchTime->getMatchId();
			$link=$oTournament->getUrlFull()."match/".$oMatchTime->getMatchId()."/"; // $oBlog->getUrlFull()."turnir/".$oTournament->getUrl()."/_match/".$match_id;
			//$oTalk=$this->Talk_SendTalk('Согласование времени матча','Для просмотра предложенного времени пройдите по <a href="'.$link.'">ссылке</a>',$this->oUserCurrent,$aUsers);
		
				
			$oTalk=$this->Talk_SendTalk($title,'<a href="'.$link.'">Link</a> to suggestion time page',$this->oUserCurrent,$aUsers);
			
			$this->Message_AddNoticeSingle(" ","Saved");
		}
		
	
	}
	
//klaus
protected function EventWhoTopic() {
		$this->Viewer_SetResponseAjax('json');

		$idTopic=getRequest('id',null,'post');
		if (!($oTopic=$this->Topic_GetTopicById($idTopic))) {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'),$this->Lang_Get('error'));
			return;
		}
		
		$votes=array();
		$aVoters=array();

		$rating=$oTopic->getRating();
		$voters=$oTopic->getCountVote();

		//$dimensions = array('uid'=>1, "attitude"=>2, "login"=>"Klaus");
		$aVotes=$this->PluginVs_Vote_GetUserVotes("topic",$idTopic);
					
		$this->Viewer_AssignAjax('message','');
		$this->Viewer_AssignAjax('rating',$rating);
		$this->Viewer_AssignAjax('status','OK');
		$this->Viewer_AssignAjax('voters',$voters);
		$this->Viewer_AssignAjax('votes',$aVotes);
}
//klaus
protected function EventWhoComment() {
		$this->Viewer_SetResponseAjax('json');

		$idComment=getRequest('id',null,'post');
		if (!($oComment=$this->Comment_GetCommentById($idComment))) {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'),$this->Lang_Get('error'));
			return;
		}
		
		$votes=array();
		$aVoters=array();

		$rating=$oComment->getRating();
		$voters=$oComment->getCountVote();

		//$dimensions = array('uid'=>1, "attitude"=>2, "login"=>"Klaus");
		$aVotes=$this->PluginVs_Vote_GetUserVotes("comment",$idComment);
					
		$this->Viewer_AssignAjax('message','');
		$this->Viewer_AssignAjax('rating',$rating);
		$this->Viewer_AssignAjax('status','OK');
		$this->Viewer_AssignAjax('voters',$voters);
		$this->Viewer_AssignAjax('votes',$aVotes);
}	


protected function EventDeleteShedule() {
	if (func_check(getRequest('tournament',null,'post'),'id',1,11))$tournament_id=getRequest('tournament',null,'post');
	if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) 
	{
		$sql="select count(*) as kolvo from tis_stat_matches where tournament_id='".$tournament_id."' and played=1";
		if ($aNum=$this->PluginVs_Stat_GetAll($sql)) $kolvo=$aNum[0]['kolvo']; 
		
		if($kolvo==0){
			$aMatches=$this->PluginVs_Stat_GetMatchesItemsByFilter(array( 
				'played' => '0',
				'tournament_id' => $tournament_id 
			)); 
			foreach($aMatches as $oMatch){
				$oMatch->Delete();
			}
		
		}else {
			$this->Message_AddErrorSingle("существуют сыгранные матчи",$this->Lang_Get('attention'));
			return;
		}
	}
}
protected function EventCreateShedule() {
	$tournament_id=0;
	if (func_check(getRequest('tournament',null,'post'),'id',1,11))$tournament_id=getRequest('tournament',null,'post');
	if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) 
	{		
		//$tournament_id=9; 
		$with_your_group=1;
		$with_alien_group=1;
		$sparenno=0;
		$obratka=1;
		$round_id=0;
		$another_group_id=0;
		$group_id=0;
		$parentgroup_id=0;		
		$secret_team=999999; 
		$protivnik_group_id=0;
		
		$date[0]='27-11-2013';
		$date[1]='28-11-2013';
		$date[2]='29-11-2013';
		$date[3]='30-11-2013';
		$date[4]='01-12-2013';
		$date[5]='02-12-2013';
		$date[6]='03-12-2013';
		
		$k=0;
		$calendar = array();
		for($i=0; $i<=6; $i++)
		{
			if(trim($date[$i]) != '' ){
				$res=explode('-', $date[$i]);
				$calendar[$k]=mktime(0, 0, 0, $res[1], $res[0], $res[2]);
				$k++;
			}
		}
		if($group_id == 0 && $parentgroup_id ==0)
			$aTeams=$this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'round_id' => $round_id 
					));
		if($group_id != 0 && $parentgroup_id ==0)
			$aTeams=$this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'round_id' => $round_id, 
					'group_id'=> $group_id
					));
		
		if($group_id == 0 && $parentgroup_id !=0)
			$aTeams=$this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'round_id' => $round_id, 
					'parentgroup_id'=> $parentgroup_id
					));	
		if($group_id != 0 && $parentgroup_id !=0)
		$aTeams=$this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'round_id' => $round_id,
					'parentgroup_id'=> $parentgroup_id,
					'group_id'=> $group_id
					));
		
		if(count($aTeams) % 2==1 && $protivnik_group_id==0){
			$Team_add =  Engine::GetEntity('PluginVs_Stat_Teamsintournament');
			$Team_add->setTournamentId($tournament_id);
			$Team_add->setRoundId($round_id);
			$Team_add->setGroupId($group_id);
			$Team_add->setParentgroupId($parentgroup_id);
			$Team_add->setTeamId($secret_team);
			$Team_add->Add();		
		}
		
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
		
		if($this->oUserCurrent->GetUserId()==4)
		$matches=gen_rasp($tournament_id, $with_your_group, $with_alien_group, $calendar, $parentgroup_id, $group_id, $obratka, $protivnik_group_id);
		//$matches=gen_rasp_by_groups($tournament_id, $with_your_group, $with_alien_group, $calendar, $another_group_id, $group_id, $obratka);
 
/*		$oTeams=$this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
					'tournament_id' => $tournament_id,
					'round_id' => $round_id,
					'team_id' => $secret_team
					));
		if($oTeams)$oTeams->Delete();
*/
		$num=0;
		$sql="select max(number) as num from tis_stat_matches where tournament_id='".$tournament_id."' and round_id='".$round_id."' union select 0 as num";
		if ($aNum=$this->PluginVs_Stat_GetAll($sql)) $num=$aNum[0]['num']; 
		
		$sql="select id, team_id from tis_stat_teamsintournament where tournament_id='".$tournament_id."' and round_id='".$round_id."'";
		$aTeamintournament=$this->PluginVs_Stat_GetAll($sql);
		$aTeamtournament = array();
		foreach ($aTeamintournament as $oTeamintournament ) {
			$aTeamtournament[$oTeamintournament['id']] = $oTeamintournament['team_id'];
		}
		//print_r($aTeamtournament);
		
		$oTeams=$this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
					'tournament_id' => $tournament_id,
					'round_id' => $round_id,
					'team_id' => $secret_team
					));
		if($oTeams)$oTeams->Delete();
		
		$num=$num+1;
		foreach ($matches as $match ) {
			//if( $match['team1']==$team_id )$left++;
			//if( $match['team2']==$team_id )$right++;
			//echo $match['team1']."-".$match['team2']."-".date("Y-m-d", $match['date'])."<br/>";
			
			if($aTeamtournament[$match['team1']]!=$secret_team && $aTeamtournament[$match['team2']]!=$secret_team){
				$oMatch_add =  Engine::GetEntity('PluginVs_Stat_Matches');			
				$oMatch_add->setTournamentId($tournament_id);
				$oMatch_add->setRoundId($round_id);
				$oMatch_add->setGameId($oTournament->getGameId());
				$oMatch_add->setGametypeId($oTournament->getGametypeId());
				$oMatch_add->setDates(date("Y-m-d", $match['date']));
				$oMatch_add->setHome($aTeamtournament[$match['team1']]);
				$oMatch_add->setAway($aTeamtournament[$match['team2']]);
				$oMatch_add->setHomeTeamtournament($match['team1']);
				$oMatch_add->setAwayTeamtournament($match['team2']);
				$oMatch_add->setHomeComment('');
				$oMatch_add->setAwayComment('');
				$oMatch_add->setNumber($num);
				$oMatch_add->setBlogId($oTournament->getBlogId());
				$oMatch_add->Add();
				$num++;
				
				if($sparenno==1){
					$oMatch_add =  Engine::GetEntity('PluginVs_Stat_Matches');			
					$oMatch_add->setTournamentId($tournament_id);
					$oMatch_add->setRoundId('0');
					$oMatch_add->setGameId($oTournament->getGameId());
					$oMatch_add->setGametypeId($oTournament->getGametypeId());
					$oMatch_add->setDates(date("Y-m-d", $match['date']));
					$oMatch_add->setHome($aTeamtournament[$match['team2']]);
					$oMatch_add->setAway($aTeamtournament[$match['team1']]);
					$oMatch_add->setHomeTeamtournament($match['team2']);
					$oMatch_add->setAwayTeamtournament($match['team1']);
					$oMatch_add->setHomeComment('');
					$oMatch_add->setAwayComment('');
					$oMatch_add->setNumber($num);
					$oMatch_add->setBlogId($oTournament->getBlogId());
					$oMatch_add->Add();
					$num++;
				}
			}
		}
	
		$this->Message_AddNoticeSingle("расписание создано",$this->Lang_Get('attention'));
	} else {
		$this->Message_AddErrorSingle("не получилось",$this->Lang_Get('attention'));
		return;
	}
}
protected function EventCreateStatTable() {
	$this->Viewer_SetResponseAjax('json');
	if (func_check(getRequest('tournament',null,'post'),'id',1,11))$tournament_id=getRequest('tournament',null,'post');
	
	if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) {		
		/*$aTournamentStat = $this->PluginVs_Stat_GetTournamentstatItemsByFilter(array(
			'tournament_id' => $tournament_id
		));
		foreach($aTournamentStat as $oTournamentStat) {
			$oTournamentStat->delete();
		}
		
		$aTeamInTournament = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
			'tournament_id' => $tournament_id
		));
		foreach($aTeamInTournament as $oTeamInTournament) {
			$Stat_add =  Engine::GetEntity('PluginVs_Stat_Tournamentstat');
			$Stat_add->setTournamentId($oTeamInTournament->getTournamentId());
			$Stat_add->setRoundId($oTeamInTournament->getRoundId());
			$Stat_add->setGroupId($oTeamInTournament->getGroupId());
			$Stat_add->setParentgroupId($oTeamInTournament->getParentgroupId());
			$Stat_add->setTeamId($oTeamInTournament->getTeamId());
			$Stat_add->Add();
		}*/
		$this->EventCreateStatTableByTournamentRound($tournament_id,0);
		
		$this->Message_AddNoticeSingle("турнирная таблица создана",$this->Lang_Get('attention'));
	} else {
		$this->Message_AddErrorSingle("не получилось",$this->Lang_Get('attention'));
		return;
	}
}

	
	

	
	protected function EventCreateStatTableByTournamentRound($tournament_id,$round_id) {
	
		$aTournamentStat = $this->PluginVs_Stat_GetTournamentstatItemsByFilter(array(
			'tournament_id' => $tournament_id,
			'round_id' => $round_id
		));
		/*foreach($aTournamentStat as $oTournamentStat) {
			$oTournamentStat->delete();
		}*/
		if(!$aTournamentStat)
		{
			if($round_id != 100)
			{
				$aTeamInTournament = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'round_id' => $round_id
				));
				foreach($aTeamInTournament as $oTeamInTournament) {
					$Stat_add =  Engine::GetEntity('PluginVs_Stat_Tournamentstat');
					$Stat_add->setTournamentId($oTeamInTournament->getTournamentId());
					$Stat_add->setRoundId($oTeamInTournament->getRoundId());
					$Stat_add->setGroupId($oTeamInTournament->getGroupId());
					$Stat_add->setParentgroupId($oTeamInTournament->getParentgroupId());
					$Stat_add->setTeamId($oTeamInTournament->getTeamId());
					$Stat_add->Add();
				}
			}	
			if($round_id == 100)
			{
				$aTeamInTournament = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id' => $tournament_id
				));
				foreach($aTeamInTournament as $oTeamInTournament) {
					$Stat_add =  Engine::GetEntity('PluginVs_Stat_Tournamentstat');
					$Stat_add->setTournamentId($oTeamInTournament->getTournamentId());
					$Stat_add->setRoundId('100');
					$Stat_add->setGroupId($oTeamInTournament->getGroupId());
					$Stat_add->setParentgroupId($oTeamInTournament->getParentgroupId());
					$Stat_add->setTeamId($oTeamInTournament->getTeamId());
					$Stat_add->Add();
				}
			}
		}
	}

	
	/*
			params['tournament_id']={/literal}{$tournament_id} {literal};
			params['known_teams']=$('known_teams').value;
			params['league_name']=$('league_name').value;
			params['league_pass']=$('league_pass').value;
			params['win']=$('win').value;
			if($('exist_o').checked){params['exist_o']=1;}else{params['exist_o']=0;}
			params['win_o']=$('win_o').value;
			params['lose_o']=$('lose_o').value;
			if($('exist_b').checked){params['exist_b']=1;}else{params['exist_b']=0;}
			params['win_b']=$('win_b').value;
			params['lose_b']=$('lose_b').value;
			if($('exist_n').checked){params['exist_n']=1;}else{params['exist_n']=0;}
			params['points_n']=$('points_n').value;
			if($('zakryto').checked){params['zakryto']=1;}else{params['zakryto']=0;}
			params['goals_teh_w']=$('goals_teh_w').value;
			params['goals_teh_l']=$('goals_teh_l').value;
			params['goals_teh_n']=$('goals_teh_n').value;
			if($('zavershen').checked){params['zavershen']=1;}else{params['zavershen']=0;}
	*/
	
	protected function EventDeleteLogo() {
		$tournament_id=0;
		$blog_id=0;
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('blog_id',null,'post'),'id',1,11))$blog_id=getRequest('blog_id',null,'post');
		if (func_check(getRequest('logo_type',null,'post'),'text',1,110))$logo_type=getRequest('logo_type',null,'post');
		
		
		if($tournament_id<>0){
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
			if($logo_type=='small_logo'){
				$this->Image_RemoveFile(Config::Get('path.images.tournament') . '/'.$oTournament->getUrl(). '/'.$oTournament->getLogoSmall());
				$oTournament->setLogoSmall('');
			}
			if($logo_type=='full_logo'){
				$this->Image_RemoveFile(Config::Get('path.images.tournament') . '/'.$oTournament->getUrl(). '/'.$oTournament->getLogoFull());
				$oTournament->setLogoFull('');
			}
			$oTournament->Save();
		}

		if($blog_id<>0){
			$oBlog=$this->Blog_GetBlogById($blog_id);
			if($logo_type=='small_logo'){
				$this->Image_RemoveFile(Config::Get('path.images.blog') . '/'.$oBlog->getUrl(). '/'.$oBlog->getLogoSmall());
				$oBlog->setLogoSmall('');
				$this->Blog_SetLogos($oBlog,'small');
			}
			if($logo_type=='full_logo'){
				$this->Image_RemoveFile(Config::Get('path.images.blog') . '/'.$oBlog->getUrl(). '/'.$oBlog->getLogoFull());
				$oBlog->setLogoFull(''); 
				$this->Blog_SetLogos($oBlog,'full');
			}
			if($logo_type=='team_logo'){
				$this->Image_RemoveFile(Config::Get('path.images.blog') . '/'.$oBlog->getUrl(). '/'.$oBlog->getLogoTeam());
				$oBlog->setLogoTeam(''); 
				$this->Blog_SetLogos($oBlog,'team');
			}
			
			if( $oBlog->getTeamId()!=0 && $oTeam = $this->PluginVs_Stat_GetTeamByTeamId( $oBlog->getTeamId() )) {
				$sFileTmpPath_big = Config::Get('path.images.teams') . '/';
				$sFileTmpPath_small = Config::Get('path.images.teams') . '/small/';
				$sFileTmpPath_team = Config::Get('path.images.teams') . '/teamplay/';
				
				if ($logo_type =='full_logo'){
					$sFileTmpPath = Config::Get('path.images.teams') . '/';
				}elseif ($logo_type =='small_logo'){
					$sFileTmpPath = Config::Get('path.images.teams') . '/small/';
				}elseif ($logo_type =='team_logo'){
					$sFileTmpPath = Config::Get('path.images.teams') . '/teamplay/';
				}
				$sFile = $this->Image_SaveFile($sFileTmp, $sFileTmpPath, 'team_'.$oBlog->getTeamId().'.png');
				
				if ($logo_type =='full_logo'){
					copy($sFileTmpPath_big.'000_CH.png', $sFileTmpPath_big.'team_'.$oBlog->getTeamId().'.png');
				}
				if ($logo_type =='small_logo'){
					copy($sFileTmpPath_small.'000_CH.png', $sFileTmpPath_small.'team_'.$oBlog->getTeamId().'.png');
				}
				if ($logo_type =='team_logo'){
					copy($sFileTmpPath_team.'000_CH.png', $sFileTmpPath_team.'team_'.$oBlog->getTeamId().'.png');
				}
			}
		
		
		}
		
		
	}
	
	protected function EventUploadLogo() {
		$tournament_id=0;
		$blog_id=0;
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('blog_id',null,'post'),'id',1,11))$blog_id=getRequest('blog_id',null,'post');
		if (func_check(getRequest('logo_type',null,'post'),'text',1,110))$logo_type=getRequest('logo_type',null,'post');
		
		if($tournament_id<>0){
		
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
	 
			if (isset($_FILES['tournament_'.$logo_type]) and is_uploaded_file($_FILES['tournament_'.$logo_type]['tmp_name'])) {
			if ($_FILES['tournament_'.$logo_type]['type'] != "image/png") { 
				//error code here. 
				$this->Message_AddErrorSingle("Only Png files",$this->Lang_Get('attention'));
				return;
			}
				if ($sPath=$this->UploadLogo($_FILES['tournament_'.$logo_type], $oTournament->getUrl(),$logo_type, 'tournament', 0)) {
					if($logo_type=='small_logo')$oTournament->setLogoSmall($sPath);
					if($logo_type=='full_logo')$oTournament->setLogoFull($sPath);
					$oTournament->Save(); 
				}
			}
		}
		if($blog_id<>0){
			$oBlog=$this->Blog_GetBlogById($blog_id);
			if (isset($_FILES['blog_'.$logo_type]) and is_uploaded_file($_FILES['blog_'.$logo_type]['tmp_name'])) {
				
				if ($_FILES['blog_'.$logo_type]['type'] != "image/png") { 
					//error code here. 
					$this->Message_AddErrorSingle("Only Png files ",$this->Lang_Get('attention'));
					return;
				}
			
				if ($sPath=$this->UploadLogo($_FILES['blog_'.$logo_type], $oBlog->getUrl(),$logo_type, 'blog', $oBlog->getTeamId() )) {
					if($logo_type=='small_logo'){
						$oBlog->setLogoSmall($sPath);
						$this->Blog_SetLogos($oBlog,'small');
					}
					if($logo_type=='full_logo'){
						$oBlog->setLogoFull($sPath);
						$this->Blog_SetLogos($oBlog,'full');
					}
					if($logo_type=='team_logo'){
						$oBlog->setLogoTeam($sPath);
						$this->Blog_SetLogos($oBlog,'team');
					}
					if($oBlog->getTeamId() && $oTeam = $this->PluginVs_Stat_GetTeamByTeamId( $oBlog->getTeamId() )){
						$oTeam->setLogo('team_'.$oBlog->getTeamId().'.png');
						$oTeam->Save();
					}
				}
			}
		}
		
	}
	public function UploadLogo($aFile, $dir_name,$logo_type, $type, $team_id=0)
    {
        if (!is_array($aFile) || !isset($aFile['tmp_name'])) {
            return false;
        }

        $sFileTmp = Config::Get('sys.cache.dir') . func_generator();

        $sFileTmpName = $aFile['name'];
        $sFileTmpPath = Config::Get('path.images.'.$type) . '/'.$dir_name. '/';

        if (!move_uploaded_file($aFile['tmp_name'], $sFileTmp)) {
            return false;
        }

        $oImage = $this->Image_CreateImageObject($sFileTmp);
        $sFile = $this->Image_SaveFile($sFileTmp, $sFileTmpPath, $logo_type.'_'.$sFileTmpName);
       
		
		if( $team_id!=0 && $oTeam = $this->PluginVs_Stat_GetTeamByTeamId( $team_id )) {
			$sFileTmpPath_big = Config::Get('path.images.teams') . '/';
			$sFileTmpPath_small = Config::Get('path.images.teams') . '/small/';
			$sFileTmpPath_team = Config::Get('path.images.teams') . '/teamplay/';
			
			if ($logo_type =='full_logo'){
				$sFileTmpPath = Config::Get('path.images.teams') . '/';
			}elseif ($logo_type =='small_logo'){
				$sFileTmpPath = Config::Get('path.images.teams') . '/small/';
			}elseif ($logo_type =='team_logo'){
				$sFileTmpPath = Config::Get('path.images.teams') . '/teamplay/';
			}
			$sFile = $this->Image_SaveFile($sFileTmp, $sFileTmpPath, 'team_'.$team_id.'.png');
			
			if (!file_exists($sFileTmpPath_big.'team_'.$team_id.'.png')) {
				copy($sFileTmpPath_big.'000_CH.png', $sFileTmpPath_big.'team_'.$team_id.'.png');
			}
			if (!file_exists($sFileTmpPath_small.'team_'.$team_id.'.png')) {
				copy($sFileTmpPath_small.'000_CH.png', $sFileTmpPath_small.'team_'.$team_id.'.png');
			}
			if (!file_exists($sFileTmpPath_team.'team_'.$team_id.'.png')) {
				copy($sFileTmpPath_team.'000_CH.png', $sFileTmpPath_team.'team_'.$team_id.'.png');
			}
		}
		$this->Image_RemoveFile($sFileTmp);
        return $logo_type.'_'.$sFileTmpName ; //str_replace(Config::Get('path.root.server'), '', $sFile);

    }
	
	protected function EventUpdateTournament() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('known_teams',null,'post'),'id',1,2))$known_teams=getRequest('known_teams',null,'post');
		if (func_check(getRequest('league_name',null,'post'),'text',1,110))$league_name=getRequest('league_name',null,'post');
		if (func_check(getRequest('league_pass',null,'post'),'text',1,110))$league_pass=getRequest('league_pass',null,'post');
		if (func_check(getRequest('prodlenie',null,'post'),'text',1,8))$prodlenie=getRequest('prodlenie',null,'post');
		
		if (func_check(getRequest('win',null,'post'),'id',1,3))$win=getRequest('win',null,'post');
		if (func_check(getRequest('lose',null,'post'),'id',1,3))$lose=getRequest('lose',null,'post');
		if (func_check(getRequest('exist_o',null,'post'),'id',1,3))$exist_o=getRequest('exist_o',null,'post');
		if (func_check(getRequest('win_o',null,'post'),'id',1,3))$win_o=getRequest('win_o',null,'post');
		if (func_check(getRequest('lose_o',null,'post'),'id',1,3))$lose_o=getRequest('lose_o',null,'post');
		if (func_check(getRequest('exist_b',null,'post'),'id',1,3))$exist_b=getRequest('exist_b',null,'post');
		if (func_check(getRequest('win_b',null,'post'),'id',1,3))$win_b=getRequest('win_b',null,'post');
		if (func_check(getRequest('lose_b',null,'post'),'id',1,3))$lose_b=getRequest('lose_b',null,'post');
		if (func_check(getRequest('exist_n',null,'post'),'id',1,3))$exist_n=getRequest('exist_n',null,'post');
		if (func_check(getRequest('points_n',null,'post'),'id',1,3))$points_n=getRequest('points_n',null,'post');
		if (func_check(getRequest('exist_yard',null,'post'),'id',1,3))$exist_yard=getRequest('exist_yard',null,'post');
		if (func_check(getRequest('zakryto',null,'post'),'id',1,3))$zakryto=getRequest('zakryto',null,'post');
		if (func_check(getRequest('goals_teh_w',null,'post'),'id',1,3))$goals_teh_w=getRequest('goals_teh_w',null,'post');
		if (func_check(getRequest('goals_teh_l',null,'post'),'id',1,3))$goals_teh_l=getRequest('goals_teh_l',null,'post');
		if (func_check(getRequest('goals_teh_n',null,'post'),'id',1,3))$goals_teh_n=getRequest('goals_teh_n',null,'post');
		if (func_check(getRequest('zavershen',null,'post'),'id',1,3))$zavershen=getRequest('zavershen',null,'post');
		if (func_check(getRequest('autosubmit',null,'post'),'id',1,3))$autosubmit=getRequest('autosubmit',null,'post');
		if (func_check(getRequest('submithours',null,'post'),'id',1,3))$submithours=getRequest('submithours',null,'post');
		
		if (func_check(getRequest('prolong',null,'post'),'id',1,11))$prolong=getRequest('prolong',null,'post');
		if (func_check(getRequest('waitlist',null,'post'),'id',1,11))$waitlist=getRequest('waitlist',null,'post');
		
		if (func_check(getRequest('show_full_stat_table',null,'post'),'id',1,4))$show_full_stat_table=getRequest('show_full_stat_table',null,'post');
		if (func_check(getRequest('show_parent_stat_table',null,'post'),'id',1,4))$show_parent_stat_table=getRequest('show_parent_stat_table',null,'post');
		if (func_check(getRequest('show_group_stat_table',null,'post'),'id',1,4))$show_group_stat_table=getRequest('show_group_stat_table',null,'post');
		if (func_check(getRequest('vznos',null,'post'),'id',1,3))$vznos=getRequest('vznos',null,'post');
		
		
		if($datestart=getRequest('datestart')) {
			if(func_check($datestart,'text',6,10) && substr_count($datestart,'/')==2) {
				list($m,$d,$y)=explode('/',$datestart);
				if(@checkdate($m,$d,$y)) {
					
					$datestart_string=$y.'-'.$m.'-'.$d;
				}
			}
		}	
		
		if($datezayavki=getRequest('datezayavki')) {
			if(func_check($datezayavki,'text',6,10) && substr_count($datezayavki,'/')==2) {
				list($m,$d,$y)=explode('/',$datezayavki);
				if(@checkdate($m,$d,$y)) {
					
					$datezayavki_string=$y.'-'.$m.'-'.$d;
				}
			}
		}	
		
		if($dateopenrasp=getRequest('dateopenrasp')) {
			if(func_check($dateopenrasp,'text',6,10) && substr_count($dateopenrasp,'/')==2) {
				list($m,$d,$y)=explode('/',$dateopenrasp);
				if(@checkdate($m,$d,$y)) {					
					$dateopenrasp_string=$y.'-'.$m.'-'.$d;
				}
			}
		}
		
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) 
		{
			if($oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id))
			{
				if(isset($known_teams))$oTournament->setKnownTeams($known_teams);
				if(isset($league_name))$oTournament->setLeagueName($league_name);
				if(isset($league_pass))$oTournament->setLeaguePass($league_pass);
				if(isset($win))$oTournament->setWin($win);
				if(isset($lose))$oTournament->setLose($lose);
				if(isset($exist_o))$oTournament->setExistO($exist_o);
				if(isset($win_o))$oTournament->setWinO($win_o);
				if(isset($lose_o))$oTournament->setLoseO($lose_o);
				if(isset($exist_b))$oTournament->setExistB($exist_b);
				if(isset($win_b))$oTournament->setWinB($win_b);
				if(isset($lose_b))$oTournament->setLoseB($lose_b);
				if(isset($exist_n))$oTournament->setExistN($exist_n);
				if(isset($points_n))$oTournament->setPointsN($points_n);
				if(isset($exist_yard))$oTournament->setExistYard($exist_yard);
				if(isset($zakryto))$oTournament->setZakryto($zakryto);
				if(isset($goals_teh_w))$oTournament->setGoalsTehW($goals_teh_w);
				if(isset($goals_teh_l))$oTournament->setGoalsTehL($goals_teh_l);
				if(isset($goals_teh_n))$oTournament->setGoalsTehN($goals_teh_n);
				if(isset($zavershen))$oTournament->setZavershen($zavershen);
				if(isset($autosubmit))$oTournament->setAutosubmit($autosubmit);
				if(isset($submithours))$oTournament->setSubmithours($submithours);
				if(isset($prodlenie))$oTournament->setProdlenie($prodlenie);
				if(isset($datestart_string))$oTournament->setDatestart($datestart_string);
				if(isset($datezayavki_string))$oTournament->setDatezayavki($datezayavki_string);
				if(isset($dateopenrasp_string))$oTournament->setDateopenrasp($dateopenrasp_string);
				if(isset($prolong))$oTournament->setProlongTopicId($prolong);
				if(isset($waitlist))$oTournament->setWaitlistTopicId($waitlist);
				
				if(isset($vznos))$oTournament->setVznos($vznos);
				
				if(isset($show_full_stat_table))$oTournament->setShowFullStatTable($show_full_stat_table);
				if(isset($show_parent_stat_table))$oTournament->setShowParentStatTable($show_parent_stat_table);
				if(isset($show_group_stat_table))$oTournament->setShowGroupStatTable($show_group_stat_table);
				$oTournament->Save();
			}			
		}
	}
	
	protected function EventDeleteAloneTeams() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) 
		{	
			$aTeams=$this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'player_id' => '0'
					));
			foreach($aTeams as $oTeam)
			{
				$oTeam->Delete();			
			}
			
		}		
	}
	protected function EventUpdateTournamentRating() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) 
		{		
			$aPlayerTournament= $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
								 'tournament_id'  => $tournament_id ));
			
			foreach($aPlayerTournament as $oPlayerTournament)
			{
				$oPlayerTournament->setTournamentRating('0');
				$oPlayerTournament->Save();
			}
			
			$aMatches=$this->PluginVs_Stat_GetMatchesItemsByFilter(array(
					'played'=> '1',
					'tournament_id' => $tournament_id 
			));
			$match_id=0;	
			foreach($aMatches as $oMatch)
			{
				//$this->PluginVs_Stat_CalcNewRating($oMatch->getMatchId()); 
				/*
				$this->PluginVs_Stat_CalcStat($oMatch->getMatchId());	
				$this->PluginVs_Stat_CalcPlayerStat($oMatch->getMatchId());	
				if($match_id==0)$match_id=$oMatch->getMatchId();
				*/
				$this->PluginVs_Stat_CalcPlayerStat($oMatch->getMatchId());	
				
			$oPlayerTournamentHome = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
								'user_id' => $oMatch->getHomePlayer(),
								'tournament_id'  => $oMatch->getTournamentId() ));
								
			$oPlayerTournamentAway = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
								'user_id' => $oMatch->getAwayPlayer(),
								'tournament_id'  => $oMatch->getTournamentId() ));
			
			$raznica=0;
			$W=0;
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0){$W=1; $raznica=$oMatch->getGoalsHome()-$oMatch->getGoalsAway();}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())==0)$W=0.5;		
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==1){$W=0.5; $raznica=1;}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getSo()==1){$W=0.5; $raznica=1;}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0)$W=0;
			
			$newHomerating = round( ($W + $raznica *0.01 )*0.8,2);
			
			//$newHomerating = round($oHomeRating->getRating(),2)+$G*$K * ( $W - 1/(pow(10,(-1)*($oHomeRating->getRating()-$oAwayRating->getRating())/400 ) +1));
			
			$raznica=0;
			$W=0;
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0){$W=1; $raznica=$oMatch->getGoalsAway()-$oMatch->getGoalsHome();}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())==0)$W=0.5;		
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==1){$W=0.5; $raznica=1;}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getSo()==1){$W=0.5; $raznica=1;}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0)$W=0;
			
			$newAwayrating = round( ($W + $raznica *0.01 )*0.8,2);
			//$newAwayrating = round($oAwayRating->getRating(),2)+$G*$K * ( $W - 1/(pow(10,(-1)*($oAwayRating->getRating()-$oHomeRating->getRating())/400 ) +1));
			
			$oMatch->setHomeNewRating( number_format(round($newHomerating,2),2, '.', '') );
			$oMatch->setAwayNewRating(   number_format(round($newAwayrating,2),2, '.', '') );
			$oMatch->Save();
			
			if($oPlayerTournamentHome){
				$oPlayerTournamentHome->setTournamentRating(  number_format( $oPlayerTournamentHome->getTournamentRating() + $newHomerating, 2, '.', '') );	 
				$oPlayerTournamentHome->Save();	
			}
			if($oPlayerTournamentAway){
				$oPlayerTournamentAway->setTournamentRating(  number_format( $oPlayerTournamentAway->getTournamentRating() + $newAwayrating, 2, '.', '') );	 
				$oPlayerTournamentAway->Save();
			}
			
			} 
			
		}
	}
	
	protected function EventUpdateStattable() {
		if (func_check(getRequest('tournament_id',null,'post'),'id',1,11))$tournament_id=getRequest('tournament_id',null,'post');
		if (func_check(getRequest('round_id',null,'post'),'id',1,11))$round_id=getRequest('round_id',null,'post');
		if (isTournamentAdmin($tournament_id,$this->User_IsAuthorization(), $this->oUserCurrent->GetUserId()) || $this->oUserCurrent->isAdministrator()) 
		{		
			
			 
			  
			$sql="select max(number) as num from tis_stat_matches where tournament_id='".$tournament_id."' union select 0 as num";
			if ($aNum=$this->PluginVs_Stat_GetAll($sql)) $id=$aNum[0]['num']; 
		 			  
			/*	 $sql="  
				SELECT p.dates, t.team_id AS home_team, t2.team_id AS away_team, p.goal2 AS home_goals, p.goal1 AS away_goals, 
				CASE WHEN p.OT =  'OT'
				THEN 1 
				ELSE 0 
				END AS ot, 
				CASE WHEN p.OT =  'SO'
				THEN 1 
				ELSE 0 
				END AS so, 
				CASE WHEN p.goal1 IS NULL 
				THEN 0 
				ELSE 1 
				END AS played
				FROM  `nba` p, tis_stat_team t, tis_stat_team t2
				WHERE p.team2 = t.name
				AND p.team1 = t2.name
				ORDER BY dates
				 ";
			*/
		/*	
			 $sql="  
				SELECT  p.dates,
				t.team_id as home_team,
				t2.team_id as away_team,
				p.goal2 as home_goals,
				p.goal1 as away_goals,
				case when p.OT='OT' then 1 else 0 end as ot,
				case when p.OT='SO' then 1 else 0 end as so,
				case when p.goal1 IS NULL then 0 else 1 end  as played

				FROM `pkhl` p,tis_stat_team t, tis_stat_team t2

				WHERE p.team2=t.brief
				and p.team1=t2.brief
				order by dates 
				 ";
				 
		$aMatches=$this->PluginVs_Stat_GetAll($sql);
		foreach($aMatches as $Match){
			
			$oMatch_add = null;
			$search = 1;
			$id++; 
			$dates	= $Match['dates'];
			$home_team	= $Match['home_team'];
			$away_team	= $Match['away_team'];
			$away_goals = $Match['away_goals'];
			$home_goals = $Match['home_goals'];
			$ot	= $Match['ot'];
			$so	= $Match['so'];
			$played	= $Match['played'];
			
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
			
			if($search==1){				
				$oMatch_add = $this->PluginVs_Stat_GetMatchesByFilter(array(
							'home' => $home_team,
							'away' => $away_team,
					//		'dates' => $dates,
							'tournament_id' => $tournament_id,
							'played' => 0
						));
			}		
			if($oMatch_add == null){		
				$oMatch_add =  Engine::GetEntity('PluginVs_Stat_Matches');			
				$oMatch_add->setTournamentId($tournament_id);
				$oMatch_add->setRoundId('0');
				$oMatch_add->setGameId($oTournament->getGameId());
				$oMatch_add->setGametypeId($oTournament->getGametypeId());
				$oMatch_add->setDates($dates);
				$oMatch_add->setHome($home_team);
				$oMatch_add->setAway($away_team);
				$oMatch_add->setHomeComment('');
				$oMatch_add->setAwayComment('');
				$oMatch_add->setNumber($id);
				$oMatch_add->setBlogId($oTournament->getBlogId());
				$oMatch_add->Add();
			}	
			$team_id = $home_team;
			$match_id = $oMatch_add->getMatchId();
			$oMatch=$this->PluginVs_Stat_GetMatchesByMatchId($match_id);
			$yard ='0';
			
			if($played=='1'){
				$oMatchResult_add =  Engine::GetEntity('PluginVs_Stat_Matchresult');
				$oMatchResult_add->setMatchId($match_id);
				$oMatchResult_add->setUserId($this->oUserCurrent->GetUserId());
				$oMatchResult_add->setTeamId($team_id);
				$oMatchResult_add->setAway($away_goals);
				$oMatchResult_add->setHome($home_goals);
				$oMatchResult_add->setComment('');
				$oMatchResult_add->setDates(date("Y-m-d H:i:s"));
				if(isset($ot))$oMatchResult_add->setOt($ot);
				if(isset($so))$oMatchResult_add->setSo($so);
				if(isset($zhaloba))$oMatchResult_add->setHome('');
				$oMatchResult_add->Add();				
				
				if($team_id!=0){
					if($oMatch->getHome()==$team_id){
						$oMatch->setHomeInsert(1); 
						$oMatch->Save();
					}
					if($oMatch->getAway()==$team_id){
						$oMatch->setAwayInsert(1); 
						$oMatch->Save();
					}
				}elseif($user_id!=0){
					if($oMatch->getHomePlayer()==$user_id){
						$oMatch->setHomeInsert(1); 
						$oMatch->Save();
					}
					if($oMatch->getAwayPlayer()==$user_id){
						$oMatch->setAwayInsert(1); 
						$oMatch->Save();
					}				
				}				
				$this->PluginVs_Stat_CheckResult($match_id);
				
				$team_id = $away_team;
				$match_id = $oMatch_add->getMatchId();
				$oMatchResult_add =  Engine::GetEntity('PluginVs_Stat_Matchresult');
				$oMatchResult_add->setMatchId($match_id);
				$oMatchResult_add->setUserId($this->oUserCurrent->GetUserId());
				$oMatchResult_add->setTeamId($team_id);
				$oMatchResult_add->setAway($away_goals);
				$oMatchResult_add->setHome($home_goals);
				$oMatchResult_add->setComment('');
				$oMatchResult_add->setDates(date("Y-m-d H:i:s"));
				if(isset($ot))$oMatchResult_add->setOt($ot);
				if(isset($so))$oMatchResult_add->setSo($so);
				if(isset($zhaloba))$oMatchResult_add->setHome('');
				$oMatchResult_add->Add();				
				if($team_id!=0){
					if($oMatch->getHome()==$team_id){
						$oMatch->setHomeInsert(1); 
						$oMatch->Save();
					}
					if($oMatch->getAway()==$team_id){
						$oMatch->setAwayInsert(1); 
						$oMatch->Save();
					}
				}elseif($user_id!=0){
					if($oMatch->getHomePlayer()==$user_id){
						$oMatch->setHomeInsert(1); 
						$oMatch->Save();
					}
					if($oMatch->getAwayPlayer()==$user_id){
						$oMatch->setAwayInsert(1); 
						$oMatch->Save();
					}				
				}				 
				$this->PluginVs_Stat_CheckResult($match_id);
			}
			
		}
		  */
		                         
			
			$aStats=$this->PluginVs_Stat_GetTournamentstatItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'round_id' => $round_id
					));
					
			foreach($aStats as $oStat)
			{
				$oStat->Delete();			
			}	
			
			$aStats=$this->PluginVs_Stat_GetPlayerstatItemsByFilter(array(
					'tournament_id' => $tournament_id,
					'round_id' => $round_id
					));
					
			$oStat = null;		
			if($aStats)		
			foreach($aStats as $oStat)
			{
				//if($oStat)$oStat->Delete();			
			}	

			$this->EventCreateStatTableByTournamentRound($tournament_id,$round_id);
				
			$aMatches=$this->PluginVs_Stat_GetMatchesItemsByFilter(array(
					'played'=> '1',
					'tournament_id' => $tournament_id,
					'round_id' => $round_id
			));
			$match_id=0;	
			//$fh = fopen('/www/virtualsports.ru/data.txt', 'w'); 
			foreach($aMatches as $oMatch)
			{
				
//fwrite($fh, $oMatch->getMatchId().'-'); 
				$this->PluginVs_Stat_CalcStat($oMatch->getMatchId());	
				//$this->PluginVs_Stat_CalcPlayerStat($oMatch->getMatchId());	
				if($match_id==0)$match_id=$oMatch->getMatchId();
			}
			if($match_id!=0)$this->PluginVs_Stat_CalcPosition($match_id);
		}
	}
	
	/**
	 * Получение новых комментариев
	 *
	 */
	protected function AjaxResponseComment() {
		$this->Viewer_SetResponseAjax('json');
		$idCommentLast=getRequest('idCommentLast');	
		$match_id=getRequest('idTarget');		
		/**
		 * Проверям авторизован ли пользователь
		 */
		if (!$this->User_IsAuthorization()) {
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
			return;			
		}
		/**
		 * Проверяем разговор
		 */
		/*if (!($oTalk=$this->Talk_GetTalkById(getRequest('idTarget')))) {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'),$this->Lang_Get('error'));
			return;
		}
		if (!($oTalkUser=$this->Talk_GetTalkUser($oTalk->getId(),$this->oUserCurrent->getId()))) {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'),$this->Lang_Get('error'));
			return;
		}*/
		if (!($oMatch=$this->PluginVs_Stat_GetMatchesByFilter(array(
			'match_id' => $match_id		))
			)){
				return;
		}
		if (!($oMatchUser=$this->PluginVs_Stat_GetMatchcommentByFilter(array(
			'match_id' => $match_id,
			'user_id' => $this->oUserCurrent->getId()))
			)){
				return;
		}
		
		$aReturn=$this->Comment_GetCommentsNewByTargetId($match_id,'match',$idCommentLast);
		$iMaxIdComment=$aReturn['iMaxIdComment'];
		
		$oMatchUser->setDateLast(date("Y-m-d H:i:s"));
		if ($iMaxIdComment!=0) {
			$oMatchUser->setCommentIdLast($iMaxIdComment);
		}
		$oMatchUser->setCommentCountNew(0);
		//$this->Talk_UpdateTalkUser($oTalkUser);
		$oMatchUser->Save();
		
		$aComments=array();
		$aCmts=$aReturn['comments'];
		if ($aCmts and is_array($aCmts)) {
			foreach ($aCmts as $aCmt) {
				$aComments[]=array(
					'html' => $aCmt['html'],
					'idParent' => $aCmt['obj']->getPid(),
					'id' => $aCmt['obj']->getId(),
				);
			}
		}
		$this->Viewer_AssignAjax('aComments',$aComments);
		$this->Viewer_AssignAjax('iMaxIdComment',$iMaxIdComment);
	}
	/**
	 * Обработка добавление комментария к топику через ajax
	 *
	 */
	protected function AjaxAddComment() {
		$this->Viewer_SetResponseAjax('json');
		$this->SubmitComment();
	}	
	/**
	 * Обработка добавление комментария к топику
	 *	 
	 * @return unknown
	 */
	protected function SubmitComment() {
		$match_id=getRequest('cmt_target_id');	
		/**
		 * Проверям авторизован ли пользователь
		 */
		if (!$this->User_IsAuthorization()) {
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
			return;			
		}
		if( in_array($this->oUserCurrent->getLogin(), Config::Get('module.user.shutup'))  ){
			$this->Message_AddErrorSingle('вам запрещено оставлять комментарии',$this->Lang_Get('error'));
			return;
		} 
		/**
		 * Проверяем разговор
		 */
		/*if (!($oTalk=$this->Talk_GetTalkById(getRequest('cmt_target_id')))) {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'),$this->Lang_Get('error'));
			return;
		}
		if (!($oTalkUser=$this->Talk_GetTalkUser($oTalk->getId(),$this->oUserCurrent->getId()))) {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'),$this->Lang_Get('error'));
			return;
		}	*/
		 if (!($oMatch=$this->PluginVs_Stat_GetMatchesByMatchId( $match_id	) ) ){
				return;
		}
		 
		if (!($oMatchUser=$this->PluginVs_Stat_GetMatchcommentByFilter(array(
			'match_id' => $match_id,
			'user_id' => $this->oUserCurrent->getId()))
			)){
				return;
		}
		 
		/**
		* Проверяем текст комментария
		*/
		$sText=$this->Text_Parser(getRequest('comment_text'));
		if (!func_check($sText,'text',2,3000)) {			
			$this->Message_AddErrorSingle($this->Lang_Get('talk_comment_add_text_error'),$this->Lang_Get('error'));
			return;
		}
 
		/**
		* Проверям на какой коммент отвечаем
		*/
		$sParentId=(int)getRequest('reply');
		if (!func_check($sParentId,'id')) {			
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'),$this->Lang_Get('error'));
			return;
		}
		$oCommentParent=null;
		if ($sParentId!=0) {
			/**
			* Проверяем существует ли комментарий на который отвечаем
			*/
			if (!($oCommentParent=$this->Comment_GetCommentById($sParentId))) {				
				$this->Message_AddErrorSingle($this->Lang_Get('system_error'),$this->Lang_Get('error'));
				return;
			}
			/**
			* Проверяем из одного топика ли новый коммент и тот на который отвечаем
			*/
			if ($oCommentParent->getTargetId()!=$oMatch->getMatchId()) {
				$this->Message_AddErrorSingle($this->Lang_Get('system_error'),$this->Lang_Get('error'));
				return;
			}
		} else {
			/**
			* Корневой комментарий
			*/
			$sParentId=null;
		}
		/**
		* Проверка на дублирующий коммент
		*/
		if ($this->Comment_GetCommentUnique($oMatch->getMatchId(),'match',$this->oUserCurrent->getId(),$sParentId,md5($sText))) {			
			$this->Message_AddErrorSingle($this->Lang_Get('topic_comment_spam'),$this->Lang_Get('error'));
			return;
		}
		/**
		* Создаём коммент
		*/
		$oCommentNew=Engine::GetEntity('Comment');
		$oCommentNew->setTargetId($oMatch->getMatchId());
		$oCommentNew->setTargetType('match');
		$oCommentNew->setUserId($this->oUserCurrent->getId());		
		$oCommentNew->setText($sText);
		$oCommentNew->setDate(date("Y-m-d H:i:s"));
		$oCommentNew->setUserIp(func_getIp());
		$oCommentNew->setPid($sParentId);
		$oCommentNew->setTextHash(md5($sText));
		$oCommentNew->setPublish(1);	
		/**
		* Добавляем коммент
		*/
		if ($this->Comment_AddComment($oCommentNew)) {
			$this->Viewer_AssignAjax('sCommentId',$oCommentNew->getId());
			$oMatch->setDateLast(date("Y-m-d H:i:s"));
			$oMatch->setCountComment( ($oMatch->getCountComment()+1).'');
			//$this->Talk_UpdateTalk($oTalk);
			$oMatch->Update();
			/*$aCloseBlogs = ($this->oUserCurrent)
			? $this->Blog_GetInaccessibleBlogsByUser($this->oUserCurrent)
			: $this->Blog_GetInaccessibleBlogsByUser();
			
			$s=serialize($aCloseBlogs);
			*/
			//$this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,array("comment_online_update_match_".$s."_5"));
			//$this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,array('matches_save'));
			
			/**
			* Добавляем коммент в прямой эфир если топик не в черновиках
			*/
			$oCommentOnline=Engine::GetEntity('Comment_CommentOnline');
			$oCommentOnline->setTargetId($oCommentNew->getTargetId());
			$oCommentOnline->setTargetType($oCommentNew->getTargetType());
			$oCommentOnline->setTargetParentId($oCommentNew->getTargetParentId());
			$oCommentOnline->setCommentId($oCommentNew->getId());

			$this->Comment_AddCommentOnline($oCommentOnline);
			
			/**
			 * Увеличиваем число новых комментов
			 */
			//$this->Talk_increaseCountCommentNew($oTalk->getId(),$oCommentNew->getUserId()); 			
		} else {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'),$this->Lang_Get('error'));
		}
	}	
	
}

?>