<?php

class PluginVs_WidgetIndexadvert extends Widget {
    public function Exec() {
		
		$adverts = 6; // сколько объвлений выводим 
		
		$aAdverts=$this->PluginVs_Stat_GetAdvertItemsByFilter(array(  
			'site' => Config::Get('sys.site'),
			'#order' => array('sorter'=>'desc'),
			'#limit' => array('0',$adverts)
		));
		
		foreach($aAdverts as $oAdvert){
			$ResultTopics[$oAdvert->getTopicId()]=$oAdvert->getTopicId();
		}
		$ResultTopics = $this->Topic_GetTopicsAdditionalData($ResultTopics, null);
		/* 
		foreach($aAdverts as $oAdvert){
			if($oUser=$this->User_GetUserById($oAdvert->getFromId())){
				$Results[$oAdvert->getId()]['login']=$oUser->getLogin(); 
				$Results[$oAdvert->getId()]['login']=$oUser->getUserWebPath();
			}
		}*/
					
		$this->Viewer_Assign('aAdverts', $aAdverts);
		$this->Viewer_Assign('ResultTopics', $ResultTopics);
	 
    }
}
?>