<?php

namespace Home\Controller;
use Think\Controller;

class BookController extends Controller {
    //index.html页面点击浏览全文，传入书评的id，显示书评详情页
    public function bookreviewcontent($bookreviewid){
        //书评浏览次数的实现
        $in = M("bookreview");
        $output = $in->where(array('bookreviewid' => $bookreviewid))->setInc('viewtimes',1);
        $info = $in -> find($bookreviewid);
        $this -> assign('info',$info);

        //显示书评标题以及书评内容
        $bookReviewModel = M('bookreview');
        $result = $bookReviewModel -> find($bookreviewid);
        $this -> assign("bookReview",$result);
        $this->display();
    }
}