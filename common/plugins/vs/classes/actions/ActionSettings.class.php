<?php

class PluginVs_ActionSettings extends PluginVs_Inherit_ActionSettings {	
	protected function RegisterEvent() {	
		parent::RegisterEvent(); 
		$this->AddEvent('userbar','EventUserbar');
		$this->AddEvent('teamplay','EventTeamplay');
		$this->AddEventPreg('/^profiles$/i','/^upload-playerphoto/i','/^$/i','EventUploadPlayerPhoto');
		$this->AddEventPreg('/^profiles$/i','/^resize-playerphoto/i','/^$/i','EventResizePlayerPhoto');
		$this->AddEventPreg('/^profiles$/i','/^remove-playerphoto/i','/^$/i','EventRemovePlayerPhoto');
		$this->AddEventPreg('/^profiles$/i','/^cancel-playerphoto/i','/^$/i','EventCancelPlayerPhoto');
		
	}

	/**
	 * Загрузка временной картинки для аватара
	 */
	protected function EventUploadPlayerPhoto() {
		/**
		 * Устанавливаем формат Ajax ответа
		 */
		$this->Viewer_SetResponseAjax('jsonIframe',false); 
  
		if(!isset($_FILES['playerphoto']['tmp_name'])) {
			return false;
		} 
		/**
		 * Копируем загруженный файл
		 */
		$sFileTmp=Config::Get('sys.cache.dir').func_generator();
		if (!move_uploaded_file($_FILES['playerphoto']['tmp_name'],$sFileTmp)) {
			return false;
		}
 
		/**
		 * Ресайзим и сохраняем уменьшенную копию
		 */
		$sDir=Config::Get('path.uploads.images')."/tmp/playerphotos/{$this->oUserCurrent->getId()}";
		if ($sFilePlayerPhoto=$this->Image_Resize($sFileTmp,$sDir,'original',Config::Get('view.img_max_width'),Config::Get('view.img_max_height'),500,null,true)) {
			/**
			 * Зписываем в сессию
			 */
			$this->Session_Set('sPlayerPhotoFileTmp',$sFilePlayerPhoto);
			$this->Viewer_AssignAjax('sTmpFile',$this->Image_GetWebPath($sFilePlayerPhoto));
 
		} else {
			$this->Message_AddError($this->Image_GetLastError(),$this->Lang_Get('error'));
		} 
		unlink($sFileTmp);
	}
	/**
	 * Вырезает из временной аватарки область нужного размера, ту что задал пользователь
	 */
	protected function EventResizePlayerPhoto() {
		/**
		 * Устанавливаем формат Ajax ответа
		 */
		$this->Viewer_SetResponseAjax('json');
		/**
		 * Получаем файл из сессии
		 */ 
		$sFilePlayerPhoto=$this->Session_Get('sPlayerPhotoFileTmp');
		if (!file_exists($sFilePlayerPhoto)) {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'));
			return;
		}
		/**
		 * Определяем размер большого фото для подсчета множителя пропорции
		 */
		$fRation=1;
		if ($aSizeFile=getimagesize($sFilePlayerPhoto) and isset($aSizeFile[0])) {
			$fRation=$aSizeFile[0]/500; // 200 - размер превью по которой пользователь определяет область для ресайза
			if ($fRation<1) {
				$fRation=1;
			}
		}
		/**
		 * Получаем размер области из параметров
		 */
		$aSize=array();
		$aSizeTmp=getRequest('size');
		if (isset($aSizeTmp['x']) and is_numeric($aSizeTmp['x'])
			and isset($aSizeTmp['y']) and is_numeric($aSizeTmp['y'])
				and isset($aSizeTmp['x2']) and is_numeric($aSizeTmp['x2'])
					and isset($aSizeTmp['y2']) and is_numeric($aSizeTmp['y2'])) {
			$aSize=array('x1'=>round($fRation*$aSizeTmp['x']),'y1'=>round($fRation*$aSizeTmp['y']),'x2'=>round($fRation*$aSizeTmp['x2']),'y2'=>round($fRation*$aSizeTmp['y2']));
		}
		/**
		 * Вырезаем аватарку
		 */
		if ($sFileWeb=$this->User_UploadPlayerPhoto($sFilePlayerPhoto,$this->oUserCurrent,$aSize)) {
			/**
			 * Удаляем старые аватарки
			 */
			/*if ($sFileWeb!=$this->oUserCurrent->getProfilePlayerPhoto()) {
				$this->User_DeletePlayerPhoto($this->oUserCurrent);
			}
			$this->oUserCurrent->setProfilePlayerPhoto($sFileWeb);

			$this->User_Update($this->oUserCurrent);
			*/
			$oPlayercard = $this->PluginVs_Stat_GetPlayercardByFilter(array(
						'user_id' => $this->oUserCurrent->GetUserId(), 
						'sport_id' => 1  
					));
			$oPlayercard->setFoto($sFileWeb);
			$oPlayercard->Save();
			$this->Session_Drop('sPlayerPhotoFileTmp');
			$this->Viewer_AssignAjax('sFile',$oPlayercard->getFotoUrl());
			$this->Viewer_AssignAjax('sTitleUpload',$this->Lang_Get('settings_profile_avatar_change'));
		} else {
			$this->Message_AddError($this->Lang_Get('settings_profile_avatar_error'),$this->Lang_Get('error'));
		}
	}
	/**
	 * Удаляет аватар
	 */
	protected function EventRemovePlayerPhoto() {
		/**
		 * Устанавливаем формат Ajax ответа
		 */
		$this->Viewer_SetResponseAjax('json');
		/**
		 * Удаляем
		 */
		$this->User_DeletePlayerPhoto($this->oUserCurrent);
		
		$oPlayercard = $this->PluginVs_Stat_GetPlayercardByFilter(array(
						'user_id' => $this->oUserCurrent->GetUserId(), 
						'sport_id' => 1  
					));
		$oPlayercard->setFoto(null);
		$oPlayercard->Save();
			
		/*
		$this->oUserCurrent->setProfilePlayerPhoto(null);
		$this->User_Update($this->oUserCurrent);
		*/
		/**
		 * Возвращает дефолтную аватарку
		 */
		$this->Viewer_AssignAjax('sFile','http://virtualsports.ru/templates/skin/virtsports/images/Arshavin.png');
		$this->Viewer_AssignAjax('sTitleUpload',$this->Lang_Get('settings_profile_avatar_upload'));
	}
	/**
	 * Отмена ресайза аватарки, необходимо удалить временный файл
	 */
	protected function EventCancelPlayerPhoto() {
		/**
		 * Устанавливаем формат Ajax ответа
		 */
		$this->Viewer_SetResponseAjax('json');
		/**
		 * Достаем из сессии файл и удаляем
		 */
		$sFilePlayerPhoto=$this->Session_Get('sPlayerPhotoFileTmp');
		$this->Image_RemoveFile($sFilePlayerPhoto);
		$this->Session_Drop('sPlayerPhotoFileTmp');
	}
	
	protected function EventTeamplay() {
 
		$this->sMenuItemSelect='settings';
		

		$this->Viewer_Assign('game',Router::GetParam(0));
		$this->Viewer_Assign('platform',Router::GetParam(1));
		$this->sMenuSubItemSelect='teamplay'.Router::GetParam(0).Router::GetParam(1);
		
		$user_id = $this->oUserCurrent->GetUserId();
		if(Router::GetParam(2) && $this->oUserCurrent->getIsAdministrator()){
			$User=$this->User_getUserByLogin(Router::GetParam(2));
			$user_id = $User->getId();
			$this->Viewer_Assign('UserLogin',Router::GetParam(2));
		}else{
			$User=$this->oUserCurrent;
		}
		$this->Viewer_Assign('User',$User);
		$this->Viewer_Assign('aUserFields', $this->User_getUserFieldsValues($user_id, false));
		$this->Viewer_Assign('aUserFieldsContact',$this->User_getUserFields(array('contact','social')));
		
		$this->Viewer_AddHtmlTitle('Player card');
		
		$sport_id='0';
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
		
		
		$this->Viewer_Assign('sport_id',$sport_id);
		
		if(Router::GetParam(0)!='' && Router::GetParam(1)!=''){
			$oPlatform = $this->PluginVs_Stat_GetPlatformByBrief(Router::GetParam(1));
			if($oPlayercard = $this->PluginVs_Stat_GetPlayercardByFilter(array(
						'user_id' => $user_id, 
						'sport_id' => $sport_id, 
						'platform_id' => $oPlatform->getPlatformId()
					)))
			{ 
				$this->Viewer_Assign('oPlayercard',$oPlayercard);				
			}
		} 
		if($oPlayercard && $oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
				'playercard_id' => $oPlayercard->getPlayercardId(),
				'tournament_id'         => 0	,
				'#with'         => array('team'),
			)))
		{		
			$this->Viewer_Assign('oPlayerTournament',$oPlayerTournament);
		}
		
		if ($oPlayercard &&  $aInvites = $this->PluginVs_Stat_GetInviteItemsByFilter(array(
					'playercard_id' => $oPlayercard->getPlayercardId(),
					'player_submit' => '0',
					'tournament_id' => '0', 
					)) 
				) {
				$this->Viewer_Assign('aInvites', $aInvites );
				//$teamTest = $this->PluginVs_Stat_GetTeamByTeamId(1112);
				print_r($this->Blog_GetBlogById(210)) ;
				
			}
		
		if ($oPlayercard && isPost('send_invites')) {
			$sUsers=getRequest('teams');
			$aUsers=explode(',',$sUsers);		
			$this->aUsersId=array();
			
			foreach ($aUsers as $sUser) {
				$sUser=trim($sUser);			
				if ($sUser=='' ) {
					continue;
				}
				if ($oTeam=$this->PluginVs_Stat_GetTeamByFilter(array(
								'name' => $sUser,
								'gametype_id' => 3	,
								//'blog_id <>' => 0
							))  ) {
					
					if ( !$oInvite = $this->PluginVs_Stat_GetInviteByFilter(array(
						'playercard_id' => $oPlayercard->getPlayercardId(),
						'team_submit' => '0',
						'tournament_id' => '0'
						)) 
					) {
						$Invite_add = Engine::GetEntity('PluginVs_Stat_Invite');
						$Invite_add->setPlayercardId($oPlayercard->getPlayercardId());
						$Invite_add->setTeamId($oTeam->getTeamId()); 	
						$Invite_add->setPlayerSubmit(1); 	
						$Invite_add->setTournamentId(0);
						$Invite_add->setTimes(date("Y-m-d H:i:s"));
						$Invite_add->Add();
						
						$aUsers=array();
						if($aPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
								'team_id' => $oTeam->getTeamId(),
								'tournament_id' => 0	,
								'cap >' => 0
							)))
							{	
								foreach($aPlayerTournament as $osPlayerTournament){
									$oUserTarget=$this->User_GetUserById($osPlayerTournament->getUserId());
									$aUsers[]=$oUserTarget;
								}													
								$link = $oTeam->getBlog()->getTeamUrlFull().'_au/';
								$oTalk = $this->Talk_SendTalk('New request to club '.$oTeam->getName(),'To accept or decline request please go to this <a href="'.$link.'">link</a>',$this->oUserCurrent, $aUsers);
							}else{
								$oUserTarget=$this->User_GetUserById(4);
								$aUsers[]=$oUserTarget;
								$oUserTarget=$this->User_GetUserById(11);
								$aUsers[]=$oUserTarget;													
								$link = $oTeam->getBlog()->getTeamUrlFull().'_au/';
								$oTalk = $this->Talk_SendTalk('New request to club '.$oTeam->getName(),'To accept or decline request please go to this <a href="'.$link.'">link</a>',$this->oUserCurrent, $aUsers);
							
							
							}
						}
					
					if ( $oInvite = $this->PluginVs_Stat_GetInviteByFilter(array(
						'team_id' => $oTeam->getTeamId(),
						'player_submit' => '0',
						'team_submit'=> '1',
						'tournament_id' => '0'
						)) 
					) {
						$oInvite->setPlayerSubmit(1);
						$oInvite->setSubmit(1);
						$oInvite->setTimesSubmit(date("Y-m-d H:i:s"));
						$oInvite->Save();							
						
						if($oPlayerTournament && $oTeam && $oPlayerTournament->getTeamId()!=0 && $oPlayerTournament->getTeamId()!=$oTeam->getTeamId()){
							$Transfer_add = Engine::GetEntity('PluginVs_Stat_Transfer');
							$Transfer_add->setTeamId($oPlayerTournament->getTeamId()); 	
							$Transfer_add->setPlayercardId($oPlayercard->getPlayercardId()); 
							$Transfer_add->setTimes(date("Y-m-d H:i:s"));
							$Transfer_add->setWho($oPlayercard->getUserId()); 
							$Transfer_add->setAction('leave_team'); 
							$Transfer_add->Add();							
						}
							
						$Transfer_add = Engine::GetEntity('PluginVs_Stat_Transfer');
						$Transfer_add->setTeamId($oTeam->getTeamId()); 	
						$Transfer_add->setPlayercardId($oPlayercard->getPlayercardId()); 
						$Transfer_add->setTimes(date("Y-m-d H:i:s"));
						$Transfer_add->setWho($oPlayercard->getUserId()); 
						$Transfer_add->setAction('join_team'); 
						$Transfer_add->Add();
			
						$oPlayerTournament->setTeamId($oTeam->getTeamId());
						$oPlayerTournament->setCap(0);
						$oPlayerTournament->Save();
					}
				}
			}
		}
		if (isPost('submit_settings_teamplay')) {
			//if (func_check(getRequest('settings_fio',null,'post'),'text',0,255))$settings_fio=getRequest('settings_fio',null,'post');
			if (func_check(getRequest('settings_name',null,'post'),'text',0,255))$settings_name=getRequest('settings_name',null,'post');
			if (func_check(getRequest('settings_family',null,'post'),'text',0,255))$settings_family=getRequest('settings_family',null,'post');
			if (func_check(getRequest('settings_number',null,'post'),'text',0,2))$settings_number=getRequest('settings_number',null,'post');
			if (func_check(getRequest('settings_time',null,'post'),'text',0,255))$settings_time=getRequest('settings_time',null,'post');
			if (func_check(getRequest('settings_about',null,'post'),'text',0,3000))$settings_about=getRequest('settings_about',null,'post');
			
			$settings_end = getRequest('settings_end') ? 1 : 0;			
			$settings_lw = getRequest('settings_lw') ? 1 : 0;
			$settings_c = getRequest('settings_c') ? 1 : 0;
			$settings_rw = getRequest('settings_rw') ? 1 : 0;
			$settings_ld = getRequest('settings_ld') ? 1 : 0;
			$settings_rd = getRequest('settings_rd') ? 1 : 0;
			$settings_g = getRequest('settings_g') ? 1 : 0;
			$settings_looking = getRequest('settings_looking') ? 1 : 0;
			 
			if(!$oPlayercard){
				$oPlayercard =  LS::Ent('PluginVs_Stat_Playercard');
				$oPlayercard->setTimes(date("Y-m-d H:i:s"));
			}
				$oPlayercard->setPlatformId($oPlatform->getPlatformId());
				$oPlayercard->setUserId($user_id);
				$oPlayercard->setSportId($sport_id);
				$oPlayercard->setNumber($settings_number);
				//$oPlayercard->setFio($settings_fio);
				$oPlayercard->setName($settings_name);
				$oPlayercard->setFamily($settings_family);
				$oPlayercard->setPlayTime($settings_time);
				$oPlayercard->setAbout($settings_about); 
				$oPlayercard->setLw($settings_lw);
				$oPlayercard->setC($settings_c);
				$oPlayercard->setRw($settings_rw);
				$oPlayercard->setLd($settings_ld);
				$oPlayercard->setRd($settings_rd);
				$oPlayercard->setG($settings_g);
				$oPlayercard->setLastUpdate(date("Y-m-d H:i:s"));
				
				$oPlayercard->setLooking($settings_looking);
				$oPlayercard->setEndGames($settings_end);
								
			if(!$oPlayercard){
				
				$oPlayercard->Add();
			}else{
				$oPlayercard->Save();
			}
			
					/**
					 * Обрабатываем дополнительные поля, type = ''
					 */
					$aFields = $this->User_getUserFields('');
					$aData = array();
					foreach ($aFields as $iId => $aField) {
						if (isset($_REQUEST['profile_user_field_'.$iId])) {
							$aData[$iId] = (string)getRequest('profile_user_field_'.$iId);
						}
					}
					$this->User_setUserFieldsValues($user_id, $aData);
					/**
					 * Динамические поля контактов, type = array('contact','social')
					 */
					$aType=array('contact','social');
					$aFields = $this->User_getUserFields($aType);
					/**
					 * Удаляем все поля с этим типом
					 */
					$this->User_DeleteUserFieldValues($user_id,$aType);
					$aFieldsContactType=getRequest('profile_user_field_type');
					$aFieldsContactValue=getRequest('profile_user_field_value');
					if (is_array($aFieldsContactType)) {
						foreach($aFieldsContactType as $k=>$v) {
							if (isset($aFields[$v]) and isset($aFieldsContactValue[$k]) and is_string($aFieldsContactValue[$k])) {
								$this->User_setUserFieldsValues($user_id, array($v=>$aFieldsContactValue[$k]), Config::Get('module.user.userfield_max_identical'));
							}
						}
					}
					$this->Message_AddNoticeSingle($this->Lang_Get('settings_profile_submit_ok'));
			Router::Location($this->curPageURL());
		}
		if (isPost('delete_settings_teamplay')) {
				$errors=0;
				if($aMatchplayerstat = $this->PluginVs_Stat_GetMatchplayerstatByFilter(array(
									'playercard_id' => $oPlayercard->getPlayercardId() 
						)) ){
					$this->Viewer_Assign('errors', 'Вы участвовали в матчах, вас нельзя удалять' );	
					$errors++;
				}
				
				if($aPlayertournaments = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
									'playercard_id' => $oPlayercard->getPlayercardId(),
									'tournament_id <>' => '0'
						)) ){
					$this->Viewer_Assign('errors', 'Выйдите из клуба' );	
					$errors++;
				}
				if($errors==0){
					$oPlayercard->Delete();
					Router::Location($this->curPageURL());
				}
				
		}
	}
	
	public function curPageURL() {
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}	
	protected function EventUserbar() {
		$sql="SELECT  
				min(p.brief) as platform
				,min(g.brief) as game
				,min(gt.brief) as gametype 
				FROM `tis_stat_matches` m, tis_user u, tis_stat_rating r , tis_stat_game g, tis_stat_gametype gt, tis_stat_platform p
				 WHERE m.played=1
				and (m.home_player=u.user_id or m.away_player=u.user_id)

				and m.game_id = g.game_id
				and m.gametype_id = gt.gametype_id
				and g.platform_id=p.platform_id

				and u.user_id= r.user_id
				and m.game_id = r.game_id
				and m.gametype_id = r.gametype_id
				and u.user_id='".$this->oUserCurrent->getId()."'
				group by u.user_login, r.game_id
				order by rating desc";
		if($results=$this->PluginVs_Stat_GetAll($sql)){
			$this->Viewer_Assign('userbar',1);
			$this->Viewer_Assign('results',$results);
		}else{
			$this->Viewer_Assign('userbar',0);
		}
		
	
	}




}