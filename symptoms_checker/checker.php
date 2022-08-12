<?php
$xpath = array_filter(array_merge(array('gender'=>'man','side'=>'front','part'=>'head'), (array) $_GET));

$filename = $xpath['gender'].'.php';
if(file_exists($filename)) require_once($filename);
else exit('The '.$filename.' is missing');

function slug($str = '')
{
	return preg_replace('/(\s+)/', '_', preg_replace('/([^a-z0-9_ ])/', '', strtolower($str)));
}

function get_keys($data)
{
	$return = array();
	foreach($data as $k=>$v)
		$return[slug($k)] = $v;

	return $return;
}

$data = $settings;
foreach($xpath as $key)
{
	$nkey = slug($key);
	$last_data = (isset($data[$nkey])) ? $data[$nkey] : array();
	
	if(isset($data[$nkey])) $data = get_keys($data[$nkey]);
	else $data = array();
}

if(is_numeric(key($data))) exit(json_encode(array_combine(array_keys($data), array_values($last_data))));
elseif( ! empty($data)) exit(json_encode(array_combine(array_keys($data), array_keys($last_data))));
else exit('The part settings are missing in checker php file and you can change this error message from symptoms_checker/checker.php');