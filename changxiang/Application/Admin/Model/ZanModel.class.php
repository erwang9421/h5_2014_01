<?php
namespace Admin\Model;
use Think\Model;
class ZanModel extends Model{
	public $_validate =array(
		//点赞
		array("commentname","require","被赞者不能为空"),
		array("supportusername","require","点赞人不能为空"),
		array("publishtime","require","点赞时间不能为空")
		);	
}