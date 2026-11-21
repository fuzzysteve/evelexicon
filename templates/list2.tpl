{extends file='layout2.tpl'}
{block name=title}EveLexicon.com{/block}
{block name=extrajavascript}<script src="/js/definitions2.js?v=20261121e"></script>{/block}
{block name=body}
<div class="row">
    <div class="termList col-md-2 col-xs-4">
            <div class="form-group has-feedback ">
                <input type=text placeholder="search" name="search" class="form-control" id="search"{if isset($searchquery)} value="{$searchquery|escape}"{/if}><span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
            </div>
<div class="scrollable" id="mainTermList">
{if isset($searchquery)}
<p class="searchsummary">{if $terms}{count($terms)} terms match{else}No terms match{/if} &ldquo;{$searchquery|escape}&rdquo; &middot; <a href="/list.php">show all</a></p>
{/if}
{assign var="last" value=""}
{foreach $terms as $term}
{if $last !={$term.name|truncate:1:""|upper}}
</ul>
<h2>{$term.name|truncate:1:""|upper|escape}</h2>
<ul>
{/if}
{assign var="last" value={$term.name|truncate:1:""|upper}}
            <li><span class="loaddefinition" id="term-{$term.id}" data-id="{$term.id}">{$term.name|escape}</span></li>
{/foreach}
        </ul>
    </div>
</div>
    <div class="termdisplay col-md-10 col-xs-8">
    <div id='definitions' data-characterid="{$characterid|escape}">
    <p>Select a term from the list to see its definitions.</p>
    </div>
    <div>
    <p>If you don't know a term in a definition, try selecting it (or part of it) if it's in the lexicon, you'll get a window opening with the matches.</p>
    </div>
</div>
<div id="searchbox" title="Searchbox">
</div>
<div id="definitionDialog" title="Definition">
</div>
<script src="/js/list2-page.js?v=20261121"></script>
{/block}
