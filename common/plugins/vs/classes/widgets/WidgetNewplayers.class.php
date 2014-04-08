<?php

class PluginVs_WidgetNewplayers extends Widget {
    public function Exec() {
		
		
		if( $aPlayercard_temp = $this->PluginVs_Stat_GetPlayercardItemsByFilter(array(
				'#order' =>array('playercard_id'=>'desc'),
				'#limit' =>array('0','5')
					)) ){
					
			$playercards = array();
			foreach($aPlayercard_temp as $oPlayercard){
				$playercards[]=$oPlayercard->getPlayercardId();	
				$aPlayercards[$oPlayercard->getPlayercardId()] = $oPlayercard;
			}

			if($aPlayerTournament_temp = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
				'playercard_id in' => $playercards,
				'tournament_id'         => '0'	,
				'#with'         => array('team'),
			)))
			{	
				foreach($aPlayerTournament_temp as $oPlayerTournament){
					//$aPlayerTournaments[$oPlayerTournament->getPlayercardId()] = $oPlayerTournament;
					$aPlayercards[$oPlayerTournament->getPlayercardId()]->setTeam($oPlayerTournament->getTeam());
					$playercards[]=$oPlayerTournament->getPlayercardId();			
				}
				//print_r($aPlayerTournaments);
			}
			$this->Viewer_Assign('aPlayercards', $aPlayercards);
		}
		
    }
}
?>