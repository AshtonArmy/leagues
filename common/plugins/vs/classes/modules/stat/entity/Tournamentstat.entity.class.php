<?php
class PluginVs_ModuleStat_EntityTournamentstat extends EntityORM {
protected $aRelations=array(            
        'team' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTeam', 'team_id'),
		'round' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityRound', 'round_id'),
		'group' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGroup', 'group_id'),
		'parentgroup' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGroup', 'parentgroup_id'),
        'tournament' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTournament', 'tournament_id')
);

}

?>