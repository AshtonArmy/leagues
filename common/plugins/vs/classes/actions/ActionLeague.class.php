<?php
/*
 * Пример нового экшна. Задаем новые страницы (не забудьте сконфигурировать роутинг в config.php плагина)
 *
 */

class PluginVs_ActionLeague extends ActionPlugin {
    private $sPlugin = 'league';
	/**
	 * Инизиализация экшена
	 *
	 */
	public function Init() {
        $this->SetDefaultEvent('index'); // ПРи ображении к domain.com/somepage будет вызываться EventIndex()
		$this->oUserCurrent = $this->User_GetUserCurrent();
		
		$this->Lang_AddLangJs(array(
				'blog_join','blog_leave'
			));
			
		$sBlogUrl=$_REQUEST['subdomain'];
		if (!($oBlog=$this->Blog_GetBlogByUrl($sBlogUrl))) {
			return parent::EventNotFound();
		}
		$this->Viewer_Assign('oBlog',$oBlog);
		$this->Hook_Run('league_show',array("oBlog"=>$oBlog));
		
		$this->Viewer_AddHtmlTitle($oBlog->getTitle());
	}
	
	/**
	 * Регистрируем евенты, по сути определяем УРЛы вида /somepage/.../
	 *
	 */
	protected function RegisterEvent() { 
		$this->AddEvent('index','EventLeague'); 
		
		$this->AddEvent('_blog','EventShowBlog'); 
		$this->AddEvent('_video','EventShowVideo');  
	}

	protected function EventLeague() {
		$first="helloworld";
		$sBlogUrl=$_REQUEST['subdomain'];
		if (!($oBlog=$this->Blog_GetBlogByUrl($sBlogUrl))) {
			return parent::EventNotFound();
		}
		$this->Viewer_Assign('oBlog',$oBlog);
		$this->Viewer_AddHtmlTitle($oBlog->getTitle());	
		
		$this->Viewer_AddWidget('main','slider',array('plugin'=>'mainpage', 'oBlog'=>$oBlog),202);
		$this->Viewer_AddWidget('main','subpage',array('plugin'=>'mainpage', 'oBlog'=>$oBlog),201);
		$this->Viewer_AddWidget('right','rightslider',array('plugin'=>'mainpage', 'oBlog'=>$oBlog),201);
 	
		
		$this->Viewer_AddWidget('main_top','indexmatches',array('plugin'=>'vs', 'oBlog'=>$oBlog),202);
		$this->Viewer_AddWidget('right','stream',array(),200); 
		//$this->Viewer_AddWidget('videolist','indexvideo',array('plugin'=>'vs', 'oBlog'=>$oBlog),202);
		// не работает $this->Viewer_AddWidget('newslist','indexnews',array('plugin'=>'vs', 'oBlog'=>$oBlog),202);
		//$this->Viewer_AddWidget('advertlist','indexadvert',array('plugin'=>'vs', 'oBlog'=>$oBlog),202);
		//$this->Viewer_AddWidget('right','stream',array(),200); 
		$this->SetTemplateAction('index');
		
 		
	}
	protected function EventShowBlog() {
		
		$sPeriod=1; // по дефолту 1 день
		if (in_array(getRequest('period'),array(1,7,30,'all'))) {
			$sPeriod=getRequest('period');
		}
		//$sBlogUrl=$this->sCurrentEvent;
		$sBlogUrl=$_REQUEST['subdomain'];
		
		$sShowType=in_array($this->GetParamEventMatch(0,0),array('bad','new','newall','discussed','top')) ? $this->GetParamEventMatch(0,0) : 'good';
		if (!in_array($sShowType,array('discussed','top'))) {
			$sPeriod='all';
		}
		/**
		 * Проверяем есть ли блог с таким УРЛ
		 */
		if (!($oBlog=$this->Blog_GetBlogByUrl($sBlogUrl))) {
			return parent::EventNotFound();
		}
		$this->Viewer_AddWidget('right','rightslider',array('plugin'=>'mainpage', 'oBlog'=>$oBlog),201);
		$this->Viewer_AddWidget('right','stream',array(),200); 
		
		//$this->Hook_Run('team_show',array("oBlog"=>$oBlog));
		/**
		 * Определяем права на отображение закрытого блога
		 */
		if($oBlog->getType()=='close'
			and (!$this->oUserCurrent
				or !in_array(
					$oBlog->getId(),
					$this->Blog_GetAccessibleBlogsByUser($this->oUserCurrent)
				)
			)
		) {
			$bCloseBlog=true;
		} else {
			$bCloseBlog=false;
		}
		/**
		 * Меню
		 */
		$this->sMenuSubItemSelect=$sShowType=='newall' ? 'new' : $sShowType;
		$this->sMenuSubBlogUrl=$oBlog->getUrlFull();
		/**
		 * Передан ли номер страницы
		 */
		/*$iPage= $this->GetParamEventMatch(($sShowType=='good')?0:1,2) ? $this->GetParamEventMatch(($sShowType=='good')?0:1,2) : 1;
		if ($iPage==1 and !getRequest('period') and in_array($sShowType,array('discussed','top'))) {
			$this->Viewer_SetHtmlCanonical($oBlog->getUrlFull().$sShowType.'/');
		}*/
$iPage=1;
		if(Router::GetParam(0)){
			if(substr(Router::GetParam(0), 0, 4)=='page'){
				$iPage=substr(Router::GetParam(0), 4, strlen(Router::GetParam(0))-4);
			}
		}

		if (!$bCloseBlog) {
			/**
			 * Получаем список топиков
			 */
			$aResult=$this->Topic_GetTopicsByBlog($oBlog,$iPage,Config::Get('module.topic.per_page'),$sShowType,$sPeriod=='all' ? null : $sPeriod*60*60*24);
			/**
			 * Если нет топиков за 1 день, то показываем за неделю (7)
			 */
			if (in_array($sShowType,array('discussed','top')) and !$aResult['count'] and $iPage==1 and !getRequest('period')) {
				$sPeriod=7;
				$aResult=$this->Topic_GetTopicsByBlog($oBlog,$iPage,Config::Get('module.topic.per_page'),$sShowType,$sPeriod=='all' ? null : $sPeriod*60*60*24);
			}
			$aTopics=$aResult['collection'];
			/**
			 * Формируем постраничность
			 */
			$aPaging=($sShowType=='good')
				? $this->Viewer_MakePaging($aResult['count'],$iPage,Config::Get('module.topic.per_page'),Config::Get('pagination.pages.count'),rtrim($oBlog->getUrlFull(),'/'))
				: $this->Viewer_MakePaging($aResult['count'],$iPage,Config::Get('module.topic.per_page'),Config::Get('pagination.pages.count'),$oBlog->getUrlFull().$sShowType,array('period'=>$sPeriod));
			/**
			 * Получаем число новых топиков в текущем блоге
			 */
			$this->iCountTopicsBlogNew=$this->Topic_GetCountTopicsByBlogNew($oBlog);

			$this->Viewer_Assign('aPaging',$aPaging);
			$this->Viewer_Assign('aTopics',$aTopics);
			if (in_array($sShowType,array('discussed','top'))) {
				$this->Viewer_Assign('sPeriodSelectCurrent',$sPeriod);
				$this->Viewer_Assign('sPeriodSelectRoot',$oBlog->getUrlFull().$sShowType.'/');
			}
		}
		/**
		 * Выставляем SEO данные
		 */
		$sTextSeo=strip_tags($oBlog->getDescription());
		$this->Viewer_SetHtmlDescription(func_text_words($sTextSeo, Config::Get('seo.description_words_count')));
		/**
		 * Получаем список юзеров блога
		 */
		$aBlogUsersResult=$this->Blog_GetBlogUsersByBlogId($oBlog->getId(),ModuleBlog::BLOG_USER_ROLE_USER,1,Config::Get('module.blog.users_per_page'));
		$aBlogUsers=$aBlogUsersResult['collection'];
		$aBlogModeratorsResult=$this->Blog_GetBlogUsersByBlogId($oBlog->getId(),ModuleBlog::BLOG_USER_ROLE_MODERATOR);
		$aBlogModerators=$aBlogModeratorsResult['collection'];
		$aBlogAdministratorsResult=$this->Blog_GetBlogUsersByBlogId($oBlog->getId(),ModuleBlog::BLOG_USER_ROLE_ADMINISTRATOR);
		$aBlogAdministrators=$aBlogAdministratorsResult['collection'];
		/**
		 * Для админов проекта получаем список блогов и передаем их во вьювер
		 */
		if($this->oUserCurrent and $this->oUserCurrent->isAdministrator()) {
			$aBlogs = $this->Blog_GetBlogs();
			unset($aBlogs[$oBlog->getId()]);

			$this->Viewer_Assign('aBlogs',$aBlogs);
		}
		/**
		 * Вызов хуков
		 */
		$this->Hook_Run('blog_collective_show',array('oBlog'=>$oBlog,'sShowType'=>$sShowType));
		/**
		 * Загружаем переменные в шаблон
		 */
		$this->Viewer_Assign('aBlogUsers',$aBlogUsers);
		$this->Viewer_Assign('aBlogModerators',$aBlogModerators);
		$this->Viewer_Assign('aBlogAdministrators',$aBlogAdministrators);
		$this->Viewer_Assign('iCountBlogUsers',$aBlogUsersResult['count']);
		$this->Viewer_Assign('iCountBlogModerators',$aBlogModeratorsResult['count']);
		$this->Viewer_Assign('iCountBlogAdministrators',$aBlogAdministratorsResult['count']+1);
		$this->Viewer_Assign('oBlog',$oBlog);
		$this->Viewer_Assign('bCloseBlog',$bCloseBlog);
		/**
		 * Устанавливаем title страницы
		 */
		$this->Viewer_SetHtmlRssAlternate(Router::GetPath('rss').'blog/'.$oBlog->getUrl().'/',$oBlog->getTitle());
		/**
		 * Устанавливаем шаблон вывода
		 */
		$this->SetTemplateAction('blog');
	}
	protected function EventShowVideo() {
	 
		$sBlogUrl=$_REQUEST['subdomain'];
		$sShowType=in_array($this->GetParamEventMatch(0,0),array('bad','new')) ? $this->GetParamEventMatch(0,0) : 'good';
		/**
		 * Проверяем есть ли блог с таким УРЛ
		 */
		if (!($oBlog=$this->Blog_GetBlogByUrl($sBlogUrl))) {
			return parent::EventNotFound();
		}
		/**
		 * Определяем права на отображение закрытого блога
		 */
		 
		
		$this->Hook_Run('team_show',array("oBlog"=>$oBlog));
		if($oBlog->getType()=='close'
			and (!$this->oUserCurrent
				or !in_array(
						$oBlog->getId(),
						$this->Blog_GetAccessibleBlogsByUser($this->oUserCurrent)
					)
				)
			) {
			$bCloseBlog=true;
		} else {
			$bCloseBlog=false;
		}

		/**
		 * Меню
		 */
		$this->sMenuSubItemSelect=$sShowType;
		$this->sMenuSubBlogUrl=$oBlog->getUrlFull();
		/**
		 * Передан ли номер страницы
		 */
		//$iPage= $this->GetParamEventMatch(($sShowType=='good')?0:1,2) ? $this->GetParamEventMatch(($sShowType=='good')?0:1,2) : 1;
		$iPage=1;
		if(Router::GetParam(0)){
			if(substr(Router::GetParam(0), 0, 4)=='page'){
				$iPage=substr(Router::GetParam(0), 4, strlen(Router::GetParam(0))-4);
			}
		}


		if (!$bCloseBlog) {
			/**
		 	* Получаем список топиков
		 	*/
			$aResult=$this->Topic_GetVideosByBlog($oBlog,$iPage,Config::Get('module.topic.per_page'),$sShowType);
			$aTopics=$aResult['collection'];
			/**
		 	* Формируем постраничность
		 	*/
			$aPaging=($sShowType=='good')
			? $this->Viewer_MakePaging($aResult['count'],$iPage,Config::Get('module.topic.per_page'),4,rtrim($oBlog->getUrlFull(),'/'))
			: $this->Viewer_MakePaging($aResult['count'],$iPage,Config::Get('module.topic.per_page'),4,$oBlog->getUrlFull().$sShowType);
			/**
		 	* Получаем число новых топиков в текущем блоге
		 	*/
			$this->iCountTopicsBlogNew=$this->Topic_GetCountTopicsByBlogNew($oBlog);

			$this->Viewer_Assign('aPaging',$aPaging);
			$this->Viewer_Assign('aTopics',$aTopics);
		}
		/**
		 * Выставляем SEO данные
		 */
		$sTextSeo=preg_replace("/<.*>/Ui",' ',$oBlog->getDescription());
		$this->Viewer_SetHtmlDescription(func_text_words($sTextSeo,20));
		/**
		 * Получаем список юзеров блога
		 */
		$aBlogUsersResult=$this->Blog_GetBlogUsersByBlogId($oBlog->getId(),ModuleBlog::BLOG_USER_ROLE_USER,1,Config::Get('module.blog.users_per_page'));
		$aBlogUsers=$aBlogUsersResult['collection'];
		$aBlogModeratorsResult=$this->Blog_GetBlogUsersByBlogId($oBlog->getId(),ModuleBlog::BLOG_USER_ROLE_MODERATOR);
		$aBlogModerators=$aBlogModeratorsResult['collection'];
		$aBlogAdministratorsResult=$this->Blog_GetBlogUsersByBlogId($oBlog->getId(),ModuleBlog::BLOG_USER_ROLE_ADMINISTRATOR);
		$aBlogAdministrators=$aBlogAdministratorsResult['collection'];

	/**
		 * Для админов проекта получаем список блогов и передаем их во вьювер
		 */
		if($this->oUserCurrent and $this->oUserCurrent->isAdministrator()) {
			$aBlogs = $this->Blog_GetBlogs();
			unset($aBlogs[$oBlog->getId()]);

			$this->Viewer_Assign('aBlogs',$aBlogs);
		}
		/**
		 * Вызов хуков
		 */
		$this->Hook_Run('blog_collective_show',array('oBlog'=>$oBlog,'sShowType'=>$sShowType));
		/**
		 * Загружаем переменные в шаблон
		 */
		$this->Viewer_Assign('aBlogUsers',$aBlogUsers);
		$this->Viewer_Assign('aBlogModerators',$aBlogModerators);
		$this->Viewer_Assign('aBlogAdministrators',$aBlogAdministrators);
		$this->Viewer_Assign('iCountBlogUsers',$aBlogUsersResult['count']);
		$this->Viewer_Assign('iCountBlogModerators',$aBlogModeratorsResult['count']);
		$this->Viewer_Assign('iCountBlogAdministrators',$aBlogAdministratorsResult['count']+1);
		$this->Viewer_Assign('oBlog',$oBlog);
		$this->Viewer_Assign('bCloseBlog',$bCloseBlog);
		$this->Viewer_SetHtmlRssAlternate(Router::GetPath('rss').'blog/'.$oBlog->getUrl().'/',$oBlog->getTitle());
		/**
		 * Устанавливаем шаблон вывода
		 */
		$team_id=0;
		if($oBlog && $oBlog->getTeamId()!=0)$team_id=$oBlog->getTeamId();	 
		if($team_id)$oTeam=$this->PluginVs_Stat_GetTeamByTeamId($team_id);	
		
		$this->Viewer_Assign('oTeam', $oTeam );
		if($this->checkRight($team_id))	$this->Viewer_Assign('can_edit', 1 ); 
		$this->SetTemplateAction('blog');
		//$this->SetTemplateAction('blog');
	}

}