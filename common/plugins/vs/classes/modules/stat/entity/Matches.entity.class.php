<?php
class PluginVs_ModuleStat_EntityMatches extends EntityORM {  
protected $aRelations = array(
    'hometeam' =>  array(self::RELATION_TYPE_BELONGS_TO,'PluginVs_ModuleStat_EntityTeam','home'),
	'awayteam' =>  array(self::RELATION_TYPE_BELONGS_TO,'PluginVs_ModuleStat_EntityTeam','away'),		
	'blog' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleBlog_EntityBlog', 'blog_id'),
	'tournament' =>  array(self::RELATION_TYPE_BELONGS_TO,'PluginVs_ModuleStat_EntityTournament','tournament_id'),
	'awayuser' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'away_player'),		
    'homeuser' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'home_player')
  );
  }

?>