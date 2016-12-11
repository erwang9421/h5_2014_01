<?php
namespace Admin\Controller;
use Think\Controller;
class FansController extends Controller {
   	
	public function lists(){
		//分页
            $fansmodel=M('fans');
            import('Org.Util.Page');
            $count=$fansmodel->count();
            $page=new \Think\Page($count,3);
            $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
            $page->setConfig('first','第一页');
            $page->setConfig('prev','前一页');
            $page->setConfig('next','后一页');
            //进行分页数据查询，注意limit方法的参数要使用Page类的属性
            $fans=$fansmodel->order('id desc')->page($nowPage.',9')->select();
            $show=$page->show();
            $this->assign('page',$show);
            $this->assign('fans', $fans);  //传值到模板
            $this->display();
	}

       //删除
        public function delete() {
            //全部删除
            $fansModel = D("fans");
            $id = $_GET['id'];
            if(is_array($id)){
                foreach($id as $value){
                    M("fans")->delete($value);
                }
                $this->success("删除成功",U("lists"));
            }
            //单个删除
            else{
                if($fansModel->where("id=$id")->delete())
                    {
                        $this->success("删除成功",U("lists"));
                    }
                else
                    {
                        $this->error($fansModel->geterror());
                    }
            }
        }
}