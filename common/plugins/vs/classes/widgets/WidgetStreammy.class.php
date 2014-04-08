<?php

class PluginVs_WidgetStreammy extends Widget {
    public function Exec() {
		
		$stream_count = Config::Get('block.stream.row');
		if( $this->GetParam('oBlog') ){
			$oBlog=$this->GetParam('oBlog');
			$stream_lang = 'all';
			$stream_count = $this->GetParam('stream_count');
		}
		
		if( $this->GetParam('stream_count') ){
			$stream_count = $this->GetParam('stream_count');
		}
		
		/**
		 * Получаем комментарии
		 */
		if ($aComments=$this->Comment_GetCommentsOnline('topic',$stream_count)) {
			$oViewer=$this->Viewer_GetLocalViewer();
			$oViewer->Assign('aComments',$aComments);
			/**
			 * Формируем результат в виде шаблона и возвращаем
			 */
			$sTextResult=$oViewer->Fetch(/*Plugin::GetTemplatePath(__CLASS__).*/"widgets/widget.stream_comment.tpl");
			$this->Viewer_Assign('sStreamComments',$sTextResult);
			$this->Viewer_Assign('stream_count',$stream_count);
			$this->Viewer_Assign('stream_lang',$stream_lang);
		}
	}
	
 
}
?>