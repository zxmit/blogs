<?php if (!defined('THINK_PATH')) exit();?><link href="/Blogs/Public/admin/css/note.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/Blogs/Public/admin/js/note.js" ></script>
<script type="text/javascript">
   $(document).ready(function() {
      $(".GoPage").click(function() {
            var tp = $(this).attr("tp");
            
            if(tp === '1') {
                var page = $(this).attr("rel");
            } else {
                var page = $("select[name=pageurl]").val();
            }
            $("#right").load("/Blogs/admin.php/Note/note_all?page="+page+"");
        }); 
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
    <div style="width:81%;float:left;">
        <font style="float: right;">
        <page><?php echo ($page); ?></page>/<num><?php echo ($totalPage); ?></num>&nbsp;
        <?php if($page != 1): ?><span style="cursor: pointer" id="pre" class="GoPage" tp="1" rel="<?php echo ($page-1); ?>">上一页</span>&nbsp;<?php endif; ?>
        <?php if($page != $totalPage): ?><span style="cursor: pointer" id="next" class="GoPage" tp="1" rel="<?php echo ($page+1); ?>">下一页</span>&nbsp;<?php endif; ?>
        <select name="pageurl">
            <?php $__FOR_START_1626__=1;$__FOR_END_1626__=$totalPage+1;for($i=$__FOR_START_1626__;$i < $__FOR_END_1626__;$i+=1){ ?><option value="<?php echo ($i); ?>" <?php echo ($page==$i? 'selected':''); ?> ><?php echo ($i); ?></option><?php } ?>
        </select>&nbsp;
        <input type="button" tp="2" class="GoPage" name="submit" value="跳转"/>
        </font>
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
                </div>
            </div>
        </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>