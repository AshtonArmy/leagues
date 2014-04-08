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

/**
 * Добавляем в функционал в модуль "Topic"
 *
 */
class PluginVs_ModuleBlog extends PluginVs_Inherit_ModuleBlog {
	/**
	 * Дополнительная обработка топиков
	 *
	 * @return unknown
	 */
	public function GetLeagues() {
		$data = $this->oMapperBlog->GetLeagues(); 
		return $data;
	}
	
	 public function increaseBlogCountComment($sBlogId) {
        $this->Cache_Delete("blog_{$sBlogId}");
        $this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array("blog_update"));
		
        return $this->oMapperBlog->increaseBlogCountComment($sBlogId);
    }
	public function GetBlogsAdditionalData($aBlogId, $aAllowData = null, $aOrder = null) {
        
		//print_r($aAllowData);
		if (is_null($aAllowData)) {
            $aAllowData = array('vote', 'owner' => array(), 'relation_user');
        }
        func_array_simpleflip($aAllowData);
        if (!is_array($aBlogId)) {
            $aBlogId = array($aBlogId);
        }
        /**
         * Получаем блоги
         */
        $aBlogs = $this->GetBlogsByArrayId($aBlogId, $aOrder);
        /**
         * Формируем ID дополнительных данных, которые нужно получить
         */
        $aUserId = array();
        foreach ($aBlogs as $oBlog) {
            if (isset($aAllowData['owner'])) {
                $aUserId[] = $oBlog->getOwnerId();
            }
			if (isset($aAllowData['last_topic'])) {
                $aLastTopicsId[] = $oBlog->getLastTopicId();
            }
			if (isset($aAllowData['last_forum_topic'])) {
                $aLastTopicsId[] = $oBlog->getLastTopicId();
            }
        }
        /**
         * Получаем дополнительные данные
         */
        $aBlogUsers = array();
        $aBlogsVote = array();
        $aUsers = (isset($aAllowData['owner']) && is_array($aAllowData['owner']))
            ? $this->User_GetUsersAdditionalData($aUserId, $aAllowData['owner'])
            : $this->User_GetUsersAdditionalData($aUserId);
        if (isset($aAllowData['relation_user']) && $this->oUserCurrent) {
            $aBlogUsers = $this->GetBlogUsersByArrayBlog($aBlogId, $this->oUserCurrent->getId());
        }
        if (isset($aAllowData['vote']) && $this->oUserCurrent) {
            $aBlogsVote = $this->Vote_GetVoteByArray($aBlogId, 'blog', $this->oUserCurrent->getId());
        }
		if (isset($aAllowData['last_topic'])) {
            $aLastTopics = $this->Topic_GetTopicsAdditionalData($aLastTopicsId);
        }
		/*
		if (isset($aAllowData['last_forum_topic'])) {
            //$aLastForumTopics = $this->Topic_GetTopicsAdditionalData($aLastForumTopicsId);

			$aFilter=array(
				'blog_type' => array(
					'open',
				),
				'topic_publish' => 1,
				'blog_id'=>$aBlogId,
			'order'=>' t.topic_last_update desc'
			);

			$aReturn = $this->Topic_GetTopicsByFilter($aFilter,1, 1,array('user','blog','comment_new'));
			$aLastForumTopic = reset($aReturn['collection']); 
        }*/
        /**
         * Добавляем данные к результату - списку блогов
         */
        foreach ($aBlogs as $oBlog) {
            if (isset($aUsers[$oBlog->getOwnerId()])) {
                $oBlog->setOwner($aUsers[$oBlog->getOwnerId()]);
            } else {
                $oBlog->setOwner(null); // или $oBlog->setOwner(new ModuleUser_EntityUser());
            }
			
			if (isset($aLastTopics[$oBlog->getLastTopicId()])) {
                $oBlog->setLastTopic($aLastTopics[$oBlog->getLastTopicId()]);
            } else {
                $oBlog->setLastTopic(null);  
            }
			//print_r($aAllowData);
			/*if (isset($aAllowData['last_forum_topic'])) {
            //$aLastForumTopics = $this->Topic_GetTopicsAdditionalData($aLastForumTopicsId);
				$aFilter=array(
					'blog_type' => array(
						'open',
					),
					'topic_publish' => 1,
					'blog_id'=>$oBlog->getId(),
				'order'=>' t.topic_last_update desc'
				);

				$aReturn = $this->Topic_GetTopicsByFilter($aFilter,1, 1,array('user','blog','comment_new'));
				$aLastForumTopic = reset($aReturn['collection']); 
				//print_r($aReturn);
				if ($aLastForumTopic) { 
					$oBlog->setLastForumTopic($aLastForumTopic);
				} else { 
					$oBlog->setLastForumTopic(null);  
				}
			}*/
		
            if (isset($aBlogUsers[$oBlog->getId()])) {
                $oBlog->setUserIsJoin(true);
                $oBlog->setUserIsAdministrator($aBlogUsers[$oBlog->getId()]->getIsAdministrator());
                $oBlog->setUserIsModerator($aBlogUsers[$oBlog->getId()]->getIsModerator());
            } else {
                $oBlog->setUserIsJoin(false);
                $oBlog->setUserIsAdministrator(false);
                $oBlog->setUserIsModerator(false);
            }
            if (isset($aBlogsVote[$oBlog->getId()])) {
                $oBlog->setVote($aBlogsVote[$oBlog->getId()]);
            } else {
                $oBlog->setVote(null);
            }
        }
        return $aBlogs;
    }
	 public function GetBlogsBySql($sWhere) {
		$data = $this->oMapperBlog->GetBlogsBySql($sWhere);
				$data=$this->GetBlogsAdditionalData($data);
		return $data;
	}
	public function SetTeamLeague($oBlog) {
		$data = $this->oMapperBlog->SetTeamLeague($oBlog); 
		return;
	}
	public function SetLogos($oBlog, $type) {
		$data = $this->oMapperBlog->SetLogos($oBlog, $type); 
		$this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,array('blog_update',"blog_update_{$oBlog->getId()}","topic_update"));
		$this->Cache_Delete("blog_{$oBlog->getId()}");
		return;
	}
	
	public function UpdateTeam(ModuleBlog_EntityBlog $oBlog, $team_id) {
		$data = $this->oMapperBlog->UpdateTeam($oBlog, $team_id); 
		return $data;
	}
	public function GetBlogByTournamentId($tournament_id) {		
		if (false === ($id = $this->Cache_Get("blog_tournament_id_{$tournament_id}"))) {						
			if ($id = $this->oMapperBlog->GetBlogByTournamentId($tournament_id)) {				
				$this->Cache_Set($id, "blog_tournament_id_{$tournament_id}", array("blog_update_{$id}"), 60*60*24*2);				
			} else {
				$this->Cache_Set(null, "blog_tournament_id_{$tournament_id}", array('blog_update','blog_new'), 60*60);
			}
		}		
		return $this->GetBlogById($id);		
	}
	
	public function GetBlogByTeamId($team_id) {		
		$id = $this->oMapperBlog->GetBlogByTeamId($team_id);
		return $this->GetBlogById($id);		
	}
}
?>