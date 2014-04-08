<?php
class PluginVs_ModuleStat_EntityOfrating extends EntityORM {
protected $aRelations=array(            
        'user' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'user_id') 
);

}

?>