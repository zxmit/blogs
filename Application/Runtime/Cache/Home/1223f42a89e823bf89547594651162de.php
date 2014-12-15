<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html dir="ltr" lang="en-US">

    <head>
        <meta charset="UTF-8" />
        <title>硬件与描述语言课程</title>
        <!-- Stylesheet -->
        <link rel="stylesheet" type="text/css" media="all" href="/Blogs/Public/home/css/style.css" />
        <!--<link rel="stylesheet" type="text/css" media="all" href="/Blogs/Public/home/css/responsive.css" />-->
        <!-- Google Font -->
        <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>-->
        <!--[if lt IE 9]>
        <script src="js/html5.js" type="text/javascript"></script>
        <![endif]-->
        <script type="text/javascript" src="/Blogs/Public/js/jquery-1.10.2.min.js"></script>
        <style type="text/css">
            .title{
                text-align: center;
            }
            .title span {
                padding-left: 15px;
                padding-right: 15px;
            }
            .news_content {
                min-height: 580px;
                color: #433;
            }
            .news_comment {
                min-height: 210px;
                border-bottom: 1px dotted #CCC;
            }
            .news_comment_list {
                padding: 5px 50px 5px 10px;
                min-height: 50px;
                border-bottom: 1px dotted #CCC;
            }
            .input_search {
                background: #FDFDFD;
                border: 1px solid #D4D8D9;
                color: #7d7f80;
                text-shadow: 0 1px 0 rgba(255, 255, 255, 0.2);
                padding: 0;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.05) inset;
                border-radius: 1px;
                height: 23px;
                width: 200px;
                -moz-border-radius: 1px;
                -webkit-border-radius: 1px;
            }
            .search_btn {
                width: 48px;
                height:25px
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function() {
                $("input[type='button']").click(function() {

                    var name = $.trim($("input[name='name']").val());
                    var email = $.trim($("input[name='email']").val());
                    var content = $.trim($("#textarea").val());
                    var newsid = $("input[name='newsid']").val();
//                    alert(name + "  " + email + "  " + content);
                    if (email === '' || name === '' || content === '') {
                        $('#input_worming').html('姓名、邮箱、内容、不能为空');
                        $('#input_worming').show();
                        return false;
                    }
                    /**********
                     * 判断字符串长度，英文字符两个视为一个
                     *********/
                    var rlen = 0, len = content.length, charCode = -1;
                    for (var i = 0; i < len; i++) {
                        charCode = content.charCodeAt(i);
                        if (charCode >= 0 && charCode <= 128)
                            rlen += 1;
                        else
                            rlen += 2;
                    }
                    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-z]{2,4})$/;

                    if (!email.match(filter)) {
                        $('#input_worming').html('邮箱格式不正确');
                        $('#input_worming').show();
                        return false;
                    }
                    if (rlen > 300) {
                        $('#input_worming').html('内容不能超过150字');
                        $('#input_worming').show();
                        return false;
                    }
                    $('#input_worming').hide();
                    $.post('/Blogs/Home/Index/comment', {name: name, email: email, content: content, nid:newsid}, function(data) {
                        if (data === 'success') {
                            $("input[name='name']").val('');
                            $("input[name='email']").val('');
                            $("textarea").val('');
                            alert('留言成功');
                        } else {
                            alert('网络繁忙，请稍后再试');
                        }
                    });
                });
                $("input[name='search_submit']").click(function() {
                    var st = $.trim($("input[name='search_title']").val());
                    if (st === '') {
                        return false;
                    }
                });
            });
        </script>
    </head>
    <body id="body" class="home">
        <!-- #site-container -->
        <div id="site-container"> 
            <!-- #header-top -->
            <div id="header-top" class="clearfix">
                <div class="left"> 硬件与描述语言课程网站 | <?php echo ($_SESSION[email][email]); ?></div>
            </div>
            <!-- /#header-top --> 
            <!-- #header -->
            <header id="header" class="clearfix"> 
                <!-- #primary-nav -->
                <div style='padding:10px; height:30px'>
                    <div style='float:left; width:70%; font-size:18px; font-weight:bold' class="current-menu-item">
                        <a href="/Blogs/" >首页</a></div>
                    <div style='float:left; width:30%'>
                        <form action="/Blogs/index.php/Index/search_news" method="post">
                            <input class='input_search' type='text' name='search_title' />
                            <input class='input_search search_btn' name="search_submit" type='submit' value='搜索'>
                        </form>
                    </div>
                </div>
                <!-- #primary-nav --> 
            </header>
            <!-- /#header --> 
            <!-- #primary -->
            <div id="primary" class="clearfix"> 
                <!-- #content -->
                <section id="content" role="main" class="fullwidth">
                    <div id="feature" class="clearfix">
                        <div class="title">
                            <input type="hidden" value="<?php echo ($detail["id"]); ?>" name="newsid">
                            <h1><?php echo ($detail["title"]); ?></h1>
                            <p style="font-size: 12px; ">
                                <span><?php echo ($detail["time"]); ?></span>|
                                <span>来源：<?php echo ($detail["type"]); ?></span>|
                                <span>作者：<?php echo ($detail["publisher"]); ?></span>
                            </p>
                        </div>
                    </div>

                    <div id="home-blocks" class="clearfix">
                        <h3 class="line"></h3>
                        <div class="news_content">
                            <?php echo ($detail["content"]); ?>
                        </div>
                        <div>
                            <div style="float: left;width: 50%;">
                                <?php if($pnews !== 'NULL'): ?>上一篇：<a href='/Blogs/Home/Index/detail?id=<?php echo ($pnews["id"]); ?>'><?php echo ($pnews["title"]); ?></a><?php endif; ?>
                                &nbsp;
                            </div>
                            <div style="float: left;width: 50%;text-align: right;">
                                <?php if($nnews !== 'NULL'): ?>下一篇：<a href='/Blogs/Home/Index/detail?id=<?php echo ($nnews["id"]); ?>'><?php echo ($nnews["title"]); ?></a><?php endif; ?>
                                &nbsp;
                            </div>
                        </div>
                    </div>
                    <div id="home-blocks" class="clearfix" >
                        <h3 class="line"></h3>

                        <div class="news_comment">
                            <div style="height:50px">
                                姓名：<input type="text" name="name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                邮箱：<input type="text" name="email">
                                <span id='input_worming' style='padding-left:100px; color: red; display: none'>账号、邮箱不能为空</span>
                            </div>
                            <div style="height:100px">
                                内容：<textarea id="textarea" name="comment" style="width: 503px; height: 61px; margin: 0px;resize: none;"></textarea>
                                <span style="position: absolute;padding-top: 60px;padding-left: 15px;">内容不能超过150字</span>
                            </div>
                            <div style="width:62%; text-align: right">
                                <input  type="button" value="留言" style="width: 62px;font-size: 14px;font-weight: bold;">
                            </div>
                        </div>
                        <?php if(is_array($notes)): $i = 0; $__LIST__ = $notes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="news_comment_list">
                            <div>
                                <div style="height:25px">
                                    <font style="color:blue;text-align: left;font-size: 14px"><?php echo ($vo["name"]); ?></font>
                                    <font style="color:#c0c0c0; text-align: left"><?php echo ($vo["time"]); ?></font>
                                </div>
                                <div style="color:#433"><?php echo ($vo["note"]); ?></div>
                            </div>
                            <?php if($vo["fnote"] != ''): ?><div style="padding: 1px 10px 1px 15px;">
                                <div>
                                    <font style="color:blue;text-align: left;font-size: 13px;"><?php echo ($vo["fname"]); ?></font>
                                    <font style="color:#c0c0c0; text-align: left"><?php echo ($vo["ftime"]); ?></font>
                                </div>
                                <div style="color:#433"><?php echo ($vo["fnote"]); ?></div>
                            </div><?php endif; ?>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </section>
                <!-- /#content --> 
            </div>
            <!-- /#primary --> 

            <!-- #footer-bottom -->
            <footer id="footer-bottom" class="clearfix">
                <div id="copyright">&copy; Copyright &copy; 2013.Company name All rights reserved.Collect from </div>
            </footer>
            <!-- /#footer-bottom --> 

        </div>
        <!-- /#container --> 
    </body>
</html>