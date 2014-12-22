<?php
	require_once(INCLUDES_DIR.'/config.php');
	require_once(INCLUDES_DIR.'/smarty/Smarty.class.php');
	require_once(INCLUDES_DIR.'/core/Action.class.php');

	$template = new Smarty();
	$template->setCompileDir(INCLUDES_DIR.'/smarty/templates_c/');
	$template->setCacheDir(INCLUDES_DIR.'/smarty/cache/');

	$template->setTemplateDir(TEMPLATES_DIR.TEMPLATE_DIR);
	$template->assign("template_dir", TEMPLATES_DIR.TEMPLATE_DIR);


	// ROOTING
	$url_path = explode("/", $_GET['path']);

	$rooting_json = file_get_contents(ROOTING_FILE);
	$rooting_json = json_decode($rooting_json, true);

	function getModule()
	{
		global $url_path;

		$url_module = $url_path[0];

		$module = findModuleForURL($url_module);

		return $module;
	}

	function getActionForModule($module)
	{
		global $url_path;
		$url_action = array_slice($url_path, 1);
		$url_action = "/".implode("/", $url_action);

		$actions = $module["action"];
		foreach ($actions as $action) {
			$path = $action["path"];
			if (preg_match("#".$path."#", $url_action, $matches)) {
				// echo "C'est bon pour $path et $url_action<br/>";
				$action_return = new Action($action["target"], array_slice($matches, 1));
				// echo $action_string."<br/><br/>";
				return $action_return;
			}
			else {
				// echo "Pas bon pour $path et $url_action<br/>";
			}
		}

		return NULL;
	}

	function findModuleForURL($url)
	{
		global $rooting_json;

		$modules = $rooting_json["modules"];

		foreach ($modules as $module) {
			if ($module["url"] == $url){
				return $module;
			}
		}
	}
	// if (isset($_GET['module'])) {
	// 	$bp_module = $_GET['module'];
	// }
	// if (isset($_GET['param'])) {
	// 	$bp_param = explode("/", $_GET['param']);
	// }

	// function getModule($module = NULL) {
	// 	global $bp_module;
	// 	if (isset($module)) {
	// 		return MODULES_DIR.'/'.$module;
	// 	}
	// 	return MODULES_DIR.'/'.$bp_module.'.php';
	// }
?>