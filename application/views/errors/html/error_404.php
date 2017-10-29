<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>404 Page Not Found</title>
        <style type="text/css">
            /*  --- 404 page --- */
            .container404{
                background-color: #3A353C;
                margin-top: 10px;

            }
            #post-404{
                text-align: center;
            }
            .container404{
                padding-bottom: 200px;
            }

            .text-404{

                font-family: 'lato', sans-serif;
                font-weight:400;
                font-size: 75px;
                color:#9D9A9E;
                padding-top: 200px;

            }
            .sub-text-404{
                font-family: 'lato', sans-serif;
                font-weight:200;
                font-size: 25px;
                color:#9D9A9E;

            }

            .sub-text-3-404{
                font-family: 'lato', sans-serif;
                font-weight:400;
                font-size:20px;
                color:#9D9A9E;
            }





        </style>
    </head>
    <body>
        <div class="container404">
            <!-- section -->
            <section>

                <!-- article -->
                <article id="post-404">
                    <p class="text-404">404</p>
                    <h1 class="sub-text-404">Page not found</h1>

                    <p class="sub-text-3-404">Looks like the page you're trying to visit doesn't exist.
                        Please check the URL and try your luck again.</p>
                    <a class="btn btn-warning btn-lg" href="<?php echo base_url(); ?>">Take Me Home</a>
                </article>
                <!-- /article -->

            </section>
            <!-- /section -->
        </div>
    </body>
</html>