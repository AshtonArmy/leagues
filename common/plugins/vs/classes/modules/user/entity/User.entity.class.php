<?php
class PluginVs_ModuleUser_EntityUser extends PluginVs_Inherit_ModuleUser_EntityUser {

 
	public function getChId() { 
        return $this->_aData['ch_id'];
    }
	public function setChId($data) {
        $this->_aData['ch_id']=$data;
    } 
 
 	public function getChPassword() { 
        return $this->_aData['ch_password'];
    }
	public function setChPassword($data) {
        $this->_aData['ch_password']=$data;
    } 
	
}

?>