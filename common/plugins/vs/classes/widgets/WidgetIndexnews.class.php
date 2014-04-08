<?php

class PluginVs_WidgetIndexnews extends Widget {
    public function Exec() {
		
		$news=6;
		
		if( $this->GetParam('oBlog') ){
			$oBlog=$this->GetParam('oBlog');
		}		
		
		$aFilter=array(
			'blog_type' => array(
				'personal',
				'open'
			),
			'topic_publish' => 1,
			'slider_add' => 'NULL',
			'topic_rating'  => array(
				'value' => Config::Get('module.blog.index_good'),
				'type'  => 'top',
				'publish_index'  => 1,
			)
		);
		if($oBlog)$aFilter['blog_id']=$oBlog->getId(); 
		
		if($this->oUserCurrent ) {
			$aOpenBlogs = $this->Blog_GetAccessibleBlogsByUser($this->oUserCurrent);
			if(count($aOpenBlogs)) $aFilter['blog_type']['close'] = $aOpenBlogs;
		}

		$aNews = $this->Topic_GetTopicsByFilter($aFilter,1,$news);
		
		$this->Viewer_Assign('aNews', $aNews['collection']);
	 
    }
}
?>