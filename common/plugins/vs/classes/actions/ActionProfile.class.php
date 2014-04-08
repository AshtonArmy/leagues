<?php

class PluginVs_ActionProfile extends PluginVs_Inherit_ActionProfile {	
	protected function RegisterEvent() {	
		parent::RegisterEvent();   	
		$this->AddEventPreg('/^.+$/i','/^teamplay$/i','EventTeamplay');
	}
	protected function EventTeamplay() {
		if (!$this->CheckUserProfile()) {
			return parent::EventNotFound();
		}
		
		if(Router::GetParam(1)!='' && Router::GetParam(2)!=''){
			$platform = Router::GetParam(2); 
			$oPlatform = $this->PluginVs_Stat_GetPlatformByBrief($platform);
			switch (Router::GetParam(1)) {
				case 'hockey':
					$sport_id='1';
					break;
				case 'football':
					$sport_id='2';
					break;
				case 'battlefield':
					$sport_id='5';
					break;
			}
		
		}else{
			$platform = '0';
			$sport_id='0';
		}
		
		
		//echo Router::GetParam(1);	
		if($aPlayercards=$this->PluginVs_Stat_GetPlayercardItemsByFilter(array(
			'user_id' => $this->oUserProfile->getId(),
			'#with'         => array('platform'),
			'#order'         => array('playercard_id'=>'desc') 						
			)) )
		{
		
			if($platform == '0'){
				$oPlayercard=$aPlayercards[0];
			}else{
				foreach($aPlayercards as $Card){
					if($Card->getPlatformId()==$oPlatform->getPlatformId() && $Card->getSportId()==$sport_id) $oPlayercard = $Card;
				}
			}
			
			$aFilter= array(	
							'who'=>'all', 
							'playercard_id'=>$oPlayercard->getId(),  
							'platform_id'=>$oPlayercard->getPlatformId(), 
							'user_id'=>$oPlayercard->getUserId(), 
							'sport_id'=>$oPlayercard->getSportId(),
							'tournament_id'=>'0', 
							'gametype_id'=>'4',
							'group_by'=>array('s.tournament_id','t.team_id','m.round_id'),
							'get_team'=>'mps');
			$aStats=$this->PluginVs_Stat_PlayerStats($aFilter);
			$this->Viewer_Assign('aStats',$aStats);
			
			//print_r($aStats);
			$aFilter=  array(	
							'who'=>'goalkeeper', 
							'playercard_id'=>$oPlayercard->getId(),  
							'platform_id'=>$oPlayercard->getPlatformId(), 
							'user_id'=>$oPlayercard->getUserId(), 
							'sport_id'=>$oPlayercard->getSportId(),
							'tournament_id'=>'0', 
							'gametype_id'=>'4',
							'group_by'=>array('s.tournament_id','t.team_id','m.round_id'),
							'get_team'=>'mps');
							
			$aStats_Goalkeeper=$this->PluginVs_Stat_PlayerStats($aFilter);
			$this->Viewer_Assign('aStats_Goalkeeper',$aStats_Goalkeeper);	
			
			if($aStats)
			foreach($aStats as $oStat){
				$tournaments[] = $oStat['tournament_id'];
				$teams[] = $oStat['team_id'];
			}
			if($aStats_Goalkeeper)
			foreach($aStats_Goalkeeper as $oStat){
				$tournaments[] = $oStat['tournament_id'];
				$teams[] = $oStat['team_id'];
			}
			if(isset($teams)){
				$oTeams = $this->PluginVs_Stat_GetTeamItemsByFilter(array(
					'team_id in' => $teams
				));
				foreach($oTeams as $oTeam){
					$aTeams[$oTeam->getTeamId()] = $oTeam;
				}
			}
			
			if(isset($tournaments)){
				$oTournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					'tournament_id in' => $tournaments
				));
				foreach($oTournaments as $oTournament){
					$aTournaments[$oTournament->getTournamentId()] = $oTournament;
				}
			}
			
			$oPlayerTournament=$this->PluginVs_Stat_GetPlayertournamentByFilter(array(
			'playercard_id' => $oPlayercard->getPlayercardId(),
			'tournament_id' => 0,
			'#with'         => array('team')					
			));
			
			$this->Viewer_Assign('oPlayercard', $oPlayercard);
			$this->Viewer_Assign('oPlayerTournament', $oPlayerTournament);
			if(isset($aTeams))$this->Viewer_Assign('aTeams', $aTeams);
			if(isset($aTournaments))$this->Viewer_Assign('aTournaments', $aTournaments);
			$this->Viewer_Assign('aPlayercards', $aPlayercards);
			$this->Viewer_Assign('oUserProfile',$this->User_GetUserByLogin($this->sCurrentEvent));
		}
					
		$this->sMenuSubItemSelect='teamplay';
		$this->SetTemplateAction('teamplay');
	}
	
}