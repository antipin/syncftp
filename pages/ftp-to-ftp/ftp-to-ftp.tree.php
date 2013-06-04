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
            "content" => "FTP 2 FTP"
        ),

        array(
            "block" => "b-footer"
        ),
    ),
);