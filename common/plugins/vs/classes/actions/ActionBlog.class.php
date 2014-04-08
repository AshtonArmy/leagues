<?php

class PluginVs_ActionBlog extends PluginVs_Inherit_ActionBlog {	

	protected function AjaxBlogInfo() {

		parent::AjaxBlogInfo(); 
		
		$sBlogId=getRequestStr('idBlog',null,'post');
		
		$selectValues=array();
		if( $aTournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array( 
						'blog_id' => $sBlogId, 
						'#with'         => array('blog'),
						'#order' =>array('datestart'=>'desc') 
					))
						)
					{  	
						
						foreach ($aTournaments as $oTournament){
							$selectValues[$oTournament->getTournamentId()]=$oTournament->getName();
						}						 
					}
		$this->Viewer_AssignAjax('selectValues',$selectValues);
		
	}

}

?>