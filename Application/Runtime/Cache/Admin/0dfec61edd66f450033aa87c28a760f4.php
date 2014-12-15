<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>后台登录平台</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <style type="text/css">
            body{
                background:  #00FFFF;
            }
            #login{
                width:450px;
                height:320px;
                border:#909090 1px solid;
                background:#00FFFF;
                color:#333;
                -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000')";  /* For IE 8 */
                filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000');  /* For IE 5.5 - 7 */
                -moz-box-shadow: 2px 2px 10px #909090;/* for firefox */
                -webkit-box-shadow: 2px 2px 10px #909090;/* for safari or chrome */
                box-shadow:2px 2px 10px #909090;/* for opera or ie9 */
               // width:450px;
               // height: 320px;
                position: absolute;
                top: 200px;
                left:35%;
                border-radius: 16px;
                //border: solid 3px #FFEFEF;
                //background: #FEFFFF;
            }
            .tt{
                width: 95%;
                height: 56px;
                line-height: 56px;
                font-size: 26px;
                font-weight: bold;
                text-transform: uppercase; 
                border-bottom: solid 1px #909090;
                color: #00C0E0;
                padding-left: 5%;
            }
            .nr{
                width: 83%;
                height: 200px;
                line-height: 32px;
                text-transform: uppercase; 
                border: solid 7px #ffffff;
                background: #0FFEAF;
                color: #000000;
                margin: 4%;
                font-size: 18px;
                padding-left: 5%;
                padding-top: 10px;
            }
            .nr p{
                margin: 20px;
            }
            .text{
                width: 240px;
                height: 26px;
                line-height:26px;
                padding: 5px;
                font-size: 18px;
            }
            .button{
                width:60px;
                height: 32px;
            }
        </style>
    </head>
    <body>
        <div id="login">
            <form method="POST" action="doLogin">
            <div class="tt">后台登录中心</div>
            <div class="nr">
                <p>账号：<input type="text" class="text" name="admin"/></p>
                <p>密码：<input type="password" class="text" name="pwd"/></p>
                <p style="text-align: center;"><input type="submit" name="sub" class="button" value="登录"/>&nbsp;&nbsp;<input type="reset" name="reset" class="button" value="重置"/></p>
            </div>
            </form>
        </div>
    </body>
</html>