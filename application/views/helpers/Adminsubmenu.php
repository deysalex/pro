<?php
 
class Zend_View_Helper_Adminsubmenu extends Zend_View_Helper_Abstract
{
	public function Adminsubmenu()
	{
		$html = '';
		$html = '<ul class="submenu">
					<li><a href="/admin/mailtemplate">Список шаблонов для письма</a></li>
					<li><a href="/admin/listseo">Список seo параметров</a></li>
					<li><a href="/admin/addseo">Добавить seo параметр</a></li>
					<li><a href="/admin/sendmail">Отправка писем</a></li>
					<li><a href="/admin/stat">Статистика</a></li>  
				</ul>';
		return $html;
	}
	
}