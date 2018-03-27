﻿function showQuan(){ // 显示首页票券信息弹窗
    $('.quan_index_bg').show();
    $('.quan_win').show();
    $('.quan_win_close').css('display','inline-block');
}
function quanHide(){  // 隐藏首页票券信息弹窗
    $('.quan_index_bg').hide();
    $('.quan_win').fadeOut();
    $('.quan_win_close').css('display','none');
}
$(function(){
    $('.quan_index_bg').click(function(){ //点击遮罩层隐藏首页票券信息弹窗
        quanHide();
    });
});
/* 模拟弹窗 */
window.alert = function(msg, callback) {
    var div = document.createElement("div");
    div.innerHTML = "<style type=\"text/css\">"
        + ".nbaMask { position: fixed; z-index: 1000; top: 0; right: 0; left: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); }                                                                                                                                                                       "
        + ".nbaMaskTransparent { position: fixed; z-index: 1000; top: 0; right: 0; left: 0; bottom: 0; }                                                                                                                                                                                            "
        + ".nbaDialog { position: fixed; z-index: 5000; width: 80%; max-width: 300px; top: 50%; left: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%); background-color: #fff; text-align: center; border-radius: 8px; overflow: hidden; opacity: 1; color: white; }"
        + ".nbaDialog .nbaDialogHd { padding: .2rem .27rem .08rem .27rem; }                                                                                                                                                                                                                         "
        + ".nbaDialog .nbaDialogHd .nbaDialogTitle { font-size: 17px; font-weight: 400; }                                                                                                                                                                                                           "
        + ".nbaDialog .nbaDialogBd { padding: 1.5rem .27rem; font-size: 15px; line-height: 1.3; word-wrap: break-word; word-break: break-all; color: #000000; }                                                                                                                                          "
        + ".nbaDialog .nbaDialogFt { position: relative; line-height: 48px; font-size: 17px; display: -webkit-box; display: -webkit-flex; display: flex; }                                                                                                                                          "
        + ".nbaDialog .nbaDialogFt:after { content: \" \"; position: absolute; left: 0; top: 0; right: 0; height: 1px; border-top: 1px solid #e6e6e6; color: #e6e6e6; -webkit-transform-origin: 0 0; transform-origin: 0 0; -webkit-transform: scaleY(0.5); transform: scaleY(0.5); }               "
        + ".nbaDialog .nbaDialogBtn { display: block; -webkit-box-flex: 1; -webkit-flex: 1; flex: 1; color: #007AFF; text-decoration: none; -webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 0; }                                                                       "
        + ".nbaDialog .nbaDialogBtn:after { content: \" \"; position: absolute; left: 0; top: 0; width: 1px; bottom: 0; border-left: 1px solid #e6e6e6; color: #e6e6e6; -webkit-transform-origin: 0 0; transform-origin: 0 0; -webkit-transform: scaleX(0.5); transform: scaleX(0.5); }             "
        + ".nbaDialog a { text-decoration: none; -webkit-tap-highlight-color: transparent; }"
        + "</style>"
        + "<div id=\"dialogs2\" style=\"display: none\">"
        + "<div class=\"nbaMask\"></div>"
        + "<div class=\"nbaDialog\">"
        + "	<div class=\"nbaDialogHd\">"
        + "		<strong class=\"nbaDialogTitle\"></strong>"
        + "	</div>"
        + "	<div class=\"nbaDialogBd\" id=\"dialog_msg2\">弹窗内容，告知当前状态、信息和解决方法，描述文字尽量控制在三行内</div>"
        + "	<div class=\"nbaDialogHd\">"
        + "		<strong class=\"nbaDialogTitle\"></strong>"
        + "	</div>"
        + "	<div class=\"nbaDialogFt\">"
        + "		<a href=\"javascript:;\" class=\"nbaDialogBtn nbaDialogBtnPrimary\" id=\"dialog_ok2\">确定</a>"
        + "	</div></div></div>";
    document.body.appendChild(div);

    var dialogs2 = document.getElementById("dialogs2");
    dialogs2.style.display = 'block';

    var dialog_msg2 = document.getElementById("dialog_msg2");
    dialog_msg2.innerHTML = msg;

    // var dialog_cancel = document.getElementById("dialog_cancel");
    // dialog_cancel.onclick = function() {
    // dialogs2.style.display = 'none';
    // };
    var dialog_ok2 = document.getElementById("dialog_ok2");
    dialog_ok2.onclick = function() {
        dialogs2.style.display = 'none';
        callback();
    };
};

// 倒计时
//var endtime = new Date("2018/12/31 23:59:59");
//setInterval(function () {
//   // var nowtime = new Date();
//    var nowtime = new Date($.ajax({async: false}).getResponseHeader("Date"));  //使用服务器时间
//    var time = endtime - nowtime;
//    var hour = parseInt(time / 1000 / 60 / 60 % 24);
//    var minute = parseInt(time / 1000 / 60 % 60);
//    var seconds = parseInt(time / 1000 % 60);
//    if(time>0){
//        hour = (String(hour).length >= 2) ? hour : '0' + hour;
//        minute = (String(minute).length >= 2) ? minute : '0' + minute;
//        seconds = (String(seconds).length >= 2) ? seconds : '0' + seconds;
//        $('#time_h').html(hour);
//        $('#time_m').html(minute);
//        $('#time_s').html(seconds);
//    }else{
//        $('#time_h').html('00');
//        $('#time_m').html('00');
//        $('#time_s').html('00');
//    }
//}, 1000);
