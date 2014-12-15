<?php if (!defined('THINK_PATH')) exit();?><script src="/Blogs/Public/js/jquery-2.0.2.js" ></script>
<script src="/Blogs/Public/ueditor/ueditor.config.js" ></script>   
<script src="/Blogs/Public/ueditor/ueditor.all.min.js" ></script>
<!--<script src="/Blogs/Public/admin/js/message.publish.js"></script>-->
<script>
    $(function(){
        var ue = UE.getEditor('container',{
            serverUrl :'<?php echo U('Home/Index/ueditor');?>'
        });
        
        $("#btnadd").click(function() {
        var title = $.trim($("input[name=title]").val());
        var type = $.trim($("select[name=type]").val());
        var nid = 0;
        var content = $.trim(ue.getContent());
        $.post("/Blogs/admin.php/Message/publish_messageadd", {
            title: title,
            type: type,
            content: content,
            nid: nid
        }, function(data) {
            
            if (data === '1') {
                window.location.href="/Blogs/admin.php/Message/message_list";
            } else if (data === '0') {
                alert("服务器出错，请稍后再试!!!");
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
<div style="width:99%;height: 30px;line-height: 30px;font-size: 14px;font-weight: bold;color: blue;">
    <div style="margin-left: 8px;">信息发布</div>
    <div style="clear: both;"></div>
</div>
<form method="post">
    <div class="row">
        <span >标题：</span><input style="height:28px; width: 87%;"  type="text" name="title" value="">
    </div>
    <div class="row">
        <span>类别：</span><select name="type" style="width: 87%; height: 28px;">
            <option value="0">------所有类型------</option>
            <?php if(is_array($type_list)): $i = 0; $__LIST__ = $type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["type"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>   
    </div>
    <div class="row">
        <script id="container" name="content" type="text/plain">
            开始使用
        </script>
    </div>
</form>
<div class="row">
    <span style="margin-right:18px;">
        <input type="submit" id="btnadd" rel="1" style="width:60px; height: 24px;" value="提交"></button></span><span style="margin-right:18px;"><button id="reset" style="width:60px; height: 24px;">重置</button></span></span>
</div>