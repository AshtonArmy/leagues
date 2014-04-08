<?php
class PluginVs_ModuleStat_EntityMatchtime extends EntityORM {  
protected $aRelations=array(            
        'user1' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'player_id'),
        'user2' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'player2_id')
		);

}

?>