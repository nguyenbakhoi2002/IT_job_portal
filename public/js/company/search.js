/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/company/search.js ***!
  \****************************************/
$(function () {
  $(document).on("click", ".pagination li a,#button_search", function (e) {
    e.preventDefault();
    var url = $(this).attr("href");
    var showTable = $('table').attr('data-pageapplied');
    var append = url.indexOf("?") == -1 ? "?" : "&";
    var finalURL = url + append + $("#search").serialize();
    if (showTable != undefined) {
      finalURL = url + append + $("#search").serialize() + "&showTable=" + showTable;
    }
    window.history.pushState({}, null, finalURL);
    $.get(finalURL, function (data) {
      $(".table-outer").html(data);
      $(".btn_profileApplied").on("click", function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        window.history.pushState({}, null, url);
        $.get(url, function (data) {
          $(".row").html(data);
        });
        return false;
      });
    });
    return false;
  });
});
/******/ })()
;