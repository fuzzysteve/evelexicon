{extends file='layout.tpl' }
{block name=title}Add Term{/block}
{block name=body}
{if ($characterid==0)}
<div class="alert alert-danger" role="alert">You're not currently logged in. Please <a href="/auth/login.php" class="alert-link">log in</a>, if you want to be able to submit anything.</div>
{else}
<div class="entryForm">
<p>If you try to re-add a term, you will just add a new definition to it</p>
<form action="/addterm.php" method="post">
<input type=hidden value="{$nonce}" id='nonce' name='nonce'>
<table class="inputtable">
<tr><th><label for="term">Term</label></th><td><input type=text maxlength=100 size=100 name="term" id="term"></td></tr>
<tr><th><label for="definition">Definition</label></th><td><textarea cols=200 name="definition" id="definition"></textarea></td></tr>
</table>
<br>
<input type=submit value="Add Term">
</form>
</div>
{/if}
{/block}
