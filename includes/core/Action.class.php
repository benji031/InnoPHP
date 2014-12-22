<?php
/**
* Classe permetant la gestion d'une action
*/
class Action
{
	private $_target;
	private $_params;

	function __construct($target, $params)
	{
		$this->_target = $target;
		$this->_params = $params;
	}

	public function getTarget()
	{
		return $this->_target;
	}
	public function getParams()
	{
		return $this->_params;
	}
}
?>