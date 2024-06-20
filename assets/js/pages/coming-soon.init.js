/*
Template Name: AWD网络攻防系统  & Countdown Template
Author: Swback
File: coming soon Init Js File
*/

$('[data-countdown]').each(function () {
    var $this = $(this), finalDate = $(this).data('countdown');
    $this.countdown(finalDate, function (event) {
        $(this).html(event.strftime(''
        + '<div class="coming-box">%D <span>天</span></div> '
        + '<div class="coming-box">%H <span>时</span></div> '
        + '<div class="coming-box">%M <span>分</span></div> '
        + '<div class="coming-box">%S <span>秒</span></div> '));
    });
});