<?php

class PluginVs_ModuleComment_MapperComment extends PluginVs_Inherit_ModuleComment_MapperComment {
	
	public function SetCommentNum(ModuleComment_EntityComment $oComment, $num) {
		$sql = "UPDATE " . Config::Get('db.table.comment')
			. " SET comment_num = ?d WHERE comment_id = ? ;";
		$bResult = $this->oDb->query($sql, $num, $oComment->getId());
		return false;
	}

public function GetCommentsTreePageByTargetId($sId, $sTargetType, &$iCount, $iPage, $iPerPage) {

        /**
         * Сначала получаем корни и определяем границы выборки веток
         */
		 
		/*
        $sql = "SELECT
					comment_left,
					comment_right 
				FROM 
					" . Config::Get('db.table.comment') . "
				WHERE 
					target_id = ?d 
					AND			
					target_type = ? 
					AND
					comment_pid IS NULL
				ORDER by comment_left desc
				LIMIT ?d , ?d ;";
        $aComments = array();
        if ($aRows = $this->oDb->selectPage($iCount, $sql, $sId, $sTargetType, ($iPage - 1) * $iPerPage, $iPerPage)) {
            $aCmt = array_pop($aRows);
            $iLeft = $aCmt['comment_left'];
            if ($aRows) {
                $aCmt = array_shift($aRows);
            }
            $iRight = $aCmt['comment_right'];
        } else {
            return array();
        }
		*/
        /**
         * Теперь получаем полный список комментов
         */
		/*
        $sql = "SELECT
					comment_id 
				FROM 
					" . Config::Get('db.table.comment') . "
				WHERE 
					target_id = ?d 
					AND			
					target_type = ? 
					AND
					comment_left >= ?d
					AND
					comment_right <= ?d
				ORDER by comment_left asc;	
					";
        $aComments = array();
        if ($aRows = $this->oDb->select($sql, $sId, $sTargetType, $iLeft, $iRight)) {
            foreach ($aRows as $aRow) {
                $aComments[] = $aRow['comment_id'];
            }
        }

        return $aComments;
	*/	
		 $sql = "SELECT
					count(comment_id) as c
				FROM 
					" . Config::Get('db.table.comment') . "
				WHERE 
					target_id = ?d 
					AND			
					target_type = ? 	 ;";

        if ($aRow = $this->oDb->selectRow($sql, $sId, $sTargetType)) {
            $iCount = $aRow['c'];
        }
		
		
		$sql = "SELECT
					comment_id 
				FROM 
					" . Config::Get('db.table.comment') . "
				WHERE 
					target_id = ?d 
					AND			
					target_type = ?  
				ORDER by comment_id asc
				LIMIT ?d , ?d;	
					";
        $aComments = array();
        if ($aRows = $this->oDb->select($sql, $sId, $sTargetType, ($iPage - 1) * $iPerPage, $iPerPage)) {
            foreach ($aRows as $aRow) {
                $aComments[] = $aRow['comment_id'];
            }
        }

        return $aComments;
    }
	
}