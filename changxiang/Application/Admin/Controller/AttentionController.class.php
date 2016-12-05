<?php
namespace Admin\Controller;
use Think\Controller;
class AttentionController extends Controller {
    public function payattention(){
		//分页
		$fans=M('Fans');
        import('Org.Util.Page');
        $count=$fans->count();
        $page=new \Think\Page($count,10);
        $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
        $page->setConfig('first','第一页');
        $page->setConfig('prev','前一页');
        $page->setConfig('next','后一页');
        //进行分页数据查询，注意limit方法的参数要使用Page类的属性
        $fanlist=$fans->order('attentiontime asc')->page($nowPage.',10')->select();
        $show=$page->show();
        $this->assign('page',$show);
        $this->assign('fanlist',$fanlist);  

  //       $booksModel=D("books");
		// $id=$_GET['booksId'];
		// $books=$booksModel->find($id);
		// $this->assign('books',$books);

  //       $id=$_GET['booksId'];
  //       if(is_array($id)){
  //           foreach($id as $value){
  //               M("Books")->delete($value);
  //           }  
  //           $this->success("删除成功！");
  //       } 
  //       else{
  //           if(M("Books")->delete($id)){
  //               $this->success("删除成功！");
  //           }
  //       }       

		$this->display();
	}

	public function addattention(){
		$tagsModel=M('Tags');
		$tags=$tagsModel->select();
		$this->assign('tags',$tags);

		$this->display();
	}
	//添加粉丝
	public function doAdd(){
		if (!IS_POST) {
			exit("bad request请求");
		}
		$attentionModel=D("fans");
		if (!$attentionModel->create()) {
			$this->error($attentionModel->getError());
		}
		if ($attentionModel->add()) {
		    $this->success("添加成功",U("Attention/payattention"));
		}else{
			$this->error("添加失败");
		}
		
	}
	//编辑粉丝
	public function editpayattention(){
		$tagsModel=D('tags');
		$tags=$tagsModel->select();
		$this->assign('tags',$tags);

		$attentionModel=D("fans");
		$id=$_GET['fansId'];
		$fans=$attentionModel->find($id);
		// $books=$booksModel->where("bookid = $id")->find();
		$this->assign('fans',$fans);

		if (IS_POST) {
			$model=M("Fans");
			$model->create();
			if ($model->save()) {
				$this->success("修改成功",U("payattention"));
			}
			else{
				$this->error($model->getError());
			}
		}	
		$this->display();
	}

	//删除粉丝
	public function delete(){
		//全部删除
        $id = $_GET['fansId'];
        if(is_array($id)){
            foreach($id as $value){
                M("Fans")->delete($value);
            }  
            $this->success("删除成功！");
        } 
        //单个删除
        else{
            if(M("Fans")->delete($id)){
                $this->success("删除成功！");
            }
        }       
    }
}