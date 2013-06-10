<?php
global $router;
$currentRoute = $router->get_route();
if ($currentRoute["request"] == trim($block["href"], '/')) {
    $classActive = "b-nav-item_active_yes";
}
?>
<a href="/<?= $block["href"] ?>" class="<?= $classActive; ?> <?= $block["block"]; ?>"><?= $block["content"] ?></a>