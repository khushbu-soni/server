<?php

  $response=array();

  if(isset($_GET['user']) && isset($_GET['pass'])){
     $name = $_GET['user'];
     $pwd = $_GET['pass'];
   
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("Select uname,logincode from staff where uname='$name' and logincode='$pwd'");
  
    //echo mysql_affected_rows($result);
  
    $count=mysql_num_rows($result);
    // check if row inserted or not
   //echo $count."gg";
   
   if ($count > 0) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Logged-In Successfully ";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Access Denied.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
} 
	  
?>