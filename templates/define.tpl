{extends file='layout2.tpl' }
{block name=title}{$termname|escape}{/block}
{block name=body}
        <div class="termTitle"><h1><a href="/define.php?id={$termid}">{$termname|escape}</a></h1></div>
{foreach $terms as $term}
<div class="term well row vertical-center">
    <div class="termdisplay col-md-2">
        <div class="termUser"><a href="https://evewho.com/character/{$term.userid}"><img src="https://images.evetech.net/characters/{$term.userid}/portrait?size=32" width="32" height="32" alt=""> {$term.username|escape}</a></div>
    </div>
    <div class="termdisplay col-md-10">
        <div class="termDefinition">{$term.definition|escape|nl2br}</div>
    </div>
</div>
{/foreach}
{/block}
