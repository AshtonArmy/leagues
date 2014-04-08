<?php

class PluginVs_ModuleText extends PluginVs_Inherit_ModuleText {
/*	protected function JevixConfig() {
		$this->oJevix->cfgAllowTags(array('cut','a', 'img', 'i', 'b', 'u', 's', 'video', 'em',  'strong', 'nobr', 'li', 'ol', 'ul', 'sup', 'abbr', 'sub', 'acronym', 'h4', 'h5', 'h6', 'br', 'hr', 'pre', 'code', 'object', 'param', 'embed', 'blockquote', 'irony'));
	}
*/	
	public function IronyParser($sText) {
        $sText=str_replace("<irony>",'<span class="irony">',$sText);
        $sText=str_replace("</irony>",'</span>',$sText);
        return $sText;
    }
	
	public function Parser($sText) {
		$sResult=$this->FlashParamParser($sText);
		$sResult = $this->PluginQipsmiles_Smile_Replace($sResult); 		
		$sResult=$this->JevixParser($sResult);	
		$sResult=$this->VideoParser($sResult);	
		$sResult=$this->CodeSourceParser($sResult);
		$sResult=$this->IronyParser($sResult);
		return $sResult;
	}
}

?>