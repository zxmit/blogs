<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>后台管理系统</title>
        <link href="/Blogs/Public/admin/css/style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="/Blogs/Public/js/jquery-1.10.2.min.js"></script>
        <script src="/Blogs/Public/admin/js/message.list.js"></script>
            <style>
    a{
        text-decoration: none;
        color: #666666;
    }
    .divOver{
        background: #F6F4F6;
        color: #666666;
        /*border-left:2px solid #ddd;*/
    }

    .divclick{
        background: #E0ECF9;
        color: #666666;
        /*border-left:2px solid #ddd;*/
    }
</style>
        </head>

    <body id="right">
<input type="hidden" value="/Blogs" id="root" />
<div style="width:99%;height: 30px;line-height: 30px;float: left;font-size: 14px;font-weight: bold;color: blue;">
    <div style="margin-left: 8px; float: left; width: 20%;">信息管理</div>
    <div style="width: 75%;float:right;height: 28px;line-height: 28px;">
        <select name="type" style="width: 60%; height: 28px;">
            <option value="0">------所有类型-----</option>
            <?php if(is_array($type_list)): $i = 0; $__LIST__ = $type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"<?php if($vo["id"] == $id): ?>selected<?php endif; ?>><?php echo ($vo["type"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>

        <select name="state" style="width: 20%; height: 28px;">
            <option value="0" <?php if($state == 0): ?>selected<?php endif; ?>>---所有状态---</option>
            <option value="1" <?php if($state == 1): ?>selected<?php endif; ?>>启用</option>
            <option value="2" <?php if($state == 2): ?>selected<?php endif; ?>>关闭</option>
        </select>

        <button id="search" style="margin-left: 8px; margin-right: 8px; width:60px; height:28px;">检索</button>
        <button id="public" style=" margin-left: 0px; margin-right: 8px; width:60px; height: 28px;">发布</button>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="message_info" style="width:99%;height: 30px;line-height: 30px;float: left;margin-top:8px;background:#c1d9f3;">

    <div style="width:6%;float:left;">
        <div style="margin-left: 10px;margin-top:4px;"><button state ="1" class="delete" style="width:50px;height: 22px;">删除</button></div>
    </div>
    <div style="width:6%;float:left;">
        <div style="margin-left: 5px;margin-top:4px;"><button state="1" class="minitab" style="width:50px;height: 22px;">启用</button></div>
    </div>
    <div style="width:6%;float:left;">
        <div style="margin-left: 5px;margin-top:4px;"><button state="1" class="close" style="width:50px;height: 22px;">关闭</button></div>
    </div>
    <div style="width:81%;float:left;">
        <font style="float: right;">
        <page><?php echo ($page); ?></page>/<num><?php echo ($num1); ?></num>&nbsp;<span id="pre" class="GoPage" tp="1" rel="<?php echo ($page-1); ?>">上一页</span>&nbsp;<span id="next" class="GoPage" tp="1" rel="<?php echo ($page+1); ?>">下一页</span>&nbsp;
        <select name="pageurl">
            <option value="<?php echo ($page); ?>"><?php echo ($page); ?></option>
            <?php $__FOR_START_15745__=1;$__FOR_END_15745__=$num1+1;for($i=$__FOR_START_15745__;$i < $__FOR_END_15745__;$i+=1){ ?><option value="<?php echo ($i); ?>"><?php echo ($i); ?></option><?php } ?>
        </select>&nbsp;
        <input type="button" tp="2" class="GoPage" name="submit" value="跳转"/>
        </font>
    </div>
    <div style="clear:both;"></div>
</div>

<div style="width:99%;height: 23px;line-height: 23px;float: left;margin-top:8px;background: #F2F4F6;font-size: 14px;">
    <div style="width:4%;float:left; text-align: center;">
        <input type="checkbox" name="checkboxall" id="checkboxall">
    </div>
    <div style="width:6%;float:left;text-align: center;">
        <div style="border-right: 1px solid #ddd; border-left: 1px solid #ddd;">状态</div>
    </div>
    <div style="width:10%;float:left;text-align: center;">
        <div style="border-right: 1px solid #ddd;">时间</div>
    </div>
    <div style="width:64%;float:left;text-align: left;">
        <div style="border-right: 1px solid #ddd;margin-left:10px;">标题</div>
    </div>
    <div style="width:15%;float:left;text-align: center;">
        <div style="">操作</div>
    </div>
</div>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="message_info mk" style="width:99%;height: 23px;line-height: 23px;float: left;margin-top:8px;border-bottom: 1px solid #ddd;font-size: 14px;">
        <div style="width:4%;float:left; text-align: center;" class="first">
            <input type="checkbox" name="checkbox" class="checkbox" nid="<?php echo ($vo["id"]); ?>">
        </div>
        <div style="width:6%;float:left;text-align: center;">
            <div class="state">
                <?php if($vo["state"] == 1): ?>已启用<?php elseif($vo["state"] == 2): ?>
                    已关闭<?php endif; ?>
            </div>
        </div>
        <div style="width:10%;float:left;text-align: center;">
            <div ><?php echo ($vo["time"]); ?></div>
        </div>
        <div style="width:64%;float:left;text-align: left;">
            <div style="margin-left:10px;"><a href="/Blogs/Home/Index/detail/id/<?php echo ($vo["id"]); ?>" target="__bank()" title="<?php echo ($vo["title"]); ?>"><?php echo ($vo["title"]); ?></a></div>
        </div>
        <div style="width:15%;float:left;text-align: center;">
            <div class="operation" nid = "<?php echo ($vo["id"]); ?>">
                <span class="update" style="cursor: pointer">修改</span>
                <span class="delete" style="cursor: pointer" state="2">删除</span>
                <?php if($vo["state"] == 1): ?><span class="close" style="cursor: pointer" state="2">关闭</span>
                    <?php elseif($vo["state"] == 2): ?>
                    <span class="minitab" style="cursor: pointer" state="2">启用</span><?php endif; ?>
            </div>
        </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
</body>