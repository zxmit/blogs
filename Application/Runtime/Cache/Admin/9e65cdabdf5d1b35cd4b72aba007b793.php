<?php if (!defined('THINK_PATH')) exit();?><link href="/Blogs/Public/admin/css/note.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/Blogs/Public/admin/js/note.js" ></script>
<style>
    span{
        line-height: 20px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        var id, nid;
        $('.reply_btn').click(function() {
            id = $(this).parents('.note_items').find("input[name='reply_id']").val();
            nid = $("input[name='reply_nid']").val();
            var name = $(this).parents('.note_items').find('.reply_name').html();
            var content = $.trim($(this).parents('.note_items').find('.reply_fnote').html());
            if(content === '') {
                $('.reply_content').text("回复 "+name+":");
            }else {
                $('.reply_content').text("回复 "+name+":"+content.replace('&nbsp;',''));
            }
            $('.reply_div').show();
        });
        $('.reply_content').focusin(function() {
           $('.submitBtn').removeAttr('disabled');
           $(this).html(''); 
        });
        $(".submitBtn").click(function() {
            var content = $.trim($(".reply_content").html());
            $(this).attr('disabled', true);
            if(content === '') {
                return false;
            }
            alert('')
            $.post('/Blogs/admin.php/Note/reply', {id:id, reply:content}, function() {
                $('.reply_div').hide();
                $('#right').load("/Blogs/admin.php/Note/note_detail?id="+id+"&nid="+nid+"");
                $(this).removeAttr('disabled');
            });
        });
    });
</script>
<div>
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
        <div style="width:81%;float:left;">
            <font style="float: right;">
            
            </font>
        </div>
        <div style="clear:both;"></div>
        <div style="padding: 10px; position:relative">
            <input type="hidden" value="<?php echo ($news["id"]); ?>" name="reply_nid" />
            <div class="block_home_post" style="padding-bottom: 10px">

                <div class="text">
                    <p class="title"><?php echo ($news["title"]); ?></p>
                    <div class="date"><p><?php echo ($news["time"]); ?> | 来源：<?php echo ($news["type"]); ?></p></div>
                </div>
            </div>
            <div class="intro">
                &nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($news["content"]); ?>                </div>
            <br/>
            <div style="position: relative;/* padding-top: 13px; */ border: 1px solid #ddd; background-color: #f7f8fa">
                <div>
                    <span style="position: absolute; top: -10px;font-size: 16px;left: 30px;color: #ddd;">◆</span>
                    <span style="position: absolute; top: -9px;font-size: 16px;left: 30px;color: #f7f7f7;">◆</span>
                </div>
                <?php if(is_array($news["notes"])): $i = 0; $__LIST__ = $news["notes"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div style="padding: 10px 20px 10px 20px;" class="note_items">
                        <input type="hidden" value="<?php echo ($vo["id"]); ?>" name="reply_id" />
                        <div style=" border-bottom: 1px dotted #ddd">
                            <div style="width: 100%;">
                                <span style="font-size: 16px">
                                    <a class="reply_name" href="#" style="color: #2d64b3"><?php echo ($vo["name"]); ?></a>
                                </span>
                                <span style="font-size: 14px; color: #858585"><?php echo ($vo["time"]); ?></span>                                    
                            </div>
                            <div style="text-align: left;">
                                <span style="font-size: 12px;"><?php echo ($vo["note"]); ?></span>
                            </div>
                            <div style="text-align: right;">
                             <?php if($vo["fname"] == ''): ?><span class="reply_btn" style="font-size: 13px;cursor: pointer; text-align: right">回复</span><?php endif; ?>
                                </div>
                        
                        <?php if($vo["fname"] != ''): ?><div style="margin: 0 10px 0 10px">
                            <div style="width: 680px;">
                                <span style="font-size: 16px">
                                    <a href="#" style="color: #2d64b3"><?php echo ($_SESSION[admin][admin]); ?></a>
                                </span>
                                <span style="font-size: 14px; color: #858585"><?php echo ($vo["ftime"]); ?></span>                                    
                            </div>
                            <div style="text-align: left">
                                <span class="reply_fnote" style="font-size: 12px;"><?php echo ($vo["fnote"]); ?></span>
                            </div>
                            <div style="text-align: right">
                                <span style="font-size: 13px;cursor: pointer; text-align: right" class="reply_btn">回复</span>
                                </div>
                        
                            
                            </div><?php endif; ?>
                            </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="reply_div" style="display:none">
                <div style="padding: 10px 28px 10px 20px;">
                    <div>
                        <div class="reply_content"  contenteditable="true" style="padding-left: 5px;line-height: 18px; min-height: 56px;width: 100%;color: #000;border: 2px solid #D6DFFB;background-color: #fff;">
                            
                        </div>
                    </div>
                </div>
                <div style="padding: 10px 20px 10px 20px;text-align: right;font-size: 16px;font-weight: bold;">
                    <input class="submitBtn" disabled="disabled" type="button" style="border: 1px solid white;background-color: rgb(81, 81, 219);height: 30px;width: 60px;cursor: pointer;" value="回复">
                </div>
                </div>
            </div>
        </div>