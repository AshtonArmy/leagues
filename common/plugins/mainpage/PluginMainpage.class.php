<?php
/*---------------------------------------------------------------------------
 * @Project: Alto CMS
 * @Project URI: http://altocms.com
 * @Description: Advanced Community Engine
 * @Version: 0.9a
 * @Copyright: Alto CMS Team
 * @License: GNU GPL v2 & MIT
 *----------------------------------------------------------------------------
 */

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
    die('Hacking attempt!');
}

class PluginMainpage extends Plugin {

    protected $aInherits = array(
        'action' => array(
            'ActionAdmin'
        ),
    );


    /**
     * Активация плагина
     */
    public function Activate() {
		 
        return true;
    }

    /**
     * Инициализация плагина
     */
    public function Init() {
		//$this->Viewer_AppendStyle(Plugin::GetTemplateWebPath(__CLASS__).'css/style.css');

    }
}

// EOF