<?php
    $tag = isset($block["tag"]) ? $block["tag"] : "div";
?>
<<?= $tag ?> class="<?= $block["classes"]?>"><?= $block["content"] ?></<?= $tag ?>>