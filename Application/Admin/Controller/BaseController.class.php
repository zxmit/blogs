<?php
namespace Admin\Controller;
class BaseController extends CommonController{
    //显示密码修改页
    public function medpwd(){
        //查询邮箱
        $email = M('email');
        $elist = M('email')->select();
        $this->assign('elist',$elist);
       $this->display(); 
    }
    /**
     * 原始密码校验
     */
    public function check_oldPwd(){
        $oldpwd = $_POST['oldpwd'];
        $pwd = md5($oldpwd);
        $name = $_SESSION['admin']['admin'];
        $admin = M('admin');
        $count = $admin->where("pwd='$pwd' AND admin='$name'")->count();
        echo $count;
    }
    /**
     * 修改密码方法
     * echo 0:修改事变
     * echo 1：修改成功
     * echo 2：没有修改
     */
    public function doMedPwd(){
        $newpwd = $_POST['newpwd'];
        $admin = M("admin");
        $pwd = md5($newpwd);
        $name = $_SESSION['admin']['admin'];
        $data['pwd'] = md5($newpwd);
        $count = $admin->where("pwd='$pwd' AND admin='$name'")->count();
         if($count>0){
             echo 2;
         }else{
             if($admin->where("admin='$name'")->save($data)){
                 echo 1;
             }else{
                 echo 0;
             }
         }
    }
    /**添加邮箱
     * echo 0:添加失败
     * echo 1：添加成功
     */
    public function addemail(){
        $email = $_POST['email'];
        $mail = M('email');
        $data['email'] = $email;
        if($mail->add($data)){
            echo 1;
        }else{
            echo 0;
        }
    }
    /**
     * 修改邮箱
     */
    public function update_email(){
        $email = $_POST['email'];
        $mail = M('email');
        $data['email']= $email;
        $count = $mail->where("email='$email'")->count();
        if($count>0){
            echo 2;
        }else{
            if($mail->where("1=1")->save($data)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
}
