<?php
namespace php\lang;

function import($class){
	require_once(str_replace('\\',DIRECTORY_SEPARATOR,$class) . '.php');
}


?>