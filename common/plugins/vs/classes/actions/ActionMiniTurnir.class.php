<?php
/*
 * Пример нового экшна. Задаем новые страницы (не забудьте сконфигурировать роутинг в config.php плагина)
 *
 */

class PluginVs_ActionMiniTurnir extends ActionPlugin {
    private $sPlugin = 'adminvs';
	/**
	 * Инизиализация экшена
	 *
	 */
	public function Init() {
        $this->SetDefaultEvent('index'); // ПРи ображении к domain.com/somepage будет вызываться EventIndex()
		$this->oUserCurrent = $this->User_GetUserCurrent();
		if (!$this->User_IsAuthorization() ) {
            return $this->EventDenied();
        }
	}

	/**
	 * Регистрируем евенты, по сути определяем УРЛы вида /somepage/.../
	 *
	 */
	protected function RegisterEvent() { 
		$what=$this->CheckLevel();
// echo $what;
	
		$this->AddEvent('index','EventIndex');  
		if($what=='gametype'){
			$this->AddEventPreg('/^[\w\-\_]+$/i','EventTurnir');
		}
		if($what=='game'){
			$this->AddEventPreg('/^[\w\-\_]+$/i','EventTurnirs');
		}
	}

	protected function CheckLevel() {
	
	
		/*if(Router::GetAction()!=''){
			$what=Router::GetActionEvent();	
			if(substr($what, 0, 1)=='_' || substr($what, 0, 4)=='page' || substr($what, 0, 4)==''){
				return 'platform';
			}
		}*/
		if(Router::GetActionEvent()!=''){
			$what=Router::GetParam(0);	
			if(substr($what, 0, 1)=='_' || substr($what, 0, 4)=='page' || substr($what, 0, 4)==''){
				return 'game';
			}
		}
		if(Router::GetParam(0)!=''){
			$what=Router::GetParam(1);	
			if(substr($what, 0, 1)=='_' || substr($what, 0, 4)=='page' || substr($what, 0, 4)==''){
				return 'gametype';
			}
		}
		if(Router::GetParam(1)!=''){
			$what=Router::GetParam(2);	
			if(substr($what, 0, 1)=='_' || substr($what, 0, 4)=='page' || substr($what, 0, 4)==''){
				return 'tournament';
			}
		}
	}
	
	
    protected function EventIndex() {
	


		$first="helloworld";
		
	}
	
	protected function EventTurnirs() {
	
	}
	   protected function EventTurnir() {
	
//echo Router::GetActionEvent();


				//$this->Viewer_AddHtmlTitle($oBlog->getTitle());	
				$this->Viewer_AddHtmlTitle('Матчи на деньги');
				
				$oGameType= Engine::GetInstance()->PluginVs_Stat_GetGametypeByBrief($this->GetParam(0));
				$oGame= Engine::GetInstance()->PluginVs_Stat_GetGameByBrief(Router::GetActionEvent());
				$oPlatform= Engine::GetInstance()->PluginVs_Stat_GetPlatformByPlatformId($oGame->getPlatformId());
 
				
				if ($this->User_IsAuthorization()) {
					
					 
					if($oTovarki = Engine::GetInstance()->PluginVs_Stat_GetTovarkiByFilter(array(
					'game_id' => $oGame->getGameId(),
					'gametype_id' => $oGameType->getGametypeId(),
					'user_id' => $this->oUserCurrent->GetUserId()		
					))
					){
						$this->Viewer_Assign('oTovarki',$oTovarki);					
					}
					 
					$sql="select distinct gt.brief as brief, gt.name as name from `tis_stat_miniturnir` mt, `tis_stat_gametype` gt where mt.game_id='".$oGame->getGameId()."' and mt.gametype_id=gt.gametype_id and open=1 order by brief";						 
					$aGametype=Engine::GetInstance()->PluginVs_Stat_GetAll($sql);
					$this->Viewer_Assign('aGametype',$aGametype);
					
					$sql="select distinct stavka from `tis_stat_miniturnir` where game_id='".$oGame->getGameId()."' and gametype_id='".$oGameType->getGametypeId()."' and open=1 order by stavka";						 
					$aStavki=Engine::GetInstance()->PluginVs_Stat_GetAll($sql);
					$this->Viewer_Assign('aStavki',$aStavki);
					
					$sql="select distinct min(stavka) as stavka from `tis_stat_miniturnir` where game_id='".$oGame->getGameId()."' and gametype_id='".$oGameType->getGametypeId()."' and open=1 order by stavka";						 
					$aStavka=Engine::GetInstance()->PluginVs_Stat_GetAll($sql);
					$this->Viewer_Assign('aStavka',$aStavka[0]['stavka']);
					/*
					if($aMiniTurnirs = Engine::GetInstance()->PluginVs_Stat_GetMiniturnirItemsByFilter(array( 
						'gametype_id' => $oGameType->getGametypeId(),
						'game_id' => $oGame->getGameId(),
						'open' => '1',
						'stavka' => $aStavka[0]['stavka']
					))
					){
						$this->Viewer_Assign('aMiniTurnirs',$aMiniTurnirs);					
					} 
					*/
					
					if(Router::GetAction()!='pc')$Identifier=Engine::GetInstance()->User_getUserFieldValueByName($this->oUserCurrent->GetUserId(), $oPlatform->getBrief());
					if(Router::GetAction()=='pc')$Identifier=Engine::GetInstance()->User_getUserFieldValueByName($this->oUserCurrent->GetUserId(), 'steamid');
					$this->Viewer_Assign('Identifier',$Identifier); 
					$this->Viewer_Assign('oGame',$oGame);
					$this->Viewer_Assign('oGameType',$oGameType);
					
					
					$this->Viewer_Assign('gametype_id',$oGameType->getGametypeId());
					$this->Viewer_Assign('game_id',$oGame->getGameId());
					
					$this->Viewer_Assign('authorise',1);
					$this->Viewer_Assign('whats',$this->GetParam(0));
					 
				}else{
					$this->EventDenied();
				}
				
				//$this->SetTemplateAction('gametype_tovarischeskie');
				
				
 
		$this->SetTemplateAction('turnir');
	}
///-------Платформы--------//////	 
	
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
        $this->Viewer_AddMenu('adminvs', $this->GetTemplateFile('/menu.adminvs.tpl'));
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
		
     }
	    
	protected function EventDenied() {
        $this->Message_AddErrorSingle($this->Lang_Get('adm_denied_text'), $this->Lang_Get('adm_denied_title'));
        return Router::Action('error');
    }
}
?>
