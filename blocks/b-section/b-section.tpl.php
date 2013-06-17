<?
if (!$block["columns"]) {
    $content = '<div class="span12">' . $block["content"] . '</div>';
} else {
    $content = $block["content"];
}
?>
<section class="<?= $block["classes"] ?>">
    <div class="container">
        <div class="row">
            <?= $content ?>
        </div>
    </div>
</section>