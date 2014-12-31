<?php
/**
* Exception si l'url du module est null
*/
class ModuleNullURLException extends Exception
{
	function __construct($message = null, $code = 0)
	{
		parent::__construct($message, $code);
	}
}
?>