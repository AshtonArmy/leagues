<?php
class PluginVs_ModuleStat_EntityTransfer extends EntityORM {
protected $aRelations=array(            
        'team' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTeam', 'team_id'),
		'playercard' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityPlayercard', 'playercard_id'),
		'who_user' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'who'),
		 );
}


?>