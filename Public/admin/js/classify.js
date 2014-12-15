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
                    var tt = $(this).parent().parent().parent();
                    if (this.checked) {
                        tt.addClass("divclick");
                    }
                }
            });
        } else {
            $("input[type=checkbox]:not('#checkAll')").each(function(index) {
                var tt = $(this).parent().parent().parent();
                if (!this.checked) {
                    tt.removeClass("divclick");
                }
            });
        }
    });

//       //点击删除按钮         
    $(".classify_info").delegate(".delete", "click", function() {
        var state = $(this).attr('state');
//               alert(state);
        var flag = 1;
        var ids = "(";
        if (state == 2) {
            $(this).parents(".mk").children().children().children().prop("checked", true);
            ids += $(this).parents(".mk").children().children().children().attr("nid");
            $(this).parents(".mk").addClass("divclick");
            ids += ")";
            if (!confirm("确定删除吗?")) {
                return false;
            }
        } else {
            var intL = $("input:checked:not('#checkAll')").length;
            if (intL != 0) {
                if (!confirm("确定删除吗?")) {
                    return false;
                }
                $("input[type=checkbox]:not('#checkAll')").each(function(index) {
                    if (this.checked) {
                        if (index > 0) {
                            var id = $(this).attr("nid");
                            ids += id + ",";
                        }
                    }
                });
                ids += "0 )";
            } else {
                alert("请选择要删除的内容");
                flag = 0;
            }
        }
        if (flag > 0) {
            $.post(root+"/admin.php/Classify/classify_delete", {id: ids},
            function(data) {
                if (data == 1) {
                    $("#right").load(root+"/admin.php/classify/classify_list");
                } else {
                    alert("服务器出错,请稍后再试!!!");
                }
            });
        }
    });

    $(".classify_info").delegate(".minitab", "click", function() {
        var state = $(this).attr('state');
        var flag = 1;
        var ids = "(";
        var t = "";
        var tt = "";
        if (state == 2) {
            $(this).parents(".mk").children().children().children().prop("checked", true);
            ids += $(this).parents(".mk").children().children().children().attr("nid");
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
//                              tt = $(this).parent().next();
//                              t = $(this).parent().nextAll().eq(3).children();
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
            $.post(root+"/admin.php/Classify/minitab_classify", {id: ids, state: state},
            function(data) {
                if (data == 1) {
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

                } else if (data == 0) {
                    alert("服务器出错,请稍后再试!!!");
                } else {
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
                }
            });
        }

    });

    //点击关闭按钮
    $(".classify_info").delegate(".close", "click", function() {
        var state = $(this).attr('state');
        var flag = 1;
        var ids = "(";
        var t = "";
        var tt = "";
        if (state == 2) {
            $(this).parents(".mk").children().children().children().prop("checked", true);
            ids += $(this).parents(".mk").children().children().children().attr("nid");
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
            $.post(root+"/admin.php/Classify/close_message", {id: ids, state: state},
            function(data) {
//                                    alert(data);
                if (data == 1) {
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

                } else if (data == 0) {
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

    //鼠标经过效果
    $(".classify_info").hover(function() {
        $(this).addClass('divOver');
    }, function() {
        //鼠标离开时移除divOver样式
        $(this).removeClass('divOver');
    }
    );
    $(".checkbox").click(function() {
        var tt = $(this).parent().parent().parent();
        if (this.checked) {
            tt.addClass("divclick");
        } else {
            tt.removeClass("divclick");
        }
    });

    //类型检索
    $("#search").click(function() {
        var id = $("select option:selected").val();
//         alert(id);
        $.post(root+"/admin.php/Classify/search_type", {id: id}, function(data) {
            $("#right").html(data);
        });
    });

    //点击修改
//      $(".update").cilck(function(){
//          alert("---->>>");
//         var tt = $(this).parent().parent().parent().children().eq(2);
//          alert(tt.html());
//      });

    var oldtitle = "";
    var oldposition = "";
    $(".classify_info").delegate(".update", "click", function() {
        var tt = $(this).parent().parent().parent().children().eq(2);
        var t = $(this).parent().parent().parent().children().eq(3).children();
        oldtitle = $(this).parent().parent().parent().children().eq(3).children().children().html();
        oldposition = tt.html();
        $(".update").css("cursor", "");
        $(".update").attr("class", "unupdate");//让其他的修改点击不了
//            alert($(".update").attr("class"));
        //查询所有的position
        $.post(root+"/admin.php/Classify/queryallposition", function(data) {
            var html_select = "<select name='position'>";
            for (var i = 0; i < data.length; i++) {
                if (data[i].position == oldposition.trim()) {
                    html_select += "<option value='" + data[i].position + "' selected>" + data[i].position + "</option>";
                } else {
                    html_select += "<option value='" + data[i].position + "'>" + data[i].position + "</option>";
                }
            }
            html_select += "</select>";
            tt.html(html_select);
            t.html("<input type='text' name='title' value='" + oldtitle + "' size='100'>");
        });
        $(this).attr("class", "confirm");
        $(this).css("cursor", "pointer");
        $(this).html("确定");
    });
    //点击确定按钮
    $(".classify_info").delegate(".confirm", "click", function() {
        var newposition = $("select[name='position'] :selected").val();
        var newtitle = $("input[name='title']").val();
        var nid = $(this).parent().attr("nid");
        var oldp = oldposition.trim();
        if (newtitle.trim() != oldtitle.trim() || newposition != oldp) {
//              alert("------>>>"+newposition+"  "+oldposition.trim());
            if (newtitle.trim() != oldtitle.trim() && newposition == oldp) {
                //修改了标题
//                  alert("--title-->>>");
                $.post(root+"/admin.php/Classify/update_classify", {newposition: newposition, oldposition: oldp, newtitle: newtitle, state: 1, nid: nid},
                function(data) {
                    if (data == 1) {
//                         alert("修改成功");
                        $("#right").load(root+"/admin.php/Classify/classify_list");
                    } else {
                        alert("服务器出错,请稍后再试!!!");
                    }
                });
            }
            else if (newtitle.trim() == oldtitle.trim() && newposition != oldp) {
                //修改了位置
//                  alert("--position-->>>"+newposition+"  "+oldposition.trim()+""+nid);
                $.post(root+"/admin.php/Classify/update_classify", {newposition: newposition, oldposition: oldp, newtitle: newtitle, state: 2, nid: nid},
                function(data) {
//                        alert(data);
                    if (data == 1) {
//                         alert("修改成功");
                        $("#right").load(root+"/admin.php/Classify/classify_list");
                    } else {
                        alert("服务器出错,请稍后再试!!!");
                    }
                });

            } else {
                //都修改了
//                  alert("--position--title-->>>");
                $.post(root+"/admin.php/Classify/update_classify", {newposition: newposition, oldposition: oldp, newtitle: newtitle, state: 3, nid: nid},
                function(data) {
//                      alert(data);
                    if (data == 1) {
//                         alert("修改成功");
                        $("#right").load(root+"/admin.php/Classify/classify_list");
                    } else {
                        alert("服务器出错,请稍后再试!!!");
                    }
                });
            }
        } else {
//               alert("数据未修改");
            $("#right").load(root+"/admin.php/Classify/classify_list");
        }
    });
    //点击添加类型
    $(".add_type").click(function() {
        $(".mk").hide();
        $(".add_typeview").show();
    });
    //添加操作
    $("#add_type").click(function() {
        var type = $("input[name=type]").val();
        if (type == "") {
            alert("请填写类型!!!");
        } else {
            $.post(root+"/admin.php/Classify/add_type", {type: type}, function(data) {
                if (data == 1) {
                    alert("添加成功");
                    $("#right").load(root+"/admin.php/Classify/classify_list");
                } else {
                    alert("服务器出错,请稍后再试!!!");
                }
            });
        }
    });
});

