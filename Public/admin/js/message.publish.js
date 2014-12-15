/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    
    var ue = UE.getEditor('container', {
        
            serverUrl: "{:U('Admin/Message/ueditor')}"
        });
    
    
    
    $("#reset").click(function() {
        $("input[name=title]").val("");
        $("select[name=type]").val("");
        $(document.getElementsByTagName("iframe")[0].contentWindow.document.body).html("");
    });
});

