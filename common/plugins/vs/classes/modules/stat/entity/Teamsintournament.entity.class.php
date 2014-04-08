<?php
class PluginVs_ModuleStat_EntityTeamsintournament extends EntityORM {
protected $aRelations=array(            
        'user1' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'player_id'),
        'team' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTeam', 'team_id'),
		'tournament' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTournament', 'tournament_id')
);

}

?>