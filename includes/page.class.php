<?php

class Page {

    const BLOCK_DEFAULT_TPL = "b-default";
    const BLOCK_TPL_EXTENSION = ".tpl.php";

    private $_name = "";
    private $_tree = array();
    private $_blocks = array();
    private $_headers = array();


    function __construct($pageName, $pageTree) {

        $this->_name = $pageName;

        // В декларации станицы могут быть определены HTTP заголовки
        if (isset($pageTree["headers"])) {
            $this->_headers = $pageTree["headers"];
        }

        // Дерево страницы может находится в корне или по кллючу "page"
        if (isset($pageTree["page"])) {
            $this->_tree = $pageTree["page"];
        }
        else {
            $this->_tree = $pageTree;
        }

        $this->_blocks = $this->_build_block_list();
    }


    public function output() {

        // Выводим HTTP заголовки
        if (!empty($this->_headers)) {
            foreach($this->_headers as $header) {
                header($header);
            }
        }

        // Выводим страницу
        print $this->_build();
    }


    private function _build() {
        $tree = $this->_tree;
        return $this->_process_node($tree);
    }


    private function _build_node_content($block) {

        global $page;

        // Шаблон для блока существует
        if (array_key_exists($block["block"], $page->_blocks)) {
            $blockTplPath = $page->_blocks[$block["block"]] . "/" . $block["block"] . self::BLOCK_TPL_EXTENSION;
        }

        // Шаблон для блока не найден
        if (!file_exists($blockTplPath)) {
            $blockTplPath = implode("/", array(
                DIR_BLOCKS,
                self::BLOCK_DEFAULT_TPL,
                self::BLOCK_DEFAULT_TPL . ".tpl.php",
            ));
        }

        ob_start();
        include $blockTplPath;
        return ob_get_clean();
    }



    private function _process_node(&$node) {

        if (isset($node["content"]) && is_array($node["content"]) && !isset($node["content"]["_build"])) {
            if (is_assoc($node["content"])) {
                $node["content"]["parent"] = &$node;
                return $this->_process_node($node["content"]);
            }
            else {
                foreach($node["content"] as &$_node) {
                    $node["_build"] .= $this->_process_node($_node);
                }

                $node["_build"] = $this->_build_node_content($this->_prepare_tpl_var($node));

                if ($node["parent"]) {
                    return $this->_process_node($node["parent"]);
                } else {
                    return $node["_build"];
                }
            }
        } else {
            if (isset($node["content"]) && is_string($node["content"])) {
                $node["_build"] = $node["content"];
            } else {
                $node["_build"] = $node["content"]["_build"];
            }
            $node["_build"] = $this->_build_node_content($this->_prepare_tpl_var($node));
            if ($node["parent"]) {
                return $this->_process_node($node["parent"]);
            } else {
                return $node["_build"];
            }
        }
    }


    private function _prepare_tpl_var($node) {
        $block = $node;
        unset($block["_build"]);
        $block["content"] = $node["_build"];
        return $block;
    }


    /**
     * Возвращает массив блоков
     * @return mixed
     */
    private function _build_block_list() {

        static $blocks = array();

        if (!empty($blocks)) return $blocks;

        $destinations = $this->_get_blocks_destinations();

        foreach($destinations as $destination) {
            $dirList = glob($destination . "/*", GLOB_ONLYDIR);
            foreach($dirList as $dir) {
                $explodedDir = explode("/", $dir);
                $blockName = array_pop($explodedDir);
                $blocks[$blockName] = $dir;
            }
        }
        return $blocks;
    }


    /**
     * Возвращает массив директорий, в которых следует искать блоки для посторения страницы.
     * @return array
     */
    private function _get_blocks_destinations() {
        $pageBlocksDir = implode("/", array(
            DIR_PAGES,
            $this->_name,
            DIR_BLOCKS
        ));
        return array(DIR_BLOCKS, $pageBlocksDir);
    }

}