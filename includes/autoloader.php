<?php

spl_autoload_register('__autoloader');
function __autoloader($class) {
	$namespace = 'CodeMilitant\CodeMeta';

	if (strpos($class, $namespace) !== 0) {
		return;
	}

	$class = str_replace($namespace, '', $class);
	$class = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

	$directory = dirname(__DIR__);
	$path = $directory . strtolower($class);

	if (file_exists($path)) {
		require $path;
		return true;
	}
	return false;
}
