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
 * @since 0.9.2
 */

class PluginMainpage_ActionMainpage extends ActionPlugin {
    public function Init() {
        $this->SetDefaultEvent('index');
    }

    /**
     * Регистрация евентов
     */
    protected function RegisterEvent() {
        $this->AddEvent('index', 'EventIndex');
		//$this->AddEventPreg('/^[\w\-\_]+$/i','/^(page([1-9]\d{0,5}))?$/i',array('EventCategoryList','list'));
    }

    protected function EventIndex() {
		
        $this->SetTemplateAction('index');

		//$aCategories=$this->PluginCategories_Categories_GetItemsByFilter(array(),'PluginCategories_ModuleCategories_EntityCategory');
		//$this->Viewer_Assign("aCategories",$aCategories);
    }

	 

}

// EOF