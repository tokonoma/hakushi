<?php

//localhost ips
$localips = array(
	'127.0.0.1',
	'::1'
);

//this is for getting baseurl to work locally, 
$baseurl  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$baseurl .= $_SERVER['SERVER_NAME'];
if (strpos($baseurl, 'localhost') !== false) {
    $baseurl .= ":".$_SERVER['SERVER_PORT'];
}

//create base url for server and for all routing in app
$cleanuri = explode('?', $_SERVER['REQUEST_URI'], 2);
$cleanurizero = htmlspecialchars($cleanuri[0]);
$baseurl .= $cleanurizero;

//also, try putting ../ in the middle of a path like get to ROOT, get CURRENT, then ../ to system

//this is for developing locally, for example, with MAMP...
//You may need to add your projects directory to the path to the database.
if(in_array($_SERVER['REMOTE_ADDR'], $localips)){
	//add your projects directory name here...
	$projectdirectory = "hakushi";
	$dbrelativepath = "/".$projectdirectory."/system/data/database.sqlite";
}
else{
	$dbrelativepath = $cleanurizero."system/data/database.sqlite";

}

//sqlite DB
define('DB_PATH', $_SERVER['DOCUMENT_ROOT'].$dbrelativepath);
$dsn = "sqlite:".DB_PATH;

//postgres DB
//$dbhost = "";
//$dbname = "";
//$dbuser = "";
//$dbpassword = "";
//$dbport = "";
//$dsn = "pgsql:host=".$dbhost.";port=".$dbport.";dbname=".$dbname.";user=".$dbuser.";password=".$dbpassword;

?>