<?
    $block["classes"] .= " well"
?>

<form class="<?= $block["classes"] ?>">

    <fieldset>

        <div class="control-group">
            <label class="control-label">Name</label>
            <div class="controls">
                <input class="input-block-level" type="text" placeholder="Your name…">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">E-mail</label>
            <div class="controls">
                <input class="input-block-level" type="email" placeholder="user@domain.com…">
                <span class="help-block">So we could get in touch with you.</span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Message</label>
            <div class="controls">
                <textarea class="input-block-level" rows="3"></textarea>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </fieldset>

    <?= $block["content"] ?>
</form>