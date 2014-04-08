<?php
/*
 * Пример нового экшна. Задаем новые страницы (не забудьте сконфигурировать роутинг в config.php плагина)
 *
 */

class PluginVs_ActionGame extends ActionPlugin {
 
	
	/**
	 * Инизиализация экшена
	 *
	 */
	public function Init() {
        $this->SetDefaultEvent('index'); // ПРи ображении к domain.com/somepage будет вызываться EventIndex()
		$this->oUserCurrent = $this->User_GetUserCurrent();
		
	}
	
	protected function RegisterEvent() { 
		$this->AddEventPreg('/^[\w\-\_]+$/i','EventGame');
		//$this->AddEvent('index','EventGame');
		/*$this->AddEvent('create','EventCreate'); 
		$this->AddEvent('_create','EventCreate');  		

		$this->AddEvent('_blog','EventShowBlog'); 
		$this->AddEvent('_video','EventShowVideo'); 
 
		$this->AddEventPreg('/^[\w\-\_]+$/i','EventGame');
		*/
	}
	
	protected function EventGame() {
		$this->SetTemplateAction('index');
		$iPage=1;
			if(Router::GetParam(0)){
				if(substr(Router::GetParam(0), 0, 4)=='page'){
					$iPage=substr(Router::GetParam(0), 4, strlen(Router::GetParam(0))-4);
				}
			}
		$aResult=Engine::GetInstance()->PluginVs_Stat_GetTopicsByGame($iPage,Config::Get('module.topic.per_page'),Router::GetActionEvent());
		$aTopics=$aResult['collection']; 
		/**
		 * Формируем постраничность
		 */
		$aPaging=$this->Viewer_MakePaging($aResult['count'],$iPage,Config::Get('module.topic.per_page'),4,Config::Get('path.root.web')."/".Router::GetAction()."/".Router::GetActionEvent());
		/**
		 * Загружаем переменные в шаблон
		 */
		$this->Viewer_Assign('aTopics',$aTopics);
		$this->Viewer_Assign('aPaging',$aPaging);
	}
	
}