<?php

class Page {

    public static $metas = array(), 
            $styles = array(), 
            $scripts = array(), 
            $menu = array(), 
            $content = "";
    var $config, $modules;
    var $html;

    function __construct($cfg) {
        $this->config = $this->loadConfig();
        $this->modules = array();

        $this->html = "";
        
        $this->modules = $this->loadModules();
    }

    function loadConfig() {
        $config = array();
        $result = sqlQuery("SELECT * FROM config_tbl");
        foreach ($result as $value) {
            $config[$value["variable_name"]] = $value["variable_value"];
        }
        return $config;
    }

    function genPage($p) {
        $this->__hook("preprocess_page");
        
        $this->__hook("postprocess_header");
        $this->__hook("process_{$p}");
        $this->__hook("postprocess_menu");
        
        $this->__hook("postprocess_page");
    }

    function getHtml() {
        $theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : $this->config['default_theme'];

        $html = $this->loadTemplate($theme);
        
        $html = str_replace("<!-- content-site -->", self::$content, $html);
        $html = str_replace("<!-- menu-site -->", implode("\n", self::$menu), $html);
        $html = str_replace("<!-- meta -->", implode("\n", self::$metas), $html);
        $html = str_replace("<!-- style -->", implode("\n", self::$styles), $html);
        $html = str_replace("<!-- script -->", implode("\n", self::$scripts), $html);
        return $html;
    }

    function loadTemplate($theme) {
        $tpl = loadData(THEME_PATH . "{$theme}/index.tpl.php");
        return str_replace("<!-- theme-path -->", THEME_PATH . $theme, $tpl);
    }

    function __hook($hook_name, $param = NULL) {
        $result = null;
        foreach ($this->modules as $module_name) {

            $fn = "{$module_name->name}->{$hook_name}";
            if (DEBUG == "1") {
                writeLog("test function '{$fn}'");
            }
            if (method_exists($module_name, $hook_name)) {
                if (DEBUG == "1") {
                    writeLog("call function '{$fn}' with param {$param}");
                }

                $result[$module_name->name] = $module_name->$hook_name($param);
            }
        }
        return $result;
    }

    function loadModules(){
        $_r = array();
        $result = sqlQuery("SELECT * FROM modules_tbl");
        
        foreach ($result as $m) {
            writeLog("load module: " . $m["module_name"]);
            includeFile(MODULE_PATH . "{$m["module_name"]}/{$m["module_name"]}.class.php");
            $_r[] = new $m["module_name"]();
        }
        return $_r;
    }
}
