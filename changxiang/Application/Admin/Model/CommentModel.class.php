<?php

namespace Admin\Model;
use Think\Model;

class CommentModel extends Model{
    public $_validate =array(
        //添加图书
        array("commentuserid","require","发表评论用户的id不能为空"),
        array("bookreviewid","require","书评id不能为空"),
        array("commentcontent","require","评论内容不能为空"),
        array("commenttime","require","评论时间不能为空")
    );
}
