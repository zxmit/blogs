<?php
/**
 * Description of CommonAction
 *
 * @author Administrator
 */
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
    Public function _initialize(){
    // 初始化的时候检查用户权限
//
//        $_SESSION['admin'] = 'admin';
//        $_SESSION['id'] = 1;
   	if(!isset($_SESSION['admin']) || $_SESSION['admin']==''){
		$this->redirect('/admin.php/Login/login');
//             $this->display();
	}
    }
}
