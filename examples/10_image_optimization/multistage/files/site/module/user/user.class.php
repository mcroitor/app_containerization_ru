<?php

namespace module\user;
/*
 * The MIT License
 *
 * Copyright 2019 Croitor Mihail <mcroitor@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

use \core\page;
use \core\site;
use \mc\route;

/**
 * Description of user
 *
 * @author Croitor Mihail <mcroitor@gmail.com>
 */
class user implements \core\module
{
    public const AUTHENTICATED_CAPABILITY = 'user_authenticated';

    private static $props = [];

    public static function init()
    {
        \session_start();
        if (empty($_SESSION['user'])) {
            $userId = 1;
            $user = site::$database->select("user", ["*"], ["id" => $userId])[0];
            $_SESSION['user'] = $user;
            $userId = $_SESSION['user']['id'];
            $_SESSION['user']['role'] = self::getRole($userId);
            $roleId = $_SESSION['user']['role']['id'];
            $_SESSION['user']['capabilities'] = self::getCapabilities($roleId);
        }
        self::$props = $_SESSION['user'];
        site::$logger->debug("session: " . json_encode($_SESSION['user']), true);
    }

    public static function getProperty(string $property)
    {
        return self::$props[$property] ?? null;
    }

    public static function hasCapability(string $capability)
    {
        return isset(self::getProperty("capabilities")[$capability]);
    }

    private static function getRole($userId) {
        $userRole = site::$database->select(
            "user_role",
            ["*"],
            ["user_id" => $userId]);
        if(empty($userRole)) {
            return ['id' => 1, 'name' => 'guest', "description" => null];
        }
        return site::$database->select("role",["*"],["id" => $userRole[0]["role_id"]])[0];
    }

    private static function getCapabilities($roleId) {
        $capabilityIds = site::$database->select(
            "role_capability",
            ["capability_id AS id"],
            ["role_id" => $roleId]);
        $capabilities = [];
        foreach ($capabilityIds as $capabilityId) {
            $capability = site::$database->select(
                "capability",
                ["*"],
                ["id" => $capabilityId["id"]])[0];
            $capabilities[$capability["name"]] = $capability;
        }
        return $capabilities;
    }

    public static function data()
    {
        site::$logger->debug("complete page with login form");
        if (self::isAuthenticated()) {
            site::$logger->debug("is authenticated");
            site::$page->attach_data(page::ASIDE_CONTENT,
                file_get_contents(\config::module_dir . "user/templates/logout.template.php"));
        } else {
            site::$page->attach_data(page::ASIDE_CONTENT,
            file_get_contents(\config::module_dir . "user/templates/login.template.php"));
        }
    }

    #[route('user/login')]
    private static function login(): void
    {
        $db = site::$database;
        $username = \filter_input(INPUT_POST, "username") ?? "";
        $password = \filter_input(INPUT_POST, "password") ?? "";
        $key = \crypt($username . $password, $password);
        $what = ["login" => $username, "password" => $key];
        site::$logger->debug(print_r($what, true));
        if ($db->exists("user", $what)) {
            $user = $db->select("user", ["*"], $what)[0];
            self::$props = $user;
            // get role
            $role = self::getRole($user["id"]);
            self::$props["role"] = $role;
            // get capabilities
            self::$props["capabilities"] = self::getCapabilities($role["id"]);
        }
        $_SESSION["user"] = self::$props;
        \header("location:/");
        exit();
    }

    #[route('user/logout')]
    private static function logout(): void
    {
        \session_destroy();
        \header("location:/");
        exit();
    }

    public static function info(): string
    {
        return "";
    }

    public static function name(): string
    {
        return "user";
    }

    public static function version(): string
    {
        return "202105101100";
    }

    public static function isAuthenticated(): bool
    {
        return self::hasCapability(user::AUTHENTICATED_CAPABILITY);
    }
}
