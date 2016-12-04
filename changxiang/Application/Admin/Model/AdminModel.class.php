<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
	public $_validate =array(
		//添加图书
		array("adminname","require","管理员名称不能为空"),
		array("updatetime","require","管理员创建时间不能为空")
		);	
}
