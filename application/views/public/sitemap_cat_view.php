<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- Your Sitemap catergory -->

    <url>
        <loc><?php echo base_url() . "party-items" ?></loc>
        <priority>0.8</priority>
        <changefreq>daily</changefreq>
    </url>
    <url>
        <loc><?php echo base_url() . "foods" ?></loc>
        <priority>0.8</priority>
        <changefreq>daily</changefreq>
    </url>
    <url>
        <loc><?php echo base_url() . "games-activities-services" ?></loc>
        <priority>0.8</priority>
        <changefreq>daily</changefreq>
    </url>
    <url>
        <loc><?php echo base_url() . "venues" ?></loc>
        <priority>0.8</priority>
        <changefreq>daily</changefreq>
    </url>
    <url>
        <loc><?php echo base_url() . "party-packages" ?></loc>
        <priority>0.8</priority>
        <changefreq>daily</changefreq>
    </url>
    <url>
        <loc><?php echo base_url() . "food-packages" ?></loc>
        <priority>0.8</priority>
        <changefreq>daily</changefreq>
    </url>


    <!-- Your Sitemap catergory -->
    <?php foreach ($catlist as $cat) { ?>
        <url>
            <loc><?php echo base_url() . "category/" . $cat['slug'] ?></loc>
            <priority>0.8</priority>
            <changefreq>daily</changefreq>


        </url>
    <?php } ?>

    <!-- Your Sitemap sub catergory-->

    <?php foreach ($subcatlist as $scat) { ?>
        <url>
            <loc><?php echo base_url() . "subcategory/" . $scat['slug'] ?></loc>
            <priority>0.8</priority>
            <changefreq>daily</changefreq>

        </url>
    <?php } ?>


    <!-- Your Sitemap sub items-->


</urlset>