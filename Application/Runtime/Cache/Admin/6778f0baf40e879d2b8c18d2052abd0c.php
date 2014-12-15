<?php if (!defined('THINK_PATH')) exit();?><div id="left">
    <div class="lefta">
                            <p style="line-height: 24px; font-size: 12px; margin-top: 2px; margin-left: 5px;">您好，<?php echo ($_SESSION[admin][admin]); ?></p>
                            <p style="line-height: 24px; font-size: 12px; margin-top: 3px; margin-left: 3px; color: blue;">
                                <a href="/Blogs/admin.php/Note/note?num=<?php echo ($num); ?>" id="show_notes" style="color:blue">【留言信息(<?php echo ($num); ?>)】</a> 
                                <a href="/Blogs/admin.php/Login/doExit">【退出】</a>
                            </p>
                        </div>
                        <div class="leftb">
                            <div class="nav" id="1" style="width:100%;height: 25px;line-height: 25px;color: #1E5494; cursor: pointer;">
                                <a href="/Blogs/admin.php/Message/message_list" target="right">信息管理</a>
                            </div>
                            <div class="nav" id="2" style="width:100%;height: 25px;line-height: 25px;color: #1E5494; cursor: pointer;">
                                <a href="/Blogs/admin.php/Classify/classify_list" target="right">分类管理</a>
                            </div>
                            <div class="nav" id="3" style="width:100%;height: 25px;line-height: 25px;color: #1E5494; cursor: pointer;">
                                <a href="/Blogs/admin.php/Base/medpwd" target="right">密码与邮箱</a>
                            </div>
                        </div>
                    </div>