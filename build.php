<?php

$videos = glob('video/*');

$arr = [];
$stub = file_get_contents('stub.index.html');

foreach( $videos as $vid ){

	$vid_name = explode('.mp4',basename($vid))[0];
	$arr[] = ['name' => $vid_name, 'path' => $vid];
	
	$pstub = $stub;

	$pstub = str_replace('%title%',$vid_name,$pstub);
	$pstub = str_replace('%src%',$vid,$pstub);

	file_put_contents('test'.time().'.html', $pstub);
}

