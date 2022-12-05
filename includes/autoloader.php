<?php

spl_autoload_register('__autoloader');
function __autoloader($class) {
	$namespace = 'CodeMilitant\CodeMeta';

	if (strpos($class, $namespace) !== 0) {
		return;
	}

	$class = str_replace($namespace, '', $class);
	$class = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

	$directory = "/usr/share/nginx/html/wp-content/plugins/code-meta/includes";

	$path = $directory . DIRECTORY_SEPARATOR . 'src' . $class;

	if (file_exists($path)) {
		require_once($path);
	}
}
