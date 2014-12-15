<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <style>
            a{
                text-decoration: none;
                color: #666666;
            }
            .divOver{
                background: #F2F4F6;
                color: #33ccff;
                /*border-left:2px solid #ddd;*/
            }
            .divclick{
                background: #E0ECF9;
                color: #33ccff;
                /*border-left:2px solid #ddd;*/
            }
        </style>
        <script src="/Blogs/Public/admin/js/classify.js"></script>
    </head>
    <body id="right">
        <input type="hidden" value="/Blogs" id="root" />
        <div style="width:99%;height: 30px;line-height: 30px;float: left;font-size: 14px;font-weight: bold;color: blue;">
            <div style="margin-left: 8px; float: left; width: 20%;">分类管理</div>
            <div style="width: 30%;float:right;height: 28px;line-height: 28px;">
                <select name="type" style="width:35%; height: 28px;">
                    <option value="0" <?php if($type == 0): ?>selected<?php endif; ?>>---所有状态---</option>
                    <option value="1" <?php if($type == 1): ?>selected<?php endif; ?>>启用</option>
                    <option value="2" <?php if($type == 2): ?>selected<?php endif; ?>>关闭</option>
                </select>
                <button id="search" style="margin-left: 8px; margin-right: 8px; width:60px; height:28px;">检索</button>
            </div>
            <div style="clear: both;"></div>
        </div>


        <div class="classify_info" style="width:99%;height: 30px;line-height: 30px;float: left;margin-top:8px;background:#c1d9f3;">

            <div style="width:6%;float:left;">
                <div style="margin-left: 10px;"><button class="delete" style="width:50px;height: 22px;" state="1">删除</button></div>
            </div>
            <div style="width:6%;float:left;">
                <div style="margin-left: 5px;"><button class="minitab" style="width:50px;height: 22px;"state="1">启用</button></div>
            </div>
            <div style="width:6%;float:left;">
                <div style="margin-left: 5px;"><button class="close" style="width:50px;height: 22px;"state="1">关闭</button></div>
            </div>
            <div style="width:8%;float:left;">
                <div style="margin-left: 5px;"><button class="add_type" style="width:70px;height: 22px;">添加类型</button></div>
            </div>
            <div style="clear:both;"></div>
        </div>

        <div class="mk" style="width:99%;height: 23px;line-height: 23px;float: left;margin-top:8px;background: #F2F4F6;">
            <div style="width:4%;float:left;">
                <div style="margin-left: 10px;border-right: 1px solid #ddd;"><input type="checkbox" name="checkboxall" id="checkboxall"></div>
            </div>
            <div style="width:6%;float:left;text-align: center;">
                <div style="border-right: 1px solid #ddd;">状态</div>
            </div>
            <div style="width:6%;float:left;text-align: center;">
                <div style="border-right: 1px solid #ddd;">位置</div>
            </div>
            <div style="width:68%;float:left;text-align: left;">
                <div style="border-right: 1px solid #ddd;margin-left:10px;">类型</div>
            </div>
            <div style="width:15%;float:left;text-align: center;">
                <div style="">操作</div>
            </div>
        </div>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="classify_info mk" style="width:99%;height: 23px;line-height: 23px;float: left;margin-top:8px;border-bottom: 1px solid #ddd;font-size:14px">
            <div style="width:4%;float:left;">
                <div style="margin-left: 10px;border-right: 1px solid #ddd;"><input type="checkbox" name="checkbox" class="checkbox" nid="<?php echo ($vo["id"]); ?>"></div>
            </div>
            <div style="width:6%;float:left;text-align: center;">
                <div class="state">
                    <?php if($vo["state"] == 1): ?>启用<?php elseif($vo["state"] == 2): ?>
                        关闭<?php endif; ?>
                </div>
            </div>
            <div style="width:6%;float:left;text-align: center;">
                <?php echo ($vo["position"]); ?>
            </div>

            <div style="width:68%;float:left;text-align: left;">
                <div style="margin-left:10px;"><a href="#" title="<?php echo ($vo["type"]); ?>"><?php echo ($vo["type"]); ?></a></div>
            </div>
            <div style="width:15%;float:left;text-align: center;">
                <div class="operation" nid = "<?php echo ($vo["id"]); ?>">
                    <span class="update" style="cursor: pointer" >修改</span>
                    <span class="delete" style="cursor: pointer" state="2">删除</span>
                    <!--                       <span class="minitab" style="cursor: pointer">启用</span>&nbsp;&nbsp;
                                           <span class="close" style="cursor: pointer">关闭</span>-->

                    <?php if($vo["state"] == 1): ?><span class="close" style="cursor: pointer"state="2">关闭</span>
                        <?php elseif($vo["state"] == 2): ?>
                        <span class="minitab" style="cursor: pointer"state="2">启用</span><?php endif; ?>
                </div>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>


    <div class="add_typeview" style="width:99%;height: 23px;line-height: 23px;float: left;margin-top:8px;display: none;">
        <div style="width:5%;float:left;">
            <div style="margin-left: 10px;">类型:</div>
        </div>
        <div style="width:15%;float:left;">
            <div style="margin-left: 3px;"><input type="text" name="type"></div>
        </div>
        <div style="width:5%;float:left;">
            <div style="margin-left: 3px;"><button id="add_type">添加</button></div>
        </div>
        <div style="clear: both;"></div>
    </div>
</body>
</html>