{extends file='layout2.tpl'}
{block name=title}EveLexicon.com{/block}
{block name=extrajavascript}<script src="/js/definitions2.js"></script>{/block}
{block name=body}
<div class="row">
    <div class="termList col-md-2 col-xs-4">
            <div class="form-group has-feedback ">
                <input type=text placeholder="search" name="search" class="form-control" onchange="runSearch();" id="search"><span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
            </div>
<div class="scrollable" id="mainTermList">
{assign var="last" value=""}
{foreach $terms as $term}
{if $last !={$term.name|truncate:1:""|upper}}
</ul>
<h2>{$term.name|truncate:1:""|upper}</h2>
<ul>
{/if}
{assign var="last" value={$term.name|truncate:1:""|upper}}
            <li><span class="loaddefinition" id="term-{$term.id}" data-id="{$term.id}">{$term.name}</span></li>
{/foreach}
        </ul>
    </div>
</div>
    <div class="termdisplay col-md-10 col-xs-8">
    <div id='definitions'>
    <p>Select a term from the right to see the definitions</p>
    </div>
    <div>
    <p>If you don't know a term in a definition, try selecting it (or part of it) if it's in the lexicon, you'll get a window opening with the matches.</p>
    </div>
</div>
<div id="searchbox" title="Searchbox">
</div>
<div id="definitionDialog" title="Definition">
<script>
{literal}
 $(".loaddefinition").click(function() {getDefinitions($(this).data().id); $("#mainTermList").scrollTo("#term-"+$(this).data().id);});
 $(function() { var searchbox=$( "#searchbox" ).dialog({ autoOpen: false,width: 500 }); });
 $(function() { var searchbox=$( "#definitionDialog" ).dialog({ autoOpen: false,width:600,height:500}); });

if (isFinite($.urlParam('id')) && ($.urlParam('id')!=null)) {
    temp=$.urlParam('id');
    getDefinitions(parseInt(temp));
    $("#mainTermList").scrollTo("#term-"+temp);
}




{/literal}
{if ($characterid)}
var characterid={$characterid};
{else}
var characterid=0;
{/if}
</script>
{/block}
