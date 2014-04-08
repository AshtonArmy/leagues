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
class PluginVs_ModuleVote extends Module {
	/**
	 * Дополнительная обработка топиков
	 *
	 * @return unknown
	 */
	public function Init() {
		$this->oMapper = Engine::GetMapper(__CLASS__);
	}
	public function GetUserVotes($FromWhere, $id) {
		$data = $this->oMapper->GetUserVotes($FromWhere, $id);
		return $data;
	}


}
?>