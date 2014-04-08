<?php
/*
 * Пример нового экшна. Задаем новые страницы (не забудьте сконфигурировать роутинг в config.php плагина)
 *
 */

class PluginVs_ActionTeam extends ActionPlugin {
    private $sPlugin = 'team';
	/**
     * Главное меню
     */
    protected $sMenuHeadItemSelect = 'team';
    /**
     * Меню
     */
    protected $sMenuItemSelect = 'team';
    /**
     * Субменю
     */
    protected $sMenuSubItemSelect = 'all';
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
		
		// $sBlogUrl=$_REQUEST['subdomain'];
		// if (!($oBlog=$this->Blog_GetBlogByUrl($sBlogUrl))) {
			// return parent::EventNotFound();
		// }
		// $this->Hook_Run('team_show',array("oBlog"=>$oBlog));
	}

	/**
	 * Регистрируем евенты, по сути определяем УРЛы вида /somepage/.../
	 *
	 */
	protected function RegisterEvent() { 
		$this->AddEvent('index','EventTeam');
		$this->AddEvent('create','EventCreate'); 
		$this->AddEvent('_create','EventCreate');  		

		$this->AddEvent('_blog','EventShowBlog'); 
		$this->AddEvent('_video','EventShowVideo'); 
		$this->AddEvent('_au','EventShowAu'); 
		$this->AddEvent('_roster','EventShowRoster'); 
		$this->AddEvent('_edit','EventTeamEdit');

	/*	$this->AddEventPreg('/^[\w\-\_]+$/i','/^(page(\d+))?$/i','EventShowBlog');
		$this->AddEventPreg('/^[\w\-\_]+$/i','/^bad$/i','/^(page(\d+))?$/i','EventShowBlog');
		$this->AddEventPreg('/^[\w\-\_]+$/i','/^new$/i','/^(page(\d+))?$/i','EventShowBlog');
	*/	
		$this->AddEventPreg('/^[\w\-\_]+$/i','EventTeam');
	}

	protected function EventIndex() {
		$first="helloworld";
 		
	}
	protected function EventTeamEdit() {
	
	/*$conn = $this->Database_GetConnect(Config::Get('plugin.vs.dbconfig'));
        $arow = $conn->select("select * from wp_comments");
		print_r($arow);*/
		$team_id=1; 
		$sBlogUrl=$_REQUEST['subdomain'];
		if($sBlogUrl != ''){		
			$oBlog=$this->Blog_GetBlogByUrl($sBlogUrl); 
			if($oBlog && $oBlog->getTeamId()!=0)$team_id=$oBlog->getTeamId();
		} 		
		//$oTeam=$this->PluginVs_Stat_GetTeamByTeamId($team_id);	
		
		 
		if($this->checkRight($team_id)){
		
			$oTeam=$this->PluginVs_Stat_GetTeamByTeamId($team_id);	
			$oPlatform = $this->PluginVs_Stat_GetPlatformItemsAll();  
			$oGame = $this->PluginVs_Stat_GetGameItemsBySportId($oTeam->getSportId());
			
			$this->Viewer_AddHtmlTitle($oTeam->getName());	
			
			if($this->oUserCurrent->isAdministrator()) $this->Viewer_Assign('admin_can_edit', 1 );
			$this->Viewer_Assign('oTeam', $oTeam );
			$this->Viewer_Assign('oPlatform', $oPlatform );
			$this->Viewer_Assign('oGame', $oGame );
			$this->Viewer_Assign('teams', Config::Get('plugin.vs.teamplay_hockey_field') );
			
			if (isPost('submit_create_team')) {
				$oTeam=$this->submitTeam();	
				if($oBlog){
					Router::Location($oBlog->getTeamUrlFull().'_edit');
				}else{
					Router::Location(DIR_WEB_ROOT.'/team/'.$oTeam->getTeamId().'/edit');
				}
			}
			$this->Viewer_Assign('aBlogsAllow',$this->Blog_GetBlogsAllowByUser($this->oUserCurrent));
			$this->Viewer_Assign('oTeam', $oTeam );
			if($oBlog)$this->Viewer_Assign('oBlog', $oBlog );
			$this->SetTemplateAction('team_edit');
		}
	}
	
	protected function submitAuTeam() {
		$team_id=0;
		$logo='';
		if (func_check(getRequest('team_name',null,'post'),'text',2,30))$team_name=getRequest('team_name',null,'post');
		if (func_check(getRequest('team_brief',null,'post'),'text',2,30))$team_brief=getRequest('team_brief',null,'post');
		if (func_check(getRequest('game_id',null,'post'),'id',1,11))$game_id=getRequest('game_id',null,'post');
		if (func_check(getRequest('gametype_id',null,'post'),'id',1,11))$gametype_id=getRequest('gametype_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if (func_check(getRequest('links',null,'post'),'text',0,100))$links=getRequest('links',null,'post');
		if (func_check(getRequest('forma',null,'post'),'text',0,100))$forma=getRequest('forma',null,'post');
		if (func_check(getRequest('forma_field',null,'post'),'text',1,10))$forma_field=getRequest('forma_field',null,'post');
		if (func_check(getRequest('logo',null,'post'),'text',0,100))$logo=getRequest('logo',null,'post');
		if (func_check(getRequest('blog_id',null,'post'),'id',1,11))$blog_id=getRequest('blog_id',null,'post');
		
		$team_id=1; 
		$sBlogUrl=$_REQUEST['subdomain'];
		if($sBlogUrl != ''){		
			$oBlog=$this->Blog_GetBlogByUrl($sBlogUrl); 
			if($oBlog && $oBlog->getTeamId()!=0)$team_id=$oBlog->getTeamId();
		} 
		
		//echo $team_id;
		if ($this->checkRight($team_id)){
			if($team_id!=0 && $this->checkRight($team_id)){
				$oTeam =  $this->PluginVs_Stat_GetTeamByTeamId($team_id);
				
				foreach(Config::Get('plugin.vs.teamplay_hockey_field') as $forma){
					if ($forma_field==$forma['img'])
					{
						$oTeam->setFormaField($forma['img']);
						$oTeam->setForma($forma['name']);	
					}
				}
				$oTeam->Save();
			}
			
			
			return $oTeam;
		}
	}
	
	protected function EventShowAu() { 
		$this->sMenuSubItemSelect='au';
		$team_id=1; 
		$sBlogUrl=$_REQUEST['subdomain'];
		if($sBlogUrl != ''){		
			$oBlog=$this->Blog_GetBlogByUrl($sBlogUrl); 
			if($oBlog && $oBlog->getTeamId()!=0)$team_id=$oBlog->getTeamId();
		} 		
		$oTeam=$this->PluginVs_Stat_GetTeamByTeamId($team_id);	
		
		if ($this->checkRight($team_id)==true){
			
			if (isPost('team_settings_save')) {
				$oTeam=$this->submitAuTeam();	
				//if(Config::Get('sys.site')=='ch')Router::Location('http://'.$_REQUEST['subdomain'].'.consolehockey.com/_au/');
				//if(Config::Get('sys.site')=='vs')Router::Location('http://'.$_REQUEST['subdomain'].'.virtualsports.ru/_au/');		
			}
			
			if (isPost('save_slider')) {
				$show_slider = getRequest('show_slider') ? 1 : 0;	
				$oTeam->setShowSlider($show_slider);
				$oTeam->setSlide( intval(getRequest('slide1')).';'.intval(getRequest('slide2')).';'.intval(getRequest('slide3')).';'.intval(getRequest('slide4')) );
				$oTeam->Save();
			} 
			$sUsers=getRequest('playercards');
			$aUsers=explode(',',$sUsers);		
			$this->aUsersId=array();
			
			foreach ($aUsers as $sUser) {
				$sUser=trim($sUser);			
				if ($sUser=='' ) {
					continue;
				}
				$aUser =  explode("^", $sUser);
				$sUser = trim($aUser[0]);
				$oUser = $this->User_GetUserByLogin(trim(strip_tags($aUser[1])));
				if ( $oPlayercard = $this->PluginVs_Stat_GetPlayercardByFilter(array(
					'platform_id' => $oTeam->getPlatformId(),
					'user_id' => $oUser->getUserId(),
					'#where' => array("ltrim(rtrim((concat(family,' ', name))) = ? )" => array($sUser)),
					'#with' => array('platform'),
					)) 
				) {	
					if ( !$oInvite = $this->PluginVs_Stat_GetInviteByFilter(array(
						'team_id' => $oTeam->getTeamId(),
						'playercard_id' => $oPlayercard->getPlayercardId(),
						'player_submit' => '0',
						'tournament_id' => '0',
						)) 
					) {
						$Invite_add = Engine::GetEntity('PluginVs_Stat_Invite');
						$Invite_add->setPlayercardId($oPlayercard->getPlayercardId());
						$Invite_add->setTeamId($oTeam->getTeamId()); 	
						$Invite_add->setTeamSubmit(1); 	
						$Invite_add->setTournamentId(0);
						$Invite_add->setTimes(date("Y-m-d H:i:s"));
						$Invite_add->Add();
						
						$aUsers=array();
						$oUserTarget=$this->User_GetUserById($oPlayercard->getUserId());
						$aUsers[0]=$oUserTarget;					
						$link=Router::GetPath('settings')."teamplay/".$oPlayercard->getSport()->getBrief()."/".$oPlayercard->getPlatform()->getBrief()."/";
						$oTalk=$this->Talk_SendTalk($this->Lang_Get('plugin.vs.you_was_invited').$oTeam->getName(),$this->Lang_Get('plugin.vs.go_to_link').' <a href="'.$link.'">'.$this->Lang_Get('plugin.vs.link').'</a>',$this->oUserCurrent,$aUsers);
					}
					
					if ( $oInvite = $this->PluginVs_Stat_GetInviteByFilter(array(
						'team_id' => $oTeam->getTeamId(),
						'playercard_id' => $oPlayercard->getPlayercardId(),
						'player_submit' => '1',
						'team_submit'=> '0',
						'tournament_id' => '0'
						)) 
					) {
						$oInvite->setTeamSubmit(1);
						$oInvite->setSubmit(1);
						$oInvite->setTimesSubmit(date("Y-m-d H:i:s"));
						$oInvite->Save();
						
						if($oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
								'playercard_id' => $oPlayercard->getPlayercardId(),
								'tournament_id'         => 0					
							)))
						{					
							$oPlayerTournament = Engine::GetEntity('PluginVs_Stat_Playertournament');
							$oPlayerTournament->setPsnid('');	
							$oPlayerTournament->setUserId($oPlayercard->getUserId());
							$oPlayerTournament->setPlayercardId($oPlayercard->getPlayercardId());	
							$oPlayerTournament->setTeamId($oTeam->getTeamId());
							$oPlayerTournament->setTournamentId(0);	
							$oPlayerTournament->setDates(date("Y-m-d H:i:s"));	
							$oPlayerTournament->setOtozvan('0');
							$oPlayerTournament->Add();
						}else{
							
							if($oPlayerTournament->getTeamId()!=0 && $oPlayerTournament->getTeamId()!=$oTeam->getTeamId()){
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
							$Transfer_add->setWho($this->oUserCurrent->GetUserId()); 
							$Transfer_add->setAction('join_team'); 
							$Transfer_add->Add();
							
							
							$oPlayerTournament->setTeamId($oTeam->getTeamId());
							$oPlayerTournament->setCap(0);
							$oPlayerTournament->Save();
						}
			
					}
				}
			}		
			if($sUsers){
				if(Config::Get('sys.site')=='ch')Router::Location('http://'.$_REQUEST['subdomain'].'.consolehockey.com/_au/');
				if(Config::Get('sys.site')=='vs')Router::Location('http://'.$_REQUEST['subdomain'].'.virtualsports.ru/_au/');							
			}
			if ( $aInvites = $this->PluginVs_Stat_GetInviteItemsByFilter(array(
					'team_id' => $oTeam->getTeamId(),
					'player_submit' => '0',
					'tournament_id' => '0',
					'#with'         => array('team'),
					)) 
				) {
				$this->Viewer_Assign('aInvites', $aInvites );	
			}	
			
			if ( $aInvitesFromPlayers = $this->PluginVs_Stat_GetInviteItemsByFilter(array(
					'team_id' => $oTeam->getTeamId(),
					'player_submit' => '1',
					'team_submit' => '0',
					'tournament_id' => '0', 
					)) 
				) {
				$this->Viewer_Assign('aInvitesFromPlayers', $aInvitesFromPlayers );	
			}
			if($aSostav = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
					'team_id' => $oTeam->getTeamId(),
					'tournament_id'         => 0,
					'#with'         => array('playercard'),					
				)))
			{
				$this->Viewer_Assign('aSostav', $aSostav );
			}
			if($oPlayer = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
								'team_id' => $oTeam->getTeamId(),
								'tournament_id' => 0 ,
								'user_id' =>  $this->oUserCurrent->GetUserId()) ) 
			){
				$this->Viewer_Assign('oPlayer', $oPlayer );		
			}
			$aFilter=array(
					'topic_publish' => 1,
					'blog_id' => $oBlog->getId(),
				);
			$aTopics=$this->Topic_GetTopicsByFilter($aFilter);	
				
			$this->Viewer_Assign('oTeam', $oTeam );
			$this->Viewer_Assign('oBlog', $oBlog );
			if($aTopics)$this->Viewer_Assign('aTopics', $aTopics['collection'] );
			if($this->checkRight($team_id))	$this->Viewer_Assign('can_edit', 1 );
			$this->Viewer_Assign('teams', Config::Get('plugin.vs.teamplay_hockey_field') );
			$this->SetTemplateAction('au');
		}else{
			  return $this->EventDenied();
		}
	}

	protected function EventShowRoster() {
		$this->sMenuSubItemSelect='roster';
		$team_id=0;
		$sBlogUrl=$_REQUEST['subdomain'];
		if($sBlogUrl != ''){		
			$oBlog=$this->Blog_GetBlogByUrl($sBlogUrl); 
			if($oBlog && $oBlog->getTeamId()!=0)$team_id=$oBlog->getTeamId();
		}
		$this->Hook_Run('team_show',array("oBlog"=>$oBlog));
		if($aPlayers = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
			'team_id' => $team_id, 
			'tournament_id' => 0,
			'#with'         => array('playercard'),
			'#order'		 => array('cap'=>'desc')
			)) )
		$this->Viewer_Assign('aPlayers', $aPlayers );
		$oTeam=$this->PluginVs_Stat_GetTeamByTeamId($team_id);	
		$this->Viewer_Assign('oTeam', $oTeam );		
		$this->Viewer_Assign('oBlog', $oBlog );
		if($this->checkRight($team_id))	$this->Viewer_Assign('can_edit', 1 );
 		$this->SetTemplateAction('roster');
	}
	protected function EventTeam() {
		$this->sMenuSubItemSelect='index';
	/*$conn = $this->Database_GetConnect(Config::Get('plugin.vs.dbconfig'));
        $arow = $conn->select("select * from wp_comments");
		print_r($arow);*/
		$team_id=1; 
		if (func_check(Router::GetActionEvent(),'id',1,11))$team_id=Router::GetActionEvent();
		
		$sBlogUrl=$_REQUEST['subdomain'];
		if($sBlogUrl != ''){		
			$oBlog=$this->Blog_GetBlogByUrl($sBlogUrl); 
			if($oBlog && $oBlog->getTeamId()!=0)$team_id=$oBlog->getTeamId();
		} 
		if(isset($oBlog)){
			$this->Viewer_Assign('oBlog', $oBlog );
			$this->Hook_Run('team_show',array("oBlog"=>$oBlog));
		}
		if(Router::GetParam(0)=='edit' && $this->checkRight($team_id)){
			
			$this->Viewer_Assign('aBlogsAllow',$this->Blog_GetBlogsAllowByUser($this->oUserCurrent));
			$oTeam=$this->PluginVs_Stat_GetTeamByTeamId($team_id);	
			$oPlatform = $this->PluginVs_Stat_GetPlatformItemsAll();  
			$oGame = $this->PluginVs_Stat_GetGameItemsBySportId($oTeam->getSportId());
			
			$this->Viewer_AddHtmlTitle($oTeam->getName());	
			
			if($this->oUserCurrent->isAdministrator()) $this->Viewer_Assign('admin_can_edit', 1 );
			$this->Viewer_Assign('oTeam', $oTeam );
			$this->Viewer_Assign('oPlatform', $oPlatform );
			$this->Viewer_Assign('oGame', $oGame );
			$this->Viewer_Assign('teams', Config::Get('plugin.vs.teamplay_hockey_field') );
			
			if (isPost('submit_create_team')) {
				$oTeam=$this->submitTeam();	
				if(isset($oBlog)){
					Router::Location($oBlog->getTeamUrlFull().'_team/edit');
				}else{
					Router::Location(DIR_WEB_ROOT.'/team/'.$oTeam->getTeamId().'/edit');
				}
			}
			
			$this->SetTemplateAction('team_edit');
		}else{ 
			
			
			
			if (func_check(Router::GetActionEvent(),'id',1,11))$team_id=Router::GetActionEvent();			
			$oTeam=$this->PluginVs_Stat_GetTeamByTeamId($team_id);			
			if ($oTeam)$this->Viewer_AddHtmlTitle($oTeam->getName());	
			
			if($oTeam && $oTeam->getOneTournament()==1)
			if($oPlayers = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
								'team_id' => $team_id, 
								'#with'         => array('user','playercard'),
								'#order'		 => array('cap'=>'desc')
								)) )$this->Viewer_Assign('oPlayers', $oPlayers );
			if($this->checkRight($team_id))	$this->Viewer_Assign('can_edit', 1 );				
			if($oTeam)$this->Viewer_Assign('oTeam', $oTeam );
			
			$sql="SELECT t.gametype_id from tis_stat_tournament t, tis_stat_teamsintournament tt where tt.team_id='".$team_id."' and tt.tournament_id=t.tournament_id LIMIT 0,1";
			$aGamess=$this->PluginVs_Stat_GetAll($sql); 
			if($aGamess)	$gametype_id=$aGamess[0]['gametype_id'];
		
			$Playerstat = $this->PluginVs_Stat_GetPlayerstatItemsByFilter(array(
				'team_id' => $team_id, 
				'#with'         => array('user','tournament'),
				'#order' =>array('tournament_id'=>'desc','round_id'=>'asc') 
			));
			$this->Viewer_Assign('Playerstat', $Playerstat );
			if(isset($gametype_id))$this->Viewer_Assign('gametype_id', $gametype_id );
			$sShowType='';
			if($oTeam && $oTeam->getBlogId()) {
				$own_page=1; 
				//$oBlog=$this->Blog_GetBlogByTeamId($team_id);
				if(isset($oBlog) && $oBlog){
					$aResult=$this->Topic_GetTopicsByBlog($oBlog,1,10,$sShowType);
					$aTopics=$aResult['collection'];				
					$this->Viewer_Assign('aTopics', $aTopics );
				}
				if($oTeam->getShowSlider()==1){
					$topics_arr=array();
					if(isset($aTopics) && $aTopics)
					foreach($aTopics as $key=>$value){
						$topics_arr[] = $key;
					}
					
					$slide_arr=array();
					$slides = explode(";", $oTeam->getSlide());
					if($slides)
					foreach($slides as $slide){
						if($slide!=0){
							$slide_arr[]=$slide;
						}
					}	
					if(count($slide_arr)==0 && count($topics_arr)!=0){
						for($i=0; $i<4; $i++){
							foreach($topics_arr as $topic){
								if( !in_array($topic,$slide_arr)){
									$slide_arr[] = $topic;
									break;
								}
							}
						}
					}	
					if(count($slide_arr)!=0){
						$aFilter=array(
							'topic_id' => $slide_arr);
						$aResult=$this->Topic_GetTopicsByFilter($aFilter);
						
						//print_r($aResult);
						$this->Viewer_Assign('aSliderTopics', $aResult['collection'] );
					}
				}
			}else{ 
				$own_page=0;
			}
			$this->Viewer_Assign('own_page', $own_page );
			$this->SetTemplateAction('team');
		}
		if($this->checkRight($team_id))	$this->Viewer_Assign('can_edit', 1 );
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

		
		$oGame = $this->PluginVs_Stat_GetGameItemsBySportId($sport_id);
		$oPlatform = $this->PluginVs_Stat_GetPlatformItemsAll();  
		
		/**
		 * Проверяем отправлена ли форма с данными(хотяб одна кнопка)
		 */
		if (isPost('submit_create_team')) {
			$oTeam=$this->submitTeam();			
			
			$this->Viewer_Assign('on_accept', 1 );
			//Router::Location(DIR_WEB_ROOT.'/team/'.$oTeam->getTeamId().'/edit');
		}
		if($this->oUserCurrent->isAdministrator()) $this->Viewer_Assign('admin_can_edit', 1 );
		$this->Viewer_Assign('oGame', $oGame );
		$this->Viewer_Assign('oPlatform', $oPlatform );
		$this->Viewer_Assign('sport_id', $sport_id ); 
		$this->Viewer_Assign('sport', Router::GetParam(0)); 
		$this->Viewer_Assign('teams', Config::Get('plugin.vs.teamplay_hockey_field') );
		$this->Viewer_Assign('aBlogsAllow',$this->Blog_GetBlogsAllowByUser($this->oUserCurrent));
		
		$this->SetTemplateAction('team_edit');
	}	

	protected function submitTeam() {
		$team_id=0;
		$logo='';
		if (func_check(getRequest('team_name',null,'post'),'text',2,30))$team_name=getRequest('team_name',null,'post');
		if (func_check(getRequest('team_brief',null,'post'),'text',2,30))$team_brief=getRequest('team_brief',null,'post');
		if (func_check(getRequest('game_id',null,'post'),'id',1,11))$game_id=getRequest('game_id',null,'post');
		if (func_check(getRequest('gametype_id',null,'post'),'id',1,11))$gametype_id=getRequest('gametype_id',null,'post');
		if (func_check(getRequest('team_id',null,'post'),'id',1,11))$team_id=getRequest('team_id',null,'post');
		if (func_check(getRequest('links',null,'post'),'text',0,100))$links=getRequest('links',null,'post');
		if (func_check(getRequest('forma',null,'post'),'text',0,100))$forma=getRequest('forma',null,'post');
		if (func_check(getRequest('forma_field',null,'post'),'text',1,10))$forma_field=getRequest('forma_field',null,'post');
		if (func_check(getRequest('logo',null,'post'),'text',0,100))$logo=getRequest('logo',null,'post');
		if (func_check(getRequest('blog_id',null,'post'),'id',1,11))$blog_id=getRequest('blog_id',null,'post');
		
		$oGame= $this->PluginVs_Stat_GetGameByGameId($game_id);
		//echo $team_id;
		if ($this->checkRight($team_id)){
			if($team_id!=0 && $this->checkRight($team_id)){
				$oTeam =  $this->PluginVs_Stat_GetTeamByTeamId($team_id);
			}else{
				$oTeam =  Engine::GetEntity('PluginVs_Stat_Team');
				$oTeam->setLogo('');
				$oTeam->setSmalllogo('');
				$oTeam->setStatus('wait');				
				$oTeam->setSportId($oGame->getSportId());
				$oTeam->setOwnerId($this->oUserCurrent->GetUserId());
			}								
				
			$oTeam->setGametypeId($gametype_id);	
			$oTeam->setGameId($game_id);
			$oTeam->setPlatformId($oGame->getPlatformId());
			foreach(Config::Get('plugin.vs.teamplay_hockey_field') as $forma){
				if ($forma_field==$forma['img'])
				{
					$oTeam->setFormaField($forma['img']);
					$oTeam->setForma($forma['name']);	
				}
			}	
			
			$oTeam->setLinks($links);	
			$oTeam->setName($team_name);	
			$oTeam->setShortname($team_name);	
			$oTeam->setBrief($team_brief);	
			if(isset($blog_id)){
				if($oTeam && $oTeam->getTeamId()!=0){
					$oBlog=$this->Blog_GetBlogByTeamId($oTeam->getTeamId()); 
					//if($oBlog)$this->Blog_UpdateTeam($oBlog,0);
				}
				//$oTeam->setBlogId($blog_id);
				if(Config::Get('sys.site')=='vs')$oTeam->setBlogVsId($blog_id);
				if(Config::Get('sys.site')=='ch')$oTeam->setBlogChId($blog_id);
				$oBlog=$this->Blog_GetBlogById($blog_id); 
				//if($oBlog)$this->Blog_UpdateTeam($oBlog,$team_id);
			}
			//if($this->oUserCurrent->isAdministrator() && $logo!='')$oTeam->setLogo($logo);		
			
			$oTeam->Save();
			
			return $oTeam;
		}
	}
	protected function EventShowBlog() {
		$this->sMenuSubItemSelect='blog';
		$sPeriod=1; // по дефолту 1 день
		if (in_array(getRequest('period'),array(1,7,30,'all'))) {
			$sPeriod=getRequest('period');
		}
		//$sBlogUrl=$this->sCurrentEvent;
		$sBlogUrl=$_REQUEST['subdomain'];
		
		if($sBlogUrl != ''){
			$oBlog=$this->Blog_GetBlogByUrl($sBlogUrl);
			if($oBlog && $oBlog->getTeamId()!=0)$team_id=$oBlog->getTeamId();
		}
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
		$this->Hook_Run('team_show',array("oBlog"=>$oBlog));
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
		//$this->sMenuSubItemSelect=$sShowType=='newall' ? 'new' : $sShowType;
		$this->sMenuSubBlogUrl=$oBlog->getUrlFull();
		/**
		 * Передан ли номер страницы
		 */
		$iPage= $this->GetParamEventMatch(($sShowType=='good')?0:1,2) ? $this->GetParamEventMatch(($sShowType=='good')?0:1,2) : 1;
		if ($iPage==1 and !getRequest('period') and in_array($sShowType,array('discussed','top'))) {
			$this->Viewer_SetHtmlCanonical($oBlog->getUrlFull().$sShowType.'/');
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
		$this->Viewer_AddHtmlTitle($oBlog->getTitle());
		$this->Viewer_SetHtmlRssAlternate(Router::GetPath('rss').'blog/'.$oBlog->getUrl().'/',$oBlog->getTitle());
		/**
		 * Устанавливаем шаблон вывода
		 */
		if($this->checkRight($team_id))	$this->Viewer_Assign('can_edit', 1 );
		$this->SetTemplateAction('blog');
	}
	protected function EventShowBlog2() {
	 
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
			$aResult=$this->Topic_GetTopicsByBlog($oBlog,$iPage,Config::Get('module.topic.per_page'),$sShowType);
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
		$this->Viewer_AddHtmlTitle($oBlog->getTitle());
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
	
	protected function EventShowVideo() {
		$this->sMenuSubItemSelect='video';
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
		$this->Viewer_AddHtmlTitle($oBlog->getTitle());
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
	
	protected function checkRight($team_id) {

		if ($this->oUserCurrent && $this->oUserCurrent->isAdministrator())	return true;
 		
		if ($this->oUserCurrent && $oPlayers = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
								'team_id' => $team_id,
								'cap in' => array('1','2') ,
								'tournament_id' => '0',
								'user_id' =>  $this->oUserCurrent->GetUserId(),								
								)) )return true;
		if ($team_id==0) return true;
		return false;						
	}
    protected function EventDenied() {
        $this->Message_AddErrorSingle('Something wrong', 'Hmm');
        return Router::Action('error');
    }
	
	public function EventShutdown()
    {
        /**
         * Загружаем переменные в шаблон
         */
        $this->Viewer_Assign('sMenuHeadItemSelect', $this->sMenuHeadItemSelect);
        $this->Viewer_Assign('sMenuItemSelect', $this->sMenuItemSelect);
        $this->Viewer_Assign('sMenuSubItemSelect', $this->sMenuSubItemSelect);
    }
	
}