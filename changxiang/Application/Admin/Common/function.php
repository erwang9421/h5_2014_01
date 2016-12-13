<?php
function get_adminname(){
	if(!isset($_SESSION['adminname'])||$_SESSION['adminname']==''){
	return false;
	}
	else{
	return $_SESSION['adminname'];
	}
}