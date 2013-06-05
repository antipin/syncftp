<?php

return array(

        "headers" => array(
            "HTTP/1.0 404 Not Found"
        ),

        "page" => array(
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
                    "block" => "b-section",
                    "content" => "404. Page not found"
                ),

                array(
                    "block" => "b-footer"
                ),
            ),
        )
    );