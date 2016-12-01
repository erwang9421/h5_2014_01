<?php

namespace Admin\Controller;
use Think\Controller;


class BookCommentController extends Controller
{
    public function bookview(){
        $this -> display();
    }
    public function addbookview(){
        $this->display();
    }
}