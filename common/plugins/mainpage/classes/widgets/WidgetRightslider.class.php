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
 * Регистрация хука
 *
 */
class PluginMainpage_WidgetRightslider extends Widget {
    /**
     * Запуск обработки
     */
    public function Exec() {  
		
		$aResult = $this->Blog_GetLeagues();
		
		$this->Viewer_Assign('aLeagueBlogs',$aResult);
    }
}
// EOF