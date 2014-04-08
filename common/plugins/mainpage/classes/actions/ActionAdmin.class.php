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
 * @package plugin Categories
 * @since 0.9.5
 */

class PluginMainpage_ActionAdmin extends PluginMainpage_Inherits_ActionAdmin {
	protected function RegisterEvent() {
		parent::RegisterEvent();
	   
	}
	
    // Установка собственного обработчика главной страницы
    protected function _eventConfigLinks() {
        if (($sHomePage = $this->GetPost('homepage')) && ($sHomePage == 'mainpage_homepage')) {
            $aConfig = array(
                'router.config.action_default' => 'homepage',
                'router.config.homepage' => 'mainpage/index',
                'router.config.homepage_select' => 'mainpage_homepage',
            );
            Config::WriteCustomConfig($aConfig);
            Router::Location('admin/config/links');
            exit;
        }
        return parent::_eventConfigLinks();
    }
 
}

// EOF