<?php
class PluginVs_ModuleStat extends ModuleORM {
	public $oMapper=null;
	public function Init() {
		parent::Init();
		$this->oMapper=Engine::GetMapper(__CLASS__,'Stat');
		$this->oUserCurrent=$this->User_GetUserCurrent();
	}
	
	public function IsTournamentAdmin($oTournament) {
		$admin = false;
		if($this->oUserCurrent){
			$sKey="user_".$this->oUserCurrent->GetUserId()."_tournament_admin_".$oTournament->getTournamentId();
			
			if (false === ($myTeam = $this->Cache_Get($sKey))) {
				$admin = false;
				if ($this->User_IsAuthorization()) {
					$aAdmin = $this->PluginVs_Stat_GetTournamentadminItemsByFilter(array(
						'tournament_id' => $oTournament->getTournamentId(),
						'user_id'	=> $this->oUserCurrent->GetUserId(),
						'#page' 	=> 'count',
						'expire >=' => date("Y-m-d")
					));
					if($aAdmin['count']>0)$admin = true; 
				}
			}
		}
		return $admin;
		
	}
	public function GetMyTeam($oTournament) {
		$myTeam = 0;
		if($this->oUserCurrent){
			$sKey="user_".$this->oUserCurrent->GetUserId()."_tournament_".$oTournament->getTournamentId();
			
			if (false === ($myTeam = $this->Cache_Get($sKey))) {
				$myTeam = 0;
				if ($this->User_IsAuthorization()) {
					$aTeam = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
						'tournament_id' => $oTournament->getTournamentId(),
						'player_id' => $this->oUserCurrent->GetUserId()		
					));		
					if($aTeam){$myTeam=$aTeam->getTeamId();}		
				}
				if($myTeam==0 && $oTournament->getGametypeId()==3 && $this->User_IsAuthorization()){
					if($aTeam = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
						'tournament_id' => $oTournament->getTournamentId(),
						'user_id' => $this->oUserCurrent->GetUserId()		
					 ))	){
						if($aTeam = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'tournament_id' => $oTournament->getTournamentId(),
							'team_id' => $aTeam->getTeamId()		
						)) ){
							$myTeam=$aTeam->getTeamId();
						}
					}
				}
				$this->Cache_Set($myTeam, $sKey, array("PluginVs_ModuleStat_EntityTeamsintournament_save","PluginVs_ModuleStat_EntityPlayertournament_save"), 60*60*24*1);
			}		
		}
        return $myTeam;
    }
	
	public function GetAll($sql) {
        return $this->oMapper->GetAll($sql);
    }
	public function CreateBlog($sql) {
        return $this->oMapper->CreateBlog($sql);
    }
	public function DelZayavki($user,$tournament) {
        return $this->oMapper->DelZayavki($user,$tournament);
    }
	public function InsertZayavki($user, $tournament, $number, $prior ) {
        return $this->oMapper->InsertZayavki($user, $tournament, $number, $prior );
    }
	public function CheckZayavkaTime($user,$tournament) {
        return $this->oMapper->CheckZayavkaTime($user,$tournament);
    }
	public function PlayerRatings($user_id,$game_id,$gametype_id) {
        return $this->oMapper->PlayerRatings($user_id,$game_id,$gametype_id);
    }
	public function PlayerStats($aFilter) {
        return $this->oMapper->PlayerStats($aFilter);
    }
	public function SituationStats($aFilter) {
        return $this->oMapper->SituationStats($aFilter);
    }
	public function MatchesSQL($aFilter) {
        return $this->oMapper->MatchesSQL($aFilter);
    }
	public function MatchesSQLNew($aFilter) {
        return $this->oMapper->MatchesSQLNew($aFilter);
    }
	public function CheckSetZayavkaTime($user,$tournament,$psnid) {
        return $this->oMapper->CheckSetZayavkaTime($user,$tournament,$psnid);
    }
	public function InsertZayavkaTime($user,$tournament) {
        return $this->oMapper->InsertZayavkaTime($user,$tournament);
    }
	public function Zayavok($tournament) {
        return $this->oMapper->Zayavok($tournament);
    }
	public function TeamZayavki($tournament) {
        return $this->oMapper->TeamZayavki($tournament);
    }
	public function TeamZayavok($tournament) {
        return $this->oMapper->TeamZayavok($tournament);
    }
	
	public function GetPlayerByFilter($aFilter,$aOrder,$iCurrPage,$iPerPage,$aAllowData=null) {
		$sKey="user_filter_".serialize($aFilter).serialize($aOrder)."_{$iCurrPage}_{$iPerPage}";
		if (false === ($data = $this->Cache_Get($sKey))) {
			$data = array('collection'=>$this->oMapper->GetPlayerByFilter($aFilter,$aOrder,$iCount,$iCurrPage,$iPerPage),'count'=>$iCount);
			$this->Cache_Set($data, $sKey, array("user_update","user_new"), 60*60*24*2);
		}
		$data['collection']=$this->GetUsersAdditionalData($data['collection'],$aAllowData);
		return $data;
	}
	
	public function GetMatchesAdditionalData($aTopicId,$aAllowData=array('user'=>array(),'blog'=>array('owner'=>array(),'relation_user'),'vote','favourite','comment_new')) {
		 //print_r( $aMatchId);
		 
		$aTopicId=array_unique($aTopicId);
		$aTopics=array();
		$aTopicIdNotNeedQuery=array();
		/**
		 * Делаем мульти-запрос к кешу
		 */
		$aCacheKeys=func_build_cache_keys($aTopicId,'matches_');
		//print_r($aCacheKeys);
		if (false !== ($data = $this->Cache_Get($aCacheKeys))) {			
			/**
			 * проверяем что досталось из кеша
			 */ 
			 /*
			foreach ($aCacheKeys as $sValue => $sKey ) {
				if (array_key_exists($sKey,$data)) {	
					if ($data[$sKey]) {
						$aTopics[$data[$sKey]->getMatchId()]=$data[$sKey];
					} else {
						$aTopicIdNotNeedQuery[]=$sValue;
					}
				} 
			}
			*/
		}
		/**
		 * Смотрим каких топиков не было в кеше и делаем запрос в БД
		 */		
		$aTopicIdNeedQuery=array_diff($aTopicId,array_keys($aTopics));		
		$aTopicIdNeedQuery=array_diff($aTopicIdNeedQuery,$aTopicIdNotNeedQuery);
 		
		$aTopicIdNeedStore=$aTopicIdNeedQuery; 
		 
		if($aTopicIdNeedQuery)
		if ($data = $this->PluginVs_Stat_GetMatchesItemsByFilter(array(
				'match_id in ' => $aTopicIdNeedQuery,	
				'#with'         => array('hometeam','awayteam','tournament')
			))
			
			/* $this->oMapperTopic->GetTopicsByArrayId($aTopicIdNeedQuery)*/) {
			foreach ($data as $oMatch) {
			
				/*$oTournament=$this->PluginVs_Stat_GetTournamentByFilter(array(
					'tournament_id' => $oMatch->getTournamentId(),	
					'#with'         => array('blog')
				));
				$oMatch->setBlog($oTournament->getBlog());
				*/
				/**
				 * Добавляем к результату и сохраняем в кеш
				 */
				$aTopics[$oMatch->getMatchId()]=$oMatch;
				$this->Cache_Set($oMatch, "matches_{$oMatch->getMatchId()}", array(), 60*60*24*4);
				$aTopicIdNeedStore=array_diff($aTopicIdNeedStore,array($oMatch->getMatchId()));
			}
		}
		/**
		 * Сохраняем в кеш запросы не вернувшие результата
		 */
		 
	 	foreach ($aTopicIdNeedStore as $sId) {
			$this->Cache_Set(null, "matches_{$sId}", array(), 60*60*24*4);
		}	 
/*		
		$aTopics=func_array_sort_by_keys($aTopics,$aTopicId);
		return $aTopics;
		
		
		//--------------------------------------------//
		$aMatch=$this->PluginVs_Stat_GetMatchesItemsByFilter(array(
				'match_id in ' => $aMatchId,	
				'#with'         => array('hometeam','awayteam','tournament')
			));
		foreach ($aMatch as $oMatch) { 
			$oTournament=$this->PluginVs_Stat_GetTournamentByFilter(array(
				'tournament_id' => $oMatch->getTournamentId(),	
				'#with'         => array('blog')
			));
			$oMatch->setBlog($oTournament->getBlog());
			
			$aMatches[$oMatch->getMatchId()]=$oMatch;
			

			
			 $this->Cache_Set($oMatch, "match_{$oMatch->getMatchId()}", array(), 60*60*24*4);
			 $aTopicIdNeedStore=array_diff($aTopicIdNeedStore,array($oMatch->getMatchId()));
		}
			
		$aMatches=func_array_sort_by_keys($aMatches,$aMatchId); 
		return $aMatches;	*/
		$aTopics=func_array_sort_by_keys($aTopics,$aTopicId);
		return $aTopics;	
	}
	public function GetTopicsByPlatform($iPage,$iPerPage,$platform,$bAddAccessible=false) {
		$aFilter=array(
			'blog_type' => array(
				'personal',
				'open'
			),
			'platform' => $platform,
			'topic_publish' => 1,
                        'order' => 't.topic_date_add desc'

		);

		if($this->oUserCurrent && $bAddAccessible) {
			$aOpenBlogs = $this->Blog_GetAccessibleBlogsByUser($this->oUserCurrent);
			if(count($aOpenBlogs)) $aFilter['blog_type']['close'] = $aOpenBlogs;
		}

		return $this->Topic_GetTopicsByFilter($aFilter,$iPage,$iPerPage);
	}
	public function GetTopicsByGame($iPage,$iPerPage,$game,$bAddAccessible=false) {
		$aFilter=array(
			'blog_type' => array(
				'personal',
				'open'
			),
			//'platform' => $platform,
			'game' => $game,
			'topic_publish' => 1,
                        'order' => 't.topic_date_add desc'

		);

		if($this->oUserCurrent && $bAddAccessible) {
			$aOpenBlogs = $this->Blog_GetAccessibleBlogsByUser($this->oUserCurrent);
			if(count($aOpenBlogs)) $aFilter['blog_type']['close'] = $aOpenBlogs;
		}

		return $this->Topic_GetTopicsByFilter($aFilter,$iPage,$iPerPage);
	}
	public function GetTopicsByGametype($iPage,$iPerPage,$platform,$game,$gametype,$bAddAccessible=false) {
		$aFilter=array(
			'blog_type' => array(
				'personal',
				'open'
			),
			'platform' => $platform,
			'game' => $game,
			'gametype' => $gametype,
			'topic_publish' => 1,
                        'order' => 't.topic_date_add desc'

		);

		if($this->oUserCurrent && $bAddAccessible) {
			$aOpenBlogs = $this->Blog_GetAccessibleBlogsByUser($this->oUserCurrent);
			if(count($aOpenBlogs)) $aFilter['blog_type']['close'] = $aOpenBlogs;
		}

		return $this->Topic_GetTopicsByFilter($aFilter,$iPage,$iPerPage);
	}
		public function GetTopicsByTournament($iPage,$iPerPage,$tournament_id,$bAddAccessible=false) {
		$aFilter=array(
			'blog_type' => array(
				'personal',
				'open'
			),
			'tournament_id' => $tournament_id,
			'topic_publish' => 1,
                        'order' => array('t.topic_sticky desc','t.topic_date_add desc')

		);

		if($this->oUserCurrent && $bAddAccessible) {
			$aOpenBlogs = $this->Blog_GetAccessibleBlogsByUser($this->oUserCurrent);
			if(count($aOpenBlogs)) $aFilter['blog_type']['close'] = $aOpenBlogs;
		}

		return $this->Topic_GetTopicsByFilter($aFilter,$iPage,$iPerPage);
	}
	
	public function MonthMatches($tournament_id,$team_id, $month) {
		return $this->oMapper->MonthMatches($tournament_id,$team_id, $month);
	}
	public function PlayoffTree($tournament_id) {
		return $this->oMapper->PlayoffTree($tournament_id);
	}
	
	public function PlayoffTreeWithMatches($tournament_id) {
		return $this->oMapper->PlayoffTreeWithMatches($tournament_id);
	}
	
	public function StreamReadMainPage($iCount=null,$iFromId=null, $tournament_id=null, $userId=null,$gameId=null, $only_matches=0, $blogId=null) {
		$aEventTypes = array(
			'match_played' => array('related' => 'matches') 
		);	
		if(!$only_matches!=1){
			$aEventTypes['teh_penalty']=array('related' => 'penalty');
		} 
		if(is_null($iCount))$iCount=20;
		if(is_null($iFromId))$iFromId=0;
		if(is_null($tournament_id))$tournament_id=0;
		if(is_null($userId))$userId=0;
		if(is_null($gameId))$gameId=0;
		if(is_null($blogId))$blogId=0;
		
		$sql="SELECT st.id as id,
			at.name as away_name,
			at.logo as away_logo,
			ht.name as home_name,
			ht.logo as home_logo,
			t.name as tournament_name,
			t.url as tournament_url
			FROM `tis_stat_stream` st , `tis_stat_matches` m, tis_stat_team ht, tis_stat_team at , tis_stat_tournament t
			where  (m.blog_id = (".$blogId.") or 0 = (".$blogId.") ) 
				and st.event_type='match_played'
				and st.what_id=m.match_id
				and m.away=at.team_id
				and m.home=ht.team_id
				and m.tournament_id=t.tournament_id
				and (m.tournament_id = (".$tournament_id.") or 0 = (".$tournament_id.") )
			order by st.id desc
			limit 0,".$iCount;
		$aTemp=Engine::GetInstance()->PluginVs_Stat_GetAll($sql);
		$events=array();
		$events[0]=0;
		if($aTemp)
		foreach($aTemp as $oTemp){
			$events[$oTemp['id']]=$oTemp['id'];
		}
		
		$aEvents=$this->PluginVs_Stat_GetStreamItemsByFilter(array( 
				'id in' => $events,
				'#order' =>array('date_add'=>'desc'),
				'#limit' =>array('0',$iCount)
			));
		$aNeedObjects=array();
		
		$teams=array();
		if($aTemp)
		foreach($aTemp as $oTemp){
			$teams[$oTemp['id']]['away_name']=$oTemp['away_name'];
			$teams[$oTemp['id']]['home_name']=$oTemp['home_name'];
			$teams[$oTemp['id']]['away_logo']=$oTemp['away_logo'];
			$teams[$oTemp['id']]['home_logo']=$oTemp['home_logo'];
			$teams[$oTemp['id']]['tournament_name']=$oTemp['tournament_name'];
			$teams[$oTemp['id']]['tournament_url']=$oTemp['tournament_url'];
		}
		
		foreach ($aEvents as $oEvent) {
			if (isset($aEventTypes[$oEvent->getEventType()]['related'])) {
				$aNeedObjects[$aEventTypes[$oEvent->getEventType()]['related']][]=$oEvent->getWhatId();				
			}
			$oEvent->setAwayName($teams[$oEvent->getId()]['away_name']);
			$oEvent->setHomeName($teams[$oEvent->getId()]['home_name']);
			$oEvent->setAwayLogo($teams[$oEvent->getId()]['away_logo']);
			$oEvent->setHomeLogo($teams[$oEvent->getId()]['home_logo']);
			$oEvent->setTournamentName($teams[$oEvent->getId()]['tournament_name']);
			$oEvent->setTournamentUrl($teams[$oEvent->getId()]['tournament_url']);
		}
		
		$aObjects=array();
		foreach ($aNeedObjects as $sType => $aListId) {
			if (count($aListId)) {
				$aListId=array_unique($aListId);
				if($sType=='matches'){
					if ($aRes=$this->PluginVs_Stat_GetMatchesItemsByFilter(array(
						'match_id in' => $aListId,	
						'#with'         => array( 'blog')
						))
						) {
						foreach ($aRes as $oObject) {
							$aObjects[$sType][$oObject->getMatchId()]=$oObject; 
						}
						//PluginFirephp::GetLog(count($aRes));
					}
				}
			}
		}
		foreach ($aEvents as $key => $oEvent) {
				if (isset($aEventTypes[$oEvent->getEventType()]['related'])) {
					$sTypeObject=$aEventTypes[$oEvent->getEventType()]['related'];
					if (isset($aObjects[$sTypeObject][$oEvent->getWhatId()])) {
						$oEvent->setWhat($aObjects[$sTypeObject][$oEvent->getWhatId()]);
					} else {
						unset($aEvents[$key]);
					}
				} else {
					unset($aEvents[$key]);
				}

		}		
		return $aEvents;
	}
	public function StreamRead($iCount=null,$iFromId=null, $tournament_id=null, $userId=null,$gameId=null, $only_matches=0) {
		
		$aEventTypes = array(
			'match_played' => array('related' => 'matches') 
		);	
		if(!$only_matches!=1){
			$aEventTypes['teh_penalty']=array('related' => 'penalty');
		} 
		if(is_null($iCount))$iCount=20;
		if(is_null($iFromId))$iFromId=0;
		if(is_null($tournament_id))$tournament_id=0;
		if(is_null($userId))$userId=0;
		if(is_null($gameId))$gameId=0;
		
		if($userId>0){		
			$sql="SELECT st.id as id FROM `tis_stat_stream` st , `tis_stat_matches` m
			where (m.home_player=".$userId." or m.away_player=".$userId.")
				and (m.tournament_id = (".$tournament_id.") or 0 = (".$tournament_id.") )
				and (m.game_id = (".$gameId.") or 0 = (".$gameId.") )
				and st.event_type='match_played'
				and st.what_id=m.match_id
			order by st.id desc
			limit 0,".$iCount;

			$aTemp=Engine::GetInstance()->PluginVs_Stat_GetAll($sql);
			$events=array();
			$events[0]=0;
			if($aTemp)
			foreach($aTemp as $oTemp){
				$events[]=$oTemp['id'];
			}
			
			$aEvents=$this->PluginVs_Stat_GetStreamItemsByFilter(array( 
					'id in' => $events,
					'#order' =>array('date_add'=>'desc'),
					'#limit' =>array('0',$iCount)
				));
		}else{		
			$aEvents=$this->PluginVs_Stat_GetStreamItemsByFilter(array( 
					'#where' => array('(id < (?d) or 0 = (?d) ) and (tournament_id = (?d) or 0 = (?d) ) and ( (event_type = "match_played" and 1 = (?d)) or  0 = (?d) )' => array($iFromId, $iFromId, $tournament_id, $tournament_id,  $only_matches,  $only_matches)),				
					'#order' =>array('date_add'=>'desc'),
					'#limit' =>array('0',$iCount)
				));  
		}		
		$aNeedObjects=array();
		foreach ($aEvents as $oEvent) {
			if (isset($aEventTypes[$oEvent->getEventType()]['related'])) {
				$aNeedObjects[$aEventTypes[$oEvent->getEventType()]['related']][]=$oEvent->getWhatId();
//echo $oEvent->getWhatId();				
			}
			//$aNeedObjects['user'][]=$oEvent->getUserId();
		}
		
		$aObjects=array();
		foreach ($aNeedObjects as $sType => $aListId) {
			if (count($aListId)) {
				$aListId=array_unique($aListId);
				$sMethod = 'loadRelated' . ucfirst($sType);
				//echo $sType;
				if($sType=='matches'){
					if ($aRes=$this->PluginVs_Stat_GetMatchesItemsByFilter(array(
						'match_id in' => $aListId,	
						'#with'         => array('hometeam','awayteam','homeuser','awayuser', 'tournament')
						))
						) {
						foreach ($aRes as $oObject) {
							$aObjects[$sType][$oObject->getMatchId()]=$oObject;
							//echo $oObject->getMatchId();
						}
					}
				}elseif($sType=='penalty'){
					if ($aRes=$this->PluginVs_Stat_GetPenaltyItemsByFilter(array(
						'id in' => $aListId,	
						'#with'         => array('player','match')
						))
						) {
						foreach ($aRes as $oObject) {
							$aObjects[$sType][$oObject->getId()]=$oObject;
							//echo $oObject->getMatchId();
						}
					}

				}elseif (method_exists($this, $sMethod)) {
					if ($aRes=$this->$sMethod($aListId)) {
						foreach ($aRes as $oObject) {
							$aObjects[$sType][$oObject->getId()]=$oObject;
						}
					}
				}
			}
		}
		//print_r($aNeedObjects['matches']);
		
		foreach ($aEvents as $key => $oEvent) {
			/**
			 * Жестко вытаскиваем автора события
			 */
			 

				if (isset($aEventTypes[$oEvent->getEventType()]['related'])) {
					$sTypeObject=$aEventTypes[$oEvent->getEventType()]['related'];
					if (isset($aObjects[$sTypeObject][$oEvent->getWhatId()])) {
						$oEvent->setWhat($aObjects[$sTypeObject][$oEvent->getWhatId()]);
						//echo $oEvent->getWhat()->getMatchId();
					} else {
						unset($aEvents[$key]);
					}
				} else {
					unset($aEvents[$key]);
				}

		}
		
		return $aEvents;
	}
	public function loadRelatedUser($aIds) {
		return $this->User_GetUsersAdditionalData($aIds);
	}

//внесение результатов	
	public function AutoSubmit() {
		//echo 'alloha';
		//$this->Viewer_SetResponseAjax('json',true,false);
		//$this->Viewer_AssignAjax('message','');
		$sql="SELECT mr.id  
			FROM `tis_stat_matchresult`mr,
				`tis_stat_matches`m,
				`tis_stat_tournament` t				
			where mr.match_id=m.match_id 
				and m.tournament_id = t.tournament_id
				and t.autosubmit=1
				and not exists (select 1 from `tis_stat_matchresult` where match_id=mr.match_id and mr.id<>id)
				and date_add(mr.dates, INTERVAL t.submithours HOUR)<now()
				";
		$aMatches=$this->PluginVs_Stat_GetAll($sql);
		if($aMatches){
		
			foreach($aMatches as $aMatch){		
				$oMatchResult=$this->PluginVs_Stat_GetMatchresultById($aMatch['id']);
				$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($oMatchResult->getMatchId());
				
				$user_id=0;
				$team_id=0;
				if($oMatchResult->getTeamId()==$oMatch->getHome()){$team_id=$oMatch->getAway();}else{$team_id=$oMatch->getHome();}
				
				if( $oTeamintournament = $this->PluginVs_Stat_GetTeamsintournamentByFilter(array(
							'team_id' => $team_id,
							'tournament_id' => $oMatch->getTournamentId()			
							))
				)$user_id=$oTeamintournament->getPlayerId();
				if( /*$user_id!=0 &&*/ $team_id!=0){	
					$oMatchResult_add =  Engine::GetEntity('PluginVs_Stat_Matchresult');
					$oMatchResult_add->setMatchId($oMatchResult->getMatchId());
					$oMatchResult_add->setUserId($user_id);
					$oMatchResult_add->setTeamId($team_id);
					$oMatchResult_add->setAway($oMatchResult->getAway());
					$oMatchResult_add->setHome($oMatchResult->getHome());
					$oMatchResult_add->setComment('подтверждено автоматом');
					$oMatchResult_add->setDates(date("Y-m-d H:i:s"));
					$oMatchResult_add->setOt($oMatchResult->getOt());
					$oMatchResult_add->setSo($oMatchResult->getSo());
					//if(isset($zhaloba))$oMatchResult_add->setHome($zhaloba);
					$oMatchResult_add->Add();
					
					//$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($oMatchResult->getMatchId());
					if($oMatch->getHome()==$team_id){
						$oMatch->setHomeInsert(1);
						$oMatch->Save();
					}
					if($oMatch->getAway()==$team_id){
						$oMatch->setAwayInsert(1);
						$oMatch->Save();
					}
					$this->CheckResult($oMatchResult->getMatchId());
				}
			}
		}

	}
	
	public function CheckResult($match_id) {
		$aMatchResults = $this->PluginVs_Stat_GetMatchresultItemsByFilter(array(
						'match_id' => $match_id,
						'#page' => 'count'
						));
		if($aMatchResults['count']==2){
				$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
				
				if($oMatch->getTournamentId()!=0){
					$oResultHome = $this->PluginVs_Stat_GetMatchresultByFilter(array(
							'match_id' => $match_id,
							'team_id' => $oMatch->getHome()			
							));
					$oResultAway = $this->PluginVs_Stat_GetMatchresultByFilter(array(
							'match_id' => $match_id,
							'team_id' => $oMatch->getAway()			
							));
				}else{
					$oResultHome = $this->PluginVs_Stat_GetMatchresultByFilter(array(
							'match_id' => $match_id,
							'team_id' => $oMatch->getHome(),
							'user_id' => $oMatch->getHomePlayer()								
							));
					$oResultAway = $this->PluginVs_Stat_GetMatchresultByFilter(array(
							'match_id' => $match_id,
							'team_id' => $oMatch->getAway(),
							'user_id' => $oMatch->getAwayPlayer()			
							));				
				
				}
				if($oResultHome->getHome()==$oResultHome->getHome()
					&& $oResultHome->getHome()==$oResultAway->getHome()
					&& $oResultHome->getAway()==$oResultAway->getAway()
					&& $oResultHome->getOt()==$oResultAway->getOt()
					&& $oResultHome->getSo()==$oResultAway->getSo() )
					{
						$oMatch->setGoalsHome($oResultHome->getHome());
						$oMatch->setGoalsAway($oResultHome->getAway());
						$oMatch->setOt($oResultHome->getOt());
						$oMatch->setSo($oResultHome->getSo());
						$oMatch->setHomePlayer($oResultHome->getUserId());
						$oMatch->setAwayPlayer($oResultAway->getUserId());
						$oMatch->setHomeComment($oResultHome->getComment());
						$oMatch->setAwayComment($oResultAway->getComment());
						$oMatch->setPlayed(1);
						$oMatch->setPlayDates(date("Y-m-d H:i:s"));
						$oMatch->Save();
						if($oMatch->getHomeRating()==0 && $oMatch->getAwayRating()==0 && $oMatch->getTeh()==0)
						$this->CalcRating($match_id);
						$this->CalcStat($match_id);
						if($oMatch->getAwayPlayer()!=$oMatch->getHomePlayer())$this->CalcPlayerStat($match_id);
						$this->CalcPosition($match_id);
						if(!$oEvent = $this->PluginVs_Stat_GetStreamByFilter(array(
							'event_type' => 'match_played',
							'what_id' => $match_id		
							))
						){
							$oEvent =  Engine::GetEntity('PluginVs_Stat_Stream');
							$oEvent->setEventType('match_played');
							$oEvent->setWhatId($match_id);
							$oEvent->setTournamentId($oMatch->getTournamentId());
							$oEvent->setDateAdd(date("Y-m-d H:i:s"));
							$oEvent->Add();
						
						}
					}else{
					//ищем админов и пишем им в личку с номером матча
					
					}
		}		
    }
	
	public function CalcRating($match_id) {
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		
		if( !$oRating = $this->PluginVs_Stat_GetRatingByFilter(array(
						'game_id' => $oMatch->getGameId(),
						'gametype_id' => $oMatch->getGametypeId(),
						'user_id' => $oMatch->getHomePlayer()			
						)) 
			)
		{
			$oHomeRating_add =  Engine::GetEntity('PluginVs_Stat_Rating');
			$oHomeRating_add->setUserId($oMatch->getHomePlayer());
			$oHomeRating_add->setGameId($oMatch->getGameId());
			$oHomeRating_add->setGametypeId($oMatch->getGametypeId());
			$oHomeRating_add->setRating(1000);
			$oHomeRating_add->setMatches(0);
			$oHomeRating_add->Add();
		}
		
		if( !$oRating = $this->PluginVs_Stat_GetRatingByFilter(array(
						'game_id' => $oMatch->getGameId(),
						'gametype_id' => $oMatch->getGametypeId(),
						'user_id' => $oMatch->getAwayPlayer()			
						)) 
			)
		{
			$oAwayRating_add =  Engine::GetEntity('PluginVs_Stat_Rating');
			$oAwayRating_add->setUserId($oMatch->getAwayPlayer());
			$oAwayRating_add->setGameId($oMatch->getGameId());
			$oAwayRating_add->setGametypeId($oMatch->getGametypeId());
			$oAwayRating_add->setRating(1000);
			$oAwayRating_add->setMatches(0);
			$oAwayRating_add->Add();
		}
		
		$oHomeRating = $this->PluginVs_Stat_GetRatingByFilter(array(
						'game_id' => $oMatch->getGameId(),
						'gametype_id' => $oMatch->getGametypeId(),
						'user_id' => $oMatch->getHomePlayer()			
						));
						
		$oAwayRating = $this->PluginVs_Stat_GetRatingByFilter(array(
						'game_id' => $oMatch->getGameId(),
						'gametype_id' => $oMatch->getGametypeId(),
						'user_id' => $oMatch->getAwayPlayer()			
						)); 
		$G=1;
		if(abs($oMatch->getGoalsHome()-$oMatch->getGoalsAway())==1)$G=1;
		if(abs($oMatch->getGoalsHome()-$oMatch->getGoalsAway())==2)$G=1.5;
		if(abs($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>2)$G=(11+abs($oMatch->getGoalsHome()-$oMatch->getGoalsAway()))/8;
		$K=10;
		if($oMatch->getTournamentId()==0)$K=10; //товарки
		if($oMatch->getTournamentId()!=0)$K=30; //турнир
		//if($oMatch->getTournamentId()!=0 && $oMatch->getRoundId()==0)$K=30; //турнир
		
		$W=0;
		if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0)$W=1;
		if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())==0)$W=0.5;		
		if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==1)$W=0.5;
		if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getSo()==1)$W=0.5;
		if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0)$W=0;
		
		$newHomerating = round($oHomeRating->getRating(),2)+$G*$K * ( $W - 1/(pow(10,(-1)*($oHomeRating->getRating()-$oAwayRating->getRating())/400 ) +1));
						
		$W=0;
		if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0)$W=1;
		if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())==0)$W=0.5;		
		if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==1)$W=0.5;
		if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getSo()==1)$W=0.5;
		if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0)$W=0;
		
		$newAwayrating = round($oAwayRating->getRating(),2)+$G*$K * ( $W - 1/(pow(10,(-1)*($oAwayRating->getRating()-$oHomeRating->getRating())/400 ) +1));
		
		$oMatch->setHomeRating(number_format(round($newHomerating,2)-$oHomeRating->getRating(),2, '.', ''));
		$oMatch->setAwayRating(number_format(round($newAwayrating,2)-$oAwayRating->getRating(),2, '.', ''));
		$oMatch->Save();
		
		$oHomeRating->setRating(number_format(round($newHomerating,2),2, '.', ''));	
		$oHomeRating->setMatches($oHomeRating->getMatches()+1);
		$oHomeRating->Save();	
		
		$oAwayRating->setRating(number_format(round($newAwayrating,2),2, '.', ''));	
		$oAwayRating->setMatches($oAwayRating->getMatches()+1);
		$oAwayRating->Save();			
		
    }
	public function CalcStat($match_id) {
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		if($oMatch->getTournamentId()!=0){
		
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());
			
			if(!$this->PluginVs_Stat_GetTournamentstatByFilter(array(
					'tournament_id' => $oMatch->getTournamentId(),
					'round_id' => $oMatch->getRoundId()
					)))
			{
				$this->EventCreateStatTableByTournamentRound($oMatch->getTournamentId(),$oMatch->getRoundId());
			}
			
			$oHomeResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
					'match_id' => $oMatch->getMatchId(),
					'team_id' => $oMatch->getHome()			
					));
			$oAwayResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
					'match_id' => $oMatch->getMatchId(),
					'team_id' => $oMatch->getAway()			
					));
			
			$oHomeStat = $this->PluginVs_Stat_GetTournamentstatByFilter(array(
					'tournament_id' => $oMatch->getTournamentId(),
					'round_id' => $oMatch->getRoundId(),
					'team_id' => $oMatch->getHome()			
					));
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oHomeStat->setHomeW($oHomeStat->getHomeW()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getWin());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oHomeStat->setHomeWot($oHomeStat->getHomeWot()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getWinO());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oHomeStat->setHomeWb($oHomeStat->getHomeWb()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getWinB());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oHomeStat->setHomeL($oHomeStat->getHomeL()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+0);}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oHomeStat->setHomeLot($oHomeStat->getHomeLot()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getLoseO());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oHomeStat->setHomeLb($oHomeStat->getHomeLb()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getLoseB());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())==0 && $oMatch->getTeh()==0){$oHomeStat->setHomeT($oHomeStat->getHomeT()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getPointsN());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())==0 && $oMatch->getTeh()==1){$oHomeStat->setHomeL($oHomeStat->getHomeL()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+0);}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getTeh()==0 && $oMatch->getGoalsAway()==0)$oHomeStat->setSuhW($oHomeStat->getSuhW()+1);
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getTeh()==0 && $oMatch->getGoalsHome()==0)$oHomeStat->setSuhL($oHomeStat->getSuhL()+1);
					
			$oHomeStat->setGf($oHomeStat->getGf()+$oMatch->getGoalsHome());
			$oHomeStat->setGa($oHomeStat->getGa()+$oMatch->getGoalsAway());
			
			$oHomeStat->setYardW($oHomeStat->getYardW() + $oMatch->getHomeYard());
			$oHomeStat->setYardL($oHomeStat->getYardL() + $oMatch->getAwayYard());
			
			$oHomeStat->setShots($oHomeStat->getShots() + $oHomeResult->getShots());
			$oHomeStat->setHits($oHomeStat->getHits() + $oHomeResult->getHits());
			$oHomeStat->setPim($oHomeStat->getPim() + $oHomeResult->getPenalty());
			$oHomeStat->setSecundeAt($oHomeStat->getSecundeAt() + $oHomeResult->getSecundeAt()+ $oHomeResult->getMinuteAt()*60);
			$oHomeStat->setPass($oHomeStat->getPass() + $oHomeResult->getPassPrc());
			$oHomeStat->setPowerplayWin($oHomeStat->getPowerplayWin() + $oHomeResult->getPowerplayRealize());
			$oHomeStat->setPowerplayVsego($oHomeStat->getPowerplayVsego() + $oHomeResult->getPp());
			$oHomeStat->setShorthand($oHomeStat->getShorthand() + $oHomeResult->getPkg());
			$oHomeStat->setBullits($oHomeStat->getBullits() + $oHomeResult->getBullits());
			$oHomeStat->setEmptyNet($oHomeStat->getEmptyNet() + $oHomeResult->getEmptyNet());
			
			$oHomeStat->setFaceoffWin($oHomeStat->getFaceoffWin() + $oHomeResult->getFaceoffWin());
			$oHomeStat->setFaceoffVsego($oHomeStat->getFaceoffVsego() + $oHomeResult->getFaceoffWin() + $oAwayResult->getFaceoffWin() );
			
			$oHomeStat->setPenaltykillLose($oHomeStat->getPenaltykillLose() + $oAwayResult->getPowerplayRealize());
			$oHomeStat->setPenaltykillVsego($oHomeStat->getPenaltykillVsego() + $oAwayResult->getPp());
			
			
			$aMatches=$this->PluginVs_Stat_GetMatchesItemsByFilter(array(
				'played'=> '1',
				'tournament_id' => $oMatch->getTournamentId(),
				'round_id' => $oMatch->getRoundId(),
				'#where' => array('(home = (?d) or away = (?d) )' => array($oMatch->getHome(),$oMatch->getHome())),	
				'#order' =>array('play_dates'=>'desc'),
				'#limit' =>array('0','10')
			));
			$win=0;
			$ot=0;
			$lose=0;
			foreach($aMatches as $oMatches){
				if($oMatches->getHome()==$oMatch->getHome()){
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$win++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())>0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$win++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$win++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$lose++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())<0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$ot++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$ot++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())==0 && $oMatches->getTeh()==0)$ot++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())==0 && $oMatches->getTeh()==1)$lose++;
				}
				
				if($oMatches->getAway()==$oMatch->getHome()){
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$win++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())>0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$win++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$win++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$lose++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())<0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$ot++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$ot++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())==0 && $oMatches->getTeh()==0)$ot++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())==0 && $oMatches->getTeh()==1)$lose++;
				}
			}
			$oHomeStat->setLastTen($win."-".$lose."-".$ot);
			$oHomeStat->Save();
			
			$oAwayStat = $this->PluginVs_Stat_GetTournamentstatByFilter(array(
					'tournament_id' => $oMatch->getTournamentId(),
					'round_id' => $oMatch->getRoundId(),
					'team_id' => $oMatch->getAway()			
					));
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oAwayStat->setAwayW($oAwayStat->getAwayW()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+$oTournament->getWin());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oAwayStat->setAwayWot($oAwayStat->getAwayWot()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+$oTournament->getWinO());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oAwayStat->setAwayWb($oAwayStat->getAwayWb()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+$oTournament->getWinB());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oAwayStat->setAwayL($oAwayStat->getAwayL()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+0);}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oAwayStat->setAwayLot($oAwayStat->getAwayLot()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+$oTournament->getLoseO());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oAwayStat->setAwayLb($oAwayStat->getAwayLb()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+$oTournament->getLoseB());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())==0 && $oMatch->getTeh()==0){$oAwayStat->setAwayT($oAwayStat->getAwayT()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+$oTournament->getPointsN());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())==0 && $oMatch->getTeh()==1){$oAwayStat->setAwayL($oAwayStat->getAwayL()+1);; $oAwayStat->setPoints($oAwayStat->getPoints()+0);}
			$oAwayStat->setGf($oAwayStat->getGf()+$oMatch->getGoalsAway());
			$oAwayStat->setGa($oAwayStat->getGa()+$oMatch->getGoalsHome());
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getTeh()==0 && $oMatch->getGoalsHome()==0)$oAwayStat->setSuhW($oAwayStat->getSuhW()+1);
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getTeh()==0 && $oMatch->getGoalsAway()==0)$oAwayStat->setSuhL($oAwayStat->getSuhL()+1);
			
			$oAwayStat->setYardW($oAwayStat->getYardW() + $oMatch->getAwayYard());
			$oAwayStat->setYardL($oAwayStat->getYardL() + $oMatch->getHomeYard());
			
			$oAwayStat->setShots($oAwayStat->getShots() + $oAwayResult->getShots());
			$oAwayStat->setHits($oAwayStat->getHits() + $oAwayResult->getHits());
			$oAwayStat->setPim($oAwayStat->getPim() + $oAwayResult->getPenalty());
			$oAwayStat->setSecundeAt($oAwayStat->getSecundeAt() + $oAwayResult->getSecundeAt()+ $oAwayResult->getMinuteAt()*60);
			$oAwayStat->setPass($oAwayStat->getPass() + $oAwayResult->getPassPrc());
			$oAwayStat->setPowerplayWin($oAwayStat->getPowerplayWin() + $oAwayResult->getPowerplayRealize());
			$oAwayStat->setPowerplayVsego($oAwayStat->getPowerplayVsego() + $oAwayResult->getPp());
			$oAwayStat->setShorthand($oAwayStat->getShorthand() + $oAwayResult->getPkg());
			$oAwayStat->setBullits($oAwayStat->getBullits() + $oAwayResult->getBullits());
			$oAwayStat->setEmptyNet($oAwayStat->getEmptyNet() + $oAwayResult->getEmptyNet());
			
			$oAwayStat->setFaceoffWin($oAwayStat->getFaceoffWin() + $oAwayResult->getFaceoffWin());
			$oAwayStat->setFaceoffVsego($oAwayStat->getFaceoffVsego() + $oHomeResult->getFaceoffWin() + $oAwayResult->getFaceoffWin() );
			
			$oAwayStat->setPenaltykillLose($oAwayStat->getPenaltykillLose() + $oHomeResult->getPowerplayRealize());
			$oAwayStat->setPenaltykillVsego($oAwayStat->getPenaltykillVsego() + $oHomeResult->getPp());
			
			
			$aMatches=$this->PluginVs_Stat_GetMatchesItemsByFilter(array(
				'played'=> '1',
				'tournament_id' => $oMatch->getTournamentId(),
				'round_id' => $oMatch->getRoundId(),
				'#where' => array('(home = (?d) or away = (?d) )' => array($oMatch->getAway(),$oMatch->getAway())),	
				'#order' =>array('play_dates'=>'desc'),
				'#limit' =>array('0','10')
			));
			$win=0;
			$ot=0;
			$lose=0;
			$suh_w=0;
			$suh_l=0;
			foreach($aMatches as $oMatches){
				if($oMatches->getHome()==$oMatch->getAway()){
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$win++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())>0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$win++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$win++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$lose++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())<0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$ot++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$ot++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())==0 && $oMatches->getTeh()==0)$ot++;
					if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())==0 && $oMatches->getTeh()==1)$lose++;
				}
				
				if($oMatches->getAway()==$oMatch->getAway()){
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$win++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())>0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$win++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$win++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$lose++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())<0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$ot++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$ot++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())==0 && $oMatches->getTeh()==0)$ot++;
					if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())==0 && $oMatches->getTeh()==1)$lose++;
				}
			}
			$oAwayStat->setLastTen($win."-".$lose."-".$ot);			
			$oAwayStat->Save();
			//$this->CalcPosition($match_id);
		}
	}
	public function CalcPosition($match_id) {
	
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		
		$order = array('points'=>'desc', '(home_w+home_wot+away_w+away_wot)'=>'desc', '(gf-ga)'=>'desc');
		$oGame= $this->PluginVs_Stat_GetGameByGameId($oMatch->getGameId());
		if($oGame->getSportId()==3)$order = array('(home_w + away_w + home_wot + away_wot + home_wb + away_wb - (home_l + away_l + home_lot + away_lot + home_lb + away_lb))/(home_w + away_w + home_wot + away_wot + home_wb + away_wb + (home_l + away_l + home_lot + away_lot + home_lb + away_lb))'=>'desc', '(gf-ga)'=>'desc');
		$groups=array();
		$aStats = $this->PluginVs_Stat_GetTournamentstatItemsByFilter(array(
			'tournament_id' => $oMatch->getTournamentId(),
			'round_id' => $oMatch->getRoundId(),
			'#order' => $order
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
			'tournament_id' => $oMatch->getTournamentId(),
			'round_id' => $oMatch->getRoundId(),
			'#order' =>$order,		
		));
		$position=1;
		foreach($aStats as $oStats)
		{
			$oStats->setPosition($position);
			$oStats->Save();
			$position++;
		}
	}

	public function DeleteStat($match_id) {
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		if($oMatch->getTournamentId()!=0 && $oMatch->getPlayed()==1){
			
			$this->DeletePlayerStat($match_id);
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());
			
			if(!$this->PluginVs_Stat_GetTournamentstatByFilter(array(
					'tournament_id' => $oMatch->getTournamentId(),
					'round_id' => $oMatch->getRoundId()
					)))
			{
				$this->EventCreateStatTableByTournamentRound($oMatch->getTournamentId(),$oMatch->getRoundId());
			}
			
			$oHomeStat = $this->PluginVs_Stat_GetTournamentstatByFilter(array(
					'tournament_id' => $oMatch->getTournamentId(),
					'round_id' => $oMatch->getRoundId(),
					'team_id' => $oMatch->getHome()			
					));
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oHomeStat->setHomeW($oHomeStat->getHomeW()-1); $oHomeStat->setPoints($oHomeStat->getPoints()-$oTournament->getWin());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oHomeStat->setHomeWot($oHomeStat->getHomeWot()-1); $oHomeStat->setPoints($oHomeStat->getPoints()-$oTournament->getWinO());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oHomeStat->setHomeWb($oHomeStat->getHomeWb()-1); $oHomeStat->setPoints($oHomeStat->getPoints()-$oTournament->getWinB());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oHomeStat->setHomeL($oHomeStat->getHomeL()-1); $oHomeStat->setPoints($oHomeStat->getPoints()-0);}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oHomeStat->setHomeLot($oHomeStat->getHomeLot()-1); $oHomeStat->setPoints($oHomeStat->getPoints()-$oTournament->getLoseO());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oHomeStat->setHomeLb($oHomeStat->getHomeLb()-1); $oHomeStat->setPoints($oHomeStat->getPoints()-$oTournament->getLoseB());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())==0 && $oMatch->getTeh()==0){$oHomeStat->setHomeT($oHomeStat->getHomeT()-1); $oHomeStat->setPoints($oHomeStat->getPoints()-$oTournament->getPointsN());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())==0 && $oMatch->getTeh()==1){$oHomeStat->setHomeL($oHomeStat->getHomeL()-1); $oHomeStat->setPoints($oHomeStat->getPoints()+0);}
			$oHomeStat->setGf($oHomeStat->getGf()-$oMatch->getGoalsHome());
			$oHomeStat->setGa($oHomeStat->getGa()-$oMatch->getGoalsAway());
			
			$oHomeStat->setYardW($oHomeStat->getYardW() - $oMatch->getHomeYard());
			$oHomeStat->setYardL($oHomeStat->getYardL() - $oMatch->getAwayYard());
			
			$win=0;
			$ot=0;
			$lose=0;
			
			if($aMatches=$this->PluginVs_Stat_GetMatchesItemsByFilter(array(
				'played'=> '1',
				'match_id !=' =>$oMatch->getMatchId(),
				'tournament_id' => $oMatch->getTournamentId(),
				'round_id' => $oMatch->getRoundId(),
				'#where' => array('(home = (?d) or away = (?d) )' => array($oMatch->getHome(),$oMatch->getHome())),
				'#order' =>array('play_dates'=>'desc'),
				'#limit' =>array('0','10')
			))
			){
				foreach($aMatches as $oMatches){
					if($oMatches->getHome()==$oMatch->getHome()){
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$win++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())>0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$win++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$win++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$lose++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())<0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$ot++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$ot++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())==0 && $oMatches->getTeh()==0)$ot++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())==0 && $oMatches->getTeh()==1)$lose++;
					}
					
					if($oMatches->getAway()==$oMatch->getHome()){
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$win++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())>0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$win++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$win++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$lose++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())<0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$ot++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$ot++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())==0 && $oMatches->getTeh()==0)$ot++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())==0 && $oMatches->getTeh()==1)$lose++;
					}
				}
			}
			$oHomeStat->setLastTen($win."-".$lose."-".$ot);
			
			$oHomeStat->Save();
			
			$oAwayStat = $this->PluginVs_Stat_GetTournamentstatByFilter(array(
					'tournament_id' => $oMatch->getTournamentId(),
					'round_id' => $oMatch->getRoundId(),
					'team_id' => $oMatch->getAway()			
					));
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oAwayStat->setAwayW($oAwayStat->getAwayW()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-$oTournament->getWin());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oAwayStat->setAwayWot($oAwayStat->getAwayWot()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-$oTournament->getWinO());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oAwayStat->setAwayWb($oAwayStat->getAwayWb()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-$oTournament->getWinB());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oAwayStat->setAwayL($oAwayStat->getAwayL()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-0);}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oAwayStat->setAwayLot($oAwayStat->getAwayLot()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-$oTournament->getLoseO());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oAwayStat->setAwayLb($oAwayStat->getAwayLb()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-$oTournament->getLoseB());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())==0 && $oMatch->getTeh()==0){$oAwayStat->setAwayT($oAwayStat->getAwayT()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-$oTournament->getPointsN());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())==0 && $oMatch->getTeh()==1){$oAwayStat->setAwayL($oAwayStat->getAwayL()-1);; $oAwayStat->setPoints($oAwayStat->getPoints()-0);}
			$oAwayStat->setGf($oAwayStat->getGf()-$oMatch->getGoalsAway());
			$oAwayStat->setGa($oAwayStat->getGa()-$oMatch->getGoalsHome());
			
			$oAwayStat->setYardW($oAwayStat->getYardW() - $oMatch->getAwayYard());
			$oAwayStat->setYardL($oAwayStat->getYardL() - $oMatch->getHomeYard());
			
			$win=0;
			$ot=0;
			$lose=0;
			
			if($aMatches=$this->PluginVs_Stat_GetMatchesItemsByFilter(array(
				'played'=> '1',
				'match_id !=' =>$oMatch->getMatchId(),
				'tournament_id' => $oMatch->getTournamentId(),
				'round_id' => $oMatch->getRoundId(),
				'#where' => array('(home = (?d) or away = (?d) )' => array($oMatch->getAway(),$oMatch->getAway())),	
				'#order' =>array('play_dates'=>'desc'),
				'#limit' =>array('0','10')
			))
			){			
				foreach($aMatches as $oMatches){
					if($oMatches->getHome()==$oMatch->getAway()){
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$win++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())>0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$win++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$win++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$lose++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())<0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$ot++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$ot++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())==0 && $oMatches->getTeh()==0)$ot++;
						if(($oMatches->getGoalsHome()-$oMatches->getGoalsAway())==0 && $oMatches->getTeh()==1)$lose++;
					}
					
					if($oMatches->getAway()==$oMatch->getAway()){
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$win++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())>0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$win++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())>0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$win++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==0 )$lose++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())<0 && $oMatches->getOt()==1 && $oMatches->getSo()==0 )$ot++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())<0 && $oMatches->getOt()==0 && $oMatches->getSo()==1 )$ot++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())==0 && $oMatches->getTeh()==0)$ot++;
						if(($oMatches->getGoalsAway()-$oMatches->getGoalsHome())==0 && $oMatches->getTeh()==1)$lose++;
					}
				}
			}
			$oAwayStat->setLastTen($win."-".$lose."-".$ot);	
			
			$oAwayStat->Save();
			
			$this->CalcPosition($match_id);
		}
	}
	
	public function CalcNewRating($match_id) {
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		
		if($oMatch->getPlayed()){
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
			
			$newHomerating = round( ($W + $raznica *0.01 ),2);
			
			//$newHomerating = round($oHomeRating->getRating(),2)+$G*$K * ( $W - 1/(pow(10,(-1)*($oHomeRating->getRating()-$oAwayRating->getRating())/400 ) +1));
			
			$raznica=0;
			$W=0;
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0){$W=1; $raznica=$oMatch->getGoalsAway()-$oMatch->getGoalsHome();}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())==0)$W=0.5;		
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==1){$W=0.5; $raznica=1;}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getSo()==1){$W=0.5; $raznica=1;}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0)$W=0;
			
			$newAwayrating = round( ($W + $raznica *0.01 ),2);
			//$newAwayrating = round($oAwayRating->getRating(),2)+$G*$K * ( $W - 1/(pow(10,(-1)*($oAwayRating->getRating()-$oHomeRating->getRating())/400 ) +1));
			
			$oMatch->setHomeNewRating( number_format(round($newHomerating,2),2, '.', '') );
			$oMatch->setAwayNewRating(   number_format(round($newAwayrating,2),2, '.', '') );
			$oMatch->Save();
			
			$oPlayerTournamentHome->setTournamentRating(  number_format( $oPlayerTournamentHome->getTournamentRating() + $newHomerating, 2, '.', '') );	 
			$oPlayerTournamentHome->Save();	
			
			$oPlayerTournamentAway->setTournamentRating(  number_format( $oPlayerTournamentAway->getTournamentRating() + $newAwayrating, 2, '.', '') );	 
			$oPlayerTournamentAway->Save();
		}				
		
    }
	public function CalcPlayerStat($match_id) {
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		 
		if( ($oMatch->getGametypeId()==3 || $oMatch->getGametypeId()==7 ) && $oMatch->getPlayed()==1 && $oMatch->getTeh()==0){
		
			if($oMatch->getGoalsHome()>$oMatch->getGoalsAway()){
				$winners=$oMatch->getHome();
				$wingoal=$oMatch->getGoalsAway()+1;
			}else{
				$winners=$oMatch->getAway();
				$wingoal=$oMatch->getGoalsHome()+1;
			}
		 
			if($aGoals = $this->PluginVs_Stat_GetMatchgoalItemsByFilter(array(
					'match_id' => $oMatch->getMatchId(),
					//'team_id <>' => $winners,
					'#order' =>array('period'=>'asc', 'minute'=>'asc','secunde'=>'asc'),
					)))
			{
				$goal_w = 0;
				$goal_l = 0;
				$winner_pl = 0;
				$loser_pl = 0;
				$win_goal_author = 0;
				foreach($aGoals as $oGoal){
				
					if( $oGoal->getTeamId() == $winners ){
						$goal_w++;
						if( $wingoal == $goal_w )$win_goal_author = $oGoal->getGoal();
						if( $wingoal == $goal_w ){
							$oGoal->setWining(1); 
						}elseif( $oGoal->getWining() != 0 ){
							$oGoal->setWining(0);												
						} 
						$oGoal->setRaznica( $goal_w - $goal_l - 1);
						
						if( $oGoal->getType()==0 || $oGoal->getType()==2 ){
							$winner_pl++;
						}
					}else{
						$goal_l++;
						 if( $oGoal->getWining() != 0 ){
							$oGoal->setWining(0); 		
						} 
						$oGoal->setRaznica( $goal_l - $goal_w -1 );
						
						if( $oGoal->getType()==0 || $oGoal->getType()==2 ){
							$loser_pl++;
						}
					
					}					
					$oGoal->Save();
				}
				$plus_minus = $winner_pl - $loser_pl;
				
			}
			
			if($aMatchPlayerstat = $this->PluginVs_Stat_GetMatchplayerstatItemsByFilter(array(
					'match_id' => $oMatch->getMatchId(),
					//'team_id <>' => $winners, 
					)))
			{
				foreach($aMatchPlayerstat as $oMatchPlayerstat){
					if( $oMatchPlayerstat->getTeamId() == $winners  && $oMatchPlayerstat->getPosition() !='G'){
						$oMatchPlayerstat->setPlusMinus($plus_minus);
						$oMatchPlayerstat->setShga(0);
					}elseif( $oMatchPlayerstat->getPosition() !='G' ){
						$oMatchPlayerstat->setPlusMinus($plus_minus*(-1));
						$oMatchPlayerstat->setShga(0);				
					}elseif( $oMatchPlayerstat->getPosition() =='G' ){
					
						$oMatchResult = $this->PluginVs_Stat_GetMatchresultByFilter(array(
								'match_id' => $oMatch->getMatchId(),
								'team_id <>' => $oMatchPlayerstat->getTeamId()	));		
								
						$oMatchPlayerstat->setShga($oMatchResult->getShots());					
					}
					if($win_goal_author == $oMatchPlayerstat->getPlayercardId() && $oMatchPlayerstat->getTeamId() == $winners){
						$oMatchPlayerstat->setWinGoal(1); 
					}else{
						$oMatchPlayerstat->setWinGoal(0); 
					}
					$oMatchPlayerstat->Save();
				}
			
			
			}
			
		}
 
		if($oMatch->getGametypeId()==1 || $oMatch->getGametypeId()==6){
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());
			
			if(!$this->PluginVs_Stat_GetPlayerstatByFilter(array(
					'tournament_id' => $oMatch->getTournamentId(),
					'round_id' => $oMatch->getRoundId(),
					'game_id' => $oMatch->getGameId(),
					'gametype_id' => $oMatch->getGametypeId(),
					'user_id' => $oMatch->getHomePlayer()
					)))
			{
				$this->EventCreatePlayerStatTableByMatchId($match_id);
			}
			if(!$this->PluginVs_Stat_GetPlayerstatByFilter(array(
					'tournament_id' => $oMatch->getTournamentId(),
					'round_id' => $oMatch->getRoundId(),
					'game_id' => $oMatch->getGameId(),
					'gametype_id' => $oMatch->getGametypeId(),
					'user_id' => $oMatch->getAwayPlayer()
					)))
			{
				$this->EventCreatePlayerStatTableByMatchId($match_id);
			}
			
			
			if($oHomeStat = $this->PluginVs_Stat_GetPlayerstatByFilter(array(
					'tournament_id' => $oMatch->getTournamentId(),
					'round_id' => $oMatch->getRoundId(),
					'team_id' => $oMatch->getHome(),
					'user_id' => $oMatch->getHomePlayer()					
					)) ){
				if($oTournament){
					if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oHomeStat->setHomeW($oHomeStat->getHomeW()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getWin());}
					if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oHomeStat->setHomeWot($oHomeStat->getHomeWot()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getWinO());}
					if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oHomeStat->setHomeWb($oHomeStat->getHomeWb()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getWinB());}
					if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oHomeStat->setHomeL($oHomeStat->getHomeL()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+0);}
					if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oHomeStat->setHomeLot($oHomeStat->getHomeLot()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getLoseO());}
					if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oHomeStat->setHomeLb($oHomeStat->getHomeLb()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getLoseB());}
					if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())==0 && $oMatch->getTeh()==0){$oHomeStat->setHomeT($oHomeStat->getHomeT()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getPointsN());}
					if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())==0 && $oMatch->getTeh()==1){$oHomeStat->setHomeL($oHomeStat->getHomeL()+1); $oHomeStat->setPoints($oHomeStat->getPoints()+0);}
				}
				if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getTeh()==0 && $oMatch->getGoalsAway()==0)$oHomeStat->setSuhW($oHomeStat->getSuhW()+1);
				if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getTeh()==0 && $oMatch->getGoalsHome()==0)$oHomeStat->setSuhL($oHomeStat->getSuhL()+1);
						
				$oHomeStat->setGf($oHomeStat->getGf()+$oMatch->getGoalsHome());
				$oHomeStat->setGa($oHomeStat->getGa()+$oMatch->getGoalsAway());
				
				$oHomeStat->setYardW($oHomeStat->getYardW() + $oMatch->getHomeYard());
				$oHomeStat->setYardL($oHomeStat->getYardL() + $oMatch->getAwayYard());

				$oHomeStat->Save();
			}
			if($oAwayStat = $this->PluginVs_Stat_GetPlayerstatByFilter(array(
					'tournament_id' => $oMatch->getTournamentId(),
					'round_id' => $oMatch->getRoundId(),
					'team_id' => $oMatch->getAway(),
					'user_id' => $oMatch->getAwayPlayer()			
					))){
				if($oTournament){
					if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oAwayStat->setAwayW($oAwayStat->getAwayW()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+$oTournament->getWin());}
					if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oAwayStat->setAwayWot($oAwayStat->getAwayWot()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+$oTournament->getWinO());}
					if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oAwayStat->setAwayWb($oAwayStat->getAwayWb()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+$oTournament->getWinB());}
					if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oAwayStat->setAwayL($oAwayStat->getAwayL()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+0);}
					if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oAwayStat->setAwayLot($oAwayStat->getAwayLot()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+$oTournament->getLoseO());}
					if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oAwayStat->setAwayLb($oAwayStat->getAwayLb()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+$oTournament->getLoseB());}
					if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())==0 && $oMatch->getTeh()==0){$oAwayStat->setAwayT($oAwayStat->getAwayT()+1); $oAwayStat->setPoints($oAwayStat->getPoints()+$oTournament->getPointsN());}
					if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())==0 && $oMatch->getTeh()==1){$oAwayStat->setAwayL($oAwayStat->getAwayL()+1);; $oAwayStat->setPoints($oAwayStat->getPoints()+0);}
				}
				$oAwayStat->setGf($oAwayStat->getGf()+$oMatch->getGoalsAway());
				$oAwayStat->setGa($oAwayStat->getGa()+$oMatch->getGoalsHome());
				if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getTeh()==0 && $oMatch->getGoalsHome()==0)$oAwayStat->setSuhW($oAwayStat->getSuhW()+1);
				if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getTeh()==0 && $oMatch->getGoalsAway()==0)$oAwayStat->setSuhL($oAwayStat->getSuhL()+1);
				
				$oAwayStat->setYardW($oAwayStat->getYardW() + $oMatch->getAwayYard());
				$oAwayStat->setYardL($oAwayStat->getYardL() + $oMatch->getHomeYard());
				
						
				$oAwayStat->Save();
			}
		}
		//$this->CalcPosition($match_id);
	
	}
	public function DeletePlayerStat($match_id) {
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($oMatch->getTournamentId());
		
		if(!$this->PluginVs_Stat_GetPlayerstatByFilter(array(
				'tournament_id' => $oMatch->getTournamentId(),
				'round_id' => $oMatch->getRoundId(),
				'game_id' => $oMatch->getGameId(),
				'gametype_id' => $oMatch->getGametypeId(),
				'user_id' => $oMatch->getHomePlayer()
				)))
		{
			$this->EventCreatePlayerStatTableByMatchId($match_id);
		}
		if(!$this->PluginVs_Stat_GetPlayerstatByFilter(array(
				'tournament_id' => $oMatch->getTournamentId(),
				'round_id' => $oMatch->getRoundId(),
				'game_id' => $oMatch->getGameId(),
				'gametype_id' => $oMatch->getGametypeId(),
				'user_id' => $oMatch->getAwayPlayer()
				)))
		{
			$this->EventCreatePlayerStatTableByMatchId($match_id);
		}
		
		
		if( $oHomeStat = $this->PluginVs_Stat_GetPlayerstatByFilter(array(
				'tournament_id' => $oMatch->getTournamentId(),
				'round_id' => $oMatch->getRoundId(),
				'team_id' => $oMatch->getHome(),
				'user_id' => $oMatch->getHomePlayer()					
				)) ){
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oHomeStat->setHomeW($oHomeStat->getHomeW()-1); $oHomeStat->setPoints($oHomeStat->getPoints()-$oTournament->getWin());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oHomeStat->setHomeWot($oHomeStat->getHomeWot()-1); $oHomeStat->setPoints($oHomeStat->getPoints()-$oTournament->getWinO());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oHomeStat->setHomeWb($oHomeStat->getHomeWb()-1); $oHomeStat->setPoints($oHomeStat->getPoints()-$oTournament->getWinB());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oHomeStat->setHomeL($oHomeStat->getHomeL()-1); $oHomeStat->setPoints($oHomeStat->getPoints()+0);}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oHomeStat->setHomeLot($oHomeStat->getHomeLot()-1); $oHomeStat->setPoints($oHomeStat->getPoints()-$oTournament->getLoseO());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oHomeStat->setHomeLb($oHomeStat->getHomeLb()-1); $oHomeStat->setPoints($oHomeStat->getPoints()-$oTournament->getLoseB());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())==0 && $oMatch->getTeh()==0){$oHomeStat->setHomeT($oHomeStat->getHomeT()-1); $oHomeStat->setPoints($oHomeStat->getPoints()+$oTournament->getPointsN());}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())==0 && $oMatch->getTeh()==1){$oHomeStat->setHomeL($oHomeStat->getHomeL()-1); $oHomeStat->setPoints($oHomeStat->getPoints()+0);}
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())>0 && $oMatch->getTeh()==0 && $oMatch->getGoalsAway()==0)$oHomeStat->setSuhW($oHomeStat->getSuhW()-1);
			if(($oMatch->getGoalsHome()-$oMatch->getGoalsAway())<0 && $oMatch->getTeh()==0 && $oMatch->getGoalsHome()==0)$oHomeStat->setSuhL($oHomeStat->getSuhL()-1);
					
			$oHomeStat->setGf($oHomeStat->getGf()-$oMatch->getGoalsHome());
			$oHomeStat->setGa($oHomeStat->getGa()-$oMatch->getGoalsAway());
			
			$oHomeStat->setYardW($oHomeStat->getYardW() - $oMatch->getHomeYard());
			$oHomeStat->setYardL($oHomeStat->getYardL() - $oMatch->getAwayYard());
		
			$oHomeStat->Save();
		}
		if( $oAwayStat = $this->PluginVs_Stat_GetPlayerstatByFilter(array(
				'tournament_id' => $oMatch->getTournamentId(),
				'round_id' => $oMatch->getRoundId(),
				'team_id' => $oMatch->getAway(),
				'user_id' => $oMatch->getAwayPlayer()			
				)) ){
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oAwayStat->setAwayW($oAwayStat->getAwayW()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-$oTournament->getWin());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oAwayStat->setAwayWot($oAwayStat->getAwayWot()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-$oTournament->getWinO());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oAwayStat->setAwayWb($oAwayStat->getAwayWb()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-$oTournament->getWinB());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==0 ){$oAwayStat->setAwayL($oAwayStat->getAwayL()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-0);}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==1 && $oMatch->getSo()==0 ){$oAwayStat->setAwayLot($oAwayStat->getAwayLot()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-$oTournament->getLoseO());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getOt()==0 && $oMatch->getSo()==1 ){$oAwayStat->setAwayLb($oAwayStat->getAwayLb()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-$oTournament->getLoseB());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())==0 && $oMatch->getTeh()==0){$oAwayStat->setAwayT($oAwayStat->getAwayT()-1); $oAwayStat->setPoints($oAwayStat->getPoints()-$oTournament->getPointsN());}
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())==0 && $oMatch->getTeh()==1){$oAwayStat->setAwayL($oAwayStat->getAwayL()-1);; $oAwayStat->setPoints($oAwayStat->getPoints()-0);}
			$oAwayStat->setGf($oAwayStat->getGf()-$oMatch->getGoalsAway());
			$oAwayStat->setGa($oAwayStat->getGa()-$oMatch->getGoalsHome());
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())>0 && $oMatch->getTeh()==0 && $oMatch->getGoalsHome()==0)$oAwayStat->setSuhW($oAwayStat->getSuhW()-1);
			if(($oMatch->getGoalsAway()-$oMatch->getGoalsHome())<0 && $oMatch->getTeh()==0 && $oMatch->getGoalsAway()==0)$oAwayStat->setSuhL($oAwayStat->getSuhL()-1);
			
			$oAwayStat->setYardW($oAwayStat->getYardW() - $oMatch->getAwayYard());
			$oAwayStat->setYardL($oAwayStat->getYardL() - $oMatch->getHomeYard());
					
			$oAwayStat->Save();
		}
		//$this->CalcPosition($match_id);
	
	}
	
	public function EventCreatePlayerStatTableByMatchId($match_id) {
		$oMatch = $this->PluginVs_Stat_GetMatchesByMatchId($match_id);
		
		$aTournamentStat = $this->PluginVs_Stat_GetPlayerstatItemsByFilter(array(
			'tournament_id' => $oMatch->getTournamentId(),
			'round_id' => $oMatch->getRoundId(),
			'game_id' => $oMatch->getGameId(),
			'gametype_id' => $oMatch->getGametypeId(),
			'user_id' => $oMatch->getAwayPlayer()
		));
		/*foreach($aTournamentStat as $oTournamentStat) {
			$oTournamentStat->delete();
		}*/
		if(!$aTournamentStat)
		{			
			$Stat_add =  Engine::GetEntity('PluginVs_Stat_Playerstat');
			$Stat_add->setTournamentId($oMatch->getTournamentId());
			$Stat_add->setRoundId($oMatch->getRoundId()); 
			$Stat_add->setTeamId($oMatch->getAway());
			$Stat_add->setUserId($oMatch->getAwayPlayer());
			$Stat_add->setGameId($oMatch->getGameId());
			$Stat_add->setGametypeId($oMatch->getGametypeId());
			$Stat_add->Add();
		}
		
		$aTournamentStat = $this->PluginVs_Stat_GetPlayerstatItemsByFilter(array(
			'tournament_id' => $oMatch->getTournamentId(),
			'round_id' => $oMatch->getRoundId(),
			'game_id' => $oMatch->getGameId(),
			'gametype_id' => $oMatch->getGametypeId(),
			'user_id' => $oMatch->getHomePlayer()
		));
		/*foreach($aTournamentStat as $oTournamentStat) {
			$oTournamentStat->delete();
		}*/
		if(!$aTournamentStat)
		{			
			$Stat_add =  Engine::GetEntity('PluginVs_Stat_Playerstat');
			$Stat_add->setTournamentId($oMatch->getTournamentId());
			$Stat_add->setRoundId($oMatch->getRoundId()); 
			$Stat_add->setTeamId($oMatch->getHome());
			$Stat_add->setUserId($oMatch->getHomePlayer());
			$Stat_add->setGameId($oMatch->getGameId());
			$Stat_add->setGametypeId($oMatch->getGametypeId());
			$Stat_add->Add();
		}
		
	}
	
	public function EventCreateStatTableByTournamentRound($tournament_id,$round_id) {
	
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
}
?>