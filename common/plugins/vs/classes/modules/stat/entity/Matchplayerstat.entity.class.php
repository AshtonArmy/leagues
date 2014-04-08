<?php
class PluginVs_ModuleStat_EntityMatchplayerstat extends EntityORM {  
protected $aRelations=array(    
			'playercard' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityPlayercard', 'playercard_id'),
			'team' =>  array(self::RELATION_TYPE_BELONGS_TO,'PluginVs_ModuleStat_EntityTeam','team_id')
		);

}

?>