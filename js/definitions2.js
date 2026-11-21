function termUrl(term) {
    // Apache rejects encoded slashes (%2F), so leave them raw; the /term/ rewrite accepts them.
    return "/term/"+encodeURIComponent(term).replace(/%2F/g, "/");
}

function escapeHtml(s) {
    return String(s).replace(/[&<>"']/g, function(c) {
        return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];
    });
}

function userLink(value) {
    return '<a href="https://evewho.com/character/'+parseInt(value.userid,10)+'"><img src="https://images.evetech.net/characters/'+parseInt(value.userid,10)+'/portrait?size=32" width="32" height="32" alt=""> <span class="hidden-xs">'+escapeHtml(value.username)+'</span></a>';
}

function getDefinitions(id) {

    $.getJSON("/api/getdefinitions.php?id="+encodeURIComponent(id),function(data){
        $("#definitions").empty();
        $("#definitions").append("<h2><a href='"+termUrl(data.term)+"'>"+escapeHtml(data.term)+"<span class='glyphicon glyphicon-link'></span></a></h2>");
        try {
            var stateObj = {};
            history.replaceState(stateObj, data.term, termUrl(data.term));
        }
        catch(err) { console.log("No pushstate");}
        $.each(data.definitions,function( index, value ) {
            reporttext='';
            if (characterid){
                reporttext="<div class='voteicons'><a href='/report.php?id="+parseInt(value.id,10)+"' title='report'><span class='glyphicon glyphicon-bullhorn glyphgrey'></span></a></div>";
            }
            $("#definitions").append('<div class="term well row vertical-center">'+'<div class="termUser col-md-2">'+userLink(value)+'</div><div class="termdefinition col-md-10">'+escapeHtml(value.definition)+reporttext+'</div>');
        });
        $(".termDefinition").mouseup(function() {searchDefinition();});
        if ($("#term-"+data.listid).length) {
            $("#mainTermList").scrollTo("#term-"+data.listid);
        }
    })
}

function runSearch() {

    searchTerm=$("#search").val();
     $.getJSON("/api/search.php?search="+encodeURIComponent(searchTerm),function(data){
        if (data.length==0) {
            alert("Nothing found. Searchs below 3 characters are exact matches");
        } else {
        $("#mainTermList").empty();
        $("#mainTermList").append("<h2 id='clearSearch'>clear search</h2>");
        $("#mainTermList").append("<ul id='searchTermList'></ul>");
        $.each(data,function( index, value ) {
            $("#searchTermList").append("<li><span class='loaddefinition' id='term-"+parseInt(value.id,10)+"' data-id='"+parseInt(value.id,10)+"'>"+escapeHtml(value.term)+"</span></li>");
        });
        $(".loaddefinition").click(function() {getDefinitions($(this).data().id); $("#mainTermList").scrollTo("#term-"+$(this).data().id);});
        $("#clearSearch").click(function() {clearSearch()});
        }
    });

}

function clearSearch() {

    $.getJSON("/api/term2.php",function(data){
        $("#mainTermList").empty();
        indexcharacter=data[0].term.charAt(0).toUpperCase();
        indexnum=0;
        $("#mainTermList").append("<h2 id='termindex-"+indexnum+"' data-search='"+escapeHtml(indexcharacter)+"'>"+escapeHtml(indexcharacter)+"</h2>");
        $("#mainTermList").append("<ul id='termlist-"+indexnum+"' data-search='"+escapeHtml(indexcharacter)+"'></ul>");
        $.each(data,function( index, value ) {
                if (indexcharacter!=value.term.charAt(0).toUpperCase()) {
                    indexcharacter=value.term.charAt(0).toUpperCase();
                    indexnum++;
                    $("#mainTermList").append("<h2 id='termindex-"+indexnum+"' data-search='"+escapeHtml(indexcharacter)+"'>"+escapeHtml(indexcharacter)+"</h2>");
                    $("#mainTermList").append("<ul id='termlist-"+indexnum+"' data-search='"+escapeHtml(indexcharacter)+"'></ul>");
                }
                $("#termlist-"+indexnum).append("<li><span class='loaddefinition' id='term-"+parseInt(value.id,10)+"' data-id='"+parseInt(value.id,10)+"'>"+escapeHtml(value.term)+"</span></li>");
        });
        $(".loaddefinition").click(function() {getDefinitions($(this).data().id); $("#mainTermList").scrollTo("#term-"+$(this).data().id);});
        $("#search").val('');
    });
}

function searchDefinition()
{
    if (window.getSelection()) {
        term=window.getSelection().toString();
        if (term.length>2) {
        $.getJSON("/api/search.php?search="+encodeURIComponent(term),function(data){
            if (data.length==0) {
                $("#searchbox").html("<p>Nothing found</p>");
                $("#searchbox").dialog( "open" );
                return;
            }
            $("#searchbox").html("<h2>search results</h2><ul id='dialogsearch'></ul>");
            $.each(data,function( index, value ) {
                $("#dialogsearch").append("<li><span class='loaddialog' data-id='"+parseInt(value.id,10)+"'>"+escapeHtml(value.term)+"</span></li>");
        });
        $("#searchbox").dialog( "open" );
        $(".loaddialog").click(function() {loadDialog($(this).data().id);});
    });
    }
    }
}

function loadDialog(id) {

    $.getJSON("/api/getdefinitions.php?id="+encodeURIComponent(id),function(data){
        $("#definitionDialog").empty();
        $("#definitionDialog").append("<h2><a href='"+termUrl(data.term)+"'>"+escapeHtml(data.term)+"<span class='glyphicon glyphicon-link'></span></a></h2>");
        $.each(data.definitions,function( index, value ) {
            $("#definitionDialog").append('<div class="term well row vertical-center">'+'<div class="termdisplay col-md-2"><div class="termUser">'+userLink(value)+'</div></div><div class="termdisplay col-md-10"><div class="termDefinition">'+escapeHtml(value.definition)+'</div></div>');
        });

        $("#definitionDialog").dialog( "open" );
    });
}

$.urlParam = function(name){
    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
        return null;
    } else {
        return results[1] || 0;
    }
}
