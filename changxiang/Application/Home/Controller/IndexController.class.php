<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        // $this->show("前台默认");
        $this->display();
    }

    public function unlogindex(){
    	$this->display();
    }
}