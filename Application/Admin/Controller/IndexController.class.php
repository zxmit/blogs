<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;

class IndexController extends CommonController {
    public function index(){
//	echo "这是后台页面";
         
//        dump($note->getLastSql());
        $this->display();
    }
    public function left(){
        $note = M('note');
        $num = $note->where('state=0')->count();
        $this->assign('num',$num);
       $this->display("Index:left");
    }
    
}