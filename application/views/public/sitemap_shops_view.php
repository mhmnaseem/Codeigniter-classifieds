<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">


    <!-- Your Sitemap shop -->
    <?php foreach ($shops as $shop) { ?>
        <url>
            <loc><?php echo base_url() . "shops/" . $shop->name_slug; ?></loc>
            <priority>0.8</priority>
            <changefreq>daily</changefreq>


        </url>
    <?php } ?>




    <!-- Your Sitemap sub items-->


</urlset>