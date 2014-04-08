<?php

class PluginVs_ActionAdmin extends PluginVs_Inherits_ActionAdmin {

	protected function RegisterEvent() {
		parent::RegisterEvent();
        $this->AddEvent('newteams', 'EventNewTeams');		
        $this->AddEvent('newteamadd', 'EventNewTeamEdit');
        $this->AddEvent('newteamedit', 'EventNewTeamEdit');
        $this->AddEvent('newteamdelete', 'EventNewTeamDelete');	
		$this->AddEvent('teams', 'EventTeams');		
	}
	
	protected function EventTeams() {
	    $this->_setTitle('Teams');
        
		
		
		$aTeams = $this->PluginVs_Stat_GetTeamItemsAll();	
		$this->Viewer_Assign('aTeams', $aTeams);
		
		$this->SetTemplateAction('team_list');
	}
	protected function EventNewTeams() {
	    $this->_setTitle('Teams');
        
		if (isPost('submit_newteam_save')) {
            $this->SubmitSaveTeam();
        }
		
		if($this->GetParam(0)=='new'){
			$aTeams = $this->PluginVs_Stat_GetTeamItemsByFilter(array(
								'status' => 'wait'							
								));	
			
			$this->Viewer_Assign('sMode', 'new');
		}else{
			$aTeams = $this->PluginVs_Stat_GetTeamItemsByFilter(array(
							'gametype_id' =>'3' 						
								));	
		}
		$this->Viewer_Assign('aTeams', $aTeams);
		
		$this->SetTemplateAction('team_list');
	}
	
	protected function EventNewTeamEdit() {
	
		$this->_setTitle('Accept new team');
		
		
		
		$this->Viewer_Assign('sMode', str_replace('newteam','',Router::GetActionEvent()));	
		
		if(Router::GetActionEvent() == 'newteamedit'){
			if ($oTeam = $this->PluginVs_Stat_GetTeamByTeamId($this->GetParam(0))) {			
			
				if (!isPost('submit_newteam_save')) {
					$_REQUEST['name'] = $oTeam->getName();
					$_REQUEST['brief'] = $oTeam->getBrief();
					$_REQUEST['gametype_id'] = $oTeam->getGametypeId();
					$_REQUEST['game_id'] = $oTeam->getGameId();
					$_REQUEST['team_id'] = $oTeam->getTeamId();
					$_REQUEST['platform_id'] = $oTeam->getPlatformId();
					$_REQUEST['forma_filed'] = $oTeam->getFormaField();
					
					$_REQUEST['links'] = $oTeam->getLinks();
					$_REQUEST['blog_id'] = $oTeam->getBlogId();
					$_REQUEST['status'] = $oTeam->getStatus();
					if($oTeam->getOwner()){
						$_REQUEST['owner'] = $oTeam->getOwner()->getLogin();
					}else{
						$_REQUEST['owner'] ='';
					}
				}
		
			}else {
                $this->Message_AddError('No such team', $this->Lang_Get('error'));
                $this->SetParam(0, null);
            }
		}
		
		$oPlatform = $this->PluginVs_Stat_GetPlatformItemsAll();  
		$oGame = $this->PluginVs_Stat_GetGameItemsBySportId('1');
		$this->Viewer_Assign('oPlatform', $oPlatform );
		$this->Viewer_Assign('oGame', $oGame );
		$this->Viewer_Assign('teams', Config::Get('plugin.vs.teamplay_hockey_field') );
		$this->Viewer_Assign('aBlogsAllow',$this->Blog_GetBlogsAllowByUser($this->oUserCurrent));
		
			
		$this->SetTemplateAction('team_edit');
	}
	
	public function SubmitSaveTeam(){
		/*
		if (!getRequest('team_id')) {
			$this->Message_AddError($this->Lang_Get('system_error'));
		}elseif (!$oTeam = $this->PluginVs_Stat_GetTeamByTeamId( getRequest('team_id') )) {
			$oSeopack = Engine::GetEntity('PluginVs_ModuleStat_EntityTeam');
			$oSeopack->setUrl( $this->GetUri(getRequest('url')) );
		}*/
		$owner='';
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
		if (func_check(getRequest('create_blog',null,'post'),'id',0,2))$create_blog=getRequest('create_blog',null,'post');
		if (func_check(getRequest('status',null,'post'),'text',0,100))$status=getRequest('status',null,'post');
		if (func_check(getRequest('owner',null,'post'),'text',0,100))$owner=getRequest('owner',null,'post');
		
		$oUser = $this->User_GetUserByLogin (strip_tags($owner));
		
		if( $oTeam = $this->PluginVs_Stat_GetTeamByTeamId( $team_id )) {
			$oGame= $this->PluginVs_Stat_GetGameByGameId($game_id);
			
			
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
			
			$oTeam->setLinks(strip_tags($links));	
			$oTeam->setName(strip_tags($team_name));	
			$oTeam->setShortname(strip_tags($team_name));	
			$oTeam->setBrief(strip_tags($team_brief));	
			if($oUser)$oTeam->setOwnerId($oUser->getId());
			$old_status=$oTeam->getStatus();
			$oTeam->setStatus(strip_tags($status));
			$oTeam->setLogo('000_CH.png');
			
			if($oTeam->getBlogId()==0 && $create_blog == '1' ){
				$subdomain_brief = str_replace(' ','',$oTeam->getBrief());
				if( $oBlog_exist=$this->Blog_GetBlogByUrl( strtolower($subdomain_brief) ) ){
					if($oBlog_exist->getTitle()==strip_tags($oTeam->getName()) ){
						$oBlog = $oBlog_exist;
						$oBlog->setUrl(strtolower ($subdomain_brief));
					}else{
						$oBlog = Engine::GetEntity('Blog');
						$oBlog->setUrl(strtolower ($subdomain_brief).'2');
						$oBlog_exist = null;
					}
				}else{
					$oBlog = Engine::GetEntity('Blog');
					$oBlog->setUrl(strtolower ($subdomain_brief));					
				}
				
				$oBlog->setOwnerId($oTeam->getOwnerId());
				$oBlog->setTitle(strip_tags($oTeam->getName()));
			 
				$oBlog->setDescription('Blog team '.strip_tags($oTeam->getName()));
				$oBlog->setType('open');
				$oBlog->setDateAdd(F::Now());
				$oBlog->setLimitRatingTopic('-10');
				
				$oBlog->setAvatar(null);
				
				print_r($oBlog);
				if(!$oBlog_exist){
					$this->Blog_AddBlog($oBlog);
				}else{
					$this->Blog_UpdateBlog($oBlog);
				}
				//$oBlog = $this->Blog_GetBlogById($oBlog->getId());
				
				//$oTeam->setBlogChId($oBlog->getBlogId());
				//$oTeam->Save();
				$blog_id = $oBlog->getId();
				

				$oBlog->setTeam('1');				
				$this->Blog_SetTeamLeague($oBlog);
		
				$sql="select blog_url from ".Config::Get('db.table.blog')."  where team=1";
				$teams=$this->PluginVs_Stat_GetAll($sql); 
				$to_text_array=array();
				foreach($teams as $team){
					$to_text_array[]=strtolower($team['blog_url']);
				}
				if(Config::Get('sys.site')=='vs')$file = '/www/virtualsports.ru/plugins/vs/config/teams.ttp';
				if(Config::Get('sys.site')=='ch')$file = '/www/consolehockey.com/plugins/vs/config/teams.ttp';
					
				//$file = '/www/consolehockey.com/plugins/vs/config/teams.ttp';
				if (file_exists($file)) { 
					$fp = fopen($file,'w');  
					fwrite($fp, implode(",", $to_text_array));
					fclose($fp);
				}
				
				$oUser = $this->User_GetUserCurrent();
				if ($oUser->isAdministrator()) {
					$oBlog->setOrderNum(getRequest('order_num', 0));
					$oBlog->setBlogsOnly(getRequest('blogs_only', false));
				}
				 
				if(Config::Get('sys.site')=='ch'){				
					if($oGame->getPlatformId() ==1 ){
						$parent_blog_id=9;
					}else{
						$parent_blog_id=12;
					}
				}
				if(Config::Get('sys.site')=='vs'){				
					if($oGame->getPlatformId() ==1 ){
						$parent_blog_id=1010;
					}else{
						$parent_blog_id=1010;
					}
				}
				$oBlog->setParentId($parent_blog_id);
				$this->Blog_UpdateTreeblogData($oBlog);
				
				$oBlog->setTeamId($team_id);
				if($oBlog)$this->Blog_UpdateTeam($oBlog,$team_id);
			}
			if(isset($blog_id)){
					//if($oTeam && $oTeam->getTeamId()!=0){
						//$oBlog=$this->Blog_GetBlogByTeamId($oTeam->getTeamId()); 
						//if($oBlog)$this->Blog_UpdateTeam($oBlog,0);
					//}
					//$oTeam->setBlogId($blog_id);
					if(Config::Get('sys.site')=='vs')$oTeam->setBlogVsId($blog_id);
					if(Config::Get('sys.site')=='ch')$oTeam->setBlogChId($blog_id);
					$oBlog=$this->Blog_GetBlogById($blog_id); 
					if($oBlog)$this->Blog_UpdateTeam($oBlog,$team_id);
				}
				//if($this->oUserCurrent->isAdministrator() && $logo!='')$oTeam->setLogo($logo);		
	
			
			if (  $oTeam->Save() ) {
				if($old_status!=$status && $status=='play' ){
		//Get Playercard	
					if( ! $oPlayercard = $this->PluginVs_Stat_GetPlayercardByFilter(array(
							'user_id' => $oTeam->getOwnerId(),
							'platform_id' =>$oTeam->getPlatformId()
					))){
						$oPlayercard =  LS::Ent('PluginVs_Stat_Playercard');	
						$oPlayercard->setPlatformId($oTeam->getPlatformId());
						$oPlayercard->setUserId($oTeam->getOwnerId());
						$oPlayercard->setSportId('1');
						$oPlayercard->setNumber('00');
						$oPlayercard->setName('');
						$oPlayercard->setFamily('');
						$oPlayercard->setPlayTime('');
						$oPlayercard->setAbout(''); 
						$oPlayercard->setLw(0);
						$oPlayercard->setC(0);
						$oPlayercard->setRw(0);
						$oPlayercard->setLd(0);
						$oPlayercard->setRd(0);
						$oPlayercard->setG(0);
						$oPlayercard->setLastUpdate(date("Y-m-d H:i:s"));
						
						$oPlayercard->setLooking(0);
						$oPlayercard->setEndGames(0);
						$oPlayercard->setTimes(date("Y-m-d H:i:s"));
						$oPlayercard->Add();				
					}

		// Create playertournament
					if(!$oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
						'playercard_id' => $oPlayercard->getPlayercardId(),
						'tournament_id'         => 0	,
							)))
					{		
						$oPlayerTournament = Engine::GetEntity('PluginVs_Stat_Playertournament');
						$oPlayerTournament->setPsnid('');	
						$oPlayerTournament->setUserId($oPlayercard->getUserId());
						$oPlayerTournament->setPlayercardId($oPlayercard->getPlayercardId());	
						$oPlayerTournament->setTeamId(0);
						$oPlayerTournament->setTournamentId(0);	
						$oPlayerTournament->setDates(date("Y-m-d H:i:s"));	
						$oPlayerTournament->setOtozvan('0');
						$oPlayerTournament->Add();
						
						$oPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentByFilter(array(
							'playercard_id' => $oPlayercard->getPlayercardId(),
							'tournament_id'         => 0	,
						));
					}
			// Create Invite
					if($oTeam->getTeamId() != $oPlayerTournament->getTeamId()){
						$oInvite = Engine::GetEntity('PluginVs_Stat_Invite');
						$oInvite->setPlayercardId($oPlayercard->getPlayercardId());
						$oInvite->setTeamId($oTeam->getTeamId()); 	
						$oInvite->setTeamSubmit(1); 	
						$oInvite->setTournamentId(0);
						$oInvite->setTimes(date("Y-m-d H:i:s"));
						$oInvite->Add();
						
						$oInvite = $this->PluginVs_Stat_GetInviteById($oInvite->getId());
			//Submit invite or trade
						$id = 1;
						$who = 'player';
						if($oInvite->getTournamentId()==0){
							if($who=='player' && $oInvite->getPlayerSubmit()==0){
								if($id==1){				
									$oInvite->setPlayerSubmit(1);
									$oInvite->setSubmit(1);
									$oInvite->setTimesSubmit(date("Y-m-d H:i:s"));
									$oInvite->Save();
									 
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
									$Transfer_add->setWho($oPlayercard->getUserId()); 
									$Transfer_add->setAction('join_team'); 
									$Transfer_add->Add();
										
									$oPlayerTournament->setTeamId($oTeam->getTeamId());
									$oPlayerTournament->setCap(2);
									$oPlayerTournament->Save();	
									$answer='Player '.$oPlayercard->getFullFio().' join club';
									$why='';
								}
								
									$aUsers=array();
									if($aPlayerTournament = $this->PluginVs_Stat_GetPlayertournamentItemsByFilter(array(
											'team_id' => $oTeam->getTeamId(),
											'tournament_id' => 0	,
											'cap >' => 0
										)))
										{	
											if(count($aPlayerTournament)>0){
												foreach($aPlayerTournament as $osPlayerTournament){
													$oUserTarget=$this->User_GetUserById($osPlayerTournament->getUserId());
													$aUsers[]=$oUserTarget;
												}													
												$oTalk = $this->Talk_SendTalk($answer, $why, $this->oUserCurrent, $aUsers);
											}
										}			
							}
							
							
						}
					}
				}
				//$this->Message_AddNotice('All is ok');
				Router::Location('admin/newteams/');
			} else {
				//$this->Message_AddError($this->Lang_Get('system_error'));
			}		
		
		}
	
	}
	
	
	protected function EventNewTeamDelete() {
	}
}