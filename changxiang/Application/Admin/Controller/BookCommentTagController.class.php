<?php
namespace Admin\Controller;
use Think\Controller;
class BookCommentTagController extends Controller {

   		public function lists() {
            //分页
            $tagmodel=D('tags');
            import('Org.Util.Page');
            $count=$tagmodel->count();
            $page=new \Think\Page($count,3);
            $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
            $page->setConfig('first','第一页');
            $page->setConfig('prev','前一页');
            $page->setConfig('next','后一页');
            //进行分页数据查询，注意limit方法的参数要使用Page类的属性
            $tag=$tagmodel->order('tagid desc')->page($nowPage.',9')->select();
            $show=$page->show();
            $this->assign('page',$show);
            $this->assign('tag', $tag);  //传值到模板
            $this->display();
        }


        public function read() {
            $id=$_GET['id'];
            if ($id == '') {
                exit("bad param!");
            }
            $data = M("tags")->where("tagid=$id")->find();
            $this->assign("data", $data);
            $this->display();
        }


         //删除书评标签
        public function delete() {
            //全部删除
            $tagModel = M("tags");
            $id = $_GET['id'];
            if(is_array($id)){
                foreach($id as $value){
                    M("tags")->delete($value);
                }
                $this->success("书评标签删除成功",U("lists"));
            }
            //单个删除
            else{
                if($tagModel->where("tagid=$id")->delete())
                    {
                        $this->success("此书评标签删除成功",U("lists"));
                    }
                else
                    {
                        $this->error($tagModel->geterror());
                    }
            }
        }
}