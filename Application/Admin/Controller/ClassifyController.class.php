<?php
namespace Admin\Controller;
class ClassifyController extends CommonController {
    /**
     * 列表信息显示
     */
    public function classify_list(){
        $type = D('type');   
//        $list = $type->where("state>0")->select();
        $list = $type->order('position')->where("state>0")->select();
        $this->assign('list',$list);
        $this->display();
    }
    /*
     * 删除
     * echo 1:删除成功
     * echo 0:删除失败
     */
    public function classify_delete(){
        $id = $_POST["id"];
        $type = D('type');  
        $data['state'] = 0;
        if($type->where("id in $id ")->save($data)){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    /**
     * 开启类别
     * echo 0:开启失败
     * echo 1:开启成功
     * echo 2：没改变状态
     */
    public function minitab_classify(){
        $id = $_POST["id"];
        $state = $_POST['state'];
        $type = D('type');  
        $data['state'] = 1;
       if($state==2){
            $count = $type->where("id in $id AND state=1")->count();
       }else{
           $count=0;
       }
//         $count = $type->where("id in $id AND state=1")->count();
        if($count>0){
            echo 2;
        }else{
         if($type->where("id in $id")->save($data)){
            echo 1;
        }else{
            echo 0;
        } 
       }
    }
    
     /**
     * 关闭类别
     * echo 0:开启失败
     * echo 1:开启成功
     * echo 2：没改变状态
     */
    public function close_message(){
        $id = $_POST["id"];
        $state = $_POST['state'];
        $type = D('type');  
        $data['state'] = 2;
       
        if($state == 2){
             $count = $type->where("id in $id AND state=2")->count();
        }else{
            $count = 0;
        }
        if($count>0){
            echo 2;
        }else{
         if($type->where("id in $id")->save($data)){
            echo 1;
        }else{
            echo 0;
        } 
       }
    }
    //状态检索
    public function search_type(){
        $state = $_POST['id'];
        $type = D('type');
        if($state==0){
           $list = $type->select();
        }else{
            $list = $type->where("state= '$state'")->select();
        }
         $this->assign('list',$list);
         $this->assign("type",$state);
        $this->display("classify_list");
    }
    //检索所有的位置
    public function queryallposition(){
         $type = D('type');
         $list = $type->field("position")->select();
//         echo $type->getLastSql();
         $this->ajaxReturn($list,'JSON');
    }
    
    //修改信息
    public function update_classify(){
        $state    = $_POST['state']; 
        $position = $_POST['newposition'];
        $title    = $_POST['newtitle'];
        $nid = $_POST['nid'];
        $oldposition = $_POST['oldposition'];
        $type = D('type');
        if($state==1){
            //修改了标题
            $data['type'] = $title;
            if($type->where("id='$nid'")->save($data)){
                echo 1;
            }else{
                echo 0;
            }
        }
        else if($state==2){
            //修改了位置
            if($oldposition>$position){
              $data['position'] = $position;
              $p1 = $oldposition-1;
              $result1 = $type->execute("update blogs_type set position=position+1 where position <=$p1 and position >=$position");
              $result2 = $type->where("id='$nid'")->save($data);
              if($result1 && $result2){
                  echo 1;
              }else{
                  echo 0;
              }
            }else{
               $data['position'] = $position;
              $p1 = $oldposition+1;
              $result1 = $type->execute("update blogs_type set position=position-1 where position >=$p1 and position <=$position");
              $result2 = $type->where("id='$nid'")->save($data);
              if($result1 && $result2){
                  echo 1;
              }else{
                  echo 0;
              }
            }
        }
        else {
            //标题位置都修改了
              if($oldposition>$position){
              $data['position'] = $position;
              $data['type'] = $title;
              $p1 = $oldposition-1;
              $result1 = $type->execute("update blogs_type set position=position+1 where position <=$p1 and position >=$position");
              
              $result2 = $type->where("id='$nid'")->save($data);
              if($result1 && $result2){
                  echo 1;
              }else{
                  echo 0;
              }
            }else{
               $data['position'] = $position;
               $data['type'] = $title;
              $p1 = $oldposition+1;
              $result1 = $type->execute("update blogs_type set position=position-1 where position >=$p1 and position <=$position");
              $result2 = $type->where("id='$nid'")->save($data);
              if($result1 && $result2){
                  echo 1;
              }else{
                  echo 0;
              }
            }
        }
    }
    
   /**
    * 添加类型
    * echo 1:添加成功
    * echo 2：添加失败
    */
    public function add_type(){
        $type = D("type");
        $maxposition = $type->max('position');
        $typecontent = $_POST['type'];
        $data['type'] = $typecontent;
        $data['state'] = 1;
        $data['position'] = $maxposition+1;
        if($type->add($data)){
            echo 1;
        }else{
            echo 0;
        }
//        echo $typecontent;
    }
    
}
