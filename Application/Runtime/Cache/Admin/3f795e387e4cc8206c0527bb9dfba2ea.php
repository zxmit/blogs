<?php if (!defined('THINK_PATH')) exit();?><link href="/Blogs/Public/admin/css/note.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/Blogs/Public/admin/js/note.js" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        //关闭回复框
        $('.close').click(function() {
            $('.note_replayBtn:hidden').show();
            $('.close:visible').hide();
            $(this).parents('.note_item').find('.reply').hide();
            return false;
        });
        //显示回复
        $('.note_replayBtn').click(function() {
            $('.reply:visible').hide();
            $('.note_replayBtn:hidden').show();
            $('.close:visible').hide();
            $(this).hide();
            $(this).next().show();
            $(this).parents('.note_item').find('.reply').show();
            $(this).parents('.note_item').find('.content').focus();
            return false;
        });
        //回复留言
        $('.replyBtn').click(function() {
//            alert('');
           var note_id = $(this).parents('.note_message_info').find("input[name='note_id']").val();
           var note_reply = $.trim($(this).parents('.reply').find('.content').html());
//           alert(note_reply +note_id + "  " + news_id);
           if(note_reply !== '') {
               $(this).val('Loading...');
               $(this).attr("disabled", true);
//               var rediv = $(this);
               $.post('/Blogs/admin.php/Note/reply', {id:note_id, reply:note_reply}, function(data) {
                   if(data === 'false') {
                       $(this).removeAttr('disabled');
                       alert('网络繁忙，请稍后再试');
                   }else {
                       $("#right").load('/Blogs/admin.php/Note/note_list');
                   }
                });
           }
        });
//        
    });
</script>
<div class="note_title">
    <div class="note_title_content">信息管理</div>
    <div style="clear: both;"></div>
</div>

<div class="note_message_head">
    
    <div style="width:6%;float:left;">
        <div style="margin-left: 10px;margin-top:4px;">
            <?php if($new == 1): ?><button class="new_note" style="width:60px;height: 22px;" disabled="disabled">最新留言</button>
                <?php else: ?>
                <button class="new_note" style="width:60px;height: 22px;">最新留言</button><?php endif; ?></div>
    </div>
    <div style="width:6%;float:left;">
        <div style="margin-left: 5px;margin-top:4px;">
            <?php if($all == 1): ?><button class="all_note" style="width:60px;height: 22px;" disabled="disabled">全部留言</button>
                <?php else: ?>
                <button class="all_note" style="width:60px;height: 22px;" >全部留言</button><?php endif; ?>
            </div>
    </div>
    <div style="width:6%;float:left;">
        <div style="margin-top:4px;">
            <?php if($theme == 1): ?><button  class="theme_note" style="width:70px;height: 22px;" disabled="disabled" >按主题查询</button>
            <?php else: ?>
            <button  class="theme_note" style="width:70px;height: 22px;">按主题查询</button><?php endif; ?>
        </div>
    </div>
    
    <div style="clear:both;"></div>
</div>
<?php if(is_array($notes)): $i = 0; $__LIST__ = $notes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="note_message_info">
        <input type="hidden" name="note_id" value="<?php echo ($vo["id"]); ?>">
        <input type="hidden" name="news_id" value="<?php echo ($vo["nid"]); ?>">
        <div class="note_item">
            <div>
                <div class="content">
                    <span><a href='/Blogs/admin.php/Note/note_detail?nid=<?php echo ($vo["nid"]); ?>&id=<?php echo ($vo["id"]); ?>' class='detail_link' ><?php echo ($vo["name"]); ?> 回复：<?php echo ($vo["note"]); ?></a></span>
                </div>
                <div class="time">
                    <span><?php echo ($vo["time"]); ?></span>
                </div>
            </div>
            <div>
                <div class="title">
                    <span>
                        回复相关项目：“<a target="_blank" href="/Blogs/index.php/Index/detail?id=<?php echo ($vo["nid"]); ?>" style="color:#000; font-size: 13px;"><?php echo ($vo["title"]); ?></a>”
                    </span>
                </div>
                <div class="operate">
                    <span class="note_item_del">
                        <img src="/Blogs/Public/admin/images/close_normal.jpg">
                        <a href="/Blogs/admin.php/Note/note_del?id=<?php echo ($vo["id"]); ?>" class="note_del" >删除</a>
                    </span>
                    <span>
                        <img src="/Blogs/Public/admin/images/replyPop_781acc0d.gif">
                        <a href="#" class="note_replayBtn">回复</a>
                        <a href="#" class="close">关闭</a>
                    </span>
                </div>
            </div>
            <div class="reply">
                <div class="replydiv">
                    <div contenteditable="true" class="content">
                    </div>
                </div>
                <div class="replydiv2">
                    <div class="note_replyworming">
                        回复不能超过150字
                    </div>
                    
                    <div class="btndiv">
                        <input type="button" class="replyBtn" value="回复">
                    </div>
                </div>
            </div>
        </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>