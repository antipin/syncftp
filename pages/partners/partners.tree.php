<?php
return array(

    "block" => "b-page",
    "content" => array(
        array(
            "block" => "b-header",
            "content" => array(
                "block" => "b-nav",
                "content" => include(DIR_BLOCKS . "/b-nav/b-nav.tree.php") // todo: сделать поиск автоматическим
            ),
        ),

        array(
            "block" => "b-title",
            "title" => "Partnership",
            "content" => "We are looking forward for partnership with ISP and hosting providers.",
        ),

        array(
            "block" => "b-section",
            "content" => "Our service is definitely built upon high-quality servers and broadband internet, so if you would like to have your company logo to be proudly pinned on the service web pages, please feel free to contact us on that matter."
        ),

        array(
            "block" => "b-footer",
            "content" => array(
                "block" => "b-nav",
                "content" => include(DIR_BLOCKS . "/b-nav/b-nav.tree.php") // todo: сделать поиск автоматическим
            ),
        ),
    ),
);