<?php
	$files = scandir('../flashmp3player/mp3');
	$mp3files = array();
	for($i=0; $i<count($files); $i++) {
		if(strpos($files[$i], '.mp3') != false) {
			array_push($mp3files, $files[$i]);
		}
	}
	echo json_encode($mp3files);
?>