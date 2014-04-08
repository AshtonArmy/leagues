<?php
class PluginVs_ModuleStat_EntityMatchgoal extends EntityORM {  
protected $aRelations=array(        
			'team' =>  array(self::RELATION_TYPE_BELONGS_TO,'PluginVs_ModuleStat_EntityTeam','team_id'),
			'matchgoal' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityPlayercard', 'goal'),
			'matchassist' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityPlayercard', 'assist'),
			'matchassist2' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityPlayercard', 'assist2')
		);

}

?>