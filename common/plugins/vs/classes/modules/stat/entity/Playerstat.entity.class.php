<?php
class PluginVs_ModuleStat_EntityPlayerstat extends EntityORM {
protected $aRelations=array(            
        'team' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTeam', 'team_id'),
		'user' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'user_id'),
		'round' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityRound', 'round_id'),
		'group' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGroup', 'group_id'),		
		'game' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGame', 'game_id'),
		'gametype' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGametype', 'gametype_id'),
		'parentgroup' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGroup', 'parentgroup_id'),
        'tournament' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTournament', 'tournament_id')
);

}

?>