<?php
class PluginVs_ModuleStat_EntityZayavki extends EntityORM {
protected $aRelations=array(            
        'user' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'user_id'),
		'team' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTeam', 'team_id')
		);
}

?>