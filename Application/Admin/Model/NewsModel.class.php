<?php
namespace Admin\Model;
use Think\Model;
class NewsModel extends Model {
    protected $_auto = array ( 
        array('state','1'),  // 新增的时候把status字段设置为1
    );
    protected $_validate = array(
        array('title','require','标题必须填写！'), //默认情况下用正则进行验证
        array('title','','该信息已存在，无需重复添加！',0,'unique',1), // 在新增的时候验证name字段是否唯一
        array('type','require','请选择信息类别'), //默认情况下用正则进行验证
        array('content','require','内容不能为空'), //默认情况下用正则进行验证
    );


}
