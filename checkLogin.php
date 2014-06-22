<?php
function checkLogin(){
	if (!isset($_SESSION["player"])){
		return "login"; 
	}else{
		return 'ok';
	}		
}
?>