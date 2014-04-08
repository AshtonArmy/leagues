<?php

class PluginVs_WidgetNewtransfers extends Widget {
    public function Exec() {
		
		if( $aTransfers = $this->PluginVs_Stat_GetTransferItemsByFilter(array(
				'#order' =>array('id'=>'desc'),
				'#limit' =>array('0','5')
					)) ){
			$this->Viewer_Assign('aTransfers', $aTransfers);
		}
			
    }
}
?>