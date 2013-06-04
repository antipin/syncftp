<?php

// Директория, в которой находятся декларации страниц
define("DIR_PAGES", "pages");

// Директория, в которой находятся блоки
define("DIR_BLOCKS", "blocks");

include "includes/common.php";
include "includes/router.class.php";
include "includes/page.class.php";

$router = new Router(include("routes.php"));
$page = new Page($router->get_page_name(), $router->get_page_tree());

print $page->output();