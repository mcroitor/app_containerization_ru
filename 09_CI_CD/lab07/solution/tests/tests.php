<?php

require_once __DIR__ . '/testframework.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../modules/database.php';
require_once __DIR__ . '/../modules/page.php';

$tests = new TestFramework();

// test 1: check database connection
function testDbConnection() {
    global $config;
    
    try {
        $db = new Database($config['db']['path']);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// test 2: test count method
function testDbCount() {
    global $config;
    
    $db = new Database($config['db']['path']);
    $count = $db->Count('pages');
    return assertExpression($count == 3);
}

// test 3: test create method
function testDbCreate() {
    global $config;
    
    $db = new Database($config['db']['path']);
    $db->Create('pages', ['title' => 'Test', 'content' => 'Test']);
    $count = $db->Count('pages');
    return assertExpression($count == 4);
}

// test 4: test read method
function testDbRead() {
    global $config;
    
    $db = new Database($config['db']['path']);
    $data = $db->Read('pages', 1);
    return assertExpression($data[0]['title'] == 'Home');
}


// add tests
$tests->add('Database connection', 'testDbConnection');
$tests->add('Database count', 'testDbCount');
$tests->add('Database create', 'testDbCreate');

// run tests
$tests->run();

echo $tests->getResult();
