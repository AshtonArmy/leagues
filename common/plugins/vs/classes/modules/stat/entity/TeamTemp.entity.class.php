<?php
class PluginVs_ModuleStat_EntityTeamTemp extends EntityORM {
protected $aRelations=array(            
		'game' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGame', 'game_id'),
		'gametype' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityGametype', 'gametype_id'),
		'sport' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntitySport', 'sport_id'),		
		'owner' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'owner_id'),
		'blog' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleBlog_EntityBlog', 'blog_id'),
);



}

?>