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
        <style type='text/css'>
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
               
                $("input[name='search_submit']").click(function() {
                    var st = $.trim($("input[name='search_title']").val());
                    if (st === '') {
                        return false;
                    }
                });
            });
        </script>
    </head>
    <body id="body" class="home" style='min-width:960px'>
        <!-- #site-container -->
        <div id="site-container"> 

            <!-- #header-top -->
            <div id="header-top" class="clearfix">
                <div class="left"> 硬件与描述语言课程网站 | <?php echo ($_SESSION[email][email]); ?>  </div>
            </div>
            <!-- /#header-top -->

            <!-- #header -->
            <header id="header" class="clearfix"> 

                <!-- #primary-nav -->

                <div style='padding:10px; height:30px'>
                    <div style='float:left; width:70%; font-size:18px; font-weight:bold' class="current-menu-item"><a href="/Blogs" >首页</a></div>
                    <div style='float:left; width:30%'>
                        <form action="/Blogs/Home/Index/search_news" method="post">
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
                        <div id="callout">

                            <h2>简讯通知</h2>

                            <p style="font-size: 19px">&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php if(empty($notice["content"])): ?>欢迎进入硬件与描述语言课程网站<?php endif; ?>
                            <?php echo ($notice["content"]); ?>
                            </p>
                        </div>

                    </div>
                    <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div id="home-blocks" class="clearfix" style="padding-bottom: 10px">
                            <h3 class="deco"><span class="outer"><span class="inner"><?php echo ($vo["type"]); ?></span></span></h3>
                            <div style="">
                                <?php if(is_array($vo["news"])): $i = 0; $__LIST__ = $vo["news"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$new): $mod = ($i % 2 );++$i;?><div id="callout">
                                        <div style='width:90%; float: left'>
                                            <a href='/Blogs/Home/Index/detail?id=<?php echo ($new["id"]); ?>'><?php echo ($new["title"]); ?></a>
                                        </div>
                                        <!--                                        <div style='width:10%; float: left'>
                                                                                    <?php echo ($new["time"]); ?>
                                                                                </div>-->
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </section>
                <!-- /#content --> 
            </div>
            <!-- /#primary --> 

            <!-- #footer-bottom -->
            <footer id="footer-bottom" class="clearfix">
                <nav id="footer-nav">
                    <ul class="nav-footer">
                        <li><a href="index-2.html" >Homepage</a></li>
                        <li><a href="#">Features</a></li>
                        <li><a href="portfolio.html" >Portfolio</a></li>
                        <li><a href="blog.html" >Blog</a></li>
                        <li><a href="contact.html" >Contact</a></li>
                    </ul>
                </nav>
                <div id="copyright">&copy; Copyright &copy; 2013.Company name All rights reserved. Collect from </div>
            </footer>
            <!-- /#footer-bottom --> 

        </div>
        <!-- /#container --> 
    </body>
</html>