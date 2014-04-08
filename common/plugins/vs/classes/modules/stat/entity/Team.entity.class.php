<?php
class PluginVs_ModuleStat_EntityTeam extends EntityORM {
protected $aRelations=array(            
		'game' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGame', 'game_id'),
		'gametype' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGametype', 'gametype_id'),
		'sport' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntitySport', 'sport_id'),		
		'owner' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'owner_id'),
		//'blog' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleBlog_EntityBlog', 'blog_id'),
		'blog_vs' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleBlog_EntityBlog', 'blog_vs_id'),
		'blog_ch' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleBlog_EntityBlog', 'blog_ch_id'),
);

	public function getSlidebyNum($num) { 
		$slides = explode(";", $this->getSlide());
		return isset($slides[$num-1])? $slides[$num-1] : '0';
    }
	
	public function getBlogId() {
		if(Config::Get('sys.site')=='vs'){
			return $this->getBlogVsId();
		}
		if(Config::Get('sys.site')=='ch'){
			return $this->getBlogChId();
		}
	}
	
	public function getBlog() {
		if(Config::Get('sys.site')=='vs'){
			return $this->getBlogVs();
		}
		if(Config::Get('sys.site')=='ch'){
			return $this->getBlogCh();
		}
	}
	
	public function getUrlFull() { 	
		if($this->getBlogId()!=0 && $this->getBlog()){
			return $this->getBlog()->getTeamUrlFull();
		}else{
			return Router::GetPath('team').$this->getTeamId();
		}
    }

}

?>