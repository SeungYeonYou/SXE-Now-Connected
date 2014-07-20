<?php
	if(!defined("__XE__")) exit();
	if(Context::get('module')=='admin' && $called_position != 'before_display_content' && $called_position != 'before_module_init'){return;}

	/**
	* @addon sxe_now_connected.addon.php
	* @author SeungXE (SeungYeonYou.KR+XE@gmail.com)
	* @brief 현재 접속자 출력 애드온
	**/

	if($called_position == 'before_display_content' && Context::getResponseMethod() == 'HTML') {
		$sxe_default_template = '<span>NOW: <strong>$_SXE_COUNT_$</strong></span>';
		if($addon_info->sxe_html_template==''){
			$SXE_Template = $sxe_default_template;
		}else{
			$SXE_Template = $addon_info->sxe_html_template;
		}
		$sxe_obj->list_count = -1;
		$oSessionModel = &getModel('session');
		$sxe_output = $oSessionModel->getLoggedMembers($sxe_obj);
		$SXE_Template = str_replace('$_SXE_COUNT_$',count($sxe_output->data),$SXE_Template);
		$output = str_replace('$$_SXE_NOWCONNECTED_SXE_$$',$SXE_Template,$output);
	}
?>