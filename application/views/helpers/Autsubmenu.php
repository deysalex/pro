<?php
 
class Zend_View_Helper_Autsubmenu extends Zend_View_Helper_Abstract
{
	public function Autsubmenu()
	{
		$html = '';
		$html = '<ul class="nav nav-list">
					<li><a href="/'.Zend_Registry::get('aut_controller').'/office">Мои объявления</a></li> 
					<li><a href="/'.Zend_Registry::get('aut_controller').'/changepass">Сменить пароль</a></li>
				</ul>';
		return $html;
	}
	
}