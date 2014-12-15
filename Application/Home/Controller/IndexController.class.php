<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class IndexController extends Controller {
    
    /*
      ------------------------------------------------------
      参数：
      $str_cut    需要截断的字符串
      $length     允许字符串显示的最大长度
      程序功能：截取全角和半角（汉字和英文）混合的字符串以避免乱码
      ------------------------------------------------------
     */

    public function substr_cut($str_cut, $length) {
        if (strlen($str_cut) > $length) {
            for ($i = 0; $i < $length; $i++) {
                if (ord($str_cut[$i]) > 128)
                    $i = $i + 2;
            }
            $str_cut = substr($str_cut, 0, $i) . "...";
        }
        return $str_cut;
    }
    
    public function index(){
        $Type = M('type');
        $News = M('news');
        $Notice = M('notice');
        $Email = M('email');
        $notice = $Notice->find();
        $email = $Email->find();
        $_SESSION['email'] = $email;
        $types = $Type->where('state=1')->select();
        for($i=0; $i<count($types); $i++) {
            $typeid = $types[$i]['id'];
            $news = $News->where('type='.$typeid.' and state=1 ')->field('id, title, time')->order('time')->select();
            if($news == null) {
                array_splice($types, $i, 1);
            }else {
                for($j=0; $j<count($news); $j++) {
                    $news[$j]['title'] = $this->substr_cut($news[$j]['title'], 120);
                }
                $types[$i]['news'] = $news;
            }
        }
        $this->assign('types', $types);
        $this->assign('notice', $notice);
        
//        dump($types);
        $this->display();
    }
    
    public function detail() {
        $newsid = $_GET['id'];
        $model = new Model();
        $detail = $model->query(" select news.id as id, news.title as title, type.type as type,news.content,news.time as time,admin.admin as publisher "
                . " from blogs_news as news, blogs_admin as admin,blogs_type as type "
                . " where news.id = ".$newsid." and news.publisher = admin.id and type.id = news.type ");
//        echo $model->getLastSql();
//        $News = M('news');
        
        //查询上一条信息，下一条信息
        $pnews = $model->query(" select n2.id as id, n2.title as title, n2.time as time "
                . "from blogs_news as n1 join blogs_news as n2 where n1.id=".$newsid." and n2.type=n1.type and n2.state=1 and n1.time>n2.time order by n2.time desc limit 1");
        $nnews = $model->query(" select n2.id as id, n2.title as title, n2.time as time "
                . "from blogs_news as n1 join blogs_news as n2 where n1.id=".$newsid." and n2.type=n1.type and n2.state=1 and n1.time<n2.time order by n2.time limit 1 ");
        $this->assign('detail', $detail[0]);
        if($pnews[0] == null) {
            $this->assign('pnews', 'NULL');
        }else {
            $this->assign('pnews', $pnews[0]);
        }
        if($nnews[0] == null) {
            $this->assign('nnews', 'NULL');
        }else {
            $this->assign('nnews', $nnews[0]);
        }
        //查询留言
        $notes = $model->query(" select note.id, note.note,note.name, note.fnote, note.time, note.ftime, admin.admin as fname "
                . "from blogs_note as note, blogs_admin as admin where note.nid = ".$newsid." and note.state = 1 and note.fname = admin.id; ");
        $this->assign('notes',$notes);
        $this->display();
    }
    public function comment() {
        $Note = M('note');
        $Note->nid = $_POST['nid'];
        $content = str_replace('<', "＜", $_POST['content']);
        $content = str_replace('>', "＞", $content);
//        $content = str_replace('\r', "", $content)
        $content = preg_replace('/\r|\n/', " ",$content);
//        $content = str_replace(' ', "",$content);
        $Note->note = $content;
        $Note->name = $_POST['name'];
        $Note->email = $_POST['email'];
        $Note->time = date('Y-m-d', time());
        $Note->add();
        echo 'success';
    }
    public function search_news() {
        $search_title = $_POST['search_title'];
        $model = new Model();
        $news = $model->query("select news.title, news.id, type.type "
                . "from blogs_news as news, blogs_type as type "
                . "where news.type = type.id and  news.title like '%".$search_title."%'  and news.state = 1;");
//        dump($news);
        $this->assign('condition', $search_title);
        $this->assign('news', $news);
        $this->display();
    }
    
    public function editor() {
        $this->display();
    }
    
    public function ueditor(){
        
    	$data = new \Org\Util\Ueditor();
		echo $data->output();
    }
    
}