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
class PluginVs_ModuleComment extends PluginVs_Inherit_ModuleComment {

	public function SetCommentNum($oComment, $num) {
		$this->oMapper->SetCommentNum($oComment, $num);
		$this->Cache_Clean(
                Zend_Cache::CLEANING_MODE_MATCHING_TAG,
                array("comment_new", "comment_new_{$oComment->getTargetType()}",
                      "comment_new_user_{$oComment->getUserId()}_{$oComment->getTargetType()}",
                      "comment_new_{$oComment->getTargetType()}_{$oComment->getTargetId()}")
            );
		return false;	
	}
	/**
     * Получает дополнительные данные(объекты) для комментов по их ID
     *
     * @param array      $aCommentId    Список ID комментов
     * @param array|null $aAllowData    Список типов дополнительных данных, которые нужно получить для комментариев
     *
     * @return array
     */
    public function GetCommentsAdditionalData($aCommentId, $aAllowData = null) {
        if (is_null($aAllowData)) {
            $aAllowData = array('vote', 'target', 'favourite', 'user' => array());
        }
        func_array_simpleflip($aAllowData);
        if (!is_array($aCommentId)) {
            $aCommentId = array($aCommentId);
        }
        /**
         * Получаем комменты
         */
        $aComments = $this->GetCommentsByArrayId($aCommentId);
        /**
         * Формируем ID дополнительных данных, которые нужно получить
         */
        $aUserId = array();
        $aTargetId = array('topic' => array(), 'talk' => array());
        foreach ($aComments as $oComment) {
            if (isset($aAllowData['user'])) {
                $aUserId[] = $oComment->getUserId();
            }
            if (isset($aAllowData['target'])) {
                $aTargetId[$oComment->getTargetType()][] = $oComment->getTargetId();
            }
        }
        /**
         * Получаем дополнительные данные
         */
        $aUsers = (isset($aAllowData['user']) && is_array($aAllowData['user']))
            ? $this->User_GetUsersAdditionalData($aUserId, $aAllowData['user'])
            : $this->User_GetUsersAdditionalData($aUserId);
        /**
         * В зависимости от типа target_type достаем данные
         */
        $aTargets = array();
        //$aTargets['topic']=isset($aAllowData['target']) && is_array($aAllowData['target']) ? $this->Topic_GetTopicsAdditionalData($aTargetId['topic'],$aAllowData['target']) : $this->Topic_GetTopicsAdditionalData($aTargetId['topic']);
        $aTargets['topic'] = $this->Topic_GetTopicsAdditionalData(
            $aTargetId['topic'], array('blog' => array('owner' => array()), 'user' => array())
        );
	//klaus
		if(isset($aTargetId['match']))$aTargets['match']=$this->PluginVs_Stat_GetMatchesAdditionalData($aTargetId['match'],array('blog'=>array('owner'=>array())));
		
		
        $aVote = array();
        if (isset($aAllowData['vote']) && $this->oUserCurrent) {
            $aVote = $this->Vote_GetVoteByArray($aCommentId, 'comment', $this->oUserCurrent->getId());
        }
        if (isset($aAllowData['favourite']) && $this->oUserCurrent) {
            $aFavouriteComments = $this->Favourite_GetFavouritesByArray($aCommentId, 'comment', $this->oUserCurrent->getId());
        }
        /**
         * Добавляем данные к результату
         */
        foreach ($aComments as $oComment) {
            if (isset($aUsers[$oComment->getUserId()])) {
                $oComment->setUser($aUsers[$oComment->getUserId()]);
            } else {
                $oComment->setUser(null); // или $oComment->setUser(new ModuleUser_EntityUser());
            }
            if (isset($aTargets[$oComment->getTargetType()][$oComment->getTargetId()])) {
                $oComment->setTarget($aTargets[$oComment->getTargetType()][$oComment->getTargetId()]);
            } else {
                $oComment->setTarget(null);
            }
            if (isset($aVote[$oComment->getId()])) {
                $oComment->setVote($aVote[$oComment->getId()]);
            } else {
                $oComment->setVote(null);
            }
            if (isset($aFavouriteComments[$oComment->getId()])) {
                $oComment->setIsFavourite(true);
            } else {
                $oComment->setIsFavourite(false);
            }
        }
        return $aComments;
    }
	
}
?>