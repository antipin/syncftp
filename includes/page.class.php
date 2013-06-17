<?php

class Page {

    const BLOCK_DEFAULT_TPL = "b-default";
    const BLOCK_TPL_EXTENSION = ".tpl.php";

    private $_route = array();
    private $_tree = array();
    private $_blocks = array();
    private $_headers = array();


    function __construct($route, $pageTree) {

        $this->_route = $route;

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


    private function _build_node_content($node) {

        if (isset($node["block"])) {

            $isNodeElem = isset($node["block"]) && isset($node["elem"]);

            // Получаем декларацию для блока
            $blockDecl = isset($this->_blocks[$node["block"]])
                ? $this->_blocks[$node["block"]]
                : $this->_blocks[BLOCK_DEFAULT_TPL];


            if ($isNodeElem) {
                // Ищем декларацию для элемента
                $elemDecl = isset($blockDecl["elems"][$node["elem"]])
                    ? $blockDecl["elems"][$node["elem"]]
                    : $this->_blocks[self::BLOCK_DEFAULT_TPL]["elems"]["default"];

                // Если декларация элемента существует
                if ($elemDecl) {
                    $nodeTplPath = $elemDecl["path"] . "/" . $blockDecl["name"] . "__" . $elemDecl["name"] . self::BLOCK_TPL_EXTENSION;
                }
            }

            $nodeDecl = $isNodeElem ? $elemDecl : $blockDecl;

            $nodeTplPath = $nodeDecl["path"] . "/" . $nodeDecl["name"] . self::BLOCK_TPL_EXTENSION;

            // Шаблон для дефолтного блока (блок не найден)
            if (!file_exists($nodeTplPath)) {
                throw new Exception("Node " . $nodeDecl["name"] . " has no declaration (path: " . $nodeTplPath . ")");
            }

            // Формируем массив CSS-классов
            $classes = array();
            if (isset($node["cls"])) $classes = $node["cls"];
            if ($isNodeElem) {
                $classes[] = $node["block"] . "__" . $node["elem"];
            } else {
                $classes[] = $node["block"];
            }

            ob_start();
            $block = $node;
            $block["classes"] = implode(" ", $classes);
            include $nodeTplPath;
            $output = ob_get_clean();
        }
        else {
            $output = $node["content"];
        }

        return $output;
    }



    private function _process_node(&$node) {

        $isNodeString = is_string($node);
        $isNodeArrayOfNodes = is_array($node) && !is_assoc($node);

        // Нода является строкой
        if ($isNodeString || $isNodeArrayOfNodes) {
            $node = array(
                "content" => $node
            );
        }

        // Пробрасываем в ноды, являющиеся элементами, название родительского блока
        if (!isset($node["block"]) && isset($node["elem"])) {
            $node["block"] = $node["parent"]["block"];
        }

        if (isset($node["content"]) && is_array($node["content"]) && !isset($node["content"]["_build"])) {
            if (is_assoc($node["content"])) {
                $node["content"]["parent"] = &$node;
                return $this->_process_node($node["content"]);
            }
            else {
                foreach($node["content"] as &$_node) {
                    $node["_build"] .= $this->_process_node($_node) . "\n";
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
            $blocksDirList = glob($destination . "/*", GLOB_ONLYDIR);
            foreach($blocksDirList as $blockDir) {

                $explodedBlockDir = explode("/", $blockDir);
                $blockName = array_pop($explodedBlockDir);

                $blocks[$blockName]["path"] = $blockDir;
                $blocks[$blockName]["name"] = $blockName;
                $blocks[$blockName]["elems"] = array();

                $elemsDirList = glob($blockDir . "/*", GLOB_ONLYDIR);

                forEach($elemsDirList as $elemDir) {

                    $explodedElemDir = explode("/", $elemDir);
                    $elemName = array_pop($explodedElemDir);

                    $blocks[$blockName]["elems"][$elemName] = array(
                        "path" => $elemDir,
                        "name" => $elemName,
                    );
                }

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
            $this->_route["declaration-dir"],
            DIR_BLOCKS
        ));
        return array(DIR_BLOCKS, $pageBlocksDir);
    }

}