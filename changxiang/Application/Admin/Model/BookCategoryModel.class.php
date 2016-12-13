<?php
namespace Admin\Model;
use Think\Model;
class BookCategoryModel extends Model{
	public $_validate =array(
		//添加图书分类
		array("typebcname","require","标签名称不能为空"),
		array("addtime","require","标签创建时间不能为空")
		);	
}
