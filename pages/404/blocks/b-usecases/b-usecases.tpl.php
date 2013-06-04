<?php
$usecases = array(

    array(
        "title" => "Move your website",
        "content" => "Thinking about new hosting? You can transfer all you files directly from
                      one remote FTP to another without downloading them to your desktop.",
        "icon" => ""
    ),

    array(
        "title" => "Perform scheduled backups to Amazon S3 storage",
        "content" => "You can set up a schedule for regular backups of your site to another FTP server,
                      Amazon S3 cloud or Dropbox.",
        "icon" => ""
    ),

    array(
        "title" => "Manage you web-site files easily with Dropbox",
        "content" => "You can instantly set synchronization of your website files with Dropbox and manage website files like a local folder.",
        "icon" => "calendar"
    )
);
?>

<section class="<?= $block["block"] ?>">
    <div class="container">
        <div class="row">
            <div class="span12">

                <h2 class="b-usecases__title section-title">Usage scenarios</h2>

                <ul class="b-usecases__content row">
                    <?php foreach($usecases as $usecase) : ?>
                    <li class="b-usecases__item">
                        <h3 class="b-usecases__item-title"><?= $usecase["title"]; ?></h3>
                        <div class="b-usecases__item-content"><?= $usecase["content"]; ?></div>
                    </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </div>
</section>
