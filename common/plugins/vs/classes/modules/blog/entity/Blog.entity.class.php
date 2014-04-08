<?php
/*-------------------------------------------------------
*
*   LiveStreet Engine Social Networking
*   Copyright © 2008 Mzhelskiy Maxim
*
*--------------------------------------------------------
*
*   Official site: www.livestreet.ru
*   Contact e-mail: rus.engine@gmail.com
*
*   GNU General Public License, version 2:
*   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
---------------------------------------------------------
*/

class PluginVs_ModuleBlog_EntityBlog extends PluginVs_Inherit_ModuleBlog_EntityBlog { 

	protected $aExtra=null;
	
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
	
	public function getCategory(){
		if ($oCategoryRel=$this->PluginCategories_Categories_GetByFilter(array('blog_id'=>$this->getBlogId()),'PluginCategories_ModuleCategories_EntityCategoryRel') ) {
			return $this->PluginCategories_Categories_GetByFilter(array('category_id'=>$oCategoryRel->getCategoryId()),'PluginCategories_ModuleCategories_EntityCategory');
		}else{
			return null;
		}
	}
	public function getCountComment() { 
        return $this->_aData['blog_count_comment'];
    }
	public function getLastTopicId() { 
        return $this->_aData['last_topic_id'];
    }
	public function getTeamId() {
		if(!isset($this->_aData['team_id']))$this->_aData['team_id']='0';
        return $this->_aData['team_id'];
    }
	public function setTeamId($data) {
        $this->_aData['team_id']=$data;
    } 
	public function getTeam() {
		if(!isset($this->_aData['team']))$this->_aData['team']='0';
        return $this->_aData['team'];
    }
	public function setTeam($data) {
        $this->_aData['team']=$data;
    } 
	public function getLeague() {
		if(!isset($this->_aData['league']))$this->_aData['league']='0';
        return $this->_aData['league'];
    }
	public function setLeague($data) {
        $this->_aData['league']=$data;
    } 	
	
	public function getLogoSmall() { 
        return $this->_aData['logo_small'];
    }
	public function setLogoSmall($data) {
        $this->_aData['logo_small']=$data;
    } 
	public function getLogoFull() { 
        return $this->_aData['logo_full'];
    }
	public function setLogoFull($data) {
        $this->_aData['logo_full']=$data;
    }
	public function getLogoTeam() { 
        return $this->_aData['logo_team'];
    }
	public function setLogoTeam($data) {
        $this->_aData['logo_team']=$data;
    }	
  /*
	public function getPlatform() {
		if(!isset($this->_aData['platform']))$this->_aData['platform']='';
        return $this->_aData['platform'];
    }

	public function getGame() {
		if(!isset($this->_aData['game']))$this->_aData['game']='';
        return $this->_aData['game'];
    }
	public function getGametype() {
		if(!isset($this->_aData['gametype']))$this->_aData['gametype']='';
        return $this->_aData['gametype'];
    }	
	public function getTournament() {
		if(!isset($this->_aData['tournament_id']))$this->_aData['tournament_id']='0';
        return $this->_aData['tournament_id'];
    }		
	public function getTournamentId() {
		if(!isset($this->_aData['tournament_id']))$this->_aData['tournament_id']='0';
        return $this->_aData['tournament_id'];
    }
*/
 /*
    public function getUrlFull() { 
        if ($this->getType()=='personal') {
    		return Router::GetPath('my').$this->getOwner()->getLogin().'/';
    	} else {
		
			$sPrimaryHost=str_replace('http://','',DIR_WEB_ROOT);
			$add = ( in_array($this->getUrl(), Config::Get('plugin.vs.teamplay_team_blogs')) 
						||
					in_array($this->getUrl(), Config::Get('plugin.vs.league_blogs'))) ? '_blog/' : '' ; 
			return 'http://'.$this->getUrl().'.'.$sPrimaryHost.'/'.$add ; 
    	}	 
    }
*/
	   public function getUrlFull() {
        if ($this->getType() == 'personal') {
            return $this->getOwner()->getUserUrl() . 'created/topics/';
        } else {
		
			$sPrimaryHost=str_replace('http://','',DIR_WEB_ROOT);
			if ( in_array($this->getUrl(), Config::Get('plugin.vs.teamplay_team_blogs')) 
				|| in_array($this->getUrl(), Config::Get('plugin.vs.league_blogs'))) {					
					return 'http://'.$this->getUrl().'.'.$sPrimaryHost.'/'.'_blog/' ; 
				 }	
				 
            return Router::GetPath('blog') . $this->getUrl() . '/';
        }
    }
	
 
	public function getTeamUrlFull() {         
		$sPrimaryHost=str_replace('http://','',DIR_WEB_ROOT); 
		return 'http://'.$this->getUrl().'.'.$sPrimaryHost.'/';
    }
	public function getLeagueUrlFull() {         
		$sPrimaryHost=str_replace('http://','',DIR_WEB_ROOT); 
		return 'http://'.$this->getUrl().'.'.$sPrimaryHost.'/';

    }
	
	public function getTournaments() {
		
		$aTournaments =  $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					'zavershen' => '0',
					'blog_id' => $this->getId(),
					'#order' =>array('datestart'=>'desc') 
				));
		
		return $aTournaments;
	}
}
?>