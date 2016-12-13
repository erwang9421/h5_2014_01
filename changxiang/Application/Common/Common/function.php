<?php
function isLogin(){
	if (!isset($_SESSION['adminname']) || $_SESSION['adminname']=='') {
		return false;
	}
	return true;
}