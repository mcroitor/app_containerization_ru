<?php

function message($type, $message) {
    $time = date('Y-m-d H:i:s');
    echo "{$time} [{$type}] {$message}" . PHP_EOL;
}

function info($message) {
    message('INFO', $message);
}

function error($message) {
    message('ERROR', $message);
}

function assertExpression($expression, $pass = 'Pass', $fail = 'Fail'): bool {
    if ($expression) {
        info($pass);
        return true;
    }
    error($fail);
    return false;
}

class TestFramework {
    private $tests = [];
    private $success = 0;

    public function add($name, $test) {
        $this->tests[$name] = $test;
    }

    public function run() {
        $count = 1;
        foreach ($this->tests as $name => $test) {
            info("{$count} Running test {$name}");
            if ($test()) {
                ++ $this->success;
            }
            ++ $count;
        }
    }

    public function getResult() {
        return "{$this->success} / " . count($this->tests);
    }
}
