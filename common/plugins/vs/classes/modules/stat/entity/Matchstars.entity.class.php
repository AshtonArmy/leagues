<?php
class PluginVs_ModuleStat_EntityMatchstars extends EntityORM {  
protected $aRelations=array(          
			'playercard' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityPlayercard', 'playercard_id')
		);

}

?>