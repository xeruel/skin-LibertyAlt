$(document).ready(function () {
  $("#libertyalt-scrollup").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 400);
    return false;
  });
  $("#libertyalt-scrolldown").click(function () {
    $("html, body").animate({ scrollTop: $(document).height() }, 400);
    return false;
  });
});
