<?php

namespace module\article;
/*
 * The MIT License
 *
 * Copyright 2021 XiaomiPRO.
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

use config;
use \core\page;
use core\site;
use module\user\user;
use \mc\route;

/**
 * Description of article
 *
 * @author XiaomiPRO
 */
class article implements \core\module
{
    // capabilities
    public const CREATE_CAPABILITY = "article_create";

    protected static $page = 0;
    protected static $total = 12;

    public static function info(): string
    {
        return "";
    }

    public static function name(): string
    {
        return "article";
    }

    public static function version(): string
    {
        return "202105101900";
    }

    public static function view(array $articleId = [])
    {
        $database = \core\site::$database;
        $result = "";
        $tpl = \file_get_contents(\config::module_dir . "/article/templates/article.template.php");
        $generator = new \mc\template($tpl, ["prefix" => "<!-- ", "suffix" => " -->"]);

        if (empty($articleId)) {
            // show page of articles
            $articles = $database->select(
                \meta\article::__name__, ['*'], [],
                ['offset' => self::$page, 'limit' => self::$total]
            );
            foreach ($articles as $article) {
                $result .= $generator->fill($article)->value();
            }
        } else {
            // show article
            $article = $database->select(
                \meta\article::__name__,
                ["*"],
                [\meta\article::ID => $articleId[0]]);
            $result .= $generator->fill($article)->value();
        }
        return $result;
    }

    #[route("article/create")]
    public static function create() {
        // TODO: Implement
        if(! user::hasCapability(article::CREATE_CAPABILITY)) {
            header("location:" . config::root_dir);
            exit();
        }
        if(empty($_POST[\meta\article::TITLE])) {
            //site::$page->set_data();
            return;
        }
        $crud = new \mc\sql\crud(site::$database, \meta\article::__name__);
        $crud->insert([
            \meta\article::TITLE => filter_input(INPUT_GET, \meta\article::TITLE),
            \meta\article::BODY => filter_input(INPUT_GET, \meta\article::BODY),
            \meta\article::CREATED => time(),
        ]);

    }

    public static function data() {
        \core\site::$page->set_data(page::CONTENT, self::view([]));
        if(user::isAuthenticated()) {
            \core\site::$page->attach_data(
                page::ASIDE_CONTENT,
                "<a href='./?q=article/create'>create article</a>");
        }
    }
}
