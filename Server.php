<?php
// dont forget cookites 
//1 get values from the link
	$operation = $_GET['operation'];

	
	
	//locals
	$passwordArray[0]=247261;
	$passwordArray[1]=123;
	$passwordArray[2]=6873821;
	$passwordArray[3]=374277661;
	$passwordArray[4]=2262321;
	$passwordArray[5]=844654641;
	$passwordArray[6]=54629471;
	$passwordArray[7]=227392731;
	$passwordArray[8]=3774251;
	$passwordArray[9]=33052271;
	$passwordArray[10]=27784661;
	$passwordArray[11]=2275866921;
	$passwordArray[12]=243621;
	$passwordArray[13]=5664723741;
	$passwordArray[14]=5261;
	$passwordArray[15]=2636271;
	$passwordArray[16]=2261;
	$passwordArray[17]=25371;
	$passwordArray[18]=248637331;
	$passwordArray[19]=2522851;
	$passwordArray[20]=464364871;
	$passwordArray[21]=5741;
	$passwordArray[22]=8446597271;
	$passwordArray[23]=2526241;
	$passwordArray[24]=8377283761;
	$passwordArray[25]=63941;

	
	
	$knownLoggers[0]="Cisco";
	$knownLoggers[1]="AMH";
	$knownLoggers[2]="NUREVA";
	$knownLoggers[3]="ERICSSON";
	$knownLoggers[4]="Canada ISC";
	$knownLoggers[5]="ThinkingPhones";
	$knownLoggers[6]="Kinaxis";
	$knownLoggers[7]="CaseWare";
	$knownLoggers[8]="Espial";
	$knownLoggers[9]="FD Labs";
	$knownLoggers[10]="Apption";
	$knownLoggers[11]="Carletin University";
	$knownLoggers[12]="Ciena";
	$knownLoggers[13]="Kongsberg Gallium";
	$knownLoggers[14]="IBM";
	$knownLoggers[15]="Amdocs";
	$knownLoggers[16]="BlackBerry";
	$knownLoggers[17]="2Keys";
	$knownLoggers[18]="A Hundred Answers";
	$knownLoggers[19]="Alcatel-Lucent";
	$knownLoggers[20]="Ingenius";
	$knownLoggers[21]="JSI Telecom";
	$knownLoggers[22]="Thinkwrap";
	$knownLoggers[23]="Akamai Technologies";
	$knownLoggers[24]="Versaterm";
	$knownLoggers[25]="Mxi Technologies";

	
	
	// getting IP
	if(!empty($_SERVER["HTTP_CLIENT-IP"]))
	{
		$ip_address = $_SERVER["HTTP_CLIENT_IP"];
	}elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
	{
		$ip_address = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}else
	{
		$ip_address = $_SERVER["REMOTE_ADDR"];
	}
	

//2 Giving access and accessing the database
	$mysqli = new mysqli("localhost" /*mysql server hodt*/, 
					"root" /*username to access mysql*/, 
					"" /*password*/, 
					"rasberrypi" /*database name*/ );
					
// important	
	//header("Access-Control-Allow-Origin: *");
	
//3 now do Operations !


	// checking password lists ! if failed echo fialed
if($operation=="login")
{
	$password = $_GET['password'];
	for($i=0; $i<count($passwordArray);$i++)
	{
		if($password == $passwordArray[$i])
		{
			$username= $knownLoggers[$i];
			setcookie("logger",$username);
			$t= time();
			$sql = "INSERT INTO Login(IP,Time,Password,Name) VALUES('$ip_address','$t','$password', '$username'  )";
			$mysqli->query($sql);
			echo "Welcome $username";
			break;
		}else if (($i+1)== count($passwordArray))
		{
			echo "wrong password";
		}
	}
}else
{
	$t= time();
	$password="";
	$username="Guest";
	$sql = "INSERT INTO Login(IP,Time,Password,Name) VALUES('$ip_address','$t','$password', '$operation'  )";
	$mysqli->query($sql);
	echo "Welcome $username";
}




/*
if($operation=="login"){
		//echo $username. " " .$password."<br/>";
		
		setcookie('oppa',$operation)			;
		$query = "SELECT * FROM login WHERE IP='$username' AND password='$password'";	
		$result = $mysqli->query($query); 
		
		if($result===false){
			echo "Found nothing";
		}else{
			$num = $result->num_rows;
			if($num==0){
				echo "No record with $username and $password";
			}else{
				$row = $result->fetch_object();
				echo "ok";
				//"The record is " . $row->username . " and ". $row->password;
			}			
		}
	}
	
	
	if($operation=="update"){
		$sql = "UPDATE users SET password='$password' WHERE username='$username'";
		//another example
		//$sql = "UPDATE games SET results = CONCAT(results,' $result')WHERE game_id='$putID' ";
		$mysqli->query($sql);
		echo "ok";
		
	}
	

	if($operation=="create"){
	//$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
		setcookie("operation",$operation);
		$t= time();
		$password= 123;
		$sql = "INSERT INTO Login(IP,Time,Password,Name) VALUES('$ip_address','$t','$password', '$username'  )";
				
		$mysqli->query($sql);
		
		echo "ok";
		
	}
	*/
?>