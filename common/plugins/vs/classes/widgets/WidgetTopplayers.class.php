<?php

class PluginVs_WidgetTopplayers extends Widget {
    public function Exec() {
		
		if( $this->GetParam('oTournament') ){
			$oTournament=$this->GetParam('oTournament');
		}
		if( $this->GetParam('num') ){
			$players=$this->GetParam('num');
		}else{
			$players = 10; // сколько матчей выводим
		}
		
		
		$aFilter['who']='all';
		
		$this->Viewer_Assign('who',$aFilter['who']);
		
		$aFilter['tournament_id'] = $oTournament->getTournamentId();
		$aFilter['gametype_id'] = $oTournament->getGametypeId();
		$aFilter['group_by'] = array('s.tournament_id');
		$aFilter['limit'] = $players;
		$aFilter['round_id'] = '0';//'100';
		$aStats=$this->PluginVs_Stat_PlayerStats($aFilter);
		
		$this->Viewer_Assign('aStats',$aStats);
		
		foreach($aStats as $oStat){
			$teams[] = $oStat['team_id'];
		}
		if(isset($teams)){
			$oTeams = $this->PluginVs_Stat_GetTeamItemsByFilter(array(
				'team_id in' => $teams
			));
			foreach($oTeams as $oTeam){
				$aTeams[$oTeam->getTeamId()] = $oTeam;
			}
			$this->Viewer_Assign('aTeams', $aTeams);
		}
		
		
		$this->Viewer_Assign('oTournament', $oTournament);
    }
}
?>