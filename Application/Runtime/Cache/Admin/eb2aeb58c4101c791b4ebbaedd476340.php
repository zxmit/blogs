<?php if (!defined('THINK_PATH')) exit();?><!--<link rel="stylesheet" href="/Blogs/Public/kindeditor-4.1.10/themes/default/default.css" />
<script src="/Blogs/Public/kindeditor-4.1.10/kindeditor-min.js"></script>
<script  src="/Blogs/Public/kindeditor-4.1.10/lang/zh_CN.js"></script>-->

<script type="text/javascript" src="/Blogs/Public/js/jquery-2.0.2.js"></script>
    <script type="text/javascript" src="/Blogs/Public/ueditor/ueditor.config.js"></script>    
    <script type="text/javascript" src="/Blogs/Public/ueditor/ueditor.all.min.js"></script>
    <script src="/Blogs/Public/admin/js/message.update.js"></script>
    <script type="text/javascript">
//    $(function(){
//        KindEditor.create('textarea[name="content"]');
//    });
//  
    $(function(){
        
        var ue = UE.getEditor('container',{
            serverUrl :'<?php echo U('Admin/Message/ueditor');?>'
        });
        $("#btnadd").click(function() {
        var title = $.trim($("input[name=title]").val());
        var type = $.trim($("select[name=type]").val());
        var nid = $(this).attr("nid");
        var content = ue.getContent();
        
//        var content = $.trim($(document.getElementsByTagName("iframe")[0].contentWindow.document.body).html());
            alert("/Blogs/admin.php/Message/message_list");
        $.post("/Blogs/admin.php/Message/update_news", {
            title: title,
            type: type,
            content: content,
            nid: nid
        }, function(data) {
            if (data === '1') {
                alert("修改成功");
//                $("#right").load("/Blogs/admin.php/Message/message_list");
                window.location.href="/Blogs/admin.php/Message/message_list";
            } else if (data === '0') {
                alert("服务器出错，请稍后再试!!!");
            } else {
                alert("内容为有改动!!!");
            }
        });
    });
        
    });
    
</script>
<style>
   .divOver{
                background:  #E0ECF9;
                color: #33ccff;
                /*border-left:2px solid #ddd;*/
            }
   .divClick{
              background: #0066cc;
              color: white;
              /*font-weight: bold;*/
            }
</style>
<input type="hidden" value="/Blogs" id="root" />
<div style="width:99%;height: 30px;line-height: 30px;font-size: 14px;font-weight: bold;color: blue;">
       <div style="margin-left: 8px;">信息修改</div>
            <div style="clear: both;"></div>
</div>
<form method="post">
    <?php if(is_array($new_list)): $i = 0; $__LIST__ = $new_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$new): $mod = ($i % 2 );++$i;?><div class="row">
        <span >标题：</span><input style="height:28px; width: 87%;"  type="text" name="title" value="<?php echo ($new["title"]); ?>">
    </div>
    <div class="row">
        <span>类别：</span><select name="type" style="width: 87%; height: 28px;">
                   <?php if(is_array($type_list)): $i = 0; $__LIST__ = $type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"<?php if($vo["id"] == $new_type): ?>selected<?php endif; ?>><?php echo ($vo["type"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>   
        
    </div>
    <div class="row">
        <script id="container" name="content" type="text/plain">
        <?php echo ($new["content"]); ?>
    </script>
        <!--<textarea name="content" style="width:90%;height:480px;"><?php echo ($new["content"]); ?></textarea>-->
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
</form>
    <div class="row">
        <span style="margin-right:18px;">
            <input type="submit" id="btnadd" nid=<?php echo ($nid); ?> style="width:60px; height: 24px;" value="提交">
        </span><span style="margin-right:18px;">
            <button id="reset" style="width:60px; height: 24px;">重置</button></span></span>
    </div>