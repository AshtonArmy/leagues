<?php
/*
 * Пример нового экшна. Задаем новые страницы (не забудьте сконфигурировать роутинг в config.php плагина)
 *
 */

class PluginVs_ActionMainpage extends ActionPlugin {
 
	
	/**
	 * Инизиализация экшена
	 *
	 */
	public function Init() {
		$this->SetDefaultEvent('index'); // ПРи ображении к domain.com/somepage будет вызываться EventIndex()
		$this->oUserCurrent = $this->User_GetUserCurrent();
		
	}
	
	protected function RegisterEvent() { 
		$this->AddEvent('index','EventMainpage');
		//$this->AddEvent('index','EventGame');
		/*$this->AddEvent('create','EventCreate'); 
		$this->AddEvent('_create','EventCreate');  		

		$this->AddEvent('_blog','EventShowBlog'); 
		$this->AddEvent('_video','EventShowVideo'); 
 
		$this->AddEventPreg('/^[\w\-\_]+$/i','EventGame');
		*/
	}
	
	protected function EventMainpage() {
		$this->Viewer_AddBlock('matches','indexmatches',array('plugin'=>'vs'),202);
		
		//'matches' => array('indexmatches' => array('priority'=>202,'params'=>array('plugin'=>'vs'))),
	}
	
}