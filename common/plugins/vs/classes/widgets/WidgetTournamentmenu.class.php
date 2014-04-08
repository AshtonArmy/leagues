<?php
/*---------------------------------------------------------------------------
 * @Project: Alto CMS
 * @Project URI: http://altocms.com
 * @Description: Advanced Community Engine
 * @Version: 0.9a
 * @Copyright: Alto CMS Team
 * @License: GNU GPL v2 & MIT
 *----------------------------------------------------------------------------
 */


/**
 * Регистрация хука
 *
 */
class PluginVs_WidgetTournamentmenu extends Widget {
    /**
     * Запуск обработки
     */
    public function Exec() { 
		
		
		if( $this->GetParam('oTournament') ){
			$oTournament=$this->GetParam('oTournament');
			$this->Viewer_Assign("whats","");
		}else{
			$oTournament = $this -> PluginVs_Stat_GetTournamentByUrl(Router::GetActionEvent());
			$this->Viewer_Assign("whats",Router::GetParam(0));
		}
		//$sql="select distinct 1 from tis_stat_playoff where tournament_id=".$oTournament->getTournamentId();
		//if($this->PluginVs_Stat_GetAll($sql))$this->Viewer_Assign('po',1);
		
		
		$this->Viewer_Assign("oTournament",$oTournament);
		$this->Viewer_Assign("oGame",$oTournament->getGame());
		
	  
    }
}
// EOF