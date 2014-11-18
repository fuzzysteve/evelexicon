{extends file='layout.tpl' }
{block name=title}EveLexicon.com{/block}
{block name=body}
<div id="termsoftheday">

{foreach $terms as $term}
<div class="term well row vertical-center">
    <div class="termDate col-md-1">
        <div class="dateCircle">
        {$term.tod|date_format:"%d"}  {$term.tod|date_format:"%b"}
        </div>
    </div>
    <div class="termdisplay col-md-11">
        <div class="termTitle"><h1><a href="/define.php?id={$term.id}">{$term.term}</a><h1></div>
        <div class="termDefinition">{$term.definition}</div>
        <div class="termUser"><a href="https://forums.eveonline.com/profile/{$term.username|escape:'url'}"><img src="https://image.eveonline.com/character/{$term.userid}_32.jpg"> {$term.username}</a></div>

    </div>
</div>
{/foreach}

</div>
{/block}
