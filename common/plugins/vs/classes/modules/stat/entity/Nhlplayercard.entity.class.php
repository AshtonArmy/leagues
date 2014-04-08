<?php
class PluginVs_ModuleStat_EntityNhlplayercard extends EntityORM {
	protected $aRelations=array(            
	);
	
	public function getFotoUrl() { 
		return 'http://3.cdn.nhle.com/photos/mugs/'.$this->getNhlId().'.jpg';
    }
	
	public function getFullFio() { 
		return $this->getFamily().' '.$this->getName();
    }

}
?>