{extends file='layout.tpl'}
{block name=title}EveLexicon.com{/block}
{block name=extrajavascript}<script src="/js/definitions.js"></script>{/block}
{block name=body}
<div class="row">
    <div class="termList scrollable col-md-2 col-xs-4">
{assign var="last" value=""}
{foreach $terms as $term}
{if $last !={$term.name|truncate:1:""|upper}}
</ul>
<h2>{$term.name|truncate:1:""|upper}</h2>
<ul>
{/if}
{assign var="last" value={$term.name|truncate:1:""|upper}}
            <li><span class="loaddefinition" data-id="{$term.id}">{$term.name}</span></li>
{/foreach}
        </ul>
    </div>
    <div class="termdisplay col-md-10 col-xs-8" id='definitions'>
    <p>Select a term from the right to see the definitions</p>
    </div>
</div>
<script>
{literal}
$(".loaddefinition").click(function() {getDefinitions($(this).data().id);});
{/literal}
</script>
{/block}
