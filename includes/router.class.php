<?php

class Router {

    const PAGE_DECLARATION_EXTENSION = ".tree.php";
    const DEFAULT_REQUEST = "index";
    const PAGE_404 = "404";

    private $_routes = array();
    private $_request = "";
    private $_pageName = "";
    private $_pageDeclarationPath = "";

    public function __construct() {

        $this->_routes = include("routes.php");

        $this->_request = $this->_get_request();

        $this->_pageDeclarationPath = $this->_get_page_declaration_path();
    }

    /**
     * Возвращает машинное имя страницы
     */
    public function get_page_name() {
        return $this->_pageName;
    }

    /**
     * Возвращает декларацию страницы
     * @return array
     */
    public function get_page_tree() {

        static $pageTree = array();

        if (!empty($pageTree)) {
            return $pageTree;
        }
        else {
            $pageTree = include($this->_pageDeclarationPath);
        }

        return $pageTree;
    }

    /**
     * Формирует путь до декларации страницы
     * @return string
     * @throws Exception
     */
    private function _get_page_declaration_path() {

        if (array_key_exists($this->_request, $this->_routes)) {
            $pageName = $this->_request;
        }
        else {
            $pageName = self::PAGE_404;
        }

        $pageDeclarationPath = implode("/", array(
            DIR_PAGES,
            $pageName,
            $pageName . self::PAGE_DECLARATION_EXTENSION
        ));

        if (file_exists($pageDeclarationPath)) {
            $this->_pageName = $pageName;
            return $pageDeclarationPath;
        }
        else {
            throw new Exception("Tree declaration for route $pageName not found.");
        }
    }

    /**
     * Возвращает запрос
     * @return string
     */
    private function _get_request() {

        static $path;

        if (isset($path)) {
            return $path;
        }

        if (isset($_SERVER['REQUEST_URI'])) {
            // This request is either a clean URL, or 'index.php', or nonsense.
            // Extract the path from REQUEST_URI.
            $request_path = strtok($_SERVER['REQUEST_URI'], '?');
            $base_path_len = strlen(rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/'));
            // Unescape and strip $base_path prefix, leaving q without a leading slash.
            $path = substr(urldecode($request_path), $base_path_len + 1);
            // If the path equals the script filename, either because 'index.php' was
            // explicitly provided in the URL, or because the server added it to
            // $_SERVER['REQUEST_URI'] even when it wasn't provided in the URL (some
            // versions of Microsoft IIS do this), the front page should be served.
            if ($path == basename($_SERVER['PHP_SELF'])) {
                $path = "";
            }
        }
        else {
            // This is the front page.
            $path = "";
        }

        // Under certain conditions Apache's RewriteRule directive prepends the value
        // assigned to $_GET['q'] with a slash. Moreover we can always have a trailing
        // slash in place, hence we need to normalize $_GET['q'].
        $path = trim($path, '/');

        if ($path == "") {
            $path = self::DEFAULT_REQUEST;
        }

        return $path;
    }

}