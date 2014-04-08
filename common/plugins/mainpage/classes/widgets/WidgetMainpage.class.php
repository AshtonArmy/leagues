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
class PluginMainpage_WidgetMainpage extends Widget {
    /**
     * Запуск обработки
     */
    public function Exec() {
        /**
         * Получаем категории
         */
        
		$this->Viewer_Assign('aForums',  $this->Blog_GetMenuBlogs() );
		/*
		if ($this->User_GetUserCurrent() 
				and ($this->User_GetUserCurrent()->getLogin() == 'Klaus' 
						|| $this->User_GetUserCurrent()->getLogin() =='2ManyFaces'
					) ){
			$this->Viewer_Assign('aForums',  $this->Blog_GetMenuBlogs() );
		}else{
			$aCategories=$this->PluginCategories_Categories_GetItemsByFilter(array('#order'=>array('category_sort'=>'asc')),'PluginCategories_ModuleCategories_EntityCategory');
			$this->Viewer_Assign("aCategories",$aCategories);
			
		
		}*/
    }
}
// EOF