<?php

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

if (file_exists('./config.php') === false) {
    header("location:/install/");
    exit();
}

include_once __DIR__ . '/config.php';

// start site populating
\core\site::$database = new \mc\sql\database(config::dsn);
\core\site::$logger = new \mc\logger();
\core\site::$logger->enableDebug(config::$debug);
\core\site::$page = new core\page();

// use routes for parse GET, POST and SESSION, populate in \core\site::$page
\mc\router::init();
\mc\router::run();

\core\site::$logger->debug(json_encode(\core\site::$page->get_data(\core\page::ASIDE_CONTENT)));

// render page
echo \core\site::$page->render();
