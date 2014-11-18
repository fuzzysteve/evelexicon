{extends file='layout.tpl' }
{block name=title}{$termname}{/block}
{block name=body}
        <div class="termTitle"><h1><a href="/define.php?id={$termid}">{$termname}</a><h1></div>
{foreach $terms as $term}
<div class="term well row vertical-center">
    <div class="termdisplay col-md-2">
        <div class="termUser"><a href="https://forums.eveonline.com/profile/{$term.username|escape:'url'}"><img src="https://image.eveonline.com/character/{$term.userid}_32.jpg">{$term.username}</a></div>
    </div>
    <div class="termdisplay col-md-10">
        <div class="termDefinition">{$term.definition}</div>
    </div>
</div>
{/foreach}
{/block}
