<?php

include "../connect.php";

$verifyCode= rand(10000 , 99999);
$userEmail = filterRequest("userEmail");

sendemail($userEmail,'here is your Verify code ',"Verify code : $verifyCode");

$data=array("users_verifycode"=>$verifyCode);
updateData("users", $data,"users_email = '$userEmail'");
