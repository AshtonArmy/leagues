<?php

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
	die('Hacking attemp!');
}

class PluginAdminvs extends Plugin {

    // Объявление делегирований (нужны для того, чтобы назначить свои экшны и шаблоны)
	public $aDelegates = array(
            /*
             * 'action' => array('ActionIndex'=>'_ActionSomepage'),
             * Замена экшна ActionIndex на ActionSomepage из папки плагина
             *
             * 'template' => array('index.tpl'=>'_my_plugin_index.tpl'),
             * Замена index.tpl из корня скина файлом /plugins/Adminvs/templates/skin/default/my_plugin_index.tpl
             *
             * 'template'=>array('actions/ActionIndex/index.tpl'=>'_actions/ActionTest/index.tpl'), 
             * Замена index.tpl из скина из папки actions/ActionIndex/ файлом /plugins/Adminvs/templates/skin/default/actions/ActionTest/index.tpl
             */


    );

	// Объявление переопределений (модули, мапперы и сущности)
	protected $aInherits=array(
	  'action' => array('ActionAdminvs')
       /*
	    * Переопределение модулей (функционал):
	    *
	    * 'module'  =>array('ModuleTopic'=>'_ModuleTopic'),
	    *
	    * К классу ModuleTopic (/classes/modules/Topic.class.php) добавляются методы из
	    * PluginAdminvs_ModuleTopic (/plugins/Adminvs/classes/modules/Topic.class.php) - новые или замена существующих
	    *
	    *
	    * Переопределение мапперов (запись/чтение объектов в/из БД):
	    *
	    * 'mapper'  =>array('ModuleTopic_MapperTopic' => '_ModuleTopic_MapperTopic'),
	    *
	    * К классу ModuleTopic_MapperTopic (/classes/modules/mapper/Topic.mapper.class.php) добавляются методы из
	    * PluginAdminvs_ModuleTopic_EntityTopic (/plugins/Adminvs/classes/modules/mapper/Topic.mapper.class.php) - новые или замена существующих
	    *
	    *
	    * Переопределение сущностей (интерфейс между объектом и записью/записями в БД):
	    *
	    * 'entity'  =>array('ModuleTopic_EntityTopic' => '_ModuleTopic_EntityTopic'),
	    *
	    * К классу ModuleTopic_EntityTopic (/classes/modules/entity/Topic.entity.class.php) добавляются методы из
	    * PluginAdminvs_ModuleTopic_EntityTopic (/plugins/Adminvs/classes/modules/entity/Topic.entity.class.php) - новые или замена существующих
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
		return true;
	}
    
	// Деактивация плагина
	public function Deactivate(){
        
		//$this->ExportSQL(dirname(__FILE__).'/deinstall.sql'); // Выполнить деактивационный sql, если надо.
	return true;	 
    }


	// Инициализация плагина
	public function Init() {
		
		//$this->Viewer_AppendStyle(Plugin::GetTemplatePath('PluginAdminvs')."/css/style.css"); // Добавление своего CSS
		//$this->Viewer_AppendScript(Plugin::GetTemplatePath('PluginAdminvs')."/js/javascript.js"); // Добавление своего JS

		// $this->Viewer_AddMenu('blog',Plugin::GetTemplatePath(__CLASS__).'/menu.blog.tpl'); // например, задаем свой вид меню
		//$first="helloworld";
		//$this->Viewer_Assign('first', $first);
		$this->Viewer_Assign('sTemplatePathPluginAdminVs', rtrim(Plugin::GetTemplatePath('adminvs'), '/'));
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