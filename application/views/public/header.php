<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta name="msvalidate.01" content="E421CAD375C946A1BDCBF18E7A9C5206" />
        <meta name="google-site-verification" content="a8nh_Va3jcR7lZDiT2yE7czgnR1jqtAYcaF2sI1qFiA" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>asset/images/favicon-32.png">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>asset/images/favicon-57.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>asset/images/favicon-72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>asset/images/favicon-114.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:url" content="<?php echo current_url(); ?>" />
        <meta property="og:type"   content="website" />
        <meta property="fb:app_id" content="125427194666750" />

        <meta name="twitter:card" content="summary">
        <?php
        if (isset($meta)) {
            echo meta($meta);
            ?>
            <meta property="og:title" content="<?php echo isset($title) ? $title : ""; ?>" />
            <meta property="og:description" content="<?php echo isset($description) ? $description : ""; ?>" />
            <meta name="twitter:title" content="<?php echo isset($title) ? $title : ""; ?>">
            <meta name="twitter:description" content="<?php echo isset($description) ? $description : ""; ?>">
            <?php
        }
        ?>

        <title><?php
            if (!empty($title)) {

                echo $title;
            } else {

                echo "Birthdays.lk | Party Items, Foods, Services, Venues,Party Packages in Sri Lanka";
            }
            ?></title>


        <meta property="og:image"         content="<?php
        if (!empty($single_image)) {
            echo $single_image;
        } else {
            echo base_url('asset/images/logo.png');
        }
        ?>"/>
        <meta name="twitter:image"         content="<?php
        if (!empty($single_image)) {
            echo $single_image;
        } else {
            echo base_url('asset/images/logo.png');
        }
        ?>"/>




        <!-- Bootstrap Core CSS -->
        <!--        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">-->
        <link href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" rel="stylesheet">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
<!--        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
        <script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
        <!-- Bx Slider asset -->
        <link href="<?php echo base_url(); ?>asset/css/jquery.bxslider.css?v-<?Php echo time(); ?>" rel="stylesheet">
        <script src="<?php echo base_url(); ?>asset/js/jquery.bxslider.js?v-<?Php echo time(); ?>"></script>
        <!-- LIGHTBOX asset -->
        <link href="<?php echo base_url(); ?>asset/css/lightbox.min.css?v-<?Php echo time(); ?>" rel="stylesheet">
        <script src="<?php echo base_url(); ?>asset/js/lightbox.min.js?v-<?Php echo time(); ?>"></script>
        <!-- light Slider asset -->
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>asset/css/lightslider.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/lightslider.js"></script>
        <!-- Slick Slider-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/slick.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>asset/css/slick-theme.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/slick.js"></script>

        <!-- Js Cookie-->
        <script src="<?php echo base_url(); ?>asset/js/jscookie.js"></script>

        <!-- Custom Css/js -->
        <link href="<?php echo base_url(); ?>asset/css/style.css?v-<?Php echo time(); ?>" rel="stylesheet">
        <script src="<?php echo base_url(); ?>asset/js/custom.js?v-<?Php echo time(); ?>"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
        <!--[if IE]>
                   <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
               <![endif]-->

        <!--        input mask
                <script src="<?php echo base_url(); ?>asset/js/mask.js"></script>-->
    </head>
    <body>
        <?php require APPPATH . 'views/partials/topheader.php'; ?>



