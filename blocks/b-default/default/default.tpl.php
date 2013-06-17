<?php
    $tag = isset($block["tag"]) ? $block["tag"] : "div";
?>
<<?= $tag ?> class="<?= $block["block"] . "__" . $block["elem"]?>">
    <?= $block["content"] ?>
</<?= $tag ?>>