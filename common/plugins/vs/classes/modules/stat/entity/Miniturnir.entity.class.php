<?php
class PluginVs_ModuleStat_EntityMiniturnir extends EntityORM {
protected $aRelations=array(            
        'game' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGame', 'game_id'),	 
		'gametype' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGametype', 'gametype_id')
);
}
?>