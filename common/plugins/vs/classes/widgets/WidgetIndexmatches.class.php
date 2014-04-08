<?php

class PluginVs_WidgetIndexmatches extends Widget {
    public function Exec() {
		
		if( $this->GetParam('oTournament') ){
			$oTournament=$this->GetParam('oTournament');
		}
		if( $this->GetParam('num') ){
			$matches=$this->GetParam('num');
		}else{
			$matches = 10; // сколько матчей выводим
		}
		
		
		if($oTournament)
		$Indexmatches = $this->PluginVs_Stat_StreamReadMainPage($matches, 0, $oTournament->getTournamentId() , 0, 0,  /*1*/ 0, 0); 
		
		 
		//PluginFirephp::GetLog($oBlog);
				
		$this->Viewer_Assign('Indexmatches', $Indexmatches);
		$this->Viewer_Assign('oTournament', $oTournament);
		 
    }
}
?>