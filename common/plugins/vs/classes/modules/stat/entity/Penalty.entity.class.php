<?php
class PluginVs_ModuleStat_EntityPenalty extends EntityORM {  
protected $aRelations = array(
	'match' =>  array(self::RELATION_TYPE_BELONGS_TO,'PluginVs_ModuleStat_EntityMatches','match_id'),
    'player' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'user_id')
  );
  }

?>