<?php
class PluginVs_ModuleStat_EntityMapsintournament extends EntityORM {
protected $aRelations=array(             
        'map' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityMap', 'map_id'),
		'tournament' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTournament', 'tournament_id')
);

}

?>