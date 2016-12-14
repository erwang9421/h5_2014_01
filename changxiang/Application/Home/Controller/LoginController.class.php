<?php
        namespace Home\Controller;
        use Think\Controller;
        class LoginController extends Controller {


        public function personal_register(){
        $this->display();
        }
        public function login(){
        //后台登录
        if (IS_POST) {
        $adminModel=M('username');

        $condition=array(
        'username' => I("post.username"),
        'pass' => I("post.pass")
        'email'=>I("post.email")
        );
        $result=$adminModel->where($condition)->count();
        // dump($result);
        if ($result>0) {
        session("username",I("post.username"));
        $this->success("登录成功",U("Index/index"));
        }
        else{
        $this->error("用户名或密码不正确");
        }

        }
}