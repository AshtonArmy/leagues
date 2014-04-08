<?php

class PluginVs_WidgetTournamentdescription extends Widget {
    public function Exec() {
		 
		if( $this->GetParam('oTournament') ){
			$oTournament=$this->GetParam('oTournament');
		}	
		if($oTournament){
		 //Блок турнира		
			$this->Viewer_Assign('tournament',1);
			$aTournamentAdmins = $this->PluginVs_Stat_GetTournamentadminItemsByFilter(array(
				'tournament_id' => $oTournament->getTournamentId(),
				'status' => 'admin',
				'#with'         => array('user')				
			));		
			
			$this->Viewer_Assign('aTournamentAdmins',$aTournamentAdmins);
			$aTournamentAssists = $this->PluginVs_Stat_GetTournamentadminItemsByFilter(array(
				'tournament_id' => $oTournament->getTournamentId(),
				'status' => 'moderator',
				'#with'         => array('user')				
			));		
			$this->Viewer_Assign('aTournamentAssists',$aTournamentAssists);
			
			$sql="select count(*) as total, sum(played) as played from tis_stat_matches where tournament_id='".$oTournament->getTournamentId()."' and round_id<>1 group by tournament_id";
			$aMatches=Engine::GetInstance()->PluginVs_Stat_GetAll($sql);
			$matches_total=0;
			$matches_played=0;
			$matches_total=$aMatches[0]['total'];
			$matches_played=$aMatches[0]['played'];	 
			$this->Viewer_Assign('matches_total',$matches_total);
			$this->Viewer_Assign('matches_played',$matches_played);
			
			if($oTournament->getTournamentId()==75){
				$sql="select sum(ts.home_w + ts.away_w) as vs_wins,
				sum(ts.home_l + ts.away_l) as ks_wins,
				 gvs.name  as vs_name,
				 gks.name  as ks_name
				from tis_stat_tournamentstat ts

				left join tis_stat_group gvs
					on gvs.group_id = 26

				left join tis_stat_group gks
					on  gks.group_id = 27

				where ts.tournament_id = 75 
					and ts.group_id = 26
                                group by ts.tournament_id, gvs.name, gks.name";
				$aSeriyaStat=$this->PluginVs_Stat_GetAll($sql);
				$this->Viewer_Assign('aSeriyaStat',$aSeriyaStat[0]);
			}
			$this->Viewer_Assign('oTournament',$oTournament);
	//Блок турнира	
		}
    }
}
?>