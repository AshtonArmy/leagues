<?php
class PluginVs_ModuleStat_EntityPlayerminiturnir extends EntityORM {
protected $aRelations=array(            
        'miniturnir' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityMiniturnir', 'miniturnir_id'),
		'user' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'user_id')
		);
}


?>