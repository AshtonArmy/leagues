<?php

class PluginAdminvs_ModuleStat_MapperStat extends Mapper {


	public function GetAll($sql) {
        $sValue = null;

        //$sql = "SELECT adminset_key AS `key`, adminset_val AS `val` FROM ".Config::Get('db.table.adminset')." WHERE adminset_key LIKE ? ";
        $aRows = @$this->oDb->select($sql);
        if ($aRows) $sValue = $aRows;
      
        return $sValue;
    }
	public function CreateBlog($sql) {

		if ($iId=$this->oDb->query($sql)) {
			return $iId;
		}		
		return false;
    }
}

?>