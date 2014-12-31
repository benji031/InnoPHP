<?php
require_once(INCLUDES_DIR.'/core/Exceptions/ModuleNullURLException.class.php');
require_once(INCLUDES_DIR.'/core/Exceptions/ModuleNotFoundException.class.php');

/**
* Class Module, creation de module pour l'application
*/
class Module
{
	private $_module_name;
	private $_module_file;
	private $_module_url;
	private $_module_actions;

	private $_url;

	function __construct($url)
	{
		if (!isset($url)) {
			throw new ModuleNullURLException("URL cannot be NULL");
		}

		$this->_url = explode("/", $url);
		$this->_module_url = $this->_url[0];

		$rooting_json = file_get_contents(ROOTING_FILE);
		$rooting_json = json_decode($rooting_json, true);

		$modules = $rooting_json["modules"];

		foreach ($modules as $module) {
			if ($module["url"] == $this->_module_url){
				$this->_module_name		= $module['name'];
				$this->_module_file 	= $module['file'];
				$this->_module_actions 	= $module['actions'];
			}
		}

		if (!isset($this->_module_file) && !isset($this->_module_name)) {
			throw new ModuleNotFoundException("The module '".$this->_module_url."' was not found in '".ROOTING_FILE."'.");
		}
	}
}
?>