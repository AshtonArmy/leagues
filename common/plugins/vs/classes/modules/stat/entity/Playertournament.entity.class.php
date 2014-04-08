<?php
class PluginVs_ModuleStat_EntityPlayertournament extends EntityORM {
protected $aRelations=array(            
        'team' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTeam', 'team_id'),
		'playercard' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityPlayercard', 'playercard_id'),
		'user' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'user_id'),
		'tournament' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTournament', 'tournament_id')
		);
}


?>