<?php

function login_form() {
    $form = "<form method='post' action='./?p=login' >"
            . "<input type='text' name='user_name' required='required' placeholder='username' />"
            . "<input type='password' name='user_password' required='required' placeholder='password' />"
            . "<input type='submit' />"
            . "</form>";
    return $form;
}

class users {

    var $name;
    var $version;

    function __construct() {
        $this->name = "users";
        $this->version = "20141205";
        writeLog("module {$this->name} is loaded");
    }

    function postprocess_menu() {
        if (isset($_SESSION['user_name'])) {
            Page::$menu[] = _link("options", "./?p=user_options", "menu-button");
            Page::$menu[] = _link("log out", "./?p=logout", "menu-button");
        } else {
            Page::$menu["login_form"] = login_form();
        }
        // Page::$content = crypt("password", "admin");
    }

    function process_login() {
        global $dblink;
        $user_name = filter_input(INPUT_POST, "user_name");
        $user_password = crypt(filter_input(INPUT_POST, "user_password"), $user_name);
        $sql_query = "SELECT * "
                . "FROM users_tbl "
                . "WHERE user_name='{$user_name}' AND "
                . "user_password='{$user_password}'";
        $result = $dblink->query($sql_query) or die($dblink->error);
        if ($result->num_rows > 0) {
            $_SESSION["user_name"] = $user_name;
            $usr = $result->fetch_array();
            $_SESSION["user_id"] = $usr["user_id"];
            // $_SESSION["user_access"] = $usr["user_access"];
        }
        $result->close();
        header("location: ./");
        exit();
    }
    
    function process_logout(){
        session_destroy();
        header("location: ./");
        exit();
    }

    function process_user_options(){
        //check_access();
        global $dblink;


        $result = $dblink->query("SELECT * FROM users_tbl WHERE user_id={$_SESSION['user_id']}");
        $usr_data = $result->fetch_array();
        Page::$content = "<fieldset>"
                . "<input type='text' name='email' value='{$usr_data['user_email']}' />"
                . "</fieldset>";
    }
}
