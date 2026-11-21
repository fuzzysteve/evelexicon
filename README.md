evelexicon
==========


You'll need to also have code from my auth repository.

And a postgres database.

Apache
------

`deploy/evelexicon.com.conf` is a copy of the live vhost
(`/etc/apache2/sites-available/evelexicon.com.conf`). It holds the `/term/`
rewrite (needs `[PT]` so PHP-FPM handles the rewritten URL), the PHP-FPM proxy,
Cloudflare real-IP settings and the Content-Security-Policy header. Needs
`mod_rewrite`, `mod_headers`, `mod_remoteip` and `mod_proxy_fcgi`.

Install with:

    cp deploy/evelexicon.com.conf /etc/apache2/sites-available/
    a2ensite evelexicon.com && apachectl configtest && systemctl reload apache2

Keep this copy in sync when the live vhost changes. `deploy/.htaccess` stops
the folder being served.
