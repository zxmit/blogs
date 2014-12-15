<?php
/**
 * Description of NoteAction
 *
 * @author xiaoming
 */
namespace Admin\Controller;
use Think\Model;

class NoteController extends CommonController {
    /*
      ------------------------------------------------------
      参数：
      $str_cut    需要截断的字符串
      $length     允许字符串显示的最大长度
      程序功能：截取全角和半角（汉字和英文）混合的字符串以避免乱码
      ------------------------------------------------------
     */
    public function note_condition() {
        $this->display();
    }
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
    
    public function note() {
        $num = $_GET['num'];
        
        if($num == 0) {
            $this->assign('all', 1);
            $this->note_all();
        }else {
            $this->assign('new', 1);
            $this->note_new();
        }
    }
    
    public function note_new() {
        $model = new Model();
        $notes = $model->query(" select note.id, note.note, note.time, note.name, note.nid, news.title "
                . "from blogs_note as note, blogs_news as news where note.state=0 and note.nid = news.id order by note.time desc ");
        for($i=0; $i<count($notes); $i++) {
            $notes[$i]['note'] = $this->substr_cut($notes[$i]['note'], 80);
        }
        $this->assign('new', 1);
        $this->assign('notes', $notes);
        $this->display('note_new');
    }
    
    public function note_all() {
        
        $pageSize = 8;
        $page = $_GET['page'];
        
        if($page == 0) {
            $page = 1;
        }
        $c = M('note');
        $count = $c->where('state!=2')->count();
        $model = new Model();
        $totalPage = ceil($count/$pageSize);
        $from = ($page-1)*$pageSize;
        if($totalPage == $page ) {
            $pageSize = $count;
        }
        $notes =  $model->query(" select note.id, note.note, note.time, note.name, note.nid, news.title "
                . "from blogs_note as note, blogs_news as news where note.state!=2 and note.nid = news.id order by note.time desc limit ".$from." , ".$pageSize." ");
        for($i=0; $i<count($notes); $i++) {
            $notes[$i]['note'] = $this->substr_cut($notes[$i]['note'], 80);
        }
        $this->assign('page', $page);
        $this->assign('totalPage', $totalPage);
        $this->assign('all', 1);
        $this->assign('notes', $notes);
        $this->display('note_all');
    }
    
    public function note_theme() {
        $model = new Model();
        $pageSize = 8;
        $page = $_GET['page'];
        
        if($page == 0) {
            $page = 1;
        }
        $count = $model->query(" select count(*) as count from "
                . "(select news.id from blogs_news as news, blogs_note as note where note.state!=2 and note.nid = news.id group by news.id) as c ");
        
        $totalPage = ceil($count[0]['count']/$pageSize);
        $from = ($page-1)*$pageSize;
        if($totalPage == $page ) {
            $pageSize = $count[0]['count'];
        }
        
        $notes = $model->query(" select count(*) as count, note.nid, news.title,notel.name, notel.time, notel.note "
                . "from blogs_note as note, blogs_news as news, "
                . "(select n.id as id, n.time as time, n.name as name, n.note as note from blogs_note as n where n.state!=2 order by n.time desc) as notel "
                . "where note.id = notel.id and note.state!=2 and note.nid=news.id group by nid order by notel.time desc limit ".$from." , ".$pageSize." ");
        $len = count($notes);
        for($i=0; $i<$len; $i++) {
            $notes[$i]['note'] = $this->substr_cut($notes[$i]['note'], 80);
            $notes[$i]['title'] = $this->substr_cut($notes[$i]['title'], 80);
        }
        $this->assign('theme', 1);
        $this->assign('page', $page);
        $this->assign('totalPage', $totalPage);
        $this->assign('notes', $notes);
        $this->display();
    }
    
    public function note_del() {
        $id = $_GET['id'];
        $Note = M('note');
        $Note->state = 2;
        $Note->where('id='.$id)->save();
        $this->note_all();
    }
    
    public function reply() {
        $Note = M('note');
        $Note->id = $_POST['id'];
        $Note->fnote = $_POST['reply'];
        $Note->ftime = date('Y-m-d', time());
        $Note->fname = $_SESSION['admin']['id'];
        $Note->state = 1;
        $result = $Note->save();
        echo $result;
    }
    
    public function note_detail() {
        $model = new Model();
        $nid = $_GET['nid'];
        $id = $_GET['id'];
        $news = $model->query(" select news.id, news.title, news.content, news.time, type.type "
                . "from blogs_news as news, blogs_type as type where news.id = ".$nid." and news.type = type.id ");
        $news[0]['content'] = $this->substr_cut($news[0]['content'], 200);
        $notes = $model->query(" select * from blogs_note where nid = ".$nid." and state != 2 ");
        $news[0]['notes'] = $notes;
        $Note = M('note');
        $Note->state = 1;
        $Note->id = $id;
        $Note->save();
        $this->assign('news', $news[0]);
        $this->display();
    }
    
}
