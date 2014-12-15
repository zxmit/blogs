/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    
    var root = $("#root").val();
    $("#checkboxall").click(function() {
        var flag = this.checked;
        $(".checkbox").prop("checked", flag);
        var intL = $("input:checked:not('#checkAll')").length;
        if (intL > 0) {
            $("input[type=checkbox]:not('#checkAll')").each(function(index) {
                if (index > 0) {
                    var tt = $(this).parent().parent();
                    if (this.checked) {
                        tt.addClass("divclick");
                    }
                }
            });
        } else {
            $("input[type=checkbox]:not('#checkAll')").each(function(index) {
                var tt = $(this).parent().parent();
                if (!this.checked) {
                    tt.removeClass("divclick");
                }
            });
        }
    });


    //点击删除按钮

    $(".message_info").delegate(".delete", "click", function() {

        var state = $(this).attr('state');
        var ids = "(";
        var t = "";
        var tt = "";
        if (state === '2') {

            $(this).parents(".mk").children().children().prop("checked", true);
            ids += $(this).parents(".mk").children().children().attr("nid");
            $(this).parents(".mk").addClass("divclick");
            ids += ")";
            t = $(this).parents(".mk").children().eq(1).children();
            tt = $(this).parents(".mk").children().eq(4).children();
            if (!confirm("确定删除吗?")) {
                return false;
            }
        } else {
            var intL = $("input:checked:not('#checkAll')").length;
            if (intL !== 0) {
                if (!confirm("确定删除吗?")) {
                    return false;
                }
                $("input[type=checkbox]:not('#checkAll')").each(function(index) {
                    if (this.checked) {
                        if (index > 0) {
                            var id = $(this).attr("nid");
                            var tt = $(this).parent().next();
                            var t = $(this).parent().nextAll().eq(3).children();
                            ids += id + ",";
                        }
                    }
                });
                ids += "0 )";
            } else {
                alert("请选择要删除的内容");
            }
        }
        $.post(root+"/admin.php/Message/delete_message", {id: ids},
        function(data) {

            if (data === '1') {
                $("#right").load(root+"/admin.php/Message/message_list");
            } else {
                alert("服务器出错,请稍后再试!!!");
            }
        });
    });

//         //点击启用按钮
    $(".message_info").delegate(".minitab", "click", function() {
        var state = $(this).attr('state');
        var flag = 1;
        var ids = "(";
        var t = "";
        var tt = "";
        if (state == 2) {
            $(this).parents(".mk").children().children().prop("checked", true);
            ids += $(this).parents(".mk").children().children().attr("nid");
            $(this).parents(".mk").addClass("divclick");
            ids += ")";
            t = $(this).parents(".mk").children().eq(1).children();
            tt = $(this).parents(".mk").children().eq(4).children();
        } else {
            var intL = $("input:checked:not('#checkAll')").length;
            if (intL != 0) {
                $("input[type=checkbox]:not('#checkAll')").each(function(index) {
                    if (this.checked) {
                        if (index > 0) {
                            var id = $(this).attr("nid");
                            tt = $(this).parent().next();
                            t = $(this).parent().nextAll().eq(3).children();
                            ids += id + ",";
                        }
                    }
                });
                ids += "0 )";
            } else {
                alert("请选择要启用的内容");
                flag = 0;
            }
        }
        if (flag > 0) {

            $.post(root+"/admin.php/Message/minitab_message", {id: ids, state: state},
            function(data) {
                if (data === '1') {
                    if (state == 1) {
                        $(".state").html("已启用");
                        $(".operation").html('<span class="update" style="cursor: pointer">修改</span>&nbsp;' +
                                '<span class="delete" style="cursor: pointer" state="2">删除</span>&nbsp;' +
                                '<span class="close"  style="cursor: pointer" state="2">关闭</span>');
                    } else {
                        t.html("已启用");
                        tt.html('<span class="update" style="cursor: pointer">修改</span>&nbsp;' +
                                '<span class="delete" style="cursor: pointer" state="2">删除</span>&nbsp;' +
                                '<span class="close"  style="cursor: pointer" state="2">关闭</span>');
                    }

                } else if (data === '0') {
                    alert("服务器出错,请稍后再试!!!");
                } else {
                    if (state === '1') {
                        $(".state").html("已启用");
                        $(".operation").html('<span class="update" style="cursor: pointer">修改</span>&nbsp;' +
                                '<span class="delete" style="cursor: pointer" state="2">删除</span>&nbsp;' +
                                '<span class="close"  style="cursor: pointer" state="2">关闭</span>');
                    } else {
                        t.html("已启用");
                        tt.html('<span class="update" style="cursor: pointer">修改</span>&nbsp;' +
                                '<span class="delete" style="cursor: pointer" state="2">删除</span>&nbsp;' +
                                '<span class="close"  style="cursor: pointer" state="2">关闭</span>');
                    }
                }
            });
        }

    });


    //点击关闭按钮
    $(".message_info").delegate(".close", "click", function() {
        var state = $(this).attr('state');
        var flag = 1;
        var ids = "(";
        var t = "";
        var tt = "";
        if (state === 2) {
            $(this).parents(".mk").children().children().prop("checked", true);
            ids += $(this).parents(".mk").children().children().attr("nid");
            $(this).parents(".mk").addClass("divclick");
            ids += ")";
            t = $(this).parents(".mk").children().eq(1).children();
            tt = $(this).parents(".mk").children().eq(4).children();
        } else {
            var intL = $("input:checked:not('#checkAll')").length;
            if (intL !== 0) {
                $("input[type=checkbox]:not('#checkAll')").each(function(index) {
                    if (this.checked) {
                        if (index > 0) {
                            var id = $(this).attr("nid");
                            var tt = $(this).parent().next();
                            var t = $(this).parent().nextAll().eq(3).children();
                            ids += id + ",";
                        }
                    }
                });
                ids += "0 )";
            } else {
                alert("请选择要关闭的内容");
                flag = 0;
            }
        }
        if (flag > 0) {
            //发送数据到后台修改状态
            $.post(root+"/admin.php/Message/close_message", {id: ids, state: state},
            function(data) {
                if (data === '1') {
                    if (state == 1) {
                        $(".state").html("已关闭");
                        $(".operation").html('<span class="update" style="cursor: pointer">修改</span>&nbsp;' +
                                '<span class="delete" style="cursor: pointer" state="2">删除</span>&nbsp;' +
                                '<span class="minitab" style="cursor: pointer" state="2">启用</span>');
                    } else {
                        t.html("已关闭");
                        tt.html('<span class="update" style="cursor: pointer">修改</span>&nbsp;' +
                                '<span class="delete" style="cursor: pointer" state="2">删除</span>&nbsp;' +
                                '<span class="minitab" style="cursor: pointer" state="2">启用</span>');
                    }

                } else if (data === '0') {
                    alert("服务器出错,请稍后再试!!!");
                } else {
                    if (state == 1) {
                        $(".state").html("已关闭");
                        $(".operation").html('<span class="update" style="cursor: pointer">修改</span>&nbsp;' +
                                '<span class="delete" style="cursor: pointer" state="2">删除</span>&nbsp;' +
                                '<span class="minitab" style="cursor: pointer" state="2">启用</span>');
                    } else {
                        t.html("已关闭");
                        tt.html('<span class="update" style="cursor: pointer">修改</span>&nbsp;' +
                                '<span class="delete" style="cursor: pointer" state="2">删除</span>&nbsp;' +
                                '<span class="minitab" style="cursor: pointer" state="2">启用</span>');
                    }
                }
            });
        }
    });


    //点击新闻发布
    $("#public").click(function() {

//        var right = $("#right");
//       // right.load(root+"/admin.php/Message/publish_messageUI");
//       alert(root+"/Admin/Message/editor");
//       right.load(root+"/Admin/Message/editor");
       window.location.href=root+"/Admin/Message/publish_messageUI";
    });

    $(".GoPage").click(function() {
        var tp = $(this).attr("tp");
        if (tp == 1) {
            var page = $(this).attr("rel");
            var num = $("num").html();
            if (page > num) {
                alert("已到最后一页");
                return false;
            }
            if (page < 1) {
                alert("当前为第一页");
                return false;
            }
        } else {
            var page = $("select[name=pageurl]").val();
        }
        $.get(root+"/admin.php/Message/message_list", {
            page: page
        }, function(data) {
            $("#right").html(data);
        });
    });

    //点击search按钮
    $("#search").click(function() {
        var id = $("select[name='type'] :selected").val();
        var state = $("select[name='state'] :selected").val();

        if (id === '0' && state === '0') {
            $("#right").load(root+"/admin.php/Message/message_list");
        } else {
            $.post(root+"/admin.php/Message/search_bycondition", {id: id, state: state}, function(data) {
                $("#right").html(data);
            });
        }
    });

    //鼠标经过效果
    $(".message_info").hover(function() {
        $(this).addClass('divOver');
    }, function() {
        //鼠标离开时移除divOver样式
        $(this).removeClass('divOver');
    }
    );
    $(".checkbox").click(function() {
        var tt = $(this).parent().parent();
        if (this.checked) {
            tt.addClass("divclick");
        } else {
            tt.removeClass("divclick");
        }
    });

    //点击修改
     $(".update").click(function() {
        var nid = $(this).parent().attr("nid");
        window.location.href=root+"/admin.php/Message/update_messageUI?nid="+nid;
    });
});