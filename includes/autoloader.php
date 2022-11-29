<?php

spl_autoload_register('__autoloader');
function __autoloader($class) {
	$namespace = 'CodeMilitant\CodeMeta';

	if (strpos($class, $namespace) !== 0) {
		return;
	}

	$class = str_replace($namespace, '', $class);
	$class = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
echo "this is class: " . var_dump($class);

	$directory = plugin_dir_path( __DIR__ );
echo "this is directory: " . var_dump($directory);

	$path = $directory . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $class;

	if (file_exists($path)) {
		require_once($path);
	}
}
