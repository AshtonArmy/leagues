<?php
class PluginVs_ModuleStat_EntityBuilder extends EntityORM {

public function getAtrArray() {
		$arr = json_encode($this->getAttributes()); 
		var_dump($arr );
		return implode(",", $arr);
    }


}

?>