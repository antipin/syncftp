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
            "block" => "b-body",
            "content" => "Contact us"
        ),

        array(
            "block" => "b-footer"
        ),
    ),
);