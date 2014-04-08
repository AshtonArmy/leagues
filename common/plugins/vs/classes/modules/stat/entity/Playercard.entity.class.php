<?php
class PluginVs_ModuleStat_EntityPlayercard extends EntityORM {
	protected $aRelations=array(            
		'platform' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityPlatform', 'platform_id'),
		'sport' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntitySport', 'sport_id'),
        'user' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'user_id')
	);
	
	public function getFotoUrl() { 
		return $this->getFoto()? $this->getFoto() : 'http://virtualsports.ru/templates/skin/virtsports/images/Arshavin.png';
    }
	
	public function getFullFio() { 
		return $this->getFamily().' '.$this->getName();
    }

}
?>