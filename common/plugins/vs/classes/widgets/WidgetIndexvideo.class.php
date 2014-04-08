<?php

class PluginVs_WidgetIndexvideo extends Widget {
    public function Exec() {
		
		$videos = 4; // сколько объвлений выводим
		
		
		$aFilter=array(
			'topic_publish' => 1, 
			'topic_type'=>'video'			
		);
 	
		$aFilter['order'] = 't.topic_date_add desc';
		$aVideos = $this->Topic_GetTopicsByFilter($aFilter,1,$videos);
		 
		$this->Viewer_Assign('aVideos', $aVideos['collection']);
	 
    }
}
?>