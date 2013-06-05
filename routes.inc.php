<?php
return array(

    // Pages
    "index" => array(
        "title" => "Front",
    ),
    "ftp-to-ftp" =>  array(
        "title"=> "FTP to FTP",
    ),
    "partners" => array(
        "title" => "Partners",
    ),
    "contact-us" => array(
        "title" => "Contact us",
    ),

    // Errors
    "404" => array(
        "title" => "Not found",
        "exclude-from-sitemap" => true,
    ),

    // Sitemap
    "sitemap.xml" => array(
        "declaration" => "sitemap.tree.php",
        "declaration-dir" => "_sitemap",
        "exclude-from-sitemap" => true,
    ),
);