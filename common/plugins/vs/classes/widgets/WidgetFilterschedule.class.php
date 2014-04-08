<?php

class PluginVs_WidgetFilterschedule extends Widget {
    public function Exec() {
		 
		if( $this->GetParam('oTournament') ){
			$oTournament=$this->GetParam('oTournament');
		}
		if( $this->GetParam('aFilter') ){
			$aFilter=$this->GetParam('aFilter');
		}
		if($oTournament){		
			$this->Viewer_Assign('oTournament',$oTournament);
		}
		
		$sql          = "select t.team_id from tis_stat_teamsintournament tt, tis_stat_team t where tt.tournament_id='" . $oTournament->getTournamentId() . "' and tt.team_id=t.team_id order by t.name";
		$aTeams_order = $this->PluginVs_Stat_GetAll($sql);
		$teams_order  = array();
		if ($aTeams_order){
			foreach ($aTeams_order as $oTeam_order)
				$teams_order[] = $oTeam_order['team_id'];
		} else {
			$teams_order[0] = 0;
		}
		
		$aTeamsInTournament = $this->PluginVs_Stat_GetTeamsintournamentItemsByFilter(array(
			'tournament_id' => $oTournament->getTournamentId(),
			'#where' => array(
				' 1=1 order by FIELD(team_id,?a)' => array(
					$teams_order
				)
			),
			'#with' => array(
				'team'
			)
		));
		if($aTeamsInTournament)$this->Viewer_Assign('aTeamsInTournament', $aTeamsInTournament);
		if($aFilter)$this->Viewer_Assign('aFilter', $aFilter); 
		 
		$sql          = "select distinct tt.round_id from tis_stat_matches tt where tt.tournament_id='" . $oTournament->getTournamentId() . "' ";
		$aRounds_order = $this->PluginVs_Stat_GetAll($sql);
		$rounds  = array();
		$rounds[] = 0;
		$teams_order[0] =-1;
		if ($aRounds_order){
			foreach ($aRounds_order as $round)
				$rounds[] = $round['round_id'];
		}
		$aRounds = $this->PluginVs_Stat_GetRoundItemsByFilter(array(
			'round_id in' => $rounds ));
		$this->Viewer_Assign('aRounds', $aRounds);
    }
}
?>