<?php
class PluginVs_ModuleTopic_EntityTopic extends PluginVs_Inherit_ModuleTopic_EntityTopic {

	public function Init() {
		parent::Init();
		$this->aValidateRules[]=array('topic_title','string','max'=>200,'min'=>2,'allowEmpty'=>false,'label'=>$this->Lang_Get('topic_create_title'),'on'=>array('topic','link','photoset','video'));
		$this->aValidateRules[]=array('topic_title','string','max'=>200,'min'=>2,'allowEmpty'=>false,'label'=>$this->Lang_Get('topic_question_create_title'),'on'=>array('question'));
		$this->aValidateRules[]=array('topic_text_source','string','max'=>Config::Get('module.topic.max_length'),'min'=>2,'allowEmpty'=>false,'label'=>$this->Lang_Get('topic_create_text'),'on'=>array('topic','photoset'));
		$this->aValidateRules[]=array('topic_text_source','string','max'=>500,'min'=>10,'allowEmpty'=>false,'label'=>$this->Lang_Get('topic_create_text'),'on'=>array('link','video'));
		$this->aValidateRules[]=array('topic_text_source','string','max'=>500,'allowEmpty'=>true,'label'=>$this->Lang_Get('topic_create_text'),'on'=>array('question'));
		$this->aValidateRules[]=array('topic_tags','tags','count'=>15,'label'=>$this->Lang_Get('topic_create_tags'),'allowEmpty'=>Config::Get('module.topic.allow_empty_tags'),'on'=>array('topic','link','question','photoset','video'));
		$this->aValidateRules[]=array('blog_id','blog_id','on'=>array('topic','link','question','photoset'));
		$this->aValidateRules[]=array('topic_text_source','topic_unique','on'=>array('topic','link','question','photoset','video'));
		$this->aValidateRules[]=array('topic_type','topic_type','on'=>array('topic','link','question','photoset'));
		$this->aValidateRules[]=array('link_url','url','allowEmpty'=>false,'label'=>$this->Lang_Get('topic_link_create_url'),'on'=>array('link','video'));
	}
	//klaus
	public function getCountCommentSlova() {
		$a = array($this->Lang_Get('plugin.vs.comment'),$this->Lang_Get('plugin.vs.comments_ya'),$this->Lang_Get('plugin.vs.comments'));
		$i = array (2, 0, 1, 1, 1, 2);
		$num=$this->_aData['topic_count_comment'];
		
        return $a[($num%100>4 && $num%100<20)? 2 : $i[min($num%10, 5)]];
    }
	//klaus
	public function getPage() {
		return (floor(($this->getCommentCountLast()-1)/Config::Get('module.comment.nested_per_page')) + 1) ;
	}
	public function getCommentCountLast() {
        return $this->_getDataOne('comment_count_last');
    }

    public function getCommentIdLast() {
        return $this->_getDataOne('comment_id_last');
    }
    public function setCommentCountLast($data) {
        $this->_aData['comment_count_last'] = $data;
    }
    public function setCommentIdLast($data) {
        $this->_aData['comment_id_last'] = $data;
    }	
	public function getSliderAdd() {
		return $this->_getDataOne('topic_slider_add');
	}

	public function setSliderAdd($data) {
		$this->_aData['topic_slider_add'] = $data;
	}

	public function getSticky() {
		return $this->_getDataOne('topic_sticky');
	}

	public function setSticky($data) {
		$this->_aData['topic_sticky'] = $data;
	}

	public function getTopBlogId() {
		return $this->_getDataOne('top_blog_id');
	}

	public function setTopBlogId($data) {
		$this->_aData['top_blog_id'] = $data;
	}
	
	public function getFaq() {
		return $this->_getDataOne('topic_faq');
	}

	public function setFaq($data) {
		$this->_aData['topic_faq'] = $data;
	}
	
	public function getNewsId() {
		if(!isset($this->_aData['news_id']))$this->_aData['news_id']='0';
        return $this->_aData['news_id'];
    }
	public function setNewsId($data) {
        $this->_aData['news_id']=$data;
    } 
	
	public function getIsRead() {
		if(!isset($this->_aData['is_read']))$this->_aData['is_read']='0';
        return $this->_aData['is_read'];
    }
	public function setIsRead($data) {
        $this->_aData['is_read']=$data;
    } 
	
	public function getMatchId() {
		if(!isset($this->_aData['match_id']))$this->_aData['match_id']='0';
        return $this->_aData['match_id'];
    }
	public function setMatchId($data) {
        $this->_aData['match_id']=$data;
    }
	
	public function getTournamentId() {
		if(!isset($this->_aData['tournament_id']))$this->_aData['tournament_id']='0';
        return $this->_aData['tournament_id'];
    }
	public function setTournamentId($data) {
        $this->_aData['tournament_id']=$data;
    } 
	
	 // методы для топика-ссылки
    public function getLinkUrl($bShort=false) {
    	if ($this->getType()!='link' && $this->getType()!='video') {
    		return null;
    	}
    	
    	if ($this->getExtraValue('url')) {
    		if ($bShort) {
    			$sUrl=htmlspecialchars($this->getExtraValue('url'));
    			if (preg_match("/^http:\/\/(.*)$/i",$sUrl,$aMatch)) {
    				$sUrl=$aMatch[1];
    			}
    			$sUrlShort=substr($sUrl,0,30);
    			if (strlen($sUrlShort)!=strlen($sUrl)) {
    				return $sUrlShort.'...';
    			}
    			return $sUrl;
    		}
    		$sUrl=$this->getExtraValue('url');
    		if (preg_match("/^http:\/\/(.*)$/i",$sUrl,$aMatch)) {
    			$sUrl=$aMatch[1];
    		}
    		return 'http://'.$sUrl;
    	}
    	return null;
    }    
    public function getVideo() {
    	if ( $this->getType()!='video') {
    		return null;
    	}
    	
    	if ($this->getExtraValue('url')) {
 
    		$sUrl=$this->getExtraValue('url');
    		if (preg_match("/^http:\/\/(.*)$/i",$sUrl,$aMatch)) {
    			$sUrl=$aMatch[1];
    		}
    		return $this->Text_Parser('<video>http://'.$sUrl.'</video>') ;
    	}
    	return null;
    }    
    public function setLinkUrl($data) {
        if ($this->getType()!='link' && $this->getType()!='video') {
    		return;
    	}
    	$this->setExtraValue('url',$data);
    }
    public function getLinkCountJump() {
    	if ($this->getType()!='link' && $this->getType()!='video') {
    		return null;
    	}
    	return (int)$this->getExtraValue('count_jump');
    }
    public function setLinkCountJump($data) {
        if ($this->getType()!='link' && $this->getType()!='video') {
    		return;
    	}
    	$this->setExtraValue('count_jump',$data);
    }
	public function getUrl($sUrlMask = null, $bFullUrl = true) {
        if (!$sUrlMask) {
            $sUrlMask = Router::GetTopicUrlMask();
        }
        if (!$sUrlMask) {
            // формирование URL по умолчанию в LS-стиле
            if ($this->getBlog()->getType() == 'personal') {
                return Router::GetPath('blog') . $this->getId() . '.html';
            } else {
                return Router::GetPath('blog') . $this->getBlog()->getUrl() . '/' . $this->getId() . '.html';
            }
        }
        // ЧПУ по маске
        $sCreateDate = strtotime($this->GetDateAdd());
        $aReplace = array(
            '%year%'      => date('Y', $sCreateDate),
            '%month%'     => date('m', $sCreateDate),
            '%day%'       => date('d', $sCreateDate),
            '%hour%'      => date('H', $sCreateDate),
            '%minute%'    => date('i', $sCreateDate),
            '%second%'    => date('s', $sCreateDate),
            '%topic_id%'  => $this->GetId(),
            '%topic_url%' => $this->GetTopicUrl(),
        );

        $aReplace['%login%'] = $this->GetUser()->GetLogin();

        if ($this->GetBlog()->getType() == 'personal') {
            $aReplace['%blog_url%'] = $this->GetUser()->GetLogin();
        } else {
            $aReplace['%blog_url%'] = $this->GetBlog()->GetUrl();
        }

        return ($bFullUrl ? F::File_RootUrl(false, $this->getBlog()->getUrl()) : '') . strtr($sUrlMask, $aReplace);
    }
	/* в комплекте надо в file  в functions заменить на 
	static public function RootUrl($xAddLang = false,$subdomain = null) {
        if (class_exists('Config', false)) {
            $sUrl = Config::Get('path.root.url');
			
			$sPrimaryHost=str_replace('http://','', $sUrl);
			if ( in_array($subdomain, Config::Get('plugin.vs.teamplay_team_blogs')) 
				|| in_array($subdomain, Config::Get('plugin.vs.league_blogs'))) {					
					$sUrl = 'http://'.$subdomain.'.'.$sPrimaryHost ; 
				 }
				 
				 
            // Если требуется, то добавляем в URL язык
            if ($xAddLang && Config::Get('lang.in_url') && class_exists('Router', false)) {
                // Если строковый параметр, то это язык
                if (is_string($xAddLang)) {
                    $sLang = $xAddLang;
                } else {
                    // иначе язык берем из роутера
                    $sLang = Router::GetLang();
                }
                if ($sLang) {
                    $sUrl = self::NormPath($sUrl . '/' . $sLang . '/');
                }
            }
        } elseif (isset($_SERVER['HTTP_HOST'])) {
            $sUrl = 'http://' . ($subdomain) ? $subdomain.'.' : '' . $_SERVER['HTTP_HOST'];
        } else {
            $sUrl = null;
        }
        if ($sUrl && substr($sUrl, -1) != '/') {
            $sUrl .= '/';
        }
        return $sUrl;
    }
	*/
	
}

?>