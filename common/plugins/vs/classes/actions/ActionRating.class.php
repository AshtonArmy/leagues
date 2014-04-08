<?php
/*
 * Пример нового экшна. Задаем новые страницы (не забудьте сконфигурировать роутинг в config.php плагина)
 *
 */
class PluginVs_ActionRating extends ActionPlugin {
    private $sPlugin = 'vs';
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
		//$this->AddEvent('index','EventIndex'); 
		$this->AddEventPreg('/^[\w\-\_]+$/i','EventIndex');
	}
	protected function EventIndex() {
		$first="helloworld"; 	

//echo Router::GetParam(2);
if(Router::GetParam(2)=="_rating"){
			
				//$this->Viewer_AddHtmlTitle($oBlog->getTitle());	
				$this->Viewer_AddHtmlTitle('Рейтинг');
				
				$oGameType= Engine::GetInstance()->PluginVs_Stat_GetGametypeByBrief($this->GetParam(1));
				$oGame= Engine::GetInstance()->PluginVs_Stat_GetGameByBrief($this->GetParam(0));
				
				$aRating = Engine::GetInstance()->PluginVs_Stat_GetRatingItemsByFilter(array(
					'game_id' => $oGame->getGameId(),
					'gametype_id' => $oGameType->getGametypeId(),
					'user_id !='=> '0',
					'#with'         => array('user'),
					'#order' =>array('rating'=>'desc')
					));
				$this->Viewer_Assign('aRating',$aRating);	
				
				$this->SetTemplate(Plugin::GetTemplatePath(__CLASS__).'actions/ActionVs/gametype_rating.tpl');
				
			}elseif(Router::GetParam(2)=="_ofrating"){
			
				//$this->Viewer_AddHtmlTitle($oBlog->getTitle());	
				$this->Viewer_AddHtmlTitle('Официальный рейтинг');
				$oGameType= Engine::GetInstance()->PluginVs_Stat_GetGametypeByBrief($this->GetParam(1));
				$oGame= Engine::GetInstance()->PluginVs_Stat_GetGameByBrief($this->GetParam(0));
				
				$aRating = Engine::GetInstance()->PluginVs_Stat_GetOfratingItemsByFilter(array(
					'game_id' => $oGame->getGameId(),
					'gametype_id' => $oGameType->getGametypeId(),
					'#with'         => array('user'),
					'#order' =>array('ovrskillpoints'=>'desc')
					));
				$this->Viewer_Assign('aRating',$aRating);	
				//$this->SetTemplateAction('gametype_ofrating');
				$this->SetTemplate(Plugin::GetTemplatePath(__CLASS__).'actions/ActionVs/gametype_ofrating.tpl');
			}
//$this->SetTemplate(Plugin::GetTemplatePath(__CLASS__).'actions/ActionVs/gametype_rating.tpl');
				
	}
}