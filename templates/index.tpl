{extends file='layout2.tpl' }
{block name=title}EVELexicon.com{/block}
{block name=body}
<div id="termsoftheday">

{foreach $terms as $term}
<div class="term well row vertical-center">
    <div class="termDate col-md-1 col-xs-5">
        <div class="dateCircle">
        {$term.tod|date_format:"%d"}  {$term.tod|date_format:"%b"}
        </div>
    </div>
    <div class="termdisplay col-md-11 col-xs-7">
        <div class="termTitle"><h1><a href="/list.php?id={$term.id}">{$term.term}</a><h1></div>
        <div class="termDefinition">{$term.definition}</div>
        <div class="termUser"><a href="https://forums.eveonline.com/profile/{$term.username|escape:'url'}"><img src="https://image.eveonline.com/character/{$term.userid}_32.jpg"> {$term.username}</a></div>

    </div>
</div>
{/foreach}

</div>
<div class="tsandcs">
EVE Online and the EVE logo are the registered trademarks of CCP hf. All rights are reserved worldwide. All other trademarks are the property of their respective owners. EVE Online, the EVE logo, EVE and all associated logos and designs are the intellectual property of CCP hf. All artwork, screenshots, characters, vehicles, storylines, world facts or other recognizable features of the intellectual property relating to these trademarks are likewise the intellectual property of CCP hf. CCP hf. has granted permission to fuzzwork.co.uk to use EVE Online and all associated logos and designs for promotional and information purposes on its website but does not endorse, and is not in any way affiliated with, fuzzwork.co.uk. CCP is in no way responsible for the content on or functioning of this website, nor can it be liable for any damage arising from the use of this website.
</div>
{/block}
