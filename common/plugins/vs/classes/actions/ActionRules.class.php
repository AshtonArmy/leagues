<?php
/*
 * Пример нового экшна. Задаем новые страницы (не забудьте сконфигурировать роутинг в config.php плагина)
 *
 */

class PluginVs_ActionRules extends ActionPlugin {
    
	/**
	 * Инизиализация экшена
	 *
	 */
	public function Init() {
        $this->SetDefaultEvent('index'); // ПРи ображении к domain.com/somepage будет вызываться EventIndex()
		$this->oUserCurrent = $this->User_GetUserCurrent();
	}

	/**
	 * Регистрируем евенты, по сути определяем УРЛы вида /somepage/.../
	 *
	 */
	protected function RegisterEvent() { 
		$this->AddEvent('index','EventIndex');  
		$this->AddEvent('site','EventIndex'); 
		//$this->AddEvent('create','EventCreate'); 
		$this->AddEvent('players','EventPlayers');
	}

	protected function EventIndex() {
		$this->SetTemplateAction('site');
		$this->Viewer_AddHtmlTitle('Правила сайта');
		$this->Viewer_Assign('bNoSidebar',1);
		
		
	}
	protected function EventPlayers() {
		$onpage=50;
		/**
		 * По какому полю сортировать
		 */
		$sOrder='fio';
		if (getRequest('order')) {
			$sOrder=getRequest('order');
		}
		/**
		 * В каком направлении сортировать
		 */
		$sOrderWay='desc';
		if (getRequest('order_way')) {
			$sOrderWay=getRequest('order_way');
		}		
		$iPage=$this->GetParamEventMatch(0,2) ? $this->GetParamEventMatch(0,2) : 1;	 
		/*$aPlayercard = Engine::GetInstance()->PluginVs_Stat_GetPlayercardItemsByFilter(array( 
					'#with'         => array('user'), 
					'#order' => array($sOrder=>$sOrderWay),
					'#limit' =>array( ($iPage-1)*$onpage, $onpage)
					)); */
		$sql="SELECT  pc.*, u.user_login, u.user_profile_city,  
				ifnull( REPLACE(user_profile_avatar, '100x100', '48x48'), 'http://virtualsports.ru/templates/skin/vs-new/images/avatar_48x48.jpg') as user_profile_avatar
				FROM `tis_stat_playercard` pc 
				left join `tis_user` u
				on u.user_id=pc.user_id
				order by ".mysql_escape_string($sOrder)." ".mysql_escape_string($sOrderWay)."
				limit ".($iPage-1)*$onpage.", ".$onpage."
				";
		$aPlayercard=Engine::GetInstance()->PluginVs_Stat_GetAll($sql);
	//$aResult=$this->User_GetUsersByFilter($aFilter,array($sOrder=>$sOrderWay),$iPage,Config::Get('module.user.per_page'));
		//$aUsers=$aResult['collection'];
		/**
		 * Формируем постраничность
		 */
		$aPaging=$this->Viewer_MakePaging(count($aPlayercard),$iPage,$onpage,4,Router::GetPath('teams').'players',array('order'=>$sOrder,'order_way'=>$sOrderWay));
		/**
		 * Загружаем переменные в шаблон
		 */
		$this->Viewer_Assign('aPaging',$aPaging);
		$this->Viewer_Assign('aPlayercard',$aPlayercard);
		$this->Viewer_Assign("sUsersOrder",htmlspecialchars($sOrder));
		$this->Viewer_Assign("sUsersOrderWay",htmlspecialchars($sOrderWay));
		$this->Viewer_Assign("sUsersOrderWayNext",htmlspecialchars($sOrderWay=='desc' ? 'asc' : 'desc'));
		
	}
	protected function EventCreate() {
		if (!$this->User_IsAuthorization() ) {
            return $this->EventDenied();
        }
		$first="helloworld";	
		switch (Router::GetParam(0)) {
			case 'hockey':
				$sport_id='1';
				break;
			case 'football':
				$sport_id='2';
				break;
			case 'battlefield':
				$sport_id='5';
				break;
		}

		
		$oGame = Engine::GetInstance()->PluginAdminvs_Stat_GetGameItemsBySportId($sport_id);
		$oPlatform = Engine::GetInstance()->PluginAdminvs_Stat_GetPlatformItemsAll();  
		
		/**
		 * Проверяем отправлена ли форма с данными(хотяб одна кнопка)
		 */
		if (isPost('submit_create_team')) {
			if (func_check(getRequest('team_name',null,'post'),'text',2,30))$team_name=getRequest('team_name',null,'post');
			if (func_check(getRequest('team_brief',null,'post'),'text',2,30))$team_brief=getRequest('team_brief',null,'post');
			if (func_check(getRequest('game_id',null,'post'),'id',1,11))$game_id=getRequest('game_id',null,'post');
			if (func_check(getRequest('gametype_id',null,'post'),'id',1,11))$gametype_id=getRequest('gametype_id',null,'post');
			
			$oGame= Engine::GetInstance()->PluginVs_Stat_GetGameByGameId($game_id);			
			
			$oTeam =  LS::Ent('PluginVs_Stat_Team');				
			$oTeam->setSportId($oGame->getSportId());	
			$oTeam->setGametypeId($gametype_id);	
			$oTeam->setGameId($game_id);
			$oTeam->setName($team_name);	
			$oTeam->setShortname($team_name);	
			$oTeam->setBrief($team_brief);	
			$oTeam->setLogo('');
			$oTeam->setSmalllogo(''); 
			$oTeam->setOwnerId($this->oUserCurrent->GetUserId());			
			$oTeam->Add();
			
			Router::Location(DIR_WEB_ROOT.'/team/'.$oTeam->getTeamId());
		}
		
		$this->Viewer_Assign('oGame', $oGame );
		$this->Viewer_Assign('oPlatform', $oPlatform );
		$this->Viewer_Assign('sport_id', $sport_id ); 
	}	
}