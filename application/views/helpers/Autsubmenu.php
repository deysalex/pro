<?php
 
class Zend_View_Helper_Autsubmenu extends Zend_View_Helper_Abstract
{
	public function Autsubmenu()
	{
		$html = '';
		$html = '<ul class="submenu">
					<li><a href="/aut/office">Мои объявления</a></li> 
					<li><a href="/aut/rezume">Мои резюме</a></li> 
					<li><a href="/aut/changepass">Сменить пароль</a></li>
				</ul>';
		return $html;
	}
	
}