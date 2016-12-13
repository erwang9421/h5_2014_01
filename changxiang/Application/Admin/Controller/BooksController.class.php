<?php
namespace Admin\Controller;
use Think\Controller;
class BooksController extends Controller{
	public function __construct(){
    	parent::__construct();
    	if (!isLogin()) {
    		$this->error("请先登录",U("Admin/login"));
    	}
    }
	public function lists(){
		$books=M('Books');
		//分页
        import('Org.Util.Page');
        $count=$books->count();
        $page=new \Think\Page($count,4);
        $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
        $page->setConfig('first','第一页');
        $page->setConfig('prev','前一页');
        $page->setConfig('next','后一页');

// $booklist=$books->join(array('books ON bcconnection.bookid = books.bookid','bookscategories ON bcconnection.bcid = bookscategories.bcid'))->order('addtime asc')->page($nowPage.',4')->select();
		$booklist=$books->join('bookscategories ON books.bcid = bookscategories.bcid')
		->order('books.addtime desc')->page($nowPage.',4')->select();
		// dump($booklist);
		// exit();
		// distinct(true)重复字段 group('bcname')重复字段合并

        $show=$page->show();
        $this->assign('page',$show);
        $this->assign('booklist',$booklist);        	   

		$this->display();
	}

	public function addbook(){
		$tags=M('Bookscategories');
		$taglist=$tags->join('books ON bookscategories.bcid = books.bcid')
		->order('pid asc')->group('typebcname')->select();
		$this->assign('tags',$taglist);

		$this->display();
	}
	//添加图书
	public function doAdd(){
		if (!IS_POST) {
			exit("bad request请求");
		}
		$booksModel=M('Books');
		$book=$booksModel->create();
		if($booksModel->add($data)){
			$this->success('添加成功',U("Books/lists"));
		}else{
			$this->error('数据添加失败');
		}
	}
	public function doAdd1(){
		if (!IS_POST) {
			exit("bad request请求");
		}
		else{
			$booksModel=D('bookscategories');
			// $booksModel=D('books')->join('bookscategories ON books.bcid = bookscategories.bcid')
			// ->group('typebcname');
			if(!$booksModel->create()){
                $this->error($booksModel->getError());
            }else{
            	if ($booksModel->add()) {
                    $bookType = I('typebcname');
                    $bcId = $booksModel->getFieldBytypebcname("{$bookType}","bcid");
                    // $pId=$booksModel->getFieldBypid("{$bookType}","pid");

                    // $books=M("Books b")->join('bookscategories c ON b.bcid = c.bcid')->select();
                    $books=M("Books");
                    $data['bcid'] = $bcId;
                    // $data['typebcname']=$books->join('bookscategories ON books.bcid=bookscategories.bcid')->field('typebcname')->find();
                    // dump($data['typebcname']);
                    // $data['pid']=$pId;
                    $data['bookname'] = I('bookname');
                    $data['bookauthor'] = I('bookauthor');
                    $data['bookcontent'] = I('bookcontent');
                    $data['addtime'] = date('Y-m-d H:i:s',time());
                    // dump($data);
                    if($books -> data($data) -> add()){
                        $this -> success("添加成功",U("Books/lists"));
                    }
            	}else{
            		$this->error("添加失败");
            	}
            }
		}
	}


	//编辑修改图书
	public function editbook(){
		// $tags=M('Bookscategories');
		// $taglist=$tags->join('books ON bookscategories.bcid = books.bcid')
		// ->select();

		$booksModel=M("Books");
		// $id=$_GET['booksId'];
		$id=I('booksId');
		$taglist=$booksModel
		->join('bookscategories ON books.bcid = bookscategories.bcid')
		->select();
		$books=$booksModel->find($id);
		
		$this->assign('data',$taglist);
		$this->assign('books',$books);

		$this->display();
	}
	public function update(){
		if (IS_POST) {
			$model=M("books");
			// $id=$_GET['booksId'];
			$id=I('bcid');
			$data=$model->create();
			dump($data);
			if ($model->where("bcid=".$id)->save($data)) {
				$this -> success("数据更新成功",U("Books/lists"));
			}
			else{
				$this->error($model->getError());
			}
		}	
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
    // public function deleteAll(){
    // 	$booksModel=M("Books");
    // 	$id=$_GET['bookid'];
    // 	$i=0;
    // 	foreach ($id as $key => $value) {
    // 		$it=$value;
    // 		$where='bookid='.$it;
    // 		$list[$i]=$booksModel->where($where)->delete();
    // 		$i++;
    // 	}
    // 	if($list){
    // 		$this->success("成功删除{$i}条",U('Books/lists'));
    // 	}else{
    // 		$this->error($booksModel->getError());
    // 	}

    // }



}