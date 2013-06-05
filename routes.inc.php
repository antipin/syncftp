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

    // Misc
    "yandex_7c15c3fb2b4b1223.txt" => array(
        "declaration" => "yandex.tree.php",
        "declaration-dir" => "_3rd-part-authorization/yandex",
        "exclude-from-sitemap" => true,
    ),

    "BingSiteAuth.xml" => array(
        "declaration" => "bing.tree.php",
        "declaration-dir" => "_3rd-part-authorization/bing",
        "exclude-from-sitemap" => true,ßß
    ),

    // Sitemap
    "sitemap.xml" => array(
        "declaration" => "sitemap.tree.php",
        "declaration-dir" => "_sitemap",
        "exclude-from-sitemap" => true,
    ),
);