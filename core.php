<?
    function block($blockName, $args = array()) {

        $blockFileName = "blocks/" . $blockName . "/" . $blockName . ".php";
        $blockCallback = str_replace("-", "_", $blockName);

        require_once ($blockFileName);

        if (function_exists($blockCallback)) {
            print call_user_func_array($blockCallback, $args);
        }
    }
?>