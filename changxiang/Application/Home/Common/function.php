<?php

function getData(){
	if(!isset($_SESSION['username'])||$_SESSION['username']=='')
	{
		return "我不相信我没登录";
	}
	else{
		$username = $_SESSION['username'];
    	$userModel = M('users');
    	$authorModel = M('author');
    	$condition->username = $username;
   	 	$a = $userModel->where($condition)->select();
    	$b = $authorModel->where($condition)->select();
    	$list =array_merge($a,$b);
    	return $list;
	}

}