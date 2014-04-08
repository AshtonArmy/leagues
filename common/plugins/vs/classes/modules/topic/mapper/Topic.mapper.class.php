<?php

class PluginVs_ModuleTopic_MapperTopic extends PluginVs_Inherit_ModuleTopic_MapperTopic {
	
	public function UpdateTopicSetSlider(ModuleTopic_EntityTopic $oTopic)
    {
        $sql = "UPDATE " . Config::Get('db.table.topic') . "
			SET
				topic_slider_add = ?
				
			WHERE
				topic_id = ?d
		";
        if ($this->oDb->query($sql, $oTopic->getSliderAdd(), $oTopic->getId())) {
            return true;
        }
        return false;
    }
	
	public function UpdateTopicSetSticky(ModuleTopic_EntityTopic $oTopic)
    {
        $sql = "UPDATE " . Config::Get('db.table.topic') . "
			SET
				topic_sticky = ?d
				
			WHERE
				topic_id = ?d
		";
        if ($this->oDb->query($sql, $oTopic->getSticky(), $oTopic->getId())) {
            return true;
        }
        return false;
    }
	
	public function UpdateTopicSetFaq(ModuleTopic_EntityTopic $oTopic)
    {
        $sql = "UPDATE " . Config::Get('db.table.topic') . "
			SET
				topic_faq = ?d
				
			WHERE
				topic_id = ?d
		";
        if ($this->oDb->query($sql, $oTopic->getFaq(), $oTopic->getId())) {
            return true;
        }
        return false;
    }

	public function UpdateTopicSetTopBlogId(ModuleTopic_EntityTopic $oTopic)
    {
        $sql = "UPDATE " . Config::Get('db.table.topic') . "
			SET
				top_blog_id = ?d
				
			WHERE
				topic_id = ?d
		";
        if ($this->oDb->query($sql, $oTopic->getTopBlogId(), $oTopic->getId())) {
            return true;
        }
        return false;
    }
	
    public function UpdateTopicTournament(ModuleTopic_EntityTopic $oTopic)
    {
        $sql = "UPDATE " . Config::Get('db.table.topic') . "
			SET
				tournament_id = ?d
			WHERE
				topic_id = ?d
		";
        if ($this->oDb->query($sql, $oTopic->getTournamentId(), $oTopic->getId())) {
            return true;
        }
        return false;
    }
	public function AddTopic(ModuleTopic_EntityTopic $oTopic) {
	
		if ( is_null($oTopic->getTournamentId()))
			$tournament_id=0;
		 else
			$tournament_id=$oTopic->getTournamentId();	
			
		$news_id=0;
		if ( is_null($oTopic->getNewsId()))
			$news_id=0;
		else
			$news_id=$oTopic->getNewsId();	
	
	
		$sql = "INSERT INTO ".Config::Get('db.table.topic')." 
			(blog_id,
			user_id,
			topic_type,
			topic_title,			
			topic_tags,
			topic_date_add,
			topic_user_ip,
			topic_publish,
			topic_publish_draft,
			topic_publish_index,
			topic_cut_text,
			topic_forbid_comment,			
			topic_text_hash,
			tournament_id,
			news_id,
			match_id,
			topic_url
			)
			VALUES(?d,  ?d,	?,	?,	?,  ?, ?, ?d, ?d, ?d, ?, ?, ?, ?, ?, ?, ?)
		";			
		if ($iId=$this->oDb->query($sql,$oTopic->getBlogId(),$oTopic->getUserId(),$oTopic->getType(),$oTopic->getTitle(),
			$oTopic->getTags(),$oTopic->getDateAdd(),$oTopic->getUserIp(),$oTopic->getPublish(),$oTopic->getPublishDraft(),$oTopic->getPublishIndex(),$oTopic->getCutText(),$oTopic->getForbidComment(),$oTopic->getTextHash(), $tournament_id, $news_id, $oTopic->getMatchId(), $oTopic->getTopicUrl() )) 
		{
			$oTopic->setId($iId);
			$this->AddTopicContent($oTopic);
			return $iId;
		}		
		return false;
	}
	
protected function buildFilter($aFilter) {

		//$sWhere='';
		$sWhere = parent::buildFilter($aFilter); 
		 
		if (isset($aFilter['no_video'])) {
			$sWhere.=" AND (t.topic_type <>'video' or t.topic_rating >=5  or topic_publish_index=1) ";
		}
		
		if (isset($aFilter['match_id'])) {
			$sWhere.=" AND t.match_id = '".$aFilter['match_id']."' ";
		}
		
		if (isset($aFilter['topic_rating']) and is_array($aFilter['topic_rating'])) {
			$sPublishIndex='';
			//klaus
			$your_blogs='';
			if ( isset($aFilter['topic_rating']['blogs']) && count($aFilter['topic_rating']['blogs'])>0 ){
				$your_blogs = " or t.blog_id IN(".implode(', ',$aFilter['topic_rating']['blogs']).")";
				
			}
			if (isset($aFilter['topic_rating']['publish_index']) and $aFilter['topic_rating']['publish_index']==1) {
				$sPublishIndex=" or topic_publish_index=1 ";
			}
			if ($aFilter['topic_rating']['type']=='top') {
				$sWhere.=" AND ( ( t.topic_rating >= ".(float)$aFilter['topic_rating']['value']." {$sPublishIndex}) {$your_blogs} ) ";
			} else {
				$sWhere.=" AND ( t.topic_rating < ".(float)$aFilter['topic_rating']['value']." {$your_blogs} ) ";
			}	
 			
		}
		//echo $sWhere;
		if (isset($aFilter['topic_new'])) {
			$sWhere.=" AND t.topic_date_add >=  '".$aFilter['topic_new']."'";
		}
		if (isset($aFilter['news_id'])) {
			$sWhere.=" AND t.news_id =  '".$aFilter['news_id']."'";
		}
		
		if (isset($aFilter['platform'])) {
			$sWhere.=" AND b.platform =  '".$aFilter['platform']."'";
		}
		if (isset($aFilter['game'])) {
			$sWhere.=" AND b.game =  '".$aFilter['game']."'";
		}
		if (isset($aFilter['gametype'])) {
			$sWhere.=" AND b.gametype =  '".$aFilter['gametype']."'";
		}
		if (isset($aFilter['tournament_id'])) {
			$sWhere.=" AND t.tournament_id =  '".$aFilter['tournament_id']."'";
		}		 
		
		if (isset($aFilter['not_blog_id'])) {
			if(!is_array($aFilter['not_blog_id'])) {
				$aFilter['not_blog_id']=array($aFilter['not_blog_id']);
			}
			$sWhere.=" AND t.blog_id  not IN ('".join("','",$aFilter['not_blog_id'])."')";
		}
		if (isset($aFilter['top_blog_id'])) {
			if(!is_array($aFilter['top_blog_id'])) {
				$aFilter['top_blog_id']=array($aFilter['top_blog_id']);
			}
			$sWhere.=" AND t.top_blog_id   IN ('".join("','",$aFilter['top_blog_id'])."')";
		}
		if (isset($aFilter['slider_add'])) { 
			if($aFilter['slider_add'] == 'NULL'){
				$sWhere.=" AND t.topic_slider_add IS NULL ";
			}elseif($aFilter['slider_add'] == 'NOT NULL'){
				$sWhere.=" AND t.topic_slider_add IS NOT NULL ";
			}
		}
		if (isset($aFilter['sticky'])) {
            $sWhere .= " AND t.topic_sticky =  '" . $aFilter['sticky'] . "'";
        }
		if (isset($aFilter['faq'])) {
            $sWhere .= " AND t.topic_faq =  '" . $aFilter['faq'] . "'";
        }
		 
		 
		return $sWhere;
	}
}

?>