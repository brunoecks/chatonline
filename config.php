<?php

	
	$dbhost = 'locahost';
	$dbname = 'chat2';
	$dbuser = 'ricardoloureiro';
	$dbpass = 'bhorg.750';


	try{
		$db = new PDO("mysql:dbhost=$dbhost;dbname=$dbname", "$dbuser", "$dbpass");
		
	}catch( PDOException $e ){
		echo $e->getMessage();
	}
	


?>