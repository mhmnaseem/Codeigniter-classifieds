<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo base_url(); ?></loc>
        <priority>1.0</priority>
        <changefreq>hourly</changefreq>

    </url>

    <!-- Your Sitemap items-->

    <?php foreach ($singleitem as $item) { ?>
        <url>
            <loc><?php echo base_url() . "item/" . $item['slug'] ?></loc>
            <priority>0.6</priority>
            <changefreq>hourly</changefreq>

        </url>
    <?php } ?>

    <?php foreach ($singlepack as $pack) { ?>
        <url>
            <loc><?php echo base_url() . "package/" . $pack['slug'] ?></loc>
            <priority>0.6</priority>
            <changefreq>hourly</changefreq>

        </url>
    <?php } ?>

</urlset>