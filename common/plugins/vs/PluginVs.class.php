<?php

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
	die('Hacking attemp!');
}

class PluginVs extends Plugin {


    // Объявление делегирований (нужны для того, чтобы назначить свои экшны и шаблоны)
	public $aDelegates = array(
			'template' => array('menu.tournament.content.tpl'=>'_menu.tournament.content.tpl',
								'menu.team.content.tpl'=>'_menu.team.content.tpl',
								'menu.league.content.tpl'=>'_menu.league.content.tpl'),		 
            /*
             * 'action' => array('ActionIndex'=>'_ActionSomepage'),
             * Замена экшна ActionIndex на ActionSomepage из папки плагина
             *
             * 'template' => array('index.tpl'=>'_my_plugin_index.tpl'),
             * Замена index.tpl из корня скина файлом /plugins/Vs/templates/skin/default/my_plugin_index.tpl
             *
             * 'template'=>array('actions/ActionIndex/index.tpl'=>'_actions/ActionTest/index.tpl'), 
             * Замена index.tpl из скина из папки actions/ActionIndex/ файлом /plugins/Vs/templates/skin/default/actions/ActionTest/index.tpl
             */


    );

	// Объявление переопределений (модули, мапперы и сущности)
	protected $aInherits=array(
	  'action' => array('ActionVs','ActionAjax','ActionSettings','ActionProfile','ActionBlog','ActionAdmin'),
	   'module'  =>array('ModuleBlog','ModuleText','ModuleTopic','ModuleACL','ModuleUser','ModuleComment'),       
       'entity'  =>array('ModuleBlog_EntityBlog','ModuleTopic_EntityTopic','ModuleTalk_EntityTalk','ModuleComment_EntityComment'), 
	   'mapper'  =>array('ModuleBlog_MapperBlog','ModuleTopic_MapperTopic','ModuleComment_MapperComment'), 
       /*
	    * Переопределение модулей (функционал):
	    *
	    * 'module'  =>array('ModuleTopic'=>'_ModuleTopic'),
	    *
	    * К классу ModuleTopic (/classes/modules/Topic.class.php) добавляются методы из
	    * PluginVs_ModuleTopic (/plugins/Vs/classes/modules/Topic.class.php) - новые или замена существующих
	    *
	    *
	    * Переопределение мапперов (запись/чтение объектов в/из БД):
	    *
	    * 'mapper'  =>array('ModuleTopic_MapperTopic' => '_ModuleTopic_MapperTopic'),
	    *
	    * К классу ModuleTopic_MapperTopic (/classes/modules/mapper/Topic.mapper.class.php) добавляются методы из
	    * PluginVs_ModuleTopic_EntityTopic (/plugins/Vs/classes/modules/mapper/Topic.mapper.class.php) - новые или замена существующих
	    *
	    *
	    * Переопределение сущностей (интерфейс между объектом и записью/записями в БД):
	    *
	    * 'entity'  =>array('ModuleTopic_EntityTopic' => '_ModuleTopic_EntityTopic'),
	    *
	    * К классу ModuleTopic_EntityTopic (/classes/modules/entity/Topic.entity.class.php) добавляются методы из
	    * PluginVs_ModuleTopic_EntityTopic (/plugins/Vs/classes/modules/entity/Topic.entity.class.php) - новые или замена существующих
	    *
	    */
		

    );

	// Активация плагина
	public function Activate() { 
	
	/*	
        if (!$this->isTableExists('prefix_tablename')) { 
			$this->ExportSQL(dirname(__FILE__).'/install.sql'); // Если нам надо изменить БД, делаем это здесь.
		}
		 */
		 //$this->ExportSQL(dirname(__FILE__).'/install.sql');
		return true;
	}
    
	// Деактивация плагина
	public function Deactivate(){
        
		//$this->ExportSQL(dirname(__FILE__).'/deinstall.sql'); // Выполнить деактивационный sql, если надо.
	return true;	 
    }


	// Инициализация плагина
	public function Init() {
		
		//$this->Viewer_AppendStyle(Plugin::GetTemplatePath('PluginVs')."/css/style.css"); // Добавление своего CSS
		//$this->Viewer_AppendScript(Plugin::GetTemplatePath('PluginVs')."/js/javascript.js"); // Добавление своего JS

		// $this->Viewer_AddMenu('blog',Plugin::GetTemplatePath(__CLASS__).'/menu.blog.tpl'); // например, задаем свой вид меню
		//$first="helloworld";
		//$this->Viewer_Assign('first', $first);
		$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/jquery-ui.js');
		$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/au.js');
		$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/stream.js');
		$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/my.js');
		$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/comment.js');
		$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/raspisanie.js');
	//	$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/jquery.treeview.js');
		
	//	$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/excanvas.js');
	//	$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/spinners.min.js');
		$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/tipped.js');
		//$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/jquery.carousellite.js');
	//	$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/jquery.ui.accordion.js');
		
		
		$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/player-photo.js');
		$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/ui.multiselect.js');
		$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/ui.selectmenu.js');
		$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/jquery.tmpl.1.1.1.js');
		$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/jquery.tablesorter.min.js');
	//	$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/jquery-ui-timepicker-addon.js');
		
		$this->Viewer_AppendStyle(Plugin::GetTemplateWebPath(__CLASS__).'css/tipped.css'); 
		$this->Viewer_AppendStyle(Plugin::GetTemplateWebPath(__CLASS__).'css/mod.css');
	//	$this->Viewer_AppendStyle(Plugin::GetTemplateWebPath(__CLASS__).'css/buttons.css');
	//	$this->Viewer_AppendStyle(Plugin::GetTemplateWebPath(__CLASS__).'css/block-games.css');

		$this->Viewer_Assign('sTPLvs', rtrim(Plugin::GetTemplatePath('vs'), '/'));
		
	}

    /**
	 * Проверяет наличие таблицы в БД - может использоваться в Activate() 
	 *
	 * @param unknown_type $sTableName
	 * @return unknown
	 */
	protected function isTableExists($sTableName) {
		$sTableName = str_replace('prefix_', Config::Get('db.table.prefix'), $sTableName);
		$sQuery="SHOW TABLES LIKE '{$sTableName}'";
		if ($aRows=$this->Database_GetConnect()->select($sQuery)) {
			return true;
		}
		return false;
	}
}
?>