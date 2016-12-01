<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model {
	//定义自动验证
	public $_validate = array (
		array("username", "require", "用户名不能为空"),
		array("userpass", "require", "密码不能为空"),
	);
}