/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    var baseurl = $("input[name='baseURL']").val();
    $('.note_message_info').hover(
            function() {
                $(this).css('background-color', '#f5f5f5');
                $(this).find('.note_item_del').show();
            },
            function() {
                $(this).css('background-color', '#fff');
                $(this).find('.note_item_del').hide();
            });
    //删除信息
    $('.note_del').click(function() {
        if (confirm("你确认删除该条消息吗？")) {
            var url = $(this).attr('href');
            $('#right').load(url);
        }
        return false;
    });
    //查询新留言
    $('.new_note').click(function() {
        $("#right").load(baseurl + "/admin.php/Note/note_new", function() {
            $('.new_note').attr('disabled', true);
        });
    });
    //查询所有留言
    $('.all_note').click(function() {
        $("#right").load(baseurl + "/admin.php/Note/note_all", function() {
            $('.all_note').attr('disabled', true);
        });
    });
    //按主题查询
    $('.theme_note').click(function() {
        $("#right").load(baseurl + "/admin.php/Note/note_theme", function() {
            $('.theme_note').attr('disabled', true);
        });
    });
    $('.detail_link').click(function() {

        $('#right').load($(this).attr('href'));
        return false;
    });
});


