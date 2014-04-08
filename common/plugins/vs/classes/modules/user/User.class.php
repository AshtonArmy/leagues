<?php

class PluginVs_ModuleUser extends PluginVs_Inherit_ModuleUser {
	public function DeletePlayerPhoto($oUser) {
		$oPlayercard = $this->PluginVs_Stat_GetPlayercardByFilter(array(
						'user_id' => $oUser->GetUserId(), 
						'sport_id' => 1  
					));
		$this->Image_RemoveFile($this->Image_GetServerPath($oPlayercard->getFoto()));
	}
	
	public function UploadPlayerPhoto($sFileTmp,$oUser,$aSize=array()) {
		if (!file_exists($sFileTmp)) {
			return false;
		}
		$sDirUpload=$this->Image_GetIdDir($oUser->getId());
		$aParams=$this->Image_BuildParams('playerphoto');


		if ($aSize) {
			$oImage = $this->Image_CreateImageObject($sFileTmp);
			/**
			 * Если объект изображения не создан,
			 * возвращаем ошибку
			 */
			if($sError=$oImage->get_last_error()) {
				// Вывод сообщения об ошибки, произошедшей при создании объекта изображения
				// $this->Message_AddError($sError,$this->Lang_Get('error'));
				@unlink($sFileTmp);
				return false;
			}

			$iWSource=$oImage->get_image_params('width');
			$iHSource=$oImage->get_image_params('height');
			/**
			 * Достаем переменные x1 и т.п. из $aSize
			 */
			extract($aSize,EXTR_PREFIX_SAME,'ops');
			if ($x1>$x2) {
				// меняем значения переменных
				$x1 = $x1 + $x2;
				$x2 = $x1 - $x2;
				$x1 = $x1 - $x2;
			}
			if ($y1>$y2) {
				$y1 = $y1 + $y2;
				$y2 = $y1 - $y2;
				$y1 = $y1 - $y2;
			}
			if ($x1<0) {
				$x1=0;
			}
			if ($y1<0) {
				$y1=0;
			}
			if ($x2>$iWSource) {
				$x2=$iWSource;
			}
			if ($y2>$iHSource) {
				$y2=$iHSource;
			}

			$iW=$x2-$x1;
			// Допускаем минимальный клип в 32px (исключая маленькие изображения)
			if ($iW<32 && $x1+32<=$iWSource) {
				$iW=32;
			}
			$iH=$y2-$y1;
			$oImage->crop($iW,$iH,$x1,$y1);
			$oImage->output(null,$sFileTmp);
		}

		if ($sFileFoto=$this->Image_Resize($sFileTmp,$sDirUpload,func_generator(6),Config::Get('view.img_max_width'),Config::Get('view.img_max_height'),100,null,true,$aParams)) {
			@unlink($sFileTmp);
			/**
			 * удаляем старое фото
			 */
			$this->DeletePlayerPhoto($oUser);
			return $this->Image_GetWebPath($sFileFoto);
		}
		@unlink($sFileTmp);
		return false;
	}

}
?>