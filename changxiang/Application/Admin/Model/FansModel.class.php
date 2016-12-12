<?php
namespace Admin\Model;
use Think\Model;
class FansModel extends Model{
	public $_validate =array(
		//添加图书
		array("username","require","用户名不能为空"),
		array("fanname","require","粉丝名不能为空"),
		/*array("bookcontent","require","图书内容不能为空"),*/
		array("attentiontime","require","关注时间时间不能为空")
		);	
}
