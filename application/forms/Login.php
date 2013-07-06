<?php
 
class Application_Form_Login extends Zend_Form
{
    public function init()
    {
        $this->setName('login');
        $this->setMethod('post');
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
		//--------------------------------------------------------------------------------------	
        $username = new Zend_Form_Element_Text('username', array(
            'required'    => true,
            'label'       => 'Логин:',
            'maxlength'   => '200',
			'class'       => 'input-block-level',			
            'filters'     => array('StripTags', 'StringTrim'),
        ));
		
		$username->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
        $this->addElement($username);
		//--------------------------------------------------------------------------------------
        $password = new Zend_Form_Element_Password('password', array(
			'required'    => true,
            'label'       => 'Пароль:',
			'maxlength'   => '200',
			'class'       => 'input-block-level',			
            'filters'     => array('StripTags', 'StringTrim'),
        )); 
        $this->addElement($password);	
		//--------------------------------------------------------------------------------------	
        // Кнопка Submit
        $submit = new Zend_Form_Element_Submit('login', array(
            'label'       => 'Войти в систему',
			'class'       => 'btn pull-right btn-primary',
        )); 
        $this->addElement($submit);	
		//--------------------------------------------------------------------------------------		
    }
}

