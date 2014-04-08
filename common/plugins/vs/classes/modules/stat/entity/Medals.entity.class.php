<?php
class PluginVs_ModuleStat_EntityMedals extends EntityORM {
protected $aRelations=array(            
        'user' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'user_id'), 
		'tournament' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTournament', 'tournament_id'),
		'game' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGame', 'game_id'),
		'team' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTeam', 'team_id'),
		'playercard' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityPlayercard', 'playercard_id')
);

}

?>