{extends file='layout2.tpl' }
{block name=title}Report Definition{/block}
{block name=body}
<div class="container">
<div id="about">
<h1>Report Definition</h1>
<p>{$term.definition}</p>
<p>Are you sure you want to report this term?</p>
<a href="/reportterm.php?id={$term.id}&nonce={$nonce}" class="btn btn-primary btn-lg">Report</a>
</div>
</div>
<div class="tsandcs">
EVE Online and the EVE logo are the registered trademarks of CCP hf. All rights are reserved worldwide. All other trademarks are the property of their respective owners. EVE Online, the EVE logo, EVE and all associated logos and designs are the intellectual property of CCP hf. All artwork, screenshots, characters, vehicles, storylines, world facts or other recognizable features of the intellectual property relating to these trademarks are likewise the intellectual property of CCP hf. CCP hf. has granted permission to EveLexicon.com to use EVE Online and all associated logos and designs for promotional and information purposes on its website but does not endorse, and is not in any way affiliated with, evelexicon.com. CCP is in no way responsible for the content on or functioning of this website, nor can it be liable for any damage arising from the use of this website.
</div>
{/block}
