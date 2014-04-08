<?php
class PluginVs_ModuleStat_EntityAdvert extends EntityORM {
	protected $aRelations=array(            
        'user' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'from_id') ,
		'topic' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleTopic_EntityTopic', 'topic_id') 
);

}

?>