/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    var root = $("#root").val();
    var flag = 1;
        var same = 1;
        //失去输入原始密码事件
        $("input[name=oldpwd]").focusout(function() {
            var oldpwd = $(this).val();
            var t = $(this);
            if (oldpwd == "") {
                $(".right").hide();
                $(".error").show();
                flag = 0;
//             t.focus();
            } else {
                //发送数据到后台校验
                $.post(root+"/admin.php/Base/check_oldPwd", {oldpwd: oldpwd}, function(data) {
                    if (data == 1) {
                        $(".error").hide();
                        $(".right").show();
                    } else {
                        $(".right").hide();
                        $(".error").show();
                        flag = 0;
//                      t.focus();
                    }
                });
            }
        });

        //失去输入新密码事件
        $("input[name=newpwd]").focusout(function() {
            var newpwd = $(this).val();
            if (newpwd == "") {
                $(".empty").show();
//             $(this).focus();
            } else {
                $(".empty").hide();
            }
        });

        //失去输入确认密码事件
        $("input[name=repwd]").focusout(function() {
            var repwd = $(this).val();
            var newpwd = $("input[name=newpwd]").val();
            if (repwd == "") {
                $(".different").show();
//             $(this).focus();
            } else if (repwd != newpwd) {
                $(".different").show();
//             $(this).focus();
                same = 0
            } else {
                $(".different").hide();
            }
        });

        $("#med").click(function() {
            var oldpwd = $("input[name=oldpwd]").val();
            var newpwd = $("input[name=newpwd]").val();
            var repwd = $("input[name=repwd]").val();
            if (oldpwd == "" || flag == 0) {
                $("input[name=oldpwd]").focus();
            }
            else if (newpwd == "") {
                $("input[name=newpwd]").focus();
            }
            else if (repwd == "" || same == 0) {
                $("input[name=repwd]").focus();
            }
            else {
                $.post(root+"/admin.php/Base/doMedPwd", {newpwd: newpwd}, function(data) {
                    if (data == 1) {
                        alert("密码修改成功,请记牢!!!");
                    } else if (data == 2) {
                        alert("新密码与原始密码一致!!!");
                    } else {
                        alert("服务器出错,请稍后再试!!!");
                    }
                });
            }
        });
        //点击邮箱添加
        $(".addemail").click(function() {
            $(".pwd").hide();
            $(".email").show();
        });
        //点击密码修改
        $(".updatepwd").click(function() {
            $(".email").hide();
            $(".pwd").show();
        });
        //邮箱添加
        $("#add").click(function() {
            var email = $("input[name='email']").val();
            if (email == "") {
                alert("请填写邮箱");
            } else {
                $.post(root+"/admin.php/Base/addemail", {email: email}, function(data) {
                    alert(data);
                    if (data == 1) {
                        alert("添加成功");
                        $("#right").laod(root+"/admin.php/Base/medpwd");
                    } else {
                        alert("服务器出错,请稍后再试!!!");
                    }
                });
            }
        });
        //修改邮箱
//   $("#upd_email").click(function(){
//      var t =  $(this).prev();
//      var oldemail = t.html();
//      t.html("<input type='text' value='"+oldemail+"' name='email'>");
//      $(this).attr("id","save");
//      $(this).html(保存);
//   });
        $(".email").delegate("#upd_email", "click", function() {
            var t = $(this).prev();
            var oldemail = t.html();
            t.html("<input type='text' value='" + oldemail + "' name='email'>");
            $(this).attr("id", "save");
        });
        $(".email").delegate("#save", "click", function() {
            var email = $(this).prev().children().val();
            if (email.trim() == "") {
                alert("邮箱不能为空");
            } else {
                $.post(root+"/admin.php/Base/update_email", {email: email}, function(data) {
                    if (data == 1) {
                        alert("修改成功");
                        $("#right").laod(root+"/admin.php/Base/medpwd");
                    } else if (data == 2) {
                        alert("邮箱为修改");
                    } else {
                        alert("服务器出错,请稍后再试!!!");
                    }
                });
            }
        });
});

