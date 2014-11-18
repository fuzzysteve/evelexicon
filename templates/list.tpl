{extends file='layout.tpl'}
{block name=title}EveLexicon.com{/block}
{block name=extrajavascript}<script src="/js/definitions.js"></script>{/block}
{block name=body}
<div class="row">
    <div class="termList scrollable col-md-2">
{assign var="last" value=""}
{section name=term loop=$terms}
{if $last !={$terms[term].name|truncate:1:""}}
</ul>
<h2>{$terms[term].name|truncate:1:""|upper}</h2>
<ul>
{/if}
{assign var="last" value={$terms[term].name|truncate:1:""}}
            <li><span class="loaddefinition" data-id="{$terms[term].id}">{$terms[term].name}</span></li>
{/section}
        </ul>
    </div>
    <div class="termdisplay col-md-10" id='definitions'>
    <p>Select a term from the right to see the definitions</p>
    </div>
</div>
<script>
{literal}
$(".loaddefinition").click(function() {getDefinitions($(this).data().id);});
{/literal}
</script>
{/block}
