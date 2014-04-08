<?php
class PluginVs_ModuleStat_EntityVyzov extends EntityORM {  
protected $aRelations=array(            
        'user1' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'user_id'),
        'user2' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'user2_id')
		);

}

?>