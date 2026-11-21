<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"> 
  <url>
      <loc>https://evelexicon.com/list.php</loc> 
  </url>
  <url>
      <loc>https://evelexicon.com/about.php</loc> 
  </url>
{foreach $terms as $term}
    <url>
        <loc>https://evelexicon.com/define.php?id={$term.id}</loc>
    </url>
{/foreach}
</urlset>
