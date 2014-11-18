function getDefinitions(id) {

    $.getJSON("/api/getdefinitions.php?id="+id,function(data){
        $("#definitions").empty();
        $("#definitions").append("<h2><a href='define.php?id="+data.id+"'>"+data.term+"<span class='glyphicon glyphicon-link'></span></a></h2>");
        $.each(data.definitions,function( index, value ) {
            $("#definitions").append('<div class="term well row vertical-center">'+'<div class="termdisplay col-md-2"><div class="termUser"><a href="https://forums.eveonline.com/profile/'+value.username+'"><img src="https://image.eveonline.com/character/'+value.userid+'_32.jpg"> '+value.username+'</a></div></div><div class="termdisplay col-md-10"><div class="termDefinition">'+value.definition+'</div></div>');
        });
    })
}
