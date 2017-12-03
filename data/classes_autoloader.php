<?
spl_autoload_register(function($className)
	{
	$classNameExplode = explode("\\", $className);
	$classFilePath    =
		SITE_PATH.DIRECTORY_SEPARATOR
		."data".DIRECTORY_SEPARATOR
		."classes".DIRECTORY_SEPARATOR
		.implode(DIRECTORY_SEPARATOR, $classNameExplode).".php";

	if(file_exists($classFilePath)) include $classFilePath;
	});