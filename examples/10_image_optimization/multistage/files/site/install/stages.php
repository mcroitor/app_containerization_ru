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

include_once __DIR__ . '/../core/template/mc/template.php';
$stage = (int) filter_input(INPUT_POST, "stage");

file_put_contents("php://stdout", "stage = {$stage}\n");

if (empty($stage)) {
    if (file_exists(__DIR__ . "/../config.php")) {
        echo "<h2>site is installed!</h2>";
        echo "<form method='post' name='stageform' action='../'>";
        echo "<input class='button-primary' type='submit' value='Done' />";
        echo "</form>";
        exit();
    }
    echo "<h3>Configuring...</h3>";
    echo "<fieldset><legend>database configuration</legend>";
    echo "<form method='post' name='stageform'>";
    ++$stage;
    echo "<input type='hidden' name='stage' value='{$stage}' />";
    echo "<table>";
    echo "  <tr><td>DB name</td><td><input class='u-full-width' type='text' name='dbname' required='required' placeholder='mydatabase' /></td></tr>";
    echo "  <tr><td colspan='2'><input class='button-primary' type='button' value='install' onclick='get_stage();' /></td></tr>";
    echo "</table>";
    exit();
}

if ($stage === 1) {
    echo "<h3>configuring...</h3>";
    // create config file here
    $cfgfile = file_get_contents(__DIR__ . "/config.example.php");
    $data["databasename"] = filter_input(INPUT_POST, "dbname");
    file_put_contents(__DIR__ . "/../config.php", (new \mc\template($cfgfile))->fill($data)->value());
    echo "<p>Done!</p>";

    echo "<p>install tables ... </p>";
    include_once __DIR__ . '/../config.php';
    // fix sql connection string
    $database = new \mc\sql\database(config::dsn);
    
    // create tables here
    $database->parse_sqldump(__DIR__ . "/sqlite.sql");
    echo "<p>tables installed!</p>";
    echo "<form method='post' name='stageform'>";
    ++$stage;
    echo "<input type='hidden' name='stage' value='{$stage}' />";
    echo "<input class='button-primary' type='button' value='Next' onclick='get_stage();' />";
    echo "</form>";
    exit();
}

if ($stage === 2) {
    echo "<h3>Install plugins...</h3>";
    include_once __DIR__ . '/../config.php';
    \core\site::$database = new \mc\sql\database(config::dsn);
    
    include_once __DIR__ . '/../core/modulemanager.class.php';

    $manager = new \core\modulemanager();
    $modules = $manager->get_modules();
    foreach ($modules as $module) {
        echo "<p>install module '{$module}'</p>";
        $manager->install($module);
        echo "<p>done!</p>";
    }
    echo "<form method='post' name='stageform'>";
    ++$stage;
    echo "<input type='hidden' name='stage' value='{$stage}' />";
    echo "<input class='button-primary' type='submit' value='Done' />";
    echo "</form>";
    exit();
}

if ($stage === 3) {
    echo "<h3>Done!</h3>";
    echo "<form method='post' name='stageform' action='../'>";
    ++$stage;
    echo "<input type='hidden' name='stage' value='{$stage}' />";
    echo "<input class='button-primary' type='submit' value='Done' />";
    echo "</form>";
    exit();
}
