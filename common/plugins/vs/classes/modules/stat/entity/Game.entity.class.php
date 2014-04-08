<?php
class PluginVs_ModuleStat_EntityGame extends EntityORM {
	protected $aRelations=array(            
        'platform' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityPlatform', 'platform_id'),
		'sport' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntitySport', 'sport_id')
);

}

?>