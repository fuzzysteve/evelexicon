{extends file='layout2.tpl' }
{block name=title}EVELexicon.com{/block}
{block name=body}
<div class="home">

<section class="home-hero">
    <h1>EVE Lexicon</h1>
    <p class="home-tagline">Work out what that guy on comms is yammering about.</p>
    <form action="/search.php" method="post" class="home-search" role="search">
        <div class="input-group input-group-lg">
            <input type="text" name="search" class="form-control" placeholder="e.g. tackle, bubble, cyno" aria-label="Search terms" autofocus>
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
            </span>
        </div>
    </form>
    <ul class="home-stats">
        <li><strong>{$stats.terms}</strong> terms</li>
        <li><strong>{$stats.definitions}</strong> definitions</li>
        <li><strong>{$stats.contributors}</strong> contributors</li>
    </ul>
    <a class="home-browse" href="/list.php">Browse the full A&ndash;Z list &rarr;</a>
</section>

{if $termoftheday}
<section class="home-tod">
    <div class="home-label">Term of the day &middot; {$smarty.now|date_format:"%e %B"}</div>
    <h2><a href="/term/{$termoftheday.term|escape:'url'|replace:'%2F':'/'}">{$termoftheday.term|escape}</a></h2>
    <p class="home-tod-definition">{$termoftheday.definition|escape|nl2br}</p>
    <div class="home-byline">
        <img src="https://images.evetech.net/characters/{$termoftheday.userid}/portrait?size=32" width="32" height="32" alt="">
        Defined by {$termoftheday.username|escape}
        <a class="home-more" href="/term/{$termoftheday.term|escape:'url'|replace:'%2F':'/'}">All definitions &rarr;</a>
    </div>
</section>
{/if}

<div class="row home-columns">
    <div class="col-md-5 col-sm-6">
        <section class="home-panel">
            <h3>Explore</h3>
            <div class="home-chips">
{foreach $explore as $term}
                <a href="/term/{$term.term|escape:'url'|replace:'%2F':'/'}" title="{$term.definition|truncate:140|escape}">{$term.term|escape}</a>
{/foreach}
            </div>
        </section>
    </div>
    <div class="col-md-4 col-sm-6">
        <section class="home-panel">
            <h3>Recently added</h3>
            <ul class="home-list">
{foreach $recent as $term}
                <li><a href="/term/{$term.term|escape:'url'|replace:'%2F':'/'}">{$term.term|escape}</a></li>
{/foreach}
            </ul>
        </section>
    </div>
    <div class="col-md-3 col-sm-12">
        <section class="home-panel">
            <h3>Top contributors</h3>
            <ol class="home-list home-contributors">
{foreach $contributors as $c}
                <li><img src="https://images.evetech.net/characters/{$c.userid}/portrait?size=32" width="24" height="24" alt=""> {$c.username|escape} <span class="home-count">{$c.definitions}</span></li>
{/foreach}
            </ol>
        </section>
    </div>
</div>

<section class="home-cta">
{if $characterid>0}
    <p>Know a term that's missing, or a better way to explain one?</p>
    <a class="btn btn-default" href="/enter.php">Add a term</a>
{else}
    <p>Know a term that's missing? Log in with EVE to add it.</p>
    <a href="/auth/login.php"><img src="/auth/EVE_SSO_Login_Buttons_Large_Black.png" width="178" height="30" alt="Log in with EVE"></a>
{/if}
</section>

<footer class="home-legal">
EVE Online and the EVE logo are the registered trademarks of CCP hf. All rights are reserved worldwide. All other trademarks are the property of their respective owners. EVE Online, the EVE logo, EVE and all associated logos and designs are the intellectual property of CCP hf. All artwork, screenshots, characters, vehicles, storylines, world facts or other recognizable features of the intellectual property relating to these trademarks are likewise the intellectual property of CCP hf. CCP hf. has granted permission to EveLexicon.com to use EVE Online and all associated logos and designs for promotional and information purposes on its website but does not endorse, and is not in any way affiliated with, EveLexicon.com. CCP is in no way responsible for the content on or functioning of this website, nor can it be liable for any damage arising from the use of this website.
</footer>

</div>
{/block}
