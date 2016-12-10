<?php
namespace Admin\Controller;
use Think\Controller;
class ZanController extends Controller {
   	
	public function lists(){
		//分页
            $supportmodel=M('support');
           /* $usermodel = M('users');
            $authormodel = M('author');*/
            import('Org.Util.Page');
            $count=$supportmodel->count();
            $page=new \Think\Page($count,3);
            $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
            $page->setConfig('first','第一页');
            $page->setConfig('prev','前一页');
            $page->setConfig('next','后一页');
            //进行分页数据查询，注意limit方法的参数要使用Page类的属性
            $support=$supportmodel->order('supportid desc')->page($nowPage.',9')->select();
            $show=$page->show();
            $this->assign('page',$show);
            $this->assign('support', $support);  //传值到模板
            $this->display();
	}

       //删除点赞记录
        public function delete() {
            //全部删除
            $supportModel = D("support");
            $id = $_GET['id'];
            if(is_array($id)){
                foreach($id as $value){
                    M("support")->delete($value);
                }
                $this->success("点赞记录删除成功",U("lists"));
            }
            //单个删除
            else{
                if($supportModel->where("supportid=$id")->delete())
                    {
                        $this->success("点赞记录删除成功",U("lists"));
                    }
                else
                    {
                        $this->error($supportModel->geterror());
                    }
            }
        }
}