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
            "title" => "FTP to FTP",
            "content" => "Synchronize FTP remote servers directly!",
        ),

        array(
            "block" => "b-section",
            "content" => array(

                array(
                    "block" => "b-paragraph",
                    "content" => "SyncFTP service is created specially to perform direct ftp to ftp transfers (and other endpoints too). Whenever you need to move a site, copy data from one server to another or synchronize some backups between two endpoints, you have to download the data most times. This issues several disadvantages at a time:",
                ),

                array(
                    "block" => "b-list",
                    "items" => array(
                        "Your download and upload speeds are limited by your ISP plan. In case of popular ADSL connection the uplink is often limited by 1 Mbps by the specification itself, so it makes painful to upload large files",
                        "You have to manage the procedure completely: handle errors and keep an eye on the process since there is no guarantee in success (force majeure sometime occur, like network or electricity failures",
                        "The task should be run by at least two steps, download and upload stages, so you should store the temporary data on your hard drive. And if that data exceeds your storage? Then you multiply the steps count as many times as needed."
                    ),
                ),

                array(
                    "block" => "b-paragraph",
                    "content" => "This problem can be solved by removing your PC or laptop from the transfer process, that eliminates the “network bottleneck” (your ISP speed), manages data automatically on-the-go and transfers it directly through high-speed SyncFTP server. SyncFTP moves your data completely online with a web-based interface to create and manage transfer tasks in terms of “endpoints”, your remote connections and services (FTP, SFTP, Dropbox and others).",
                ),

                array(
                    "block" => "b-paragraph",
                    "content" => "SyncFTP service offers the following:",
                ),

                array(
                    "block" => "b-list",
                    "items" => array(
                        "Broadband transfer speeds, at least 100 Mbps both ways (download and upload)",
                        "Strong transfer servers and a handy web interface to manage everything",
                        "Fully automated control of your data transfers, detailed reports and instant alerts on any issues occur",
                        "High 24/7 service availability, customer care",
                        "Distributed data-servers, that are appropriately used to serve local region tasks. If we have a server in your region (in your data server’s region indeed), this server will be handling your data",
                        "Lots of built in endpoint templates, like FTP, SFTP, FTPS, Dropbox and Amazon S3",
                    ),
                ),

            ),
        ),

        array(
            "block" => "b-footer"
        ),
    ),
);