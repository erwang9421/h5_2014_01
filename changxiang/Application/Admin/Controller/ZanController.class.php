<?php

namespace Admin\Controller;
use Think\Controller;


class ZanController extends Controller {

    //编辑修改点赞信息
	public function pushpraise(){
		$ZanModel=D('Zan');
		$Zan=$ZanModel->select();
		$this->assign('Zan',$Zan);

		$booksModel=D("Zan");
		$id=$_GET['booksId'];
		$Zan=$booksModel->find($id);
		$this->assign('Zan',$Zan);
		$this->display();
	}
    //添加点赞信息
    public function edit(){
        if (!IS_POST) {
			exit("bad request请求");
		}
		$ZanModel=D("books");
		if (!$ZanModel->create()) {
			$this->error($ZanModel->getError());
		}
		if ($ZanModel->add()) {
		    $this->success("添加成功",U("Zan/pushpraise"));
		}else{
			$this->error("添加失败");
		}		
	}
    
}