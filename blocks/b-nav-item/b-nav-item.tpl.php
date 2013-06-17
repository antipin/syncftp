<?php
global $router;
$currentRoute = $router->get_route();
if ($currentRoute["request"] == trim($block["href"], '/')) {
    $block["classes"] .= " b-nav-item_active_yes";
}
?>
<a href="/<?= $block["href"] ?>" class="<?= $block["classes"] ?>"><?= $block["content"] ?></a>