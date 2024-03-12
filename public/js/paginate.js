/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/paginate.js ***!
  \**********************************/
$(window).on('pagination', function () {
  if (window.location.hash) {
    var page = window.location.hash.replace('#', '');
    if (page == Number.NaN || page <= 0) {
      return false;
    } else {
      getData(page);
    }
  }
});
$(document).ready(function () {
  $(document).on('click', '.pagination li a', function (event) {
    event.preventDefault();
    $('a').removeClass('current-page');
    $(this).parent('a').addClass('current-page');
    var myurl = $(this).attr('href');
    var page = $(this).attr('href').split('page=')[1];
    getData(page);
  });
});
function getData(page) {
  $.ajax({
    url: '?page=' + page,
    type: "get",
    datatype: "html"
  }).done(function (data) {
    $(".table-outer").empty().html(data);
    location.hash = page;
  }).fail(function (jqXHR, ajaxOptions, thrownError) {
    alert('No response from server');
  });
}
/******/ })()
;