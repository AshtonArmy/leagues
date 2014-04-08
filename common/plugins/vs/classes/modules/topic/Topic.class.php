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
class PluginVs_ModuleTopic extends PluginVs_Inherit_ModuleTopic {
	/**
	 * Дополнительная обработка топиков
	 *
	 * @return unknown
	 */
	 protected $aTopicTypes=array(
		'topic','link','question','photoset','video'
	);
	
	public function GetTopicsByBlogId($nBlogId, $iPage = 0, $iPerPage = 0, $aAllowData = array(), $bIdsOnly = true) {

        $aFilter = array('blog_id' => $nBlogId, 'order'=> array('t.topic_sticky desc','t.topic_date_add desc'));

        if (!$aTopics = $this->GetTopicsByFilter($aFilter, $iPage, $iPerPage, $aAllowData)) {
            return false;
        }

        return ($bIdsOnly)
            ? array_keys($aTopics['collection'])
            : $aTopics;
    }
	
	public function GetTopicsByBlog($oBlog, $iPage, $iPerPage, $sShowType = 'good', $sPeriod = null) {

        if (is_numeric($sPeriod)) {
            // количество последних секунд
            $sPeriod = date('Y-m-d H:00:00', time() - $sPeriod);
        }
        $aFilter = array(
            'topic_publish' => 1,
            'blog_id'       => $oBlog->getId(),
			'order'=> array( 't.topic_sticky desc','t.topic_date_add desc')
        );
        if ($sPeriod) {
            $aFilter['topic_date_more'] = $sPeriod;
        }
        switch ($sShowType) {
            case 'good':
                $aFilter['topic_rating'] = array(
                    'value' => Config::Get('module.blog.collective_good'),
                    'type'  => 'top',
                );
                break;
            case 'bad':
                $aFilter['topic_rating'] = array(
                    'value' => Config::Get('module.blog.collective_good'),
                    'type'  => 'down',
                );
                break;
            case 'new':
                $aFilter['topic_new'] = date('Y-m-d H:00:00', time() - Config::Get('module.topic.new_time'));
                break;
            case 'newall':
                // нет доп фильтра
                break;
            case 'discussed':
                $aFilter['order'] = array('t.topic_count_comment desc', 't.topic_id desc');
                break;
            case 'top':
                $aFilter['order'] = array('t.topic_rating desc', 't.topic_id desc');
                break;
            default:
                break;
        }
        return $this->GetTopicsByFilter($aFilter, $iPage, $iPerPage);
    }
	
	public function UpdateTopicSetSlider(ModuleTopic_EntityTopic $oTopic, $slider_add)
    { 
		if($slider_add==0)$oTopic->setSliderAdd(null);
		if($slider_add==1)$oTopic->setSliderAdd(date("Y-m-d H:i:s"));
        if ($this->oMapperTopic->UpdateTopicSetSlider($oTopic)) {

            //чистим зависимые кеши
            $this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array('topic_update', "topic_update_user_{$oTopic->getUserId()}"));
            $this->Cache_Delete("topic_{$oTopic->getId()}");
            return true;
        }
        return false;
    }

	public function UpdateTopicSetSticky(ModuleTopic_EntityTopic $oTopic, $sticky)
    { 
		$oTopic->setSticky($sticky);
        if ($this->oMapperTopic->UpdateTopicSetSticky($oTopic)) {

            //чистим зависимые кеши
            $this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array('topic_update', "topic_update_user_{$oTopic->getUserId()}"));
            $this->Cache_Delete("topic_{$oTopic->getId()}");
            return true;
        }
        return false;
    }
	public function UpdateTopicSetFaq(ModuleTopic_EntityTopic $oTopic, $faq)
    { 
		$oTopic->setFaq($faq);
        if ($this->oMapperTopic->UpdateTopicSetFaq($oTopic)) {

            //чистим зависимые кеши
            $this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array('topic_update', "topic_update_user_{$oTopic->getUserId()}"));
            $this->Cache_Delete("topic_{$oTopic->getId()}");
            return true;
        }
        return false;
    }
	public function UpdateTopicSetTopBlogId(ModuleTopic_EntityTopic $oTopic, $top_blog_id)
    { 
		$oTopic->setTopBlogId($top_blog_id);
        if ($this->oMapperTopic->UpdateTopicSetTopBlogId($oTopic)) {

            //чистим зависимые кеши
            $this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array('topic_update', "topic_update_user_{$oTopic->getUserId()}"));
            $this->Cache_Delete("topic_{$oTopic->getId()}");
            return true;
        }
        return false;
    }
	
	/**
	 * Получает число новых топиков в коллективных блогах
	 *
	 * @return int
	 */
	public function GetCountTopicsCollectiveNew() {
		$sDate=date("Y-m-d H:00:00",time()-Config::Get('module.topic.new_time'));
		$aFilter=array(
			/*'blog_type' => array(
				'open',
			),*/
			'not_blog_id' => array('466'),
			'topic_publish' => 1,
			'topic_new' => $sDate,
		);
		/**
		 * Если пользователь авторизирован, то добавляем в выдачу
		 * закрытые блоги в которых он состоит
		 */
		if($this->oUserCurrent) {
			$aOpenBlogs = $this->Blog_GetAccessibleBlogsByUser($this->oUserCurrent);
			if(count($aOpenBlogs)) $aFilter['blog_type']['close'] = $aOpenBlogs;
		}
		return $this->GetCountTopicsByFilter($aFilter);
	}
	
	 public function GetVideosByBlog($oBlog,$iPage,$iPerPage,$sShowType='good') {
		$aFilter=array(
			'topic_publish' => 1,
			'blog_id' => $oBlog->getId(),
			'topic_type'=>'video'			
		);
		switch ($sShowType) {
			case 'good':
				$aFilter['topic_rating']=array(
					'value' => Config::Get('module.blog.collective_good'),
					'type'  => 'top',
				);			
				break;	
			case 'bad':
				$aFilter['topic_rating']=array(
					'value' => Config::Get('module.blog.collective_good'),
					'type'  => 'down',
				);			
				break;	
			case 'new':
				$aFilter['topic_new']=date("Y-m-d H:00:00",time()-Config::Get('module.topic.new_time'));							
				break;
			default:
				break;
		}		
		if($this->User_IsAuthorization() && $this->User_getUserCurrent()->getSettingsShowOrder()==0){
			$aFilter['order'] = 't.topic_date_add desc';
 
		}elseif($this->User_IsAuthorization() && $this->User_getUserCurrent()->getSettingsShowOrder()==1){
			$aFilter['order'] = 't.topic_last_update desc';
 
		}else{
			$aFilter['order'] = 't.topic_date_add desc';
 
		}
		return $this->GetTopicsByFilter($aFilter,$iPage,$iPerPage);
	}
	public function UpdateTopicTournament(ModuleTopic_EntityTopic $oTopic, $tournament_id)
    { 
		$oTopic->setTournamentId($tournament_id);
        if ($this->oMapperTopic->UpdateTopicTournament($oTopic)) {

            //чистим зависимые кеши
            $this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array('topic_update', "topic_update_user_{$oTopic->getUserId()}"));
            $this->Cache_Delete("topic_{$oTopic->getId()}");
            return true;
        }
        return false;
    }
	public function GetTopicsAdditionalData($aTopicId, $aAllowData = null) {
        if (is_null($aAllowData)) {
            $aAllowData = array('user' => array(), 'blog' => array('owner' => array(), 'relation_user'), 'vote',
                                'favourite', 'fields', 'comment_new');
        }
        func_array_simpleflip($aAllowData);
        if (!is_array($aTopicId)) {
            $aTopicId = array($aTopicId);
        }
        /**
         * Получаем "голые" топики
         */
        $aTopics = $this->GetTopicsByArrayId($aTopicId);
        /**
         * Формируем ID дополнительных данных, которые нужно получить
         */
        $aUserId = array();
        $aBlogId = array();
        $aTopicId = array();
        $aPhotoMainId = array();
		$aTournamentId = array();
        foreach ($aTopics as $oTopic) {
            if (isset($aAllowData['user'])) {
                $aUserId[] = $oTopic->getUserId();
            }
            if (isset($aAllowData['blog'])) {
                $aBlogId[] = $oTopic->getBlogId();
            }
	//klaus
			$aTournamentId[] = $oTopic->getTournamentId();
	//klaus
            //if ($oTopic->getType()=='question')	{
            $aTopicId[] = $oTopic->getId();
            //}
            //if ($oTopic->getType()=='photoset' and $oTopic->getPhotosetMainPhotoId())	{
            $aPhotoMainId[] = $oTopic->getPhotosetMainPhotoId();
            //}
        }
        /**
         * Получаем дополнительные данные
         */
        $aTopicsVote = array();
        $aFavouriteTopics = array();
        $aTopicsQuestionVote = array();
        $aTopicsRead = array();
        $aUsers = isset($aAllowData['user']) && is_array($aAllowData['user']) ? $this->User_GetUsersAdditionalData(
            $aUserId, $aAllowData['user']
        ) : $this->User_GetUsersAdditionalData($aUserId);
        $aBlogs = isset($aAllowData['blog']) && is_array($aAllowData['blog']) ? $this->Blog_GetBlogsAdditionalData(
            $aBlogId, $aAllowData['blog']
        ) : $this->Blog_GetBlogsAdditionalData($aBlogId);
        if (isset($aAllowData['vote']) && $this->oUserCurrent) {
            $aTopicsVote = $this->Vote_GetVoteByArray($aTopicId, 'topic', $this->oUserCurrent->getId());
            $aTopicsQuestionVote = $this->GetTopicsQuestionVoteByArray($aTopicId, $this->oUserCurrent->getId());
        }
        if (isset($aAllowData['favourite']) && $this->oUserCurrent) {
            $aFavouriteTopics = $this->GetFavouriteTopicsByArray($aTopicId, $this->oUserCurrent->getId());
        }
        if (isset($aAllowData['fields'])) {
            $aTopicFieldValues = $this->GetTopicValuesByArrayId($aTopicId);
        }
        if (/*isset($aAllowData['comment_new']) &&*/ $this->oUserCurrent) {
            $aTopicsRead = $this->GetTopicsReadByArray($aTopicId, $this->oUserCurrent->getId());
        }
	//klaus
		$aTopicsTournament = array();
		if ($aTournamentId) {
            $aTopicsTournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
				'tournament_id in' => $aTournamentId		
				));	
			if($aTopicsTournaments){
				foreach($aTopicsTournaments as $oTopicsTournament){
					$aTopicsTournament[$oTopicsTournament->getTournamentId()] = $oTopicsTournament;
				}
			}
        }
	//klaus	
        $aPhotosetMainPhotos = $this->GetTopicPhotosByArrayId($aPhotoMainId);
        /**
         * Добавляем данные к результату - списку топиков
         */
        foreach ($aTopics as $oTopic) {
            if (isset($aUsers[$oTopic->getUserId()])) {
                $oTopic->setUser($aUsers[$oTopic->getUserId()]);
            } else {
                $oTopic->setUser(null); // или $oTopic->setUser(new ModuleUser_EntityUser());
            }
		//klaus	
			 if (isset($aTopicsTournament[$oTopic->getTournamentId()])) {
                $oTopic->setTournament($aTopicsTournament[$oTopic->getTournamentId()]);
            } else {
                $oTopic->setTournament(null);  
            }
		//klaus	
            if (isset($aBlogs[$oTopic->getBlogId()])) {
                $oTopic->setBlog($aBlogs[$oTopic->getBlogId()]);
            } else {
                $oTopic->setBlog(null); // или $oTopic->setBlog(new ModuleBlog_EntityBlog());
            }
            if (isset($aTopicsVote[$oTopic->getId()])) {
                $oTopic->setVote($aTopicsVote[$oTopic->getId()]);
            } else {
                $oTopic->setVote(null);
            }
            if (isset($aFavouriteTopics[$oTopic->getId()])) {
                $oTopic->setFavourite($aFavouriteTopics[$oTopic->getId()]);
            } else {
                $oTopic->setFavourite(null);
            }
            if (isset($aTopicsQuestionVote[$oTopic->getId()])) {
                $oTopic->setUserQuestionIsVote(true);
            } else {
                $oTopic->setUserQuestionIsVote(false);
            }
            if (isset($aTopicFieldValues[$oTopic->getId()])) {
                $oTopic->setTopicValues($aTopicFieldValues[$oTopic->getId()]);
            } else {
                $oTopic->setTopicValues(false);
            }
            if (isset($aTopicsRead[$oTopic->getId()])) {
                $oTopic->setCountCommentNew(
                    $oTopic->getCountComment() - $aTopicsRead[$oTopic->getId()]->getCommentCountLast()
                );
                $oTopic->setDateRead($aTopicsRead[$oTopic->getId()]->getDateRead());
				$oTopic->setIsRead(1);
				$oTopic->setCommentCountLast($aTopicsRead[$oTopic->getId()]->getCommentCountLast());
				$oTopic->setCommentIdLast($aTopicsRead[$oTopic->getId()]->getCommentIdLast());
            } else {
                $oTopic->setCountCommentNew(0);
                $oTopic->setDateRead(F::Now());
				$oTopic->setCommentCountLast(0);
				$oTopic->setCommentIdLast(0);
				if (isset($aAllowData['comment_new']) && $this->oUserCurrent) {
					$oTopic->setIsRead(-1);
				}else{
					$oTopic->setIsRead(0);
				}
            }
            if (isset($aPhotosetMainPhotos[$oTopic->getPhotosetMainPhotoId()])) {
                $oTopic->setPhotosetMainPhoto($aPhotosetMainPhotos[$oTopic->getPhotosetMainPhotoId()]);
            } else {
                $oTopic->setPhotosetMainPhoto(null);
            }
        }
        return $aTopics;
    }
	
	public function increaseTopicCountComment($sTopicId) {
       
		$oTopic = $this->GetTopicById($sTopicId);
		$zapros = $this->Blog_increaseBlogCountComment($oTopic->getBlogId());
		
		$this->Cache_Delete("topic_{$sTopicId}");
        $this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array("topic_update"));
		
        return $this->oMapperTopic->increaseTopicCountComment($sTopicId);
    }
	
}
?>