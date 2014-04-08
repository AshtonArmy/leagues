<?php

class PluginMainpage_WidgetSlider extends Widget {
    public function Exec() {
		$this->oUserCurrent=$this->User_GetUserCurrent();
		if( $this->GetParam('oBlog') ){
			$oBlog=$this->GetParam('oBlog');
		}
		$aFilter=array(
			'blog_type' => array(
				'personal',
				'open'
			),
			'slider_add' => 'NOT NULL',
			'topic_publish' => 1,
		);
		 
		$aFilter['order']=array('t.topic_slider_add desc');
		
		if($oBlog){
			$aFilter['blog_id']=$oBlog->getId();
		}else{
			/*$aFilter['order']=array(
					'value' => Config::Get('module.blog.index_good'),
					'type'  => 'top',
					'publish_index'  => 1,
				);*/
		}
		$bAddAccessible =true;
		//print_r($aFilter);
		if($this->oUserCurrent && $bAddAccessible) {
			$aOpenBlogs = $this->Blog_GetAccessibleBlogsByUser($this->oUserCurrent);
			if(count($aOpenBlogs)) $aFilter['blog_type']['close'] = $aOpenBlogs;
		}
		$aBlockTopics = $this->Topic_GetTopicsByFilter($aFilter,1 ,6 );
		$this->Viewer_Assign('aBlockTopics',$aBlockTopics['collection']);
		$this->Viewer_Assign('oUserCurrent',$this->oUserCurrent);
		
    }
}
?>