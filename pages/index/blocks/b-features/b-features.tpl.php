<?php
$features = array(

    array(
        "title" => "Fast and direct",
        "content" => "Forget about hours of low-speed data transfer. We offer you high-bandwidth servers for this tasks.",
        "icon" => "speed"
    ),

    array(
        "title" => "Completely online",
        "content" => "Our service is completely online with no software installation and runs in your favourite browser.",
        "icon" => "online"
    ),

    array(
        "title" => "Schedule",
        "content" => "Need a scheduled transfer? Set up a repeatable task or delay the transferring process.",
        "icon" => "calendar"
    ),

    array(
        "title" => "Notifications",
        "content" => "Get in touch with email notification on your tasks' progress.",
        "icon" => "megaphone"
    ),

    array(
        "title" => "History and logs",
        "content" => "Get details over all of your transfers and tasks, including pending, ongoing and cancelled ones.",
        "icon" => "history"
    ),

    array(
        "title" => "Customer support",
        "content" => "We're glad to offer first-class support for all our users. Feel free to contact us at any time.",
        "icon" => "support"
    )
);
?>

<section class="b-features">
    <div class="container">
        <div class="row">
            <div class="span12">

                <h2 class="b-features__title section-title">Why you will love us</h2>

                <div class="b-features__content row">
                    <?php foreach($features as $feature) : ?>
                        <div class="b-features__item span6">
                            <span class="s-no b-features__item-icon b-features__item-icon_type_<?= $feature["icon"]; ?>"></span>
                            <h3 class="b-features__item-title"><?= $feature["title"]; ?></h3>
                            <div class="b-features__item-content"><?= $feature["content"]; ?></div>
                        </div>
                    <? endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</section>
