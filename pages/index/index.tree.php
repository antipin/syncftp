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
            "block" => "b-content",
            "content" => array(
                array(
                    "block" => "b-promo",
                    "content" => array(
                        "block" => "b-email-trap"
                    ),
                ),
                array(
                    "block" => "b-sync-scheme"
                ),
                array(
                    "block" => "b-features"
                ),
                array(
                    "block" => "b-usecases"
                ),
            ),
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