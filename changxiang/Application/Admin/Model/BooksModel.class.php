<?php
namespace Admin\Model;
use Think\Model;
class BooksModel extends Model{
	public $_validate =array(
		//添加图书
		array("bookname","require","图书名称不能为空"),
		array("bookauthor","require","图书作者不能为空"),
		array("bookcontent","require","图书内容不能为空"),
		array("addtime","require","图书创建时间不能为空")
		);	
}
