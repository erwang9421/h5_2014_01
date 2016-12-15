<?php
        namespace Home\Controller;
        use Think\Controller;
        class LoginController extends Controller {


        public function personal_register(){
        $this->display();
        }
        public function login(){
                    $this->display();
                }

                public function checkId(){
                    if(!IS_POST)
                    {
                        exit("bad request!");
                    }
                    else {
                        $authorModel = M('author');
                        $userModel = M('users');
                        $condition=array(
                            'username' => I("post.username"),
                            'pass' => I("post.pass")
                        );
                        $result1=$authorModel->where($condition)->count();
                        $result2=$userModel->where($condition)->count();
                        $result = $result1 + $result2;
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

                public function author(){
                $this->display();
                }



                public function doAdd(){
                    $authorModel = M('author');
                    $send = sendMail($_POST['mail'],$_POST['username'],$_POST['pass']);
                	if($send)
                    {
                          $this->success('发送成功！');
                    }
                    else
                        $this->error("发送失败");
                }
}