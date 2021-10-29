<?php

function slugify($str, $join = '-')
{
	preg_match_all('/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/', $str, $matches );
	return join( array_map( 'strtolower',(array) array_shift($matches) ),$join );
}

$videos = glob('video/*.mp4');

$arr = [];
$stub = file_get_contents('stub.index.html');

foreach( $videos as $vid ){
	$folder = explode('/',$vid)[0];
	$vid_name = explode('.mp4',basename($vid))[0];
	
	$pstub = $stub;
	
	$html_file = $folder.'/'.slugify($vid_name).'.html';
	$vidData = ['name' => $vid_name, 'path' => $vid,'link' => $html_file];
	$arr[] = $vidData;
	$pstub = str_replace('%title%',$vid_name,$pstub);
	$pstub = str_replace('%src%',basename($vid),$pstub);
	$pstub = str_replace('%videoinfo%', json_encode($vidData),$pstub);
	$pstub = str_replace('%allVid%', json_encode($arr),$pstub);

	file_put_contents($folder.'/'.slugify($vid_name).'.html', $pstub);
}

