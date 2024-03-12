/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************!*\
  !*** ./resources/js/admin/blacklist.js ***!
  \*****************************************/
var path = "{{url('admin/blacklist/candidate/action')}}";
$('#key').typeahead({
  source: function source(query, process) {
    return $.get(path, {
      query: query
    }, function (data) {
      return process(data);
    });
  }
});
/******/ })()
;