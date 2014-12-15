<?php
namespace Admin\Controller;
class TypeController extends CommonController{
    public function index(){
        $type = D('type');   
        $list = $type->select();
        $this->assign('list',$list);
        $this->display();
    }
//    public function indexabs(){
//        $type = D('type'); 
//        $data['state']=1;
//        $count = $type->where($data)->count("id");
//        
//        if(isset($_GET['page'])){
//            $page = $_GET['page'];
//        }else{
//            $page = 1;
//        }
//        $pagesize = 1;
//        if($count%$pagesize==0){
//            $num1 = $count/$pagesize;
//        }else{
//            $num1 = intval($count/$pagesize)+1;
//        }
//        $list = $type->where($data)->page($page,$pagesize)->select();
//        $this->assign('count',$count);
//        $this->assign('num1',$num1);
//        $this->assign('page',$page);
//        $this->assign('list',$list);
//        $this->display();
////        $this->assign('list',$list);
////        /*
////        import("ORG.Util.Page");// 导入分页类
////        $count      = $type->count();// 查询满足要求的总记录数
////        $Page       = new Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数
////        //$show       = $Page->show();// 分页显示输出
////         * *
////         */
////        $this->assign('page',$Page);// 赋值分页输出
////        $this->display();
//    }
    public function curd(){
        $news = M('type');
        $condition = $_POST['condition'];
        $data['state'] = $_POST['state'];
        $result = $news->where("$condition")->save($data);
        if($result){
            $res = 1;
        }else{
            $res = 0;
        }
        echo $res;
    }
}
