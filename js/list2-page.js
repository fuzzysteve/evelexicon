// Page setup for list.php (layout2). Kept out of the template so the CSP needs no inline script.
var characterid = parseInt($("#definitions").data("characterid"), 10) || 0;

$(".loaddefinition").click(function() {
    getDefinitions($(this).data().id);
    $("#mainTermList").scrollTo("#term-"+$(this).data().id);
});
$("#search").change(function() { runSearch(); });

$(function() {
    $("#searchbox").dialog({ autoOpen: false, width: 500 });
    $("#definitionDialog").dialog({ autoOpen: false, width: 600, height: 500 });
});

if (isFinite($.urlParam('id')) && ($.urlParam('id') != null)) {
    getDefinitions(parseInt($.urlParam('id'), 10));
}
