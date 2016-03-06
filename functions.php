<?php

function getJason($url, $param = false){
	if(!$param)
		$param = '?offset=0&limit=10&';
	$opts = array(
	  'http'=>array(
		'method'=>"GET",
		'header'=>"client_id: kcrjzDgxydgi\r\nAccept' : 'application/json', 'Cross-origin' : '*'"
	  )
	);
	//echo $url.$param;
	$context = stream_context_create($opts);
	$file = file_get_contents($url.$param, false, $context);
	//var_dump($url.$param);
	if(!$file)
		return;
		
	$retorno = json_decode($file);
	if(!is_array($retorno))
		$retorno = array($retorno);
		
	return $retorno;
}

?>