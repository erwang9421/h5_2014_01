<?php
namespace Admin\Controller;
use Think\Controller;
class BooksController extends Controller{
	public function lists(){
		//分页
		$books=M('Books');
        import('Org.Util.Page');
        $count=$books->count();
        $page=new \Think\Page($count,4);
        $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
        $page->setConfig('first','第一页');
        $page->setConfig('prev','前一页');
        $page->setConfig('next','后一页');
        //进行分页数据查询，注意limit方法的参数要使用Page类的属性
        $booklist=$books->order('addtime desc')->page($nowPage.',4')->select();
        $show=$page->show();
        $this->assign('page',$show);
        $this->assign('booklist',$booklist);  

        $booksModel=D("books");
		$id=$_GET['booksId'];
		$books=$booksModel->find($id);
		$this->assign('books',$books);

        $id=$_GET['booksId'];
        if(is_array($id)){
            foreach($id as $value){
                M("Books")->delete($value);
            }  
            $this->success("删除成功！");
        } 
        else{
            if(M("Books")->delete($id)){
                $this->success("删除成功！");
            }
        }       

		$this->display();
	}

	public function addbook(){
		$tagsModel=M('Tags');
		$tags=$tagsModel->select();
		$this->assign('tags',$tags);

		$this->display();
	}
	//添加图书
	public function doAdd(){
		if (!IS_POST) {
			exit("bad request请求");
		}
		$booksModel=D("books");
		if (!$booksModel->create()) {
			$this->error($booksModel->getError());
		}
		if ($booksModel->add()) {
		    $this->success("添加成功",U("Books/lists"));
		}else{
			$this->error("添加失败");
		}
		
	}
	//编辑修改图书
	public function editbook(){
		$tagsModel=D('tags');
		$tags=$tagsModel->select();
		$this->assign('tags',$tags);

		$booksModel=D("books");
		$id=$_GET['booksId'];
		$books=$booksModel->find($id);
		// $books=$booksModel->where("bookid = $id")->find();
		$this->assign('books',$books);

		if (IS_POST) {
			$model=M("Books");
			$a=$model->create();
			if ($model->save()) {
				$this->success("修改成功",U("Books/lists"));
			}
			else{
				$this->error($model->getError());
			}
		}	
		$this->display();
	}

	//删除图书
	public function delete(){
		//全部删除
        $id = $_GET['booksId'];
        if(is_array($id)){
            foreach($id as $value){
                M("Books")->delete($value);
            }  
            $this->success("删除成功！");
        } 
        //单个删除
        else{
            if(M("Books")->delete($id)){
                $this->success("删除成功！");
            }
        }       
    }



}