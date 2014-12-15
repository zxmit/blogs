<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
    public function login(){
        $this->display();
    }
    public function doLogin(){
        $admin = $_POST['admin'];
        $pwd = md5($_POST['pwd']);
        $ad = D('admin');
        $data['admin'] = $admin;
        $data['pwd'] = $pwd;
        $data['state'] = 1;
        
        $arr = $ad->where($data)->find();
//        echo $ad->getLastSql();
//        dump($arr);
        if($arr){
            $_SESSION['admin'] = $arr;
            $this->success("登录成功","../Index/index");
        }else{
            $this->error("用户名或密码错误！","login");
        }
    }
    public function doExit() {
        $_SESSION['admin'] = null;
        $this->redirect('/admin.php/Login/login');
    }
}
