<?php

	if($_POST["code"] == "pakyubobo") // Code for upload attack protection?? Change "pakyubobo" HERE and ON C# PROJECT if want to.
	{
		if(isset($_POST["data"]))
		{
			$timenow = time();
			$decoded = base64_decode($_POST["data"]);
		
			$filename = $_POST["user"].".".$timenow.".".md5(base64_encode($decoded));
		
			$fp = fopen("files\\booties\\".$filename.".txt", 'w');
			fwrite($fp, $decoded);
			fclose($fp);
    
			$saveinfo = json_decode(file_get_contents("files\\booties_data.json"));
			$myObj = new stdClass();
		
			$myObj->username = $_POST["user"];
			$myObj->ip = $_SERVER['REMOTE_ADDR'];
			$myObj->time = $timenow;
			$myObj->save = $filename;
			$myObj->info = $filename;
    
			$saveinfo[] = $myObj;
		
			file_put_contents("files\\booties_data.json", json_encode($saveinfo));
		}
	}
	else
	{
		header("Location: error.php");
	}
   
?>