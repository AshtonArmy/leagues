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

class PluginVs_ModuleTalk_EntityTalk extends PluginVs_Inherit_ModuleTalk_EntityTalk {

	public function getUserLast() {
		if ($oComment=$this->Comment_GetCommentsAdditionalData($this->getCommentIdLast())) {
			return $oComment[$this->getCommentIdLast()]->getUser();
		}
		 
		return $this->getUser();
	}
}