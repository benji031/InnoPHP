<?php
	define('ROOT', __DIR__);

	define('INCLUDES_DIR', ROOT.'/includes');
	define('CONTENTS_DIR', ROOT.'/contents');

	define('MODULES_DIR', CONTENTS_DIR.'/modules');
	define('TEMPLATES_DIR', CONTENTS_DIR.'/templates');

	require_once(INCLUDES_DIR.'/app.php');

	$module = getModule();
	$module_name = $module["name"];
	$module_file = MODULES_DIR."/".$module["file"];
	$module_url = $module["url"];

	if (isset($module)) {
		if (is_file($module_file)) {
			require($module_file);
			$module_exec = new $module_name;
			$action = getActionForModule($module);
			
			call_user_method_array($action->getTarget(), $module_exec, $action->getParams());
		}
		else {
			echo "404";
		}
	}
	else {
		echo "Accueil !";
	}
	// if (isset($bp_module)) {
	// 	if (is_file(getModule())) {
	// 		require(getModule());
	// 		$module_name = ucfirst($bp_module)."Module";
	// 		$module = new $module_name;
	// 		$module->$bp_module();
	// 	}
	// 	else {
	// 		include(getModule('errors.php'));
	// 	}
	// }
	// else {
	// 	include(getModule('index.php'));
	// }

	// $module = $_GET['path'];
	// echo $module;