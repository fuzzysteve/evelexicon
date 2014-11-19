function getDefinitions(id) {

    $.getJSON("/api/getdefinitions.php?id="+id,function(data){
        $("#definitions").empty();
        $("#definitions").append("<h2><a href='list.php?id="+data.id+"'>"+data.term+"<span class='glyphicon glyphicon-link'></span></a></h2>");
        $.each(data.definitions,function( index, value ) {
            $("#definitions").append('<div class="term well row vertical-center">'+'<div class="termdisplay col-md-2"><div class="termUser"><a href="https://forums.eveonline.com/profile/'+value.username+'"><img src="https://image.eveonline.com/character/'+value.userid+'_32.jpg"><span class="hidden-xs">'+value.username+'</span></a></div></div><div class="termdisplay col-md-10"><div class="termDefinition">'+value.definition+'</div></div>');
        });
        $(".termDefinition").mouseup(function() {searchDefinition();});
    })
}

function runSearch() {

    searchTerm=$("#search").val();
     $.getJSON("/api/search.php?search="+searchTerm,function(data){
        if (data.length==0) {
            alert("Nothing found. Searchs below 3 characters are exact matches");
        } else {
        $("#mainTermList").empty();
        $("#mainTermList").append("<h2 id='clearSearch'>clear search</h2>");
        $("#mainTermList").append("<ul id='searchTermList'></ul>");
        $.each(data,function( index, value ) {
            $("#searchTermList").append("<li><span class='loaddefinition' id='term-"+value.id+"' data-id='"+value.id+"'>"+value.term+"</span></li>");
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
        $("#mainTermList").append("<h2 id='termindex-"+indexnum+"' data-search='"+indexcharacter+"'>"+indexcharacter+"<h2>");
        $("#mainTermList").append("<ul id='termlist-"+indexnum+"' data-search='"+indexcharacter+"'></ul>");
        $.each(data,function( index, value ) {
                if (indexcharacter!=value.term.charAt(0).toUpperCase()) {
                    indexcharacter=value.term.charAt(0).toUpperCase();
                    indexnum++;
                    $("#mainTermList").append("<h2 id='termindex-"+indexnum+"' data-search='"+indexcharacter+"'>"+indexcharacter+"<h2>");
                    $("#mainTermList").append("<ul id='termlist-"+indexnum+"' data-search='"+indexcharacter+"'></ul>");
                }
                $("#termlist-"+indexnum).append("<li><span class='loaddefinition' id='term-"+value.id+"' data-id='"+value.id+"'>"+value.term+"</span></li>");
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
        $.getJSON("/api/search.php?search="+term,function(data){
            if (data.length==0) {
                $("#searchbox").html("<p>Nothing found</p>");
                $("#searchbox").dialog( "open" );
                return;
            }
            $("#searchbox").html("<h2>search results</h2><ul id='dialogsearch'></ul>");
            $.each(data,function( index, value ) {
                $("#dialogsearch").append("<li><span class='loaddialog' id='term-"+value.id+"' data-id='"+value.id+"'>"+value.term+"</span></li>");
        });
        $("#searchbox").dialog( "open" );
        $(".loaddialog").click(function() {loadDialog($(this).data().id);});
    });
    }
    }
}

function loadDialog(id) {

    $.getJSON("/api/getdefinitions.php?id="+id,function(data){
        $("#definitionDialog").empty();
        $("#definitionDialog").append("<h2><a href='define.php?id="+data.id+"'>"+data.term+"<span class='glyphicon glyphicon-link'></span></a></h2>");
        $.each(data.definitions,function( index, value ) {
            $("#definitionDialog").append('<div class="term well row vertical-center">'+'<div class="termdisplay col-md-2"><div class="termUser"><a href="https://forums.eveonline.com/profile/'+value.username+'"><img src="https://image.eveonline.com/character/'+value.userid+'_32.jpg"><span class="hidden-xs">'+value.username+'</span></a></div></div><div class="termdisplay col-md-10"><div class="termDefinition">'+value.definition+'</div></div>');
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
