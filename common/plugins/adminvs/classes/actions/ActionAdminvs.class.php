<?php
/*
 * Пример нового экшна. Задаем новые страницы (не забудьте сконфигурировать роутинг в config.php плагина)
 *
 */

class PluginAdminvs_ActionAdminvs extends ActionPlugin {
    private $sPlugin = 'adminvs';
	/**
	 * Инизиализация экшена
	 *
	 */
	public function Init() {
        $this->SetDefaultEvent('platform'); // ПРи ображении к domain.com/somepage будет вызываться EventIndex()
		$this->oUserCurrent = $this->User_GetUserCurrent();
		if (!$this->User_IsAuthorization() || !$this->oUserCurrent->isAdministrator()) {
            return $this->EventDenied();
        }
	}

	/**
	 * Регистрируем евенты, по сути определяем УРЛы вида /somepage/.../
	 *
	 */
	protected function RegisterEvent() {
		$this->AddEvent('index','EventPlatform');
		$this->AddEvent('platform', 'EventPlatform');
		$this->AddEvent('sport', 'EventSport');
		$this->AddEvent('game', 'EventGame');
		$this->AddEvent('gametype', 'EventGametype');
		$this->AddEvent('turnir', 'EventTurnir');
		
		//$this->AddEvent('team', 'EventTeam');
		$this->AddEvent('medal', 'EventMedal');
		$this->AddEvent('advert', 'EventAdvert');
        //$this->AddEvent('add','EventAdd'); // урл /somepage/add  - вызывается EventAdd()
	    //$this->AddEvent('edit','EventEdit'); // урл /somepage/edit - вызывается EventEdit()
	}

    protected function EventIndex() {
	
	$oPlatform =  LS::Ent('PluginVs_Stat_Platform');
	//$oPlatform->setAutorId($oUserCurrent->getId());
	$oPlatform->setName('Personal computer');
	$oPlatform->setBrief('pc');
	//$oPlatform->Add();


		$first="helloworld";
		
	}
///-------Платформы--------//////	 
	protected function EventPlatform() {
	    if (($sAdminAction=$this->getRequestCheck('4platform'))) {
            if ($sAdminAction=='Удалить') $this->EventDeletePlatform();
            elseif ($sAdminAction=='Сохранить') $this->EventEditPlatform();
            elseif ($sAdminAction=='Добавить') $this->EventAddPlatform();
        }		
		if(sizeof(Router::GetParams())>0){
			$do=$this->GetParam(0);	
			$oPlatform = $this->PluginVs_Stat_GetPlatformById($this->GetParam(1));

			
			$this->Viewer_Assign('oPlatform', $oPlatform );
		}else{
			$do='';
			$sql = "SELECT * from tis_stat_platform";
			$oPlatforms=$this->PluginVs_Stat_GetAll($sql);
			
			$this->Viewer_Assign('oPlatforms', $oPlatforms );
		}
		$this->Viewer_Assign('do',$do);	
		$this->Viewer_Assign('sMenuSubItemSelect', 'platform');
    }	
	protected function EventAddPlatform() {
		$oPlatform_add =  LS::Ent('PluginVs_Stat_Platform');
		$oPlatform_check1 = $this->PluginVs_Stat_GetPlatformByName(getRequest('name'));
		$oPlatform_check2 = $this->PluginVs_Stat_GetPlatformByBrief(getRequest('brief'));
		if(!$oPlatform_check1 && !$oPlatform_check2){
			$oPlatform_add->setName(getRequest('name'));
			$oPlatform_add->setBrief(getRequest('brief'));
			$oPlatform_add->Add();
			
			//$this->oUserCurrent = $this->User_GetUserCurrent();
			$oPlatform = $this->PluginVs_Stat_GetPlatformByBrief(getRequest('brief'));
		
			$sql = "INSERT INTO tis_blog 
				(user_owner_id,
				blog_title,
				blog_description,
				blog_type,			
				blog_date_add,
				blog_limit_rating_topic,
				blog_url,
				blog_avatar,
				platform,
				game,
				gametype,
				tournament_id
			)
			VALUES(".$this->oUserCurrent->getId().",  '".$oPlatform->getName()."', 'Блог ".$oPlatform->getName()."',	'".'open'."',	'".date("Y-m-d H:i:s")."',	'".'0'."',  '".$oPlatform->getBrief()."', null, '".$oPlatform->getBrief()."', '', '', '')
			";		
		
			$oSports=$this->PluginVs_Stat_CreateBlog($sql);
		}
		setmenu();
    }
	protected function EventEditPlatform() {
		$oPlatform_edit = $this->PluginVs_Stat_GetPlatformById(getRequest('platform_id'));
		if($oPlatform_edit){
			$oPlatform_edit->setName(getRequest('name'));
			$oPlatform_edit->setBrief(getRequest('brief'));
			$oPlatform_edit->Save();
		}
		setmenu();
    }	
	protected function EventDeletePlatform() {
		$oPlatform_delete = $this->PluginVs_Stat_GetPlatformById(getRequest('platform_id'));
		if($oPlatform_delete){
			$oPlatform_delete->Delete();
		}
		setmenu();
    }
///-------Платформы--------//////	
///-------Игра--------//////	 
	protected function EventGame() {
	    if (($sAdminAction=$this->getRequestCheck('4game'))) {
            if ($sAdminAction=='Удалить') $this->EventDeleteGame();
            elseif ($sAdminAction=='Сохранить') $this->EventEditGame();
            elseif ($sAdminAction=='Добавить') $this->EventAddGame();
        }		
		if(sizeof(Router::GetParams())>0){
			$do=$this->GetParam(0);	
			$oGame = $this->PluginVs_Stat_GetGameById($this->GetParam(1));
			$oSport = $this->PluginVs_Stat_GetSportItemsAll();
			$oPlatform = $this->PluginVs_Stat_GetPlatformItemsAll();
			
			$this->Viewer_Assign('oGame', $oGame );
			$this->Viewer_Assign('oSport', $oSport );
			$this->Viewer_Assign('oPlatform', $oPlatform );
		}else{
			$do='';
			$sql = "SELECT * from tis_stat_game";
			$oGames=$this->PluginVs_Stat_GetAll($sql);
			
			$this->Viewer_Assign('oGames', $oGames );
		}
		
		$this->Viewer_Assign('do',$do);	
		$this->Viewer_Assign('sMenuSubItemSelect', 'game');
    }	
	protected function EventAddGame() {
		$oGame_add =  LS::Ent('PluginVs_Stat_Game');
		//$oGame_check1 = $this->PluginVs_Stat_GetGameByName(getRequest('name'));
		$oGame_check2 = $this->PluginVs_Stat_GetGameByBrief(getRequest('brief'));
		$oPlatform = $this->PluginVs_Stat_GetPlatformById(getRequest('platform_id'));
		if(getRequest('oneplay')==1){$oneplay=1;}else{$oneplay=0;}
		if(getRequest('hut')==1){$hut=1;}else{$hut=0;}
		if(getRequest('twoplay')==1){$twoplay=1;}else{$twoplay=0;}
		if(getRequest('teamplay')==1){$teamplay=1;}else{$teamplay=0;}
		if(!$oGame_check2){
			$oGame_add->setName(getRequest('name'));
			$oGame_add->setBrief(getRequest('brief'));
			$oGame_add->setPlatformId(getRequest('platform_id'));
			$oGame_add->setSportId(getRequest('sport_id'));
			$oGame_add->setOneplay($oneplay);
			$oGame_add->setHut($hut);
			$oGame_add->setTwoplay($twoplay);
			$oGame_add->setTeamplay($teamplay);
			$oGame_add->Add();
			
			//$this->oUserCurrent = $this->User_GetUserCurrent();
			$oGame = $this->PluginVs_Stat_GetGameByBrief(getRequest('brief'));
			
			
			
			$sql = "INSERT INTO tis_blog (user_owner_id, blog_title, blog_description, blog_type, blog_date_add, blog_limit_rating_topic, blog_url,	blog_avatar, platform, game, gametype, tournament_id )
				VALUES(".$this->oUserCurrent->getId().",  '".strtoupper($oPlatform->getBrief())." - ".$oGame->getName()."', 'Блог ".$oGame->getName()." на ".$oPlatform->getName()."',	'".'open'."',	'".date("Y-m-d H:i:s")."',	'".'0'."',  '".$oGame->getBrief()."', null, '".$oPlatform->getBrief()."', '".$oGame->getBrief()."', '', 0)
			";			
			$oSports=$this->PluginVs_Stat_CreateBlog($sql);
			
			$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('brief'));
			if($oBlog){
				$this->CleanBlogCache($oBlog); 
			}
			
			if($oneplay==1){
				$sql = "INSERT INTO tis_blog (user_owner_id, blog_title, blog_description, blog_type, blog_date_add, blog_limit_rating_topic, blog_url,	blog_avatar, platform, game, gametype, tournament_id )
					VALUES(".$this->oUserCurrent->getId().",  '".strtoupper($oPlatform->getBrief())." - ".$oGame->getName()." - 1 на 1', 'Блог ".$oGame->getName()." на ".strtoupper($oPlatform->getBrief())." - 1 на 1',	'".'open'."',	'".date("Y-m-d H:i:s")."',	'".'0'."',  '".$oGame->getBrief()."_1vs1', null, '".$oPlatform->getBrief()."', '".$oGame->getBrief()."', '1vs1', 0)
				";			
				$oSports=$this->PluginVs_Stat_CreateBlog($sql);
				$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('brief')."_1vs1");
				if($oBlog){
					$this->CleanBlogCache($oBlog); 
				}
			}
			if($hut==1){
				$sql = "INSERT INTO tis_blog (user_owner_id, blog_title, blog_description, blog_type, blog_date_add, blog_limit_rating_topic, blog_url,	blog_avatar, platform, game, gametype, tournament_id )
					VALUES(".$this->oUserCurrent->getId().",  '".strtoupper($oPlatform->getBrief())." - ".$oGame->getName()." - HUT', 'Блог ".$oGame->getName()." на ".strtoupper($oPlatform->getBrief())." - HUT',	'".'open'."',	'".date("Y-m-d H:i:s")."',	'".'0'."',  '".$oGame->getBrief()."_hut', null, '".$oPlatform->getBrief()."', '".$oGame->getBrief()."', 'hut', 0)
				";			
				$oSports=$this->PluginVs_Stat_CreateBlog($sql);
				$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('brief')."_hut");
				if($oBlog){
					$this->CleanBlogCache($oBlog); 
				}
			}
			if($twoplay==1){
				$sql = "INSERT INTO tis_blog (user_owner_id, blog_title, blog_description, blog_type, blog_date_add, blog_limit_rating_topic, blog_url,	blog_avatar, platform, game, gametype, tournament_id )
					VALUES(".$this->oUserCurrent->getId().",  '".strtoupper($oPlatform->getBrief())." - ".$oGame->getName()." - 2 на 2', 'Блог ".$oGame->getName()." на ".strtoupper($oPlatform->getBrief())." - 2 на 2',	'".'open'."',	'".date("Y-m-d H:i:s")."',	'".'0'."',  '".$oGame->getBrief()."_2vs2', null, '".$oPlatform->getBrief()."', '".$oGame->getBrief()."', '2vs2', 0)
				";			
			$oSports=$this->PluginVs_Stat_CreateBlog($sql);
			$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('brief')."_2vs2");
				if($oBlog){
					$this->CleanBlogCache($oBlog); 
				}
			}
			if($teamplay==1){
				$sql = "INSERT INTO tis_blog (user_owner_id, blog_title, blog_description, blog_type, blog_date_add, blog_limit_rating_topic, blog_url,	blog_avatar, platform, game, gametype, tournament_id )
					VALUES(".$this->oUserCurrent->getId().",  '".strtoupper($oPlatform->getBrief())." - ".$oGame->getName()." - командные турниры', 'Блог ".$oGame->getName()." на ".strtoupper($oPlatform->getBrief())." - командные турниры',	'".'open'."',	'".date("Y-m-d H:i:s")."',	'".'0'."',  '".$oGame->getBrief()."_teamplay', null, '".$oPlatform->getBrief()."', '".$oGame->getBrief()."', 'teamplay', 0)
				";			
			$oSports=$this->PluginVs_Stat_CreateBlog($sql);
			$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('brief')."_teamplay");
				if($oBlog){
					$this->CleanBlogCache($oBlog); 
				}
			}			
			
		}
		setmenu();
    }
	protected function EventEditGame() {
		$oGame_edit = $this->PluginVs_Stat_GetGameById(getRequest('game_id'));
		if($oGame_edit){
		
			if(getRequest('oneplay')==1){$oneplay=1;}else{$oneplay=0;}
			if(getRequest('hut')==1){$hut=1;}else{$hut=0;}
			if(getRequest('twoplay')==1){$twoplay=1;}else{$twoplay=0;}
			if(getRequest('teamplay')==1){$teamplay=1;}else{$teamplay=0;}
			
			$oGame_edit->setName(getRequest('name'));
			$oGame_edit->setBrief(getRequest('brief'));
			$oGame_edit->setPlatformId(getRequest('platform_id'));
			$oGame_edit->setSportId(getRequest('sport_id'));
			$oGame_edit->setOneplay($oneplay);
			$oGame_edit->setHut($hut);
			$oGame_edit->setTwoplay($twoplay);
			$oGame_edit->setTeamplay($teamplay);
			$oGame_edit->Save();
						
			$oPlatform = $this->PluginVs_Stat_GetPlatformById(getRequest('platform_id'));			
			$oGame = $this->PluginVs_Stat_GetGameById(getRequest('game_id'));
			
			$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('brief'));
			if($oBlog){
				$oBlog->setTitle(strtoupper($oPlatform->getBrief())." - ".$oGame->getName());
				$oBlog->setDescription("Блог ".$oGame->getName()." на ".$oPlatform->getName()."");
				$oBlog->Save();
				$this->CleanBlogCache($oBlog); 
			}
			
			$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('brief')."_1vs1");
			if($oBlog){
				$oBlog->setTitle(strtoupper($oPlatform->getBrief())." - ".$oGame->getName()." - 1 на 1");
				$oBlog->setDescription("Блог ".$oGame->getName()." на ".strtoupper($oPlatform->getBrief())." - 1 на 1");
				$oBlog->Save();
				$this->CleanBlogCache($oBlog); 
			}
			
			$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('brief')."_hut");
			if($oBlog){
				$oBlog->setTitle(strtoupper($oPlatform->getBrief())." - ".$oGame->getName()." - HUT");
				$oBlog->setDescription("Блог ".$oGame->getName()." на ".strtoupper($oPlatform->getBrief())." - HUT");
				$oBlog->Save();
				$this->CleanBlogCache($oBlog); 
			}
			
			$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('brief')."_2vs2");
			if($oBlog){
				$oBlog->setTitle(strtoupper($oPlatform->getBrief())." - ".$oGame->getName()." - 2 на 2");
				$oBlog->setDescription("Блог ".$oGame->getName()." на ".strtoupper($oPlatform->getBrief())." - 2 на 2");
				$oBlog->Save();
				$this->CleanBlogCache($oBlog); 
			}
			$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('brief')."_teamplay");
			if($oBlog){
				$oBlog->setTitle(strtoupper($oPlatform->getBrief())." - ".$oGame->getName()." - командные турниры");
				$oBlog->setDescription("Блог ".$oGame->getName()." на ".strtoupper($oPlatform->getBrief())." - командные турниры");
				$oBlog->Save();
				$this->CleanBlogCache($oBlog); 
			}
		}
		setmenu();
    }	
	protected function EventDeleteGame() {
		$oGame_delete = $this->PluginVs_Stat_GetGameById(getRequest('game_id'));
		if($oGame_delete){
			$oGame_delete->Delete();
		}
		setmenu();
    }
///-------Игра--------//////	

////-------------Спорт---------------////
	protected function EventSport() {
	    if (($sAdminAction=$this->getRequestCheck('4sport'))) {
            if ($sAdminAction=='Удалить') $this->EventDeleteSport();
            elseif ($sAdminAction=='Сохранить') $this->EventEditSport();
            elseif ($sAdminAction=='Добавить') $this->EventAddSport();
        }		
		if(sizeof(Router::GetParams())>0){
			$do=$this->GetParam(0);	
			if(sizeof(Router::GetParams())>1){
				$oSport = $this->PluginVs_Stat_GetSportById($this->GetParam(1));
				$this->Viewer_Assign('oSport', $oSport );
			}
		}else{
			$do='';
			$sql = "SELECT * from tis_stat_sport";
			$oSports=$this->PluginVs_Stat_GetAll($sql);
			
			$this->Viewer_Assign('oSports', $oSports );
		}
		$this->Viewer_Assign('do',$do);	
		$this->Viewer_Assign('sMenuSubItemSelect', 'sport');
    }	
	protected function EventAddSport() {
		$oSport_add =  LS::Ent('PluginVs_Stat_Sport');
		$oSport_check1 = $this->PluginVs_Stat_GetSportByName(getRequest('name'));
		$oSport_check2 = $this->PluginVs_Stat_GetSportByName(getRequest('brief'));
		if(!$oSport_check1 && !$oSport_check2){
			$oSport_add->setName(getRequest('name'));
			$oSport_add->setBrief(getRequest('brief'));
			$oSport_add->Add();
		}
    }
	protected function EventEditSport() {
		$oSport_edit = $this->PluginVs_Stat_GetSportById(getRequest('sport_id'));
		if($oSport_edit){
			$oSport_edit->setName(getRequest('name'));
			$oSport_edit->setBrief(getRequest('brief'));
			$oSport_edit->Save();
		}
    }	
	protected function EventDeleteSport() {
		$oSport_delete = $this->PluginVs_Stat_GetSportById(getRequest('sport_id'));
		if($oSport_delete){
			$oSport_delete->Delete();
		}
    }
////-------------Спорт---------------////	
	


///-------Турнир--------//////	 
	protected function EventTurnir() {
	    if (($sAdminAction=$this->getRequestCheck('4tournament'))) {
            if ($sAdminAction=='Удалить') $this->EventDeleteTurnir();
            elseif ($sAdminAction=='Сохранить') $this->EventEditTurnir();
            elseif ($sAdminAction=='Добавить') $this->EventAddTurnir();
        }		
		if(sizeof(Router::GetParams())>0){
			$do=$this->GetParam(0);	
			$oTournament = $this->PluginVs_Stat_GetTournamentById($this->GetParam(1));
			$oGame = $this->PluginVs_Stat_GetGameItemsAll();
			$oPlatform = $this->PluginVs_Stat_GetPlatformItemsAll();
			$oGametype = $this->PluginVs_Stat_GetGametypeItemsAll();
			$aResult=$this->Blog_GetBlogsByFilter(array('exclude_type' => 'personal'),array('blog_title'=>'asc'),1,300);
 
			$this->Viewer_Assign('aBlogs',$aResult['collection']);
		
			$this->Viewer_Assign('oGametype', $oGametype );
			$this->Viewer_Assign('oTournament', $oTournament );
			$this->Viewer_Assign('oGame', $oGame );
			$this->Viewer_Assign('oPlatform', $oPlatform );
			
			if($oTournament){
				$aAdmins = $this->PluginVs_Stat_GetTournamentadminItemsByFilter(array( 					 
						'tournament_id' => $oTournament->getTournamentId() ,
						'#with'         => array('user'),
						
						));
				$logins=array();
				foreach ($aAdmins as $oAdmin) {
					$logins[] = $oAdmin->getUser()->getLogin();
				}
				 
				$aUsers=implode(',',$logins);
				$this->Viewer_Assign('aUsers', $aUsers );
			}
		}else{
			$do='';
			$sql = "SELECT * from tis_stat_tournament";
			$oTournaments=$this->PluginVs_Stat_GetAll($sql);
			
			$this->Viewer_Assign('oTournaments', $oTournaments );
		}
		
		$this->Viewer_Assign('do',$do);	
		$this->Viewer_Assign('sMenuSubItemSelect', 'tournament');
    }	
	protected function EventAddTurnir() {
		$oTournament_add =  LS::Ent('PluginVs_Stat_Tournament');
		//$oTournament_check1 = $this->PluginVs_Stat_GetTournamentByName(getRequest('name'));
		//$oTournament_check2 = $this->PluginVs_Stat_GetTournamentByBrief(getRequest('brief'));
		$oGame=$this->PluginVs_Stat_GetGameById(getRequest('game_id'));
		$oGametype=$this->PluginVs_Stat_GetGametypeById(getRequest('gametype_id'));
		$oPlatform = $this->PluginVs_Stat_GetPlatformById($oGame->getPlatformId()); 
		//$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('blog_id'));
		 $oBlog=$this->Blog_GetBlogById(getRequest('blog_id'));
		
		if(getRequest('nichya')==1){$nichya=1;}else{$nichya=0;}
		//if(!$oTournament_check2){
			$oTournament_add->setName(getRequest('name'));
			$oTournament_add->setBrief(getRequest('brief'));
			$oTournament_add->setUrl(getRequest('url'));
			$oTournament_add->setGameId(getRequest('game_id'));
			$oTournament_add->setGametypeId(getRequest('gametype_id'));
/*			$oTournament_add->setExistN($nichya);
			
			$oTournament_add->setWin(getRequest('win'));
			$oTournament_add->setWinO(getRequest('win_o'));
			$oTournament_add->setLoseO(getRequest('lose_o'));
			$oTournament_add->setPointsN(getRequest('points_n'));
			$oTournament_add->setGoalsTehW(getRequest('goals_teh_w'));
			$oTournament_add->setGoalsTehL(getRequest('goals_teh_l'));
			$oTournament_add->setGoalsTehN(getRequest('goals_teh_n'));
*/			$oTournament_add->setKnownTeams('1');
			$oTournament_add->Add();
			
			$this->oUserCurrent = $this->User_GetUserCurrent();
			//$oTournament = $this->PluginVs_Stat_GetTournamentByBrief(getRequest('brief'));
			$oTournament = $this->PluginVs_Stat_GetTournamentByTournamentId($oTournament_add->getTournamentId());
			$oTournamentReglament_add =  LS::Ent('PluginVs_Stat_Tournamentreglament');
			$oTournamentReglament_add->setTournamentId($oTournament->getTournamentId());
			$oTournamentReglament_add->setReglamentText('');
			$oTournamentReglament_add->setReglamentSource('');
			$oTournamentReglament_add->Add();
			/*
			$sql = "INSERT INTO tis_blog (user_owner_id, blog_title, blog_description, blog_type, blog_date_add, blog_limit_rating_topic, blog_url,	blog_avatar, platform, game, gametype, tournament_id )
				VALUES(".$this->oUserCurrent->getId().",  '".strtoupper($oPlatform->getBrief())." - ".$oGame->getName()." - ".$oTournament->getName()."', 'Блог ".$oTournament->getName()." на ".$oPlatform->getName()."',	'".'open'."',	'".date("Y-m-d H:i:s")."',	'".'0'."',  '".$oTournament->getUrl()."', null, '".$oPlatform->getBrief()."', '".$oGame->getBrief()."', '".$oGametype->getBrief()."', ".$oTournament->getTournamentId().")
			";			
			$oSports=$this->PluginVs_Stat_CreateBlog($sql);
			*/
			
			if($oBlog){
				$oTournament->setBlogId($oBlog->getBlogId());				
				$oTournament->setBlogUrl($oBlog->getUrl());
				$oTournament->Save(); 
			}
						
			
		//}
		setmenu();
    }
	protected function EventEditTurnir() {
		$oTournament_edit = $this->PluginVs_Stat_GetTournamentById(getRequest('tournament_id'));
		if($oTournament_edit){
		
		/*	if(getRequest('oneplay')==1){$oneplay=1;}else{$oneplay=0;}
			if(getRequest('hut')==1){$hut=1;}else{$hut=0;}
			if(getRequest('twoplay')==1){$twoplay=1;}else{$twoplay=0;}
			if(getRequest('teamplay')==1){$teamplay=1;}else{$teamplay=0;} */
			$oTournament_edit->setUrl(getRequest('url'));
			$oTournament_edit->setName(getRequest('name'));
			$oTournament_edit->setBrief(getRequest('brief'));
			$oTournament_edit->setGameId(getRequest('game_id'));
			//$oTournament_edit->setPlatformId(getRequest('platform_id'));
			//$oTournament_edit->setSportId(getRequest('sport_id'));
		/*	$oTournament_edit->setOneplay($oneplay);
			$oTournament_edit->setHut($hut);
			$oTournament_edit->setTwoplay($twoplay);
			$oTournament_edit->setTeamplay($teamplay);*/
			$oTournament_edit->Save();
						
		//	$oPlatform = $this->PluginVs_Stat_GetPlatformById(getRequest('platform_id'));			
			$oTournament =  $this->PluginVs_Stat_GetTournamentById(getRequest('tournament_id'));
			$oGame=$this->PluginVs_Stat_GetGameById($oTournament->getGameId());
			$oGametype=$this->PluginVs_Stat_GetGametypeById($oTournament->getGametypeId());
			$oPlatform = $this->PluginVs_Stat_GetPlatformById($oGame->getPlatformId());
			
			//$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('blog_id'));
			$oBlog=$this->Blog_GetBlogById(getRequest('blog_id'));
			if($oBlog){
				$oTournament_edit->setBlogId($oBlog->getBlogId());
				$oTournament_edit->setBlogUrl($oBlog->getUrl());
				$oTournament_edit->Save(); 
			}
			/*$oBlog=$this->PluginAdminvs_Blog_GetBlogByUrl(getRequest('url'));
			if($oBlog){
				$oBlog->setTitle(strtoupper($oPlatform->getBrief())." - ".$oGame->getName()." - ".$oTournament->getName());
				$oBlog->setDescription("Блог ".$oTournament->getName()." на ".$oPlatform->getName()."");
				$oBlog->Save();
				$oTournament->setBlogId($oBlog->getBlogId());
				$oTournament->Save();
				$this->CleanBlogCache($oBlog); 
			}*/
			
			$aAdmins = $this->PluginVs_Stat_GetTournamentadminItemsByFilter(array( 					 
					'tournament_id' => $oTournament->getTournamentId() 
					));
			foreach ($aAdmins as $oAdmin) {
				$oAdmin->Delete();
			}
			
			$sUsers=getRequest('users');
			$aUsers=explode(',',$sUsers);		
			$this->aUsersId=array();
			
			foreach ($aUsers as $sUser) {
				$sUser=trim($sUser);			
				if ($sUser=='' ) {
					continue;
				}
				if ($oUser=$this->User_GetUserByLogin($sUser) and $oUser->getActivate()==1) {
					
					$oMedals_add =  LS::Ent('PluginVs_Stat_Tournamentadmin');
					$oMedals_add->setStatus('admin'); 
					$oMedals_add->setUserId($oUser->getUserId());
					$oMedals_add->setTournamentId($oTournament->getTournamentId());
					$oMedals_add->setExpire('2050-09-03'); 
					$oMedals_add->Add();
				}
			}
		
			
		}
		setmenu();
    }	
	protected function EventDeleteTurnir() {
		$oTournament_delete = $this->PluginVs_Stat_GetTournamentById(getRequest('tournament_id'));
		if($oTournament_delete){
			$oTournament_delete->Delete();
		}
		setmenu();
    }
///-------Турнир--------//////
///-------Объявления--------//////	 
	protected function EventAdvert() {
	    if (($sAdminAction=$this->getRequestCheck('4advert'))) {
            if ($sAdminAction=='Удалить') $this->EventDeleteAdvert();
            elseif ($sAdminAction=='Сохранить') $this->EventEditAdvert();
            elseif ($sAdminAction=='Добавить') $this->EventAddAdvert();
        }		
		if(sizeof(Router::GetParams())>0){
			$do=$this->GetParam(0);	
			$oAdvert = $this->PluginVs_Stat_GetAdvertById($this->GetParam(1));

			 $aFilter=array(
				'topic_publish' => 1 ,
				'not_blog_id' => array(466) ,
				'order' => 't.topic_date_add desc' 
			);
			$aTopics=$this->Topic_GetTopicsByFilter($aFilter,1,100);
			
			if($oAdvert)$this->Viewer_Assign('oAdvert',$oAdvert);
			$this->Viewer_Assign('aTopics',$aTopics['collection']);
			
		}else{
			$do='';
			$aAdverts = $this->PluginVs_Stat_GetAdvertItemsByFilter(array( 					 
					'site' => Config::Get('sys.site'),
					'#with'         => array('user'),
					'#order' =>array('sorter'=>'desc') 
					));
			
			$this->Viewer_Assign('aAdverts', $aAdverts );
		}
		
		$this->Viewer_Assign('do',$do);	
		$this->Viewer_Assign('sMenuSubItemSelect', 'tournament');
    }	
	protected function EventAddAdvert() {
		$oAdvert_add =  LS::Ent('PluginVs_Stat_Advert');	
		$this->oUserCurrent = $this->User_GetUserCurrent();
		if ($oUser=$this->User_GetUserByLogin(getRequest('user')) and $oUser->getActivate()==1) {
			$user_id = $oUser->getUserId();
		}else{
			$user_id = $this->oUserCurrent->getId();
		} 
		$oAdvert_add->setText(getRequest('text'));
		$oAdvert_add->setFromId($user_id);
		$oAdvert_add->setWho('user');
		$oAdvert_add->setTopicId(getRequest('topic_id'));
		$oAdvert_add->setForumTopicId(0);
		$oAdvert_add->setDateFrom(date("Y-m-d"));
		$oAdvert_add->setDateTo(date("Y-m-d"));
		$oAdvert_add->setSorter(getRequest('sort'));
		$oAdvert_add->setSite(Config::Get('sys.site'));
		$oAdvert_add->Add();
		
		setmenu();
    }
	protected function EventEditAdvert() {
		$oAdvert_edit = $this->PluginVs_Stat_GetAdvertById(getRequest('advert_id'));
		if($oAdvert_edit){
			
			$this->oUserCurrent = $this->User_GetUserCurrent();
			if ($oUser=$this->User_GetUserByLogin(getRequest('user')) and $oUser->getActivate()==1) {
				$user_id = $oUser->getUserId();
			}else{
				$user_id = $this->oUserCurrent->getId();
			} 
			$oAdvert_edit->setText(getRequest('text'));
			$oAdvert_edit->setFromId($user_id);
			$oAdvert_edit->setWho('user');
			$oAdvert_edit->setTopicId(getRequest('topic_id'));
			$oAdvert_edit->setForumTopicId(0);
			$oAdvert_edit->setDateFrom(date("Y-m-d"));
			$oAdvert_edit->setDateTo(date("Y-m-d"));
			$oAdvert_edit->setSorter(getRequest('sort'));
			$oAdvert_edit->setSite(Config::Get('sys.site'));
		
			$oAdvert_edit->Save(); 
 		
		}
		setmenu();
    }	
	protected function EventDeleteAdvert() {
		$oAdvert_delete = $this->PluginVs_Stat_GetAdvertById(getRequest('advert_id'));
		if($oAdvert_delete){
			$oAdvert_delete->Delete();
		}
		setmenu();
    }
///-------Объявления--------//////
////-------------Тип игры---------------////
	protected function EventGametype() {
	    if (($sAdminAction=$this->getRequestCheck('4gametype'))) {
            if ($sAdminAction=='Удалить') $this->EventDeleteGametype();
            elseif ($sAdminAction=='Сохранить') $this->EventEditGametype();
            elseif ($sAdminAction=='Добавить') $this->EventAddGametype();
        }		
		if(sizeof(Router::GetParams())>0){
			$do=$this->GetParam(0);	
			if(sizeof(Router::GetParams())>1){
				$oGametype = $this->PluginVs_Stat_GetGametypeById($this->GetParam(1));
				$this->Viewer_Assign('oGametype', $oGametype );
			}
			
			
		}else{
			$do='';
			$sql = "SELECT * from tis_stat_gametype";
			$oGametypes=$this->PluginVs_Stat_GetAll($sql);
			
			$this->Viewer_Assign('oGametypes', $oGametypes );
		}
		$this->Viewer_Assign('do',$do);	
		$this->Viewer_Assign('sMenuSubItemSelect', 'gametype');
    }	
	protected function EventAddGametype() {
		$oGametype_add =  LS::Ent('PluginVs_Stat_Gametype');
		$oGametype_check1 = $this->PluginVs_Stat_GetGametypeByName(getRequest('name'));
		$oGametype_check2 = $this->PluginVs_Stat_GetGametypeByName(getRequest('brief'));
		if(!$oGametype_check1 && !$oGametype_check2){
			$oGametype_add->setName(getRequest('name'));
			$oGametype_add->setBrief(getRequest('brief'));
			$oGametype_add->Add();
		}
    }
	protected function EventEditGametype() {
		$oGametype_edit = $this->PluginVs_Stat_GetGametypeById(getRequest('gametype_id'));
		if($oGametype_edit){
			$oGametype_edit->setName(getRequest('name'));
			$oGametype_edit->setBrief(getRequest('brief'));
			$oGametype_edit->Save();
		}
    }	
	protected function EventDeleteGametype() {
		$oGametype_delete = $this->PluginVs_Stat_GetGametypeById(getRequest('gametype_id'));
		if($oGametype_delete){
			$oGametype_delete->Delete();
		}
    }
////-------------Тип игры---------------////
//Медали
protected function EventMedal() {
	    if (($sAdminAction=$this->getRequestCheck('4medal'))) {
            if ($sAdminAction=='Удалить') $this->EventDeleteMedal();
            elseif ($sAdminAction=='Сохранить') $this->EventEditMedal();
            elseif ($sAdminAction=='Добавить') $this->EventAddMedal();
        }	
		
		
		
		if(sizeof(Router::GetParams())>0){
			$do=$this->GetParam(0);	 
			/*$sql = "SELECT distinct pt.user_id, u.user_login from tis_stat_playertournament pt, tis_user u where u.user_id=pt.user_id order by user_login";
			$Users=$this->PluginVs_Stat_GetAll($sql);
			foreach ($Users as $User)
			{
				$aUserId[]=$User['user_id'];
			} 
			$aUser=$this->User_GetUsersByArrayId($aUserId);*/
			$aTournament = $this->PluginVs_Stat_GetTournamentItemsAll();
			 
			$oMedal = $this->PluginVs_Stat_GetMedalsByFilter(array( 
					'medal_id' => $this->GetParam(1),
					'#with'    => array('user','tournament','team','playercard'), 
					));
			$this->Viewer_Assign('oMedal', $oMedal );	
			
			$medals=array();
			foreach(glob("images/medals/*") as $medal){
				$medals[]=explode('/',$medal)[2];
			}
			$this->Viewer_Assign('medals', $medals);
			$this->Viewer_Assign('aTournament', $aTournament ); 
		}else{
			$do='';
			$aMedals = $this->PluginVs_Stat_GetMedalsItemsByFilter(array( 
					'#with'         => array('user','tournament', 'team', 'playercard'), 
					));
			$this->Viewer_Assign('aMedals',$aMedals);
		}
		
		
			
		$this->Viewer_Assign('do',$do);	
		$this->Viewer_Assign('sMenuSubItemSelect', 'medal');
    }	
	protected function EventAddMedal() {
		

		$logo=getRequest('prise');
		$medal_text=getRequest('medal_text');
		 
		$tournament_id=getRequest('tournament_id');
		$oTournament = $this->PluginVs_Stat_GetTournamentById($tournament_id);
		
		$sUsers=getRequest('users');
		$aUsers=explode(',',$sUsers);		
		$this->aUsersId=array();
		
		foreach ($aUsers as $sUser) {
			$sUser=trim($sUser);			
			if ($sUser=='' ) {
				continue;
			}
			if ($oUser=$this->User_GetUserByLogin($sUser) and $oUser->getActivate()==1) {
				
				$oMedals_add =  LS::Ent('PluginVs_Stat_Medals');
				$oMedals_add->setMedalText($medal_text); 
				$oMedals_add->setUserId($oUser->getUserId());
				$oMedals_add->setTournamentId($oTournament->getTournamentId());
				$oMedals_add->setGameId($oTournament->getGameId());
				$oMedals_add->setGametypeId($oTournament->getGametypeId()); 
				$oMedals_add->setLogo($logo);
				$oMedals_add->Add();
			}
		}
						
		$sUsers=getRequest('teams');
		$aUsers=explode(',',$sUsers);		
		$this->aUsersId=array();
		
		foreach ($aUsers as $sUser) {
			$sUser=trim($sUser);			
			if ($sUser=='' ) {
				continue;
			}
			if ($oTeam=$this->PluginVs_Stat_GetTeamByName($sUser)) {
				
				$oMedals_add =  LS::Ent('PluginVs_Stat_Medals');
				$oMedals_add->setMedalText($medal_text);  
				$oMedals_add->setTeamId($oTeam->getTeamId());
				$oMedals_add->setTournamentId($oTournament->getTournamentId());
				$oMedals_add->setGameId($oTournament->getGameId());
				$oMedals_add->setGametypeId($oTournament->getGametypeId());  
				$oMedals_add->setLogo($logo);
				$oMedals_add->Add();
			}
		}
		
		$sUsers=getRequest('playercards');
		$aUsers=explode(',',$sUsers);		
		$this->aUsersId=array();
		
		foreach ($aUsers as $sUser) {
			$sUser=trim($sUser);			
			if ($sUser=='' ) {
				continue;
			}
			if ( $oPlayercard = $this->PluginVs_Stat_GetPlayercardByFilter(array(
				'#where' => array("ltrim(rtrim((concat(family,' ', name))) = ? )" => array($sUser))			
				)) 
			) {				
				$oMedals_add =  LS::Ent('PluginVs_Stat_Medals');
				$oMedals_add->setMedalText($medal_text);  
				$oMedals_add->setPlayercardId($oPlayercard->getPlayercardId());
				$oMedals_add->setUserId($oPlayercard->getUserId());
				$oMedals_add->setTournamentId($oTournament->getTournamentId());
				$oMedals_add->setGameId($oTournament->getGameId());
				$oMedals_add->setGametypeId($oTournament->getGametypeId());  
				$oMedals_add->setLogo($logo);
				$oMedals_add->Add();
			}
		}
		
    }
	protected function EventEditMedal() {
	
		$medal=getRequest('prise');
		$medal_id=getRequest('medal_id');
		$medal_text=getRequest('medal_text'); 
		$tournament_id=getRequest('tournament_id');
		$oTournament = $this->PluginVs_Stat_GetTournamentById($tournament_id);
		
		$oMedal_edit = $this->PluginVs_Stat_GetMedalsByMedalId($medal_id);
		if($oMedal_edit){

			$oMedal_edit->setMedalText($medal_text);
			$oMedal_edit->setLogo($medal);
			$oMedal_edit->setPlayercardId('0');
			$oMedal_edit->setUserId('0');
			$oMedal_edit->setTeamId('0');
						
				//--------------//	
				$sUsers=getRequest('users');
				$aUsers=explode(',',$sUsers);		
				$this->aUsersId=array();
				
				foreach ($aUsers as $sUser) {
					$sUser=trim($sUser);			
					if ($sUser=='' ) {
						continue;
					}
					if ($oUser=$this->User_GetUserByLogin($sUser) and $oUser->getActivate()==1) {
						$oMedal_edit->setUserId($oUser->getUserId());
					}
				}
								
				$sUsers=getRequest('teams');
				$aUsers=explode(',',$sUsers);		
				$this->aUsersId=array();
				
				foreach ($aUsers as $sUser) {
					$sUser=trim($sUser);			
					if ($sUser=='' ) {
						continue;
					}
					if ($oTeam=$this->PluginVs_Stat_GetTeamByName($sUser)) { 
						$oMedal_edit->setTeamId($oTeam->getTeamId());
						
					}
				}
				
				$sUsers=getRequest('playercards');
				$aUsers=explode(',',$sUsers);		
				$this->aUsersId=array();
				
				foreach ($aUsers as $sUser) {
					$sUser=trim($sUser);			
					if ($sUser=='' ) {
						continue;
					}
					if ( $oPlayercard = $this->PluginVs_Stat_GetPlayercardByFilter(array(
						'#where' => array("ltrim(rtrim((concat(family,' ', name))) = ? )" => array($sUser))			
						)) 
					) {				 
						$oMedal_edit->setPlayercardId($oPlayercard->getPlayercardId());
						$oMedal_edit->setUserId($oPlayercard->getUserId());
					}
				}
				//-------------------------//
			$oMedal_edit->setTournamentId($oTournament->getTournamentId());
			$oMedal_edit->setGameId($oTournament->getGameId());
			$oMedal_edit->setGametypeId($oTournament->getGametypeId()); 
			$oMedal_edit->Save();			
		}
    }	
	protected function EventDeleteMedal() {
		$oMedal_delete = $this->PluginVs_Stat_GetMedalsByMedalId(getRequest('medal_id'));
		if($oMedal_delete){
			$oMedal_delete->Delete();
		}
    }
//медали	
	protected function ParseText($sText, $aData=Array()) {
        return ($this->PluginAceadminpanel_Language_ParseText($sText, $aData));
    }
	
	protected function CheckRefererUrl() {
        $bChecked = true;
        if ($this->PluginConfigGet('check_url')) {
            if (!isset($_SERVER["HTTP_REFERER"])) {
                $bChecked = false;
            } else {
                $sUrl = Config::Get('path.root.web').'/adminvs/';
                if (strpos($_SERVER["HTTP_REFERER"], $sUrl)===false) {
                    $bChecked = false;
                }
            }
        }
        return $bChecked;
    }
	
	public function GetParam($iOffset, $default=null) {
    /*    if (!$this->CheckRefererUrl()) {
            return null;
        }
        else {*/
            return parent::GetParam($iOffset, $default);
        //}
    }

    protected function GetLastParam($default=null) {
        $nNumParams = sizeof(Router::GetParams());
        if ($nNumParams > 0) {
            $iOffset = $nNumParams-1;
            return $this->GetParam($iOffset, $default);
        }
        return null;
    }
	
	protected function GetRequestCheck($sName, $default=null, $sType=null) {
        $result = getRequest($sName, $default, $sType);

        if (!is_null($result)) $this->Security_ValidateSendForm();

        return $result;
    }
    protected function GoToBackPage() {
        if ($this->sPageRef)
            admHeaderLocation($this->sPageRef);
        else
            admHeaderLocation(Router::GetPath('adminvs'));
    }

    public function SetMenuNavItemSelect($sItem) {
        $this->sMenuNavItemSelect = $sItem;
    }
	
    protected function MakeMenu() {
        $this->Viewer_AddMenu('adminvs', Plugin::GetTemplatePath(__CLASS__).'menu.adminvs.tpl');
        $this->Viewer_Assign('menu', 'adminvs');

    }
    protected function GetTemplateFile($sFile) {
        return HelperPlugin::GetTemplatePath($sFile);
    }
	
    protected function PluginConfigGet($sParam) {
        return Config::Get('plugin.'.$this->sPlugin.'.'.$sParam);
    }
    protected function PluginAppendStyle($sStyle, $aParams=array()) {
        $this->Viewer_AppendStyle(Plugin::GetTemplateWebPath($this->sPlugin).'css/'.$sStyle);
    }
    protected function CleanBlogCache($oBlog) {	
		$this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,array('blog_update',"blog_update_{$oBlog->getId()}","topic_update"));
		$this->Cache_Delete("blog_{$oBlog->getId()}");
	}
    /**
     * Shutdown Function
     */
     public function EventShutdown() {
		
		$this->Viewer_Assign('sMenuItemSelect', 'tour');
		
		
		$this->MakeMenu();
		$this->PluginAppendStyle('adminvs.css');
     }
	    
	protected function EventDenied() {
        $this->Message_AddErrorSingle($this->Lang_Get('adm_denied_text'), $this->Lang_Get('adm_denied_title'));
        return Router::Action('error');
    }
}
?>
