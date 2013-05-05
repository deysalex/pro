<?php

class Application_Model_DbTable_Seo extends Zend_Db_Table_Abstract
{

    protected $_name = 'seo';

    public function Add($name, $text, $city_id)
	{
		$text=str_replace("\r\n","<br /> ",$text);
		$data = array(
			'name' => $name,
			'text' => $text,
			'city_id' => $city_id,
		);           
		$this->insert($data);
	}
		
	public function Edit($id, $name, $text)
	{
		$data = array(
			'name' => $name,
			'text' => $text,
		);           
		$this->update($data, 'id = ' . (int)$id);
	}		
		
	public function GetAll()
	{ 
		$city = new Zend_City_City();
		return $this->fetchAll($this->select()->where('city_id = ?', $city->getId())->order(array('id desc')));         
	} 	

	public function GetById($id)
	{ 
		$retval = $this->fetchRow($this->select()->where('id = ?', $id));
		$retval->text = str_replace("<br /> ","\r\n",$retval->text);
		return $retval;         
	} 
	
	public function GetByName($name)
	{ 
/*		
$oBackend = new Zend_Cache_Backend_Memcached(
    array(
        'servers' => array( array(
            'host' => 'localhost', 'port' => 11211, 'persistent' => true, 'weight' => 1, 'timeout' => 5, 'retry_interval' => 15, 'status' => true, 'failure_callback' => '' 
        ) ),
        'compression' => true,
        'compatibility' => true
) );

 
 
// настраиваем стратегию frontend кэширования
$oCacheLog = new Zend_Log();
$oCacheLog->addWriter( new Zend_Log_Writer_Stream( '../pr-memcache.log' ) );

// настраиваем стратегию frontend кэширования
$oFrontend = new Zend_Cache_Core(
array(
'caching' => true,
'cache_id_prefix' => 'seo',
'logging' => true,
'logger' => $oCacheLog,
'write_control' => true,
'automatic_serialization' => true,
'ignore_user_abort' => true
) );
 
// составляем объект кэширования
$oCache = Zend_Cache::factory( $oFrontend, $oBackend );
		$retval = null;
		if(!$oCache->test($name)) {*/
			$city = new Zend_City_City();
			$retval = $this->fetchRow($this->select()->where('name = ?', $name)->where('city_id = ?', $city->getId()));
			$retval->text = str_replace("<br /> ","\r\n",$retval->text);
			/*$oCache->save($retval, $name);
		} else {
			$retval = $oCache->load($name);
		}*/

		return $retval;         
	} 	

}

