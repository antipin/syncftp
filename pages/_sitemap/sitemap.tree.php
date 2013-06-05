<?php

$pages = array();

$routes = include("routes.inc.php");
$sitemapRoutes = array();

foreach($routes as $request => $route) {
    if (!$route["exclude-from-sitemap"]) {
        $sitemapRoutes[] = array(
            "block" => "b-sitemap-url",
            "content" => "http://" . $_SERVER['HTTP_HOST'] . "/" . $request . "/",
            "changefreq" => "monthly"
        );
    }
}

return array(

    "headers" => array(
        "Content-type: text/xml",
    ),

    "page" => array(
        "<?xml version=\"1.0\" encoding=\"UTF-8\"?>",
        array(
            "block" => "b-sitemap-urlset",
            "content" => $sitemapRoutes
        ),
    ),
);