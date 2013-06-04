<?php
    $tag = isset($block["tag"]) ? $block["tag"] : "div";
?>
<<?= $tag ?> class="<?= $block["block"]?>"><?= $block["content"] ?></<?= $tag ?>>