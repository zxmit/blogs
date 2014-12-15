<?php
namespace Admin\Controller;

class MessageController extends CommonController{
    
    
    
    
    /**
     * 显示所有的信息
     */
    public function message_list(){
        $type = M("type");
        $type_list = $type->where("state>0")->select();
        $this->assign("type_list",$type_list);
        $news = M("news");
        $count = $news->where("state>0")->count();
        $pagesize = 12; //每页显示条数
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }
        if($count%$pagesize==0){
            $num1 = $count/$pagesize;
        }else{
            $num1 = intval($count/$pagesize)+1;
        }
         $list = $news->where("state>0")->order('id desc') ->page($page,$pagesize)->select();
         $this->assign('count',$count);
        $this->assign('num1',$num1);
        $this->assign('page',$page);
        $this->assign('list',$list);
        $this->display(); // 输出模板
    }
    
    /**
     * 
     * 条件检索
     */
    public function search_bycondition(){
        $id = $_POST['id'];
        $state = $_POST['state'];
        $news = M("news");
        if($state==0){
            $count = $news->where("state>0 AND type='$id'")->count();
            $list = $news->order('id desc')->where("state>0 AND type='$id'")->page($page,$pagesize)->select();
        }else{
            $count = $news->where("state = '$state' AND type='$id'")->count();
            $list = $news->order('id desc')->where("state = '$state' AND type='$id'")->page($page,$pagesize)->select();
        }
        $pagesize = 12; //每页显示条数
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }
        if($count%$pagesize==0){
            $num1 = $count/$pagesize;
        }else{
            $num1 = intval($count/$pagesize)+1;
        }
         if($state==0){
            $list = $news->order('id desc') ->where("state>0 AND type='$id'")->page($page,$pagesize)->select();
        }else{
            $list = $news->order('id desc') ->where("state = '$state' AND type='$id'")->page($page,$pagesize)->select();
        }
         $this->assign('count',$count);
        $this->assign('num1',$num1);
        $this->assign('page',$page);
        $this->assign('list',$list);
        
         $type = M("type");
        $type_list = $type->where("state>0")->select();
        $this->assign("type_list",$type_list);
        $this->assign("id",$id);
        $this->assign("state",$state);
        $this->display("message_list"); // 输出模板
    }
    
    /*
     * 
     * 删除信息
     * echo 1:删除成功
     * echo 0:删除失败
     */
    public function delete_message(){
        $id = $_POST["id"];
        $news = M("news");
        $data['state'] = 0;
        if($news->where("id in $id")->save($data)){
            echo 1;
        }else{
            echo 0;
        }
    }
    /**
     * 开启信息
     * echo 0:开启失败
     * echo 1:开启成功
     * echo 2：没改变状态
     */
    public function minitab_message(){
        $id = $_POST["id"];
        $state = $_POST['state'];
        $news = M("news");
        $data['state'] = 1;
        if($state==2){
            $count = $news->where("id in $id AND state=1")->count();
        }else{
            $count = 0;
        }
//        $count = $news->where("id='$id' AND state=1")->count();
        if($count>0){
            echo 2;
        }else{
         if($news->where("id in $id")->save($data)){
            echo 1;
        }else{
            echo 0;
        } 
       }
    }
    
     /**
     * 关闭信息
     * echo 0:开启失败
     * echo 1:开启成功
     * echo 2：没改变状态
     */
    public function close_message(){
        $id = $_POST["id"];
        $state = $_POST['state'];
        $news = M("news");
        $data['state'] = 2;
        if($state==2){
             $count = $news->where("id in $id AND state=2")->count();
        }else{
            $count = 0;
        }
//        $count = $news->where("id='$id' AND state=2")->count();
//         $count = 0;
        if($count>0){
            echo 2;
        }else{
         if($news->where("id in $id")->save($data)){
            echo 1;
        }else{
            echo 0;
        } 
       }
      
    }
   
    /**
     * 跳转到新闻发布页
     */
    public function publish_messageUI(){
        $type = M("type");
        $type_list = $type->where("state>0")->select();
        $this->assign("type_list",$type_list);
        $this->display();
    }
    /**
     * 新闻添加
     */
    public function publish_messageadd(){
        $news = D("news");
        $title = $_POST['title'];
        $type = $_POST['type'];
        $content = $_POST['content'];
        $data['title'] = $title;
        $data['type'] = $type;
        $data['publisher'] = $_SESSION['id'];
        $data['time'] = date("Y-m-d");
        $data['content'] = $content;
        $data['state'] = 1;
        $addid = $news->add($data);
        if($addid>0){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    /**
     * 根据查询新闻内容
     * 跳转到新闻修改页
     */
    public function update_messageUI(){
        $nid = $_GET['nid'];
        $type = M("type");
        $news = D("news");
        $type_list = $type->where("state>0")->select();
        $new_list = $news->where("id = '$nid'")->select();
        $new_type = $news->where("id='$nid'")->getField('type');
        $this->assign("type_list",$type_list);
        $this->assign("new_list",$new_list);
        $this->assign("new_type",$new_type);
        $this->assign("nid",$nid);
        $this->display();
    }
    /*
     * 提交新闻修改
     * echo 0:修改失败
     * echo 1:修改成功
     * echo 2：没有修改
     */
    public function update_news(){
        $news = D("news");
        $title = $_POST['title'];
        $type = $_POST['type'];
        $content = $_POST['content'];
        $nid = $_POST['nid'];
        $data['title'] = $title;
        $data['type'] = $type;
        $data['publisher'] = $_SESSION['id'];
        $data['time'] = date("Y-m-d");
        $data['content'] = $content;
//        $count = $news->where("title='$title' AND type='$type' AND content='$content'")->count();
        
            if($news->where("id='$nid'")->save($data)){
                echo 1;
            }else{
                echo 0;
            }
        
       
    }
    public function editor() {
        $this->display();
    }
    public function ueditor() {
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }
    
}
