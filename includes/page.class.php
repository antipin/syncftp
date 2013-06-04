<?php

class Page {

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
            $blockTplPath = $page->_blocks[$block["block"]] . "/" . $block["block"] . ".tpl.php";
        }

        // Шаблон для блока не найден
        if (!file_exists($blockTplPath)) {
            $blockTplPath = DEFAULT_BLOCK_TPL;
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

                $tplData = array(
                    "block" => $node["block"],
                    "content" => $node["_build"]
                );
                $node["_build"] = $this->_build_node_content($tplData);

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
            $tplData = array(
                "block" => $node["block"],
                "content" => $node["_build"]
            );
            $node["_build"] = $this->_build_node_content($tplData);
            if ($node["parent"]) {
                return $this->_process_node($node["parent"]);
            } else {
                return $node["_build"];
            }
        }
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