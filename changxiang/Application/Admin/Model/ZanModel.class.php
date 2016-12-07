<?php
namespace Admin\Model;
use Think\Model;
class ZanModel extends Model{
	public $_validate =array(
		//点赞
		array("cat_name","require","用户名不能为空"),
		array("unique_id","require","评论id不能为空"),
		array("sort","require","点赞时间不能为空")
		);	
}