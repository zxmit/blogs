<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
    $(function() {
        
    });
</script> 
<style type="text/css">
    .hk{
        line-height: 36px;
        margin-left: 12px;
    }
</style>
<div style="width:99%;height: 30px;line-height: 30px;font-size: 14px;font-weight: bold;color: blue;">
    <div style="margin-left: 8px;"> 密码与邮箱</div>

    <div style="clear: both;"></div>
</div>

<div  style="width:99%;height: 30px;line-height: 30px;float: left;margin-top:8px;background:#c1d9f3;">
    <div style="width:8%;float:left;">
        <div style="margin-left: 10px;margin-top:4px;"><button class="updatepwd" style="width:70px;height: 22px;">修改密码</button></div>
    </div>
    <div style="width:8%;float:left;">
        <div style="margin-left: 5px;margin-top:4px;"><button class="addemail" style="width:70px;height: 22px;">添加邮箱</button></div>
    </div>
    <div style="clear:both;"></div>
</div>

<div class="pwd">
    <div  style="width:99%;height: 30px;line-height: 30px;float: left;margin-top:8px;">
        <div class="hk ">
            原始密码：<input type="password" name="oldpwd"/>
            <span class="right" style="color: #00cc00;display: none">正确</span>
            <span class="error" style="color: #ff0000;display: none">不正确</span>
        </div>
    </div>
    <div  style="width:99%;height: 30px;line-height: 30px;float: left;margin-top:8px;">
        <div class="hk">
            新 密 码：<input type="password" name="newpwd"/>
            <span class="empty" style="color:#ff0000;display: none;">密码不能为空</span>
        </div>
    </div>
    <div  style="width:99%;height: 30px;line-height: 30px;float: left;margin-top:8px;">
        <div class="hk">
            确认密码：<input type="password" name="repwd"/>
            <span class="different" style="color: #ff0000;display: none">两次密码不一致</span>
        </div>
    </div>
    <div  style="width:99%;height: 30px;line-height: 30px;float: left;margin-top:8px;">
        <div class="hk">
            <button id="med">确认修改</button>
        </div>
    </div>
</div>

<div class="email" style="display:none;">
    <?php if(is_array($elist)): $i = 0; $__LIST__ = $elist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; endforeach; endif; else: echo "" ;endif; ?>
    <div  style="width:99%;height: 30px;line-height: 30px;float: left;margin-top:8px;">
        <?php if($vo["email"] == ''): ?><div class="hk">邮箱：<input type="text" name="email"/> <span> <button id="add">添加</button></span></div>
            <?php else: ?> <div class="hk">邮箱：<span><?php echo ($vo["email"]); ?></span>  <button id="upd_email">修改</button></div><?php endif; ?>
    </div>
</div>