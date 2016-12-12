<?php
namespace Admin\Controller;
use Think\Controller;
class BookCategoryController extends Controller{
	public function bookcategory(){
		$tagModel=M("Bookscategories");

        import('Org.Util.Page');
        $count=$tagModel->count();
        $page=new \Think\Page($count,4);
        $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
        $page->setConfig('first','第一页');
        $page->setConfig('prev','前一页');
        $page->setConfig('next','后一页');

        $tag=$tagModel->order('addtime desc')->page($nowPage.',4')->select();
        $show=$page->show();
        $this->assign('page',$show);

        $this->assign("tag",$tag);

		$this->display();
	}
	public function delete(){
		//全部删除
        $id = $_GET['tagId'];
        // dump($id);
        if(is_array($id)){
            foreach($id as $value){
                M("Bookscategories")->delete($value);
            }  
            $this->success("删除成功！");
        } 
        //单个删除
        else{
            if(M("Bookscategories")->delete($id)){
                $this->success("删除成功！");
            }
        }       
    }
    //编辑修改
    public function editbookcategory(){
    	$tagsModel=D("bookscategories");
		$id=$_GET['tagId'];
		$tags=$tagsModel->find($id);
		$this->assign('tags',$tags);

    	$this->display();
    }
    public function update(){
		if (IS_POST) {
			$model=M("Bookscategories");
			$model->create();
			if ($model->save()) {
				$this->success("修改成功",U("BookCategory/bookcategory"));
			}
			else{
				$this->error($model->getError());
			}
		}	
	}
	//添加
	public function addbookcategory(){
		$this->display();
	}
	//添加图书分类
	public function doAdd(){
		if (!IS_POST) {
			exit("bad request请求");
		}
		$tagsModel=D("bookscategories");
		if (!$tagsModel->create()) {
			$this->error($tagsModel->getError());
		}
		if ($tagsModel->add()) {
		    $this->success("添加成功",U("BookCategory/bookcategory"));
		}else{
			$this->error("添加失败");
		}

	}



}