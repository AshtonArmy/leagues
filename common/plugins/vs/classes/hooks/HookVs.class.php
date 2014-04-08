<?php
/*
 * Пример файла хуков
 *
 */

class PluginVs_HookVs extends Hook { 
	
	
	public function RegisterHook() {
		 
	//	$this->AddHook('template_profile_whois_item', 'ProfileTournamentInfo', __CLASS__,1); 
	//	$this->AddHook('template_topic_show_before', 'BeforeTopic', __CLASS__,1); 
	//	$this->AddHook('template_profile_whois_item', 'ProfileMedalsInfo', __CLASS__,1); 
	//	$this->AddHook('template_second_menu', 'SecondMenu', __CLASS__,1); 
	//	$this->AddHook('template_turnir_menu', 'TurnirMenu', __CLASS__,1); 
	//	$this->AddHook('template_spisok_turnirov', 'SpisokTurnirov', __CLASS__,1); 
	//	$this->AddHook('template_form_settings_tuning_end', 'SiteSettings', __CLASS__,1); 
	//	$this->AddHook('template_spisok_igr', 'SpisokIgr', __CLASS__,1); 
		$this->AddHook('topic_show', 'TopicShow', __CLASS__,1); 
		$this->AddHook('topic_add_after', 'TopicSave', __CLASS__);
		$this->AddHook('topic_edit_after', 'TopicSave', __CLASS__);
		$this->AddHook('team_show', 'TeamShow', __CLASS__,1); 
		$this->AddHook('forum_show', 'ForumShow', __CLASS__,1); 
		$this->AddHook('forum_topic_show', 'ForumTopicShow', __CLASS__,1); 
		$this->AddHook('init_action', 'InitAction');
		
		$this->AddHook('template_form_add_blog_end', 'AddBlogChoose', __CLASS__);
		$this->AddHook('template_form_add_blog_end_bottom', 'AddBlogLogos', __CLASS__);
		//$this->AddHook('template_leagues_top_right', 'AddLeaguesLogosOnTop', __CLASS__);
		$this->AddHook('blog_add_after','SaveBlog');
		$this->AddHook('blog_edit_after','SaveBlog');
		//$this->AddHook('template_write_item','WriteItem');

		$this->AddHook('template_block_stream_nav_item','BlockStreamNav', __CLASS__,-1);
		
		$this->AddHook('template_admin_menu_items_end', 'hook_admin_menu');
		$this->AddHook('template_form_add_topic_topic_end', 'AddTopicForm', __CLASS__);
		$this->AddHook('topic_edit_show', 'TopicEdit', __CLASS__);
		$this->AddHook('comment_add_after', 'CommentAdd', __CLASS__ );

	}
	public function CommentAdd($aVars) {
		$oCommentNew = $aVars['oCommentNew'];
		$oTopic = $aVars['oTopic'];
		$this->Comment_SetCommentNum($oCommentNew, ($oTopic->getCountComment()+1) );
	}
	
	public function AddTopicForm() { 
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'inject.topic.form.tpl');
	}
	public function TopicEdit($aVars) {
		$oTopic=$aVars['oTopic'];
		$this->Viewer_Assign('oTopicEdit',$oTopic);
	}
	
	public function hook_admin_menu() { 
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__) . 'admin_menu.tpl');
    }
	
	public function  AddLeaguesLogosOnTop() {
		//print_r( Config::Get('plugin.vs.ligi') );
		$aBlogs = $this->Blog_GetBlogsByFilter(array('in_url'=>Config::Get('plugin.vs.ligi')),array('blog_rating'=>'desc'),1,20);
		$this->Viewer_Assign('aBlogs',$aBlogs['collection']);

		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'leagues_top_right.tpl');
	}
	public function  AddBlogLogos($aParams) {
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'blog_form_bottom.tpl');
	}
	public function SaveBlog($aParams) {
		$oBlog=$aParams['oBlog'];
		
		if (isset($_REQUEST['blog_team'])) {
			$oBlog->setTeam(1); 
		} else {
			$oBlog->setTeam(0); 
		}
		
		if (isset($_REQUEST['blog_league'])) {
			$oBlog->setLeague(1); 
		} else {
			$oBlog->setLeague(0); 
		}		
		$this->Blog_SetTeamLeague($oBlog);
		
		$sql="select blog_url from ".Config::Get('db.table.blog')."  where team=1";
		$teams=$this->PluginVs_Stat_GetAll($sql); 
		$to_text_array=array();
		foreach($teams as $team){
			$to_text_array[]=strtolower($team['blog_url']);
		}
		if(Config::Get('sys.site')=='vs')$file = '/www/virtualsports.ru/plugins/vs/config/teams.ttp';
		if(Config::Get('sys.site')=='ch')$file = '/www/consolehockey.com/plugins/vs/config/teams.ttp';
		if (file_exists($file)) { 
			$fp = fopen($file,'w');  
			fwrite($fp, implode(",", $to_text_array));
			fclose($fp);
		}
		
		$sql="select blog_url from ".Config::Get('db.table.blog')."  where league=1";
		$leagues=$this->PluginVs_Stat_GetAll($sql);
		$to_text_array=array();
		foreach($leagues as $league){
			$to_text_array[]=strtolower($league['blog_url']);
		}
		if(Config::Get('sys.site')=='vs')$file = '/www/virtualsports.ru/plugins/vs/config/leagues.ttp';
		if(Config::Get('sys.site')=='ch')$file = '/www/consolehockey.com/plugins/vs/config/leagues.ttp';
		if (file_exists($file)) { 
			$fp = fopen($file,'w');  
			fwrite($fp, implode(",", $to_text_array));
			fclose($fp);
		}
		
		return;
	}
	public function AddBlogChoose(){
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'blog_form.tpl');
	}
	public function WriteItem() {
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'write_item.tpl');
	}
	public function BlockStreamNav() {
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'stream_nav.tpl');
	}
	public function InitAction()
    {
		If (Router::GetActionEvent() && substr(Router::GetActionEvent(),0,4)=='page'){
			$nomer = substr(Router::GetActionEvent(), 4, strlen(Router::GetActionEvent())-4);
			if($nomer>1)$this->Viewer_AddHtmlTitle("Страница ".$nomer); 
		}
		If (Router::GetParam(0) && substr(Router::GetParam(0),0,4)=='page'){
			$nomer = substr(Router::GetParam(0), 4, strlen(Router::GetParam(0))-4);
			if($nomer>1)$this->Viewer_AddHtmlTitle("Страница ".$nomer); 
		}	
	}
	
	public function TopicSave($aVars)
    {
		$oTopic = $aVars['oTopic'];
		$tournament_id = 0;
		if (isset($_REQUEST['tournament_id'])) {
			 $tournament_id = intval($_REQUEST['tournament_id']);
		}
		
		$Result = $this->Topic_UpdateTopicTournament($oTopic, $tournament_id);
		
		$slider_add=0;
		$sticky=0;
		$faq=0;
		
		if (getRequest('topic_slider_add')) {
			$slider_add = 1;
		}
		if (getRequest('topic_sticky')) {
			$sticky = 1;
		}
		if (getRequest('topic_faq')) {
			$faq = 1;
		}
		
		if( ($oTopic->getSliderAdd()?1:0) != $slider_add){		
			$Result = $this->Topic_UpdateTopicSetSlider($oTopic,$slider_add);
		}
		if( $oTopic->getSticky() != $sticky ){		
			$Result = $this->Topic_UpdateTopicSetSticky($oTopic,$sticky);
		}
		if( $oTopic->getFaq() != $faq ){		
			$Result = $this->Topic_UpdateTopicSetFaq($oTopic,$faq);
		}
		$Result = $this->Topic_UpdateTopicSetTopBlogId($oTopic, $this->Blog_GetTopParentId($oTopic->getBlogId()) );
		/*$aTopics = $this->Topic_GetTopicsByFilter(array('not_blog_id'=>0), 1, 1000);
		$aTopics  = $aTopics['collection'];
		foreach($aTopics as $oTopic){
			if(isset($oTopic) && $oTopic  )
			$Result = $this->Topic_UpdateTopicSetTopBlogId($oTopic, $this->Blog_GetTopParentId($oTopic->getBlogId()) );
		}
		$aTopics = $this->Topic_GetTopicsByFilter(array(), 2, 1000);
		foreach($aTopics as $oTopic){
			if(is_object($oTopic))$Result = $this->Topic_UpdateTopicSetTopBlogId($oTopic, $this->Blog_GetTopParentId($oTopic->getBlogId()) );
		}
		$aTopics = $this->Topic_GetTopicsByFilter(array(), 3, 1000);
		foreach($aTopics as $oTopic){
			if(is_object($oTopic))$Result = $this->Topic_UpdateTopicSetTopBlogId($oTopic, $this->Blog_GetTopParentId($oTopic->getBlogId()) );
		}
		$aTopics = $this->Topic_GetTopicsByFilter(array(), 4, 1000);
		foreach($aTopics as $oTopic){
			if(is_object($oTopic))$Result = $this->Topic_UpdateTopicSetTopBlogId($oTopic, $this->Blog_GetTopParentId($oTopic->getBlogId()) );
		}
		$aTopics = $this->Topic_GetTopicsByFilter(array(), 5, 1000);
		foreach($aTopics as $oTopic){
			if(is_object($oTopic))$Result = $this->Topic_UpdateTopicSetTopBlogId($oTopic, $this->Blog_GetTopParentId($oTopic->getBlogId()) );
		}
		$aTopics = $this->Topic_GetTopicsByFilter(array(), 6, 1000);
		foreach($aTopics as $oTopic){
			if(is_object($oTopic))$Result = $this->Topic_UpdateTopicSetTopBlogId($oTopic, $this->Blog_GetTopParentId($oTopic->getBlogId()) );
		}
		$aTopics = $this->Topic_GetTopicsByFilter(array(), 7, 1000);
		foreach($aTopics as $oTopic){
			if(is_object($oTopic))$Result = $this->Topic_UpdateTopicSetTopBlogId($oTopic, $this->Blog_GetTopParentId($oTopic->getBlogId()) );
		}
		*/
    }
	public function ForumShow($aVars){
		if(isset($aVars['oForum'])){
			$oForum=$aVars['oForum'];	
			if($oForum->getTeamId()<>0){
				$oTeam=$this->PluginVs_Stat_GetTeamByTeamId($oForum->getTeamId());
				if(Config::Get('sys.site')=='vs' )$oBlog=$this->Blog_GetBlogById($oTeam->getBlogVsId());
				if(Config::Get('sys.site')=='ch' )$oBlog=$this->Blog_GetBlogById($oTeam->getBlogChId());
				$this->Viewer_Assign('oBlog',$oBlog);
				$this->Viewer_Assign('team_page',1);			
			}
		}		
	}
	public function ForumTopicShow($aVars){
		if(isset($aVars['oTopic'])){
			$oForum=$aVars['oTopic']->getForum();	
			if($oForum->getTeamId()<>0){
				$oTeam=$this->PluginVs_Stat_GetTeamByTeamId($oForum->getTeamId());
				$oBlog=$this->Blog_GetBlogById($oTeam->getBlogId());
				$this->Viewer_Assign('oBlog',$oBlog);
				$this->Viewer_Assign('team_page',1);			
			}
		}		
	}
	public function TeamShow($aVars){

		if(isset($aVars['oBlog'])){
			$oBlog=$aVars['oBlog'];			
			$tournament_id=65; 
		}
			
		
		$this->oUserCurrent=$this->User_GetUserCurrent();
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id); 
		
		$team_id=0;
		if($oBlog && $oBlog->getTeamId()!=0)$team_id=$oBlog->getTeamId();	 
		if($team_id){
			$oTeam=Engine::GetInstance()->PluginVs_Stat_GetTeamByTeamId($team_id);
			
			$sql="select max(tournament_id) as tournament_id from tis_stat_teamsintournament where team_id='".$team_id."'";
			$tournaments=$this->PluginVs_Stat_GetAll($sql);
			if($tournaments){
				$tournament_id=$tournaments[0]['tournament_id'];	 
			}
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id); 
		}
		if(isset($oTeam)){
			$this->Viewer_Assign('oTeam', $oTeam );
			$this->Viewer_Assign('oBlog',$oBlog);
		} 
		if($oTournament){ 
			$this->Viewer_Assign('tournament',1);
			$this->Viewer_Assign('no_opisanie',1);
			
			$this->Viewer_Assign('tournament_id',$tournament_id);	 
			$domain='';
			$sPrimaryHost=str_replace('http://','',DIR_WEB_ROOT);
			if (SUBDOMAIN!=''){
				$domain="http://".SUBDOMAIN.".".$sPrimaryHost.'/';
			}else{
				$domain=DIR_WEB_ROOT;
			}
			
			$this->Viewer_Assign('link_zayavki', $domain."tournament/".$oTournament->getUrl()."/_uchastniki/zayavki/");
			
			//$this->Viewer_AddBlock('right','tournamentdescription',array('plugin'=>'vs', 'oTournament'=>$oTournament),999);	
			$this->Viewer_AddWidget('right','tournamentsheduleloader',array('plugin'=>'vs', 'oTournament'=>$oTournament,'myteam'=>$team_id),203);
			
			$this->Viewer_AddWidget('right','tournamentteamtable',array('plugin'=>'vs', 'oTournament'=>$oTournament),202);

		}
		$this->Viewer_AddWidget('right','stream',array(),200);
		
	}
	
	public function TopicShow($aVars){
		$this->oUserCurrent = $this->User_GetUserCurrent();
		$oTopic=$aVars['oTopic']; 
		$tournament_id=$oTopic->GetTournamentId();
		if($tournament_id){
			$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
			$this->Viewer_AddWidget('main','tournamentmenu',array('plugin'=>'vs', 'oTournament'=>$oTournament),999);
		/*
		$this->Viewer_Assign('sMenuHeadItemSelect', 'tournament');
        $this->Viewer_Assign('sMenuItemSelect', 'tournament');
        $this->Viewer_Assign('sMenuSubItemSelect', 'all');
        $this->Viewer_Assign('oTournament', $oTournament);
		
		$this->sMenuHeadItemSelect = 'tournament';
        $this->sMenuItemSelect = 'tournament';
        $this->sMenuSubItemSelect = 'all';
		*/
		
			$this->Viewer_AddWidget('right','tournamentdescription',array('plugin'=>'vs', 'oTournament'=>$oTournament),999);	
			$this->Viewer_AddWidget('right','tournamentsheduleloader',array('plugin'=>'vs', 'oTournament'=>$oTournament),203);
			$this->Viewer_AddWidget('right','tournamentteamtable',array('plugin'=>'vs', 'oTournament'=>$oTournament),202);
			
			if($this->oUserCurrent && ($this->oUserCurrent->isAdministrator() || $this->PluginVs_Stat_IsTournamentAdmin($oTournament)))$this->Viewer_Assign('admin','yes');
		
		
			$sql="select distinct 1 from tis_stat_playoff where tournament_id=".$oTournament->getTournamentId();
			if($this->PluginVs_Stat_GetAll($sql))$this->Viewer_Assign('po',1);
		}
		/*$oBlog=$oTopic->getBlog();
	 
		$oTournament=$this->PluginVs_Stat_GetTournamentByTournamentId($tournament_id);
		
		
		$team_id=0;
		if($oBlog && $oBlog->getTeamId()!=0)$team_id=$oBlog->getTeamId();	 
		if($team_id)$oTeam=Engine::GetInstance()->PluginVs_Stat_GetTeamByTeamId($team_id);	
		if(isset($oTeam)){
			$this->Viewer_Assign('oTeam', $oTeam );
			$this->Viewer_Assign('oBlog',$oBlog);
		}
		
		if($oTournament){ 
			$this->Viewer_Assign('tournament_id',$tournament_id);	 
			$domain='';
			$sPrimaryHost=str_replace('http://','',DIR_WEB_ROOT);
			if (SUBDOMAIN!=''){
				$domain="http://".SUBDOMAIN.".".$sPrimaryHost.'/';
			}else{
				$domain=DIR_WEB_ROOT;
			}
			
			$this->Viewer_Assign('link_zayavki', $domain."turnir/".$oTournament->getUrl()."/_uchastniki/zayavki/");
			
			$this->Viewer_AddBlock('right','tournamentdescription',array('plugin'=>'vs', 'oTournament'=>$oTournament),999);	
			$this->Viewer_AddBlock('right','tournamentsheduleloader',array('plugin'=>'vs', 'oTournament'=>$oTournament),203);
			$this->Viewer_AddBlock('right','tournamentteamtable',array('plugin'=>'vs', 'oTournament'=>$oTournament),202);

		}
		*/
		
	}
	public function SpisokIgr(){
	
		$aGames= $this->PluginVs_Stat_GetGameItemsByFilter(array(
			'on_front_page' => '1', 
			'#order' =>array('game_id'=>'desc'),
			'#limit' =>array('0','10')));
			
		$this->Viewer_Assign('aGames',$aGames);					
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'spisok_igr.tpl');
	}
	public function TurnirMenu(){
		$this->oUserCurrent=$this->User_GetUserCurrent();
		if($this->User_IsAuthorization()){
			
			if (false === ($aTournaments = $this->Cache_Get("my_turnirs_".$this->oUserCurrent->GetUserId()))) {
				$sql="SELECT t.tournament_id
				FROM tis_stat_teamsintournament tt, tis_stat_tournament t
				WHERE tt.player_id =  '".$this->oUserCurrent->GetUserId()."'
					AND t.zavershen =  '0'
					AND t.tournament_id = tt.tournament_id
				union
				SELECT t.tournament_id
				FROM tis_stat_playertournament pt, tis_stat_tournament t
				WHERE pt.user_id =  '".$this->oUserCurrent->GetUserId()."'
					AND pt.team_id <> 0
					AND t.zavershen =  '0'
					AND t.tournament_id = pt.tournament_id
				union
				SELECT t.tournament_id
				FROM tis_stat_tournamentadmin ta, tis_stat_tournament t
				WHERE ta.user_id =  '".$this->oUserCurrent->GetUserId()."'
					AND t.zavershen =  '0'
					AND t.tournament_id = ta.tournament_id";
				$aTournaments=Engine::GetInstance()->PluginVs_Stat_GetAll($sql);
				$this->Cache_Set($aTournaments, "my_turnirs_".$this->oUserCurrent->GetUserId(), array("PluginVs_ModuleStat_EntityPlayertournament_save","PluginVs_ModuleStat_EntityTeamsintournament_save"), 60*60*6);
			}	
			$tournament=array();
			if($aTournaments){
				foreach($aTournaments as $oTournament){
					$tournament[]=$oTournament['tournament_id'];
				}
				$mytournaments=1;
				if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					'tournament_id in' => $tournament,
					'zavershen' => '0',
					'#with'         => array('blog'),
					'#order' =>array('datestart'=>'asc'),
					'#limit' =>array('0','10')
				))
					)
				{  	
					$this->Viewer_Assign('Tournaments',$Tournaments);
					$this->Viewer_Assign('li_elements',count($Tournaments)); 
					$this->Viewer_Assign('sTournaments',$sTextResult);
					$this->Viewer_Assign('mytournaments',$mytournaments); 
					return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'turnir_menu.tpl');
				}				
			}
		}
	}
	
	public function SpisokTurnirov(){
		$this->oUserCurrent=$this->User_GetUserCurrent();
		if($this->User_IsAuthorization()){
			
			if (false === ($aTournaments = $this->Cache_Get("my_turnirs_".$this->oUserCurrent->GetUserId()))) {
				$sql="SELECT t.tournament_id
				FROM tis_stat_teamsintournament tt, tis_stat_tournament t
				WHERE tt.player_id =  '".$this->oUserCurrent->GetUserId()."'
					AND t.zavershen =  '0'
					AND t.tournament_id = tt.tournament_id
				union
				SELECT t.tournament_id
				FROM tis_stat_playertournament pt, tis_stat_tournament t
				WHERE pt.user_id =  '".$this->oUserCurrent->GetUserId()."'
					AND pt.team_id <> 0
					AND t.zavershen =  '0'
					AND t.tournament_id = pt.tournament_id
				union
				SELECT t.tournament_id
				FROM tis_stat_tournamentadmin ta, tis_stat_tournament t
				WHERE ta.user_id =  '".$this->oUserCurrent->GetUserId()."'
					AND t.zavershen =  '0'
					AND t.tournament_id = ta.tournament_id";
				$aTournaments=Engine::GetInstance()->PluginVs_Stat_GetAll($sql);
				$this->Cache_Set($aTournaments, "my_turnirs_".$this->oUserCurrent->GetUserId(), array("PluginVs_ModuleStat_EntityPlayertournament_save","PluginVs_ModuleStat_EntityTeamsintournament_save"), 60*60*6);
			}	
			$tournament=array();
			if($aTournaments){
				foreach($aTournaments as $oTournament){
					$tournament[]=$oTournament['tournament_id'];
				}
				$mytournaments=1;
				if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					'tournament_id in' => $tournament,
					'zavershen' => '0',
					'#with'         => array('blog'),
					'#order' =>array('datestart'=>'asc'),
					'#limit' =>array('0','10')
				))
					)
				{  	
					$this->Viewer_Assign('Tournaments',$Tournaments);
					$this->Viewer_Assign('li_elements',count($Tournaments)); 
					$this->Viewer_Assign('sTournaments',$sTextResult);
					$this->Viewer_Assign('mytournaments',$mytournaments); 
					return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'spisok_turnirov.tpl');
				}				
			}
		}
	}
	public function SecondMenu(){
	 
		//$oViewer=$this->Viewer_GetLocalViewer();
		$mytournaments=0;
		$this->oUserCurrent=$this->User_GetUserCurrent();
		if($this->User_IsAuthorization()){
			$sql="select tournament_id from tis_stat_teamsintournament where player_id='".$this->oUserCurrent->GetUserId()."'";
			$aTournaments=$this->PluginVs_Stat_GetAll($sql);
			$tournament=array();
			if($aTournaments){
				foreach($aTournaments as $oTournament){
					$tournament[]=$oTournament['tournament_id'];
				}
				$mytournaments=1;
				if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array( 
					'tournament_id in' => $tournament,
					'zavershen' => '0',
					'#with'         => array('gametype','blog','game'),
					'#order' =>array('datestart'=>'asc'),
					'#limit' =>array('0','10')
				))
					)
				{ 
					$this->Viewer_Assign('Tournaments',$Tournaments); 
					$this->Viewer_Assign('sTournaments',$sTextResult);
					$this->Viewer_Assign('mytournaments',$mytournaments);
					return $this->Viewer_Fetch('widget.turnirs_my.tpl');
				}
				
			}else{
				if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
					'datestart >' => date("Y-m-d"),	
					'#with'         => array('gametype','blog','game'),
					'#order' =>array('datestart'=>'asc'),
					'#limit' =>array('0','10')
				))
					)
				{
				 
					$this->Viewer_Assign('Tournaments',$Tournaments); 
					$this->Viewer_Assign('sTournaments',$sTextResult);
					$this->Viewer_Assign('mytournaments',$mytournaments);
					return $this->Viewer_Fetch('widget.turnirs_future.tpl');
				}
			}		
		}else{
			if( $Tournaments = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(
						'datestart >' => date("Y-m-d"),	
						'#with'         => array('gametype','blog','game'),
						'#order' =>array('datestart'=>'asc'),
						'#limit' =>array('0','10')
					))
				)
			{
			 	
				$this->Viewer_Assign('Tournaments',$Tournaments);
				//$sTextResult=$oViewer->Fetch("block.turnirs_future.tpl");
				$this->Viewer_Assign('sTournaments',$sTextResult);
				$this->Viewer_Assign('mytournaments',$mytournaments);
				 
				return $this->Viewer_Fetch('widget.turnirs_future.tpl');
			}	
		}
	
	}
	public function ProfileTournamentInfo($aVars) { 
			$sql="SELECT DISTINCT sp.psnid as psnid,
				sp.rating as rating,
				g.name game,
				upper(p.brief) as platform, 
				t.game_id AS game_id,
				t.tournament_id as tournament_id,
				t.name as tournament,
				b.platform as bplatform, 
				b.game as bgame, 
				b.gametype as bgametype, 
				b.blog_url as blog_url
				
				FROM `tis_stat_playertournament` sp, `tis_stat_teamsintournament` tt, `tis_stat_tournament` t, `tis_stat_game` g, `tis_stat_platform` p, `tis_blog` b
				WHERE sp.tournament_id = t.tournament_id
					AND sp.tournament_id = tt.tournament_id
					AND sp.user_id=tt.player_id
					AND t.game_id = g.game_id
					AND g.platform_id = p.platform_id
				and t.tournament_id=b.tournament_id
				and sp.user_id='".$aVars['oUserProfile']->getId()."'
				order by p.platform_id, g.game_id, t.tournament_id";
			$aGameTournament=$this->PluginVs_Stat_GetAll($sql);
			$this->Viewer_Assign('aGameTournament', $aGameTournament);
            return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'profile_tournament_info.tpl');
			
        }
	public function ProfileMedalsInfo($aVars) {
	

			$aMedals = $this->PluginVs_Stat_GetMedalsItemsByFilter(array(
			'user_id' => $aVars['oUserProfile']->getId(),
			 '#with'         => array('tournament', 'game')				
			));	
			$this->Viewer_Assign('aMedals', $aMedals);
			
			
            return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'profile_medals_info.tpl');
			
        }	
		
	public function SiteSettings($aVars) {
		$this->oUserCurrent=$this->User_GetUserCurrent();

		$aTournament = $this->PluginVs_Stat_GetTournamentItemsByFilter(array(  
					'zavershen' => '0', 
					'#order' =>array('game_id'=>'asc','gametype_id'=>'asc'), 
				));
		$this->Viewer_Assign('aTournament', $aTournament);
		$this->Viewer_Assign('oUserCurrent', $this->oUserCurrent);
		
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'site_settings.tpl');
		
        }	
		
	public function BeforeTopic($aVars) {
		 
			$oTopic = $aVars['topic'];
			//$oBlog = $oTopic->getBlog();
			if($oTopic->getTournamentId()>0){
			
				$this->oUserCurrent=$this->User_GetUserCurrent();
				$admin='no';
				if ($this->User_IsAuthorization()) {
					$aAdmin = $this->PluginVs_Stat_GetTournamentadminItemsByFilter(array(
						'tournament_id' => $oTopic->getTournamentId(),
						'user_id' => $this->oUserCurrent->getUserId(),
						'#page' => 'count',
						'expire >='   => date("Y-m-d")
					));
					if($aAdmin['count']>0)$admin='yes';
				}
				$this->Viewer_Assign('admin',$admin);
				$sql="select distinct 1 from tis_stat_playoff where tournament_id=".$oTopic->getTournamentId();
				if($this->PluginVs_Stat_GetAll($sql))$this->Viewer_Assign('po',1);

		$domain='';
		$sPrimaryHost=str_replace('http://','',DIR_WEB_ROOT);
		if (SUBDOMAIN!=''){
			$domain="http://".SUBDOMAIN.".".$sPrimaryHost.'/';
		}else{
			$domain=DIR_WEB_ROOT;
		}

		
			$oTournament = $this->PluginVs_Stat_GetTournamentByTournamentId ($oTopic->getTournamentId());
			
		$admin='no';
		if ($this->User_IsAuthorization()) {
            $aAdmin = Engine::GetInstance()->PluginVs_Stat_GetTournamentadminItemsByFilter(array(
				'tournament_id' => $oTournament->getTournamentId(),
				'user_id' => $this->oUserCurrent->GetUserId(),
				'#page' => 'count',
				'expire >='   => date("Y-m-d")
			));
			if($aAdmin['count']>0)$admin='yes';
			if($this->oUserCurrent->isAdministrator())$admin='yes';
        }
		$this->Viewer_Assign('admin',$admin);
		
			$this->Viewer_Assign('link', $domain."turnir/".$oTournament->getUrl()."/");
			$this->Viewer_Assign('oTournament', $oTournament);			
			$this->Viewer_Assign('link_uchastniki', $domain."turnir/".$oTournament->getUrl()."/_uchastniki/");
			$this->Viewer_Assign('link_zayavki', $domain."turnir/".$oTournament->getUrl()."/_uchastniki/zayavki/");
			$this->Viewer_Assign('link_stats', $domain."turnir/".$oTournament->getUrl()."/_stats/");
			$this->Viewer_Assign('link_player_stats', $domain."turnir/".$oTournament->getUrl()."/_player_stats/");
			$this->Viewer_Assign('link_raspisanie', $domain."turnir/".$oTournament->getUrl()."/_raspisanie/");
			$this->Viewer_Assign('link_sobytiya', $domain."turnir/".$oTournament->getUrl()."/_sobytiya/");
			$this->Viewer_Assign('link_reglament', $domain."turnir/".$oTournament->getUrl()."/_reglament/");
			$this->Viewer_Assign('link_au', $domain."turnir/".$oTournament->getUrl()."/_au/");
			$this->Viewer_Assign('link_po', $domain."turnir/".$oTournament->getUrl()."/_po/");
			$this->Viewer_Assign('link_match', $domain."turnir/".$oTournament->getUrl()."/_match/");
			
				
				
				return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'actions/ActionVs/tournament_menu.tpl');
			} 
        }	
	
}
?>