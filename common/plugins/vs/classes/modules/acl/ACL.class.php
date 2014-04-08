<?php
/*-------------------------------------------------------
*
*   LiveStreet Engine Social Networking
*   Copyright © 2008 Mzhelskiy Maxim
*
*--------------------------------------------------------
*
*   Official site: www.livestreet.ru
*   Contact e-mail: rus.engine@gmail.com
*
*   GNU General Public License, version 2:
*   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
---------------------------------------------------------
*/

/**
 * Добавляем в функционал в модуль "Topic"
 *
 */
class PluginVs_ModuleACL extends PluginVs_Inherit_ModuleACL {

	public function CanDeleteCommentByBlog($oUser, $oComment) {
		
		if ( $oTopic=$oComment->getTarget() ) {
			$oTopic=$this->Topic_GetTopicById($oTopic->getId());
			if($oTopic)$oBlog = $oTopic->getBlog();
		} 
		if ($oUser  && ( $oUser->isAdministrator()		
						 || ($oBlog  && ($oBlog->getUserIsAdministrator() 
											|| $oBlog->getUserIsModerator() 
											|| $oBlog->getOwnerId()==$oUser->getId()
										)
							)
						)
		) { 
			return true;
		}
		return false;
 
	}

}