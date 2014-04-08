<?php
class PluginVs_ModuleStat_EntityPlayoff extends EntityORM {
protected $aRelations=array(            
        'team' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTeam', 'team_id'),
		'team2' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTeam', 'team2_id'),
		'tournament' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTournament', 'tournament_id')
);

}

?>