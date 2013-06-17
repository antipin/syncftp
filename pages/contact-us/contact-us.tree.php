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
            "title" => "Contact information",
            "content" => "Feel free to contact as for any reason!",
        ),
        array(
            "block" => "b-content",
            "content" => array(
                array(
                    "block" => "b-section",
                    "columns" => true,
                    "content" => array(
                        array(
                            "block" => "b-section",
                            "elem" => "column",
                            "cls" => array("span7"),
                            "content" => array(
                                array(
                                    "block" => "b-paragraph",
                                    "content" => "SyncFTP idea appeared as a solution for personal business needs. No services that can meet the requirements were found those days, so the initial one was created.",
                                ),
                                array(
                                    "block" => "b-paragraph",
                                    "content" => "Feel free to share your thoughts and suggestions and we’ll try to get in touch as soon as possible.",
                                ),
                            ),
                        ),
                        array(
                            "block" => "b-section",
                            "elem" => "column",
                            "cls" => array("span5"),
                            "content" => array(
                                "block" => "b-contact-form",
                            ),
                        ),
                    ),
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