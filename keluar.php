<?php
session_start();
unset($_SESSION["nama_user"]);
//unset($_SESSION["user_name"]);
$url = "http://adminfirmanhidup.cmcsurabaya.org/";

if(isset($_GET["session_expired"])) {
	$url .= "?session_expired=" . $_GET["session_expired"];
}
header("location:$url");
?>