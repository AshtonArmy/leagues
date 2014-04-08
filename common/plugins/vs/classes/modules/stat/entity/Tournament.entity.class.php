<?php
class PluginVs_ModuleStat_EntityTournament extends EntityORM {
protected $aRelations=array(            
        'game' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGame', 'game_id'),		
		'blog' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleBlog_EntityBlog', 'blog_id'),
		'waitlist' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleTopic_EntityTopic', 'waitlist_topic_id'),
		'prolong' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleTopic_EntityTopic', 'prolong_topic_id'),
		'gametype' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGametype', 'gametype_id'),
		'miniturnir' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityMiniturnir', 'miniturnir_id')
);
	protected $aExtra=null;
	
	public function getUrlFull() { 
		$sPrimaryHost=str_replace('http://','',DIR_WEB_ROOT); 
		return 'http://'.$this->getBlogUrl().'.'.$sPrimaryHost.'/tournament/'.$this->getUrl()."/";
        //return Router::GetPath('tournament').$this->getUrl()."/";
    }
	
	public function getExtra()
    {
        return $this->_getDataOne('tournament_extra') ? $this->_getDataOne('tournament_extra') : serialize('');
    }

    /**
     * Расширения методов
     */
    protected function extractExtra() {
        if (is_null($this->aExtra)) {
            $this->aExtra=@unserialize($this->getExtra());
        }
    }
    protected function setExtraValue($sName,$data) {
        $this->extractExtra();
        $this->aExtra[$sName]=$data;
        $this->setExtra($this->aExtra);
    }
    protected function getExtraValue($sName) {
        $this->extractExtra();
        if (isset($this->aExtra[$sName])) {
            return $this->aExtra[$sName];
        }
        return null;
    }
	
	
	public function setShowFullStatTable($data) {
        $this->setExtraValue('show_full_stat_table',$data);
    }

    public function getShowFullStatTable() {
        return $this->getExtraValue('show_full_stat_table');
    }
	
	public function setShowParentStatTable($data) {
        $this->setExtraValue('show_parent_stat_table',$data);
    }

    public function getShowParentStatTable() {
        return $this->getExtraValue('show_parent_stat_table');
    }
	
	public function setShowGroupStatTable($data) {
        $this->setExtraValue('show_group_stat_table',$data);
    }

    public function getShowGroupStatTable() {
        return $this->getExtraValue('show_group_stat_table');
    }
	public function setExtra($data)
    {
        $this->_aData['tournament_extra']=serialize($data);
    }
}
?>