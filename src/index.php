<?php 
include "Core/bubaphp.php";
if (isset($_GET['url'])) {
	$Bubaphp->loadController($_GET['url']);
}else{
	$Bubaphp->loadController(__DEFAULTCONTROLLER__);
}

?>