<?php
class PluginAdminvs_ModuleStat extends ModuleORM {
	protected $oMapper=null;
  public function Init() {
    parent::Init();
			$this->oMapper=Engine::GetMapper(__CLASS__,'Stat');
  }
   public function GetAll($sql) {
        return $this->oMapper->GetAll($sql);
    }
	public function CreateBlog($sql) {
        return $this->oMapper->CreateBlog($sql);
    }
		
}
?>