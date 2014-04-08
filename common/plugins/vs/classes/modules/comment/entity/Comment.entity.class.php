<?php


class PluginVs_ModuleComment_EntityComment extends PluginVs_Inherit_ModuleComment_EntityComment { 

	public function getPage() {
		return (floor(($this->getNum()-1)/Config::Get('module.comment.nested_per_page')) + 1) ;
	}
	public function getNum() {
		return $this->_getDataOne('comment_num');
	}
	public function setNum($data) {
		$this->_aData['comment_num']=$data;
	}
}