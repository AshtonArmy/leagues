<?php
class PluginVs_ModuleStat_EntityTournamentreglament extends EntityORM {
protected $aRelations=array(             
        'tournament' => array(self::RELATION_TYPE_BELONGS_TO, 'PluginVs_ModuleStat_EntityTournament', 'tournament_id')
);

}

?>