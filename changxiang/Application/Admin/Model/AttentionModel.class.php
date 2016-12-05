<?php
namespace Admin\Model;
use Think\Model;
class AttentionModel extends Model{
	public $_validate =array(
		//添加图书
		array("userid","require","用户id不能为空"),
		array("fanid","require","粉丝id不能为空"),
		/*array("bookcontent","require","图书内容不能为空"),*/
		array("attentiontime","require","关注时间时间不能为空")
		);	
}
